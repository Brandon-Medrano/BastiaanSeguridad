class TicketsPresentador
{
	 constructor(vista)
	 {
		this.vista = vista; 

	 }
	 
	 
	 
		
	 consultar()
	 {
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.consultar(this,this.consultarResultado,this.vista.criteriosSeleccion);
	 }

	 consultarResultado(resultado)
	 {
		if(resultado.mensajeError=="")
			this.vista.datos = resultado.valor;
		else
			this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	//onblur
	 consultarPorNaye()
	 {
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.consultarPorNaye(this,this.consultarPorNayeResultado,this.vista.criteriosNayee);
	 }
	 consultarPorNayeResultado(resultado)
	 {
		if(resultado.mensajeError=="")
			this.vista.datosNayee = resultado.valor;
		else
			this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }

	 /* usuarios */	 
	 consultarPorUsuario()
	 {
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.consultarPorUsuario(this,this.consultarPorUsuarioResultado,this.vista.criteriosUsuarios);
	 }
	 consultarPorUsuarioResultado(resultado)
	 {
		if(resultado.mensajeError=="")
			this.vista.datosUsuarios = resultado.valor;
		else
			this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	/* */
	 
	 /* usuariosR */	 
	 consultarPorUsuarioR()
	 {
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.consultarPorUsuarioR(this,this.consultarPorUsuarioResultadoR,this.vista.criteriosUsuariosR);
	 }
	 consultarPorUsuarioResultadoR(resultado)
	 {
		if(resultado.mensajeError=="")
			this.vista.datosUsuariosR = resultado.valor;
		else
			this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	/* */
	 /* AREAS */	 
	 consultarPorArea()
	 {
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.consultarPorArea(this,this.consultarPorAreaResultado,this.vista.criteriosAreas);
	 }
	 consultarPorAreaResultado(resultado)
	 {
		if(resultado.mensajeError=="")
			this.vista.datosAreas = resultado.valor;
		else
			this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	/* */
	 
	
	 /* AREAS */	 
	 consultarPorProyecto()
	 {
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.consultarPorProyecto(this,this.consultarPorProyectoResultado,this.vista.criteriosProyectos);
	 }
	 consultarPorProyectoResultado(resultado)
	 {
		if(resultado.mensajeError=="")
			this.vista.datosProyectos = resultado.valor;
		else
			this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	/* */
	 /* Estatus*/
	 consultarPorEstatu()
	 {
	     var repositorio = new TicketsRepositorio(this);		
	     repositorio.consultarPorEstatu(this,this.consultarPorEstatuResultado,this.vista.criteriosEstatus);
	 }
	 consultarPorEstatuResultado(resultado)
	 {
	    if(resultado.mensajeError=="")
	        this.vista.datosEstatus = resultado.valor;
	    else
	        this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	 
	 /* Nivel de importancia*/
	 consultarPorImportancia()
	 {
	     var repositorio = new TicketsRepositorio(this);		
	     repositorio.consultarPorImportancia(this,this.consultarPorImportanciaResultado,this.vista.criteriosImportancias);
	 }
	 consultarPorImportanciaResultado(resultado)
	 {
	    if(resultado.mensajeError=="")
	        this.vista.datosImportancias = resultado.valor;
	    else
	        this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	 
	 /*CATEGORIA*/
	 consultarPorCategoria()
	 {
	     var repositorio = new TicketsRepositorio(this);		
	     repositorio.consultarPorCategoria(this,this.consultarPorCategoriaResultado,this.vista.criteriosCategorias);
	 }
	 consultarPorCategoriaResultado(resultado)
	 {
	    if(resultado.mensajeError=="")
	        this.vista.datosCategorias = resultado.valor;
	    else
	        this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	 /*sCATEGORIA*/
	 consultarPorsCategoria()
	 {
	     var repositorio = new TicketsRepositorio(this);		
	     repositorio.consultarPorsCategoria(this,this.consultarPorsCategoriaResultado,this.vista.criteriossCategorias);
	 }
	 consultarPorsCategoriaResultado(resultado)
	 {
	    if(resultado.mensajeError=="")
	        this.vista.datossCategorias = resultado.valor;
	    else
	        this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	 
	 /* via Solictud*/
	 consultarPorVia()
	 {
	     var repositorio = new TicketsRepositorio(this);		
	     repositorio.consultarPorVia(this,this.consultarPorViaResultado,this.vista.criteriosVias);
	 }
	 consultarPorViaResultado(resultado)
	 {
	    if(resultado.mensajeError=="")
	        this.vista.datosVias = resultado.valor;
	    else
	        this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	 
	 insertar()
	 {
		 var repositorio = new TicketsRepositorio(this);			 
		 repositorio.insertar(this,this.insertarResultado,this.vista.ticket);	
 
		 repositorio.correo(this,this.correoResultado,this.vista.correo);
	 }
	 
	 insertarResultado(resultado)
	 {
		if(resultado.mensajeError=="")
		{	
			this.vista.mostrarMensaje("Aviso","La información se guardó correctamente. Id: " + resultado.valor);
			this.vista.salirFormulario();
			this.consultar();
		}
		else
			this.vista.mostrarMensaje("Error","Ocurrió un error al guardar el registro. " + resultado.mensajeError);			
			
	 }	
	 
 /* CORREO */	 
	 
	 
	 correo()
	 {

		// this.vista.correo;
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.correo(this,this.correoResultado,this.vista.correo);
	 }
	/*
	 correo(resultado)
	 {
		if(resultado.mensajeError=="")
			this.vista.datosAreas = resultado.valor;
		else
			this.vista.mostrarMensaje("Error",resultado.mensajeError);
	 }
	 
	 */
	/* */
	 
	 actualizar()
	 {
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.actualizar(this,this.actualizarResultado,this.vista.ticket);
	 }
	 
	 actualizarResultado(resultado)
	 {
		 if(resultado.mensajeError=="")
		 {	
			this.vista.mostrarMensaje("Aviso","La información se actualizó correctamente.");
			this.vista.salirFormulario();
			this.consultar();
		 }
		 else
			this.vista.mostrarMensaje("Error","Ocurrió un error al actualizar el registro. " + resultado.mensajeError);			
	 }
	   
	 consultarPorLlaves()
	 {
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.consultarPorLlaves(this,this.consultarPorLlavesResultado,this.vista.llaves);
	 }
	 
	 consultarPorLlavesResultado(resultado)
	 {		
		 if(resultado.mensajeError=="")
		 {
			 this.vista.ticket = resultado.valor;
		 }
		 else
			 this.vista.mostrarMensaje("Error","Ocurrió un error al consultar el registro. " + resultado.mensajeError);
	 }
	 
	 eliminar()
	 {
		 var repositorio = new TicketsRepositorio(this);		
		 repositorio.eliminar(this,this.eliminarResultado,this.vista.llaves);		
	 }
	 
	 
	 eliminarResultado(resultado)
	 {
		if(resultado.mensajeError=="")
		{
			this.vista.mostrarMensaje("Aviso", "El registro se eliminó correctamente.");
			this.consultar();
		}
		else
			this.vista.mostrarMensaje("Error","Ocurrió un error al eliminar el registro. " + resultado.mensajeError);		
	 }
	 
}