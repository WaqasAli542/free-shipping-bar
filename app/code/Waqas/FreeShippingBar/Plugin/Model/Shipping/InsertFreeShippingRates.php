<?php
namespace Waqas\FreeShippingBar\Plugin\Model\Shipping;

/**
 * Class InsertFreeShippingRates
 * @package Waqas\FreeShippingBar\Plugin\Model\Shipping
 */
class InsertFreeShippingRates
{
    /**
     * @var \Waqas\FreeShippingBar\Helper\Data
     */
    private $barDataHelper;

    /**
     * InsertFreeShippingRates constructor.
     *
     * @param \Magento\Checkout\Model\Cart $cart
     * @param \Waqas\FreeShippingBar\Helper\Data $barDataHelper
     */
    public function __construct(
        \Magento\Checkout\Model\Cart $cart,
        \Waqas\FreeShippingBar\Helper\Data $barDataHelper
    ) {
        $this->cart = $cart;
        $this->barDataHelper = $barDataHelper;
    }

    /**
     * Collect and get rates
     *
     * @param \Magento\Shipping\Model\Carrier\AbstractCarrierInterface $subject
     * @param $result
     * @return \Magento\Framework\DataObject|bool|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterCollectRates(\Magento\Shipping\Model\Shipping $subject, $result)
    {
        $isModuleEnable = $this->barDataHelper->getConfig('Waqas_free_shipping_bar/general/enable');
        if ($isModuleEnable) {
            $subTotal = $this->cart->getQuote()->getSubtotal();
            $freeShippingGoal = (float)$this->barDataHelper->getShippingGoal();
            if ($freeShippingGoal) {
                if ($subTotal >= $freeShippingGoal) {
                    $rates = $subject->getResult()->getAllRates();
                    foreach ($rates as $rate) {
                        if ($rate->hasData('price') && $rate->hasData('cost')) {
                            $rate->setData('price', 0);
                            $rate->setData('cost', 0);
                        }
                    }
                }
            }
        }
        return $result;
    }
}
