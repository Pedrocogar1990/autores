<?php
session_start();
require __DIR__ . "/../../vendor/autoload.php";

use Src\Autores;

(new Autores)->crearAutores(30);
$autores = Autores::readAll();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN BOOTSTRAP =>me permite usar estilos sin necesidad de descargarlos (usándolos de internet)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet"> <!-- no tengo que poner el enlace que viene de bootstrap ya que ya lo tengo-->
    <!--CDN FONT-AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--sweetalert2 (js)-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Index de Autores</title>
</head>

<body style="background-color:lemonchiffon">

    <h5 class="text-center mt-4">Listado de Autores</h5>
    <div class="container">
        <a href="create.php" class="my-2 btn btn-primary">
            <i class="fas fa-add"></i> Crear Nuevo Autor
        </a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <?php
            foreach ($autores as $item) {
                $autores = serialize($item); //SIEMPRE QUE SERIALICE DEBO PASAR EL VALOR EN EL VALUE ENTRE ' ' (SI NO NO FUNCIONARÁ)
                echo <<<CODE
                        <tbody>
                            <tr>
                                <th scope="row">{$item->id_autor}</th>
                                <td>{$item->nombre}</td>
                                <td>{$item->apellidos}</td>
                                
                                <td>
                                    <form name='as' method="POST" action="delete.php">
                                        
                                        <input type="hidden" name="autores" value='{$autores}'>
                                        <button class="btn btn-danger" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    
                                    <a href="update.php?id={$item->id_autor}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                       
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    CODE;
            }
            ?>
        </table>
    </div>
    <?php
        if(isset($_SESSION['mensaje'])){
            echo <<<CODE
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Accion completada con exito',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            CODE;

            unset($_SESSION['mensaje']); //SESSION FLASH
        }
    ?>
</body>

</html>

