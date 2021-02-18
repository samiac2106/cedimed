<?php 
session_start();
include "../../conexion.php";

$nombre=$_POST['nombre'];
$sexo=$_POST['sexo'];
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$rol=$_POST['rol'];
$cedula=$_POST['cedula'];
$estado=$_POST['estado'];

$query=mysqli_query($conexion, "INSERT INTO usuario (nombre, sexo, usuario, clave, rol, cedula, estatus) VALUES
 ('$nombre','$sexo', '$usuario','$clave', '$rol', '$cedula', '$estado')");


if($query){
    echo json_encode(1);
}else{
    echo json_encode("error");
}