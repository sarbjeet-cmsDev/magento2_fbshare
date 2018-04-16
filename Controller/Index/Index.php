<?php

namespace Expert\FbShare\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Checkout\Model\Session;

class Index extends \Magento\Framework\App\Action\Action
{
    private $jsonResultFactory;
    private $helper;
    private $checkoutSession;
    private $resourceConnection;
    private $itemCollectionFactory;
 
    public function __construct(
        Context $context,
        \Expert\FbShare\Helper\Data $helper,
        Session $checkoutSession,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Expert\FbShare\Model\ResourceModel\Order\Item\CollectionFactory $itemCollectionFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->checkoutSession = $checkoutSession;
        $this->resourceConnection = $resourceConnection;
        $this->helper = $helper;
        parent::__construct($context);
    }
 
    public function execute()
    {
        if (!$this->isPostRequest()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        $result = $this->jsonResultFactory->create();
        try {
            $this->validatedParams();
            $data = $this->getRequest()->getParams();

            $discounttype = $this->helper->getConfig('discount_type');

            if ($discounttype != 2) {
                $product_id = $data['product_id'];
                $userId = $data['userId'];

                $itemcollection = $this->itemCollectionFactory->create();
                $itemcollection->addFieldToSelect('*');
                $itemcollection->addFacebookDiscountFilter($product_id, $userId);

                $discountOrder = $itemcollection->getSize();

                $discount_uses = $this->helper->getConfig('discount_uses');

                if ($discounttype == 0 && $discountOrder > 0) {
                    throw new LocalizedException(__('Sorry! You already Got Discount on this prodict'));
                } elseif ($discounttype == 1 && $discountOrder >= $discount_uses) {
                    throw new LocalizedException(__('Sorry! You already Got Discount on this prodict'));
                }
            }

            $fbshare = $this->checkoutSession->getFbShare();
            if (!is_array($fbshare)) {
                $fbshare = [];
            }
            
            $fbshare['product'][] = $data['product_id'];
            $fbshare['userId'] = $data['userId'];
            $fbshare['product'] = array_unique(array_filter($fbshare['product']));

            $this->checkoutSession->setFbShare($fbshare);

            $this->messageManager->addSuccess(
                __(
                    'Congrats! Discount is applied to checkout!'
                )
            );

            $result->setData(['error'=>'NO']);
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
            $result->setHttpResponseCode(\Magento\Framework\Webapi\Exception::HTTP_FORBIDDEN);
            $result->setData(['error' => $e->getMessage()]);
        }
        return $result;
    }
    private function isPostRequest()
    {
        /** @var Request $request */
        $request = $this->getRequest();
        return !empty($request->getPostValue());
    }
    private function validatedParams()
    {
        $request = $this->getRequest();
        $product_id = $request->getParam('product_id');
        if (isset($product_id) && trim($request->getParam('product_id')) === '') {
            throw new LocalizedException(__('Product Id is missing'));
        }
        if (trim($request->getParam('userId')) === '') {
            throw new LocalizedException(__('userId is missing'));
        }
        return $request->getParams();
    }
}
