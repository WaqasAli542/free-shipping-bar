<?php
namespace Waqas\FreeShippingBar\Model\ResourceModel\Entity;

use Waqas\FreeShippingBar\Api\Data\EntityInterface;

/**
 * Class Collection
 * @package Waqas\FreeShippingBar\Model\ResourceModel\Entity
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Primary field
     *
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @var \Magento\Framework\EntityManager\MetadataPool
     */
    protected $metadataPool;

    /**
     * @var \Waqas\FreeShippingBar\Model\ResourceModel\Entity
     */
    private $resourceEntity;

    /**
     * Collection constructor.
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Framework\EntityManager\MetadataPool $metadataPool
     * @param \Waqas\FreeShippingBar\Model\ResourceModel\Entity $resourceEntity
     * @param \Magento\Framework\DB\Adapter\AdapterInterface|null $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb|null $resource
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\EntityManager\MetadataPool $metadataPool,
        \Waqas\FreeShippingBar\Model\ResourceModel\Entity $resourceEntity,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceEntity = $resourceEntity;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    /**
     * Define model and resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Waqas\FreeShippingBar\Model\Entity::class,
            \Waqas\FreeShippingBar\Model\ResourceModel\Entity::class
        );
    }

    /**
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     * @throws \Exception
     */
    protected function _afterLoad()
    {
        $entityMetadata = $this->metadataPool->getMetadata(EntityInterface::class);
        $this->performAfterLoad($entityMetadata->getLinkField(), 'store');
        $this->performAfterLoad($entityMetadata->getLinkField(), 'customer_group');
        return parent::_afterLoad();
    }

    /**
     * Perform operations after collection load
     *
     * @param string $tableName
     * @param string|null $linkField
     * @return Collection
     * @throws \Exception
     */
    protected function performAfterLoad($linkField, $entityType)
    {
        $linkedFieldIds = $this->getColumnValues($linkField);
        if (count($linkedFieldIds)) {
            $result = $this->resourceEntity->getAssociatedEntityIds($linkedFieldIds, $entityType, 1);
            if ($result) {
                $entityId = $entityType.'_id';
                $storesData = [];
                foreach ($result as $storeData) {
                    $storesData[$storeData[$linkField]][] = $storeData[$entityId];
                }
                foreach ($this as $item) {
                    $linkedFieldId = $item->getData($linkField);
                    if (!isset($storesData[$linkedFieldId])) {
                        continue;
                    }
                    $item->setData($entityId, $storesData[$linkedFieldId]);
                }
            }
        }
        return $this;
    }
}
