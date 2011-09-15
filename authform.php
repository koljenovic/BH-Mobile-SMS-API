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
    protected $cookieJar;

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
        $this->baseUrl = 'http://sso.bhmobile.ba';
        $this->actionUrl = '/sso/login';
        $this->fields = array(new Field('application', ''),
                              new Field('url', 'http://www.bhmobile.ba/'),
                              new Field('realm', 'sso'),
                              new Field('userid', $userid),
                              new Field('password', $pass));
    }

    protected function configCurl()
    {
        $config = array(CURLOPT_URL => $this->baseUrl . $this->actionUrl,
                        CURLINFO_HEADER_OUT => TRUE,
                        CURLOPT_USERAGENT => '',
                        CURLOPT_FOLLOWLOCATION => FALSE,
                        CURLOPT_NOBODY => TRUE,
                        CURLOPT_HEADER => TRUE,
                        CURLOPT_RETURNTRANSFER => TRUE,
                        CURLOPT_POST => TRUE,
                        CURLOPT_POSTFIELDS => $this->getPostfields());
        curl_setopt_array($this->curlHandle, $config);
    }

    public function dispatch()
    {
        $this->curlHandle = curl_init();
        $this->configCurl();
        $header = curl_exec($this->curlHandle);
        $this->cookieJar = new CookieJar($header);
        return $this;
    }
}
