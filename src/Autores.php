<?php

namespace Src;

use \PDO;
use \PDOException;

class Autores extends Conexion
{
    private int $id_autor;
    private  string $apellidos;
    private string $nombre;

    public function __construct()
    {
        parent::$conexion;
    }
    //--------------------CRUD------------------------
    public function create()
    {
        parent::crearConexion();
        $q = "insert into autores(apellidos, nombre) values(:a, :n)";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':a' => $this->apellidos,
                ':n' => $this->nombre
            ]);
        } catch (PDOException $ex) {
            die("error en create()" . $ex->getMessage());
        }
        parent::$conexion = null;
    }
    public function read()
    {
    }
    public static function update($id_autor)
    {
    }
    public static function delete($id_autor)
    {
        parent::crearConexion();
        $q = "delete from autores where id_autor=:i";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':i' => $id_autor
            ]);
        } catch (PDOException $ex) {
            die("error en delete:" . $ex->getMessage());
        }
        parent::$conexion = null;
    }
    public static function readAll()
    {
        parent::crearConexion();
        $q = "select * from autores order by id_autor";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error en readAll():" . $ex->getMessage());
        }
        parent::$conexion = null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    //-----------------------metodos que necesitre
    private function hayAutores()
    {

        $q = "select id_autor from autores";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("error en hayautores()" . $ex->getMessage());
        }
        parent::$conexion = null;
        return $stmt->rowCount();
    }


    public function crearAutores($cant)
    {
        parent::crearConexion();
        if ($this->hayAutores()) return;
        $faker = \Faker\Factory::create('es_ES');
        for ($i = 0; $i < $cant; $i++) {
            (new Autores)->setApellidos($faker->lastName())
                ->setNombre($faker->firstName())
                ->create();
        }
    }
    public static function existenAutores($id_autor)
    {
        parent::crearConexion();
        $q = "select id_autor from autores where id_autor=:i";
        $stmt = parent::$conexion->prepare($q);
        try {
            $stmt->execute([
                ':i' => $id_autor
            ]);
        } catch (PDOException $ex) {
            die("error en existenAutores:" . $ex->getMessage());
        }
        parent::$conexion = null;
        return $stmt->rowCount();
    }

    //-----------------------setters--------------------------------


    /**
     * Set the value of id_autor
     *
     * @return  self
     */
    public function setId_autor($id_autor)
    {
        $this->id_autor = $id_autor;

        return $this;
    }


    /**
     * Set the value of apellidos
     *
     * @return  self
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }


    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}
