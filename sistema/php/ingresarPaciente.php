<?php
session_start();
include("../../db/Conexion.php");
$conectar= new Conexion();

$tipo=$_POST ['tipo'];
$documento=$_POST['documento'];
$nombre=$_POST['nombres'];
$telefono=$_POST['telefonos'];
$estudio=$_POST['estudio'];
$entidad=$_POST['entidad'];
$vigencia=$_POST['vigencia'];
$arl=$_POST['arl'];
$fecha=$_POST['fecha'];
$observaciones=$_POST['observaciones'];
$estado=$_POST['estado'];
$usuario=$_SESSION['iduser'];

/* traer  id del estudio seleccionado */
$consultaSQL="SELECT * FROM estudios WHERE nombre_estudio='$estudio'";
$result=$conectar->consultarDatos($consultaSQL);
$estudio=$result[0]['id_estudio'];

/*traer el id de la entidad seleccionada */
$consultaSQL="SELECT * FROM entidad WHERE nombre='$entidad'";
$result=$conectar->consultarDatos($consultaSQL);
$entidad=$result[0]['id'];

if($nombre==""){
    $nombre="CONSULTA";
}

if($estado==0){
    $consultaSQL="INSERT INTO cita(tipo_doc,identificacion, nombre,
    telefono, estudio,entidad,vigencia_orden, arl_codigo,fecha_cita, observaciones, usuario, usuario_actualizacion)
     VALUES ('$tipo', '$documento', '$nombre',  '$telefono','$estudio','$entidad','$vigencia',
     '$arl','$fecha', '$observaciones', '$usuario', '$usuario')";
     $registrar=$conectar->agregarDatos($consultaSQL);
   
     $consultaSQL="SELECT max(nro_cita) as 'max'FROM cita";
     $result=$conectar->consultarDatos($consultaSQL);
     $numCita=$result[0]['max'];
   
     $consultaSQL="INSERT INTO admisiones (num_cita) values ('$numCita')";
     $registrar=$conectar->agregarDatos($consultaSQL);
}else{
    $consultaSQL="INSERT INTO cita(tipo_doc,identificacion, nombre,
    telefono, estudio,entidad,vigencia_orden, arl_codigo,fecha_cita, observaciones, usuario, usuario_actualizacion, estadocita)
     VALUES ('$tipo', '$documento', '$nombre',  '$telefono','$estudio','$entidad','$vigencia',
     '$arl','$fecha', '$observaciones', '$usuario', '$usuario', 1)";
     $registrar=$conectar->agregarDatos($consultaSQL);
   
     $consultaSQL="SELECT max(nro_cita) as 'max'FROM cita";
     $result=$conectar->consultarDatos($consultaSQL);
     $numCita=$result[0]['max'];
   
     $consultaSQL="INSERT INTO admisiones (num_cita, estado) values ('$numCita', 3)";
     $registrar=$conectar->agregarDatos($consultaSQL);
}

  echo json_encode($registrar) ;

