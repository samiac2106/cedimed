
<?php

/* if (empty($_SESSION['active'])){
  header('location: ../');
} */
?>
<style>


</style>
<header>
		<div class="header">
			<img id="logo" src="../img/cedimed-icono.png" alt="">
			<h1>Sistema de Citas Cedimed</h1>
			<div class="optionsBar">
				<p>Medellin, <?php echo fechaC() ;?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['nombre'].' ('.$_SESSION['rol'].')'; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="../salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
		<?php include "nav.php"?>

		
	</header>

	<div class="paciente">
	
    <div class="pacientemodal">
<form action="" >
<!-- <a href="#" onclick="closeinfo()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<table >
<tr >
        <td><b>Paciente Nro</b></td>
        <td id="idcliente"></td>
    </tr>
    <tr >
        <td> <b>Fecha de Creación</b>   </td>
        <td id="fecha_ingreso"></td>
    </tr>
    <tr >
        <td><b>Tipo Documento</b></td>
        <td id="tipodoc"></td>
    </tr>
    <tr >
        <td><b>Nro Documento</b></td>
        <td id="num_identificacion"></td>
    </tr>
    <tr >
        <td><b>Nombre</b></td>
        <td id="nombre"></td>
    </tr>
    <tr >
    <td><b>Sexo</b></td> 
        <td id="sexo"></td>
    </tr>
    <td><b>Telefono</b></td> 
        <td id="telefono"></td>
    </tr>
    <tr >
        <td><b>Entidad</b></td>
        <td id="entidad"></td>
    </tr>
    <tr >
        <td><b>Asesor</b></td>
        <td id="usuario"></td>
    </tr>
</table>
<hr>
  <h3><center> Última Modificación del Paciente</center></h3> 
<table>
    <tr>
        <td><b>Asesor</b></td>
        <td id="usuarioact"></td>
    </tr>
    <tr>
        <td><b>Fecha <br> Actualización</b></td>
        <td id="fecha_actualizacion"></td>
    </tr>
</table>
<!-- <a href="#" onclick="closeinfo()" class="btn_new" style="margin: auto 10vh; background-color: #8ebbcd;	color: #196783;">cerrar</a> -->

</form>

    </div>	
</div>








<div class="admision">
	
    <div class="admisionmodal">
<form action="" >
<!-- <a href="#" onclick="closeadmision()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<table >
    <td><b>Estado Admisión</b></td> 
        <td id="estado"></td>
    </tr>
    <tr >
        <td> <b>Nro Cita</b>   </td>
        <td id="nro_cita"></td>
    </tr>
    <tr >
        <td><b>Cod Autorización</b></td>
        <td id="cod_autorizacion"></td>
    </tr>
    <tr >
        <td><b>Copago</b></td>
        <td id="copago"></td>
    </tr>
    <tr >
        <td><b>Valor Copago</b></td>
        <td id="valor_copago"></td>
    </tr>
    <tr >
    <td><b>Observaciones</b></td> 
        <td id="observaciones"></td>
    </tr>
    <td><b>Usuario Admisiones</b></td> 
        <td id="usuario_admisiones"></td>
    </tr>

    
    
</table>

<!-- <a href="#" onclick="closeinfo()" class="btn_new" style="margin: auto 10vh; background-color: #8ebbcd;	color: #196783;">cerrar</a> -->

</form>

    </div>	
</div>



<!-- estado cita -->

<div class="cita">
	
    <div class="citamodal">
<form action="" >
<!-- <a href="#" onclick="closecita()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<table >
    <td><b>Estado Cita</b></td> 
        <td id="estado_cita"></td>
    </tr>
    <tr >
        <td> <b>Nro Cita</b>   </td>
        <td id="nro_citas"></td>
    </tr>
    <tr >
        <td><b>Pendiente</b></td>
        <td id="pendiente"></td>
    </tr>
    <tr >
        <td><b>Gestion</b></td>
        <td id="gestion"></td>
    </tr>
    <tr >
        <td><b>Observaciones</b></td>
        <td id="observaciones_pendiente"></td>
    </tr>
    
    
    
</table>

<!-- <a href="#" onclick="closeinfo()" class="btn_new" style="margin: auto 10vh; background-color: #8ebbcd;	color: #196783;">cerrar</a> -->

</form>

    </div>	
</div>


<!-- modificar gestion del estado pendientes de citas -->

