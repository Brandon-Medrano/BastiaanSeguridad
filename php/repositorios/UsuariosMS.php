<?php
use php\clases\AdministradorConexion;
use php\clases\JsonMapper;
use php\modelos\UsuarioMS;
use php\repositorios\UsuariosRepositorioMS;
use php\modelos\Resultado;

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../clases/JsonMapper.php';
include '../clases/Utilidades.php';
include '../clases/AdministradorConexion.php';
include '../repositorios/UsuariosRepositorioMS.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

$administrador_conexion = new AdministradorConexion();

$conexion;
try
{
    $conexion = $administrador_conexion->abrir();
    if($conexion)
    {
        $accion = REQUEST('accion');
        $repositorio = new UsuariosRepositorioMS($conexion);
        switch ($accion)
        {
            
            case 'insertar':
                $json = json_decode(REQUEST('usuarioMS'));
                $mapper = new JsonMapper();
                $usuarioMS = $mapper->map($json, new UsuarioMS());
                $resultado = $repositorio->insertar($usuarioMS);
                if($resultado!=null)
                    //       echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
                    break;
                    
                    
            case 'actualizar':
                $json = json_decode(REQUEST('usuarioMS'));
                $mapper = new JsonMapper();
                $usuarioMS = $mapper->map($json, new UsuarioMS());
                $resultado = $repositorio->actualizar($usuarioMS) ;
                if($resultado!=null)
                    //         echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
                    break;
                    
            case 'eliminar':
                $llaves = json_decode(REQUEST('llaves'));
                $resultado = $repositorio->eliminar($llaves);
                if($resultado!=null)
                    //        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
                    break;
                    
            case 'consultarPorLlaves':
                $llaves = json_decode(REQUEST('llaves'));
                $resultado = $repositorio->consultarPorLlaves($llaves);
                if($resultado!=null)
                    //          echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
                    break;
                    
            case 'consultar':
                $criteriosSeleccion = json_decode(REQUEST('criteriosSeleccion'));
                $resultado = $repositorio->consultar($criteriosSeleccion);
                if($resultado!=null)
                    //            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
                    break;
        }
    }
    
}
catch(Exception $e)
{
    echo $e->getMessage(), '\n';
}
finally
{
    $administrador_conexion->cerrar($conexion);
    if($resultado!=null)
        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
}

