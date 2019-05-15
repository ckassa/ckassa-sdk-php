<?php
namespace Ckassa\Model;

/**
 * Сертификат
 *
 * @package Ckassa\Model
 *
 * @property string $path Путь до файла сертификата
 * @property string $password Пароль
 * @property string $name Имя сертификата
 * @property array $certInfo Информация о сертификате
 */
class Certificate
{
    /**
     * @var string Путь до файла сертификата
     */
    public $path;

    /**
     * @var string Пароль
     */
    public $password;

    /**
     * @var string Имя сертификата
     */
    public $name;

    /**
     * @var array Информация о сертификате
     */
    public $certInfo;

    /**
     * Certificate constructor.
     * @param $certPath
     * @param $certPassword
     */
    public function __construct($certPath, $certPassword)
    {
        $this->path = $certPath;
        $this->password = $certPassword;
        if (file_exists($this->path) === false) {
            throw new \Exception('Certificate file doesn\'t exist');
        }

        $this->certInfo = openssl_x509_parse('file://' . $certPath);

        if (!$this->certInfo) {
            throw new \Exception("Couldn't load certificate info");
        }
        $this->name = $this->certInfo['name'] ? $this->certInfo['name'] : '';
    }
}