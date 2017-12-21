class TicketsVista
{		
	constructor(ventana)
	{	
		this.ventana = ventana;
		this.presentador = new TicketsPresentador(this);
		this.manejadorEventos = new ManejadorEventos();
		this.grid = new GridReg("grid");	
	}
	onLoad()
	{			
		
        
		this.crearColumnasGrid();
		this.presentador.consultar();


		 
		this.cmbEstatus = new Combo("agenteIdFormularioInput");
		this.cmbEstatus.setViewport("recesoIdFormularioInput");
		this.cmbEstatus._dataField = "idEstatus";
		this.cmbEstatus._labelField = "descEstatus";

		this.cmbEstatus.render();

		this.cmbImportancias = new Combo("id1");// buscar 
		this.cmbImportancias.setViewport("importanciaIdFormularioInput");
		this.cmbImportancias._dataField = "idImportancias";
		this.cmbImportancias._labelField = "descImportancias";

		this.cmbImportancias.render();
		
		this.cmbVias = new Combo("id2");// objeto
		this.cmbVias.setViewport("viaIdFormularioInput");
		this.cmbVias._dataField = "idVias";
		this.cmbVias._labelField = "descVias";

		this.cmbVias.render();
		this.cmbCategorias = new Combo("id3");// buscar 
		this.cmbCategorias.setViewport("categoriaIdFormularioInput");
		this.cmbCategorias._dataField = "idCategorias";
		this.cmbCategorias._labelField = "descCategorias";

		this.cmbCategorias.render();
		
		this.cmbsCategorias = new Combo("id4");// buscar 
		this.cmbsCategorias.setViewport("scategoriaIdFormularioInput");
		this.cmbsCategorias._dataField = "idsCategorias";
		this.cmbsCategorias._labelField = "descsCategorias";

		this.cmbsCategorias.render();
		
	}
	
	crearColumnasGrid()
	{
		this.grid._columnas = [
			{titulo:"Id",   	alias:"id", alineacion:"I" },
			{titulo:"Actividad",   	alias:"actividad", alineacion:"I" }, 
			{titulo:"Usuario que solicita",   alias:"ugenero", alineacion:"I" }, 
			{titulo:"Fecha de solicitud",   alias:"fSolicitud", alineacion:"C" }, 
			{titulo:"Hora de solicitud",   alias:"hInicial", alineacion:"C" },	
			{titulo:"Estatus",   alias:"recesoId", alineacion:"I" },

		]
		
		this.grid._origen="vista";
		this.grid.manejadorEventos=this.manejadorEventos;
		this.grid._ajustarAltura = true;
		this.grid._colorRenglon1 = "#FFFFFF";	
		this.grid._colorRenglon2 = "#FFFFFF";
		this.grid._colorEncabezado1 = "#FF6600";
		this.grid._colorEncabezado2 = "#FF6600";
		this.grid._colorLetraEncabezado = "#ffffff";
		this.grid._colorLetraCuerpo = "#000000";
		this.grid._regExtra=20;
		this.grid.render();		
	}
	
	
	
	onBlur(){
		
         //var nombre = document.getElementById("");
		this.presentador.consultarPorNaye();
		
	}
	set datosNayee(valor)
	{		
		$('#correoFormularioInput').val(valor[0].correo);
		$('#telefonoFormularioInput').val(valor[0].telefono);
		$('#extensionFormularioInput').val(valor[0].extension);
		}
	
	areaSelect()
	{
		
		$('#areaSoliFormularioInput').val(this._gridListaArchivos._selectedItem.agenteId);
		$('#principalDiv').hide()	
		$('#formularioDiv').show();
		this.mostrarFormulario();
	 }  
	
	proyectoSelect()
	{
		
		$('#proyectoFormularioInput').val(this._gridListaArchivos._selectedItem.agenteId);
		$('#principalDiv').hide()	
		$('#formularioDiv').show();
		this.mostrarFormulario();
	 }  
	
	/*
	 * Eventos en botones
	*/
	
	btnAlta_onClick()
	{
		this.modo = "ALTA";
		this.limpiarFormulario();
		

		this.presentador.consultarPorEstatu();
		this.presentador.consultarPorImportancia();
		this.presentador.consultarPorVia();
		this.presentador.consultarPorCategoria();
				
		this.mostrarFormulario();
		
		var hoy = new Date();
		var dd = hoy.getDate();
		var MM = hoy.getMonth()+1; //hoy es 0!
		var yyyy = hoy.getFullYear();

		if(dd<10) {
		    dd='0'+dd
		} 

		if(MM<10) {
		    MM='0'+MM
		} 

		hoy = yyyy+"-"+MM+"-"+dd;
		document.getElementById("fSolicitudFormularioInput").value = hoy;

	    var momentoActual = new Date();
        var hora = momentoActual.getHours().toString();
  	    var minuto = momentoActual.getMinutes().toString();
   	    var segundo = momentoActual.getSeconds().toString();
   	    if (hora.length < 2) {
		    hora = "0"+hora;
		  }
		  
		  if (minuto.length < 2) {
		    minuto = "0"+minuto;
		  }
		  
		  if (segundo.length < 2) {
			  segundo = "0"+segundo;
			  }
  	    var horaImprime = hora + " : " + minuto + " : " + segundo;
        document.getElementById('hInicialFormularioInput').value = horaImprime;
     
    		 
	}
	get nayeMiNovia()
	{
		var nayeMiNovia = 
		{
				
		}
	}
	
	btnBaja_onClick()
	{ 
		if(this.grid._selectedItem!=null)
		{
			var confirmacion = confirm("¿Esta seguro que desea eliminar el registro?")
		    if (confirmacion)
		    {
		    	this.presentador.eliminar();
		    }	
		}
		else
			this.mostrarMensaje("Selecciona un registro para eliminar.");
	}
		
	btnCambio_onClick()
	{
		if(this.grid._selectedItem!=null)
		{			
			this.modo = "CAMBIO";	

			this.presentador.consultarPorEstatu();
			this.presentador.consultarPorImportancia();
			this.presentador.consultarPorVia();
			this.presentador.consultarPorCategoria();
			this.presentador.consultarPorLlaves();
			this.mostrarFormulario();	
			
			//
			/*
			this.presentador.consultarPorProyecto();
			this.presentador.consultarPorVia();
			this.presentador.consultarPorArea();
			this.presentador.consultarPorImportancia();
			this.presentador.consultarPorEstatu();
			this.presentador.consultarPorNaye();
			*/
		}
		else
			this.mostrarMensaje("Selecciona un registro para modificar.");
				
	}
	
	btnConsulta_onClick()
	{
		this.presentador.consultar();
	}	
	
	
	btnconsultaPrompt_onClick()
	{
		this.presentador.consultarPorArea();
	}
	
	btnconsultaPPrompt_onClick()
	{
		this.presentador.consultarPorProyecto();
	}
	
	btnconsultarPrompt_onClick()
	{
		this.presentador.consultarPorUsuario();
	}
	
	btnconsultarPromptR_onClick()
	{
		this.presentador.consultarPorUsuarioR();
	}
	


	get correo(){
		var correo = {
				correo:$('#copiaCorreoFormularioInput').val()
				}
		return correo;
	}
	
	
	btnGuardarFormulario_onClick()
	{		
		 var campoObligatorioVacio = this.campoObligatorioVacio();
		 if(campoObligatorioVacio==null)
		 {
			if(this.modo=='ALTA')
				this.presentador.insertar();
		
			else
				this.presentador.actualizar();
		 }		
		 else
		 {
			this.mostrarMensaje('Error','El campo "' + campoObligatorioVacio.attr("descripcion") + '" es obligatorio.');
		 }	
	}
	
	btnSalir_onClick()
	{
		var confirmacion = confirm("¿Esta seguro que desea salir?")
	    if (confirmacion)
	    	{
	    	//TODO: Cerrar ventana aqui
	    	}
	}
	btnSalirFormulario_onClick()
	{		
		this.salirFormulario();
	}	
	
	btnsalirPromt_onClick()
	{
		$('#principalDiv').hide()	
		$('#formularioDiv').show();
		this.mostrarFormulario();
	}
	
	/*
	 * Valores de las llaves
	 */
	
	get llaves()
	{
		var llaves =
		{
			id:this.grid._selectedItem.id	
		}
		return llaves;
	}
	
	//valores para aurorelleno con onblur
	get criteriosNayee()
	{	
		var criteriosNayee =
	    {
		ugenero:$('#ugeneroFormularioTiket').val()
	    }
	    return 	criteriosNayee;
	}	
	/*
	set datosNayee(valor)
	{
	this._gridListaArchivos._dataProvider = valor;
	this._gridListaArchivos.render();
	}	
	
	 * Valores de los criterios de selección
	 */
	
	get criteriosSeleccion()
	{
		 var criteriosSeleccion = 
		 {				    
			fInicial:$('#fInicialCriterioInput').val(),
			estado:$('#estadoCriterioInput').val(),
			usuarioSol:$('#usuarioSolCriterioInput').val()
		 }
		 return criteriosSeleccion;
	}		
	
	get criteriosUsuarios()
	{	
		var criteriosUsuarios =
	    {
		id:$('#idCriterioAsistenteInput').val(),
		nayeagenteId:$('#dscCriterioAsistenteInput').val()
	    }
	    return 	criteriosUsuarios;
	}
	
	get criteriosUsuariosR()
	{	
		var criteriosUsuariosR =
	    {
		id:$('#idCriterioAsistenteInput').val(),
		nayeagenteId:$('#dscCriterioAsistenteInput').val()
	    }
	    return 	criteriosUsuariosR;
	}
	
	get criteriosProyectos()
	{	
		var criteriosProyectos =
	    {
				agenteId:$('#idCriterioAsistenteInput').val(),
				agente:$('#dscCriterioAsistenteInput').val()
	    }
	    return 	criteriosProyectos;
	}
	
	get criteriossCategorias()
	{
		 var criteriossCategorias = 
		 {				    
			categoria:$('#categoriaIdFormularioInput').val()
		 }
		 return criteriossCategorias;
	}
	
	/*
	 * Asignar registros al grid
	 */
	
	
	
	//ONBLOR SCAT
	naye(){
		
		this.presentador.consultarPorsCategoria();
		
	}
	//
	
	set datos(valor)
	{
		this.grid._dataProvider = valor;	
		this.grid.render();
	}
	
	set datosAreas(valor)
	{
	this._gridListaArchivos._dataProvider = valor;
	this._gridListaArchivos.render();
	}
	
	set datosProyectos(valor)
	{
	this._gridListaArchivos._dataProvider = valor;
	this._gridListaArchivos.render();
	}
		
	
set datosCategorias(valor){
    	
		this.cmbCategorias._dataProvider = valor;
		this.cmbCategorias.setSeleccionado("idCategorias",this.idCategorias);
		this.cmbCategorias.render();
		
	}

set datossCategorias(valor){
		
		this.cmbsCategorias._dataProvider = valor;
		this.cmbsCategorias.setSeleccionado("idsCategorias",this.idsCategorias);
		this.cmbsCategorias.render();
		
	}

set categoria(valor)
	{
		$('descCategoriasFormularioInput').val(valor.descCategorias);
		$('idCategoriasFormularioInput').val(valor.idCategorias);
		this.idCategorias = valor.idCategorias
		
	}
	
	set scategoria(valor)
	{
		$('descsCategoriasFormularioInput').val(valor.descsCategorias);
		$('idsCategoriasFormularioInput').val(valor.idsCategorias);
		
		this.idsCategorias = valor.idsCategorias
		
	}
	
	set datosEstatus(valor){
		this.cmbEstatus._dataProvider = valor;
		this.cmbEstatus.setSeleccionado("idEstatus",this.idEstatus);
		this.cmbEstatus.render();
		
	}
	
	set datosImportancias(valor){
		
		this.cmbImportancias._dataProvider = valor;
		this.cmbImportancias.setSeleccionado("idImportancias",this.idImportancias);
		this.cmbImportancias.render();
		
	}
	
	
	set datosVias(valor){
		
		this.cmbVias._dataProvider = valor;
		this.cmbVias.setSeleccionado("idVias",this.idVias);
		this.cmbVias.render();
		
	}
	
	set datosUsuarios(valor)
	{
	this._gridListaArchivos._dataProvider = valor;
	this._gridListaArchivos.render();
	}	

	set datosUsuariosR(valor)
	{
	this._gridListaArchivos._dataProvider = valor;
	this._gridListaArchivos.render();
	}	
	
	set estatus(valor)
	{
		$('descEstatusFormularioInput').val(valor.descEstatus);
		$('idEstatusFormularioInput').val(valor.idEstatus);
		
		this.idEstatus = valor.idEstatus
		
	}


	set importancia(valor)
	{
		$('descImportanciasFormularioInput').val(valor.descImportancias);
		$('idImportanciasFormularioInput').val(valor.idImportancias);
		
		this.idImportancias = valor.idImportancias
		
	}
	
	set via(valor)
	{
		$('descViasFormularioInput').val(valor.descVias);
		$('idViasFormularioInput').val(valor.idVias);
		
		this.idViass = valor.idVias
		
	}
	
	get estatus()
	{
		
		var estatus = 
		{
		
	    idEstatus:this.cmbEstatus._selectedItem.idEstatus,
		descEstatus:$('#descEsatusFormularioInput').val()
		};
		
		return estatus;
	}
	
	
	get importancias()
	{
		
		var importancias = 
		{
		
	    idImportancias:this.cmbImportancias._selectedItem.idImportancias,
		descImportancias:$('#descImportanciasFormularioInput').val()
		};
		
		return importancias;
	}

	
	get categorias()
	{
		
		var categorias = 
		{
		
	    idCategorias:this.cmbCategorias._selectedItem.idCategorias,
		descCategorias:$('#descCategoriasFormularioInput').val(),
		};
		
		return categorias;
	}
	
	get scategorias()
	{
		
		var scategorias = 
		{
		
	    idsCategorias:this.cmbssCategorias._selectedItem.idsCategorias,
		descsCategorias:$('#descsCategoriasFormularioInput').val()
		};
		
		return scategorias;
	}
	
	get vias()
	{
		
		var vias = 
		{
		
	    idVias:this.cmbVias._selectedItem.idVias,
		descVias:$('#descViasFormularioInput').val()
		};
		
		return Vias;
	}

	get criteriosAreas()
	{	
		var criteriosAreas =
	    {
		agenteId:$('#idCriterioAsistenteInput').val(),
		agente:$('#dscCriterioAsistenteInput').val()
	    }
	    return 	criteriosAreas;
	}
	

	/*
	set datosPostales(valor)
	{
		
		this.promptPostales = valor;
		//this.datosPostales = valor;
		//this.render();
	}
	

	 * Mapeo de datos del formulario con el modelo
	 */
	
	set ticket(valor)
	{		
		  $('#idFormularioInput').val(valor.id);
		  $('#fSolicitudFormularioInput').val(valor.fSolicitud);
		  $('#hInicialFormularioInput').val(valor.hInicial);
		  $('#ugeneroFormularioTiket').val(valor.ugenero);
		  $('#viaIdFormularioInput').val(valor.viaId);
		  $('#recesoIdFormularioInput').val(valor.recesoId);
		  $('#usuarioRealizadorFormularioInput').val(valor.usuarioRealizador);
		  $('#proyectoFormularioInput').val(valor.proyecto);
		  $('#asuntoFormularioInput').val(valor.asunto);
		  $('#dscFormularioInput').val(valor.dsc);
		  $('#correoFormularioInput').val(valor.correo);
		  $('#copiaCorreoFormularioInput').val(valor.copiaCorreo);
		  $('#importanciaIdFormularioInput').val(valor.idImportancias);
		  $('#telefonoFormularioInput').val(valor.telefono);
		  $('#extensionFormularioInput').val(valor.extension);
		  $('#areaSoliFormularioInput').val(valor.areaSoli);
	}
	
	get ticket()
	{
		 var ticket = 
		 {		
			    id:$('#idFormularioInput').val(),
			    fSolicitud:$('#fSolicitudFormularioInput').val(),
			    hInicial:$('#hInicialFormularioInput').val(),
			    ugenero:$('#ugeneroFormularioTiket').val(),
			    viaId:$('#viaIdFormularioInput').val(),
			    correo:$('#correoFormularioInput').val(),
			    recesoId:$('#recesoIdFormularioInput').val(),
			    copiaCorreo:$('#copiaCorreoFormularioInput').val(),
			    usuarioRealizador:$('#usuarioRealizadorFormularioInput').val(),
			    idImportancias:$('#importanciaIdFormularioInput').val(),
			    proyecto:$('#proyectoFormularioInput').val(),
			    telefono:$('#telefonoFormularioInput').val(),
			    extension:$('#extensionFormularioInput').val(),
			    areaSoli:$('#areaSoliFormularioInput').val(),
			    asunto:$('#asuntoFormularioInput').val(),
			    dsc:$('#dscFormularioInput').val()

		 };
		 return ticket;
	 }
	
	mostrarMensaje(titulo,mensaje)
	{
		alert(mensaje);	
	}
	
	mostrarFormulario()
	{
		$('#principalDiv').hide();
		$('#formularioDiv').show();
		$('#PromptArea').hide();
		$('#PromptUsuario').hide();
		$('#PromptProyecto').hide();
		$('#PromptUsuarioR').hide();
	}
	salirFormulario()
	{
		$('#principalDiv').show()	
		$('#formularioDiv').hide();
	}
	
	
	/*
	 *Validación de los datos obligatorios del formulario 
	 */
	
	campoObligatorioVacio()
	{
		if($('#primerNombreFormularioInput').val()=='')					
			return $('#primerNombreFormularioInput');
		
		if($('#apellidoPaternoFormularioInput').val()=='')					
			return $('#apellidoPaternoFormularioInput');
		
		return null;
	}	
	
	/*
	 * Limpiar formulario
	 */
	limpiarFormulario()
	{
		$('#ugeneroFormularioTiket').val("");
		$('#agenteIdFormularioInput').val("");
		$('#extensionFormularioInput').val("");
		$('#proyectoFormularioInput').val("");
		$('#areaSoliFormularioInput').val("");
		$('#correoFormularioInput').val("");
		$('#telefonoFormularioInput').val("");
		$('#usuarioRealizadorFormularioInput').val("");
		$('#copiaCorreoFormularioInput').val("");
		$('#tSoliFormularioInput').val("");
		$('#asuntoFormularioInput').val("");
		$('#asuntodFormularioInput').val("");
		$('#dscFormularioInput').val("");
		$('#dscdFormularioInput').val("");
	}
	
	
	
	verDatosAsis()
	{	
		/*this._promptUsuarios = new PromptUsuarios("_promptUsuarios")
		this._promptUsuarios.setViewport("PromptUsuario");
		this._promptUsuarios.load(this.PromptUsuarios,this);				
		this._promptUsuarios.render();*/
		
		var output = "";
		output += '<div class="col s12 m6" style="position: fixed; top: 0px; left: 0px; display: block; width: 100%; height: 100%; z-index: 5001; background-color: rgba(255, 255, 250, 0.95);" >'
		output += "<div class='container' id='PMenuAsistente' >";
		output += "<div class='nav-wrapper  grey darken-2 accent-3 z-depth-4'";
		output += "<td>";
		output += "<img src='assets/botones/btnSalir.png' onClick='vista.btnsalirPromt_onClick();'>";
		output += "</td>";
		output += "<td>";
		output += "<img src='assets/botones/imgConsulta.png' onClick='vista.btnconsultaPrompt_onClick();'>";
		output += "</td>";
		output += "</div>";
			output += "<div class='col s12' id='contCriterios2'>";
			output += "<div class='row' >";  
			output += "<a>Id Area:</a>";
		output += "	<input  id='idCriterioAsistenteInput' class='input'/>";
		output += "<a>Nombre Area:</a>";
		output += "	<input id='dscCriterioAsistenteInput' class='input'>" ;
		output += "</div>";
		
			
			output +=" <div id='PromptAreaGrid' class='col s12' ></div>";	
		
			
			output += "</div'>";
			
		output += "</div'>";
		output += "</div'>";
		document.getElementById("PromptArea").innerHTML = output;
		document.getElementById("PromptArea").style.display = "block";			
		document.getElementById("PromptArea").style.position = "fixed";
		

		this._gridListaArchivos = new GridReg("_gridListaArchivos");
		var columnas = [
			{longitud:180, titulo:"Id Area", alias:"id", alineacion:"I"},
			{longitud:272, titulo:"Nombre Area", alias:"agenteId", alineacion:"I"}
		];
		this._gridListaArchivos
		._origen="vista";
		this._gridListaArchivos._columnas = columnas;
		this._gridListaArchivos._ajustarAltura 		= true;
		this._gridListaArchivos._colorRenglon1 		= "#FFFFFF";
		this._gridListaArchivos._colorRenglon2 		= "#FFFFFF";
		this._gridListaArchivos._colorEncabezado1 	= "#CCC";
		this._gridListaArchivos._colorEncabezado2 	= "#CCC";
		this._gridListaArchivos._colorLetraEncabezado = "#444444";
		this._gridListaArchivos._colorLetraCuerpo 	= "#888888";
		this._gridListaArchivos._colorLetraCuerpo 	= "#888888";
		this._gridListaArchivos.manejadorEventos=this.manejadorEventos;
		this._gridListaArchivos._regExtra=5;
		this._gridListaArchivos.subscribirAEvento(this, "eventGridRowDoubleClick",vista.areaSelect);
		//this._gridListaArchivos._dataProvider = [];
		this._gridListaArchivos.setViewport("PromptAreaGrid");
		this._gridListaArchivos.render();
		this.presentador.consultarPorArea();   
		
	}
	
	
	usuarioSelect()
	{
		
		$('#ugeneroFormularioTiket').val(this._gridListaArchivos._selectedItem.id);
		$('#agenteIdFormularioInput').val(this._gridListaArchivos._selectedItem.nayeagenteId);
		$('#principalDiv').hide()	
		$('#formularioDiv').show();
		this.mostrarFormulario();
		this.onBlur();

	 }  
	
	verDatosAsistente()
	{	
		var output = "";
		output += '<div class="col s12 m6" style="position: fixed; top: 0px; left: 0px; display: block; width: 100%; height: 100%; z-index: 5001; background-color: rgba(255, 255, 250, 0.95);" >'
		output += "<div class='container' id='PMenuAsistente' >";
		output += "<div class='nav-wrapper  grey darken-2 accent-3 z-depth-4'";
		output += "<td>";
		output += "<img src='assets/botones/btnSalir.png' onClick='vista.btnsalirPromt_onClick();'>";
		output += "</td>";
		output += "<td>";
		output += "<img src='assets/botones/imgConsulta.png' onClick='vista.btnconsultarPrompt_onClick();'>"
		output += "</td>";
		output += "</div>";
			output += "<div class='col s12' id='contCriterios2'>";
			output += "<div class='row' >";  
			output += "<a>Id Usuario:</a>";
		output += "	<input  id='idCriterioAsistenteInput' class='input'/>";
		output += "<a>Nombre Usuario:</a>";
		output += "	<input id='dscCriterioAsistenteInput' class='input'>" ;
		output += "</div>";
		
			
			output +=" <div id='PromptUsuarioGrid' class='col s12' ></div>";	
		
			
			output += "</div'>";
			
		output += "</div'>";
		output += "</div'>";
		

		/*
		var output = "";
		var output = "";
		output += '<div class="col s12 m6" style="position: fixed; top: 0px; left: 0px; display: block; width: 100%; height: 100%; z-index: 5001; background-color: rgba(255, 255, 250, 0.95);" >'
		output += "<div class='container' id='PMenuAsistente' >";
		output += "<div class='nav-wrapper  grey darken-2 accent-3 z-depth-4'";
		output += "<img src='assets/botones/btnSalir.png' onClick='vista.btnsalirPromt_onClick();'>";
		output += "<img src='assets/botones/imgConsulta.png' onClick='vista.btnconsultarPrompt_onClick();'>";
		output += "</div>";
		output += "<div class='col s12' id='contCriterios2'>";
		output += "<div class='row' >";  
		output += "<td>";
			output += "<td>";
			output += "<a>Id:</a>";
			output += "</td>"
			output += "<td>";
		output += "	<input  id='idCriterioAsistenteInput' class='input'/>";
			output += "</td>"	
		output += "</tr>";
		output += "<tr>";
		output += "<td>";
		output += "<a>Nombre Agente:</a>";
			output += "</td>"
			output += "<td>"
		output += "	<input id='dscCriterioAsistenteInput' type='text' class='input'>" ;
		output += "</td>";
		output += "</tr>";
		output += "</td>";
		output += "</div>";
			output +=" <div id='PromptUsuarioGrid' class='gridPrompt' style='height:60%;width:491px;></div>";	
		
			output += "</div'>";
			
		output += "</div'>";
		output += "</div'>";
			*/
		document.getElementById("PromptUsuario").innerHTML = output;
		document.getElementById("PromptUsuario").style.display = "block";			
		document.getElementById("PromptUsuario").style.position = "fixed";
		

		this._gridListaArchivos = new GridReg("_gridListaArchivos");
		var columnas = [
			{longitud:180, titulo:"Id", alias:"id", alineacion:"I"},
			{longitud:272, titulo:"Nombre Agente", alias:"nayeagenteId", alineacion:"I"}
		];
		this._gridListaArchivos
		._origen="vista";
		this._gridListaArchivos._columnas = columnas;
		this._gridListaArchivos._ajustarAltura 		= true;
		this._gridListaArchivos._colorRenglon1 		= "#FFFFFF";
		this._gridListaArchivos._colorRenglon2 		= "#FFFFFF";
		this._gridListaArchivos._colorEncabezado1 	= "#CCC";
		this._gridListaArchivos._colorEncabezado2 	= "#CCC";
		this._gridListaArchivos._colorLetraEncabezado = "#444444";
		this._gridListaArchivos._colorLetraCuerpo 	= "#888888";
		this._gridListaArchivos._colorLetraCuerpo 	= "#888888";
		this._gridListaArchivos.manejadorEventos=this.manejadorEventos;
		this._gridListaArchivos._regExtra=5;
		this._gridListaArchivos.subscribirAEvento(this, "eventGridRowDoubleClick",vista.usuarioSelect);
		//this._gridListaArchivos._dataProvider = [];
		this._gridListaArchivos.setViewport("PromptUsuarioGrid");
		this._gridListaArchivos.render();
		this.presentador.consultarPorUsuario();   
		
	}
	
	
	
	verDatosAsisProyecto()
	{	
		var output = "";
		output += '<div class="col s12 m6" style="position: fixed; top: 0px; left: 0px; display: block; width: 100%; height: 100%; z-index: 5001; background-color: rgba(255, 255, 250, 0.95);" >'
		output += "<div class='container' id='PMenuAsistente' >";
		output += "<div class='nav-wrapper  grey darken-2 accent-3 z-depth-4'";
		output += "<td>";
		output += "<img src='assets/botones/btnSalir.png' onClick='vista.btnsalirPromt_onClick();'>";
		output += "</td>";
		output += "<td>";
		output += "<img src='assets/botones/imgConsulta.png' onClick='vista.btnconsultaPPrompt_onClick();'>"
		output += "</td>";
		output += "</div>";
			output += "<div class='col s12' id='contCriterios2'>";
			output += "<div class='row' >";  
			output += "<a>Id Proyecto:</a>";
		output += "	<input  id='idCriterioAsistenteInput' class='input'/>";
		output += "<a>Nombre Proyecto:</a>";
		output += "	<input id='dscCriterioAsistenteInput' class='input'>" ;
		output += "</div>";
		
			
			output +=" <div id='PromptProyectoGrid' class='col s12' ></div>";	
		
			
			output += "</div'>";
			
		output += "</div'>";
		output += "</div'>";
		/*
		var output = "";
		output += '<div style="position: fixed; top: 0px; left: 0px; display: block; width: 100%; height: 100%; z-index: 5001; background-color: rgba(255, 255, 250, 0.75);" >'
		output += "<div class='panelAsistenteFRM' id='PMenuAsistente' style='width:520px;background-color:#BCBCBC;height:auto; margin-left:auto;margin-right:auto;margin-top:50px;padding-top:0px;padding-left: 0px;padding-right: 0px;' >";
		output += "<div class='tituloCriterio' style='height:52px;border-radius:20px;";
		output += "background-image: linear-gradient(bottom, rgb(100,100,100) 30%, rgb(140,140,140) 90%);";
		output += "background-image: -o-linear-gradient(bottom, rgb(100,100,100) 30%, rgb(140,140,140) 90%);";
		output += "background-image: -moz-linear-gradient(bottom, rgb(100,100,100) 30%, rgb(140,140,140) 90%);";
		output += "background-image: -webkit-linear-gradient(bottom, rgb(100,100,100) 30%, rgb(140,140,140) 90%);";
		output += "'>";
		output += "<td>";
		output += "<td>";
		output += "<img src='assets/botones/btnSalir.png' onClick='vista.btnsalirPromt_onClick();' style='float:right;cursor:pointer;width:48px;height:48px;'";
		output += "  >";
		output += "</td>";
		output += "<img src='assets/botones/imgConsulta.png' onClick='vista.btnconsultaPrompt_onClick();' style='float:right;cursor:pointer;width:48px;height:48px;'>";
		output += "</td>";
		output += "</div>";
			output += "<div class='contCriterios2' id='contCriterios2' style='height:370'>";
			output += "<table WIDHT=25%; HEIGHT=35%;  CELLPADDING=0; cellspacing='15' style='padding-top: 1px; padding-left: 1%; position:relative;display:block;'>";  
			output += "<td>";
			output += "<tr>";	
			output += "<td>";
			output += "<label style='position: relative; left: 15px'>Id Proyecto:</label>";
			output += "</td>"
			output += "<td>";
		output += "	<input  id='idCriterioAsistenteInput' type='text' style='left: 80px;box-shadow: 2px 2px 5px #999;' width:100px;'/>";
			output += "</td>"	
		output += "</tr>";
		output += "<tr>";
		output += "<td>";
		output += "<label style='position: relative; left: 15px'>Nombre Proyecto:</label>";
			output += "</td>"
			output += "<td>"
		output += "	<input id='dscCriterioAsistenteInput' type='text' style='right:3%;box-shadow: 2px 2px 5px #999;' width:100px;'>" ;
		output += "</td>";
		output += "</tr>";
		output += "</td>";
		output += "</table>";
		
			
			output +=" <div id='PromptProyectoGrid' class='gridPrompt' style='height:60%;width:491px;></div>";	
		
			
			output += "</div'>";
			
		output += "</div'>";
		output += "</div'>";*/
		document.getElementById("PromptProyecto").innerHTML = output;
		document.getElementById("PromptProyecto").style.display = "block";			
		document.getElementById("PromptProyecto").style.position = "fixed";
		

		this._gridListaArchivos = new GridReg("_gridListaArchivos");
		var columnas = [
			{longitud:180, titulo:"Id Proyecto", alias:"id", alineacion:"I"},
			{longitud:272, titulo:"Nombre Proyecto", alias:"agenteId", alineacion:"I"}
		];
		this._gridListaArchivos
		._origen="vista";
		this._gridListaArchivos._columnas = columnas;
		this._gridListaArchivos._ajustarAltura 		= true;
		this._gridListaArchivos._colorRenglon1 		= "#FFFFFF";
		this._gridListaArchivos._colorRenglon2 		= "#FFFFFF";
		this._gridListaArchivos._colorEncabezado1 	= "#CCC";
		this._gridListaArchivos._colorEncabezado2 	= "#CCC";
		this._gridListaArchivos._colorLetraEncabezado = "#444444";
		this._gridListaArchivos._colorLetraCuerpo 	= "#888888";
		this._gridListaArchivos._colorLetraCuerpo 	= "#888888";
		this._gridListaArchivos.manejadorEventos=this.manejadorEventos;
		this._gridListaArchivos._regExtra=5;
		this._gridListaArchivos.subscribirAEvento(this, "eventGridRowDoubleClick",vista.proyectoSelect);
		//this._gridListaArchivos._dataProvider = [];
		this._gridListaArchivos.setViewport("PromptProyectoGrid");
		this._gridListaArchivos.render();
		this.presentador.consultarPorProyecto();   
		
	}
	
	verDatosAsistenteR()
	{	
		var output = "";
		output += '<div class="col s12 m6" style="position: fixed; top: 0px; left: 0px; display: block; width: 100%; height: 100%; z-index: 5001; background-color: rgba(255, 255, 250, 0.95);" >'
		output += "<div class='container' id='PMenuAsistente' >";
		output += "<div class='nav-wrapper  grey darken-2 accent-3 z-depth-4'";
		output += "<td>";
		output += "<img src='assets/botones/btnSalir.png' onClick='vista.btnsalirPromt_onClick();'>";
		output += "</td>";
		output += "<td>";
		output += "<img src='assets/botones/imgConsulta.png' onClick='vista.btnconsultarPromptR_onClick();'>"
		output += "</td>";
		output += "</div>";
			output += "<div class='col s12' id='contCriterios2'>";
			output += "<div class='row' >";  
			output += "<a>Id:</a>";
		output += "	<input  id='idCriterioAsistenteInput' class='input'/>";
		output += "<a>Nombre Usuario:</a>";
		output += "	<input id='dscCriterioAsistenteInput' class='input'>" ;
		output += "</div>";
		
			
			output +=" <div id='PromptUsuarioRGrid' class='col s12' ></div>";	
		
			
			output += "</div'>";
			
		output += "</div'>";
		output += "</div'>";

		/*
		var output = "";
		output += '<div style="position: fixed; top: 0px; left: 0px; display: block; width: 100%; height: 100%; z-index: 5001; background-color: rgba(255, 255, 250, 0.75);" >'
		output += "<div class='panelAsistenteFRM' id='PMenuAsistente' style='width:520px;background-color:#BCBCBC;height:auto; margin-left:auto;margin-right:auto;margin-top:50px;padding-top:0px;padding-left: 0px;padding-right: 0px;' >";
		output += "<div class='tituloCriterio' style='height:52px;border-radius:20px;";
		output += "background-image: linear-gradient(bottom, rgb(100,100,100) 30%, rgb(140,140,140) 90%);";
		output += "background-image: -o-linear-gradient(bottom, rgb(100,100,100) 30%, rgb(140,140,140) 90%);";
		output += "background-image: -moz-linear-gradient(bottom, rgb(100,100,100) 30%, rgb(140,140,140) 90%);";
		output += "background-image: -webkit-linear-gradient(bottom, rgb(100,100,100) 30%, rgb(140,140,140) 90%);";
		output += "'>";
		output += "<td>";
		output += "<td>";
		output += "<img src='assets/botones/btnSalir.png' onClick='vista.btnsalirPromt_onClick();' style='float:right;cursor:pointer;width:48px;height:48px;'";
		output += "  >";
		output += "</td>";
		output += "<img src='assets/botones/imgConsulta.png' onClick='vista.btnconsultarPromptR_onClick();' style='float:right;cursor:pointer;width:48px;height:48px;'>";
		output += "</td>";
		output += "</div>";
			output += "<div class='contCriterios2' id='contCriterios2' style='height:370'>";
			output += "<table WIDHT=25%; HEIGHT=35%;  CELLPADDING=0; cellspacing='15' style='padding-top: 1px; padding-left: 1%; position:relative;display:block;'>";  
			output += "<td>";
			output += "<tr>";	
			output += "<td>";
			output += "<label style='position: relative; left: 15px'>Id:</label>";
			output += "</td>"
			output += "<td>";
		output += "	<input  id='idCriterioAsistenteInput' type='text' style='left: 80px;box-shadow: 2px 2px 5px #999;' width:100px;'/>";
			output += "</td>"	
		output += "</tr>";
		output += "<tr>";
		output += "<td>";
		output += "<label style='position: relative; left: 15px'>Nombre Agente:</label>";
			output += "</td>"
			output += "<td>"
		output += "	<input id='dscCriterioAsistenteInput' type='text' style='right:3%;box-shadow: 2px 2px 5px #999;' width:100px;'>" ;
		output += "</td>";
		output += "</tr>";
		output += "</td>";
		output += "</table>";
		
			
			output +=" <div id='PromptUsuarioRGrid' class='gridPrompt' style='height:60%;width:491px;></div>";	
		
			
			output += "</div'>";
			
		output += "</div'>";
		output += "</div'>";*/
		document.getElementById("PromptUsuarioR").innerHTML = output;
		document.getElementById("PromptUsuarioR").style.display = "block";			
		document.getElementById("PromptUsuarioR").style.position = "fixed";
		

		this._gridListaArchivos = new GridReg("_gridListaArchivos");
		var columnas = [
			{longitud:180, titulo:"Id", alias:"id", alineacion:"I"},
			{longitud:272, titulo:"Nombre Agente", alias:"nayeagenteId", alineacion:"I"}
		];
		this._gridListaArchivos
		._origen="vista";
		this._gridListaArchivos._columnas = columnas;
		this._gridListaArchivos._ajustarAltura 		= true;
		this._gridListaArchivos._colorRenglon1 		= "#FFFFFF";
		this._gridListaArchivos._colorRenglon2 		= "#FFFFFF";
		this._gridListaArchivos._colorEncabezado1 	= "#CCC";
		this._gridListaArchivos._colorEncabezado2 	= "#CCC";
		this._gridListaArchivos._colorLetraEncabezado = "#444444";
		this._gridListaArchivos._colorLetraCuerpo 	= "#888888";
		this._gridListaArchivos._colorLetraCuerpo 	= "#888888";
		this._gridListaArchivos.manejadorEventos=this.manejadorEventos;
		this._gridListaArchivos._regExtra=5;
		this._gridListaArchivos.subscribirAEvento(this, "eventGridRowDoubleClick",vista.usuarioSelectR);
		//this._gridListaArchivos._dataProvider = [];
		this._gridListaArchivos.setViewport("PromptUsuarioRGrid");
		this._gridListaArchivos.render();
		this.presentador.consultarPorUsuarioR();   
		
	}
	
	
	usuarioSelectR()
	{
		
		$('#usuarioRealizadorFormularioInputt').val(this._gridListaArchivos._selectedItem.id);
		$('#usuarioRealizadorFormularioInput').val(this._gridListaArchivos._selectedItem.nayeagenteId);
		$('#principalDiv').hide()	
		$('#formularioDiv').show();
		this.mostrarFormulario();

	 }  
}
var vista = new TicketsVista(this);

