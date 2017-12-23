<?php
include 'php/clases/Utilidades.php';

$modulo = REQUEST('CNMDLSID');
$opcionTerminal = REQUEST('CNOTRMID');
$version = REQUEST('CNOTRMVER');
$usuario = REQUEST('CNUSERID');
$nomTrabajador = REQUEST('CNUSERDESC');
$usuarioDsc = REQUEST('CNUSERDESC');
$CNUSERDESC = REQUEST('CNUSERDESC');


?>
<html> 
<title>BSTN_SYS</title>
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<script language="JavaScript" type="text/javascript" src="js/librerias/jquery-1.6.2.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="js/librerias/jquery-ui-1.8.16.custom.min.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/json2.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/AjaxContextHandler.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/Ajaxv2.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/prototype.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/funcionesFechas.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/funciones.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/funcionesColores.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/constantes.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/Eventos.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/librerias/Base.js"></script> 

	<script language="JavaScript" type="text/JavaScript" src="js/librerias/cargador.js"></script>
<!-- 	<script language="JavaScript" type="text/JavaScript" src="js/librerias/jquery.min.js"></script> -->
 	<script language="JavaScript" type="text/JavaScript" src='js/librerias/Datapickerjs/ui.core.js'></script>
	<script language="JavaScript" type="text/JavaScript" src='js/librerias/Datapickerjs/ui.datepicker.js'></script>
	<script language="JavaScript" type="text/JavaScript" src='js/librerias/Datapickerjs/ui.datepicker-es.js'></script> 
	
	<script language="JavaScript" type="text/JavaScript" src="js/componentes/GridReg.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/componentes/Combo.js"></script>
	
	<!-- Llamado de prompts
	<script language="JavaScript" type="text/javascript" src="../GV/prompts/PromptConcepto.js">  </script>
	<script language="JavaScript" type="text/javascript" src="../GV/prompts/PromptVerficador.js"></script> 
	-->
	
	<link type='text/css' href='js/librerias/Datapickerjs/ui.datepicker.css' rel='stylesheet' />
	<link type='text/css' href='js/librerias/Datapickerjs/demos.css' rel='stylesheet' />
	<link type='text/css' href='js/librerias/Datapickerjs/ui.all.css' rel='stylesheet' />

	<!--Estilo-->
    <link href="css/estilo.css" media="handheld, screen" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="css/imagenes/faviSIO.png">
    
   
    <script language="JavaScript" type="text/JavaScript" src="js/repositorios/usuariosMS_repositorio.js"></script>
    <script language="JavaScript" type="text/JavaScript" src="js/presentadores/usuariosMS_presentador.js"></script>
	<script language="JavaScript" type="text/JavaScript" src="js/vistas/usuariosMS_vista.js"></script>

    
</head>

