<?php
namespace Ckassa\Model;

use Ckassa\Exceptions\ApiException;
use Ckassa\Exceptions\ConnectionException;

/**
 * Class Shop
 * @package Ckassa
 * @param $certificate Certificate
 */
class Shop
{
    protected $key;
    protected $token;
    protected $certificate;

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
     * @param string $path
     * @param array $data
     * @return mixed
     */
    public function sendRequest($path, array $data = [])
    {
        $data = array_merge($data, ['shopToken' => $this->token, 'sign' => $this->getSign($data)]);

        $ch = curl_init($path);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, ["Content-Type:application/json","dn: {$this->certificate->name}"]);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch, CURLOPT_SSLCERT, $this->certificate->path);
        curl_setopt( $ch, CURLOPT_SSLCERTPASSWD, $this->certificate->password);
        curl_setopt( $ch, CURLOPT_SSLKEY, $this->certificate->path);
        curl_setopt( $ch, CURLOPT_SSLKEYPASSWD, $this->certificate->password);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $response = new Response(curl_exec($ch));
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new ConnectionException($error);
        }

        if ($code = $response->getCode())
        {
            throw new ApiException($response->getUserMessage(), $code);
        }

        return json_decode($response->getBody(), true);
    }
}