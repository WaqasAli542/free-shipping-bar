<?php
namespace Waqas\FreeShippingBar\Block\Adminhtml\Entity;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Initialize form.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'Waqas_FreeShippingBar';
        $this->_controller = 'adminhtml_entity';
        parent::_construct();

        if ($this->_isAllowedAction('Waqas_FreeShippingBar::free_shipping_bar_management')) {
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
            $this->buttonList->remove('delete');
        }
    }

    /**
     * Check permission for passed action.
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
