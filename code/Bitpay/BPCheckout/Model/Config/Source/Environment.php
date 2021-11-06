<?php

namespace Bitpay\BPCheckout\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Environment Model
 */
class Environment implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        return [
            'test' => 'Test',
            'prod' => 'Production',
        ];
    }
}
