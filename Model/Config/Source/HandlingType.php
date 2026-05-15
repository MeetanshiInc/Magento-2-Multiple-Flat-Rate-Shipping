<?php

namespace Meetanshi\Flatshipping\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class HandlingType
 *
 * Source model for handling type options
 */
class HandlingType implements OptionSourceInterface
{
    public const HANDLING_TYPE_PERCENT = 'P';
    public const HANDLING_TYPE_FIXED = 'F';
    public const HANDLING_TYPE_FIXED_ITEM = 'FI';

    /**
     * Get option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => self::HANDLING_TYPE_FIXED,
                'label' => __('Fixed'),
            ],
            [
                'value' => self::HANDLING_TYPE_PERCENT,
                'label' => __('Percent')
            ],
            [
                'value' => self::HANDLING_TYPE_FIXED_ITEM,
                'label' => __('Fixed Per Item'),
            ]
        ];
    }
}
