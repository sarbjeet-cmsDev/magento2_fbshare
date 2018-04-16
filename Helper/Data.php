<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Expert\FbShare\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_ENABLED = 'fbshare/general/enabled';
    const XML_PATH_DISCOUNT_TITLE = 'fbshare/general/discount_title';
    const XML_PATH_FB_APPID = 'fbshare/general/fb_app_id';
    const XML_PATH_DISCOUNT_RATE = 'fbshare/product_share/discount_rate';
    const XML_PATH_DISCOUNT_MSG = 'fbshare/product_share/discount_msg';
    const XML_PATH_DISCOUNT_USES = 'fbshare/product_share/discount_uses';
    const XML_PATH_DISCOUNT_TYPE = 'fbshare/product_share/discount_type';
    /**
     * Check if enabled
     *
     * @return number|null
     */
    public function isEnabled()
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    public function getTitle()
    {
        return $this->getConfig('discount_title');
    }
    public function getConfig($field)
    {
        $path = null;
        switch ($field) {
            case 'discount_title':
                $path = self::XML_PATH_DISCOUNT_TITLE;
                break;
            case 'fb_app_id':
                $path = self::XML_PATH_FB_APPID;
                break;
            case 'discount_rate':
                $path = self::XML_PATH_DISCOUNT_RATE;
                break;
            case 'discount_msg':
                $path = self::XML_PATH_DISCOUNT_MSG;
                break;
            case 'discount_uses':
                $path = self::XML_PATH_DISCOUNT_USES;
                break;
            case 'discount_type':
                $path = self::XML_PATH_DISCOUNT_TYPE;
                break;
        }
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
