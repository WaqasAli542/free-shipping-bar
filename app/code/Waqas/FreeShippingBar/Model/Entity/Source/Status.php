<?php
namespace Waqas\FreeShippingBar\Model\Entity\Source;

/**
 * Class Status
 * @package Waqas\FreeShippingBar\Model\Entity\Source
 */
class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 0;

    /**
     * @var \Waqas\FreeShippingBar\Model\Entity
     */
    protected $entity;

    /**
     * IsActive constructor.
     *
     * @param \Waqas\FreeShippingBar\Model\Entity $entity
     */
    public function __construct(
        \Waqas\FreeShippingBar\Model\Entity $entity
    ) {
        $this->entity = $entity;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach (self::getOptionArray() as $index => $value) {
            $options[] = ['value' => $index, 'label' => $value];
        }
        return $options;
    }

    /**
     * Retrieve option array
     *
     * @return array
     */
    public function getOptionArray()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
