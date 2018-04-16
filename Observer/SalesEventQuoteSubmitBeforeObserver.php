<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Expert\FbShare\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Gift Message Observer Model
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SalesEventQuoteSubmitBeforeObserver implements ObserverInterface
{
    /**
     * Set gift messages to order from quote address
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $observer->getEvent()->getOrder()->setFbdiscount($observer->getEvent()->getQuote()->getFbdiscount());
        $observer->getEvent()->getOrder()->setFbuserid($observer->getEvent()->getQuote()->getFbuserid());

        return $this;
    }
}
