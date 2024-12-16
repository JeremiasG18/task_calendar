<?php

namespace model;
use PDO;

class Main{

    private string $host;
    private string $db;
    private string $user;
    private string $pass;

    public function __construct()
    {
        $this->host = "localhost";
        $this->db = "task_calendar";
        $this->user = "root";
        $this->pass = "";
    }

    protected function conexion(){
        $pdo = new PDO("mysql:host={$this->host};dbname={$this->db};", $this->user, $this->pass);

        return $pdo;
    }

    public function guardarDatos(string $tabla, array $datos)
    {
        $consulta = "INSERT INTO $tabla (";

        foreach ($datos as $key => $value) {
            if ($key === 0) {
                $consulta .= $value["campo_clave"];
                continue;
            }
            $consulta .= ", " . $value["campo_clave"];
        }

        $consulta .= ") VALUES (";

        foreach ($datos as $key => $value) {
            if ($key === 0) {
                $consulta .= $value["campo_marcador"];
                continue;
            }
            $consulta .= ", " . $value["campo_marcador"];
        }

        $consulta .= ");";

        $campos = [];

        foreach ($datos as $key => $value) {
            $campos[$value["campo_marcador"]] = $value["campo_valor"];
        }

        $consulta = $this->conexion()->prepare($consulta);
        $respuesta = $consulta->execute($campos);

        return $respuesta;
    }   
}

?>