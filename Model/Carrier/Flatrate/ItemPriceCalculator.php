<?php

namespace Meetanshi\Flatshipping\Model\Carrier\Flatrate;

use Magento\Quote\Model\Quote\Address\RateRequest;

/**
 * Class ItemPriceCalculator
 *
 * Calculator for shipping price per item/order
 */
class ItemPriceCalculator
{
    /**
     * Get shipping price per item
     *
     * @param RateRequest $request
     * @param int|float $basePrice
     * @param int $freeBoxes
     * @return float
     */
    public function getShippingPricePerItem(RateRequest $request, $basePrice, $freeBoxes)
    {
        return $request->getPackageQty() * $basePrice - $freeBoxes * $basePrice;
    }

    /**
     * Get shipping price per order
     *
     * @param RateRequest $request
     * @param int|float $basePrice
     * @param int $freeBoxes
     * @return float
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getShippingPricePerOrder(RateRequest $request, $basePrice, $freeBoxes)
    {
        return $basePrice;
    }
}
