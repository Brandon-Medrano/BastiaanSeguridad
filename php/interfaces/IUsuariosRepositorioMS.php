<?php
namespace php\Interfaces;
use php\modelos\UsuarioMS;

interface IUsuariosRepositorioMS
{
    //data mapper
    public function insertar(UsuarioMS $usuarioMS);
    public function actualizar(UsuarioMS $usuarioMS);
    public function eliminar($id);
    
    public function consultarPorLlaves($id);
    public function consultar($criteriosSeleccion);
}
