<?php
namespace Ckassa;

class TestMerchantShop extends MerchantShop
{
    public function __construct($key, $token, $certPath, $certPassword)
    {
        parent::__construct($key, $token, $certPath, $certPassword);
        $this->baseUrl = 'https://demo-api.ckassa.ru/api-shop';
        $this->url = 'https://demo-api.ckassa.ru/api-shop/rs/merchant';
    }
}