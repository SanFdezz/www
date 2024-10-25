<?php
/**
* Archivo para crear la clase USER
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

class User {
    private $username;
    private $password;
    private $mail;
    private $logged = false;

    public function __construct(string $username, string $password, string $mail){
        $this -> username = $username;
        $this -> password = $password;
        $this -> mail = $mail;
    }

    public function __set($property, $value){
        if($property != 'logged'){
            if(isset($this->$property)){
                $this->$property = $value;
            }
        }
    }

    public function __get($property){
        if($property != 'logged'){
            if(isset($this->$property)){
                return $this->$property;
            }
        }
    }

    public function __toString(){
        return $this->Username . ' ('.$this->mail . ' )';
    }

    public function login(string $givenPassword){
        if($this->logged === true){
            return false;
        }

        if($givenPassword == $this->password){
            $this->logged = true;
            return true;
        } else {
            return false;
        }

    }

    public function logout(){
        if($this->logged === true){
            $this->logged = false;
        }
    }

    























}
