<!doctype html>
<html lang="en">

<head>
    <title>EXU5</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body style="background-image: url('img/fondo.jpg'); background-attachment:fixed; background-size:cover;" ;>
    <div class="container">
        <?php
        require_once 'templates/header.php';
        ?>


        <?php
        require_once 'templates/formulario.php';
        ?>
        <div id="contenendorformulario" class="container" style="background-color: rgb(161, 217, 255);">
            <header class="card-header  text-center ">
                <h1 class=" p-3">Articulos de Cat. Opinion</h1>
            </header>
            <table id="tablita" class="table table-striped ">
                <tbody>
                    <tr>
                        <th>Titulo</th>
                        <th>Subtitulo</th>
                        <th>Correo</th>
                        <th>Fecha de publicacion</th>
                        <th>Categoria</th>

                    </tr>

                    <?php
                    $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
                    $usuarioBD = "uww4txp33fwtwsd3";
                    $pwBD = "SOScyNtal6c2jEyoSEAz";
                    $nomBD = "bjmpkkoiv1c5rd7kgm65";
                    $db = mysqli_connect($servidor, $usuarioBD, $pwBD, $nomBD);                                            
                        $sql = "SELECT id_articulo, titulo, subtitulo, correo, fecha_publicacion, categoria FROM articulos WHERE categoria = 'Opinión'";
                        $resultado = mysqli_query($db, $sql);
                        if ($resultado) {
                        while ($row = $resultado->fetch_array()) {
                            $Id_articulo = $row['id_articulo'];
                            $Titulo = $row['titulo'];
                            $Subtitulo = $row['subtitulo'];
                            $Correo = $row['correo'];
                            $Fecha_publicacion = $row['fecha_publicacion'];
                            $Categoria = $row['categoria'];
                    ?>
                            <tr>
                                <td>
                                    <?php echo $Titulo ?>
                                </td>

                                <td>
                                    <?php echo $Subtitulo ?>
                                </td>

                                <td>
                                    <?php echo $Correo ?>
                                </td>
                                <td>
                                    <?php echo $Fecha_publicacion ?>
                                </td>

                                <td>
                                    <?php echo $Categoria ?>
                                </td>
                                <td>
                                <a href="ver.php?id=<?php echo $Id_articulo ?>"><img class="d-block w-100" src="img/OPINION.jpg" alt="Third slide"> </a>
                                   
                                </td>

                            </tr>
                    <?php
                        }
                        }
                    
                    ?>





                </tbody>
            </table>
        </div>



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
    <!--<script src="js/acciones.js" text="text/javascript"></script> -->

</body>

</html>