<?php
declare(strict_types=1);
namespace Waqas\Popup\ViewModel;

use Waqas\Popup\Model\ConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class PopUpConfig implements ArgumentInterface
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * Get Config value
     *
     * @return ConfigInterface
     */
    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}
