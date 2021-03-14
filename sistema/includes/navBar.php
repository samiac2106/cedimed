<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.php" class="site_title"><img src="../img/cedimed-icono.png" alt=""> <span>Cedimed</span></a>
    </div>



    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <br><br><br>
        <h3 class="mt-5">General</h3>
        <ul class="nav side-menu">
          <li><a href="convenio.php"><i class="glyphicon glyphicon-search"></i> Convenio Entidades </a></li>
          <?php if ($_SESSION['idrol'] == 2 || $_SESSION['idrol'] == 1) : ?>
            <li><a href="#"><i class="glyphicon glyphicon-earphone"></i> Copagos <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="listaGeneralCopago.php">General</a></li>
                <li><a href="listaEsperaCopago.php">Mis Pendientes Copago</a></li>
                <li><a href="listaPendienteCopago.php">Mis Pendiente Personal</a></li>

              </ul>
            </li>
            <li><a href="listaImagenesCitas.php"><i class="fa fa-paperclip"></i> Órdenes Médicas </a></li>
          <?php endif; ?>

          <?php if ($_SESSION['idrol'] == 3 || $_SESSION['idrol'] == 1) :  ?>

            <li><a href="#"><i class="glyphicon glyphicon-user"></i> Admisiones <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="listaGeneralAdmisiones.php">General</a></li>
                <li><a href="listaEsperaAdmisiones.php">Espera</a></li>
                <li><a href="listaPendienteAdmisiones.php">Pendiente personal</a></li>
              </ul>
            </li>
          <?php endif ?>
          <?php if ($_SESSION['idrol'] == 2 || $_SESSION['idrol'] == 1) :  ?>
            <li><a><i class="fa fa-sign-in"></i> Contingencia <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="listaContingencia.php">Pacientes Contingencia</a></li>
                <li><a href="finalizadoContingencia.php">Finalizados Contingencia</a></li>
                <?php if ($_SESSION['idrol'] == 1) :  ?>
                  <li><a href="graficos.php">Graficos</a></li>
                <?php endif ?>
              </ul>
            </li>

          <?php endif ?>
          <!-- <li><a href="#"><i class="fa fa-edit"></i> Instructivo </a></li> -->

        </ul>

      </div>


    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <div class="sb-sidenav-footer">
        <div class="small text-center">Creado Por: <br>William Reyes y Sandra Acevedo</div>


      </div>
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" id="view-fullscreen" title="Pantalla Completa" href="#">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Salir" href="../db/logout.php">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>
    <nav class="nav navbar-nav">
      <ul class=" navbar-right">
        <li class="nav-item dropdown open" style="padding-left: 15px;">
          <a class="user-profile text-uppercase">
            <?php echo ($_SESSION['nombre'] . " (" . $_SESSION['rol'] . ")") ?>
          </a>

        </li>

      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->


<!-- /top tiles -->

