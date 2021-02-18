<?php

class Conexion {
    public $usuario="root";
    public $clave="";


public function __construct()
{
    
}

public function Conectar(){
    try{
        $datosBD= "mysql:host=localhost;dbname=contingencia";
        $conexionBD= new PDO ($datosBD, $this->usuario, $this->clave);
        return $conexionBD;
    }catch (PDOException $error){
        echo $error->getMessage();
    }


}

public function agregarDatos($consultaSQL)
    {
        //establecer una conexion
        $conexionBD = $this->Conectar();

        //preparar consulta
        $insertarDatos = $conexionBD->prepare($consultaSQL);

        //ejecutar la consulta
        $resultado = $insertarDatos->execute();

        //verifico el resultado
        if ($resultado) {
            return 1;
        } else {
            return "error";
        }
    }

    public function consultarDatos($consultaSQL)
    {
        //establecer una conexion
        $conexionBD = $this->Conectar();
        //preparar consulta
        $consultarDatos = $conexionBD->prepare($consultaSQL);
        //establacer el método de consulta
        $consultarDatos->setFetchMode(PDO::FETCH_ASSOC);
        //ejecutar la operacion en la base de datos
        $consultarDatos->execute();
        //obtener todos los datos
        return ($consultarDatos->fetchAll());
    }

    public function eliminarDatos($consultaSQL)
    {
        //establecer una conexion
        $conexionBD = $this->Conectar();
        //preparar consulta
        $eliminarDatos = $conexionBD->prepare($consultaSQL);
        //ejecutar la consulta
        $resultado = $eliminarDatos->execute();

        //verifico el resultado
        if ($resultado) {
            return 1;
        } else {
            return "error";
        }
    }

    public function editarDatos($consultaSQL)
    {
        //establecer una conexion
        $conexionBD = $this->Conectar();
        //preparar consulta
        $editarDatos = $conexionBD->prepare($consultaSQL);
        //ejecutar la consulta
        $resultado = $editarDatos->execute();

        //verifico el resultado
        if ($resultado) {
            return 1;
        } else {
            echo "error";
        }
    }

}



