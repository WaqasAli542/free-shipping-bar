<?php
namespace Waqas\FreeShippingBar\Block\Adminhtml\Entity\Edit\Tab;

use Waqas\FreeShippingBar\Controller\Adminhtml\Entity;

class WhereToDisplay extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @return \Magento\Backend\Block\Widget\Form\Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );
        $form->setHtmlIdPrefix('Waqas_free_shipping_bar_entity_');
        $model = $this->getCurrentBar();
        $this->_addWhereToDisplayFieldset($form);
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @param \Magento\Framework\Data\Form $form
     */
    protected function _addWhereToDisplayFieldset(\Magento\Framework\Data\Form $form)
    {
        $fieldset = $form->addFieldset('where_to_display_fieldset', ['legend' => __('Where to display')]);
        $isElementDisabled = !$this->_isAllowedAction(Entity::ADMIN_RESOURCE);
        $fieldset->addField(
            'bar_layout_position',
            'select',
            [
                'label' => __('Layout Position'),
                'title' => __('Layout Position'),
                'name' => 'bar_layout_position',
                'required' => true,
                'options' => [
                    'page_top' => __('Page Top'),
                    'page_bottom' => __('Page Bottom'),
                    'insert_snippet' => __('Insert Snippet')
                ],
                'disabled' => $isElementDisabled
            ]
        );
    }

    /**
     * Prepare form Html. call the phtml file with form.
     *
     * @return string
     */
    public function getFormHtml()
    {
        $html = parent::getFormHtml();
        $html .= $this->setTemplate('Waqas_FreeShippingBar::form/snippet_code.phtml')->toHtml();
        return $html;
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

    /**
     * Get current shipping bar entity.
     *
     * @return array|null
     */
    public function getCurrentBar()
    {
        return $this->_coreRegistry->registry(Entity::REGISTRY_KEY_CURRENT_ENTITY);
    }

    /**
     * @return bool
     */
    public function getEntityId()
    {
        $model = $this->getCurrentBar();
        if ($model->getEntityId()) {
            return $model->getEntityId();
        }
        return false;
    }
}
