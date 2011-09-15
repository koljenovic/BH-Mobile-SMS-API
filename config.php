<?php

class Config
{
    private $sid;
    protected $username;
    protected $password;

    public function __construct()
    {
        // Prvo unesite username i password
        $this->username = '';
        $this->password = '';
        // Nakon toga pokrenite install.php koji ce vam generisati sid koji unosite ispod
        $this->sid = '';
    }

    public function isSidSet()
    {
        if($this->sid) {
            return true;
        }
    }

    public function isUserdataSet()
    {
        if($this->username && $this->password) {
            return true;
        }
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSid()
    {
        return $this->sid;
    }
}