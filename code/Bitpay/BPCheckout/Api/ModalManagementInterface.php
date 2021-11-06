<?php

declare(strict_types=1);

namespace Bitpay\BPCheckout\Api;

interface ModalManagementInterface
{
    /**
     * POST for modal api
     *
     * @return string
     */
    public function postModal();
}
