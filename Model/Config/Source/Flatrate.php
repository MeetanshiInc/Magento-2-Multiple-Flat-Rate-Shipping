<?php

namespace Meetanshi\Flatshipping\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Flatrate
 *
 * Source model for flat rate type options
 */
class Flatrate implements OptionSourceInterface
{
    /**
     * Get option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '', 'label' => __('None')],
            ['value' => 'O', 'label' => __('Per Order')],
            ['value' => 'I', 'label' => __('Per Item')]
        ];
    }
}
