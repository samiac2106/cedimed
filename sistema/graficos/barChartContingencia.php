<?php
include("../conexion.php");
$conexion= new ConexionContingencia();
$ejeX=array();
$ejeY=array();
$consultaSQL="SELECT * FROM modalidad";
$modalidades=$conexion->consultarDatos($consultaSQL);
foreach($modalidades as $modalidad){
    $idMod=$modalidad['id_modalidad'];
    $consultaSQL="SELECT count(modalidad) as 'contar'FROM pacientes_modalidad WHERE modalidad=$idMod and estado=0";
    $result=$conexion->consultarDatos($consultaSQL);
    $ejeY[]=$result[0]['contar'];
    $ejeX[]=$modalidad['nombre_mod'];
}

$datosX=json_encode($ejeX);
$datosY=json_encode($ejeY);
?>

<div id="barChart"></div>

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
yValue = convertirJson('<?php echo ($datosY)  ?>');

var trace1 = {
  x: xValue,
  y: yValue,
  type: 'bar',
  text: yValue.map(String),
  textposition: 'auto',
  marker: {
    color: '#2a3f54',
    opacity: 0.8,
    line: {
      color: '#22142b',
      width: 2
    }
  }
};

var data = [trace1];

var layout = {
  title: 'Total de Contingencia',
  barmode: 'stack'
};

Plotly.newPlot('barChart', data, layout);


</script>