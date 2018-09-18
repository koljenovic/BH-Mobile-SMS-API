<?php

require_once 'field.php';
require_once 'cookiejar.php';
require_once 'formabstract.php';
require_once 'config.php';

class AuthForm extends FormAbstract
{
    protected $curlHandle;
    protected $baseUrl;
    protected $actionUrl;
    protected $fields;
    protected $auth;

    /**
     * @var CookieJar
     */
    protected $cookieJar;

    /**
     * @return CookieJar
     */
    public function getCookieJar()
    {
        return $this->cookieJar;
    }

    public function __construct($userid = null, $pass = null)
    {
        if(!isset($userid) && !isset($pass)) {
            $config = new Config;
            $userid = $config->getUsername();
            $pass = $config->getPassword();
        }
        $this->auth = base64_encode("$userid:$pass");
        $this->baseUrl = 'https://bhmobile.bhtelecom.ba';
        $this->actionUrl = '/kams-mobileAppService/stanje-racuna/prijava/login';
    }

    protected function configCurl()
    {
        $config = array(CURLOPT_URL => $this->baseUrl . $this->actionUrl,
                        CURLOPT_FOLLOWLOCATION => FALSE,
                        CURLOPT_RETURNTRANSFER => TRUE,
                        CURLOPT_POST => FALSE);

        $headers = array(
            'Authorization: Basic ' . $this->auth
        );

        curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt_array($this->curlHandle, $config);
    }

    public function dispatch()
    {
        $this->curlHandle = curl_init();
        $this->configCurl();
        return curl_exec($this->curlHandle);
    }
}
