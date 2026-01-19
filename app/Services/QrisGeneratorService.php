<?php

namespace App\Services;

class QrisGeneratorService
{
    public function generateQrisString($orderId)
    {
        // contoh format QR fake
        return "QRIS-ORDER-" . $orderId . "-" . uniqid();
    }
}
