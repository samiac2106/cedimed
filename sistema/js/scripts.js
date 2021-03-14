/* Full Screen */
(function () {
  var viewFullScreen = document.getElementById("view-fullscreen");
  if (viewFullScreen) {
    viewFullScreen.addEventListener("click", function () {
      var docElm = document.documentElement;
      if (docElm.requestFullscreen) {
        docElm.requestFullscreen();
      }
      else if (docElm.msRequestFullscreen) {
        docElm = document.body; //overwrite the element (for IE)
        docElm.msRequestFullscreen();
      }
      else if (docElm.mozRequestFullScreen) {
        docElm.mozRequestFullScreen();
      }
      else if (docElm.webkitRequestFullScreen) {
        docElm.webkitRequestFullScreen();
      }
    }, false);
  }

})();


/* COPAGOS */
/* Ingresar Paciente */
function ingresarPaciente() {
  $.ajax({
    type: "POST",
    url: "php/ingresarPaciente.php",
    data: $("#ingresarPaciente").serialize(),
    dataType: "json",
    success: function (data) {

      if (data == 1) {
        $(".tablaGeneral").load("tablas/tablaGeneralCopago.php");
        $(".tablaEspera").load("tablas/tablaEsperaCopago.php");
        $(".tablaPendiente").load("tablas/tablaPendienteCopago.php");
        $("#registrarPaciente").modal("hide");
        Swal.fire({
          position: "center",
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: "Paciente Ingresado Correctamente!!!!",
          showConfirmButton: false,
          timer: 2000,
        });
      } else if (data == 2) {
        Swal.fire({
          position: "center",
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: "El estudio o entidad no fueron ingresados correctamente!!!!",
          showConfirmButton: false,
          timer: 2000,
        });
      }
      else {
        Swal.fire({
          position: "center",
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: "Error al Ingresar Datos!!!!",
          showConfirmButton: false,
          timer: 2000,
        });
      }
    },
  });
}
/* pasar datos almodal de gestion */
function pasarDatosGestion(data) {
  d = data.split("||");
  $(".cita").html(d[0]);
  $(".estado").html(d[1]);
  $(".observaciones").html(d[4]);
  $(".cita").val(d[0]);
  $(".observaciones_pendiente").val(d[4]);
}
function editarGestion() {
  $.ajax({
    type: "POST",
    url: "php/editarGestion.php",
    data: $("#editarGestion").serialize(),
    dataType: "json",
    success: function (data) {
      if (data == 1) {
        $("#modalCitas").modal("hide");
        $(".tablaGeneral").load("tablas/tablaGeneralCopago.php");
        Swal.fire({
          position: "center",
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: "Datos Ingresados Correctamente!!!!",
          showConfirmButton: false,
          timer: 2000,
        });
      } else {
        Swal.fire({
          position: "center",
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: "Error al Ingresar Datos!!!!",
          showConfirmButton: false,
          timer: 2000,
        });
      }
    },
  });
}
/* pasar datos a modal editar */
function pasarDatosPaciente(data) {
  d = data.split("||");
  $(".nro_cita").val(d[0]);
  $(".tipo").val(d[1]);
  $(".documento").val(d[2]);
  $(".nombres").val(d[3]);
  $(".telefonos").val(d[4]);
  $(".estudio").val(d[5]);
  $(".entidad").val(d[6]);
  $(".vigencia").val(d[7]);
  $(".arl").val(d[8]);
  $(".fecha").val(d[9]);
  $(".observaciones").val(d[10]);
  $(".estado").val(d[11]);
  $(".parteCuerpo").val(d[12]);
  $(".urgente").val(d[13]);
  $(".estadoAdmisiones").val(d[14]);
  $(".observacionDevolucion").val(d[15]);
}
/* editar Paciente */
function editarPaciente() {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "php/editarPaciente.php",
    data: $("#formEditarPaciente").serialize(),
    success: function (d) {
      if (d == 1) {
        $('.tablaPendiente').load('tablas/tablaPendienteCopago.php');
        $(".tablaEspera").load("tablas/tablaEsperaCopago.php");
        $("#editarPaciente").modal("hide");
        Swal.fire({
          position: "center",
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: "Paciente Editado Correctamente!!!!",
          showConfirmButton: false,
          timer: 2000,
        });
      } else {
        Swal.fire({
          position: "center",
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: "Error al Editar Datos!!!!",
          showConfirmButton: false,
          timer: 2000,
        });
      }
    },
  });
}


