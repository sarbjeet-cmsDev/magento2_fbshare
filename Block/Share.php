<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Expert\FbShare\Block;

class Share extends \Magento\Catalog\Block\Product\AbstractProduct
{
    private $helper;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Expert\FbShare\Helper\Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }
    /**
     * @return string
     */
    public function getFbAppID()
    {
        return $this->helper->getConfig('fb_app_id');
    }

    /**
     * @return string
     */
    public function getDiscountMessage()
    {
        return $this->helper->getConfig('discount_msg');
    }
    /**
     * @return string
     */
    public function _toHtml()
    {
        if ($this->helper->isEnabled()) {
            return parent::_toHtml();
        }
        return '';
    }
}
