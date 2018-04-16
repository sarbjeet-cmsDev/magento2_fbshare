<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Expert\FbShare\Model\Order\Invoice\Total;

class Discount extends \Magento\Sales\Model\Order\Invoice\Total\AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {
        $fbdiscount = $invoice->getOrder()->getFbdiscount();
        if ($fbdiscount) {
            $invoice->setGrandTotal($invoice->getGrandTotal() - $fbdiscount);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() - $fbdiscount);
        }
        return $this;
    }
}
