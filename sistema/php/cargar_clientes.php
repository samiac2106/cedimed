
<?php 
include "../../conexion.php";
      

$idconsulta=$_POST['identificacion_cliente'];

	$query=mysqli_query($conexion,"SELECT e.nombre as 'entidad', t.tipo as 'tipodoc', c.idcliente, c.nombre, c.sexo, c.telefono  
                                    FROM entidad e 
                                    INNER JOIN cliente c on e.id=c.entidad 
                                    INNER JOIN tipo_documento t on c.tipo_doc=t.num
                                    where c.num_identificacion=$idconsulta");

    $valor= mysqli_num_rows($query);

    if ($valor>0){
	$result_array = mysqli_fetch_array($query);
	
	 

    echo  "  
    <center><p class=\"msg_save\">El cliente ya se encuentra Registrado</p></center>
    <div>

    <div>
    <input type=\"hidden\" name=\"idcliente\" id=\"idcliente\" =\"".$result_array['idcliente']."\">
        <label for=\"tipodoc\">Tipo Documento</label>
       <input style=\"background-color: #8ebbcd\" type=\"text\" name=\"tipodoc\" id=\"tipodoc\" disabled value=\"".$result_array['tipodoc']."\">
    </div>
        <label for=\"nombre\">Nombre Cliente</label>
        <input style=\"background-color: #8ebbcd\" type=\"text\" name=\"nombre\" id=\"nombre\" disabled value=\"".$result_array['nombre']."\">
    </div>
    
    <div>
        <label for=\"sexo\">Sexo</label>
        <input style=\"background-color: #8ebbcd\" type=\"text\" name=\"sexo\" id=\"sexo\" disabled value=\"".$result_array['sexo']."\">
    </div>
    <div>
        <label for=\"telefono\">Telefono</label>
        <input style=\"background-color: #8ebbcd\" type=\"text\" name=\"telefono\" id=\"telefono\" disabled value=\"".$result_array['telefono']."\">
    </div>
    
    <div>
        <label for=\"entidad\">Entidad</label>
        <input style=\"background-color: #8ebbcd\" type=\"text\" name=\"entidad\" id=\"entidad\" disabled value=\"".$result_array['entidad']."\">
    </div>
   ";
    }
    else {
        echo "<p class=\"msg_error\">Este número de documento no se encuentra ingresado, por favor registra el paciente</p>
        <center><a href=\"registro_cliente.php\" class=\"btn_new\" style=\"position:relative; top: 0px\">Registrar Paciente</a></center>";
    }

?>


