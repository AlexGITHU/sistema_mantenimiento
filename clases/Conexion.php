<?php

    class conectar{

    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasenia = "";
    private $bd = "in_mantenimiento";

    public function conexion()	{
            $conexion = mysqli_connect($this->servidor, $this->usuario, $this->contrasenia, $this->bd);

                return $conexion;
            }

        }

?>