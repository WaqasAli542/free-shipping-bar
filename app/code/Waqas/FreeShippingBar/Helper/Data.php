<?php
namespace Waqas\FreeShippingBar\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Waqas\FreeShippingBar\Model\EntityFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Http\Context as HttpContext;

class Data extends AbstractHelper
{
    /**
     * @var EntityFactory
     */
    private $entityFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CustomerSession
     */
    private $customerSession;

    /**
     * @var HttpContext
     */
    private $httpContext;

    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * Data constructor.
     * @param Context $context
     * @param EntityFactory $entityFactory
     * @param StoreManagerInterface $storeManager
     * @param CustomerSession $customerSession
     * @param HttpContext $httpContext
     * @param \Magento\Framework\App\ResourceConnection $resourceConnection
     */
    public function __construct(
        Context $context,
        EntityFactory $entityFactory,
        StoreManagerInterface $storeManager,
        CustomerSession $customerSession,
        HttpContext $httpContext,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        parent::__construct($context);
        $this->entityFactory = $entityFactory;
        $this->storeManager =  $storeManager;
        $this->customerSession = $customerSession;
        $this->httpContext = $httpContext;
        $this->_resource = $resourceConnection;
    }

    /**
     * Retrieve config value.
     *
     * @return string
     */
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue($config, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve shipping bar collection.
     *
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getShippingBarCollection($entityId = null)
    {
        $barEntity = $this->entityFactory->create();
        $collection = $barEntity->getCollection();
        if ($entityId) {
            $freeShippingBarStoreTable = $this->_resource->getTableName('Waqas_free_shipping_bar_store');
            $freeShippingBarCustomerGroupTable = $this->_resource->getTableName('Waqas_free_shipping_bar_customer_group');

            $collection
                ->join(
                    ['st'=>$freeShippingBarStoreTable],
                    "main_table.entity_id = st.entity_id"
                )
                ->join(
                    ['ct' => $freeShippingBarCustomerGroupTable],
                    "main_table.entity_id = ct.entity_id"
                )
                ->addFieldToFilter('main_table.entity_id', ['eq' => $entityId])
                ->addFieldToFilter('main_table.from_date', ['lteq' => date("Y-m-d")])
                ->addFieldToFilter('main_table.to_date', [['null' => true],['gteq' => date("Y-m-d")]])
                ->addFieldToFilter('main_table.is_active', ['eq' => 1]);
        } else {
            $collection->addFieldToFilter('from_date', ['lteq' => date("Y-m-d")])
                ->addFieldToFilter('to_date', [['null' => true],['gteq' => date("Y-m-d")]])
                ->addFieldToFilter('is_active', ['eq' => 1])
                ->setOrder('sort_order', 'ASC');
        }
        return $collection;
    }

    /**
     * Retrieve shipping bar data.
     *
     * @return array|false
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getShippingBar()
    {
        $collection = $this->getShippingBarCollection();
        if ($collection->getData()) {
            foreach ($collection as $barItem) {
                if ($this->isStoreMatched($barItem['store_id']) &&
                    $this->isCustomerGroupMatched($barItem['customer_group_id'])) {
                    return $barItem->getData();
                }
            }
        }
        return false;
    }

    /**
     * Retrieve shipping bar goal.
     *
     * @return string|false
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getShippingGoal()
    {
        $barData = $this->getShippingBar();
        if ($barData) {
            return $barData['goal'];
        }
        return false;
    }

    /**
     * Retrieve shipping bar data by entity id.
     *
     * @param $entityId
     * @return array|false
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getShippingBarByEntityId($entityId)
    {
        $collection = $this->getShippingBarCollection($entityId)->getData();
        $collectionArray = [];

        if ($collection) {
            foreach ($collection as $barItem) {
                foreach ($barItem as $barKeyItem => $barValItem) {
                    if ($barKeyItem == 'store_id') {
                        if (!isset($collectionArray['store_id']) || !in_array($barValItem, $collectionArray['store_id'])) {
                            $collectionArray['store_id'][] = $barValItem;
                        }
                    } elseif ($barKeyItem == 'customer_group_id') {
                        if (!isset($collectionArray['customer_group_id']) || !in_array($barValItem, $collectionArray['customer_group_id'])) {
                            $collectionArray['customer_group_id'][] = $barValItem;
                        }
                    } else {
                        $collectionArray[$barKeyItem] = $barValItem;
                    }
                }
            }
        }

        if ($collectionArray) {
            if ($this->isStoreMatched($collectionArray['store_id']) &&
                $this->isCustomerGroupMatched($collectionArray['customer_group_id'])) {
                return $collectionArray;
            }
        }
        return false;
    }

    /**
     * Check if given store id(s) include current store id.
     *
     * @param $storeId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function isStoreMatched($storeId)
    {
        $currentStoreId =  $this->storeManager->getStore()->getId();
        if (in_array(0, $storeId) || in_array($currentStoreId, $storeId)) {
            return true;
        }
        return false;
    }

    /**
     *  Check if given customer group id(s) include current customer group id.
     *
     * @param $customerGroupId
     * @return bool
     */
    public function isCustomerGroupMatched($customerGroupId)
    {
        $isLoggedIn = $this->customerSession->isLoggedIn() ? $this->customerSession->isLoggedIn() : $this->isLoggedIn();
        $currentCustomerGroupId = $isLoggedIn ? $this->customerSession->getCustomer()->getGroupId() : 0;
        if (in_array($currentCustomerGroupId, $customerGroupId)) {
            return true;
        }
        return false;
    }

    /**
     * Check if customer logged in.
     *
     * @return bool
     */
    public function isLoggedIn()
    {
        return (bool)$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
    }
}
