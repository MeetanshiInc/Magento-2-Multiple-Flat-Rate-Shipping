<?php
namespace Meetanshi\Flatshipping\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Flatrate implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => '', 'label' => __('None')],
            ['value' => 'O', 'label' => __('Per Order')],
            ['value' => 'I', 'label' => __('Per Item')]
        ];
    }
}
