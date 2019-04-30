<?php
namespace Ckassa;

use Ckassa\Model\Certificate;

/**
 * Class Shop
 * @package Ckassa
 * @param $certificate Certificate
 */
class Shop
{
    private $key;
    private $token;
    private $url;
    private $certificate;

    public function __construct($key, $token, $certPath, $certPassword)
    {
        $this->key = $key;
        $this->token = $token;
        $this->certificate = new Certificate($certPath, $certPassword);
    }

    /**
     * Формирование подписи к запросу
     * @param array $data
     * @return string
     */
    private function getSign(array $data)
    {
        return strtoupper(md5(strtoupper(md5(implode('&', $data) . '&' . $this->token . '&' . $this->key))));
    }

    /**
     * Отправка POST запроса к серверу ShopAPI
     * @param string $method
     * @param array $data
     * @return mixed
     */
    protected function sendRequest(string $method, array $data = [])
    {
        $data = array_merge($data, ['shopToken' => $this->token, 'sign' => $this->getSign(isset($data['shop']) ? $data['shop'] : $data)]);

        $ch = curl_init($this->url . $method);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, ["Content-Type:application/json","dn: {$this->certificate->name}"]);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch, CURLOPT_SSLCERT, $this->certificate->path);
        curl_setopt( $ch, CURLOPT_SSLCERTPASSWD, $this->certificate->password);
        curl_setopt( $ch, CURLOPT_SSLKEY, $this->certificate->path);
        curl_setopt( $ch, CURLOPT_SSLKEYPASSWD, $this->certificate->password);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
}