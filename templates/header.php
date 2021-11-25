<div class="jumbotron" align="center" style="background-image: url('img/fondo_header.jpg'); background-size:cover;">
    <h1 style="margin-top: -25px; font-size: 48px; color:white"><b> Agujeros Negros </b></h1>
</div>

<nav class="navbar justify-content-end navbar-dark bg-dark" style="margin-top: -25px;">


    <button id="botoncito" type="button" class="btn btn-secondary btn-lg"><a class="badge badge-secondary" href="index.php">Inicio</a></button>
    <nav class="navbar navbar-dark bg-dark">
        <form class="form-inline" method="get" action="buscar_nombre.php" >
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar por nombre" aria-label="Search" name="barra">
            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="boton_buscar" value="Buscar">
        </form>
    </nav>

    <div class="dropdown show">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Buscar por categoria</a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="opinion.php">Opinión</a>
    <a class="dropdown-item" href="investigacion.php">Investigación</a>
    <a class="dropdown-item" href="perspectiva.php">Perspectiva</a>
    <a class="dropdown-item" href="revicion.php">Revisión</a>
  </div>
</div>



    <div class="navbar justify-content-end navbar-dark bg-dark" style="color: white" id="navbarSupportedContent;">

        <form class="form-inline my-2 my-lg-0">
            <?php
            if (isset($_SESSION["nombre"])) {
                echo '<a class="nav-link btn btn-infoS" disabled><i class="fa fa-user" style="font-size: 25px;"></i>
                Bienvenido ' . $_SESSION["nombre"] . '</a>';
            }
            ?>

            <?php
            if (isset($_SESSION["nombre"])) {
                echo '<a href="../templates/cerrarSesion.php" class="nav-link btn btn-danger" onclick="cerrarSesion()" style="margin-left: 15px; cursor: pointer;"><i class="fa fa-sign-out-alt" style="font-size: 25px;"></i> Cerrar Sesión</a>';
            } else {
                echo '<a id="login" class="nav-link btn btn-primary" onclick="muestraForm()" style="margin-left: 15px; cursor: pointer;"><i class="fa fa-sign-in-alt" style="font-size: 25px;"></i> Iniciar Sesión</a>';
            }
            ?>

        </form>
    </div>

</nav>




<script>
    function muestraForm() {
        $("#formulario").removeAttr("hidden");
    }
</script>