<?php

namespace Expert\FbShare\Observer;

use Magento\Checkout\Model\Session;

class ClearSession implements \Magento\Framework\Event\ObserverInterface
{
    private $checkoutSession;

    public function __construct(
        Session $checkoutSession
    ) {
        $this->checkoutSession = $checkoutSession;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->checkoutSession->setFbShare([]);
        return $this;
    }
}
