<?php

namespace App\Http\Controllers;
use Digikraaft\PaystackWebhooks\Http\Controllers\WebhooksController as PaystackWebhooksController;
use Illuminate\Http\Request;

class WebhookController extends PaystackWebhooksController
{
    public function handleChargeSuccess($payload)
    {
        \Log::info(json_encode($payload));
        switch($payload){
            case  "transfer.success":
            case "transfer.failed":
            case "transfer.reversed":
            case "charge.success":
            case "invoice.create":
            case "invoice.payment_failed":
            case "invoice.update":
        }
    }
}
