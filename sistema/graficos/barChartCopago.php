<?php
include("../../db/Conexion.php");
$conexion= new Conexion();
$ejeX=array();
$ejeYEspera=array();
$ejeYPendiente=array();
$consultaSQL="SELECT * FROM usuario WHERE rol=2 order by usuario";
$usuarios=$conexion->consultarDatos($consultaSQL);

foreach($usuarios as $usuario){
$ejeX[]=$usuario['usuario'];
   $idUsuario=$usuario['idusuario'];
    $consultaSQL="SELECT count(nro_cita) as 'contar'FROM cita WHERE usuario=$idUsuario and estadocita=0";
    $result=$conexion->consultarDatos($consultaSQL);
    $ejeYEspera[]=$result[0]['contar'];

    $consultaSQL="SELECT count(nro_cita) as 'contar'FROM cita WHERE usuario=$idUsuario and estadocita=1";
    $result=$conexion->consultarDatos($consultaSQL);
    $ejeYPendiente[]=$result[0]['contar'];
   
}

$datosX=json_encode($ejeX);
$datosYEspera=json_encode($ejeYEspera);
$datosYPendiente=json_encode($ejeYPendiente);
?>

<div id="barChartCopago"></div>

<script>
    function convertirJson(json) {
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }
</script>
<script>
xValue = convertirJson('<?php echo ($datosX)  ?>');
yValueEspera = convertirJson('<?php echo ($datosYEspera)  ?>');
yValuePendiente = convertirJson('<?php echo ($datosYPendiente)  ?>');

var trace1 = {
  x: xValue,
  y: yValueEspera,
  marker: {
    color: '#2a3f54'
  },
  name: 'En espera',
  type: 'bar'
};

var trace2 = {
  x: xValue,
  y: yValuePendiente,
  marker: {
    color: '#8888d3'
  },
  name: 'Pendiente',
  type: 'bar'
};

var data = [trace1, trace2];

var layout = {barmode: 'stack'};

Plotly.newPlot('barChartCopago', data, layout);



</script>