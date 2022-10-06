<?php
namespace Waqas\FreeShippingBar\Api\Data;

interface EntityInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID                 = 'entity_id';
    const ENTITY_NAME               = 'name';
    const FROM_DATE                 = 'from_date';
    const TO_DATE                   = 'to_date';
    const GOAL                      = 'goal';
    const INITIAL_GOAL_MESSAGE      = 'initial_goal_message';
    const ACHIEVE_GOAL_MESSAGE      = 'achieve_goal_message';
    const IS_CLICKABLE              = 'is_clickable';
    const BAR_LINK_URL              = 'bar_link_url';
    const IS_LINK_OPEN_IN_NEW_PAGE  = 'is_link_open_in_new_page';
    const BAR_BACKGROUND_COLOR      = 'bar_background_color';
    const BAR_TEXT_COLOR            = 'bar_text_color';
    const GOAL_TEXT_COLOR           = 'goal_text_color';
    const BAR_FONT_SIZE             = 'bar_font_size';
    const BAR_LAYOUT_POSITION       = 'bar_layout_position';
    const IS_ACTIVE                 = 'is_active';
    const SORT_ORDER                = 'sort_order';
    const CREATED_AT                = 'created_at';
    const UPDATED_AT                = 'updated_at';

    /**
     * Get bar entity id.
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set bar entity id.
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId);

    /**
     * Get bar entity name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set bar entity name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get the start date when the bar entity is active.
     *
     * @return string|null
     */
    public function getFromDate();

    /**
     * Set the start date when the bar entity is active.
     *
     * @param string $fromDate
     * @return $this
     */
    public function setFromDate($fromDate);

    /**
     * Get the end date when the bar entity is active
     *
     * @return string|null
     */
    public function getToDate();

    /**
     * Set the end date when the bar entity is active.
     *
     * @param string $toDate
     * @return $this
     */
    public function setToDate($toDate);

    /**
     * Get goal value.
     *
     * @return string
     */
    public function getGoal();

    /**
     * Set goal value.
     *
     * @param string $goal
     * @return $this
     */
    public function setGoal($goal);

    /**
     * Get initial goal message.
     *
     * @return string
     */
    public function getInitialGoalMessage();

    /**
     * Set initial goal message.
     *
     * @param string $initialgoalMessage
     * @return $this
     */
    public function setInitialGoalMessage($initialgoalMessage);

    /**
     * Get achieve goal message.
     *
     * @return string
     */
    public function getAchieveGoalMessage();

    /**
     * Set achieve goal message.
     *
     * @param string $achievegoalMessage
     * @return $this
     */
    public function setAchieveGoalMessage($achievegoalMessage);

    /**
     * Whether the bar is clickable.
     *
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function isClickable();

    /**
     * Set whether the bar is clickable.
     *
     * @param bool isClickable
     * @return bool
     */
    public function setIsClickable($isClickable);

    /**
     * Get bar link url.
     *
     * @return string
     */
    public function getBarLinkUrl();

    /**
     * Set bar link url.
     *
     * @param string $barLinkUrl
     * @return $this
     */
    public function setBarLinkUrl($barLinkUrl);

    /**
     * Whether the bar link opens in new page.
     *
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function isLinkOpenInNewPage();

    /**
     * Set whether the bar link opens in new page.
     *
     * @param bool $isLinkOpenInNewPage
     * @return bool
     */
    public function setIsLinkOpenInNewPage($isLinkOpenInNewPage);

    /**
     * Get bar background color.
     *
     * @return string
     */
    public function getBarBackgroundColor();

    /**
     * Set bar background color.
     *
     * @param string $barBackgroundColor
     * @return $this
     */
    public function setBarBackgroundColor($barBackgroundColor);

    /**
     * Get bar background color.
     *
     * @return string
     */
    public function getBarTextColor();

    /**
     * Set bar text color.
     *
     * @param string $barTextColor
     * @return $this
     */
    public function setBarTextColor($barTextColor);

    /**
     * Get goal text color.
     *
     * @return string
     */
    public function getGoalTextColor();

    /**
     * Set goal text color.
     *
     * @param string $goalTextColor
     * @return $this
     */
    public function setGoalTextColor($goalTextColor);

    /**
     * Get bar font size.
     *
     * @return string
     */
    public function getBarFontSize();

    /**
     * Set bar font size.
     *
     * @param string $barFontSize
     * @return $this
     */
    public function setBarFontSizer($barFontSize);

    /**
     * Get bar layout position.
     *
     * @return string
     */
    public function getBarLayoutPosition();

    /**
     * Set bar layout position.
     *
     * @param string $barLayoutPosition
     * @return $this
     */
    public function setBarLayoutPosition($barLayoutPosition);

    /**
     * Whether the bar entity is active.
     *
     * @return bool
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function isActive();

    /**
     * Set whether the bar entity is active.
     *
     * @param bool $isActive
     * @return bool
     */
    public function setIsActive($isActive);

    /**
     * Get sort order.
     *
     * @return int
     */
    public function getSortOrder();

    /**
     * Set sort order.
     *
     * @param int $sortOrder
     * @return $this
     */
    public function setSortOrder($sortOrder);

    /**
     * Get bar entity creation date and time.
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set bar entity creation date and time.
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get bar entity last update date and time.
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set bar entity last update date and time.
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}
