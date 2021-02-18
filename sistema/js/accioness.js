//ENTIDAD
//ingresar datos al modal editar entidad
function formEditarEntidad(datos){
    var d=datos.split('||');
    $('.idEntidad').val(d[0]);
    $('.nombre').val(d[1]);
    $('.obs').val(d[2]);
    $('.estado').val(d[3]);
}
//Editar Entidad
function editarEntidad(){
   $.ajax({
       type:"POST",
       url:"php/editarEntidad.php",
       data:$('#formEditarEntidad').serialize(),
       datatype:"json",
        success: function(dato){
            if(dato==1){
                $('.tablaEntidad').load('tablas/tablaEntidades.php')
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Entidad Editada Correctamente',
                    html: '<br><img src="./img/cedimed-icono.png" alt="" style="width:150px">',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }else{
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'Error al Editar Entidad',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }
        }
   })
}
function ingresarEntidad(){
    $.ajax({
        type:"POST",
        url:"php/ingresarEntidad.php",
        data:$('#formIngresarEntidad').serialize(),
        datatype:"json",
         success: function(dato){
             if(dato==1){
                 $('.tablaEntidad').load('tablas/tablaEntidades.php')
                 Swal.fire({
                     position: 'bottom-end',
                     icon: 'success',
                     title: 'Entidad agregrada Correctamente',
                     html: '<br><img src="./img/cedimed-icono.png" alt="" style="width:150px">',
                     showConfirmButton: false,
                     timer: 1500
                   })
             }else{
                 Swal.fire({
                     position: 'bottom-end',
                     icon: 'error',
                     title: 'Error al agregar Entidad',
                     showConfirmButton: false,
                     timer: 1500
                   })
             }
         }
    })
}
 
//ESTUDIOS
//ingresar datos al modal editar estudios
function formEditarEstudios(datos){
    var d=datos.split('||');
    $('.idEstudio').val(d[0]);
    $('.nombre_estudio').val(d[1]);
    $('.observaciones').val(d[2]);
    $('.estatus').val(d[3]);
}
//Editar Estudios
function editarEstudios(){
   $.ajax({
       type:"POST",
       url:"php/editarEstudios.php",
       data:$('#formEditarEstudios').serialize(),
       datatype:"json",
        success: function(dato){
            if(dato==1){
                $('.tablaEstudios').load('tablas/tablaEstudios.php')
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Estudio Editado Correctamente',
                    html: '<br><img src="./img/cedimed-icono.png" alt="" style="width:150px">',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }else{
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'Error al Editar Estudio',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }
        }
   })
}

//EMPLEADO
//ingresar datos al modal editar empleado
function formEditarEmpleado(datos){
    var d=datos.split('||');
    $('.idusuario').val(d[0]);
    $('.nombre').val(d[1]);
    $('.sexo').val(d[2]);
    $('.usuario').val(d[3]);
    $('.clave').val(d[4]);
    $('.rol').val(d[5]);
    $('.cedula').val(d[6]);
    $('.estado').val(d[7]);

}
//Editar Empleado
function editarEmpleado(){
   $.ajax({
       type:"POST",
       url:"php/editarEmpleado.php",
       data:$('#formEditarEmpleado').serialize(),
       datatype:"json",
        success: function(dato){
            if(dato==1){
                $('.tablaUsuario').load('tablas/tablaEmpleados.php')
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'success',
                    title: 'Editado Correctamente',
                    html: '<br><img src="./img/cedimed-icono.png" alt="" style="width:150px">',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }else{
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'Error al Editar',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }
        }
   })
}
//ingresar empleado
function ingresarEmpleado(){
    $.ajax({
        type:"POST",
        url:"php/ingresarEmpleado.php",
        data:$('#formIngresarEmpleado').serialize(),
        datatype:"json",
         success: function(dato){
             if(dato==1){
                 $('.tablaUsuario').load('tablas/tablaEmpleados.php')
                 Swal.fire({
                     position: 'bottom-end',
                     icon: 'success',
                     title: 'Agregrada Correctamente',
                     html: '<br><img src="./img/cedimed-icono.png" alt="" style="width:150px">',
                     showConfirmButton: false,
                     timer: 1500
                   })
             }else{
                 Swal.fire({
                     position: 'bottom-end',
                     icon: 'error',
                     title: 'Error al agregar ',
                     showConfirmButton: false,
                     timer: 1500
                   })
             }
         }
    })
}

 //admisiones
 function consultas(){
    $.ajax({
        type:"POST",
        url:"php/consultas.php",
        data:$('#formConsultas').serialize(),
        datatype:"json",
         success: function(dato){
             if(dato==1){
                 $('.tablaGeneral').load('tablas/tablaCopago.php')
                 Swal.fire({
                     position: 'bottom-end',
                     icon: 'success',
                     title: 'Guardado Correctamente',
                     html: '<br><img src="./img/cedimed-icono.png" alt="" style="width:150px">',
                     showConfirmButton: false,
                     timer: 1500
                   })
             }else{
                 Swal.fire({
                     position: 'bottom-end',
                     icon: 'error',
                     title: 'Error al guardar ',
                     showConfirmButton: false,
                     timer: 1500
                   })
             }
         }
    })
 }

//CONTINGENCIA
//Agregar contingencia
 function guardarContingencia() {
    $.ajax({
          type: "POST",
          url: "php/registrarContingencia.php",
          data: $('#registrarContingencia').serialize(),
          datatype:"json",
          success: function (data){
             if(data==1){
              Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Datos Ingresados!!!!',
                  showConfirmButton: false,
                  timer: 1500
                }).then((result)=>{
                  window.location.reload();
                });
                $('#documento').focus();
                
             }else{
              Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'Error al ingresar datos!!!!',
                  showConfirmButton: false,
                  timer: 1500
                })
             }
          }
      });
  }
  //Ingresar datos al formulario de editar
  function formEditarContingencia(data){
     
      d=data.split('||');
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
          datatype:"json",
          success: function (data){
            console.log(data);
             if(data==1){
              Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Consulta Editada!!!!',
                  showConfirmButton: false,
                  timer: 1500
                });
                $('.tablaContingencia').load('tablas/tablaContingencia.php');
                
             }else{
              Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'Error al editar Consulta!!!!',
                  showConfirmButton: false,
                  timer: 1500
                })
             }
          }
      });
  }