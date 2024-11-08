<?php
/**
* Archivo para crear la clase USER
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

class User {
    //declaramos los parámetros de la clase
    private $username;
    private $password;
    private $mail;
    private $logged = false;

    // creamos el constructor
    public function __construct(string $username, string $password, string $mail){
        $this -> username = $username;
        $this -> password = $password;
        $this -> mail = $mail;
    }

    //creamos la funcion mágica __SET y comprobamos que la propiedad existe y no sea LOGGED
    public function __set($property, $value){
        if($property != 'logged'){
            if(isset($this->$property)){
                $this->$property = $value;
            }
        }
    }

     //creamos la funcion mágica __GET y comprobamos que la propiedad existe y no sea LOGGED
    public function __get($property){
        if($property != 'logged'){
            if(isset($this->$property)){
                return $this->$property;
            }
        }
    }

    // creamos la funcion mágica __TOSTRING mostrando el usuario y su email.
    public function __toString():string{
        return $this->Username . ' ('.$this->mail . ' )';
    }

    // creamos un método para cambiar el estado del usuario a LOGGED, devuelve un booleano de control y si está todo correcto, se cambia a TRUE el parámetro LOGGED
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

    // creamos un método para cerrar la sesión del usuario. Comprueba si estaba a TRUE antes y si es asi lo cambia a FALSE
    public function logout(){
        if($this->logged === true){
            $this->logged = false;
        }
    }

    























}