<div class="gestion">
	
    <div class="gestionmodal">
<form action="" method="POST" name="formulario_gestion" id="formulario_gestion" onsubmit="event .preventDefault(); SendGestion();">
<!-- <a href="#" onclick="closegestion()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<center>
       <div><h3>Nro Cita</h3></div>   
      <div id="nro_cita_gestion" style="font-weight: bold; font-size: 20px"></div>
   <input type="hidden" name="cita_gestion" id="cita_gestion" required>
   <input type="hidden" name="action" id="addGestion" required></input>
   
  
<h4 style="font-weight: bold;">Gestión</h4></center>
<textarea name="txtgestion" id="txtgestion" cols="30" rows="6"></textarea>
<div class="mensajeguardado"></div>
<center><div >
<button type="submit" value=""class="btn-emergente" >Guardar</button>

<!-- <button href="" onclick="closegestion()" class="btn-emergente">Cerrar</button> -->
</div></center>
</form>

    </div>	
</div>



<!-- pasar a estado pendiente -->

<div class="pendiente">
	
    <div class="pendientemodal">
<form action="" method="POST" name="formulario_pendiente" id="formulario_pendiente" onsubmit="event .preventDefault(); SendPendiente();">
<!-- <a href="#" onclick="closependiente()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<center>
       <div><h3>Nro Cita</h3></div>   
      <div id="nro_cita_pendiente" style="font-weight: bold; font-size: 20px"></div>
   <input type="hidden" name="cita_pendiente" id="cita_pendiente" required>
   <input type="hidden" name="action" id="addPendiente" required></input>
   
  
<h4 style="font-weight: bold;">Pendiente</h4>
<h6 >Información del motivo por la cual queda pendiente</h6></center>
<textarea name="txtpendiente" id="txtpendiente" cols="30" rows="6"></textarea>
<div class="mensajeguardadopendiente"></div>
<center><div >
<button type="submit" value=""class="btn-emergente" >Guardar</button>

<!-- <button href="" onclick="closependiente()" class="btn-emergente">Cerrar</button> -->
</div></center>
</form>

    </div>	
</div>

<!-- pasar a estado finalizado -->

<div class="finalizado">
	
    <div class="finalizadomodal">
<form action="" method="POST" name="formulario_finalizado" id="formulario_finalizado" onsubmit="event .preventDefault(); SendFinalizado();">
<!-- <a href="#" onclick="closefinalizado()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<center>
       <div><h3>Nro Cita</h3></div>   
      <div id="nro_cita_finalizado" style="font-weight: bold; font-size: 20px"></div>
   <input type="hidden" name="cita_finalizado" id="cita_finalizado" required>
   <input type="hidden" name="action" id="addFinalizado" required></input>
   
  
<h4 style="font-weight: bold;">Gestionar Cita</h4>
<h6 >Desea Gestionar la Cita?</h6></center>
<textarea name="txtfinalizado" id="txtfinalizado" cols="30" rows="6" placeholder="Información de Finalizado (opcional)"></textarea>
<div class="mensajeguardadofinalizado"></div>
<center><div >
<button type="submit" value=""class="btn-emergente" >Guardar</button>

<button href="" onclick="closefinalizado()" class="btn-emergente">Cerrar</button>
</div></center>
</form>

    </div>	
</div>

<!-- pasar a estado cancelado -->

<div class="cancelado">
	
    <div class="canceladomodal">
<form action="" method="POST" name="formulario_cancelado" id="formulario_cancelado" onsubmit="event .preventDefault(); SendCancelado();">
<!-- <a href="#" onclick="closecancelado()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<center>
       <div><h3>Nro Cita</h3></div>   
      <div id="nro_cita_cancelado" style="font-weight: bold; font-size: 20px"></div>
   <input type="hidden" name="cita_cancelado" id="cita_cancelado" required>
   <input type="hidden" name="action" id="addCancelado" required></input>
   
  
<h4 style="font-weight: bold;">Cancelar Cita</h4>
<h6 >Desea Cancelar la Cita?</h6></center>
<textarea name="txtcancelado" id="txtcancelado" cols="30" rows="6" placeholder="Ingrese el motivo por cual se cancela"></textarea>
<div class="mensajeguardadocancelado"></div>
<center><div >
<button type="submit" value=""class="btn-emergente" >Guardar</button>

