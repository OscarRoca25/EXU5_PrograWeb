<?php
session_start();
?>
<!doctype html>
<html lang="en">


<head>
    <title>Agujeros Negros</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body style="background-image: url('img/fondo.jpg'); background-attachment:fixed; background-size:cover;">
    <div class="container">

    <div class="jumbotron" align="center" style="background-image: url('img/fondo_header.jpg'); background-size:cover;">
    <h1 style="margin-top: -25px; font-size: 48px; color:white"><b> Agujeros Negros </b></h1>
</div>

<nav class="navbar justify-content-end navbar-dark bg-dark" style="margin-top: -25px;">
    
        <div class=" navbar-dark bg-dark" style="color: white" id="navbarSupportedContent;" >
        
        <form class="form-inline my-2 my-lg-0">
            <?php
            if (isset($_SESSION["nombre"])) {                
                
                echo '<a href="perfil.php" class="nav link btn btn-dark justify-content-end" style="cursor:pointer;"> Perfil
                <i class="fa fa-user-circle" style="font-size: 25px; margin-left:15px"></i></a>';

                echo '<a class="nav-link btn btn-infoS" disabled><i class="fa fa-user" style="font-size: 25px;"></i>
                Bienvenido '. $_SESSION["nombre"] .'</a>';
                
            }            
            ?>
            
            <?php
            if (isset($_SESSION["nombre"])) {
                                                            
                echo '<a href="login.php" class="nav-link btn btn-danger" onclick="cerrarSesion()" style="margin-left: 15px; cursor: pointer;">
                <i class="fa fa-sign-out-alt" style="font-size: 25px;"></i> Cerrar Sesión</a>';
                
                
            } else {                
                
                echo '<a id="login" class="nav-link btn btn-primary" onclick="muestraForm()" style="margin-left: 15px; cursor: pointer;"><i class="fa fa-sign-in-alt" style="font-size: 25px;"></i> Iniciar Sesión</a>';

                
            }
            ?>



        </form>
    </div>
</nav>
                
                                
        <?php
        require_once 'includes/tabla.php';
        ?>


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