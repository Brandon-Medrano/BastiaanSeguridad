class UsuariosVistaMS
{		
	constructor(ventana)
	{	
		this.ventana = ventana;
		this.presentador = new UsuariosPresentadorMS(this);
		this.manejadorEventos = new ManejadorEventos();
		this.grid = new GridReg("grid");	
	}
	onLoad()
	{			
		this.crearColumnasGrid();
		this.presentador.consultar();
	}
	
	crearColumnasGrid()
	{
		this.grid._columnas = [
			{longitud:100, 	titulo:"Id",   	alias:"id", alineacion:"I" }, 
			{longitud:130, 	titulo:"Descripcion",   	alias:"dsc", alineacion:"I" }, 
			{longitud:150, 	titulo:"Password",   alias:"password", alineacion:"I" }, 
			{longitud:150, 	titulo:"Direccion",   alias:"direccion", alineacion:"I" }, 
			{longitud:150, 	titulo:"Idioma",   alias:"idioma", alineacion:"I" },	
			{longitud:150, 	titulo:"CURP",   alias:"curp", alineacion:"I" },	
			{longitud:200, 	titulo:"RFC",   alias:"rfc", alineacion:"I" },
			{longitud:250, 	titulo:"NSS",   alias:"nss", alineacion:"I" },
			{longitud:150, 	titulo:"Primer telefono",   alias:"ptel", alineacion:"I" }, 
			{longitud:150, 	titulo:"Segundo telefono",   alias:"stel", alineacion:"I" }, 
			{longitud:150, 	titulo:"Extension",   alias:"ext", alineacion:"I" },	
			{longitud:150, 	titulo:"Extension del marcador",   alias:"extmarcador", alineacion:"I" },	
			{longitud:200, 	titulo:"Correo",   alias:"correo", alineacion:"I" },
			{longitud:250, 	titulo:"Contraseña del correo",   alias:"passwordc", alineacion:"I" },

		]
		
		this.grid._origen="vista";
		this.grid.manejadorEventos=this.manejadorEventos;
		this.grid._ajustarAltura = true;
		this.grid._colorRenglon1 = "#FFFFFF";	
		this.grid._colorRenglon2 = "#f8f2de";
		this.grid._colorEncabezado1 = "#FF6600";
		this.grid._colorEncabezado2 = "#FF6600";
		this.grid._colorLetraEncabezado = "#ffffff";
		this.grid._colorLetraCuerpo = "#000000";
		this.grid._regExtra=20;
		this.grid.render();		
	}
	
	/*
	 * Eventos en botones
	*/
	
	btnAlta_onClick()
	{
		this.modo = "ALTA";
		this.limpiarFormulario();	
		this.mostrarFormulario();
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
			this.mostrarFormulario();		
			this.presentador.consultarPorLlaves();
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
		this.presentador.consultarPorPostal();
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
	
	/*
	 * Valores de los criterios de selección
	 */
	
	get criteriosSeleccion()
	{
		 var criteriosSeleccion = 
		 {				    
			agente:$('#agenteCriterioInput').val(),
			dsc:$('#dscCriterioInput').val(),
			clase:$('#direccionCriterioInput').val()
		 }
		 return criteriosSeleccion;
	}		
	
	
	/*
	 * Asignar registros al grid
	 */
	
	set datos(valor)
	{
		this.grid._dataProvider = valor;	
		this.grid.render();
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
	
	set usuarioMS(valor)
	{		
		$('#agenteFormularioInput').val(valor.id);
		$('#dscFormularioInput').val(valor.dsc);
		$('#passwordFormularioInput').val(valor.password);
		$('#direccionFormularioInput').val(valor.direccion);
		$('#idiomaFormularioInput').val(valor.idioma);
		$('#curpFormularioInput').val(valor.curp);
		$('#rfcFormularioInput').val(valor.rfc);
		$('#nssFormularioInput').val(valor.nss);
		$('#ptelFormularioInput').val(valor.ptel);
		$('#stelFormularioInput').val(valor.stel);
		$('#extFormularioInput').val(valor.ext);
		$('#extMarcadorFormularioInput').val(valor.extmarcador);
		$('#correoFormularioInput').val(valor.correo);
		$('#passwordCFormularioInput').val(valor.passwordc);
	}
	
	get usuarioMS()
	{
		 var usuarioMS = 
		 {				    
			 id:$('#agenteFormularioInput').val(),
			 dsc:$('#dscFormularioInput').val(),
			 password:$('#passwordFormularioInput').val(),
			 direccion:$('#direccionFormularioInput').val(),
			 idioma:$('#idiomaFormularioInput').val(),
			 curp:$('#curpFormularioInput').val(),
			 rfc:$('#rfcFormularioInput').val(), 
			 nss:$('#nssFormularioInput').val(),
			 ptel:$('#ptelFormularioInput').val(),
			 stel:$('#stelFormularioInput').val(),
			 ext:$('#extFormularioInput').val(),
			 extmarcador:$('#extMarcadorFormularioInput').val(),
			 correo:$('#correoFormularioInput').val(), 
			 passwordc:$('#passwordCFormularioInput').val()
		 };
		 return usuarioMS;
	 }
	
	mostrarMensaje(titulo,mensaje)
	{
		alert(mensaje);	
	}
	
	mostrarFormulario()
	{
		$('#principalDiv').hide();
		$('#formularioDiv').show();
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
		$('#idFormularioInput').val("");
		$('#aliasFormularioInput').val("");
		$('#primerNombreFormularioInput').val("");
		$('#segundoNombreFormularioInput').val("");
		$('#apellidoPaternoFormularioInput').val("");
		$('#apellidoMaternoFormularioInput').val("");
		$('#correoElectronicoPersonalFormularioInput').val("");
		$('#telefonoCelularFormularioInput').val("");
	}
}
var vista = new UsuariosVistaMS(this);

