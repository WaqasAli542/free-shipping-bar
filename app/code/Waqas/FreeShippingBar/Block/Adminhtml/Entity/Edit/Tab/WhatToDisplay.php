<?php
namespace Waqas\FreeShippingBar\Block\Adminhtml\Entity\Edit\Tab;

use Waqas\FreeShippingBar\Controller\Adminhtml\Entity;

class WhatToDisplay extends \Magento\Backend\Block\Widget\Form\Generic
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
        $this->_addWhatToDisplayFieldset($form, $model);
        $this->_addDesignTemplateFieldset($form, $model);
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @param \Magento\Framework\Data\Form $form
     * @param $model
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _addWhatToDisplayFieldset(\Magento\Framework\Data\Form $form, $model)
    {
        $fieldset = $form->addFieldset('what_to_display_fieldset', ['legend' => __('What to Display')]);
        $isElementDisabled = !$this->_isAllowedAction(Entity::ADMIN_RESOURCE);

        if (!$model->getEntityId()) {
            if (!$model->hasData('initial_goal_message')) {
                $model->setInitialGoalMessage('Get free shipping on order over {{goal}}.');
            }
            if (!$model->hasData('achieve_goal_message')) {
                $model->setAchieveGoalMessage('Congrats! you have got free shipping.');
            }
        }

        $fieldset->addField(
            'goal',
            'text',
            [
                'label' => __('Free Shipping Goal'),
                'title' => __('Free Shipping Goal'),
                'name' => 'goal',
                'required' => true,
                'class' => 'validate-number',
                'disabled' => $isElementDisabled,
                'note' => __('Enter the free shipping threshold. Buyers whose orders reach this amount will get free shipping.')
            ]
        );

        $fieldset->addField(
            'initial_goal_message',
            'text',
            [
                'label' => __('Initial Goal Message'),
                'title' => __('Initial Goal Message'),
                'name' => 'initial_goal_message',
                'required' => true,
                'disabled' => $isElementDisabled,
                'note' => __('Enter the initial message when buyer\'s cart sub-total haven\'t reach the goal.')
            ]
        );

        $fieldset->addField(
            'achieve_goal_message',
            'text',
            [
                'label' => __('Achieve Goal Message'),
                'title' => __('Achieve Goal Message'),
                'name' => 'achieve_goal_message',
                'required' => true,
                'disabled' => $isElementDisabled,
                'note' => __('Enter the congratulation message when buyers\' cart sub-total reach the goal.')
            ]
        );

        $fieldset->addField(
            'is_clickable',
            'select',
            [
                'label' => __('Clickable'),
                'title' => __('Clickable'),
                'name' => 'is_clickable',
                'options' => ['1' => __('Yes'), '0' => __('No')],
                'disabled' => $isElementDisabled,
                'note' => __('If Yes, the bar can be clicked to link and redirect to specified url.')
            ]
        );

        $fieldset->addField(
            'bar_link_url',
            'text',
            [
                'label' => __('Link URL'),
                'title' => __('Link URL'),
                'name' => 'bar_link_url',
                'required' => true,
                'class' => 'validate-url',
                'disabled' => $isElementDisabled,
                'note' => __('Add link to redirect free shipping bar.')
            ]
        );

        $fieldset->addField(
            'is_link_open_in_new_page',
            'select',
            [
                'label' => __('Open in New Page'),
                'title' => __('Open in New Page'),
                'name' => 'is_link_open_in_new_page',
                'options' => ['1' => __('Yes'), '0' => __('No')],
                'disabled' => $isElementDisabled,
                'note' => __('Select Yes to open the link in a new tab.')
            ]
        );

        $this->setChild(
            'form_after',
            $this->getLayout()->createBlock(\Magento\Backend\Block\Widget\Form\Element\Dependence::class)
                ->addFieldMap("Waqas_free_shipping_bar_entity_is_clickable", 'is_clickable')
                ->addFieldMap("Waqas_free_shipping_bar_entity_bar_link_url", 'bar_link_url')
                ->addFieldMap("Waqas_free_shipping_bar_entity_is_link_open_in_new_page", 'is_link_open_in_new_page')
                ->addFieldDependence('bar_link_url', 'is_clickable', 1)
                ->addFieldDependence('is_link_open_in_new_page', 'is_clickable', 1)
        );
    }

    /**
     * @param \Magento\Framework\Data\Form $form
     * @param $model
     */
    protected function _addDesignTemplateFieldset(\Magento\Framework\Data\Form $form, $model)
    {
        $fieldset = $form->addFieldset('design_template_fieldset', ['legend' => __('Design Template')]);
        $isElementDisabled = !$this->_isAllowedAction(Entity::ADMIN_RESOURCE);

        if (!$model->getEntityId()) {
            if (!$model->hasData('bar_background_color')) {
                $model->setBarBackgroundColor('#1979C3');
            }
            if (!$model->hasData('bar_text_color')) {
                $model->setBarTextColor('#FFFFFF');
            }
            if (!$model->hasData('goal_text_color')) {
                $model->setGoalTextColor('#FFFFFF');
            }
            if (!$model->hasData('bar_font_size')) {
                $model->setBarFontSize(14);
            }
        }

        $fieldset->addField(
            'bar_background_color',
            'text',
            [
                 'label' => __('Bar Background Color'),
                 'title' => __('Bar Background Color'),
                 'name' => 'bar_background_color',
                 'required' => true,
                 'class' => 'jscolor {hash:true}',
                 'disabled' => $isElementDisabled
             ]
        );

        $fieldset->addField(
            'bar_text_color',
            'text',
            [
                'label' => __('Bar Text Color'),
                'title' => __('Bar Text Color'),
                'name' => 'bar_text_color',
                'required' => true,
                'class' => 'jscolor {hash:true}',
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'goal_text_color',
            'text',
            [
                'label' => __('Goal Text Color'),
                'title' => __('Goal Text Color'),
                'name' => 'goal_text_color',
                'required' => true,
                'class' => 'jscolor {hash:true}',
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'bar_font_size',
            'text',
            [
                'label' => __('Font Size'),
                'title' => __('Font Size'),
                'name' => 'bar_font_size',
                'required' => true,
                'class' => 'validate-number validate-greater-than-zero',
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
        $html .= $this->setTemplate('Waqas_FreeShippingBar::form/preview-shipping-bar.phtml')->toHtml();
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
     * @return array
     */
    public function getGoalMessages()
    {
        $model = $this->getCurrentBar();
        $goalMessages = [
            'initial-message' => $model->getInitialGoalMessage(),
            'achieve-message' =>$model->getAchieveGoalMessage()
        ];
        return $goalMessages;
    }
}
