<?php

namespace Bitpay\BPCheckout\Model\Config\Source\Order\Status;

use Magento\Sales\Model\Order;
use Magento\Sales\Model\Config\Source\Order\Status;

/**
 * Order Status source model
 */
class PendingPayment extends Status
{
    /**
     * @var string[]
     */
    protected $_stateStatuses = [
        Order::STATE_NEW,
        Order::STATE_PROCESSING,
        Order::STATE_PAYMENT_REVIEW,
        Order::STATE_HOLDED,
    ];
}
