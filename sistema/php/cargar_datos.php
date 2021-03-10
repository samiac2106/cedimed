<?php 
require_once 'conexion.php';

function getdatos(){
  $mysqli = conectmysql();
  $id = $_POST['id'];
  $query = "SELECT * FROM info_convenios WHERE id = $id";
  $result = $mysqli->query($query);

  $consulta = $result->fetch_array(MYSQLI_ASSOC);
    
    echo  "
    <table width=\"100%\" border=\"1\" >
      <tr width=\"100%\" >
        <td width=\"19%\" style=\"padding: 10px;\"><b><center>Convenio</center></b></td>
        <td width=\"19%\" style=\"padding: 10px;\"><b><center>Autorización física</center></b></td>
        <td width=\"19%\" style=\"padding: 10px;\"><b><center>Autorización audio</center></b></td>
        <td width=\"19%\" style=\"padding: 10px;\"><b><center>Vigencia orden medica </center></b></td>
        <td width=\"19%\" style=\"padding: 10px;\"><b><center>Vigencia autorización </center></b></td>
        <td width=\"19%\" style=\"padding: 10px;\"><b><center>Codigos autorización</center></b></td>
      </tr>
      <br>
      <tr>
        <td width=\"19%\" height=\"25px\" style=\"padding: 10px;\"><center>".$consulta['convenio']."</center></td>
        <td width=\"19%\" height=\"25px\" style=\"padding: 10px;\"><center>".$consulta['aut_fisica']."</center></td>
        <td width=\"19%\" height=\"25px\" style=\"padding: 10px;\"><center>".$consulta['au_audio']."</center></td>
        <td width=\"19%\" height=\"25px\" style=\"padding: 10px;\"><center>".$consulta['vom']."</center></td>
        <td width=\"19%\" height=\"25px\" style=\"padding: 10px;\"><center>".$consulta['vaut']."</center></td>
        <td width=\"19%\" height=\"25px\" style=\"padding: 10px;\"><center>".$consulta['cod_aut']."</center></td>
      </tr>
      <tr>
        <td colspan=\"6\"height=\"10px\"><b><center><h1> Copago </h1></center></b></td>
      </tr>
      <tr>
      <td colspan=\"6\" style=\"padding: 15px;\"><center>".$consulta['copago']."</center></td>
      </tr>
      <tr>
        <td colspan=\"6\"height=\"10px\"><b><center><h1>Observaciones</h1></center></b></td>
      </tr>
      <tr>
      <td colspan=\"6\" style=\"padding: 15px;\"><center>".$consulta['observaciones'].
      
      "</center></td>
      </tr>";
      if($consulta['img']!=''){
        echo  "<tr><td colspan=\"6\"height=\"10px\" ><b><center><h1>Imagen</h1></center></b></td>
        </tr>
        <tr>
        <td  colspan=\"6\"><b><center width=\"100%\">".$consulta['img']."</center></b></td>
        </tr>
        </table>";
      }else{
        echo "</table>";
      }
     
  
  
}

echo getdatos(); 