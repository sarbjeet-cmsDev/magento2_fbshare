<?php
namespace Expert\FbShare\Model\Config;

class DiscountType implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('OneTime')],
            ['value' => 1, 'label' => __('Limited')],
            ['value' => 2, 'label' => __('Unlimited')]
        ];
    }
}
