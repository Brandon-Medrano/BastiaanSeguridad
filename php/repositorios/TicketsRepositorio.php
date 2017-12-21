<?php
namespace php\repositorios;

use Exception;
use php\interfaces\ITicketsRepositorio;
use php\modelos\Resultado;
use php\modelos\Ticket;
include "../interfaces/ITicketsRepositorio.php";
include "../modelos/Ticket.php";
include "../clases/Resultado.php";

class TicketsRepositorio implements ITicketsRepositorio
{
    protected $conexion;
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    
    
    public function calcularId()
    {
        $resultado = new Resultado();
        $consulta =  "SELECT MAX(IFNULL(MSVSOLICITUDNOLIN,0))+1 AS id FROM bstnmsv.msvsolicitud";
        
        
        if($sentencia = $this->conexion->prepare($consulta))
        {
            if($sentencia->execute())
            {
                if ($sentencia->bind_result($id))
                {
                    if($sentencia->fetch())
                    {
                        $resultado->valor = $id;
                    }
                    else
                        $resultado->mensajeError = "No se encontró ningún resultado";
                }
                else
                    $resultado->mensajeError = "Falló el enlace del resultado";
            }
            else
                $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
        }
        else
            $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
            return $resultado;
    }
    
    public function insertar(Ticket $ticket)
    {
        $resultado =  $this->calcularId();
        if($resultado->mensajeError=="")
        {
            $id = $resultado->valor;
            $consulta = " INSERT INTO bstnmsv.msvsolicitud "
                . " (MSVSOLICITUDNOLIN, "
                . " MSVSOLICITUDFSOL, "
                . " MSVSOLICITUDHSOL, "
                . " MSVSOLICITUDUSRSOLID, "
                . " MSVSCTGAID, "
                . " MSVSOLICITUDUSRRLZ, " // cambiar en el promt para que introduca su abreviado y no su nombre por que no inserta 
                . " MSVVSOLID, "
                . " MSVRACTID, "
                . " MSVPROYID, "
                . " MSVSOLICITUDASUNTO, "
                . " MSVSOLICITUDDESC,"
                . " MSVNIMPID)"  // se agrego importancia 
                . " VALUE(?,?,?,?,?,?,?,?,?,?,?,?)"; 
                              if($sentencia = $this->conexion->prepare($consulta))
                                   {
                                      if( $sentencia->bind_param("isssssssssss",$id,
                                          $ticket->fSolicitud,
                                          $ticket->hInicial,
                                          $ticket->ugenero,
                                          $ticket->areaSoli,
                                          $ticket->usuarioRealizador,
                                          $ticket->viaId,
                                          $ticket->recesoId,
                                          $ticket->proyecto,
                                          $ticket->asunto,
                                          $ticket->dsc,
                                          $ticket->idImportancias)) // se grego importancia 
                                      {
                                         if(!$sentencia->execute())
                                             $resultado->mensajeError = "Fall� la ejecuci�n (" . $this->conexion->errno . ") " . $this->conexion->error;
                                      }
                                     else
                                          $resultado->mensajeError = "Fall� el enlace de par�metros";
                                     }
                                       else
                                           $resultado->mensajeError = "Fall� la preparaci�n: (" . $this->conexion->errno . ") " . $this->conexion->error;
                                   }
           return $resultado;
    }
     public function eliminar($llaves)
     {
         $resultado = new Resultado();
         $consulta = " DELETE FROM bstnmsv.msvsolicitud "
             . "  WHERE MSVSOLICITUDNOLIN = ? ";
             if($sentencia = $this->conexion->prepare($consulta))
             {
                 if($sentencia->bind_param("s",$llaves->id))
                 {
                     if($sentencia->execute())
                     {
                         $resultado->valor = $llaves->id;
                     }
                     else
                         $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
                 }
                 else
                     $resultado->mensajeError = "Falló el enlace de parámetros";
             }
             else
                 $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
                 
                 return $resultado;
     }
     
