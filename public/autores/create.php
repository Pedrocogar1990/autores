<?php
 session_start();
 require __DIR__."/../../vendor/autoload.php";
 use Src\Autores;
 if(isset($_POST['enviarForm'])){

    $nombre= trim($_POST['nombre']);
    $apellidos=trim($_POST['apellido']);
    if(strlen($nombre)<3){
        $_SESSION['nombre']="*** El campo nombre debe tener al menos 3 caracteres";
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }
    if(strlen($apellidos)<3){
        $_SESSION['apellido']="*** El campo apellido debe tener al menos 3 caracteres";
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }
    (new Autores)->setNombre($nombre)
        ->setApellidos($apellidos)
        ->create();

    header('Location:index.php');
    die();
        

    

}else{
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
    <title>Crear Autor</title>
</head>
<body style="background-color:lemonchiffon">

    <h5 class="text-center mt-4">Crear Autor</h5>
    <div class="container">
        <form name='as' method='POST' action="<?php echo $_SERVER['PHP_SELF'] ?>" class="mx-auto bg-secondary px-4 py-4 rounded" style="width:50rem" enctype="multipart/form-data">

                <div class="mb-4">
                    <label for="n" class="form-label">Nombre</label>
                    <input type="text" id="n" class="form-control" placeholder="Autores" name="nombre" required>
                </div>
                <div class="mb-4">
                    <label for="a" class="form-label">Apellido</label>
                    <input type="text" id="n" class="form-control" placeholder="Autores" name="apellido" required>
                </div>

                <div>
                    <a href="index.php" class="btn btn-primary">
                        <i class="fas fa-backward"></i> Volver
                    </a>

                    <button type="submit" name="enviarForm" class="btn btn-info">
                        <i class="fa fa-save"></i> Guardar
                    </button>

                    <button type="reset" class="btn btn-warning">
                        <i class="fa fa-paintbrush"></i> Limpiar
                    </button>
                </div>
        </form>
    </div>
    
</body>
</html>
<?php } ?>