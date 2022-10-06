<?php
namespace Waqas\FreeShippingBar\Block\Adminhtml\Entity\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * Initialize free shipping bar edit page tabs.
     *
     * @return void
     * @codeCoverageIgnore
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('Waqas_free_shipping_bar_entity_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Free Shipping Bar Information'));
    }

    /**
     * @return \Magento\Backend\Block\Widget\Tabs
     * @throws \Exception
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'main',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getChildHtml('main'),
                'active' => true
            ]
        );
        $this->addTab(
            'what_to_display',
            [
                'label' => __('What to Display'),
                'title' => __('What to Display'),
                'content' => $this->getChildHtml('what_to_display')
            ]
        );
        $this->addTab(
            'where_to_display',
            [
                'label' => __('Where to Display'),
                'title' => __('Where to Display'),
                'content' => $this->getChildHtml('where_to_display')
            ]
        );

        return parent::_beforeToHtml();
    }
}