     public function actualizar(Ticket $ticket)
     {
         $resultado = new Resultado();
         $consulta = " UPDATE bstnmsv.msvsolicitud SET"
                 ." MSVSOLICITUDFSOL = ?, " //fSolicitud
                 ." MSVSOLICITUDHSOL = ?, " //hInicial
                 ." MSVSOLICITUDUSRSOLID = ?, "  //ugenero
                 ." MSVSCTGAID = ?, " //areaSoli
                 ." MSVVSOLID = ?, "//viaId
                 ." MSVSOLICITUDUSRRLZ = ?, " //usuarioRealizador
                 ." MSVRACTID = ?, " //recesoId
                 ." MSVPROYID = ?, " //proyecto
                 ." MSVSOLICITUDASUNTO = ?, " //asunto
                 ." MSVSOLICITUDDESC = ?, " //dsc
                 ." MSVNIMPID = ? "//idImportancias
                ." WHERE MSVSOLICITUDNOLIN = ? ";
                 if($sentencia = $this->conexion->prepare($consulta))
                       {
                           if($sentencia->bind_param("ssssssssssss",
                               $ticket->fSolicitud,
                               $ticket->hInicial,
                               $ticket->ugenero,
                               $ticket->areaSoli,
                               $ticket->viaId,
                               $ticket->usuarioRealizador,
                               $ticket->recesoId,
                               $ticket->proyecto,
                               $ticket->asunto,
                               $ticket->dsc,
                               $ticket->idImportancias,
                               $ticket->id))
                   {
          if($sentencia->execute()){
             $resultado->valor=true;
          }else
       $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
           }
       else  $resultado->mensajeError = "Falló el enlace de parámetros";
        }
           else
          $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
                       return $resultado;
     }
     public function consultarPorLlaves($llaves)
     {
         
         $resultado = new Resultado();
         $consulta =  " SELECT "
         . " MSVSOLICITUDNOLIN id, "
             . " MSVSOLICITUDFSOL fSolicitud, "
                 . " MSVSOLICITUDHSOL hInicial, "
                     . " MSVSOLICITUDUSRSOLID ugenero, "
                         . " MSVSCTGAID areaSoli, "
                             . " MSVVSOLID viaId, "
                                 . " MSVSOLICITUDUSRRLZ usuarioRealizador, "
                                     . " MSVRACTID recesoId, "
                                         . " MSVPROYID proyecto, "
                                             . " MSVSOLICITUDASUNTO asunto, "
                                                 . " MSVSOLICITUDDESC dsc, " // esta mal es dsc 
                                                     ." MSVNIMPID idImportancias "
                                                          ." FROM bstnmsv.msvsolicitud "
                                                             ." WHERE MSVSOLICITUDNOLIN like CONCAT('%',?,'%') ";
                                                             if($sentencia = $this->conexion->prepare($consulta))
                                                             {
                                                                 if($sentencia->bind_param("s",$llaves->id))
                                                                 {
                                                                     if($sentencia->execute())
                                                                     {
                                                                         if ($sentencia->bind_result($id, $fSolicitud, $hInicial, $ugenero, $areaSoli, $viaId, $usuarioRealizador, $recesoId, $proyecto, $asunto, $dsc, $idImportancias))
                                                                         {
                                                                             if($sentencia->fetch())
                                                                             {
                                                                                 $ticket = new Ticket();
                                                                                 $ticket->id =  utf8_encode($id);
                                                                                 $ticket->fSolicitud =  utf8_encode($fSolicitud);
                                                                                 $ticket->hInicial =  utf8_encode($hInicial);
                                                                                 $ticket->ugenero =  utf8_encode($ugenero);
                                                                                 $ticket->areaSoli =  utf8_encode($areaSoli);
                                                                                 $ticket->viaId =  utf8_encode($viaId);
                                                                                 $ticket->usuarioRealizador =  utf8_encode($usuarioRealizador);
                                                                                 $ticket->recesoId =  utf8_encode($recesoId);
                                                                                 $ticket->proyecto =  utf8_encode($proyecto);
                                                                                 $ticket->asunto =  utf8_encode($asunto);
                                                                                 $ticket->dsc =  utf8_encode($dsc);
                                                                                 $ticket->idImportancias =  utf8_encode($idImportancias);
                                                                                 $resultado->valor = $ticket;
                                                                                 
                                                                             }
                                                                             else
                                                                                 $resultado->mensajeError = "No se encontró ningún resultado.";
                                                                         }
                                                                         else
                                                                             $resultado->mensajeError = "Falló el enlace del resultado";
                                                                     }
                                                                     else
                                                                         $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
                                                                 }
                                                                 else
                                                                     $resultado->mensajeError = "Falló el enlace de parámetros";
                                                             }
                                                             else
                                                                 $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
                                                                 return $resultado;
     }
     public function consultar($criteriosSeleccion)
     {
         $resultado = new Resultado();
         $tickets = array();
         
         $consulta = " SELECT MSVSOLICITUDNOLIN id, MSVSOLICITUDASUNTO actividad, MSVSOLICITUDUSRSOLID ugenero, DATE_FORMAT(MSVSOLICITUDFSOL,'%d/%m/%Y') fSolicitud, ".
         " MSVSOLICITUDHSOL hInicial, B.MSVRACTNOML recesoId".
         " FROM bstnmsv.msvsolicitud A ".
        " LEFT JOIN bstnmsv.msvract B ON A.MSVRACTID = B.MSVRACTID ".
        " AND MSVSOLICITUDFSOL like CONCAT('%',?,'%') ".
        " WHERE MSVRACTNOML like CONCAT('%',?,'%') ".
             " AND MSVSOLICITUDUSRSOLID like CONCAT('%',?,'%') ";
         
         if($sentencia = $this->conexion->prepare($consulta))
         {
             if($sentencia->bind_param("sss",$criteriosSeleccion->fInicial, $criteriosSeleccion->estado, $criteriosSeleccion->usuarioSol))
             {
                 if($sentencia->execute())
                 {
                     if ($sentencia->bind_result($id, $actividad, $ugenero, $fSolicitud, $hInicial, $recesoId))
                     {
                         while($row = $sentencia->fetch())
                         {
                             $ticket = (object) [
                                 'id' => utf8_encode($id),
                                 'actividad' => utf8_encode($actividad),
                                 'ugenero' =>  utf8_encode($ugenero),
                                 'fSolicitud' =>  utf8_encode($fSolicitud),
                                 'hInicial' =>  utf8_encode($hInicial),
                                 'recesoId' => utf8_encode($recesoId)
                             ];
                             array_push($tickets,$ticket);
                         }
                         $resultado->valor = $tickets;
                     }
                     else
                         $resultado->mensajeError = "Falló el enlace del resultado.";
                 }
                 else
                     $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
             }
             else
                 $resultado->mensajeError = "Falló el enlace de parámetros";
         }
         else
             $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
             return $resultado;
     }
     public function consultarPorVia()
     {
         $resultado = new Resultado();
         $tickets = array();
         
         $consulta = "SELECT"
             . "  MSVTSOLID idVias, "
             . " MSTVSOLNOML descVias"
             . " from  bstnmsv.msvtsol";
                     if($sentencia = $this->conexion->prepare($consulta))
                     {
                         if(true)
                         {
                             if($sentencia->execute())
                             {
                                 if ($sentencia->bind_result($idVias, $descVias))
                                 {
                                     while($row = $sentencia->fetch())
                                     {
                                         $ticket = (object) [
                                             'idVias' => utf8_encode($idVias),
                                             'descVias' =>  utf8_encode($descVias)
                                         ];
                                         array_push($tickets,$ticket);
                                     }
                                     $resultado->valor = $tickets;
                                 }
                                 else
                                     $resultado->mensajeError = "Falló el enlace del resultado.";
                             }
                             else
                                 $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
                         }
                         else
                             $resultado->mensajeError = "Falló el enlace de parámetros";
                     }
                     else
                         $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
                         return $resultado;
     }
     
     
     public function consultarPorImportancia()
     {
         $resultado = new Resultado();
         $tickets = array();
         
         $consulta = "SELECT"
                     . " MSVNIMPID idImportancias, "
                     . " MSVNIMPNOML descImportancias"
                     . " from  bstnmsv.msvnimpid";
                     if($sentencia = $this->conexion->prepare($consulta))
                     {
                         if(true)
                         {
                             if($sentencia->execute())
                             {
                                 if ($sentencia->bind_result($idImportancias, $descImportancias))
                                 {
                                     while($row = $sentencia->fetch())
                                     {
                                         $ticket = (object) [
                                             'idImportancias' => utf8_encode($idImportancias),
                                             'descImportancias' =>  utf8_encode($descImportancias)
                                         ];
                                         array_push($tickets,$ticket);
                                     }
                                     $resultado->valor = $tickets;
                                 }
                                 else
                                     $resultado->mensajeError = "Falló el enlace del resultado.";
                             }
                             else
                                 $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
                         }
                         else
                             $resultado->mensajeError = "Falló el enlace de parámetros";
                     }
                     else
                         $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
                         return $resultado;
     }
     
