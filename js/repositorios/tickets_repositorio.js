class TicketsRepositorio 
{	
	constructor()
	{
		
	}
	insertar(contexto,functionRetorno, ticket)
	{		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		
		var parametros;
		parametros = "accion=insertar";
		parametros += "&ticket=" + encodeURIComponent(JSON.stringify(ticket));	
		
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.insertarResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	
	insertarResultado(resultado)
	{
		var datos = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}
	/* AREAS */ 
	consultarPorArea(contexto,functionRetorno, criteriosAreas)
	{		
		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		var parametros;
		parametros = "accion=consultarPorArea";
        parametros += "&criteriosAreas=" +  encodeURIComponent(JSON.stringify(criteriosAreas));
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorAreaResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	consultarPorAreaResultado(resultado)
	{
		var datosAreas = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
 /*  */
	/*correo */
	
	correo(contexto,functionRetorno, correo)
	{		
		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		var parametros;
		//parametros = "accion=correo";
        parametros = "&correo=" +  encodeURIComponent(JSON.stringify(correo));
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/PHPMailer-master/src/envio.php", this, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	/*
    	correoResultado(resultado)
    
	{
		var datosAreas = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
	*/
	/* */
	
	
	//ID
	calcularId(contexto,functionRetorno, criteriosIds)
	{		
	    this.contexto = contexto;
	    this.functionRetorno = functionRetorno;
	    var parametros;
	    parametros = "accion=calcularId";
	    var contextHandler = new AjaxContextHandler();
	    var host = window.location.origin + "/BastiaanMesa";	
	    var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.calcularIdResultado, "POST", parametros, contextHandler);		
	    contextHandler.AddAjaxv2Object(ai); 		
	    ai.GetPost(true);
	}
	calcularIdResultado(resultado)
	{
	    var datos = JSON.parse(resultado);
	    this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
	//
	
	/* Usuarios */ 
	consultarPorUsuario(contexto,functionRetorno, criteriosUsuarios)
	{		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		var parametros;
		parametros = "accion=consultarPorUsuario";
        parametros += "&criteriosUsuarios=" +  encodeURIComponent(JSON.stringify(criteriosUsuarios));
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorUsuarioResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	consultarPorUsuarioResultado(resultado)
	{
		var datosUsuarios = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
 /*  */
	
	/* UsuariosR */ 
	consultarPorUsuarioR(contexto,functionRetorno, criteriosUsuariosR)
	{		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		var parametros;
		parametros = "accion=consultarPorUsuarioR";
        parametros += "&criteriosUsuariosR=" +  encodeURIComponent(JSON.stringify(criteriosUsuariosR));
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorUsuarioResultadoR, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	consultarPorUsuarioResultadoR(resultado)
	{
		var datosUsuariosR = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
 /*  */
	/* proyecto */ 
	consultarPorProyecto(contexto,functionRetorno, criteriosProyectos)
	{		
		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		var parametros;
		parametros = "accion=consultarPorProyecto";
        parametros += "&criteriosProyectos=" +  encodeURIComponent(JSON.stringify(criteriosProyectos));
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorProyectoResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	consultarPorProyectoResultado(resultado)
	{
		var datosProyectos = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
 /*  */
	consultar(contexto,functionRetorno, criteriosSeleccion)
	{		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		
		var parametros;
		parametros = "accion=consultar";
		parametros += "&criteriosSeleccion=" + encodeURIComponent(JSON.stringify(criteriosSeleccion));
		
		
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	
	consultarResultado(resultado)
	{
		var datos = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}
	
	
	consultarPorReceso(contexto,functionRetorno, criteriosRecesos)
	{		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		var parametros;
		parametros = "accion=consultarPorReceso";
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorRecesoResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	consultarPorRecesoResultado(resultado)
	{
		var datos = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
	
	actualizar(contexto,functionRetorno, ticket)
	{		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		
		var parametros;
		parametros = "accion=actualizar";
		parametros += "&ticket=" + encodeURIComponent(JSON.stringify(ticket));	
		
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.actualizarResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	
	actualizarResultado(resultado)
	{
		var datos = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}
	
	
	
	consultarPorLlaves(contexto,functionRetorno, llaves)
	{		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		
		var parametros;
		parametros = "accion=consultarPorLlaves";
		parametros += "&llaves=" + encodeURIComponent(JSON.stringify(llaves));
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorLlavesResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	
	consultarPorLlavesResultado(resultado)
	{
		var datos = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}
	
	/* onblur */ 
	consultarPorNaye(contexto,functionRetorno, criteriosNayee)
	{		
		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		var parametros;
		parametros = "accion=consultarPorNaye";
        parametros += "&criteriosNayee=" +  encodeURIComponent(JSON.stringify(criteriosNayee));
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorNayeResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	consultarPorNayeResultado(resultado)
	{
		var datosNayee = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
 /*  */
	
	/* estatu */
	consultarPorEstatu(contexto,functionRetorno, criteriosEstatus)
	{		
	    this.contexto = contexto;
	    this.functionRetorno = functionRetorno;
	    var parametros;
	    parametros = "accion=consultarPorEstatu";
	    var contextHandler = new AjaxContextHandler();
	    var host = window.location.origin + "/BastiaanMesa";	
	    var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorEstatuResultado, "POST", parametros, contextHandler);		
	    contextHandler.AddAjaxv2Object(ai); 		
	    ai.GetPost(true);
	}
	consultarPorEstatuResultado(resultado)
	{
	    var datos = JSON.parse(resultado);
	    this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
/* */
	/* subcategoria */ 
	consultarPorsCategoria(contexto,functionRetorno, criteriossCategorias)
	{		
		
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		var parametros;
		parametros = "accion=consultarPorsCategoria";
        parametros += "&criteriossCategorias=" +  encodeURIComponent(JSON.stringify(criteriossCategorias));
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorsCategoriaResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}
	consultarPorsCategoriaResultado(resultado)
	{
		var datossCategorias = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
 /*  */
/* Importancia */	
	consultarPorImportancia(contexto,functionRetorno, criteriosImportancias)
	{		
	    this.contexto = contexto;
	    this.functionRetorno = functionRetorno;
	    var parametros;
	    parametros = "accion=consultarPorImportancia";
	    var contextHandler = new AjaxContextHandler();
	    var host = window.location.origin + "/BastiaanMesa";	
	    var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorImportanciaResultado, "POST", parametros, contextHandler);		
	    contextHandler.AddAjaxv2Object(ai); 		
	    ai.GetPost(true);
	}
	consultarPorImportanciaResultado(resultado)
	{
	    var datos = JSON.parse(resultado);
	    this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
/* */
	/* Categoria */	
	consultarPorCategoria(contexto,functionRetorno, criteriosCategorias)
	{		
	    this.contexto = contexto;
	    this.functionRetorno = functionRetorno;
	    var parametros;
	    parametros = "accion=consultarPorCategoria";
	    var contextHandler = new AjaxContextHandler();
	    var host = window.location.origin + "/BastiaanMesa";	
	    var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorCategoriaResultado, "POST", parametros, contextHandler);		
	    contextHandler.AddAjaxv2Object(ai); 		
	    ai.GetPost(true);
	}
	consultarPorCategoriaResultado(resultado)
	{
	    var datos = JSON.parse(resultado);
	    this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
/* */
	
	
	/* via*/	
	consultarPorVia(contexto,functionRetorno, criteriosVias)
	{		
	    this.contexto = contexto;
	    this.functionRetorno = functionRetorno;
	    var parametros;
	    parametros = "accion=consultarPorVia";
	    var contextHandler = new AjaxContextHandler();
	    var host = window.location.origin + "/BastiaanMesa";	
	    var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.consultarPorViaResultado, "POST", parametros, contextHandler);		
	    contextHandler.AddAjaxv2Object(ai); 		
	    ai.GetPost(true);
	}
	consultarPorViaResultado(resultado)
	{
	    var datos = JSON.parse(resultado);
	    this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}	
/* */	
	
	
	eliminar(contexto,functionRetorno,llaves)
	{				
		this.contexto = contexto;
		this.functionRetorno = functionRetorno;
		
		var parametros;
		parametros = "accion=eliminar";
		parametros += "&llaves=" + encodeURIComponent(JSON.stringify(llaves));
		var contextHandler = new AjaxContextHandler();
		var host = window.location.origin + "/BastiaanMesa";	
		var ai = new Ajaxv2(host +"/php/repositorios/Tickets.php", this, this.eliminarResultado, "POST", parametros, contextHandler);		
		contextHandler.AddAjaxv2Object(ai); 		
		ai.GetPost(true);
	}

	eliminarResultado(resultado)
	{
		var datos = JSON.parse(resultado);
		this.functionRetorno.call(this.contexto,JSON.parse(resultado));
	}

}