<?php
namespace Waqas\FreeShippingBar\Controller\Adminhtml\Entity;

use Magento\Framework\View\Result\PageFactory;
use Waqas\FreeShippingBar\Helper\Data;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Edit extends \Waqas\FreeShippingBar\Controller\Adminhtml\Entity implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Data
     */
    private $data;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Waqas\FreeShippingBar\Model\EntityFactory $entityFactory
     * @param PageFactory $resultPageFactory
     * @param Data $data
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Waqas\FreeShippingBar\Model\EntityFactory $entityFactory,
        PageFactory $resultPageFactory,
        Data $data
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->data = $data;
        parent::__construct($context, $coreRegistry, $entityFactory);
    }

    /**
     * @return void
     */
    public function execute()
    {
        if ($this->data->getConfig('Waqas_free_shipping_bar/general/enable') == 0) {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('admin/dashboard/index', ['_current' => true]);
        }

        $entityId = $this->getRequest()->getParam('entity_id');
        /** @var $model \Waqas\FreeShippingBar\Model\Entity */
        $model = $this->entityFactory->create();
        if ($entityId) {
            $model->load($entityId);
            if (!$model->getEntityId()) {
                $this->messageManager->addErrorMessage(__('This shipping bar no longer exist.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->coreRegistry->register(self::REGISTRY_KEY_CURRENT_ENTITY, $model);

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Free Shipping Bar'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $model->getEntityId() ? $model->getName() : __('New Shipping Bar')
        );
        $breadcrumb = $entityId ? __('Edit Shipping Bar') : __('New Shipping Bar');
        $this->_addBreadcrumb($breadcrumb, $breadcrumb);
        $this->_view->renderLayout();
    }
}