     public function consultarPorEstatu()
     {
         $resultado = new Resultado();
         $tickets = array();
         
         $consulta = "SELECT "
             . " MSVETCKTTID idEstatus, "
             . " MSVETCKTNOML descEstatus "
             . " FROM bstnmsv.msvetckt ";
         
         if($sentencia = $this->conexion->prepare($consulta))
         {
             if(true)
             {
                 if($sentencia->execute())
                 {
                     if ($sentencia->bind_result($idEstatus, $descEstatus))
                     {
                         while($row = $sentencia->fetch())
                         {
                             $ticket = (object) [
                                 'idEstatus' => utf8_encode($idEstatus),
                                 'descEstatus' =>  utf8_encode($descEstatus)
                             ];
                             array_push($tickets,$ticket);
                         }
                         $resultado->valor = $tickets;
                     }
                     else
                         $resultado->mensajeError = "Falló el enlace del resultado.";
                 }
                 else
                     $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
             }
             else
                 $resultado->mensajeError = "Falló el enlace de parámetros";
         }
         else
             $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
             return $resultado;
     }
     
     
     
     public function consultarPorNaye($criteriosNayee)
     {
         
         $resultado = new Resultado();
         $nayee = array();
         
         $consulta  =  " SELECT DISTINCT(MSVSOLICITUDUSRSOLID) ugenero, MSVUSUARIOSCEPER correo, MSVUSUARIOSTELCEL telefono, MSVUSUARIOSEXT extension ".
             " FROM bstnmsv.msvusuarios ".
             " WHERE MSVSOLICITUDUSRSOLID  like CONCAT('%',?,'%') ";
         if($sentencia = $this->conexion->prepare($consulta))
         {
             if($sentencia->bind_param("s",$criteriosNayee-> ugenero))
             {
                 if($sentencia->execute())
                 {
                     if ($sentencia->bind_result($ugenero, $correo, $telefono, $extension ))
                     {
                         while($row = $sentencia->fetch())
                         {
                             $naye = (object) [
                                 'ugenero' =>  utf8_encode($ugenero),
                                 'correo' =>  utf8_encode($correo),
                                 'telefono' =>  utf8_encode($telefono),
                                 'extension' =>  utf8_encode($extension)
                             ];
                             array_push($nayee,$naye);
                         }
                         $resultado->valor = $nayee;
                     }
                     else
                         $resultado->mensajeError = "Falló el enlace del resultado";
                 }
                 else
                     $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
             }
             else
                 $resultado->mensajeError = "Falló el enlace de parámetros";
         }
         else
             $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
             return $resultado;
     }
     public function consultarPorArea($criteriosAreas)
     
