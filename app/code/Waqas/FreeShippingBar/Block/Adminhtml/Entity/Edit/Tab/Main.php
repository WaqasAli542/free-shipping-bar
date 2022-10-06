<?php

namespace Waqas\FreeShippingBar\Block\Adminhtml\Entity\Edit\Tab;

use Waqas\FreeShippingBar\Controller\Adminhtml\Entity;

class Main extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magento\Customer\Ui\Component\Listing\Column\Group\Options
     */
    private $_customerGroup;

    /**
     * Main constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \Magento\Customer\Ui\Component\Listing\Column\Group\Options $customerGroup
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Customer\Ui\Component\Listing\Column\Group\Options $customerGroup,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_systemStore = $systemStore;
        $this->_customerGroup = $customerGroup;
    }

    /**
     * Set form id prefix, declare fields for shipping bar info.
     *
     * @return \Magento\Backend\Block\Widget\Form\Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );
        $form->setHtmlIdPrefix('waqas_free_shipping_bar_entity_');
        $model = $this->_coreRegistry->registry(Entity::REGISTRY_KEY_CURRENT_ENTITY);
        $this->_addGeneralFieldset($form, $model);
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @param \Magento\Framework\Data\Form $form
     * @param $model
     */
    protected function _addGeneralFieldset(\Magento\Framework\Data\Form $form, $model)
    {
        $fieldset = $form->addFieldset('general_fieldset', ['legend' => __('Shipping Bar Information')]);
        $isElementDisabled = !$this->_isAllowedAction(Entity::ADMIN_RESOURCE);

        if ($model->getEntityId()) {
            $fieldset->addField(
                'entity_id',
                'hidden',
                [
                    'name' => 'entity_id'
                ]
            );
        } else {
            if (!$model->hasData('is_active')) {
                $model->setData('is_active', $isElementDisabled ? '0' : '1');
                $model->setIsActive(1);
            }
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'label' => __('Name'),
                'title' => __('Name'),
                'name' => 'name',
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' =>__('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')],
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'sort_order',
            'text',
            [
                'label' => __('Priority'),
                'title' => __('Priority'),
                'name' => 'sort_order',
                'class' => 'validate-number',
                'disabled' => $isElementDisabled
            ]
        );
        if (!$this->_storeManager->hasSingleStore()) {
            $field = $fieldset->addField(
                'store_id',
                'multiselect',
                [
                    'label' => __('Store Views'),
                    'title' => __('Store Views'),
                    'name' => 'store_id',
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true),
                    'disabled' => $isElementDisabled
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                \Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element::class
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'store_id',
                'hidden',
                ['name' => 'store_id', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
        }

        $fieldset->addField(
            'customer_group_id',
            'multiselect',
            [
                'label' => __('Customer Groups'),
                'title' => __('Customer Groups'),
                'name' => 'customer_group_id',
                'required' => true,
                'values' => $this->_customerGroup->toOptionArray(),
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'from_date',
            'date',
            [
                'label' => __('From Date'),
                'title' => __('From Date'),
                'name' => 'from_date',
                'required' => true,
                'date_format' => 'yyyy-MM-dd',
                'class' => 'validate-date validate-date-range date-range-attribute-from',
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'to_date',
            'date',
            [
                'label' => __('To Date'),
                'title' => __('To Date'),
                'name' => 'to_date',
                'date_format' => 'yyyy-MM-dd',
                'class' => 'validate-date validate-date-range date-range-attribute-to',
                'disabled' => $isElementDisabled
            ]
        );
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
