<?php

namespace Expert\FbShare\Model\ResourceModel\Order\Item;

class Collection extends \Magento\Sales\Model\ResourceModel\Order\Item\Collection
{
    public function addFacebookDiscountFilter($p, $u)
    {
        $mt = 'main_table';
        $where = "o.status != 'canceled' AND $mt.fbdiscount > 0 AND $mt.product_id = $p AND o.fbuserid = '$u'";
        $on = 'main_table.order_id = o.entity_id';
        $this->getSelect()->joinLeft(['o'=> 'sales_order'], $on, ['o.fbuserid','o.status'], [])->where($where);
        return $this;
    }
}
