<?php 
session_start();
include "../../conexion.php";

$idEstudio=$_POST['idEstudio'];
$nombre_estudio=$_POST['nombre_estudio'];
$observaciones=$_POST['observaciones'];
$estatus=$_POST['estado'];

$query=mysqli_query($conexion, "UPDATE estudios SET nombre_estudio='$nombre_estudio' , observaciones='$observaciones' , 
                                    estatus='$estatus' WHERE id_estudio='$idEstudio'");


if($query){
    echo json_encode(1);
}else{
    echo json_encode("error");
}