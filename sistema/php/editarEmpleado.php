<?php 
session_start();
include "../../conexion.php";

// trae la informacion del name en el modal 

$idusuario=$_POST['idusuario'];
$nombre=$_POST['nombre'];
$sexo=$_POST['sexo'];
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$rol=$_POST['rol'];
$cedula=$_POST['cedula'];
$estado=$_POST['estado'];


$query=mysqli_query($conexion, "UPDATE usuario SET nombre='$nombre' , sexo='$sexo' , usuario='$usuario' , 
                            clave='$clave', rol='$rol' ,cedula='$cedula' , estatus='$estado'   WHERE idusuario='$idusuario'");


if($query){
    echo json_encode(1);
}else{
    echo json_encode("error");
}