     {
         $resultado = new Resultado();
         $areas = array();
         
         $consulta = " SELECT MSVSCTGAID id, MSVSCTGANOML agenteId".
             " FROM bstnmsv.msvsctga ".
             " WHERE MSVSCTGAID like CONCAT ('%',?,'%') ".
             "AND  MSVSCTGANOML  like CONCAT('%',?,'%')";
         
         if($sentencia = $this->conexion->prepare($consulta))
         {
             if($sentencia->bind_param("ss",$criteriosAreas->agenteId,
                 $criteriosAreas->agente))
             {
                 if($sentencia->execute())
                 {
                     if ($sentencia->bind_result($id, $agenteId)  )
                     {
                         while($row = $sentencia->fetch())
                         {
                             $area = (object) [
                                 'id' => utf8_encode($id),
                                 'agenteId' =>  utf8_encode($agenteId)
                             ];
                             array_push($areas,$area);
                         }
                         $resultado->valor = $areas;
                     }
                     else
                         $resultado->mensajeError = "Falló el enlace del resultado.";
                 }
                 else
                     $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
             }
             else
                 $resultado->mensajeError = "Falló el enlace de parámetros";
         }
         else
             $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
             
             
             return $resultado;
     }   
     
     public function  consultarPorUsuario($criteriosUsuarios)
     
