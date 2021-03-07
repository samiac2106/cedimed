<?php 
include 'conexion.php';

function getVideos(){
  $mysqli = conectmysql();
  $id = $_POST['id'];
  $query = "SELECT i.id, e.nombre_estudio as 'nombre'   FROM info_convenios i INNER JOIN estudios e
                                                        ON i.estudio_id=e.id_estudio
                                                        WHERE id_entidad= $id order by nombre ASC";
  $result = $mysqli->query($query);
  $estudios = '<p><h3>ESTUDIOS</h3></p><select id="estudios" name="estudios" class="custom-select select2 estudios">';
  $estudios .= '<option selected disabled value="" selected>Elige una Opción</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $estudios .= "<option value='$row[id]'>$row[nombre]</option>";
  }
  $estudios .= '</select>';
  return $estudios;
}

echo getVideos();

?>
 <script>
$('.select2').select2();
</script>
<script>

$('.estudios').on('change', function() {
  
   var id = $('#estudios').val()
    $.ajax({
            type: 'POST',
            url: 'php/cargar_datos.php',
            data: {
                'id': id
            }
        })
        .done(function(datos) {
            $('#resultado1').html(datos)
        })
        .fail(function() {
            alert('Hubo un error al cargar los datos')
        })
})
</script>