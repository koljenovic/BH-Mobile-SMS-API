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
        /* od ranije stranice
        $this->baseUrl = 'http://www.bhmobile.ba';
        $this->actionUrl = '/portal/show?idc=1023422&subtype=web2sms_arhiva';
        $this->fields = array(new Field('primatelj', $sendTo),
                              new Field('tekst_poruke', $message),
                              new Field('action', 'send_sms_submit'));*/
        $this->baseUrl = 'http://www.bhmobile.bhtelecom.ba';
        $this->actionUrl = '/posalji-poruku?views=kreirajPoruku';
        // Treba vidjeti koja su ključna polja ... 
                              
                              
                              
    }

    protected function configCurl()
    {
        $config = array(CURLOPT_URL => $this->baseUrl . $this->actionUrl,
                        CURLOPT_USERAGENT => '',
                        CURLOPT_NOBODY => TRUE,
                        CURLOPT_RETURNTRANSFER => TRUE,
                        CURLOPT_COOKIE => 'ticket=' . $this->config->getSid(),
                        CURLOPT_POST => TRUE,
                        CURLOPT_POSTFIELDS => $this->getPostfields());
        curl_setopt_array($this->curlHandle, $config);
    }

    public function dispatch()
    {
        $this->curlHandle = curl_init();
        $this->configCurl();
        return curl_exec($this->curlHandle);
    }
}
