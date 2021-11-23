<?php
session_start();
$servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
$usuarioBD = "uww4txp33fwtwsd3";
$pdwBD = "SOScyNtal6c2jEyoSEAz";
$nomBD = "bjmpkkoiv1c5rd7kgm65";
$db = mysqli_connect($servidor, $usuarioBD, $pdwBD, $nomBD);

$query = "SELECT * FROM usuarios WHERE rol = 'escritor' AND estatus NOT LIKE 'eliminado'";
$resultado = mysqli_query($db, $query);
$mostrar = mysqli_fetch_array($resultado);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Escritores</title>
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
                
                <form class="form-inline">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="color:white; border-color:purple; background-color:purple">Escritores</button>
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
            <div class="card-body" style="background:linear-gradient(rgb(46, 17, 83),rgb(12, 67, 131)); border-radius: 15px;">
                <br>
                <div class="row" style="align:center">

                    <div class="offset-md-2 col-md-8 offset-md-2">
                        <h1 style="color: white; text-align: center;"><b>Escritores</b></h1>
                        <hr>
                        <table class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr style="align:center">
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Profesión</th>
                                    <th>Perfil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($mostrar) {
                                    while ($mostrar = mysqli_fetch_array($resultado)) {
                                        $correo = $mostrar["correo"];
                                        $nombre = $mostrar["nombre"];
                                        $apellidos = $mostrar["apellidos"];
                                        $profesion = $mostrar["profesion"];
                                        echo '<tr align="center">';
                                        echo "<td>" . $nombre . "</td>";
                                        echo "<td>" . $apellidos . "</td>";
                                        echo "<td>" . $profesion . "</td>";
                                        echo '<td><a href="escritor.php?correo=' . $correo . '" class="btn btn-info"><i class="fa fa-info-circle">Mostrar datos</i></a></td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr align="center">';
                                    echo '<td colspan="2">Tabla sin registros</td>';
                                    echo '</td>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>