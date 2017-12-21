<?php
namespace php\repositorios;

use Exception;
use php\interfaces\IUsuariosRepositorioMS;
use php\modelos\UsuarioMS;
use php\modelos\Resultado;

include "../interfaces/IUsuariosRepositorioMS.php";
include "../modelos/UsuarioMS.php";
include "../clases/Resultado.php";

class UsuariosRepositorioMS implements IUsuariosRepositorioMS
{
    protected $conexion;
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    
    public function insertar(UsuarioMS $usuarioMS)
    {
        $resultado =  "";
       
            $consulta = " INSERT INTO BSTNTRN.MSVUSUARIOS "
                . " (MSVUSUARIOSID, "
                . " MSVUSUARIOSALIAS, "
                . " MSVUSUARIOSPNOMBRE, "
                . " MSVUSUARIOSSNOMBRE, "
                . " MSVUSUARIOSAPATERNO, "
                . " MSVUSUARIOSAMATERNO, "
                . " MSVUSUARIOSCEPER, "
                . " MSVUSUARIOSTELCEL) "
                . " VALUE(?,?,?,?,?,?,?,?) ";
     if($sentencia = $this->conexion->prepare($consulta))
        {
         if( $sentencia->bind_param("ssssssss",$usuarioMS->id, 
            $usuarioMS->alias,
            $usuarioMS->primerNombre,
            $usuarioMS->segundoNombre,
            $usuarioMS->apellidoPaterno,
            $usuarioMS->apellidoMaterno,
            $usuarioMS->correoElectronicoPersonal,
            $usuarioMS->telefonoCelular))
     {
       if(!$sentencia->execute())
     $resultado->mensajeError = "Fall� la ejecuci�n (" . $this->conexion->errno . ") " . $this->conexion->error;
      }
  else
       $resultado->mensajeError = "Fall� el enlace de par�metros";
       }
         else
   $resultado->mensajeError = "Fall� la preparaci�n: (" . $this->conexion->errno . ") " . $this->conexion->error;
        
        return $resultado;
    }
    
    public function eliminar($llaves)
    {
        $resultado = new Resultado();
        $consulta = " DELETE FROM BSTNTRN.MSVUSUARIOS "
            . "  WHERE MSVUSUARIOSID  = ? ";
            if($sentencia = $this->conexion->prepare($consulta))
            {
                if($sentencia->bind_param("s",$llaves->id))
                {
                    if($sentencia->execute())
                    {
                        $resultado->valor = $llaves->id;
                    }
                    else
                        $resultado->mensajeError = "Fall� la ejecuci�n (" . $this->conexion->errno . ") " . $this->conexion->error;
                }
                else
                    $resultado->mensajeError = "Fall� el enlace de par�metros";
            }
            else
                $resultado->mensajeError = "Fall� la preparaci�n: (" . $this->conexion->errno . ") " . $this->conexion->error;
                
                return $resultado;
    }
    
    public function actualizar(UsuarioMS $usuarioMS)
    {
        $resultado = new Resultado();
        $consulta = " UPDATE BSTNTRN.MSVUSUARIOS SET"
        . " MSVUSUARIOSALIAS = ?, "
        . " MSVUSUARIOSPNOMBRE = ?, "
        . " MSVUSUARIOSSNOMBRE = ?, "
        . " MSVUSUARIOSAPATERNO = ?, "
        . " MSVUSUARIOSAMATERNO = ?, "
        . " MSVUSUARIOSCEPER = ?, "
        . " MSVUSUARIOSTELCEL = ? "
        . " WHERE MSVUSUARIOSID = ? ";
  if($sentencia = $this->conexion->prepare($consulta))
  {
      if($sentencia->bind_param("ssssssss",
          $usuarioMS->alias,
          $usuarioMS->primerNombre,
          $usuarioMS->segundoNombre,
          $usuarioMS->apellidoPaterno,
          $usuarioMS->apellidoMaterno,
          $usuarioMS->correoElectronicoPersonal,
          $usuarioMS->telefonoCelular,
          $usuarioMS->id))
   {
    if($sentencia->execute())
   {
   $resultado->valor=true;
   }
 else
  $resultado->mensajeError = "Fall� la ejecuci�n (" . $this->conexion->errno . ") " . $this->conexion->error;
   }
 else  $resultado->mensajeError = "Fall� el enlace de par�metros";
  }
  else
  $resultado->mensajeError = "Fall� la preparaci�n: (" . $this->conexion->errno . ") " . $this->conexion->error;
   return $resultado;
    }
    
