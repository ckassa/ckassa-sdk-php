<?php
namespace Ckassa;

class MerchantShop extends Shop
{
    private $url = 'https://api.autopays.ru/api-shop/rs/merchant/';

    public function registerMerchant()
    {
        $path = $this->url . '/registration/merchant';
        $data = [];
        $this->sendRequest($path, $data);
    }
}