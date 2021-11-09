<?php

declare(strict_types=1);

namespace Bitpay\BPCheckout\Observer;

use Exception;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\ResourceModel\Order as OrderResource;
use Psr\Log\LoggerInterface;

/**
 * sales_order_place_after event handler.
 */
class BPEmail implements ObserverInterface
{
    /**
     * @var OrderResource
     */
    private $orderResource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * BPEmail constructor
     *
     * @param OrderResource $orderResource
     * @param LoggerInterface $logger
     */
    public function __construct(
        OrderResource $orderResource,
        LoggerInterface $logger
    ) {
        $this->orderResource = $orderResource;
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @throws Exception
     */
    public function execute(Observer $observer): void
    {
        try {
            /** @var Order $order */
            $order = $observer->getEvent()->getOrder();
            $paymentCode = $order->getPayment()->getMethodInstance()->getCode();
            if ($paymentCode === 'bpcheckout') {
                $this->stopNewOrderEmail($order);
            }
        } catch (Exception $e) {
            $this->logger->error($e);
        }
    }

    /**
     * @param Order $order
     * @throws Exception
     */
    public function stopNewOrderEmail(Order $order): void
    {
        $order->setCanSendNewEmailFlag(false);
        $order->setSendEmail(false);
        try {
            $this->orderResource->save($order);
        } catch (Exception $e) {
            $this->logger->error($e);
        }
    }
}
