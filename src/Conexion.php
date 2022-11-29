<?php

namespace Src;

use \PDO;
use \PDOException;

class Conexion
{
    protected static $conexion;

    public function __construct()
    {
        self::crearConexion();
    }

    protected static function crearConexion()
    {

        if (self::$conexion != null) return;

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
        $dotenv->load();

        $usuario = $_ENV['USER'];
        $pass = $_ENV['PASS'];
        $host = $_ENV['HOST'];
        $db = $_ENV['DATABASE'];

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {

            self::$conexion = new PDO($dsn, $usuario, $pass);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("error en conexion" . $ex->getMessage());
        }
    }
}
