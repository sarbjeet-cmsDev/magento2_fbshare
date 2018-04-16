<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Expert\FbShare\Plugin;

use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Quote\Model\Quote\Item\ToOrderItem;
use Magento\Quote\Model\Quote\Item\AbstractItem;

class QuoteItem
{
    public function afterConvert(
        ToOrderItem $subject,
        OrderItemInterface $orderItem,
        AbstractItem $item,
        $additional = []
    ) {
        $orderItem->setFbdiscount($item->getFbdiscount());
        return $orderItem;
    }
}
