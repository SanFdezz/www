<?php
/**
* 
* Archivo donde se crea la clase Potion que se usa en la clase Héroe del programa 
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

class potion {
    private $health;


    public function __construct(int $health){
        $this->health = $health;
    }

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
