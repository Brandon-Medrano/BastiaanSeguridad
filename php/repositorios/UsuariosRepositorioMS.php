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
       
            $consulta = " INSERT INTO bstnmsv.msvagente "
                . " (MSVAGENTEID, "
                . " MSVAGENTEDSC, "
                . " MSVAGENTEPASSWORD, "
                . " MSVAGENTEDIRECCION, "
                . " MSVAGENTEIDIOMA, "
                . " MSVAGENTECURP, "
                    . " MSVAGENTERFC, "
                        . " MSVAGENTENSS, "
                            . " MSVAGENTEPTEL, "
                                . " MSVAGENTESTEL, "
                                    . " MSVAGENTEEXT, "
                                        . " MSVAGENTEEXTM, "
                                            . " MSVAGENTECORREO, "
                . " MSVAGENTEPASSCOR) "
                . " VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
     if($sentencia = $this->conexion->prepare($consulta))
        {
         if( $sentencia->bind_param("ssssssssssssss",$usuarioMS->id, 
            $usuarioMS->descripcion,
            $usuarioMS->password,
            $usuarioMS->direccion,
            $usuarioMS->idioma,
            $usuarioMS->curp,
             $usuarioMS->rfc,
             $usuarioMS->nss,
             $usuarioMS->ptel,
             $usuarioMS->stel,
             $usuarioMS->ext,
             $usuarioMS->extmarcador,
             $usuarioMS->correo,
            $usuarioMS->passwordc))
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
        $consulta = " DELETE FROM bstnmsv.msvagente  "
            . "  WHERE MSVAGENTEID  = ? ";
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
        $consulta = " UPDATE bstnmsv.msvagente SET"
        . " MSVAGENTEDSC = ?, "
        . " MSVAGENTEPASSWORD = ?, "
        . " MSVAGENTEDIRECCION = ?, "
        . " MSVAGENTEIDIOMA = ?, "
            . " MSVAGENTECURP = ?, "
                . " MSVAGENTERFC = ?, "
                    . " MSVAGENTENSS = ?, "
                        . " MSVAGENTEPTEL = ?, "
                            . " MSVAGENTESTEL = ?, "
                                . " MSVAGENTEEXT = ?, "
                                    . " MSVAGENTEEXTM = ?, "
                                        . " MSVAGENTECORREO = ?, "
                                            . " MSVAGENTEPASSCOR = ? "
        . " WHERE MSVAGENTEID = ? ";
  if($sentencia = $this->conexion->prepare($consulta))
  {
      if($sentencia->bind_param("ssssssssssssss",
          $usuarioMS->dsc,
          $usuarioMS->password,
          $usuarioMS->direccion,
          $usuarioMS->idioma,
          $usuarioMS->curp,
          $usuarioMS->rfc,
          $usuarioMS->nss,
          $usuarioMS->ptel,
          $usuarioMS->stel,
          $usuarioMS->ext,
          $usuarioMS->extmarcador,
          $usuarioMS->correo,
          $usuarioMS->passwordc,
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
        . " MSVAGENTEID id, "
        . " MSVAGENTEDSC dsc, "
        . " MSVAGENTEPASSWORD password, "
        . " MSVAGENTEDIRECCION direccion, "
        . " MSVAGENTEIDIOMA idioma, "
        . " MSVAGENTECURP curp, "
        . " MSVAGENTERFC rfc, "
            . " MSVAGENTENSS nss, "
                . " MSVAGENTEPTEL ptel, "
                    . " MSVAGENTESTEL stel, "
                        . " MSVAGENTEEXT ext, "
                            . " MSVAGENTEEXTM extmarcador, "
                                . " MSVAGENTECORREO correo, "
                                    . " MSVAGENTEPASSCOR passwordc "
        . " FROM bstnmsv.msvagente  "
        . " WHERE MSVAGENTEID like  CONCAT('%',?,'%') "
        . " AND MSVAGENTEDSC like  CONCAT('%',?,'%') "
        . " AND MSVAGENTEDIRECCION like  CONCAT('%',?,'%') ";
        
if($sentencia = $this->conexion->prepare($consulta))
  {
    if($sentencia->bind_param("sss",$criteriosSeleccion->agente,$criteriosSeleccion->dsc,$criteriosSeleccion->clase))
       {
         if($sentencia->execute())
           {
               if ($sentencia->bind_result($id, $dsc, $password, $direccion, $idioma, $curp,  $rfc,  $nss, $ptel, $stel, $ext, $extmarcador, $correo, $passwordc)  )
                {
                  while($row = $sentencia->fetch())
                    {
                      $usuarioMS = (object) [
                 'id' =>  utf8_encode($id),
                          'dsc' =>  utf8_encode($dsc),
                          'password' => utf8_encode($password),
                          'direccion' => utf8_encode($direccion),
                          'idioma' => utf8_encode($idioma),
                          'curp' => utf8_encode($curp),
                          'rfc' => utf8_encode($rfc),
                          'nss' => utf8_encode($nss),
                          'ptel' => utf8_encode($ptel),
                          'stel' => utf8_encode($stel),
                          'ext' => utf8_encode($ext),
                          'extmarcador' => utf8_encode($extmarcador),
                          'correo' => utf8_encode($correo),
                          'passwordc' => utf8_encode($passwordc)
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
            . " MSVAGENTEID id, "
                . " MSVAGENTEDSC dsc, "
                    . " MSVAGENTEPASSWORD password, "
                        . " MSVAGENTEDIRECCION direccion, "
                            . " MSVAGENTEIDIOMA idioma, "
                                . " MSVAGENTECURP curp, "
                                    . " MSVAGENTERFC rfc, "
                                        . " MSVAGENTENSS nss, "
                                            . " MSVAGENTEPTEL ptel, "
                                                . " MSVAGENTESTEL stel, "
                                                    . " MSVAGENTEEXT ext, "
                                                        . " MSVAGENTEEXTM extmarcador, "
                                                            . " MSVAGENTECORREO correo, "
                                                                . " MSVAGENTEPASSCOR passwordc "
                                                                    . " FROM bstnmsv.msvagente  "
        . " WHERE MSVAGENTEID  = ? ";
     if($sentencia = $this->conexion->prepare($consulta))
        {
         if($sentencia->bind_param("s",$llaves->id))
           {
            if($sentencia->execute())
              {
                  if ($sentencia->bind_result($id, $dsc, $password, $direccion, $idioma, $curp,  $rfc,  $nss, $ptel, $stel, $ext, $extmarcador, $correo, $passwordc ))
                   {
                     if($sentencia->fetch())
                       {
                        $usuarioMS = new UsuarioMS();
                        $usuarioMS-> id =  utf8_encode($id);
                        $usuarioMS-> dsc =  utf8_encode($dsc);
                        $usuarioMS->password = utf8_encode($password);
                        $usuarioMS->direccion = utf8_encode($direccion);
                        $usuarioMS->idioma = utf8_encode($idioma);
                        $usuarioMS-> curp = utf8_encode($curp);
                        $usuarioMS->rfc = utf8_encode($rfc);
                        $usuarioMS->nss= utf8_encode($nss);
                        $usuarioMS->ptel = utf8_encode($ptel);
                        $usuarioMS->stel = utf8_encode($stel);
                        $usuarioMS->ext = utf8_encode($ext);
                        $usuarioMS-> extmarcador = utf8_encode($extmarcador);
                        $usuarioMS->correo = utf8_encode($correo);
                        $usuarioMS->passwordc = utf8_encode($passwordc);
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

