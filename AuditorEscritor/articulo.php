<?php
$servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
$usuarioBD = "uww4txp33fwtwsd3";
$pdwBD = "SOScyNtal6c2jEyoSEAz";
$nomBD = "bjmpkkoiv1c5rd7kgm65";
$conn = mysqli_connect($servidor, $usuarioBD, $pdwBD, $nomBD);

if (!$conn) {
    echo 'Error de conexión: ' . mysqli_connect_error();
}

//Recuperamos id del articulo
$id = $_GET['id'];

//Recolectamos datos del articulo
$sql = "SELECT * FROM articulos WHERE id_articulo = $id";

$resultado = mysqli_query($conn, $sql);
if ($resultado->num_rows == 1) {
    session_start();
    $articulo = mysqli_fetch_assoc($resultado);
}

$correo = $articulo["correo"];
$titulo = $articulo["titulo"];
$subtitulo = $articulo["subtitulo"];
$fecha = $articulo["fecha_publicacion"];
$categoria = $articulo["categoria"];
$estatus_articulo = $articulo["estatus_articulo"];
$contenido = $articulo["contenido"];

//Recolectamos datos del autor del articulo
$sql = "SELECT * FROM usuarios "
    . "WHERE correo = '$correo'  ";

$resultado = mysqli_query($conn, $sql); //$resultado
if ($resultado->num_rows == 1) {
    $autor = mysqli_fetch_assoc($resultado);
}

$nombre = $autor["nombre"];
$apellidos = $autor["apellidos"];

//Eliminación del articulo
if (isset($_POST['submit'])) {
    $sql = "UPDATE articulos SET estatus_articulo = 'eliminado' WHERE id_articulo = $id";

    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        header('Location: auditorEscritor.php');
    } else {
        echo "Error: " . $sql . ":" . mysqli_error($conn);
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Articulo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    
    
</head>

<body style="background:linear-gradient(rgb(46, 17, 83),rgb(12, 67, 131))">
    <div class="container">

        <?php
        require_once 'includes/header.php';
        ?>

        <br>

        <nav class="navbar justify-content" style="margin-top: -20px; background-color:rgb(14, 10, 20)">
            <div class="navbar justify-content" style="color: white" id="navbarSupportedContent;" >
                
                <form class="form-inline" action="escritores.php">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="color:white; border-color:purple">Escritores</button>
                </form>

                <form class="form-inline" action="auditorEscritor.php" style="margin-left:20px">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="color:white; border-color:purple">Artículos</button>
                </form>

                <form class="form-inline my-2 my-lg-0" style="margin-left: 460px">
                    <?php
                    if (isset($_SESSION["nombre"])) {
                        echo '<a class="nav-link btn btn-infoS" disabled><i class="fa fa-user" style="font-size: 25px;"></i>
                         Auditor de Escritores</a>';
                    }
                    ?>
                    
                    <?php
                    if (isset($_SESSION["nombre"])) {
                        echo '<a href="includes/cerrarSesion.php" class="nav-link btn btn-danger" onclick="cerrarSesion()" style="margin-left: 15px; cursor: pointer; color:white; background-color:blue; border-color:blue"><i class="fa fa-sign-out-alt" style="font-size: 25px;"></i> Cerrar Sesión</a>';
                    } else {
                        echo '<a id="login" class="nav-link btn btn-primary" onclick="muestraForm()" style="margin-left: 15px; cursor: pointer;"><i class="fa fa-sign-in-alt" style="font-size: 25px;"></i> Iniciar Sesión</a>';
                    }
                    ?>

                </form>
            </div>
        </nav>

        <br>

        <div class="card">
            <div class="card-body" style="background:linear-gradient(rgb(46, 17, 83),rgb(12, 67, 131)); border-radius: 15px">
                <br>
                <div class="row" style="align:center; padding:0px">
                    <div class="offset-md-2 col-md-8 offset-md-2">
                        <!-- Categoria -->
                        <h4 style="color: white; text-align: left;">| <?php echo $categoria?> |</h4>
                        <!-- Titulo -->
                        <h1 style="color: white; text-align: center;"><b><?php echo $titulo?></b></h1>
                        <!-- Autor y fecha -->
                        <p style="color: white; text-align:left">
                            <pre><a href="escritor.php?correo=<?php echo $correo;?>">Por <?php echo $nombre?> <?php echo $apellidos?></a>                                       <a href="#"><?php echo "Fecha de publicación:"?> <?php echo $fecha?></a></pre>    
                        </p>
                        <!-- Separador -->
                        <p>
                            <pre style="color: white">___________________________________________________________________________________________</pre>    
                        </p>
                        <!-- Subtitulo -->
                        <h5 style="color: white; text-align: left;"><?php echo $subtitulo?></h5>
                        <!-- Contenido -->
                        <br>
                        <p style="color: white; text-align:justified">
                            <?php echo $contenido?>
                        </p>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <form class="form-inline" method="POST" style="margin-left:970px">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="submit" name='submit' style="color:white; border-color:red; background-color:red">Eliminar artículo</button>
        </form>

        <br>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>