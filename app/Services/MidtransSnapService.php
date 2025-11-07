<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransSnapService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Membuat snap token dari parameter transaksi
     *
     * @param array $params
     * @return string
     */
    public function createSnapToken(array $params): string
    {
        return Snap::getSnapToken($params);
    }
}