<!-- <button href="" onclick="closefinalizado()" class="btn-emergente">Cerrar</button> -->
</div></center>
</form>

    </div>	
</div>

<!-- pasar a estado finalizado de pendiente -->

<div class="finalizadop">
	
    <div class="finalizadopmodal">
<form action="" method="POST" name="formulario_finalizadop" id="formulario_finalizadop" onsubmit="event .preventDefault(); SendFinalizadop();">
<!-- <a href="#" onclick="closefinalizadop()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<center>
       <div><h3>Nro Cita</h3></div>   
      <div id="nro_cita_finalizadop" style="font-weight: bold; font-size: 20px"></div>
   <input type="hidden" name="cita_finalizadop" id="cita_finalizadop" required>
   <input type="hidden" name="action" id="addFinalizadop" required></input>
   
  
<h4 style="font-weight: bold;">Gestionar Cita (del Pendiente)</h4>
<h6 >Desea Gestionar la Cita?</h6></center>
<textarea name="txtfinalizadop" id="txtfinalizadop" cols="30" rows="6" placeholder="Información de Finalizado (opcional)"></textarea>
<div class="mensajeguardadofinalizadop"></div>
<center><div >
<button type="submit" value=""class="btn-emergente" >Guardar</button>

<!-- <button href="" onclick="closefinalizadop()" class="btn-emergente">Cerrar</button> -->
</div></center>
</form>

    </div>	
</div>


<!-- pasar a estado cancelado de pendiente-->

<div class="canceladop">
	
    <div class="canceladopmodal">
<form action="" method="POST" name="formulario_canceladop" id="formulario_canceladop" onsubmit="event .preventDefault(); SendCanceladop();">
<!-- <a href="#" onclick="closecanceladop()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<center>
       <div><h3>Nro Cita</h3></div>   
      <div id="nro_cita_canceladop" style="font-weight: bold; font-size: 20px"></div>
   <input type="hidden" name="cita_canceladop" id="cita_canceladop" required>
   <input type="hidden" name="action" id="addCanceladop" required></input>
   
  
<h4 style="font-weight: bold;">Cancelar Cita (del Pendiente)</h4>
<h6 >Desea Cancelar la Cita? </h6></center>
<textarea name="txtcanceladop" id="txtcanceladop" cols="30" rows="6" placeholder="Ingrese el motivo por cual se cancela"></textarea>
<div class="mensajeguardadocanceladop"></div>
<center><div >
<button type="submit" value=""class="btn-emergente" >Guardar</button>

<!-- <button href="" onclick="closefinalizadop()" class="btn-emergente">Cerrar</button> -->
</div></center>
</form>

    </div>	
</div>


<!-- gestion cita tabla pendiente-->

<div class="citag">
	
    <div class="citagmodal">
<form action="" >
<!-- <a href="#" onclick="closecitag()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<table >
    <td><b>Estado Cita</b></td> 
        <td id="estado_citag"></td>
    </tr>
    <tr >
        <td> <b>Nro Cita</b>   </td>
        <td id="nro_citasg"></td>
    </tr>
        <td><b>Gestion</b></td>
        <td id="gestiong"></td>
    </tr>
    <tr >
        <td><b>Usuario Actualización</b></td>
        <td id="usuario_actualizacion_gestion"></td>
    </tr>
    <tr >
        <td><b>Fecha Actualización</b></td>
        <td id="fecha_actualizacion_gestion"></td>
    </tr>
    
    
    
</table>

<!-- <a href="#" onclick="closeinfo()" class="btn_new" style="margin: auto 10vh; background-color: #8ebbcd;	color: #196783;">cerrar</a> -->

</form>

    </div>	
</div>

<!-- pasar a estado pendiente de admisiones-->

<div class="pendientead">
	
    <div class="pendienteadmodal">
<form action="" method="POST" name="formulario_pendientead" id="formulario_pendientead" onsubmit="event .preventDefault(); SendPendientead();">
<!-- <a href="#" onclick="closependiente()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<center>
       <div><h3>Nro Cita</h3></div>   
      <div id="nro_cita_pendientead" style="font-weight: bold; font-size: 20px"></div>
   <input type="hidden" name="cita_pendientead" id="cita_pendientead" required>
   <input type="hidden" name="action" id="addPendientead" required></input>
   
  
