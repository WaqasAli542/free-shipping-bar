<?php
namespace Waqas\FreeShippingBar\Controller\Adminhtml;

/**
 * Class Entity
 * @package Waqas\FreeShippingBar\Controller\Adminhtml
 */
abstract class Entity extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Waqas_FreeShippingBar::free_shipping_bar_management';

    /**
     * Current free shipping bar entity
     */
    const REGISTRY_KEY_CURRENT_ENTITY = 'current_Waqas_free_shipping_bar_entity';

    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var \Waqas\FreeShippingBar\Model\EntityFactory
     */
    protected $entityFactory;

    /**
     * Entity constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Waqas\FreeShippingBar\Model\EntityFactory $entityFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Waqas\FreeShippingBar\Model\EntityFactory $entityFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->entityFactory = $entityFactory;
    }

    /**
     * Init action.
     *
     * @return $this
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Magento_Backend::marketing')
            ->_addBreadcrumb(__('Waqas Free Shipping Bar'), __('Waqas Free Shipping Bar'));
        return $this;
    }
}
