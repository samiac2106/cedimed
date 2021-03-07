<?php
session_start();
include("../../db/Conexion.php");
$conectar = new Conexion();

?>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Espera Admisiones</h2>
     <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <p class="text-muted font-13 m-b-30">
              Aquí se encuentran los estudios ingresados por los asesores de Copago
            </p>
            <table id="datatable" class="table  table table-hover table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Nro Cita</th>
                  <th>Fecha Registro</th>
                  <th>Datos del Paciente</th>
                  <th>Teléfonos</th>
                  <th>Estudio</th>
                  <th>Parte del Cuerpo</th>
                  <th>Entidad</th>
                  <th>Vigencia Orden</th>
                  <th>Si es ARL….</th>
                  <th>Fecha Cita</th>
                  <th>Observaciones Copago</th>
                  <th>Codigo Autorización</th>
                  <th>Valor Copago</th>
                  <th>Observaciones Admisiones</th>
                  <th>Editar Admisiones</th>
                 

                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nro Cita</th>
                  <th>Fecha Registro</th>
                  <th>Datos del Paciente</th>
                  <th>Teléfonos</th>
                  <th>Estudio</th>
                  <th>Parte del Cuerpo</th>
                  <th>Entidad</th>
                  <th>Vigencia Orden</th>
                  <th>Si es ARL….</th>
                  <th>Fecha Cita</th>
                  <th>Observaciones Copago</th>
                  <th>Codigo Autorización</th>
                  <th>Valor Copago</th>
                  <th>Observaciones Admisiones</th>
                  <th>Editar Admisiones</th>
                 

                </tr>
              </tfoot>
              <?php
              
                $consultaSQL = "SELECT ci.nro_cita, ci.fecha, ci.nombre as 'nombre_paciente', td.tipo,
              ci.identificacion, ci.tipo_doc,  ci.telefono, ent.id as id_entidad, est.id_estudio, est.nombre_estudio, ent.nombre as 'entidad', ci.vigencia_orden,
               ci.arl_codigo, ci.fecha_cita,us.nombre as 'asesor', ci.observaciones, esta.estado, estc.estado as 'estado_cita',
                ad.estado as 'estado_admision', ad.num_cita,ad.cod_autorizacion, ad.copago, ad.valor_copago, ad.observaciones
                 as 'observaciones_copago', usua.nombre as 'nombre_admision', ci.parte_cuerpo, ci.gestion_pendiente, 
                 ci.observaciones_pendiente, ci.urgencia
                FROM cita ci 
              INNER JOIN admisiones ad ON ad.num_cita=ci.nro_cita
              INNER JOIN tipo_documento td ON td.num=ci.tipo_doc
              INNER JOIN entidad ent ON ent.id=ci.entidad
              INNER JOIN estudios est ON est.id_estudio=ci.estudio
              INNER JOIN estado_cita estc ON estc.id=ci.estadocita
              INNER JOIN usuario us ON us.idusuario=ci.usuario
              INNER JOIN usuario usu ON usu.idusuario=ci.usuario_actualizacion
              INNER JOIN usuario usua ON usua.idusuario=ad.usuario_admisiones
               INNER JOIN estado_admisiones esta ON esta.id=ad.estado WHERE ad.estado=0";
              
              $copagos = $conectar->consultarDatos($consultaSQL);
              ?>
              <?php foreach ($copagos as $copago) :

                $editarPaciente =  $copago['nro_cita'] . "||" . $copago['cod_autorizacion'] . "||" . $copago['valor_copago'] . "||" . $copago['observaciones_copago'];

              ?>
                <tr style="<?php if($copago['urgencia']==1){echo "background-color:#e68a8a7e";} ?>">
                  <td><?php echo $copago['nro_cita']; ?></td>
                  <td><?php echo $copago['fecha']; ?></td>
                  <td><?php echo $copago['nombre_paciente'] . ' ' . $copago['tipo'] . $copago['identificacion']; ?></td>
                  <td><?php echo $copago['telefono']; ?></td>
                  <td><?php echo $copago['nombre_estudio']; ?></td>
                  <td><?php echo $copago['parte_cuerpo']; ?></td>
                  <td><?php echo $copago['entidad']; ?></td>
                  <td><?php echo $copago['vigencia_orden']; ?></td>
                  <td><?php echo $copago['arl_codigo']; ?></td>
                  <td><?php echo $copago['fecha_cita']; ?></td>
                  <td><?php echo $copago['observaciones']; ?></td>
                  <td><?php echo $copago['cod_autorizacion']; ?></td>
                  <td><?php echo $copago['valor_copago']; ?></td>
                  <td><?php echo $copago['observaciones_copago']; ?></td>

                  
                  <td><h5><center><a  href="" data-toggle="modal" data-target="#editarAdmisiones" onclick="pasarDatosAdmisiones('<?php echo $editarPaciente ?>')"><i class="glyphicon glyphicon-edit text-info "></i></a></center></h5> </td>
                  
                </tr>

               


              <?php endforeach ?>

            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#datatable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="col-12"/>' );
    } );
 
    // DataTable
    var table = $('#datatable').DataTable({
        "order": [
                [0, "desc"]
            ],
            "pageLength": 25,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
            },
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
 
} );
</script>