<h4 style="font-weight: bold;">Pendiente Admisiones</h4>
<h6 >Información del motivo por la cual queda pendiente</h6></center>
<textarea name="txtpendientead" id="txtpendientead" cols="30" rows="6"></textarea>
<div class="mensajeguardadopendientead"></div>
<center><div >
<button type="submit" value=""class="btn-emergente" >Guardar</button>

<!-- <button href="" onclick="closependiente()" class="btn-emergente">Cerrar</button> -->
</div></center>
</form>

    </div>	
</div>

<!-- pasar a estado finalizado de admisiones-->

<div class="finalizadoad">
	
    <div class="finalizadoadmodal">
<form action="" method="POST" name="formulario_finalizadoad" id="formulario_finalizadoad" onsubmit="event .preventDefault(); SendFinalizadoad();">
<!-- <a href="#" onclick="closefinalizado()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<center>
       <div><h3>Nro Cita</h3></div>   
      <div id="nro_cita_finalizadoad" style="font-weight: bold; font-size: 20px"></div>
   <input type="hidden" name="cita_finalizadoad" id="cita_finalizadoad" required>
   <input type="hidden" name="action" id="addFinalizadoad" required></input>
   
  
<h4 style="font-weight: bold;">Gestionar Cita (Admisiones)</h4>
<h6 >Desea Gestionar la Cita?</h6></center>
<div>
    <label for="codaut">Codigo Autorización</label>
    <input type="text" name="codaut" id="codaut" autocomplete="off">
</div>
<div>
<label for="copago">Paga Copago</label>
<select name="copago" id="copago">
    <option   selected value="0">Elija una Opción</option>
    <option value="si">Si</option>
    <option value="no">No</option>
</select>
<div>
    <label for="valor">Valor Copago</label>
    <input type="text" name="valor" id="valor" autocomplete="off">
</div>
</div>
<label for="txtfinalizadoad">Observaciones</label>
<textarea name="txtfinalizadoad" id="txtfinalizadoad" cols="30" rows="6" placeholder="Información de Finalizado (opcional)"></textarea>
<div class="mensajeguardadofinalizadoad"></div>
<center><div >
<button type="submit" value=""class="btn-emergente" >Guardar</button>

<!-- <button href="" onclick="closefinalizado()" class="btn-emergente">Cerrar</button> -->
</div></center>
</form>

    </div>	
</div>

<!-- pasar a estado finalizado de admisiones de pendiente-->

<div class="finalizadoadp">
	
    <div class="finalizadoadpmodal">
<form action="" method="POST" name="formulario_finalizadoadp" id="formulario_finalizadoadp" onsubmit="event .preventDefault(); SendFinalizadoadp();">
<!-- <a href="#" onclick="closefinalizado()" style=" margin: 0 0 0 95%; color: #196783;"><span class="glyphicon glyphicon-remove" style="font-size:20px;"></span></a> -->
<center>
       <div><h3>Nro Cita</h3></div>   
      <div id="nro_cita_finalizadoadp" style="font-weight: bold; font-size: 20px"></div>
   <input type="hidden" name="cita_finalizadoadp" id="cita_finalizadoadp" required>
   <input type="hidden" name="action" id="addFinalizadoadp" required></input>
   
  
<h4 style="font-weight: bold;">Gestionar Cita del Pendiente (Admisiones)</h4>
<h6 >Desea Gestionar la Cita?</h6></center>
<div>
    <label for="codautp">Codigo Autorización</label>
    <input type="text" name="codautp" id="codautp" autocomplete="off">
</div>
<div>
<label for="copagop">Paga Copago</label>
<select name="copagop" id="copagop">
    <option   selected value="0">Elija una Opción</option>
    <option value="si">Si</option>
    <option value="no">No</option>
</select>
<div>
    <label for="valorp">Valor Copago</label>
    <input type="text" name="valorp" id="valorp" autocomplete="off">
</div>
</div>
<label for="txtfinalizadoadp">Observaciones</label>
<textarea name="txtfinalizadoadp" id="txtfinalizadoadp" cols="30" rows="6" placeholder="Información de Finalizado (opcional)"></textarea>
<div class="mensajeguardadofinalizadoadp"></div>
<center><div >
<button type="submit" value=""class="btn-emergente" >Guardar</button>

<!-- <button href="" onclick="closefinalizado()" class="btn-emergente">Cerrar</button> -->
</div></center>
</form>

    </div>	
</div>