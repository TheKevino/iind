<?php

class Email{
    
    private $Host;
    private $SMTPAuth;
    private $Username;
    private $Password;
    private $SMTPSecure;
    private $Port;

    public function __construct(){
        $this->Host = "smtp.hostinger.com";
        $this->SMTPAuth = true;
        $this->Username = "deptoindustrial@iind.online";
        $this->Password = "Bonelessbbq1ndustrial$";
        $this->SMTPSecure = "STARTTLS";
        $this->Port = 587;
    }

    public function getHost(){
        return $this->Host;
    }

    public function getAuth(){
        return $this->SMTPAuth;
    }

    public function getUserName(){
        return $this->Username;
    }

    public function getPassword(){
        return $this->Password;
    }

    public function getSecure(){
        return $this->SMTPSecure;
    }

    public function getPort(){
        return $this->Port;
    }


}

?>