     {
         $resultado = new Resultado();
         $usuarios = array();
         
         $consulta = " SELECT MSVSOLICITUDUSRSOLID id, MSVUSUARIOSNOMC nayeagenteId".
             " FROM bstnmsv.msvusuarios ".
             " WHERE MSVSOLICITUDUSRSOLID like CONCAT ('%',?,'%') ".
             " AND  MSVUSUARIOSNOMC  like CONCAT('%',?,'%')";
         
         if($sentencia = $this->conexion->prepare($consulta))
         {
             if($sentencia->bind_param("ss",$criteriosUsuarios->id,
                 $criteriosUsuarios->nayeagenteId))
             {
                 if($sentencia->execute())
                 {
                     if ($sentencia->bind_result($id, $nayeagenteId)  )
                     {
                         while($row = $sentencia->fetch())
                         {
                             $usuario = (object) [
                                 'id' => utf8_encode($id),
                                 'nayeagenteId' =>  utf8_encode($nayeagenteId)
                             ];
                             array_push($usuarios,$usuario);
                         }
                         $resultado->valor = $usuarios;
                     }
                     else
                         $resultado->mensajeError = "Falló el enlace del resultado.";
                 }
                 else
                     $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
             }
             else
                 $resultado->mensajeError = "Falló el enlace de parámetros";
         }
         else
             $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
             
             
             return $resultado;
     }
     
     public function  consultarPorUsuarioR($criteriosUsuariosR)
     
     {
         $resultado = new Resultado();
         $usuariosR = array();
         
         $consulta = " SELECT MSVSABREBSTN id, MSVUSUARIOSBSTNPNOMBRE nayeagenteId".
             " FROM bstnmsv.msvusuariosbstn ".
             " WHERE MSVSABREBSTN like CONCAT ('%',?,'%') ".
             " AND  MSVUSUARIOSBSTNPNOMBRE  like CONCAT('%',?,'%')";
         
         if($sentencia = $this->conexion->prepare($consulta))
         {
             if($sentencia->bind_param("ss",$criteriosUsuariosR->id,
                 $criteriosUsuariosR->nayeagenteId))
             {
                 if($sentencia->execute())
                 {
                     if ($sentencia->bind_result($id, $nayeagenteId)  )
                     {
                         while($row = $sentencia->fetch())
                         {
                             $usuarioR = (object) [
                                 'id' => utf8_encode($id),
                                 'nayeagenteId' =>  utf8_encode($nayeagenteId)
                             ];
                             array_push($usuariosR,$usuarioR);
                         }
                         $resultado->valor = $usuariosR;
                     }
                     else
                         $resultado->mensajeError = "Falló el enlace del resultado.";
                 }
                 else
                     $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
             }
             else
                 $resultado->mensajeError = "Falló el enlace de parámetros";
         }
         else
             $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
             
             
             return $resultado;
     }
     
     
     public function consultarPorProyecto($criteriosProyectos)
     
