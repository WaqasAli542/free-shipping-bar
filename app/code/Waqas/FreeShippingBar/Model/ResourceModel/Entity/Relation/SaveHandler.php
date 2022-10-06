<?php
namespace Waqas\FreeShippingBar\Model\ResourceModel\Entity\Relation;

use Magento\Framework\EntityManager\Operation\AttributeInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Waqas\FreeShippingBar\Model\ResourceModel\Entity;

/**
 * Class SaveHandler
 * @package Waqas\FreeShippingBar\Model\ResourceModel\Entity\Relation
 */
class SaveHandler implements AttributeInterface
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
        if (isset($entityData['store_id'])) {
            $storeIds = $entityData['store_id'];
            if (!is_array($storeIds)) {
                $storeIds = explode(',', (string)$storeIds);
            }
            $this->resourceEntity->bindBarToEntity($entityData[$linkField], $storeIds, 'store');
        }

        if (isset($entityData['customer_group_id'])) {
            $customerGroupIds = $entityData['customer_group_id'];
            if (!is_array($customerGroupIds)) {
                $customerGroupIds = explode(',', (string)$customerGroupIds);
            }
            $this->resourceEntity->bindBarToEntity($entityData[$linkField], $customerGroupIds, 'customer_group');
        }
        return $entityData;
    }
}
