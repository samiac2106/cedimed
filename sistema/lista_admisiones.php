<?php
session_start();

include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"?>
    <title>ADMISIONES</title>
   
	<link rel="shortcut icon" href="../img/cedimed-icono.png" type="image/x-icon">
	<style>

</style>
</head>
<body>

<?php 

if (empty($_SESSION['active'])){
  header('location: ../');
}
 include "includes/header.php"; 
 ?>
	<section id="container">

  
        <h1 class="listaa">Copagos Admisiones </h1>
        

<div class="tab" style="text-align:center !important">
  <button class="tablinks" onclick="openCorte(event, 'GENERAL')" id="defaultOpen">GENERAL</button>
  <button class="tablinks" onclick="openCorte(event, 'ESPERA')">ESPERA</button><br>
  <button class="tablinks" onclick="openCorte(event, 'PENDIENTES_PERSONAL')">PENDIENTES</button>
  <button class="tablinks" onclick="openCorte(event, 'FINALIZADO')">GESTIONADO</button>
  
  
</div>        
        
<center><div id="GENERAL" class="tabcontent" >
   <h1>Aquí se encuentra todo, sea de copagos o pendientes </h1>
  
  <table id="tablageneral" style="width:100%">
         <thead>  
            <tr>
                <th>Nro Cita</th>
                <th>Fecha Registro</th>
                <th>Datos del Paciente</th>
                <th>Estudio</th>
                <th>Vigencia Orden</th>
                <th>Si es ARL….</th>
                <th>Fecha Cita</th>
                <th>Asesor Cita</th>
                <th>Observaciones</th>
                <th>Estado Admisiones</th>
                <th>Estado Cita</th>
               
            </tr>
        </thead>
        <tbody>
            <?php


            $query=mysqli_query($conexion, "SELECT cl.idcliente, ci.fecha, ci.nro_cita, ci.vigencia_orden, ci.arl_codigo, ci.fecha_cita, ci.observaciones,
            es.nombre_estudio as 'estudio', ad.id_admision, ea.estado as 'estado_admision', ec.estado as 'estado_cita' ,
            us.usuario as 'asesor', concat(tp.tipo, ' ', cl.num_identificacion) as 'identificacion', cl.nombre as 'nombre_cliente'
                                            FROM cita ci 
                                            INNER JOIN estudios es
                                            ON ci.estudio=es.id_estudio
                                            INNER JOIN estado_admisiones ea
                                            ON ci.estado_admision=ea.id
                                            INNER JOIN estado_cita ec
                                            ON ci.estadocita=ec.id
                                            INNER JOIN usuario us
                                            ON ci.usuario=us.idusuario
                                            INNER JOIN admisiones ad
                                            ON ci.num_admisiones=ad.id_admision
                                            INNER JOIN cliente cl
                                            ON ci.cliente=cl.idcliente
                                            INNER JOIN tipo_documento tp
                                            ON cl.tipo_doc=tp.num
                                            WHERE ad.estado!=3
                                            ");
            
            $result=mysqli_num_rows($query);
           

            if ($result>0){
                while($data=mysqli_fetch_array($query)){?>
                
                    <tr>
                    <td><?php echo $data['nro_cita'];?></td>
                    <td><?php echo $data['fecha'];?></td>
                    <td><a class="emergente1" href="#" idcliente="<?php echo $data['idcliente'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><?php echo $data['nombre_cliente'].' '.$data['identificacion'];?></td>
                    <td><?php echo $data['estudio'];?></td>
                    <td><?php echo $data['vigencia_orden'];?></td>
                    <td><?php echo $data['arl_codigo'];?></td>
                    <td><?php echo $data['fecha_cita'];?></td>
                    <td><?php echo $data['asesor'];?></td>
                    <td><?php echo $data['observaciones'];?></td>
                    <td><a class="emergente2" href="#" admision="<?php echo $data['id_admision'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><?php echo $data['estado_admision'];?></td>
                        <td><a class="emergente3" href="#" cita="<?php echo $data['nro_cita'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><?php echo $data['estado_cita'];?></td>
                    
                    </tr>
                <?php   
                }
            }
            
            ?> 
            
        </tbody>  

    </table>
</div></center>

<center><div id="PENDIENTES_PERSONAL" class="tabcontent" >
   <h1>Aquí se encuentra todas las citas pendientes por gestionar</h1>
  
  <table id="tablapersonal" style="width:100%">
         <thead>  
            <tr>
                <th>Nro Cita</th>
                <th>Fecha Registro</th>
                <th>Datos del Paciente</th>
                <th>Estudio</th>
                <th>Fecha Cita</th>
                <th>Asesor Cita</th>
                <th>Observaciones</th>
                <th>Estado Admisiones</th>
                <th>Pendiente </th>
                <th>Gestion</th>
                <th>Gestionar Pendiente</th>
               
               
            </tr>
        </thead>
        <tbody>
            <?php


            $query=mysqli_query($conexion, "SELECT ci.usuario, cl.idcliente, ci.fecha, ci.nro_cita, ci.pendiente, ci.gestion_pendiente, ci.fecha_cita, ci.observaciones,
            es.nombre_estudio as 'estudio', ad.id_admision, ea.estado as 'estado_admision', ec.estado as 'estado_cita' ,
            us.usuario as 'asesor', concat(tp.tipo, ' ', cl.num_identificacion) as 'identificacion', cl.nombre as 'nombre_cliente'
                                            FROM cita ci 
                                            INNER JOIN estudios es
                                            ON ci.estudio=es.id_estudio
                                            INNER JOIN estado_admisiones ea
                                            ON ci.estado_admision=ea.id
                                            INNER JOIN estado_cita ec
                                            ON ci.estadocita=ec.id
                                            INNER JOIN usuario us
                                            ON ci.usuario=us.idusuario
                                            INNER JOIN admisiones ad
                                            ON ci.num_admisiones=ad.id_admision
                                            INNER JOIN cliente cl
                                            ON ci.cliente=cl.idcliente
                                            INNER JOIN tipo_documento tp
                                            ON cl.tipo_doc=tp.num
                                            WHERE ad.estado=1 ");
            
            $result=mysqli_num_rows($query);
            $usuario_id=$_SESSION['iduser'];
            $rol_id=$_SESSION['idrol'];
            
 
            if ($result>0){
                while($data=mysqli_fetch_array($query)){
                    $usuario=$data['usuario'];?>
                
                <tr id="ptep<?php echo $data['nro_cita'];?>">
                    <td><?php echo $data['nro_cita'];?></td>
                    <td><?php echo $data['fecha'];?></td>
                    <td><a class="emergente1" href="#" idcliente="<?php echo $data['idcliente'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><?php echo $data['nombre_cliente'].' '.$data['identificacion'];?></td>
                    <td><?php echo $data['estudio'];?></td>                  
                    <td><?php echo $data['fecha_cita'];?></td>
                    <td><?php echo $data['asesor'];?></td>
                    <td><?php echo $data['observaciones'];?></td>
                    <td><a class="emergente2" href="#" admision="<?php echo $data['id_admision'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><?php echo $data['estado_admision'];?></td>
                    <td><?php echo $data['pendiente'];?></td>
                    <td><a class="celgestion emergente3g" href="#" citag="<?php echo $data['nro_cita'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><?php echo $data['gestion_pendiente'];?></td>
                    <td> <a class="cita_finalizadoadp" href="#" finalizadoadp="<?php echo $data['nro_cita'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a>
                        </td>
                </tr>
                <?php   
                }
            }
            
            ?> 
            
        </tbody>  

    </table>
</div></center>
        
<center><div id="ESPERA" class="tabcontent" aling="center">
   <h1>Aquí es el inicio del proceso para Admisiones</h1>
  
  <table id="tablaespera" style="width:100%">
         <thead>  
            <tr>
                <th>Nro Cita</th>
                <th>Fecha Registro</th>
                <th>Datos del Paciente</th>
                <th>Estudio</th>
                <th>Vigencia Orden</th>
                <th>Si es ARL….</th>
                <th>Fecha Cita</th>
                <th>Observaciones</th>
                <th>Acciones</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            $usuario_id=$_SESSION['iduser'];
            $rol_id=$_SESSION['idrol'];
            
            $queryespera=mysqli_query($conexion, "SELECT cl.idcliente, ci.fecha, ci.nro_cita, ci.vigencia_orden, ci.arl_codigo, ci.fecha_cita, ci.observaciones,
            ci.usuario, es.nombre_estudio as 'estudio', ad.id_admision, ea.estado as 'estado_admision', ec.estado as 'estado_cita' ,
            us.usuario as 'asesor', concat(tp.tipo, ' ', cl.num_identificacion) as 'identificacion', cl.nombre as 'nombre_cliente'
                                            FROM cita ci 
                                            INNER JOIN estudios es
                                            ON ci.estudio=es.id_estudio
                                            INNER JOIN estado_admisiones ea
                                            ON ci.estado_admision=ea.id
                                            INNER JOIN estado_cita ec
                                            ON ci.estadocita=ec.id
                                            INNER JOIN usuario us
                                            ON ci.usuario=us.idusuario
                                            INNER JOIN admisiones ad
                                            ON ci.num_admisiones=ad.id_admision
                                            INNER JOIN cliente cl
                                            ON ci.cliente=cl.idcliente
                                            INNER JOIN tipo_documento tp
                                            ON cl.tipo_doc=tp.num
                                            where  ad.estado=0");
                                            
             $resultespera=mysqli_num_rows($queryespera);
           

            if ($resultespera>0){
                while($dataespera=mysqli_fetch_array($queryespera)){
                    ?>
                
                    <tr id="espad<?php echo $dataespera['nro_cita'];?>">
                    <td><?php echo $dataespera['nro_cita'];?></td>
                    <td><?php echo $dataespera['fecha'];?></td>
                    <td><a class="emergente1" href="#" idcliente="<?php echo $dataespera['idcliente'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><?php echo $dataespera['nombre_cliente'].' '.$dataespera['identificacion'];?></td>
                    <td><?php echo $dataespera['estudio'];?></td>
                    <td><?php echo $dataespera['vigencia_orden'];?></td>
                    <td><?php echo $dataespera['arl_codigo'];?></td>
                    <td><?php echo $dataespera['fecha_cita'];?></td>
                    
                    <td><?php echo $dataespera['observaciones'];?></td>
                    <td>
                        <a class="cita_pendientead" href="#" pendientead="<?php echo $dataespera['nro_cita'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a>
                        <a class="cita_finalizadoad" href="#" finalizadoad="<?php echo $dataespera['nro_cita'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></a>
                        
                    </td>
                    
                    </tr>
                <?php   
                }
            }
            
            ?> 
            
        </tbody>  

    </table>
</div></center>





<center><div id="FINALIZADO" class="tabcontent" aling="center">
   <h1>Aqui se encuentra todas las citas gestionadas por admisiones</h1>
  
   <table id="tablafinalizado" style="width:100%">
         <thead>  
            <tr>
                <th>Nro Cita</th>
                <th>Fecha Registro</th>
                <th>Datos del Paciente</th>
                <th>Estudio</th>
                <th>Vigencia Orden</th>
                <th>Si es ARL….</th>
                <th>Fecha Cita</th>
                <th>Asesor Cita</th>
                <th>Observaciones</th>
                <th>Info Admisiones</th>
                <th>Info de Gestión Cita</th>
               
            </tr>
        </thead>
        <tbody>
            <?php


            $query=mysqli_query($conexion, "SELECT cl.idcliente, ci.fecha, ci.nro_cita, ci.vigencia_orden, ci.arl_codigo, ci.fecha_cita, ci.observaciones,
            es.nombre_estudio as 'estudio', ad.id_admision, ea.estado as 'estado_admision', ec.estado as 'estado_cita' , ci.estadocita,
            us.usuario as 'asesor', concat(tp.tipo, ' ', cl.num_identificacion) as 'identificacion', cl.nombre as 'nombre_cliente'
                                            FROM cita ci 
                                            INNER JOIN estudios es
                                            ON ci.estudio=es.id_estudio
                                            INNER JOIN estado_admisiones ea
                                            ON ci.estado_admision=ea.id
                                            INNER JOIN estado_cita ec
                                            ON ci.estadocita=ec.id
                                            INNER JOIN usuario us
                                            ON ci.usuario=us.idusuario
                                            INNER JOIN admisiones ad
                                            ON ci.num_admisiones=ad.id_admision
                                            INNER JOIN cliente cl
                                            ON ci.cliente=cl.idcliente
                                            INNER JOIN tipo_documento tp
                                            ON cl.tipo_doc=tp.num
                                            Where ad.estado=2");
            
            $result=mysqli_num_rows($query);
           

            if ($result>0){
                while($data=mysqli_fetch_array($query)){?>
                
                    <tr>
                    <td><?php echo $data['nro_cita'];?></td>
                    <td><?php echo $data['fecha'];?></td>
                    <td><a class="emergente1" href="#" idcliente="<?php echo $data['idcliente'];?>" data-toggle="modal" 
                        style="text-decoration: none;"><?php echo $data['nombre_cliente'].' '.$data['identificacion'];?></td>
                    <td><?php echo $data['estudio'];?></td>
                    <td><?php echo $data['vigencia_orden'];?></td>
                    <td><?php echo $data['arl_codigo'];?></td>
                    <td><?php echo $data['fecha_cita'];?></td>
                    <td><?php echo $data['asesor'];?></td>
                    <td><?php echo $data['observaciones'];?></td>
                    <td><a class="emergente2" href="#" admision="<?php echo $data['id_admision'];?>" data-toggle="modal" 
                        style="text-decoration: none;">Ver Info</td>
                        <td><a class="emergente3" href="#" cita="<?php echo $data['nro_cita'];?>" data-toggle="modal" 
                        style="text-decoration: none;">Ver Info</td>
                    
                    </tr>
                <?php   
                }
            }
            
            ?> 
            
        </tbody>  

    </table>
</div></center>


    </section>
  
 
    <script>
    function openCorte(atributo, menutab) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(menutab).style.display = "block";
      atributo.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
    </script>

<script>
      $('#tablageneral, #tablaespera, #tablafinalizado, #tablacancelado, #tablapersonal').DataTable({
        "order": [[ 0, "asc" ]],
        "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
   })
  
</script>
<?php include "includes/footer.php"?>
</body>
</html>