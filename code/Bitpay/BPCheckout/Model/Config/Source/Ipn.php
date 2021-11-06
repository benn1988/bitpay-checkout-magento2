<?php

namespace Bitpay\BPCheckout\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * IPN Model
 */
class Ipn implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        return [
            'pending' => 'Pending',
            'processing' => 'Processing',
        ];
    }
}
