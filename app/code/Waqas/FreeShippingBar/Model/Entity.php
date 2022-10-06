<?php
namespace Waqas\FreeShippingBar\Model;

use Waqas\FreeShippingBar\Api\Data\EntityInterface;
use Magento\Framework\DataObject\IdentityInterface;

/**
 * Class Entity
 * @package Waqas\FreeProducts\Model
 */
class Entity extends \Magento\Framework\Model\AbstractModel implements EntityInterface, IdentityInterface
{
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'Waqas_free_shipping_bar_entity';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'Waqas_free_shipping_bar_entity';

    /**
     * Parameter name in event
     *
     * In observe method you can use $observer->getEvent()->getEntity() in this case
     *
     * @var string
     */
    protected $_eventObject = 'entity';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Waqas\FreeShippingBar\Model\ResourceModel\Entity::class);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get entity id.
     *
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set entity id.
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get entity name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::ENTITY_NAME);
    }

    /**
     * Set entity name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::ENTITY_NAME, $name);
    }

    /**
     * Get the start date when the entity is active.
     *
     * @return string|null
     */
    public function getFromDate()
    {
        return $this->getData(self::FROM_DATE);
    }

    /**
     * Set the start date when the entity is active.
     *
     * @param string $fromDate
     * @return $this
     */
    public function setFromDate($fromDate)
    {
        return $this->setData(self::FROM_DATE, $fromDate);
    }

    /**
     * Get the end date when the entity is active
     *
     * @return string|null
     */
    public function getToDate()
    {
        return $this->getData(self::TO_DATE);
    }

    /**
     * Set the end date when the entity is active.
     *
     * @param string $toDate
     * @return $this
     */
    public function setToDate($toDate)
    {
        return $this->setData(self::TO_DATE, $toDate);
    }

    /**
     * Whether the entity is active.
     *
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function isActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set whether the entity is active.
     *
     * @param bool $isActive
     * @return Entity
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get sort order.
     *
     * @return int
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

    /**
     * Set sort order.
     *
     * @param int $sortOrder
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }

    /**
     * Get entity creation date and time.
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set entity creation date and time.
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get entity last update date and time.
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set entity last update date and time.
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get goal value.
     *
     * @return string
     */
    public function getGoal()
    {
        return $this->getData(self::GOAL);
    }

    /**
     * Set goal value.
     *
     * @param string $goal
     * @return $this
     */
    public function setGoal($goal)
    {
        return $this->setData(self::GOAL, $goal);
    }

    /**
     * Get initial goal message.
     *
     * @return string
     */
    public function getInitialGoalMessage()
    {
        return $this->getData(self::INITIAL_GOAL_MESSAGE);
    }

    /**
     * Set initial goal message.
     *
     * @param string $initialgoalMessage
     * @return $this
     */
    public function setInitialGoalMessage($initialgoalMessage)
    {
        return $this->setData(self::INITIAL_GOAL_MESSAGE, $initialgoalMessage);
    }

    /**
     * Get achieve goal message.
     *
     * @return string
     */
    public function getAchieveGoalMessage()
    {
        return $this->getData(self::ACHIEVE_GOAL_MESSAGE);
    }

    /**
     * Set achieve goal message.
     *
     * @param string $achievegoalMessage
     * @return $this
     */
    public function setAchieveGoalMessage($achievegoalMessage)
    {
        return $this->setData(self::ACHIEVE_GOAL_MESSAGE, $achievegoalMessage);
    }

    /**
     * Whether the bar is clickable.
     *
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function isClickable()
    {
        return $this->getData(self::IS_CLICKABLE);
    }

    /**
     * Set whether the bar is clickable.
     *
     * @param bool isClickable
     * @return Entity
     */
    public function setIsClickable($isClickable)
    {
        return $this->setData(self::IS_CLICKABLE, $isClickable);
    }

    /**
     * Get bar link url.
     *
     * @return string
     */
    public function getBarLinkUrl()
    {
        return $this->getData(self::BAR_LINK_URL);
    }

    /**
     * Set bar link url.
     *
     * @param string $barLinkUrl
     * @return $this
     */
    public function setBarLinkUrl($barLinkUrl)
    {
        return $this->setData(self::BAR_LINK_URL, $barLinkUrl);
    }

    /**
     * Whether the bar link opens in new page.
     *
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function isLinkOpenInNewPage()
    {
        return $this->getData(self::IS_LINK_OPEN_IN_NEW_PAGE);
    }

    /**
     * Set whether the bar link opens in new page.
     *
     * @param bool $isLinkOpenInNewPage
     * @return Entity
     */
    public function setIsLinkOpenInNewPage($isLinkOpenInNewPage)
    {
        return $this->setData(self::IS_LINK_OPEN_IN_NEW_PAGE, $isLinkOpenInNewPage);
    }

    /**
     * Get bar background color.
     *
     * @return string
     */
    public function getBarBackgroundColor()
    {
        return $this->getData(self::BAR_BACKGROUND_COLOR);
    }

    /**
     * Set bar background color.
     *
     * @param string $barBackgroundColor
     * @return $this
     */
    public function setBarBackgroundColor($barBackgroundColor)
    {
        return $this->setData(self::BAR_BACKGROUND_COLOR, $barBackgroundColor);
    }

    /**
     * Get bar background color.
     *
     * @return string
     */
    public function getBarTextColor()
    {
        return $this->getData(self::BAR_TEXT_COLOR);
    }

    /**
     * Set bar text color.
     *
     * @param string $barTextColor
     * @return $this
     */
    public function setBarTextColor($barTextColor)
    {
        return $this->setData(self::BAR_TEXT_COLOR, $barTextColor);
    }

    /**
     * Get goal text color.
     *
     * @return string
     */
    public function getGoalTextColor()
    {
        return $this->getData(self::GOAL_TEXT_COLOR);
    }

    /**
     * Set goal text color.
     *
     * @param string $goalTextColor
     * @return $this
     */
    public function setGoalTextColor($goalTextColor)
    {
        return $this->setData(self::GOAL_TEXT_COLOR, $goalTextColor);
    }

    /**
     * Get bar font size.
     *
     * @return string
     */
    public function getBarFontSize()
    {
        return $this->getData(self::BAR_FONT_SIZE);
    }

    /**
     * Set bar font size.
     *
     * @param string $barFontSize
     * @return $this
     */
    public function setBarFontSizer($barFontSize)
    {
        return $this->setData(self::BAR_FONT_SIZE, $barFontSize);
    }

    /**
     * Get bar layout position.
     *
     * @return string
     */
    public function getBarLayoutPosition()
    {
        return $this->getData(self::BAR_LAYOUT_POSITION);
    }

    /**
     * Set bar layout position.
     *
     * @param string $barLayoutPosition
     * @return $this
     */
    public function setBarLayoutPosition($barLayoutPosition)
    {
        return $this->setData(self::BAR_LAYOUT_POSITION, $barLayoutPosition);
    }
}
