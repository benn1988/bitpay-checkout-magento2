<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
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
