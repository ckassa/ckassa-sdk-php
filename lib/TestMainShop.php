<?php
namespace Ckassa;

class TestMainShop extends MainShop
{
    public function __construct($key, $token, $certPath, $certPassword)
    {
        $this->baseUrl = 'https://demo-api.ckassa.ru/api-shop';
        parent::__construct($key, $token, $certPath, $certPassword);
    }
}