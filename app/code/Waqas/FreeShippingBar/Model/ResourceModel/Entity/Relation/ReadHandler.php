<?php
namespace Waqas\FreeShippingBar\Model\ResourceModel\Entity\Relation;

use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\AttributeInterface;
use Waqas\FreeShippingBar\Model\ResourceModel\Entity;

/**
 * Class ReadHandler
 * @package Waqas\FreeShippingBar\Model\ResourceModel\Entity\Relation
 */
class ReadHandler implements AttributeInterface
{
    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var Entity
     */
    private $resourceEntity;

    /**
     * ReadHandler constructor.
     *
     * @param Entity $resourceEntity
     */
    public function __construct(
        MetadataPool $metadataPool,
        Entity $resourceEntity
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceEntity = $resourceEntity;
    }

    /**
     * Perform action on relation/extension attribute
     *
     * @param object $entity
     * @param array $arguments
     * @return array
     * @throws \Exception
     */
    public function execute($entityType, $entityData, $arguments = [])
    {
        $linkField = $this->metadataPool->getMetadata($entityType)->getLinkField();
        $entityId = $entityData[$linkField];

        $entityData['store_id'] = $this->resourceEntity->lookupStoreIds($entityId);
        $entityData['customer_group_id'] = $this->resourceEntity->lookupCustomerGroupIds($entityId);

        return $entityData;
    }
}
