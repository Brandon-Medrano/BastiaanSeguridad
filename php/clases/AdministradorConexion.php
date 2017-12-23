<?php
namespace php\clases;
use mysqli;


class AdministradorConexion
{
    private $servidor = "10.25.1.250:3306";
    private	$basedatos = "bstnmsv";
    private	$usuario = "bastiaansql";
    private	$contrasena ="060814BSTN";
    public function abrir()
    {
        return new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
       /* alert("lola")  */
    }
    
    public function cerrar($connection)
    {
        if($connection) 
            //mysqli_close($connection);
         
            $connection->close();
    }
    
}

