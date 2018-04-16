<?php
namespace Expert\FbShare\Model\Total\Quote;

use \Magento\Checkout\Model\Session;

class Discount extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    public $helper;
    private $checkoutSession;

    /**
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Expert\FbShare\Helper\Data $helper
     */
    public function __construct(
        Session $checkoutSession,
        \Expert\FbShare\Helper\Data $helper
    ) {
        $this->helper = $helper;
        $this->checkoutSession = $checkoutSession;
    }

    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        $this->setCode('fbdiscount');
        parent::collect($quote, $shippingAssignment, $total);

        $fbshare = $this->checkoutSession->getFbShare();

        if (is_array($fbshare)) {
            $items = $shippingAssignment->getItems();
            if (empty($items)) {
                return $this;
            }

            $fbdiscount = 0;
            $discount_rate = $this->helper->getConfig('discount_rate');

            foreach ($items as $item) {
                if (in_array($item->getProductId(), $fbshare['product'])) {
                    $itemdiscount = $item->getBaseRowTotal() * $discount_rate / 100;
                    $fbdiscount += $itemdiscount;
                    $item->setFbdiscount($itemdiscount);
                } else {
                    $item->setFbdiscount(0);
                }
            }
            if ($fbdiscount > 0) {
                $total->addTotalAmount('fbdiscount', -$fbdiscount);
                $total->addBaseTotalAmount('fbdiscount', -$fbdiscount);
                $total->setBaseGrandTotal($total->getBaseGrandTotal() - $fbdiscount);
                $quote->setFbdiscount($fbdiscount);
                $quote->setFbuserid($fbshare['userId']);
            }
        }
        return $this;
    }
    public function fetch(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        return [
            'code' => 'fbdiscount',
            'title' => $this->helper->getConfig('discount_title'),
            'value' => 10
        ];
    }
}
