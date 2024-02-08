<?php
class Persona {

    private $nombre;
    private $apellido1;
    private $apellido2;
    private $fechaNacimiento;
    
    public function __construct($nombre, $apellido1, $apellido2, $fechaNacimiento) {
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getNombre(){
        return $this->nombre;
    }
    function setApellido1($apellido1){
        $this->apellido1 = $apellido1;
    }

    function getApellido1(){
        return $this->apellido1;
    }
    function setApellido2($apellido2){
        $this->apellido2 = $apellido2;
    }

    function getApellido2(){
        return $this->apellido2;
    }

    function setFechaNacimiento($fechaNacimiento){
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function getFechaNacimiento(){
        return $this->fechaNacimiento;
    }

    function saludo(){
        return "Hola ". $this->nombre ;

    }
    function edad($fecha=null){
        if (!$fecha){
            $fecha = new DateTime();
        }
        
        return $fecha ->diff($this->fechaNacimiento)->y;
       
    }
}

$persona = new Persona("Marc", "Muñoz", "Servera", new DateTime("2002-11-09"));



echo "Nombre: " . $persona->getNombre() . "<br>";
echo "Apellido 1: " . $persona->getApellido1() . "<br>";
echo "Apellido 2: " . $persona->getApellido2() . "<br>";
echo "Fecha de Nacimiento: " . $persona->getFechaNacimiento()->format("d-m-y") . "<br>";
echo "Hola ". $persona->getNombre() . " ". $persona->getApellido1() ." ". $persona->getApellido2() ." ". " has nacido en la fecha ". $persona->getFechaNacimiento()->format("d-m-y"). "<br>";

echo $persona->saludo(). "<br>";
echo "Tu edad es ". $persona->edad(new DateTime("10-11-2102")). "<br>" ;



?>