<body  bgcolor="#e8e8e8" onLoad="vista.onLoad()" style="overflow: auto;height: 89%;">
<div id="dialogo" title="Di�logo" style="display:none;">
</div>
<form id="form">
	<div id="principalDiv">
		
		<div id="debug" width="100%" style="display:none">
				<input type="hidden" id="RPFREPFINCNMDLSID"  name="RPFREPFINCNMDLSID"   value ='<?php echo $modulo; ?>'/>
				<input type="hidden" id="RPFREPFINCNOTRMID"  name="RPFREPFINCNOTRMID"   value ='<?php echo $opcionTerminal; ?>'/> 
				<input type="hidden" id="RPFREPFINCNOTRMVER" name="RPFREPFINCNOTRMVER"  value ='<?php echo $version; ?>'/>
				<input type="hidden" id="CNUSERID"           name="CNUSERID"            value ='<?php  echo $usuario; ?>>'/> 
				<input type="hidden" id="CNUSERDESC"           name="CNUSERDESC"            value ='<?php  echo $CNUSERDESC; ?>'/>    
		</div>
		
		<div id="estiloBotonesPeque" class="estiloBotonesPeque">
			<div id="contieneTuberiaIzq" class="contieneTuberiaIzq">
				<img src='assets/pantalla/logoTipo.png' style="position:absolute; "/>
			</div>
			<div id="contieneCriteriosAriba" class="contieneCriteriosAriba">
				<div id="contieneCriteriosAribaBtn" class="contieneCriteriosAribaBtn">
					<div id="PMenu" align="center">
						<div id="botones" style="width:auto;overflow:auto;">
							<table class="tablaBotonesIEC">
								<tr>
									<td><img id="btnAlta" class="botonMenuIEC" title="Alta" src="css/imagenes/imgAlta.png" onClick="vista.btnAlta_onClick();"></td>
									<td><img id="btnBaja" class="botonMenuIEC" title="Baja" src="css/imagenes/imgBaja.png" onClick="vista.btnBaja_onClick();"></td>
									<td><img id="btnCambio" class="botonMenuIEC" title="Cambio" src="css/imagenes/imgCambio.png" onClick="vista.btnCambio_onClick();"></td>
									<td><img id="btnConsulta" class="botonMenuIEC" title="Consulta" src="css/imagenes/imgConsulta.png" onClick="vista.btnConsulta_onClick();"></td>
									<td><img id="btnSalir" class="botonMenuIEC" title="Salir"  src="css/imagenes/btnSalir.png" onClick="vista.btnSalir_onClick();" ></td>
								</tr>
                             </table>   
						</div>
						<div id="titulo" style="margin-left:280px;" class="tituloIEC">BSTN_SYS</div>
					</div>
				</div>
            </div>        
	     </div>
	     
		 <div id="estiloBotonesInferior" class="estiloBotonesInferior" align="center">
				<div id="criteriosMetaT2" class="criteriosMeta">
					<div id="criteriosSeleccion0_t2" style="float:left; margin-top: 6px; margin-left: 10px;">
						<div>
							<table style="position:relative;left:40px; text-align:left; margin-top:10px; margin-bottom:10px;">
								<tr>
									<td style="padding:6px 0px 4px 10px;">		<label  style="font-family: Verdana; font-size: 10px;"> Agente</label></td>									
									<td style="padding:6px 0px 4px 10px;">		<input  id='agenteCriterioInput' type='text' style='height: 20px; width:200px;'/></input></td>
									<td style="padding:6px 0px 4px 10px;">		<label  style="font-family: Verdana; font-size: 10px;">Descripcion</label></td>
									<td style="padding:6px 0px 4px 10px;">		<input  id='dscCriterioInput' type='text' style='height: 20px; width:200px;'/></input></td>	
									<td style="padding:6px 0px 4px 10px;">		<label  style="font-family: Verdana; font-size: 10px;">Direccion</label></td>
									<td style="padding:6px 0px 4px 10px;">		<input  id='direccionCriterioInput' type='text' style='height: 20px; width:200px;'/></input></td>		
								</tr>
								
							</table>
						</div>
					</div>
					
			
                </div>
		  </div>
		  
	       <div id="cargador" style="position:absolute;"></div>
		
			<div id="Pcontenido" style="position:relative;">            
				<div id="tabs" class="PcontenComp" style="display:block;"></div>
				<div id="paneles" class="PcontenComp" style="margin: auto; padding-left: 10px; padding-top: 0px; width: 99.5%; height: 90%; overflow: visible; position: relative;">
					<div id="panelesArea0" style="float:left; height:98%; width:98.5%;">
						<div id="panelesArea0paneles" class="PcontenComp" style="">
							<div id="panelesArea0panel0" class="contenedorIEC" style="width: 100%; height: 99.5%; z-index: 1; float: left; margin-right: 2px; margin-bottom: 2px; margin-left: 2px; overflow: hidden;">
								<div id="panelesArea0panel0barra" class="barracomandosContenedorIEC" style="position:relative;">
									<span id="panelesArea0panel0Titulo" class="tituloContenedorIEC"></span>	
								</div>
								<div id="panelesArea0panel0componentes" style="width:99%;height:99%;overflow:hidden;position:relative;">
                                	<div id="panelesArea0panel0componente0" style='overflow: auto; position:static;height:98%; width:100%; top:10px;left:3px;'>
                                	 		<div id="grid" style="float:left; overflow: auto; position:static; height:95%; width:100%; display: block; top:5px;left:3px;"></div>                						
                            		</div>
                           		</div>                                
							</div>
						</div>
					</div>					
				</div>								
			</div>	
    </div>
    
    

<div id="formularioDiv" style="display:none ;height: 90%;">
		<div>
			
