<?php 
session_start();
include "../../conexion.php";
?>

<div class="tab" style="text-align:center !important">
    <button class="tablinks" onclick="openCorte(event, 'GENERAL')" id="defaultOpen">GENERAL</button>
    <button class="tablinks" onclick="openCorte(event, 'PENDIENTES_PERSONAL')">PENDIENTES PERSONAL</button><br>
    <button class="tablinks" onclick="openCorte(event, 'ESPERA')">ESPERA</button>
    <button class="tablinks" onclick="openCorte(event, 'FINALIZADO')">GESTIONADO</button>
    <button class="tablinks" onclick="openCorte(event, 'CANCELADO')">CANCELADO</button>

</div>

<center>
    <div id="GENERAL" class="tabcontent">
        <h1>Aquí se encuentra todas las citas realizadas de todos los asesores</h1>

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
                                            
                                            ");
            
            $result=mysqli_num_rows($query);
           

            if ($result>0){
                while($data=mysqli_fetch_array($query)){?>

                <tr>
                    <td><?php echo $data['nro_cita'];?></td>
                    <td><?php echo $data['fecha'];?></td>
                    <td><a class="emergente1" href="#" idcliente="<?php echo $data['idcliente'];?>" data-toggle="modal"
                            style="text-decoration: none;"><?php echo $data['nombre_cliente'].' '.$data['identificacion'];?>
                    </td>
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
    </div>
</center>

<center>
    <div id="PENDIENTES_PERSONAL" class="tabcontent">
        <h1>Aquí se encuentra todas las citas pendientes de todos los asesores</h1>

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
                                            WHERE estadocita=1 ");
            
            $result=mysqli_num_rows($query);
            $usuario_id=$_SESSION['iduser'];
            $rol_id=$_SESSION['idrol'];
            
 
            if ($result>0){
                while($data=mysqli_fetch_array($query)){
                    $usuario=$data['usuario'];?>

                <tr id="pte<?php echo $data['nro_cita'];?>">
                    <td><?php echo $data['nro_cita'];?></td>
                    <td><?php echo $data['fecha'];?></td>
                    <td><a class="emergente1" href="#" idcliente="<?php echo $data['idcliente'];?>" data-toggle="modal"
                            style="text-decoration: none;"><?php echo $data['nombre_cliente'].' '.$data['identificacion'];?>
                    </td>
                    <td><?php echo $data['estudio'];?></td>
                    <td><?php echo $data['fecha_cita'];?></td>
                    <td><?php echo $data['asesor'];?></td>
                    <td><?php echo $data['observaciones'];?></td>
                    <td><a class="emergente2" href="#" admision="<?php echo $data['id_admision'];?>" data-toggle="modal"
                            style="text-decoration: none;"><?php echo $data['estado_admision'];?></td>
                    <td><?php echo $data['pendiente'];?></td>
                    <td><a class="celgestion emergente3g" href="#" citag="<?php echo $data['nro_cita'];?>"
                            data-toggle="modal" style="text-decoration: none;"><?php echo $data['gestion_pendiente'];?>
                    </td>
                    <td><a class="emergente4 link_edit" href="#" gestion="<?php echo $data['nro_cita'];?>"
                            data-toggle="modal" style="text-decoration: none;">gestion<span class="glyphicon glyphicon-pencil"
                                aria-hidden="true"></span></a>
                        <?php
                    if ($usuario_id==$usuario || $rol_id==1){?>
                        <a class="cita_finalizadop" href="#" finalizadop="<?php echo $data['nro_cita'];?>"
                            data-toggle="modal" style="text-decoration: none;"><span class="glyphicon glyphicon-ok-sign"
                                aria-hidden="true"></span></a>
                        <a class="cita_canceladop" href="#" canceladop="<?php echo $data['nro_cita'];?>"
                            data-toggle="modal" style="text-decoration: none;"><span
                                class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>


                        <?php
                    }
                    ?>
                    </td>
                </tr>
                <?php   
                }
            }
            
            ?>

            </tbody>

        </table>
    </div>
</center>

<center>
    <div id="ESPERA" class="tabcontent" aling="center">
        <h1>Espera personalizada del Asesor</h1>

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
                    <th>Estado Admisiones</th>
                    <th>Editar Cita</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
            $usuario_id=$_SESSION['iduser'];
            $rol_id=$_SESSION['idrol'];
            if($rol_id==1){
                $queryespera=mysqli_query($conexion, "SELECT cl.idcliente, ci.fecha, ci.nro_cita, ci.vigencia_orden, ci.arl_codigo, ci.fecha_cita, ci.observaciones,
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
                                            WHERE ci.estadocita=0");
            }else{
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
                                            where ci.usuario=$usuario_id AND ci.estadocita=0");
                                            
            }
            
                                            
            
            $resultespera=mysqli_num_rows($queryespera);
           

            if ($resultespera>0){
                while($dataespera=mysqli_fetch_array($queryespera)){
                    ?>

                <tr id="esp<?php echo $dataespera['nro_cita'];?>">
                    <td><?php echo $dataespera['nro_cita'];?></td>
                    <td><?php echo $dataespera['fecha'];?></td>
                    <td><a class="emergente1" href="#" idcliente="<?php echo $dataespera['idcliente'];?>"
                            data-toggle="modal"
                            style="text-decoration: none;"><?php echo $dataespera['nombre_cliente'].' '.$dataespera['identificacion'];?>
                    </td>
                    <td><?php echo $dataespera['estudio'];?></td>
                    <td><?php echo $dataespera['vigencia_orden'];?></td>
                    <td><?php echo $dataespera['arl_codigo'];?></td>
                    <td><?php echo $dataespera['fecha_cita'];?></td>

                    <td><?php echo $dataespera['observaciones'];?></td>
                    <td><a class="emergente2" href="#" admision="<?php echo $dataespera['id_admision'];?>"
                            data-toggle="modal"
                            style="text-decoration: none;"><?php echo $dataespera['estado_admision'];?></td>

                    <td>
                        <a class="" href="editar_cita.php?id=<?php echo $dataespera['nro_cita']?>"><span
                                class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

                    </td>
                    <td>
                        <a class="cita_pendiente" href="#" pendiente="<?php echo $dataespera['nro_cita'];?>"
                            data-toggle="modal" style="text-decoration: none;"><span
                                class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a>
                        <a class="cita_finalizado" href="#" finalizado="<?php echo $dataespera['nro_cita'];?>"
                            data-toggle="modal" style="text-decoration: none;"><span class="glyphicon glyphicon-ok-sign"
                                aria-hidden="true"></span></a>
                        <a class="cita_cancelado" href="#" cancelado="<?php echo $dataespera['nro_cita'];?>"
                            data-toggle="modal" style="text-decoration: none;"><span
                                class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a>

                    </td>

                </tr>
                <?php   
                }
            }
            
            ?>

            </tbody>

        </table>
    </div>
</center>

<center>
    <div id="FINALIZADO" class="tabcontent" aling="center">
        <h1>Finalizado personalizada del Asesor</h1>

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
                                            Where ci.estadocita=2");
            
            $result=mysqli_num_rows($query);
           

            if ($result>0){
                while($data=mysqli_fetch_array($query)){?>

                <tr>
                    <td><?php echo $data['nro_cita'];?></td>
                    <td><?php echo $data['fecha'];?></td>
                    <td><a class="emergente1" href="#" idcliente="<?php echo $data['idcliente'];?>" data-toggle="modal"
                            style="text-decoration: none;"><?php echo $data['nombre_cliente'].' '.$data['identificacion'];?>
                    </td>
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
    </div>
</center>

<center>
    <div id="CANCELADO" class="tabcontent" aling="center">
        <h1>Cancelado personalizada del Asesor</h1>

        <table id="tablacancelado" style="width:100%">
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
                                            Where ci.estadocita=3
                                            ");
            
            $result=mysqli_num_rows($query);
           

            if ($result>0){
                while($data=mysqli_fetch_array($query)){?>

                <tr>
                    <td><?php echo $data['nro_cita'];?></td>
                    <td><?php echo $data['fecha'];?></td>
                    <td><a class="emergente1" href="#" idcliente="<?php echo $data['idcliente'];?>" data-toggle="modal"
                            style="text-decoration: none;"><?php echo $data['nombre_cliente'].' '.$data['identificacion'];?>
                    </td>
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
    </div>
</center>

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
$('#tablageneral, #tablaespera, #tablapendiente, #tablafinalizado, #tablapersonal, #tablacancelado').DataTable({
    "order": [
        [0, "desc"]
    ],
    "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    },
})
</script>