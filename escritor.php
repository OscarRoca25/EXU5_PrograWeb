<?php
$servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
$usuarioBD = "uww4txp33fwtwsd3";
$pdwBD = "SOScyNtal6c2jEyoSEAz";
$nomBD = "bjmpkkoiv1c5rd7kgm65";
$conn = mysqli_connect($servidor, $usuarioBD, $pdwBD, $nomBD);

if (!$conn) {
    echo 'Error de conexión: ' . mysqli_connect_error();
}

//Recuperamos correo del escritor
$correo = $_GET['correo'];

//Recuperamos datos del escritor
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";

$resultado = mysqli_query($conn, $sql);
if ($resultado->num_rows == 1) {
    session_start();
    $escritor = mysqli_fetch_assoc($resultado);
}

$nombre = $escritor["nombre"];
$apellidos = $escritor["apellidos"];
$estatus = $escritor["estatus"];
$referencias = $escritor["referencias"];
$profesion = $escritor["profesion"];
$facebook = $escritor["facebook"];
$twitter = $escritor["twitter"];

//Recuperamos articulos del escritor
$sql = "SELECT * FROM articulos WHERE correo = '$correo' AND estatus_articulo = 'publicado'";
$resultado = mysqli_query($conn, $sql);

//Sancionar escritor
if (isset($_POST['submitS'])) {
    $sql = "UPDATE usuarios SET estatus = 'suspendido' WHERE correo ='$correo'";

    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        header('Location: escritores.php');
    } else {
        echo "Error: " . $sql . ":" . mysqli_error($conn);
    }
}

//Eliminar escritor
if (isset($_POST['submitE'])) {
    $sql = "UPDATE usuarios SET estatus = 'eliminado' WHERE correo = '$correo'";

    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        header('Location: escritores.php');
    } else {
        echo "Error: " . $sql . ":" . mysqli_error($conn);
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Perfil de escritor</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body style="background-image: url('img/fondoG.jpeg'); background-size:cover; background-attachment:fixed">
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

        <div class="card" style="background:linear-gradient(rgba(46, 17, 83,0.5),rgba(12, 67, 131,0.5))">
            <div class="card-body" style="background:linear-gradient(rgba(46, 17, 83, 0.5),rgba(12, 67, 131, 0.5)); border-radius: 15px">
                <br>
                <div class="row" style="align:center; padding:0px">
                    <div class="offset-md-2 col-md-8 offset-md-2">
                        <h2 style="color: white; text-align: center;"><b>Perfil de escritor</b></h2>
                        <!-- Separador -->
                        <p>
                            <pre style="color: white">___________________________________________________________________________________________</pre>    
                        </p>
                        <!-- Nombre y Apellidos -->
                        <h3 style="color: white; text-align: left;"><?php echo $nombre?> <?php echo $apellidos?></h3>
                        <!-- Estatus -->
                        <p style="text-align: left;">
                            <h6 style="color: white">Estatus: <?php echo $estatus?></h6>
                        </p>
                        <!-- Referencias -->
                        <p style="text-align: left;">
                            <h6 style="color: white">Referencias</h6>
                            <p style="color: white"><?php echo $referencias?></p>
                        </p>
                        <!-- Profesión -->
                        <p style="text-align: left;">
                            <h6 style="color: white">Profesión</h6>
                            <p style="color: white"><?php echo $profesion?></p>
                        </p>
                        <!-- Redes sociales -->
                        <p style="text-align: left;">
                            <h6 style="color: white">Redes sociales</h6>
                            <p style="color: white">
                                Facebook: <?php echo $facebook?>
                                <br>
                                Twitter: <?php echo $twitter?>
                            </p>
                        </p>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        
        <br>

        <div class="card" style="background:linear-gradient(rgba(46, 17, 83,0.5),rgba(12, 67, 131,0.5))">
            <div class="card-body" style="background:linear-gradient(rgba(46, 17, 83, 0.5),rgba(12, 67, 131, 0.5)); border-radius: 15px;">
                <br>
                <div class="row" style="align:center">
                    <div class="offset-md-2 col-md-8 offset-md-2">
                        <h2 style="color: white; text-align: center;"><b>Articulos publicados</b></h2>
                        <hr>
                        <table class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr style="align:center">
                                <th>Categoria</th>
                                <th>Nombre</th>
                                <th>Fecha de publicación</th>
                                <th>Artículo</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if ($resultado) {
                                    while ($articulos = mysqli_fetch_array($resultado)) {
                                        $id = $articulos["id_articulo"];
                                        $categoria = $articulos["categoria"];
                                        $titulo = $articulos["titulo"];                                      
                                        $fecha = $articulos["fecha_publicacion"];
                                        
                                        echo '<tr align="center">';
                                        echo "<td>" . $categoria . "</td>";
                                        echo "<td>" . $titulo . "</td>";
                                        echo "<td>" . $fecha . "</td>";
                                        echo '<td><a href="articulo.php?id=' . $id . '" class="btn btn-info"><i class="fa fa-info-circle"> Ver</i></a></td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr align="center">';
                                    echo '<td>No hay articulos publicados</td>';
                                    echo '</td>';
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <br>

        <form class="form-inline" method="POST" style="margin-left:795px">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submitS" id="submitS" name='submitS' style="color:white; border-color:orange; background-color:orange">Sancionar escritor</button>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submitE" id="submitE" name='submitE' style="color:white; border-color:red; background-color:red; margin-left:20px">Eliminar escritor</button>
        </form>

        <br>

        <?php
        require_once 'includes/footer.php';
        ?>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>