     {
         $resultado = new Resultado();
         $proyectos = array();
         
         $consulta = " SELECT MSVPROYID id, MSVPROYNOML agenteId".
             " FROM bstnmsv.msvproy ".
             " WHERE MSVPROYID like CONCAT ('%',?,'%') ".
             "AND  MSVPROYNOML  like CONCAT('%',?,'%')";
         
         if($sentencia = $this->conexion->prepare($consulta))
         {
             if($sentencia->bind_param("ss",$criteriosProyectos->agenteId,
                 $criteriosProyectos->agente))
             {
                 if($sentencia->execute())
                 {
                     if ($sentencia->bind_result($id, $agenteId)  )
                     {
                         while($row = $sentencia->fetch())
                         {
                             $proyecto = (object) [
                                 'id' => utf8_encode($id),
                                 'agenteId' =>  utf8_encode($agenteId)
                             ];
                             array_push($proyectos,$proyecto);
                         }
                         $resultado->valor = $proyectos;
                     }
                     else
                         $resultado->mensajeError = "Falló el enlace del resultado.";
                 }
                 else
                     $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
             }
             else
                 $resultado->mensajeError = "Falló el enlace de parámetros";
         }
         else
             $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
             
             
             return $resultado;
     }
     public function consultarPorcategoria()
     {
         $resultado = new Resultado();
         $tickets = array();
         
         $consulta = "SELECT"
             . " MSVCATNOMC idCategorias, "
                 . " MSVCATNOML descCategorias"
                     . " from  bstnmsv.msvcat";
                     if($sentencia = $this->conexion->prepare($consulta))
                     {
                         if(true)
                         {
                             if($sentencia->execute())
                             {
                                 if ($sentencia->bind_result($idCategorias, $descCategorias))
                                 {
                                     while($row = $sentencia->fetch())
                                     {
                                         $ticket = (object) [
                                             'idCategorias' => utf8_encode($idCategorias),
                                             'descCategorias' =>  utf8_encode($descCategorias)
                                         ];
                                         array_push($tickets,$ticket);
                                     }
                                     $resultado->valor = $tickets;
                                 }
                                 else
                                     $resultado->mensajeError = "Falló el enlace del resultado.";
                             }
                             else
                                 $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
                         }
                         else
                             $resultado->mensajeError = "Falló el enlace de parámetros";
                     }
                     else
                         $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
                         return $resultado;
     }
     
     public function consultarPorsCategoria($criteriossCategorias)
     {
         $resultado = new Resultado();
         $tickets = array();
         
         $consulta = "SELECT"
             . " MSVCATNOMC idsCategorias, "
                 . " MSVSCATNOML descsCategorias"
                     . " from  bstnmsv.msvscat"
                         ." WHERE MSVCATNOMC like CONCAT('%',?,'%') ";
                         if($sentencia = $this->conexion->prepare($consulta))
                         {
                             if($sentencia->bind_param("s",$criteriossCategorias->categoria))
                             {
                                 if($sentencia->execute())
                                 {
                                     if ($sentencia->bind_result($idsCategorias, $descsCategorias))
                                     {
                                         while($row = $sentencia->fetch())
                                         {
                                             $ticket = (object) [
                                                 'idsCategorias' => utf8_encode($idsCategorias),
                                                 'descsCategorias' => utf8_encode($descsCategorias)
                                             ];
                                             array_push($tickets,$ticket);
                                         }
                                         $resultado->valor = $tickets;
                                     }
                                     else
                                         $resultado->mensajeError = "Falló el enlace del resultado.";
                                 }
                                 else
                                     $resultado->mensajeError = "Falló la ejecución (" . $this->conexion->errno . ") " . $this->conexion->error;
                             }
                             else
                                 $resultado->mensajeError = "Falló el enlace de parámetros";
                         }
                         else
                             $resultado->mensajeError = "Falló la preparación: (" . $this->conexion->errno . ") " . $this->conexion->error;
                             return $resultado;
     }
     

}
