<?php
namespace php\interfaces;

use php\modelos\Ticket;

interface ITicketsRepositorio
{
    public function insertar(Ticket $ticket);
    public function actualizar(Ticket $ticket);
    public function eliminar($id);
    
    public function consultarPorLlaves($llaves);
    public function consultar($criteriosSeleccion);
    public function consultarPorNaye($criteriosNayee); 
    public function consultarPorEstatu();
    public function consultarPorImportancia();
    public function consultarPorArea($criteriosAreas);
    public function consultarPorUsuario($criteriosUsuarios);
    public function consultarPorProyecto($criteriosProyectos);
    public function consultarPorUsuarioR($criteriosUsuariosR);
    public function consultarPorsCategoria($criteriossCategorias);
    public function consultarPorCategoria();
}