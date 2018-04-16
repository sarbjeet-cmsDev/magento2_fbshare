<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Expert\FbShare\Block\Sales;

/**
 * @api
 * @since 100.0.2
 */
class Fbdiscount extends \Magento\Framework\View\Element\Template
{
    
    private $order;
    private $source;
    private $helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Expert\FbShare\Helper\Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }
    public function getSource()
    {
        return $this->source;
    }
    public function getStore()
    {
        return $this ->order->getStore();
    }
    public function getOrder()
    {
        return $this->order;
    }
    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->order = $parent->getOrder();
        $this->source = $parent->getSource();

        $fbdiscount = new \Magento\Framework\DataObject([
            'code' => 'fbdiscount',
            'strong' => false,
            'value' => $this->order->getFbdiscount(),
            'label' =>__($this->helper->getTitle()),
        ]);

        $parent->addTotal($fbdiscount, 'fbdiscount');
        return $this;
    }
}
