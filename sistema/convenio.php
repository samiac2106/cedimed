<?php
session_start();
include "../db/conexion.php";
$conectar = new Conexion();

if (empty($_SESSION['active'])) {
  header('location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include("includes/scriptsUp.php") ?>

  <title>CONVENIO ENTIDADES</title>
  <link rel="shortcut icon" href="../img/icono-cedimed.png" type="image/x-icon">
  <style>

  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include("includes/navBar.php") ?>
      <div class="right_col" role="main">
        <section id="container">


          <div class="page-header text-left">
            <CENTer>
              <h1>CONSULTA DE CONVENIO ENTIDADES </h1>
            </CENTer>
          </div>

          <div>
            <div>
              <p>
              <h3>LISTA DE ENTIDADES</h3>
              </p>
              <select id="entidades" name="entidades" class="select2 custom-select">
              <option disabled selected value="">Elige una Opción</option>
                <?php
                $consultaSQL = "SELECT * FROM entidad where estatus=1 order by nombre ASC";
                $entidades = $conectar->consultarDatos($consultaSQL);

                foreach ($entidades as $entidad) : ?>
                  <option value="<?php echo ($entidad['id']) ?>"><?php echo ($entidad['nombre']) ?></option>
                <?php endforeach ?>
              </select>


              <br>
            </div>
            <div>
            <div class="resultado_estudios"></div>
            

            </div>

          </div>
          <div>
            <div>

              <p id="resultado1"></p>

            </div>
          </div>
      </div>
      </section>

    </div>

  </div>
  </div>
  <?php include("includes/scriptsDown.php") ?>

    
  <script>

</script>
  <script>
  $(document).ready(function() {
    $('.select2').select2();
    $('#entidades').change(function() {
    var idEntidad = "idEntidad=" + $('#entidades').val();
            $.ajax({
                type: "POST",
                url: "php/cargar_estudios.php",
                data: idEntidad,
                success: function(data) {
                   $('#estudios').val(data);
                 }
            });
        });

       
        /* dinamico de estudios y borrar datos tabla*/
        $('#entidades').on('change', function(){
         
          var id = $('#entidades').val()
             $.ajax({
            type: 'POST',
            url: 'php/cargar_estudios.php',
            data: {'id': id}
          })
          .done(function(estudio){
            
           
            $('.resultado_estudios').html(estudio),
            $('#resultado1').html('')
           })
          .fail(function(){
            alert('Hubo un error al cargar los estudios')
          }) 
        })

  });
      

            
  </script>
  

</body>

</html>