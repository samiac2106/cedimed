$('#formLogin').submit(function(e){
e.preventDefault();
var usuario = $.trim($('#usuario').val());
var password = $.trim($('#contraseña').val());

if(usuario.length=="" || password==""){
    Swal.fire({
        position:'center',
        html:'<img src="img/icono-cedimed.png" ><br>',
        title: 'Ingresa el usuario y la contraseña <br>',
        
               showConfirmButton: false,
        timer:3000,
      })
      $('#usuario').focus();
}else{
    $.ajax({
        type:"POST",
        url:"db/login.php",
        datatype:"json",
        data:{usuario: usuario, password: password},
        success: function(data){
           if(data==1){
            Swal.fire({
                position:'center',
                html:'<img src="img/icono-cedimed.png" ><br>',
                title: 'Bienvenido!!!!',
                showConfirmButton: false,
                timer:3000,
              }).then((result) => {
                  window.location="sistema/";
              } )
           }else{
            Swal.fire({
                position:'center',
                html:'<img src="img/icono-cedimed.png" ><br>',
                title: 'Usuario y/o contraseña incorrecta!!!!',
                showConfirmButton: false,
                timer:3000,
              })
           }
        }
    })
}
})