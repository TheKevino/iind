<?php

class Email{
    
    private $Host;
    private $SMTPAuth;
    private $Username;
    private $Password;
    private $SMTPSecure;
    private $Port;

    public function __construct(){
        $this->Host = "smtp-mail.outlook.com";
        $this->SMTPAuth = true;
        $this->Username = "deptoiind@outlook.com";
        $this->Password = "Industrial2022";
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