

    <!doctype html>
<html lang="en">

<head>
    <title>Ver Articulo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="background-image: url('img/fondo.jpg'); background-attachment:fixed; background-size:cover;" ;>

    <div class="container">
        <div class="jumbotron" align="center" style="background-image: url('img/fondo_header.jpg'); background-size:cover;">
            <h1 style="margin-top: -25px; font-size: 48px; color:white"><b> Agujeros Negros </b></h1>
        </div>

        <nav class="navbar justify-content-end navbar-dark bg-dark" style="margin-top: -25px;">

            <button id="botoncito" type="button" class="btn btn-secondary btn-lg"><a class="badge badge-secondary" href="index.php">Inicio</a></button>
            <nav class="navbar navbar-dark bg-dark">
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </nav>

        </nav>
        <div id="contenendorformulario" class="container" style="background-color: rgb(161, 217, 255); ">
            <header class="card-header  text-center ">
                <h1 class=" p-3">Articulo</h1>
            </header>
            <table id="tablita" class="table table-striped ">
                <tbody>


                    <?php
                    $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
                    $usuarioBD = "uww4txp33fwtwsd3";
                    $pwBD = "SOScyNtal6c2jEyoSEAz";
                    $nomBD = "bjmpkkoiv1c5rd7kgm65";
                    $id = $_GET["id"];

                    $db = mysqli_connect($servidor, $usuarioBD, $pwBD, $nomBD);
                    if (!$db) {
                        die("La coneccion fallo: " . mysqli_connect_error());
                    } else {
                        mysqli_query($db, "SET NAMES 'UTF8'");
                    }

                    $sql = "SELECT id_articulo, titulo, subtitulo, correo, fecha_publicacion, categoria, contenido FROM articulos WHERE id_articulo ='$id'";
                    $resultado = mysqli_query($db, $sql);
                    if ($resultado) {
                        while ($row = $resultado->fetch_array()) {
                            $Id_articulo = $row['id_articulo'];
                            $Titulo = $row['titulo'];
                            $Subtitulo = $row['subtitulo'];
                            $Correo = $row['correo'];
                            $Fecha_publicacion = $row['fecha_publicacion'];
                            $Categoria = $row['categoria'];
                            $Contenido = $row['contenido'];

                    ?>
                            <tr>
                                <td>
                                <strong><?php echo 'Titulo' ?></strong>
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $Titulo ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <strong><?php echo 'Subitulo' ?></strong>
                                   
                                </td>
                            </tr>
                            <td>
                                <?php echo $Subtitulo ?>
                            </td>
                            <tr>
                            <tr>
                                <td>
                                <strong><?php echo 'Correo' ?></strong>
                                   
                                </td>
                            </tr>
                                <td>
                                    <?php echo $Correo ?>
                                </td>
                            <tr>
                            <tr>
                                <td>
                                <strong><?php echo 'Fecha' ?></strong>
                                   
                                </td>
                            </tr>
                                <td>
                                    <?php echo $Fecha_publicacion ?>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td>
                                <strong><?php echo 'Categoria' ?></strong>
                                   
                                </td>
                            </tr>
                                <td>
                                    <?php echo $Categoria ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <strong><?php echo 'Contenido' ?></strong>
                                   
                                </td>
                            </tr>
                                <td>
                                    <?php echo $Contenido ?>
                                </td>
                            </tr>

                            </tr>
                    <?php

                        }
                    }
                    ?>



                </tbody>
            </table>
        </div>



        <script>
            function muestraForm() {
                $("#formulario").removeAttr("hidden");
            }
        </script>
    </div>



        <script>
            function muestraForm() {
                $("#formulario").removeAttr("hidden");
            }
        </script>
    </div>


    <?php
        require_once 'templates/footer.php';
        ?>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>