<?php
namespace Waqas\FreeShippingBar\Controller\Adminhtml\Entity;

use Magento\Framework\App\Action\HttpPostActionInterface;

class Save extends \Waqas\FreeShippingBar\Controller\Adminhtml\Entity implements HttpPostActionInterface
{
    /**
     * DateFilter
     *
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    private $dateFilter;

    /**
     * Save constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Waqas\FreeShippingBar\Model\EntityFactory $entityFactory
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Waqas\FreeShippingBar\Model\EntityFactory $entityFactory,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
    ) {
        $this->dateFilter = $dateFilter;
        parent::__construct($context, $coreRegistry, $entityFactory);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            try {
                if (empty($data['entity_id'])) {
                    unset($data['entity_id']);
                }

                /** @var $model \Waqas\FreeShippingBar\Model\Entity */
                $model = $this->entityFactory->create();
                $entityId = (int)$this->getRequest()->getParam('entity_id');
                if ($entityId) {
                    $model->load($entityId);
                }

                if (!$data['to_date']) {
                    $data['to_date'] = null;
                }

                $model->setData($data);
                $model->save();

                $this->messageManager->addWarningMessage(
                    __('Please, refresh the full page cache for the changes to take effect.')
                );
                $this->messageManager->addSuccessMessage(__('The shipping bar is saved successfully.'));

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['entity_id' => $model->getEntityId()]);
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('Something went wrong while saving the shipping bar data. Please review the error log.')
                );
                $this->_redirect('*/*/edit', ['entity_id' => (int)$this->getRequest()->getParam('entity_id')]);
                return;
            }
            $this->_redirect('*/*/');
            return;
        }
    }
}
