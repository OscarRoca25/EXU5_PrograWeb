<?php session_start(); error_reporting(E_ALL ^ E_NOTICE); ?>
<!doctype html>
<html lang="es">

<head>
    <title>Escritor</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <style>
        form li:hover{
            color:black;
        }
        .error{
            margin-left: 10px;
        }
        
        /* The container <div> - needed to position the dropdown content */
        .dropdown {
        position: relative;
        display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
        padding-top: 3px;
        display: none;
        position: absolute;
        background-color: transparent;
        min-width: 250px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
        color: black;
        text-decoration: none;
        display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: rgb(140, 139, 139);}

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {display: block;}

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {background-color: rgb(140, 139, 139);}

        input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }

    input[type=number] { -moz-appearance:textfield; }
    </style>
</head>

<body style="background-image: url('img/fondo.jpg'); background-attachment:fixed; background-size:cover;";>
    <div class="container">
        <?php
        require_once 'includes/header.php';
        ?>
        <nav class="navbar  navbar-dark bg-dark" style="margin-top: -25px;">
            <div class="navbar navbar-dark bg-dark" style="color: white" id="navbarSupportedContent;" >
                
                <form class="form-inline my-2 my-lg-0">
                    <ul class="nav nav-tabs">
                        <li class="nav-item" style="cursor: pointer;"><a id="inicio" class="nav-link active"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
                        <li class="nav-item" style="cursor: pointer;"><a id="articulos" class="nav-link"><i class="fa fa-books" aria-hidden="true"></i> Mis Artículos</a></li>
                        <li class="nav-item" style="cursor: pointer;"><a id="perfil" class="nav-link"><i class="fa fa-user-circle" aria-hidden="true"></i> Mi Perfil</a></li>
                    </ul>
                    <?php
                        echo '<a class=" btn btn-infoS" disabled style="margin-left:120px; margin-right:190px;"><i class="fa fa-user" style="font-size: 25px;"></i> 
                        Bienvenido '. $_SESSION["nombre"] .'</a>';
                    ?>
                    <a href="login.php" class=" btn btn-danger" style="cursor: pointer;"><i class="fa fa-sign-out-alt" ></i> Cerrar Sesión</a>

                </form>
            </div>
        </nav>
        <div class="offset-md-1 col-md-10 offset-md-1">
            <div id="divInicio">
                <h3 style="color: white;">Búsqueda de Artículos</h3>
                <form action="escritor.php" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="categoria" style="color: white; font-size: large;"><b>Categoría:</b></label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option>Todas</option>
                                <option>Opinión</option>
                                <option>Investigación</option>
                                <option>Perspectiva</option>
                                <option>Revisión</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="titulo" style="color: white; font-size: large;"><b>Título del artículo:</b></label>
                            <input class="form-control" type="text" name="titulo" id="titulo" placeholder="Título del artículo">
                        </div>
                        <input type="text" name="pestania" id="pestania" value="inicio" hidden>
                        <button type="submit" class="btn btn-success" style="height: 50%; margin-top: 3.8%;"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                    </div>
                </form>
                <br>
                <br>
                <table id="tablaArticulos" name="tablaArticulos" class="table-hover table-striped table-bordered" style="width: 100%;">
                    <thead style="text-align: center;">
                        <tr><th style="color:white;">Artículos</th></tr>
                    </thead>
                    <tbody id="cuerpoTabla" style="text-align:justify; background-color: silver; color:black;">
                        <?php
                        $bandera = false;
                        $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
                        $usuarioBD = "uww4txp33fwtwsd3";
                        $pwd = "SOScyNtal6c2jEyoSEAz";
                        $nombBD = "bjmpkkoiv1c5rd7kgm65";
                        $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
                        if(!$db){
                            die("La conexión falló: ".mysqli_connect_error());
                        }else{
                            mysqli_query($db, "SET NAMES 'UTF8'");
                        }
                        $sql = "SELECT * FROM articulos a, usuarios u WHERE estatus_articulo='Publicado' AND a.correo=u.correo ORDER BY fecha_publicacion DESC;";
                        $resultados = mysqli_query($db, $sql);
                        while($query = mysqli_fetch_array($resultados)){
                            $bandera = true;
                            echo "<tr id='".$query['id_articulo']."'><td><b>".$query['titulo']."</b>-".$query['apellidos'].", ".$query['nombre'].". Publicado el ".$query["fecha_publicacion"].". Haga click aquí para leer el artículo.</td></tr>";
                        }
                        if(!$bandera){
                            echo "<tr style='text-align:center'><td>Lo sentimos... aún no tenemos artículos con las características buscadas</td></tr>";
                        }
                        
                        mysqli_close($db);
                        ?>
                    </tbody>
                </table>
                <form id="formMostrarArt" action="escritor.php" method="POST">
                    <input type="number" name="noArt" id="noArt" hidden>
                    <input type="text" name="pestaniaPost" id="pestaniaPost" hidden>
                    <input type="text" name="tipoTabla" id="tipoTabla" value="" hidden>
                </form>
                <br><br>
                <div id="articuloSeleccionado" name="articuloSeleccionado" style="background-color: white;">
                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST") {
                        $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
                        $usuarioBD = "uww4txp33fwtwsd3";
                        $pwd = "SOScyNtal6c2jEyoSEAz";
                        $nombBD = "bjmpkkoiv1c5rd7kgm65";
                        $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
                        $pestania = $_POST["pestaniaPost"];
                        $bandera = false;
                        if($pestania == 'inicio'){
                            if(!$db){
                                die("La conexión falló: ".mysqli_connect_error());
                            }else{
                                mysqli_query($db, "SET NAMES 'UTF8'");
                            }
                            $sql = "SELECT * FROM articulos a, usuarios u WHERE a.correo=u.correo AND id_articulo=".$_POST["noArt"].";";
                            $resultados = mysqli_query($db, $sql);
                            while($query = mysqli_fetch_array($resultados)){
                                $html = "<h1>".$query["titulo"]."</h1><h3>-".$query["apellidos"].", ".$query["nombre"]."</h3><p><b>Categoría: </b>".$query["categoria"]."</p><h4>".$query["subtitulo"]."</h4><h5>Publicado el ".$query["fecha_publicacion"]."</h5><p>".$query["contenido"]."</p>";             
                            }
                            echo $html;
                            echo "<hr>";
                            echo "<h3 style='text-align:center;'>Comentarios</h3>";
                            $sql = "SELECT * FROM comentarios c, usuarios u WHERE c.correo=u.correo AND estatus_comentario='Publicado' AND id_articulo=".$_POST["noArt"].";";
                            $resultados = mysqli_query($db, $sql);
                            while($query = mysqli_fetch_array($resultados)){
                                $bandera = true;
                                echo "<p style='margin-left:10px; margin-right:40px; margin-bottom:0%;'><b>".$query["nombre"]." ".$query["apellidos"]." (".$query["correo"].")</b></p><p style='margin-left:10px; margin-right:200px; margin-top:1px; margin-bottom:20px; padding:20px; border: 1px solid black;'>".$query["contenido"]."</p>";
                            }
                            echo "<hr>";
                            mysqli_close($db);
                            if(!$bandera){
                                echo "<p style='color: gray; text-align:center;'>Aún no hay comentarios para este artículo</p>";
                            }
                            
                        }
                    }
                    ?>
                </div>
            </div>
            <div id="divArticulos">
                <br><br><br>
                <div class="navbar navbar-dark bg-dark" style="border-radius: 10px; ">
                    <h3 style="color:white;">Hola, <?php echo $_SESSION["nombre"]; ?>, ¿qué desea hacer?</h3>
                    <div class="dropdown">
                        <button class="dropbtn navbar-toggler"><span class="navbar-toggler-icon"></span></button>
                        <div class="dropdown-content">
                            <button id="btnListaPublicados" class="btn btn-primary" style="margin-bottom: 3px; width: 100%;"><i class="fa fa-eye" aria-hidden="true"></i> Ver Artículos Publicados</button>
                            <button id="btnListaNoPublicados" class="btn btn-secondary" style="margin-bottom: 3px; width: 100%;"><i class="fa fa-eye-slash" aria-hidden="true"></i> Ver Artículos No Publicados</button>
                            <button id="btnCrearArticulo" class="btn btn-success" style="margin-bottom: 3px; width: 100%;"><i class="fa fa-pencil" aria-hidden="true"></i> Crear un nuevo artículo</button>
                        </div>
                    </div>
                </div>
                <br>
                <img src="img/blackHole.gif" alt="Imagen Agujero Negro" height="250px" style="margin-left: 20%; margin-bottom: 10px;">
                <br>
                <div id="divArtPublicados">
                    <table id="tablaArticulosPublicados" name="tablaArticulosPublicados" class="table-hover table-striped table-bordered" style="width: 100%;">
                        <thead style="text-align: center;">
                            <tr><th style="color:white;">Artículos Publicados</th></tr>
                        </thead>
                        <tbody id="cuerpoTabla" style="text-align:justify; background-color: silver; color:black;">
                            <?php
                            $bandera = false;
                            $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
                            $usuarioBD = "uww4txp33fwtwsd3";
                            $pwd = "SOScyNtal6c2jEyoSEAz";
                            $nombBD = "bjmpkkoiv1c5rd7kgm65";
                            $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
                            if(!$db){
                                die("La conexión falló: ".mysqli_connect_error());
                            }else{
                                mysqli_query($db, "SET NAMES 'UTF8'");
                            }
                            $sql = "SELECT * FROM articulos a, usuarios u WHERE estatus_articulo='Publicado' AND a.correo=u.correo AND a.correo = '".$_SESSION["correo"]."'ORDER BY fecha_publicacion DESC;";
                            $resultados = mysqli_query($db, $sql);
                            while($query = mysqli_fetch_array($resultados)){
                                $bandera = true;
                                echo "<tr id='".$query['id_articulo']."'><td><b>".$query['titulo']."</b>-".$query['apellidos'].", ".$query['nombre'].". Publicado el ".$query["fecha_publicacion"].". Haga click aquí para leer el artículo.</td></tr>";
                            }
                            if(!$bandera){
                                echo "<tr style='text-align:center'><td>Lo sentimos... usted aún no cuenta con artículos publicados.</td></tr>";
                            }
                            
                            mysqli_close($db);
                            ?>
                        </tbody>
                    </table>
                    <br><br>
                    <div id="articuloPublicadoSeleccionado" name="articuloPublicadoSeleccionado" style="background-color: white;">
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST") {
                            $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
                            $usuarioBD = "uww4txp33fwtwsd3";
                            $pwd = "SOScyNtal6c2jEyoSEAz";
                            $nombBD = "bjmpkkoiv1c5rd7kgm65";
                            $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
                            $pestania = $_POST["pestaniaPost"];
                            $articulos = $_POST["tipoTabla"];
                            $bandera = false;
                            if($pestania == 'articulos' && $articulos == 'publicados'){
                                if(!$db){
                                    die("La conexión falló: ".mysqli_connect_error());
                                }else{
                                    mysqli_query($db, "SET NAMES 'UTF8'");
                                }
                                $sql = "SELECT * FROM articulos a, usuarios u WHERE a.correo=u.correo AND id_articulo=".$_POST["noArt"].";";
                                $resultados = mysqli_query($db, $sql);
                                while($query = mysqli_fetch_array($resultados)){
                                    $html = "<h1>".$query["titulo"]."</h1><h3>-".$query["apellidos"].", ".$query["nombre"]."</h3><p><b>Categoría: </b>".$query["categoria"]."</p><h4>".$query["subtitulo"]."</h4><h5>Publicado el ".$query["fecha_publicacion"]."</h5><p>".$query["contenido"]."</p>";             
                                }
                                echo $html;
                                echo "<hr>";
                                echo "<h3 style='text-align:center;'>Comentarios</h3>";
                                $sql = "SELECT * FROM comentarios c, usuarios u WHERE c.correo=u.correo AND estatus_comentario='Publicado' AND id_articulo=".$_POST["noArt"].";";
                                $resultados = mysqli_query($db, $sql);
                                while($query = mysqli_fetch_array($resultados)){
                                    $bandera = true;
                                    echo "<p style='margin-left:10px; margin-right:40px; margin-bottom:0%;'><b>".$query["nombre"]." ".$query["apellidos"]." (".$query["correo"].")</b></p><p style='margin-left:10px; margin-right:200px; margin-top:1px; margin-bottom:20px; padding:20px; border: 1px solid black;'>".$query["contenido"]."</p>";
                                }
                                echo "<hr>";
                                mysqli_close($db);
                                if(!$bandera){
                                    echo "<p style='color: gray; text-align:center;'>Aún no hay comentarios para este artículo</p>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div id="divArtCreados">
                    <table id="tablaArticulosCreados" name="tablaArticulosCreados" class="table-hover table-striped table-bordered" style="width: 100%;">
                        <thead style="text-align: center;">
                            <tr><th style="color:white;">Artículos No Publicados</th></tr>
                        </thead>
                        <tbody id="cuerpoTabla" style="text-align:justify; background-color: silver; color:black;">
                            <?php
                            $bandera = false;
                            $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
                            $usuarioBD = "uww4txp33fwtwsd3";
                            $pwd = "SOScyNtal6c2jEyoSEAz";
                            $nombBD = "bjmpkkoiv1c5rd7kgm65";
                            $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
                            if(!$db){
                                die("La conexión falló: ".mysqli_connect_error());
                            }else{
                                mysqli_query($db, "SET NAMES 'UTF8'");
                            }
                            $sql = "SELECT * FROM articulos a, usuarios u WHERE estatus_articulo='Creado' AND a.correo=u.correo AND a.correo = '".$_SESSION["correo"]."'ORDER BY fecha_publicacion DESC;";
                            $resultados = mysqli_query($db, $sql);
                            while($query = mysqli_fetch_array($resultados)){
                                $bandera = true;
                                echo "<tr id='".$query['id_articulo']."'><td><b>".$query['titulo']."</b>-".$query['apellidos'].", ".$query['nombre'].". Haga click aquí para proceder a la edición del artículo.</td></tr>";
                            }
                            if(!$bandera){
                                echo "<tr style='text-align:center'><td>Lo sentimos... usted no tiene artículos creados y listos para editar</td></tr>";
                            }
                            
                            mysqli_close($db);
                            ?>
                        </tbody>
                    </table>
                    <br><br>
                    <div id="articuloCreadoSeleccionado" name="articuloCreadoSeleccionado">
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST") {
                            $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
                            $usuarioBD = "uww4txp33fwtwsd3";
                            $pwd = "SOScyNtal6c2jEyoSEAz";
                            $nombBD = "bjmpkkoiv1c5rd7kgm65";
                            $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
                            $pestania = $_POST["pestaniaPost"];
                            $articulos = $_POST["tipoTabla"];
                            $bandera = false;
                            if($pestania == 'articulos' && $articulos == 'creados'){
                                if(!$db){
                                    die("La conexión falló: ".mysqli_connect_error());
                                }else{
                                    mysqli_query($db, "SET NAMES 'UTF8'");
                                }
                                $sql = "SELECT * FROM articulos a, usuarios u WHERE a.correo=u.correo AND id_articulo=".$_POST["noArt"].";";
                                $resultados = mysqli_query($db, $sql);
                                while($query = mysqli_fetch_array($resultados)){
                                    $html = "<form id='editarArticulo' name='editarArticulo' action='escritor.php' method='POST' style='color: white; background:linear-gradient(black,gray); padding: 50px 50px;'>
                                                <label for='tituloEd'><h2>Título:</h2></label>
                                                <input type='text' id='tituloEd' name='tituloEd' class='form-control' value='".$query["titulo"]."'>
                                                <label for='subtituloEd'><h3>Subtítulo:</h3></label>
                                                <textarea id='subtituloEd' name='subtituloEd' class='form-control' style='resize:none;'>".$query["subtitulo"]."</textarea>
                                                <label for='contenidoEd'><h5>Contenido:</h5></label>
                                                <textarea id='contenidoEd' name='contenidoEd' class='form-control' style='height:400px; resize:none;'>".$query["contenido"]."</textarea>
                                                <input type='text' id='opcEd' name='opcEd' hidden>
                                                <input type='number' id='noArtEd' name='noArtEd' value='".$_POST["noArt"]."' hidden>
                                                <input type='text' id='pestaniaPost' name='pestaniaPost' value='articulos' hidden>
                                                <input type='text' id='tipoTabla' name='tipoTabla' hidden>
                                                <br>
                                                <button id='btnCancelarEd' name='btnCancelarEd' type='button' class='btn btn-danger' style='margin-right:400px;'><i class='fa fa-times'></i> Cancelar</button>
                                                <button id='btnGuardarEd' name='btnGuardarEd' type='button' class='btn btn-primary'><i class='fas fa-save'></i> Guardar</button>
                                                <button id='btnPublicarEd' name='btnPublicarEd' type='button' class='btn btn-success'><i class='fa fa-upload' aria-hidden='true'></i> Publicar</button>
                                            </form>";
                                }
                                echo $html;
                                mysqli_close($db);
                                
                            }
                        }
                        ?>
                    </div>
                </div>
                <div id="divCrearArticulo">
                    <form id='crearArticulo' name='crearArticulo' action='escritor.php' method='POST' style='color: white; background:linear-gradient(black,gray); padding: 50px 50px;'>
                        <label for='tituloCrear'><h2>Título:</h2></label>
                        <input type='text' id='tituloCrear' name='tituloCrear' class='form-control' placeholder="Título del artículo">
                        <label for="categoriaCrear"><h5>Categoría:</h5></label>
                        <div class="row"><div class="col-md-2"><select id="categoriaCrear" name="categoriaCrear" class="form-control"><option value="Opinión">Opinión</option><option value="Investigación">Investigación</option><option value="Perspectiva">Perspectiva</option><option value="Revisión">Revisión</option></select></div></div>
                        <label for='subtituloCrear'><h3>Subtítulo:</h3></label>
                        <textarea id='subtituloCrear' name='subtituloCrear' class='form-control' style='resize:none;' placeholder="Subtítulo del artículo"></textarea>
                        <label for='contenidoCrear'><h5>Contenido:</h5></label>
                        <textarea id='contenidoCrear' name='contenidoCrear' class='form-control' style='height:400px; resize:none;' placeholder="Contenido del artículo"></textarea>
                        <input type='text' id='opcCrear' name='opcCrear' hidden>
                        <input type='text' id='pestaniaPost' name='pestaniaPost' value='articulos' hidden>
                        <br>
                        <button id='btnCancelarCrear' name='btnCancelarCrear' type='button' class='btn btn-danger' style='margin-right:400px;'><i class='fa fa-times'></i> Cancelar</button>
                        <button id='btnGuardarCrear' name='btnGuardarCrear' type='button' class='btn btn-primary'><i class='fas fa-save'></i> Guardar</button>
                        <button id='btnPublicarCrear' name='btnPublicarCrear' type='button' class='btn btn-success'><i class='fa fa-upload' aria-hidden='true'></i> Publicar</button>
                    </form>
                </div>
            </div>
            <div id="divPerfil">
                <?php
                $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
                $usuarioBD = "uww4txp33fwtwsd3";
                $pwd = "SOScyNtal6c2jEyoSEAz";
                $nombBD = "bjmpkkoiv1c5rd7kgm65";
                $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
                if(!$db){
                    die("La conexión falló: ".mysqli_connect_error());
                }else{
                    mysqli_query($db, "SET NAMES 'UTF8'");
                }
                $sql = "SELECT * FROM usuarios WHERE correo = '".$_SESSION["correo"]."';";
                $resultados = mysqli_query($db, $sql);
                while($query = mysqli_fetch_array($resultados)){
                    $correoPerf = $query["correo"];
                    $nombrePerf = $query["nombre"]." ".$query["apellidos"];
                    $fechaPerf = $query["fecha_nac"];
                    $rfcPerf = $query["rfc"];
                    $direccionPerf = $query["direccion"];
                    $telefonoPerf = $query["telefono"];
                    $referenciasPerf = $query["referencias"];
                    $profesionPerf = $query["profesion"];
                    $facebookPerf = $query["facebook"];
                    $twitterPerf = $query["twitter"];
                }
                mysqli_close($db);
                ?>
                <form id='actualizarDatos' name='actualizarDatos' action="escritor.php" method="POST" style='margin:10px auto; color: white; background:linear-gradient(black,gray); padding: 50px 50px;' >
                    <label>Los campos con asterísco (*) son obligatorios.</label>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="correo" style="font-size: 18px;"> <i class="fa fa-at" aria-hidden="true"></i> Correo: </label><br>
                            <input class="form-control" type="email" name="correo" id="correo" value="<?php echo $correoPerf ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="nombre"><i class="fa fa-user" aria-hidden="true"></i> Nombre:</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $nombrePerf ?>" readonly>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label for="fechNac"><i class="fa fa-birthday-cake" aria-hidden="true"></i> Fecha de nacimiento:</label>
                            <input class="form-control" type="date" name="fechNac" id="fechNac" value="<?php echo $fechaPerf ?>"  readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="rfc"><i class="fa fa-hashtag" aria-hidden="true"></i> RFC:</label>
                            <input class="form-control" type="text" name="rfc" id="rfc" value="<?php echo $rfcPerf ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="direccion"><i class="fa fa-globe-americas" aria-hidden="true"></i> Dirección:</label><label class="error">*</label>
                            <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Dirección" title="Ingrese la dirección de su domicilio." value="<?php echo $direccionPerf ?>" required>
                        </div>
                    </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="telefono"><i class="fa fa-phone" aria-hidden="true"></i> Teléfono:</label><label class="error">*</label>
                                    <input class="form-control" type="number" name="telefono" id="telefono" placeholder="Teléfono" minlength="6" pattern="[0-9]{10,10}" value="<?php echo $telefonoPerf ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="referencias"><i class="fa fa-books" aria-hidden="true"></i> Referencias:</label><label class="error">*</label>
                                    <input class="form-control" type="text" name="referencias" id="referencias" placeholder="Link (enlace) a algún trabajo publicado por usted previamente." title="Ingrese el link de alguno de sus artículos publicados previamente en algún otro sitio web." value="<?php echo $referenciasPerf ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="profesion"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Profesión:</label><label class="error">*</label>
                                    <input class="form-control" type="text" name="profesion" id="profesion" placeholder="Profesión" title="Ingrese su profesión." value="<?php echo $profesionPerf ?>" required>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 30%;">
                                <h4><i class="fas fa-user-friends"></i> Redes sociales</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="facebook"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook:</label>
                                    <input class="form-control" type="text" name="facebook" id="facebook" placeholder="Usuario de Facebook" title="Ingrese su nombre de usuario de su cuenta de Facebook" value="<?php echo $facebookPerf ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="twitter"><i class="fab fa-twitter"></i> Twitter:</label>
                                    <input class="form-control" type="text" name="twitter" id="twitter" placeholder="Usuario de Twitter" title="Ingrese su nombre de usuario de su cuenta de Twitter" value="<?php echo $twitterPerf ?>">
                                </div>
                            </div>
                            <input name="actualizar" id="actualizar" value="actualizar" hidden>
                            <input name="pestaniaPost" id="pestaniaPost" value="perfil" hidden>
                            <br>
                            <div class="offset-md-9 col-md-3">
                                <button type="submit" class="btn btn-success" ><i class="fas fa-save"></i> Guardar Cambios</button>
                            </div>
                </form>
            </div>
        </div>

        <?php
        require_once 'includes/footer.php';
        ?>
        
    </div>

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
            $("#divArtPublicados").hide();
            $("#divArtCreados").hide();
            $("#divCrearArticulo").hide();
            $("#divArticulos").hide();
            $("#divPerfil").hide();
            $(".nav-link").click(function(){
                $("#inicio").removeClass('active');
                $("#articulos").removeClass('active');
                $("#perfil").removeClass('active');
                $(this).addClass('active');
            });
            $("#inicio").click(function(){
                $("#divArticulos").hide();
                $("#divPerfil").hide();
                $("#divInicio").show();
            });
            $("#articulos").click(function(){
                $("#divInicio").hide();
                $("#divPerfil").hide();
                $("#divArticulos").show();
            });
            $("#perfil").click(function(){
                $("#divArticulos").hide();
                $("#divInicio").hide();
                $("#divPerfil").show();
            });
            $('#tablaArticulos tbody tr').click(function(){
                console.log($(this).attr('id'));
                $("#noArt").val($(this).attr('id'));
                $("#pestaniaPost").val('inicio');
                $("#formMostrarArt").submit();
            });
            $("#btnListaPublicados").click(function(){
                $("#divArtCreados").hide();
                $("#divCrearArticulo").hide();
                $("#divArtPublicados").show();
            });
            $("#btnListaNoPublicados").click(function(){
                $("#divCrearArticulo").hide();
                $("#divArtPublicados").hide();
                $("#divArtCreados").show();
            });
            $("#btnCrearArticulo").click(function(){
                $("#divArtCreados").hide();
                $("#divArtPublicados").hide();
                $("#divCrearArticulo").show();
                $("#tipoTabla").val('crearArticulo');
            });
            $('#tablaArticulosPublicados tbody tr').click(function(){
                console.log($(this).attr('id'));
                $("#noArt").val($(this).attr('id'));
                $("#pestaniaPost").val('articulos');
                $("#tipoTabla").val('publicados');
                $("#formMostrarArt").submit();
            });
            $('#tablaArticulosCreados tbody tr').click(function(){
                console.log($(this).attr('id'));
                $("#noArt").val($(this).attr('id'));
                $("#pestaniaPost").val('articulos');
                $("#tipoTabla").val('creados');
                $("#formMostrarArt").submit();
            });
            $('#btnGuardarEd').click(function(){
                $('#opcEd').val('guardar');
                $('#editarArticulo').submit();
            });
            $('#btnPublicarEd').click(function(){
                $('#opcEd').val('publicar');
                $('#editarArticulo').submit();
            });
            $('#btnCancelarEd').click(function(){
                $('#articuloCreadoSeleccionado').html("");
            });
            $('#btnGuardarCrear').click(function(){
                $('#opcCrear').val('guardar');
                $('#crearArticulo').submit();
            });
            $('#btnPublicarCrear').click(function(){
                $('#opcCrear').val('publicar');
                $('#crearArticulo').submit();
            });
            $('#btnCancelarCrear').click(function(){
                document.getElementById('crearArticulo').reset();
                $('#divCrearArticulo').hide();
            });
        });
    </script>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["opcEd"] == 'guardar') {
        $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
        $usuarioBD = "uww4txp33fwtwsd3";
        $pwd = "SOScyNtal6c2jEyoSEAz";
        $nombBD = "bjmpkkoiv1c5rd7kgm65";
        $tituloEd = $_POST["tituloEd"];
        $subtituloEd = $_POST["subtituloEd"];
        $contenidoEd = $_POST["contenidoEd"];
        $noArtEd = $_POST["noArtEd"];
        $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
        if(!$db){
            die("La conexión falló: ".mysqli_connect_error());
        }else{
            mysqli_query($db, "SET NAMES 'UTF8'");
        }
        $sql = "UPDATE articulos SET titulo = '".$tituloEd."', subtitulo = '".$subtituloEd."', contenido = '".$contenidoEd."' WHERE id_articulo = ".$noArtEd.";";
        if(mysqli_query($db, $sql)){
            echo '<script>$(document).ready(function(){bootbox.alert({title:"<b>¡Edición exitosa!</b>", message:"Su artículo ha sido editado.<br>Espere un momento mientras recarga la página."});});</script>';
            echo "<form id='recarga' name='recarga' action='escritor.php' method='POST'><input type='text' id='pestaniaPost' name='pestaniaPost' value='articulos' hidden></form>";
            echo '<script>$(document).ready(function(){setTimeout(function(){$("#recarga").submit();}, 4000);});</script>';
        }else{
            echo "Error: ".$sql.": ".mysqli_error($db); 
            echo"Error en la consulta";
        }
    
        mysqli_close($db);
    }elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["opcEd"] == 'publicar'){
        $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
        $usuarioBD = "uww4txp33fwtwsd3";
        $pwd = "SOScyNtal6c2jEyoSEAz";
        $nombBD = "bjmpkkoiv1c5rd7kgm65";
        $tituloEd = $_POST["tituloEd"];
        $subtituloEd = $_POST["subtituloEd"];
        $contenidoEd = $_POST["contenidoEd"];
        $noArtEd = $_POST["noArtEd"];
        $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
        if(!$db){
            die("La conexión falló: ".mysqli_connect_error());
        }else{
            mysqli_query($db, "SET NAMES 'UTF8'");
        }
        $sql = "UPDATE articulos SET titulo = '".$tituloEd."', subtitulo = '".$subtituloEd."', contenido = '".$contenidoEd."', fecha_publicacion = CURRENT_DATE, estatus_articulo = 'Publicado' WHERE id_articulo = ".$noArtEd.";";
        if(mysqli_query($db, $sql)){
            echo '<script>$(document).ready(function(){bootbox.alert({title:"<b>¡Publicación exitosa!</b>", message:"Su artículo ya se encuentra publicado.<br>Espere unos instantes mientras recarga la página."});});</script>';
            echo "<form id='recarga' name='recarga' action='escritor.php' method='POST'><input type='text' id='pestaniaPost' name='pestaniaPost' value='articulos' hidden></form>";
            echo '<script>$(document).ready(function(){setTimeout(function(){$("#recarga").submit();}, 4000);});</script>';
        }else{
            echo "Error: ".$sql.": ".mysqli_error($db); 
            echo"Error en la consulta";
        }
    
        mysqli_close($db);
        
    }
    ?>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["opcCrear"] == 'guardar') {
        $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
        $usuarioBD = "uww4txp33fwtwsd3";
        $pwd = "SOScyNtal6c2jEyoSEAz";
        $nombBD = "bjmpkkoiv1c5rd7kgm65";
        $tituloCrear = $_POST["tituloCrear"];
        $subtituloCrear = $_POST["subtituloCrear"];
        $categoriaCrear = $_POST["categoriaCrear"];
        $contenidoCrear = $_POST["contenidoCrear"];
        $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
        if(!$db){
            die("La conexión falló: ".mysqli_connect_error());
        }else{
            mysqli_query($db, "SET NAMES 'UTF8'");
        }
        $sql = "INSERT INTO articulos (`titulo`, `subtitulo`, `correo`, `fecha_publicacion`, `estatus_articulo`, `categoria`, `contenido`) VALUES ('".$tituloCrear."', '".$subtituloCrear."', '".$_SESSION["correo"]."', null, 'Creado', '".$categoriaCrear."', '".$contenidoCrear."');";
        if(mysqli_query($db, $sql)){
            echo '<script>$(document).ready(function(){bootbox.alert({title:"<b>¡Creación exitosa!</b>", message:"Su artículo ha sido creado de manera correcta.<br>Espere un momento mientras recarga la página."});});</script>';
            echo "<form id='recarga' name='recarga' action='escritor.php' method='POST'><input type='text' id='pestaniaPost' name='pestaniaPost' value='articulos' hidden></form>";
            echo '<script>$(document).ready(function(){setTimeout(function(){$("#recarga").submit();}, 4000);});</script>';
        }else{
            echo "Error: ".$sql.": ".mysqli_error($db); 
            echo"Error en la consulta";
        }
    
        mysqli_close($db);
    }elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["opcCrear"] == 'publicar'){
        $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
        $usuarioBD = "uww4txp33fwtwsd3";
        $pwd = "SOScyNtal6c2jEyoSEAz";
        $nombBD = "bjmpkkoiv1c5rd7kgm65";
        $tituloCrear = $_POST["tituloCrear"];
        $subtituloCrear = $_POST["subtituloCrear"];
        $categoriaCrear = $_POST["categoriaCrear"];
        $contenidoCrear = $_POST["contenidoCrear"];
        $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
        if(!$db){
            die("La conexión falló: ".mysqli_connect_error());
        }else{
            mysqli_query($db, "SET NAMES 'UTF8'");
        }
        $sql = "INSERT INTO articulos (`titulo`, `subtitulo`, `correo`, `fecha_publicacion`, `estatus_articulo`, `categoria`, `contenido`) VALUES ('".$tituloCrear."', '".$subtituloCrear."', '".$_SESSION["correo"]."', CURRENT_DATE, 'Publicado', '".$categoriaCrear."', '".$contenidoCrear."');";
        if(mysqli_query($db, $sql)){
            echo '<script>$(document).ready(function(){bootbox.alert({title:"<b>¡Publicación exitosa!</b>", message:"Su artículo fue creado y publicado de manera exitosa.<br>Espere unos instantes mientras recarga la página."});});</script>';
            echo "<form id='recarga' name='recarga' action='escritor.php' method='POST'><input type='text' id='pestaniaPost' name='pestaniaPost' value='articulos' hidden></form>";
            echo '<script>$(document).ready(function(){setTimeout(function(){$("#recarga").submit();}, 4000);});</script>';
        }else{
            echo "Error: ".$sql.": ".mysqli_error($db); 
            echo"Error en la consulta";
        }
    
        mysqli_close($db);
        
    }
    ?>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["actualizar"] == 'actualizar') {
        $direccionAct = $_POST["direccion"];
        $telefonoAct = $_POST["telefono"];
        $referenciasAct = $_POST["referencias"];
        $profesionAct = $_POST["profesion"];
        if($_POST["facebook"] != ''){
            $facebookAct = "'".$_POST["facebook"]."'";
        }else{
            $facebookAct = 'null';
        }
        if($_POST["twitter"] != ''){
            $twitterAct = "'".$_POST["twitter"]."'";
        }else{
            $twitterAct = 'null';
        }
        $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
        $usuarioBD = "uww4txp33fwtwsd3";
        $pwd = "SOScyNtal6c2jEyoSEAz";
        $nombBD = "bjmpkkoiv1c5rd7kgm65";
        $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
        if(!$db){
            die("La conexión falló: ".mysqli_connect_error());
        }else{
            mysqli_query($db, "SET NAMES 'UTF8'");
        }
        
        $sql = "UPDATE usuarios SET direccion = '".$direccionAct."', telefono = '".$telefonoAct."', referencias = '".$referenciasAct."', profesion = '".$profesionAct."', facebook = ".$facebookAct.", twitter = ".$twitterAct." WHERE correo = '".$_POST["correo"]."'";
        
        if(mysqli_query($db, $sql)){
            echo '<script>$(document).ready(function(){bootbox.alert({title:"<b>¡Actualización de datos exitosa!</b>", message:"Sus datos han sido actualizados de manera correcta.<br>Espere un momento mientras recarga la página."});});</script>';
            echo "<form id='recarga' name='recarga' action='escritor.php' method='POST'><input type='text' id='pestaniaPost' name='pestaniaPost' value='perfil' hidden></form>";
            echo '<script>$(document).ready(function(){setTimeout(function(){$("#recarga").submit();}, 4000);});</script>';
        }else{
            echo "Error: ".$sql.": ".mysqli_error($db); 
            echo"Error en la consulta";
        }
    
        mysqli_close($db);
    }
    ?>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        error_reporting(E_ALL ^ E_NOTICE); 
        $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
        $usuarioBD = "uww4txp33fwtwsd3";
        $pwd = "SOScyNtal6c2jEyoSEAz";
        $nombBD = "bjmpkkoiv1c5rd7kgm65";
        $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
        if(!$db){
            die("La conexión falló: ".mysqli_connect_error());
        }else{
            mysqli_query($db, "SET NAMES 'UTF8'");
        }
        switch($_GET["pestania"]){
            case 'inicio':
                if($_GET["categoria"] != '' && $_GET["categoria"] != 'Todas'){
                    $condicion1 = "AND categoria ='".$_GET["categoria"]."' "; 
                }else{
                    $condicion1 = " ";
                }
                if($_GET["titulo"] != ''){
                    $condicion2 = "AND UPPER(titulo) LIKE (CONCAT('%',UPPER('".$_GET["titulo"]."'),'%')) ";
                }else{
                    $condicion2 = " ";
                }
                $sql = "SELECT * FROM articulos a, usuarios u WHERE a.correo = u.correo ".$condicion1.$condicion2." AND estatus_articulo = 'Publicado' ORDER BY fecha_publicacion DESC;";
                $bandera1 = false;
                $resultados = mysqli_query($db, $sql);
                $html = "";
                while($query = mysqli_fetch_array($resultados)){
                    $bandera1 = true;
                    $html .= '<tr id=\''.$query['id_articulo'].'\'><td><b>'.$query['titulo'].'</b>-'.$query['apellidos'].', '.$query['nombre'].'. Publicado el '.$query["fecha_publicacion"].'. Haga click aquí para leer el artículo.</td></tr>';
                }
                if($bandera1){
                    echo '<script>$(document).ready(function(){$("#cuerpoTabla").html("'.$html.'")});</script>';
                }else{
                    echo '<script>$(document).ready(function(){$("#cuerpoTabla").html("<tr><td>Lo sentimos... no tenemos coincidencias con su búsqueda.</td></tr>")});</script>';
                }
                break;

        }
        
    }
    ?>
    <script>
        $(document).ready(function(){
            $('#tablaArticulos tbody tr').click(function(){
                console.log($(this).attr('id'));
                $("#noArt").val($(this).attr('id'));
                $("#pestaniaPost").val('inicio');
                $("#formMostrarArt").submit();
            });
            $('#tablaArticulosPublicados tbody tr').click(function(){
                console.log($(this).attr('id'));
                $("#noArt").val($(this).attr('id'));
                $("#pestaniaPost").val('articulos');
                $("#tipoTabla").val('publicados');
                $("#formMostrarArt").submit();
            });
            $('#tablaArticulosCreados tbody tr').click(function(){
                console.log($(this).attr('id'));
                $("#noArt").val($(this).attr('id'));
                $("#pestaniaPost").val('articulos');
                $("#tipoTabla").val('creados');
                $("#formMostrarArt").submit();
            });
        });
    </script>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $pestania = $_POST["pestaniaPost"];
        if($pestania == 'inicio'){
            echo '<script>$(document).ready(function(){$("#inicio").trigger("click")});</script>';
        }
        if($pestania == 'articulos'){
            echo '<script>$(document).ready(function(){$("#articulos").trigger("click")});</script>';
            if($_POST["tipoTabla"] == "creados"){
                echo '<script>$(document).ready(function(){$("#divArtCreados").show()});</script>';
            }elseif($_POST["tipoTabla"] == "publicados"){
                echo '<script>$(document).ready(function(){$("#divArtPublicados").show()});</script>';
            }elseif($_POST["tipoTabla"] == "crearArticulo"){

            }
        }
        if($pestania == 'perfil'){
            echo '<script>$(document).ready(function(){$("#perfil").trigger("click")});</script>';

        }
    }
    ?>
    
</body>
</html>