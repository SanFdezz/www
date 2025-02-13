<?php
/**
* 
* Archivo donde se crea la clase Héroe del programa 
*
* @author Sandra Fernández Ávila
* @version 3.0 
*
*/


// incluimos los archivos de las clases armadura, armas y pociones.
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/armor.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/potion.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/weapon.inc.php');

// creamos la clase
class Hero{
    // declaramos los atributos:
    private $name;
    private $species;
    private $class;
    private $health;
    private $weapons = [];
    private $potions = [];    
    private $armor;
    private $baseAttack;
    private $baseDefense;

    // creamos el constructor
    public function __construct(string $name, string $species, string $class, int $health=50, int $baseAttack=10, int $baseDefense=10){
        $this->name = $name;
        if(self::checkSpecies($species)){
            $this->species = $species;
        } else {
            $this->species = 'humano';
        }

        if($this->checkClass($class)){
            $this->class = $class;
        } else {
            $this->class = 'ninguna';
        }
        
        $this->health = $health;
        $this->baseAttack = $baseAttack;
        $this->baseDefense = $baseDefense;
    }

    //comprobamos si la especie que ha escrito el usuario existe
    private function checkSpecies(string $species):bool{
        $existentSpecies = ['Altmer','Argoniano','Bosmer','Bretón','Dunmer','Guardia rojo','Imperial','Khajiita','Nórdico','Orsimer'];
        foreach($existentSpecies as $specie){
            if($specie === $species){
                return true;
            }
        }
        return false;
    }

    //comprobamos si la clase que ha escrito el usuario existe
    private function checkClass(string $class):bool{
        $existentClasses = ['Agente','Arquero','Asesino','Bárbaro','Brujo','Caballero','Guerrero','Ladrón','Mago','Monje'];
        foreach($existentClasses as $aClass){
            if($aClass === $class){
                return true;
            }
        }
        return false;
    }

    // funcion set que compruebe tambien que no sean ni armas ni pociones y que las clases y especies sean las indicadas.
    public function __set(string $property, string $value){
        if(isset($this->$property)){
            // comprobamos que no sea ni el array de armas, ni el array de pociones.
            if($this->$property != 'weapons' && $this->$property != 'potions'){
                 // comprobacion de qur la especie o la clase existe previamente.
                if($this->$property == 'species'){
                    if(self::checkSpecies($property)){
                        $this->$property = $value;
                    } else {
                        $this->$property = 'humano';
                    }
                } else if($this->$property == 'class'){
                    if(self::checkClass($property)){
                        $this->$property = $value;
                    } else {
                        $this->$property = 'ninguna';
                    }
                }else{
                    $this->$property = $value;
                }
            }
        }
    }

    // funcion get.
    public function __get(string $property){
        if(isset($this->$property)){
            return $this->$property;
        }
    }

    // toString que devuelve el nombre, especie, clase y vida del héroe
    public function __toString(){
        return 'Nombre: '.$this->name .'|| Especie: '. $this->species . '|| Clase: '. $this->class . '|| Salud: '. $this->health;
    }


    // funcion que sirve para añadir al inventario del personaje una o varias armas.
    public function addWeapon(Weapon $weapon):bool{
        $numberOfWeapons = count($this->weapons);
        if($numberOfWeapons >= 2){
            return false;
        } else {
            $this->weapons[] = $weapon;
            return true;
        }
    }

    // funcion que nos permite eliminar un arma del inventario si ya no la queremos
    public function removeWeapon(Weapon $weapon): bool{
        if(count($this->weapons)>0){
            foreach ($this->weapons as $key => $thisWeapon) {
                if ($thisWeapon === $weapon) {
                    unset($this->weapons[$key]);
                    return true;
                }
            }
        } return false;
    }

    // funcion que sirve para añadir al inventario del personaje una o varias pociones.
    public function addPotion(Potion $potion):bool{
        if(count($this->potions) >= 3){
            return false;
        } else {
            $this->potions[] = $potion;
            return true;
        }
    }

    // funcion que nos permite eliminar una poción del inventario si ya no la queremos
    public function removePotion(Potion $potion): bool{
        if(count($this->potions)>0){
            foreach ($this->potions as $key => $thisPotion) {
                if ($thisPotion === $potion) {
                    unset($this->potions[$key]);
                    return true;
                }
            }
        } return false;
    }

    // funcion que sirve para añadirle al heroe una armadura.
    public function addArmor(Armor $armor):bool{
        if(empty($this->armor)){
            $this->armor = $armor;
            return true;
        } else {
            return false;
        }
    }

    // funcion que nos permite eliminar una armadura si ya no la queremos
    public function removeArmor():bool{
        if(!empty($this->armor)){
            $this->armor = null;
            return true;
        } else {
            return false;
        }
    }


    // esta funcion suma el total de puntos de daño que hacen tus armas más el bonus de ataque que tiene de por si el personaje
    public function attack():int{
        $attackValue=0;
        foreach($this->weapons as $key => $weapon){
            $attackValue += $weapon->__get('attack');
        }
        return $attackValue + $this->baseAttack;
    }

    // funcion que nos permite defendernos restandole la defensa al daño inflingido y luego relacionarlo con la salud para que surja efecto
    public function defense(int $damage):int{
        $defenseValue = $this->armor->defense+ $this->baseDefense;
        if(($damage - $defenseValue) > 0){
            $this->health -= ($damage-$defenseValue); 
            return $damage - $defenseValue;
        } else {
            return 0;
        }
    }

    // funcion para usar las pociones que selecciona la que mayor cura realiza del inventario y la usa eliminandose del mismo.
    public function usePotion(){
        $bestPotion=0;
        for($i=0; $i<count($this->potions); $i++){
            if($this->potions[$i]->health > $bestPotion ){
                $bestPotion = $this->potions[$i]->health;
            }
        }
        $this->health += $bestPotion;
        foreach($this->potions as $key => $potion){
            if($potion->health === $bestPotion){
                unset($this->potions[$key]);
            }
        }
    }

}
