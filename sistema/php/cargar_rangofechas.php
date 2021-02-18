
<?php 
include "../../conexion.php";
      

$fecha=$_POST['fecha'] ;


	$query=mysqli_query($conexion,"SELECT count(nro_cita) FROM cita where fecha<='$fecha'");
    $result_array = mysqli_fetch_array($query);
    
    if ($result_array['count(nro_cita)']>0){
	
	
        echo  "  En total son ".$result_array['count(nro_cita)']." citas que se van a eliminar <br>
                Estas seguro de eliminar estos registros??????
      ";
    }else{
        echo " No hay ningun registro por eliminar.";
    }

?>


