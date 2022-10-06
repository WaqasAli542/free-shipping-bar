<?php
namespace  Waqas\FreeShippingBar\Controller\Adminhtml\Entity;

use Magento\Framework\View\Result\PageFactory;
use Waqas\FreeShippingBar\Helper\Data;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Index extends \Waqas\FreeShippingBar\Controller\Adminhtml\Entity implements HttpGetActionInterface
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

        $this->_initAction()->_addBreadcrumb(__('Manage Free Shipping Bar'), __('Manage Free Shipping Bar'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Free Shipping Bar'));
        $this->_view->renderLayout();
    }
}
