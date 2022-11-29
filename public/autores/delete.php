<?php
session_start();
require __DIR__ . "/../../vendor/autoload.php";

use Src\Autores;

if (!isset($_POST['autores'])) {
    header('Location:index.php');
    die();
}
$autores = unserialize($_POST['autores']);
if (!Autores::existenAutores($autores->id_autor)) {
    header('Location:index.php');
    die();
}
Autores::delete($autores->id_autor);

$_SESSION['mensaje'] = "Autor borrado con exito";
header('Location:index.php');