//ADMINSIONES
//Pasar Datos a modal adminsiones
/* pasar datos almodal de gestion */
function pasarDatosAdmisiones(data) {
  d = data.split("||");
  $(".nro_cita").val(d[0]);
  $(".codigo").val(d[1]);
  $(".copago").val(d[2]);
  $(".observaciones").val(d[3]);
}
function editarAdmisiones() {
  $.ajax({
    type: "POST",
    url: "php/editarAdmisiones.php",
    data: $("#formEditarAdmisiones").serialize(),
    dataType: "json",
    success: function (d) {
      if (d == 1) {
        $('.tablaEspera').load('tablas/tablaEsperaAdmisiones.php');
        $('.tablaPendiente').load('tablas/tablaPendienteAdmisiones.php');
        $("#editarAdmisiones").modal("hide");
        Swal.fire({
          position: "center",
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: "Datos Editados Correctamente!!!!",
          showConfirmButton: false,
          timer: 2000,
        });
      } else {
        Swal.fire({
          position: "center",
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: "Error al Editar Datos!!!!",
          showConfirmButton: false,
          timer: 2000,
        });
      }
    },
  });
}


//CONTINGENCIA
//Agregar contingencia
function guardarContingencia() {
  $.ajax({
    type: "POST",
    url: "php/registrarContingencia.php",
    data: $('#registrarContingencia').serialize(),
    datatype: "json",
    success: function (data) {
      if (data == 1) {
        Swal.fire({
          position: 'top-end',
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: 'Datos Ingresados!!!!',
          showConfirmButton: false,
          timer: 1500
        }).then((result) => {
          window.location.reload();
        });
        $('#documento').focus();

      } else {
        Swal.fire({
          position: 'top-end',
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: 'Error al ingresar datos!!!!',
          showConfirmButton: false,
          timer: 1500
        })
      }
    }
  });
}
//Ingresar datos al formulario de editar
function formEditarContingencia(data) {

  d = data.split('||');
  $('.idConsulta').val(d[0]);
  $('.documento').val(d[1]);
  $('.nombre').val(d[2]);
  $('.apellido').val(d[3]);
  $('.telefono').val(d[4]);
  $('.entidad').val(d[5]);
  $('.modalidad').val(d[6]);
  $('.estudio').val(d[7]);
  $('.observaciones').val(d[8]);
  $('.estado').val(d[9]);

}
//Editar contingencia
function editarContingencia() {
  $.ajax({
    type: "POST",
    url: "php/editarContingencia.php",
    data: $('#editarContingencia').serialize(), //modal
    datatype: "json",
    success: function (data) {
      console.log(data);
      if (data == 1) {
        Swal.fire({
          position: 'top-end',
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: 'Consulta Editada!!!!',
          showConfirmButton: false,
          timer: 1500
        });
        $('.tablaContingencia').load('tablas/tablaContingencia.php');

      } else {
        Swal.fire({
          position: 'top-end',
          html: '<img src="../img/icono-cedimed.png" ><br>',
          title: 'Error al editar Consulta!!!!',
          showConfirmButton: false,
          timer: 1500
        })
      }
    }
  });
}


//ORDEN MEDICA
function formEditarAdjunto(data){
  d = data.split('||');
  $('.idAdjunto').val(d[0]);
  $('.idAdjunto').html(d[0]);
  $('.respuesta').val(d[1]);
}

function editarAdjunto(){

  $.ajax({
    type: "POST",
    url: "php/editarAdjunto.php",
    data: $('#editarOrden').serialize(),
    dataType: "json",
    success: function (data) {
     if(data==1){
      $('.tablaImagen').load('tablas/tablaImagenCita.php');
      $("#editarAdjunto").modal("hide");
      Swal.fire({
        position: 'top-end',
        html: '<img src="../img/icono-cedimed.png" ><br>',
        title: 'Consulta Editada!!!!',
        showConfirmButton: false,
        timer: 1500
      });
     }
    }
  });
}

function finalizarAdjunto(){

  $.ajax({
    type: "POST",
    url: "php/finalizarAdjunto.php",
    data: $('#finalizarOrden').serialize(),
    dataType: "json",
    success: function (data) {
     if(data==1){
      $('.tablaImagen').load('tablas/tablaImagenCita.php');
      $("#finalizarAdjunto").modal("hide");
      Swal.fire({
        position: 'top-end',
        html: '<img src="../img/icono-cedimed.png" ><br>',
        title: 'Orden Finalizada!!!!',
        showConfirmButton: false,
        timer: 1500
      });
     }
    }
  });
}

