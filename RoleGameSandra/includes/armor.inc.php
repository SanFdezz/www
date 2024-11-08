<?php
/**
* 
* Archivo donde se crea la clase Armor que se usa en la clase Héroe del programa 
*
* @author Sandra Fernández Ávila
* @version 1.0 
*
*/

class armor {
    private $name;
    private $defense;


    public function __construct(string $name, int $defense){
        $this->name = $name;
        $this->defense = $defense;
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
        return 'Nombre armadura: '.$this->name.'! Valor defensa: '.$this->defense;
    }

}