    public function consultar($criteriosSeleccion)
    {
        $resultado = new Resultado();
        $usuariosMS = array();
        
        $consulta =   " SELECT "
        . " MSVUSUARIOSID id, "
        . " MSVUSUARIOSALIAS alias, "
        . " MSVUSUARIOSPNOMBRE primerNombre, "
        . " MSVUSUARIOSSNOMBRE segundoNombre, "
        . " MSVUSUARIOSAPATERNO apellidoPaterno, "
        . " MSVUSUARIOSAMATERNO apellidoMaterno, "
        . " MSVUSUARIOSCEPER correoElectronicoPersonal, "
        . " MSVUSUARIOSTELCEL telefonoCelular "
        . " FROM BSTNTRN.MSVUSUARIOS  "
        . " WHERE MSVUSUARIOSID like  CONCAT('%',?,'%') "
        . " AND MSVUSUARIOSPNOMBRE like  CONCAT('%',?,'%') "
        . " AND MSVUSUARIOSSNOMBRE like  CONCAT('%',?,'%') ";
        
if($sentencia = $this->conexion->prepare($consulta))
  {
    if($sentencia->bind_param("sss",$criteriosSeleccion->id,$criteriosSeleccion->primerNombre,$criteriosSeleccion->segundoNombre))
       {
         if($sentencia->execute())
           {
               if ($sentencia->bind_result($id, $alias, $primerNombre, $segundoNombre, $apellidoPaterno, $apellidoMaterno,  $telefonoCelular,  $correoElectronicoPersonal)  )
                {
                  while($row = $sentencia->fetch())
                    {
                      $usuarioMS = (object) [
                 'id' =>  utf8_encode($id),
                 'alias' =>  utf8_encode($alias),
                 'primerNombre' => utf8_encode($primerNombre),
                 'segundoNombre' => utf8_encode($segundoNombre),
                 'apellidoPaterno' => utf8_encode($apellidoPaterno),
                 'apellidoMaterno' => utf8_encode($apellidoMaterno),
                 'telefonoCelular' => utf8_encode($telefonoCelular),
                 'correoElectronicoPersonal' => utf8_encode($correoElectronicoPersonal)
                  ];
 array_push($usuariosMS,$usuarioMS);
  }
  $resultado->valor = $usuariosMS;
  }
           else
       $resultado->mensajeError = "Fall� el enlace del resultado.";
         }
     else
   $resultado->mensajeError = "Fall� la ejecuci�n (" . $this->conexion->errno . ") " . $this->conexion->error;
      }
   else
 $resultado->mensajeError = "Fall� el enlace de par�metros";
 }
  else
 $resultado->mensajeError = "Fall� la preparaci�n: (" . $this->conexion->errno . ") " . $this->conexion->error;
        return $resultado;
    }
    
    public function consultarPorLlaves($llaves)
    {
        $resultado = new Resultado();
        $consulta =  " SELECT "
            . " MSVUSUARIOSID id, "
                . " MSVUSUARIOSALIAS alias, "
                    . " MSVUSUARIOSPNOMBRE primerNombre, "
                        . " MSVUSUARIOSSNOMBRE segundoNombre, "
                            . " MSVUSUARIOSAPATERNO apellidoPaterno, "
                                . " MSVUSUARIOSAMATERNO apellidoMaterno, "
                                    . " MSVUSUARIOSCEPER correoElectronicoPersonal, "
                                        . " MSVUSUARIOSTELCEL telefonoCelular "
        . " FROM BSTNTRN.MSVUSUARIOS  "
        . " WHERE MSVUSUARIOSID  = ?";
     if($sentencia = $this->conexion->prepare($consulta))
        {
         if($sentencia->bind_param("s",$llaves->id))
           {
            if($sentencia->execute())
              {
                  if ($sentencia->bind_result($id, $alias, $primerNombre, $segundoNombre, $apellidoPaterno, $apellidoMaterno, $correoElectronicoPersonal,  $telefonoCelular ))
                   {
                     if($sentencia->fetch())
                       {
                        $usuarioMS = new UsuarioMS();
                        $usuarioMS-> id =  utf8_encode($id);
                        $usuarioMS-> alias =  utf8_encode($alias);
                        $usuarioMS->primerNombre = utf8_encode($primerNombre);
                        $usuarioMS->segundoNombre = utf8_encode($segundoNombre);
                        $usuarioMS->apellidoPaterno = utf8_encode($apellidoPaterno);
                        $usuarioMS-> apellidoMaterno = utf8_encode($apellidoMaterno);
                        $usuarioMS->correoElectronicoEmpresa = utf8_encode($correoElectronicoPersonal);
                        $usuarioMS->telefonoCelular = utf8_encode($telefonoCelular);
                        $resultado->valor = $usuarioMS;
  }
       else
    $resultado->mensajeError = "No se encontr� ning�n resultado.";
     }
      else
   $resultado->mensajeError = "Fall� el enlace del resultado";
     }
   else
  $resultado->mensajeError = "Fall� la ejecuci�n (" . $this->conexion->errno . ") " . $this->conexion->error;
   }
   else
  $resultado->mensajeError = "Fall� el enlace de par�metros";
 }
  else
$resultado->mensajeError = "Fall� la preparaci�n: (" . $this->conexion->errno . ") " . $this->conexion->error;
 return $resultado;
    }
    
}