<!--  barra de men� para botones de la pantalla
 -->
			<div id="menuPrincipal"  align="right" class="contieneCriteriosAribaBtn" style="background-color: #6b6b6b;    height: 56px; " > 
				<img class='logoBAS' style='float: left;' id='logoFRM' src='assets/pantalla/logoTipo.png'  />
				<span id="txtTitulo" style="float:left;margin-top: 20px;margin-left: 15px;color: #FFFFFF;float: left;font-family: Verdana;font-size: 11px;font-weight: bold;">Catálogo de clientes</span>
				<img style="padding: 2px;" class='imgTipoBoton' id='btnGuardarFormulario' src='css/imagenes/imgGuardar.png' onclick='vista.btnGuardarFormulario_onClick();' title='Guardar' />
				<img style="padding: 2px;" class='imgTipoBoton' id='btnSalirFormulario' src='css/imagenes/btnSalir.png' onClick="vista.btnSalirFormulario_onClick();" title='Salir'  />
			</div>
<!--
  barra de men�...fin
 -->
			
<!--barra principal -->
			<div id="cargador" class="cargadorFRM2"></div>
				<div class="pContenido" id="estadoEstructura" >
						<div class="contenidoNormalUS">
					 		<div class="explicacionFRM" >
								<div id="filtros " class="contenedorIEC" style="overflow: auto; position: relative; width: 100%; display: block;">
								 <div style="width: 80%; display: block; height: 100%;  padding-top: 10px; padding-left: 34px;">								 	
								   <table WIDHT=25%; HEIGHT=150%;  CELLPADDING=0; cellspacing="10" style="padding-top: 12px; padding-left: 1%; position:relative;display:inline-block; border: #ff6600 1px solid;">
								       <tr>
            		          			<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Agente</label>
								   		</td>
								   		<td >
								     		<input class="input" id="agenteFormularioInput" type="text" maxlength="20" value="" style="width:100px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								    	<td >
								     		<label style="position: relative; left: 3px; ">Descripcion</label>
								   		</td>
								   		<td >
								     		<input class="input" id="dscFormularioInput" descripcion="Primer nombre" style="width:250px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px; box-shadow: 2px 2px 5px #999;"/>
								   		</td>
								   		</tr>
								     	<tr>
								   		<td><button style="width:130px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: inherit; left: 6px; box-shadow: 2px 2px 5px #999;">Aplicar Restricciones</button></td>
								   		<td><button style="width:130px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: inherit; left: 6px; box-shadow: 2px 2px 5px #999;">Desaplicar Restricciones</button></td>
								   		<td><button style="width:130px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: inherit; left: 6px; box-shadow: 2px 2px 5px #999;">Ver restricciones de uso</button></td>
								   		<td></td>
								   		<td></td>
								   		<td></td>
								   		<td>	
								     		<label style="position: relative; left: 3px; ">Clase</label>
								   		</td>
								   		<td >
								     		<select class="input" id="claseFormularioInput" descripcion="Primer nombre" style="width:250px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px; box-shadow: 2px 2px 5px #999;"></select>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Contraseña</label>
								   		</td>
								   		<td >
								     		<input class="input" id="passwordFormularioInput" type="text" maxlength="20" value="" style="width:150px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								   		</td>
								   		<td>
								   		</td>
								   		<td >
								     		<input type="checkbox" id="idFormularioInput" type="text" maxlength="20" value="" style="width:70px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								     		 <label style=" width:130px;display: block;  position: relative; left: 3px; ">Permitir multiples sesiones</label>
								   		</td>
								   		<td >
								     		<input type="radio" id="idFormularioInput" type="text" name="radio" maxlength="20" value="" style="width:20px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Usuario sin activar</label>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Confirmar contraseña</label>
								   		</td>
								   		<td >
								     		<input class="input" id="cPasswordFormularioInput" type="text" maxlength="20" value="" style="width:150px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								   		</td>
								   		<td>
								   		</td>
								   		<td >
								     		<input type="checkbox" id="idFormularioInput" type="text" maxlength="20" value="" style="width:70px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								     		 <label style=" width:130px; position: relative; left: 3px; ">Validar con catalogo de colaboradores</label>
								   		</td>
								   		<td >
								     		<input type="radio" id="idFormularioInput" name="radio" type="text" maxlength="20" value="" style="width:20px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Usuario activo</label>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td>
								     		 <label style=" width:130px; position: relative; left: 3px; ">Direccion</label>
								   		</td>
								   		<td >
								     		<input class="input" id="direccionFormularioInput" type="text" maxlength="20" value="" style="width:150px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								   		</td>
								   		<td>
								   		</td>
								   		<td >
								     		<input type="checkbox" id="idFormularioInput" type="text" maxlength="20" value="" style="width:70px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								     		 <label style=" width:130px; position: relative; left: 3px; ">Trabajar con mensajes colaborativos</label>
								   		</td>
								   		<td >
								     		<input type="radio" id="idFormularioInput" name="radio" type="text" maxlength="20" value="" style="width:20px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Usuario dado de baja</label>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td>
								     		 <label style=" width:130px; position: relative; left: 3px; ">Idioma</label>
								   		</td>
								   		<td >
								     		<input class="input" id="idiomaFormularioInput" type="text" maxlength="20" value="" style="width:150px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								   		</td>
								   		<td>
								   		</td>
								   		<td >
								     		<input type="checkbox" id="idFormularioInput" type="text" maxlength="20" value="" style="width:70px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								     		 <label style=" width:130px; position: relative; left: 3px; ">Trabajar con actividades del BPM</label>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">CURP</label>
								   		</td>
								   		<td >
								     		<input class="input" id="curpFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">RFC</label>
								   		</td>
								   		<td >
								     		<input class="input" id="rfcFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td >
								     		<input type="checkbox" id="idFormularioInput" type="text" maxlength="20" value="" style="width:70px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								     		 <label style=" width:130px; position: relative; left: 3px; ">Usuario administrador</label>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">NSS</label>
								   		</td>
								   		<td >
								     		<input class="input" id="nssFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								   		</td>
								   		<td>
								   		</td>
								   		<td >
								     		 <label style=" width:130px; display: block; position: relative; left: 3px; ">Numero asociado para pagina de colaboradores internos</label>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Telefono 1</label>
								   		</td>
								   		<td >
								     		<input class="input" id="ptelFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Telefono 2</label>
								   		</td>
								   		<td >
								     		<input class="input" id="stelFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Campo</label>
								   		</td>
								   		<td >
								     		<input class="input" id="idFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Extension 1</label>
								   		</td>
								   		<td >
								     		<input class="input" id="extFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		<td>
								   		</td>
								   		<td>
								   		</td>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Campo caracter</label>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Extension del marcador</label>
								   		</td>
								   		<td >
								     		<input class="input" id="extMarcadorFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
                                       <td>
                                       </td>
                                       <td>
                                       </td>
                                        <td>
                                          
								     		 <label style=" width:130px; position: relative; left: 3px; ">Campo</label>
								     		  </td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Correo electronico</label>
								   		</td>
								   		<td >
								     		<input class="input" id="correoFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
                                       <td>
                                       </td>
                                       <td>
                                       </td>
                                        <td>
                                             <textarea textarea name="dscFormularioInput" rows="20" cols="50" class="input" id="dscFormularioInput" descripcion="RecesoLargo" style="text-align:left; color:#006699;position: absolute; left: auto; box-shadow: 2px 2px 5px #999;"/></textarea>
                                       </td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Contrase�a del correo</label>
								   		</td>
								   		<td >
								     		<input class="input" id="passwordCFormularioInput" type="text" maxlength="20" value="" style="width:90px; font-family:Verdana; font-size:9px;text-align:left; color:#006699;position: relative; left: 6px;"/>
								   		</td>
								   		</tr>
								   		<tr>
								   		<td >
								     		 <label style=" width:130px; position: relative; left: 3px; ">Firma del correo</label>
								   		</td>								   		
								   		</tr>
								   		<tr>
                                        <td>
                                             <textarea textarea name="firmaCorreoFormularioInput" rows="12" cols="93" class="input" id="dscFormularioInput" descripcion="RecesoLargo" style="text-align:left; color:#006699;position: absolute; left: auto; box-shadow: 2px 2px 5px #999;"/></textarea>
                                       </td>
								   		</tr>
    								    </table>
									</div>
									
								 </div>
								</div>				  	
							</div>
						</div>
				</div>
		</div>
		<div class='ventana' id='PromptListaDistribucion' style='display: none; z-index:9001;'></div>
		<div class='ventana' id='_promptRelacionReporte' style='display: none;'></div>
		<div class='ventana' id='PromptCalendario' style='display: none; z-index:9001;'></div>  
		<div class='ventana' id='promptListaRelaciones' style='display: none;'></div>
		<div class='ventana' id='PromptPlantilla' style='display: none; z-index:9001;'></div>
		<div class='ventana' id='PromptCorreo' style='display: none;'></div>
		<div class='ventana' id='PromptSentencia' style='display:none; z-index:9001;'></div>
		<div class='ventana' id='PromptCriterioSeleccion' style='display:none; z-index:9001;'></div>    
</div>

    
    
    
    
    
    
    
    
</form>
</body>
</html>