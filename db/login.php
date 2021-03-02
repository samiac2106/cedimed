<?php 

session_start();
include("Conexion.php");

$conectar = new Conexion();
//Se envia los datos mediante el ajax
$user= (isset($_POST['usuario']))? $_POST['usuario']:'';
$pass= (isset($_POST['password']))? $_POST['password']:'';

//consulta SQL
$consultaSQL="SELECT u.idusuario, u.nombre, u.usuario, u.cedula, u.sexo , u.rol as 'idrol' ,r.rol FROM usuario u INNER JOIN rol r on u.rol = r.idrol 
WHERE u.usuario= '$user' AND u.clave= '$pass' AND u.estatus=1";

$data= $conectar->consultarDatos($consultaSQL);

if($data){
    $_SESSION['active'] = true;
            $_SESSION['iduser'] = $data[0]['idusuario'];
            $_SESSION['nombre'] = $data[0]['nombre'];
            $_SESSION['user'] = $data[0]['usuario'];
            $_SESSION['idrol'] = $data[0]['idrol']; 
            $_SESSION['rol'] = $data[0]['rol']; 
            $_SESSION['cedula'] = $data[0]['cedula']; 
            $_SESSION['sexo'] = $data[0]['sexo']; 

            echo json_encode(1);
}else{
    echo json_encode(-1);
}