<?php
$idModalidad=$_POST['id'];

include("../conexion.php");
$conexion= new ConexionContingencia();
$ejeX=array();
$ejeY=array();
$repetir=0;
$consultaSQL="SELECT * FROM pacientes_modalidad WHERE modalidad=$idModalidad order by estudio";
$estudios=$conexion->consultarDatos($consultaSQL);
foreach($estudios as $estudio){
    
    $idEstudio=$estudio['estudio'];
    
    if($repetir!=$idEstudio){
        $repetir=$idEstudio;
        $consultaSQL="SELECT * FROM estudios WHERE id_estudio=$idEstudio";
        $result=$conexion->consultarDatos($consultaSQL);
        $ejeX[]=$result[0]['nombre_estudio'];

        $consultaSQL="SELECT count(estudio)  as 'contar'FROM pacientes_modalidad WHERE estudio=$idEstudio and modalidad=$idModalidad AND estado=0";
        $result=$conexion->consultarDatos($consultaSQL);
        $ejeY[]=$result[0]['contar'];
    }
    
}

$datosX=json_encode($ejeX);
$datosY=json_encode($ejeY);
?>

<div id="barChartSelect"></div>

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



Plotly.newPlot('barChartSelect', data);


</script>