<?php

namespace Bitpay\BPCheckout\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Ux Model
 */
class Ux implements OptionSourceInterface
{
    /**
     * @inheritdoc
     */
    public function toOptionArray(): array
    {
        return [
            'redirect' => 'Redirect',
            'modal' => 'Modal',
        ];
    }
}
