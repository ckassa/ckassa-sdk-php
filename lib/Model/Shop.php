<?php
namespace Ckassa\Model;

use Ckassa\Exceptions\ApiException;
use Ckassa\Exceptions\ConnectionException;

/**
 * Базовые операции с API
 *
 * @property string $key Секретный ключ
 * @property string $token  Токен организации
 * @property Certificate $certificate Сертификат
 *
 * @package Ckassa
 */
class Shop
{
    /**
     * @var string Секретный ключ
     */
    protected $key;

    /**
     * @var string Токен организации
     */
    protected $token;

    /**
     * @var Certificate Сертификат для подписи
     */
    protected $certificate;

    /**
     * Shop constructor.
     * @param $key
     * @param $token
     * @param $certPath
     * @param $certPassword
     */
    public function __construct($key, $token, $certPath, $certPassword)
    {
        $this->key = $key;
        $this->token = $token;
        $this->certificate = new Certificate($certPath, $certPassword);
    }

    /**
     * Подготовка массива данных для формирования подписи
     * @param array $data
     *
     * @return string
     */
    public function getSignString(array $data) {
        $result = [];
        array_walk_recursive($data, function ($entry) use (&$result) {
            $result[] = $entry;
        });
        return implode('&', $result);
    }

    /**
     * Формирование подписи к запросу
     * @param array $data
     * @return string
     */
    public function getSign(array $data)
    {
        return strtoupper(md5(strtoupper(md5($this->getSignString($data) . '&' . $this->token . '&' . $this->key))));
    }

    /**
     * Отправка POST запроса к серверу ShopAPI
     * @param string $path
     * @param array $data
     * @return array
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
        $response = new Response(curl_exec($ch));

        $info = curl_getinfo($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new ConnectionException($error);
        }

        if ((int) $info['http_code'] != 200) {
            throw new ApiException($response->getBody(), $info['http_code']);
        }

        if ($code = $response->getCode())
        {
            throw new ApiException($response->getUserMessage(), $code);
        }

        if (empty($response->getBody())) {
            throw new ConnectionException('API вернул неверный ответ');
        }

        return json_decode($response->getBody(), true);
    }
}