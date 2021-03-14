<?php
session_start();
include("../../db/Conexion.php");
$conectar= new Conexion();

$idAdjunto=$_POST['idAdjunto'];

/* Editar datos del paciente */
$consultaSQL="UPDATE imgcitas SET estadoOrden =1 WHERE idImg='$idAdjunto'";
  $editar=$conectar->editarDatos($consultaSQL);

  echo json_encode($editar) ;