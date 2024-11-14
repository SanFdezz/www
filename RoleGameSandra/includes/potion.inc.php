<?php
/**
* 
* Archivo donde se crea la clase Potion que se usa en la clase Héroe del programa 
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

// creamos la clase
class potion {
    //declaramos atributos
    private $health;

    // creamos el constructor
    public function __construct(int $health){
        $this->health = $health;
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
        return 'Salud: '.$this->health;
    }

}
