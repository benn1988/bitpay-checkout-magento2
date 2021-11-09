<?php
 
namespace Bitpay\BPCheckout\Observer;
 
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * payment_method_is_active event handler.
 */
class BPPaymentMethodAvailable implements ObserverInterface
{
    const XML_PATH_BITPAY_ENDPOINT = 'payment/bpcheckout/bitpay_endpoint';
    const XML_PATH_BITPAY_DEVTOKEN = 'payment/bpcheckout/bitpay_devtoken';
    const XML_PATH_BITPAY_PRODTOKEN = 'payment/bpcheckout/bitpay_prodtoken';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * BPPaymentMethodAvailable constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Retrieve store config value by path
     *
     * @param string $path The path through the tree of configuration values, e.g., 'general/store_information/name'
     * @return mixed
     */
    private function getStoreConfig(string $path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @inheritdoc
     */
    public function execute(Observer $observer): void
    {
        if ($observer->getEvent()->getMethodInstance()->getCode() === 'bpcheckout') {
            $bitpayEndpoint = $this->getStoreConfig(self::XML_PATH_BITPAY_ENDPOINT);

            $bitpayToken = $bitpayEndpoint === 'prod'
                ? $this->getStoreConfig(self::XML_PATH_BITPAY_PRODTOKEN)
                : $this->getStoreConfig(self::XML_PATH_BITPAY_DEVTOKEN);

            if ($bitpayToken === '') {
                #hide the payment method
                $checkResult = $observer->getEvent()->getResult();
                $checkResult->setData('is_available', false); //this is disabling the payment method at checkout page
            }
        }
    }
}
