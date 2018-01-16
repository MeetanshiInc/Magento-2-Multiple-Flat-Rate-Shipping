<?php
namespace Meetanshi\Flatshipping\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class HandlingType implements ArrayInterface
{
    const HANDLING_TYPE_PERCENT = 'P';
    const HANDLING_TYPE_FIXED = 'F';
    const HANDLING_TYPE_FIXED_ITEM = 'FI';
    
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
