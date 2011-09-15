<?php

class CookieJar
{
    protected $cookieJar;

    public function __construct($header = null)
    {
        $this->cookieJar = array();
        if($header) {
            $this->setCookies($header);
        }
        return $this;
    }

    public function setCookies($header)
    {
        $tmp = array();
        preg_match_all('%(?<=Set-Cookie:\s).*?;%im', $header, $tmp);
        foreach($tmp[0] as $tmp_cookie) {
            $split = explode('=', $tmp_cookie);
            $this->cookieJar[$split[0]] = rtrim($split[1], ';');
        }
        return $this;
    }

    public function getCookies()
    {
        return $this->cookieJar;
    }

    public function getCookie($name)
    {
        return isset($this->cookieJar[$name]) ? $this->cookieJar[$name] : NULL;
    }

    public function cookiesToString()
    {
        if($this->cookieJar) {
            $result = '';
            foreach($this->cookieJar as $name => $value) {
                $result .= $name . '=' . $value . ';';
            }
            return $result;
        } else {
            return null;
        }
    }
}