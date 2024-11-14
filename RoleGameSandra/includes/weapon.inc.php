<?php
/**
* 
* Archivo donde se crea la clase Weapon que se usa en la clase Héroe del programa 
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

// creamos la clase
class weapon {
    //declaramos atributos
    private $name;
    private $attack;

    // creamos el constructor
    public function __construct(string $name, int $attack){
        $this->name = $name;
        $this->attack = $attack;
    }

    // y creamos los métodos mágicos __get(), __set() y __toString()

    public function __get(string $property){
        if(isset($this->$property)){
            return $this->$property;
        }
    }

    public function __set(string $property, string $value){
        if(isset($this->$property)){
            $this->$property = $value;
        }
    }

    public function __toString(){
        return 'Nombre del arma: '.$this->name.'! Valor del ataque: '.$this->attack;
    }

}