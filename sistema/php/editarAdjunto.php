<?php
session_start();
include("../../db/Conexion.php");
$conectar= new Conexion();

$idAdjunto=$_POST['idAdjunto'];
$respuesta=$_POST['respuesta'];

/* Editar datos del paciente */
$consultaSQL="UPDATE imgcitas SET respuesta='$respuesta'WHERE idImg='$idAdjunto'";
  $editar=$conectar->editarDatos($consultaSQL);

  echo json_encode($editar) ;