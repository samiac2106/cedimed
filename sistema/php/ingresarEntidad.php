<?php 
session_start();
include "../../conexion.php";

$nombre=$_POST['nombre'];
$obs=$_POST['obs'];
$estado=$_POST['estado'];

$query=mysqli_query($conexion, "INSERT INTO entidad (nombre, observaciones, estatus) VALUES ('$nombre','$obs', '$estado')");


if($query){
    echo json_encode(1);
}else{
    echo json_encode("error");
}