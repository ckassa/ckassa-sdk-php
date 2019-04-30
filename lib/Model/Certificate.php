<?php
namespace Ckassa\Model;

/**
 * Class Certificate
 * @package Ckassa\Model
 *
 * @property string $path
 * @property string $password
 * @property string $name
 * @property array $certInfo
 */
class Certificate
{
    public $path;
    public $password;
    public $name;
    public $certInfo;

    public function __construct($certPath, $certPassword)
    {
        $this->path = $certPath;
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