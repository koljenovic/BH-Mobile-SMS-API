<?php

require_once 'field.php';
require_once 'authform.php';
require_once 'formabstract.php';
require_once 'config.php';

class MessageForm extends FormAbstract
{
    protected $baseUrl;
    protected $actionUrl;
    protected $curlHandle;
    protected $authHandle;
    protected $fields;
    protected $config;

    public function __construct($sendTo, $message)
    {
        $this->config = new Config;
        if(!$this->config->isSidSet()) {
            throw new Exception('API not configured, please run install.php first.');
        }
        $this->baseUrl = 'https://bhmobile.bhtelecom.ba';
        $this->actionUrl = '/kams-mobileAppService/stanje-racuna/poruka/posalji?primalac=' . urlencode($sendTo) . '&test=' . urlencode($message);
        $this->fields = array();
    }

    protected function configCurl()
    {
        $config = array(CURLOPT_URL => $this->baseUrl . $this->actionUrl,
                        CURLOPT_USERAGENT => '',
                        CURLOPT_NOBODY => TRUE,
                        CURLOPT_RETURNTRANSFER => TRUE,
                        CURLOPT_HEADER => TRUE);
        $headers = array(
            'Authorization: Bearer ' . $this->config->getSid()
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