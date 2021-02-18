<?php 
session_start();
include "../../conexion.php";

$idEntidad=$_POST['idEntidad'];
$nombre=$_POST['nombre'];
$obs=$_POST['obs'];
$estado=$_POST['estado'];

$query=mysqli_query($conexion, "UPDATE entidad SET nombre='$nombre' , observaciones='$obs' , 
                                    estatus='$estado' WHERE id='$idEntidad'");


if($query){
    echo json_encode(1);
}else{
    echo json_encode("error");
}