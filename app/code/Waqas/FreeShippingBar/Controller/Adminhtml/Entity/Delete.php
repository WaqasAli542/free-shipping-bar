<?php
namespace Waqas\FreeShippingBar\Controller\Adminhtml\Entity;

use Magento\Framework\App\ActionInterface;

class Delete extends \Waqas\FreeShippingBar\Controller\Adminhtml\Entity implements ActionInterface
{
    /**
     * @return void
     */
    public function execute()
    {
        $entityId = $this->getRequest()->getParam('entity_id');
        if ($entityId) {
            try {
                $model = $this->entityFactory->create();
                $model->load($entityId);
                $model->delete();
                $this->messageManager->addSuccess(__('The shipping bar is deleted successfully.'));
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_redirect('*/*/edit', ['entity_id' => $entityId]);
                return;
            }
        }
        $this->messageManager->addError(__('We can\'t find a bar to delete.'));
    }
}
