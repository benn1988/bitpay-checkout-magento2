<?php

namespace Bitpay\BPCheckout\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Refund Status Model
 */
class Refundstatus implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 'closed', 'label' => __('True')],
            ['value' => 'ignore', 'label' => __('False')]
        ];
    }
}