<!-- Modal Registrar Paciente-->
<div class="modal fade" id="registrarPaciente"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Registrar Paciente</h5>
        <div><span class="font-weight-bold">Nota:</span> Para generar una <b>CONSULTA</b>, solo ingrese datos en observaciones</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="ingresarPaciente">
          <div class="row">
            <div class="form- col-3">
              <label for="tipo">Tipo </label>
              <select name="tipo" class="form-control" id="tipo">

                <?php
                $conectar = new Conexion();
                $consultaSQL = "SELECT * FROM tipo_documento ORDER BY tipo";
                $tipos = $conectar->consultarDatos($consultaSQL);
                foreach ($tipos as $tipo) :
                ?>
                  <option value="<?php echo ($tipo['num']) ?>"><?php echo ($tipo['tipo']) ?></option>
                <?php endforeach ?>
              </select>

            </div>
            <div class="form-group col-9">
              <label for="documento">Nro de documento</label>
              <input type="number" class="form-control" name="documento">
            </div>
          </div>

          <div class="form-group">
            <label for="nombres">Nombres y Apellidos</label>
            <input type="text" class="form-control" name="nombres">
          </div>
          <div class="form-group">
            <label for="telefonos">Teléfonos</label>
            <input type="text" class="form-control" name="telefonos">
          </div>

          <div class="form-group">
            <label for="estudio">Estudio</label>
            <select name="estudio" class="select2 form-control">
              <?php
              $consultaSQL = "SELECT * FROM estudios order by nombre_estudio ASC";
              $estudios = $conectar->consultarDatos($consultaSQL);
              foreach ($estudios as $estudio) :
              ?>
                <option value="<?php echo ($estudio['id_estudio']) ?>"><?php echo ($estudio['nombre_estudio']) ?></option>
              <?php endforeach ?>
            </select>

          </div>
          <div class="form-group">
            <label for="parteCuerpo">Parte del Cuerpo</label>
            <textarea name="parteCuerpo" id="parteCuerpo" class="form-control" cols="30" rows="2"></textarea>
          </div>
          <div class="form-group">
            <label for="entidad">Entidad</label>
            <select name="entidad" class="select2 form-control" id="entidad">
              <?php
              $consultaSQL = "SELECT * FROM entidad order by nombre ASC";
              $entidades = $conectar->consultarDatos($consultaSQL);
              foreach ($entidades as $entidad) :
              ?>
                <option value="<?php echo ($entidad['id']) ?>"><?php echo ($entidad['nombre']) ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="vigencia">Vigencia Orden Medica</label>
            <input type="text" class="form-control" name="vigencia">
          </div>
          <div class="form-group">
            <label for="arl">ARL: Codigo - Nombre del médico y fecha de la orden </label>
            <input type="text" class="form-control" id="arl" name="arl">
          </div>
          <div class="form-group">
            <label for="fecha">Fecha de la cita</label>
            <input type="date" class="form-control" name="fecha">
          </div>
          <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" class="form-control" name="observaciones"></textarea>
          </div>
          <div class="form-group">
            <label for="">Estados del Ingreso</label>
            <select name="estado" class="form-control">
              <option value="0">Admisiones</option>
              <option value="3">Pendiente Personal</option>
            </select>
            <select name="urgente" id="urgente" class="form-control">
              <option value="0"></option>
              <option value="1">Urgente</option>
            </select>
            Las urgencias serán resaltadas en rojo.
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-dark" onclick="ingresarPaciente()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Paciente -->
<div class="modal fade" id="editarPaciente"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarPaciente">
          <div class="row">
            <div class="form- col-3">
              <label for="tipo">Tipo </label>
              <input type="hidden" name="nro_cita" class="nro_cita">
              <select name="tipo" class="custom-select tipo" >
                <?php
                $consultaSQL = "SELECT * FROM tipo_documento ORDER BY tipo";
                $tipos = $conectar->consultarDatos($consultaSQL);
                foreach ($tipos as $tipo) :
                ?>
                  <option value="<?php echo ($tipo['num']) ?>"><?php echo ($tipo['tipo']) ?></option>
                <?php endforeach ?>
              </select>

            </div>
            <div class="form-group col-9">
              <label for="documento">Nro de documento</label>
              <input type="number" class="form-control documento"  name="documento">
            </div>
          </div>

          <div class="form-group">
            <label for="nombres">Nombres y Apellidos</label>
            <input type="text" class="form-control nombres"  name="nombres">
          </div>
          <div class="form-group">
            <label for="telefonos">Teléfonos</label>
            <input type="text" class="form-control telefonos" name="telefonos">
          </div>
          <div class="form-group">
            <label for="estudio">Estudio</label>
            <input list="listaEstudio" name="estudio" class="form-control estudio">
            <datalist id="listaEstudio">

              <?php
              $consultaSQL = "SELECT * FROM estudios order by nombre_estudio ASC";
              $estudios = $conectar->consultarDatos($consultaSQL);
              foreach ($estudios as $estudio) :
              ?>
                <option value="<?php echo ($estudio['nombre_estudio']) ?>"></option>
              <?php endforeach ?>
            </datalist>
          </div>
          <div class="form-group">
            <label for="parteCuerpo">Parte del Cuerpo</label>
            <textarea name="parteCuerpo" class="form-control parteCuerpo" cols="30" rows="2"></textarea>
          </div>
          <div class="form-group">
            <label for="entidad">Entidad</label>
            <input list="listaEntidad" name="entidad" class="form-control entidad">
            <datalist id="listaEntidad">
              <?php
              $consultaSQL = "SELECT * FROM entidad order by nombre ASC";
              $entidades = $conectar->consultarDatos($consultaSQL);
              foreach ($entidades as $entidad) :
              ?>
                <option value="<?php echo ($entidad['nombre']) ?>"> </option>
              <?php endforeach ?>
            </datalist>
          </div>

          <div class="form-group">
            <label for="vigencia">Vigencia Orden Medica</label>
            <input type="text" class="form-control vigencia" name="vigencia">
          </div>
          <div class="form-group">
            <label for="arl">ARL: Codigo - Nombre del médico y fecha de la orden </label>
            <input type="text" class="form-control arl" name="arl">
          </div>
          <div class="form-group">
            <label for="fecha">Fecha de la cita</label>
            <input type="date" class="form-control fecha" name="fecha">
          </div>
          <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" class="form-control observaciones" name="observaciones"></textarea>

          </div>

          <div class="form-group">
            <label for="estado">Estado Cita</label>
            <select name="estado" class="form-control estado">
              <option value="0">Espera</option>
              <option value="1">Pendiente</option>
              <option value="2">Gestionado</option>
              <option value="3">Cancelado</option>
            </select>
            <select name="urgente" class="urgente form-control">
              <option value="0"></option>
              <option value="1">Urgente</option>
            </select>
            Las urgencias serán resaltadas en rojo.
          </div>
      </div>
      <div class="modal-body">
        <div class="border text-center">
          <h2 class="font-weight-bold">Información de admisiones</h2>
          <div class="form-group">
            <label for="estado">Estado Admisiones</label>
            <select name="estadoAdmisiones" class="form-control estadoAdmisiones">
              <option value="0">Espera</option>
              <option value="2">Gestionado</option>
            </select>

          </div>
          <div class="form-group">
            <label for="observacionDevolucion">Observaciones </label>
            <textarea name="observacionDevolucion" class="form-control observacionDevolucion" id="observacionDevolucion"></textarea>

          </div>
        </div>
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-dark" onclick="editarPaciente()">Guardar</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal Editar Admisiones -->
<div class="modal fade" id="editarAdmisiones" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditarAdmisiones">

          <input hidden="text" class="form-control nro_cita" id="nro_cita" name="nro_cita">

          <div class="form-group ">
            <label for="codigo">Codigo Autorizacion</label>
            <input type="text" class="form-control codigo" id="codigo" name="codigo">
          </div>

          <div class="form-group">
            <label for="copago">Valor Copago</label>
            <input type="text" class="form-control copago" id="copago" name="copago">
          </div>

          <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" class="form-control observaciones" id="observaciones" name="observaciones"></textarea>
          </div>

          <div class="form-group">
            <label for="estado">Estado Cita</label>
            <select name="estado" id="estado" class="form-control estado">
              <option value="0">Espera</option>
              <option value="1">Pendiente</option>
              <option value="2">Gestionado</option>
            </select>
          </div>



        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-dark" onclick="editarAdmisiones()">Guardar</button>
      </div>
    </div>
  </div>
</div>