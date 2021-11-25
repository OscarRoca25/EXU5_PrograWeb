<?php
$servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
$usuarioBD = "uww4txp33fwtwsd3";
$pwd = "SOScyNtal6c2jEyoSEAz";
$nombBD = "bjmpkkoiv1c5rd7kgm65";

$db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);

if (!$db) {
    echo 'Error de conexión: ' . mysqli_connect_error();
} else {
    mysqli_query($db, "SET NAMES 'UTF8'");
}


if (isset($_POST['submit'])) {

    $correo = $_POST['usuario'];
    $contrasenia = sha1($_POST['contrasenia']);
    $nombre =  $_POST['Nombre'];
    $apellido =  $_POST['Apellidos'];    
    $telefono =  $_POST['Telefono'];


    //$sql = "INSERT INTO `usuarios`(`correo`, `pwd`, `nombre`, `apellidos`, `rol`, `estatus`, `fecha_nac`, `rfc`, `direccion`, `telefono`, `referencias`, `profesion`, `facebook`, `twitter`) 
    //VALUES ('$correo','$contrasenia','$nombre','$apellido','Lector','activo',NULL,NULL,NULL,'$telefono',NULL,NULL,NULL,NULL)";

    $sql = "INSERT INTO `usuarios`(`correo`, `pwd`, `nombre`, `apellidos`, `rol`, `estatus`,`telefono`)
    VALUES ('$correo','$contrasenia','$nombre','$apellido','lector','activo','$telefono')"; 

    if(mysqli_query($db, $sql)){

    header('Location: ./login.php');

    }else{
    echo "Error: " . $sql . ":" . mysqli_error($db);

    }

    mysqli_close($db);
}


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

    <div align="center" style="background-image: url('img/fondo_header.jpg'); background-size:cover; 
padding-top: 20px; padding-bottom: 40px; margin-bottom: 30px; margin-top: 20px">
    <h1 style="color:white">Agujeros Negros</h1>
</div>

        <style>
        a, a:link, a:visited, a:hover, a:active{
            color: white;
        }
        .error{
            color:red;
            margin-left: 20%;
        }
    </style>
    <div class="card" style="background-color: transparent; border-color: transparent" id="formulario">
        <div class="card-body"  align="center">
            <h2 style= color:white>Ingrese sus datos</h2>
            <div class="row">
                <div class="offset-md-2 col-md-8 offset-md-2">
                    <div class="card text-white" style="width: 70%; background:linear-gradient(black,gray)">
                        <div class="card-header" align="center">
                            <h3><span class="fa fa-address-card" style="font-size: 25px; margin-left: 5px;"></span> Crea una cuenta</h3>
                        </div>
                        <form action="registroLector.php" method="POST" id="formLogin" name="formLogin">
                            <div class="card-body" align="left" style="padding-left: 15%; padding-right: 15%;">
                                <label id="lblError" class="error"></label><br>
                                <label style="font-size: 18px;"><i class="fa fa-envelope-open"></i> Correo Electrónico </label>
                                <input type="mail" class="form-control" required id="usuario" title="El correo debe ser example@gmail.com"
                                        name="usuario" placeholder="example@gmail.com" pattern="[a-zA-Z0-9]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}" />
                                <label id="errorUsuario" class="error"></label>
                                <br>
                                <label style="font-size: 18px;"><i class="fa fa-lock"></i> Contraseña </label>
                                <input type="password" class="form-control" id="contrasenia" minlength="6" required 
                                        name="contrasenia" placeholder="Contraseña" 
                                        pattern="(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{4,16}" title="La contraseña debe ser de mínimo 6 caracteres, 1 letra mayúscula y 1 número."/>
                                <label id="errorContraseña"></label>
                                <br>
                                <label style="font-size: 18px;"><i class="fa fa-user"></i> Nombre </label>
                                <input type="text" class="form-control" required id="Nombre" title="Ingrese su nombre"
                                        name="Nombre" placeholder="Nombre"  />                                
                                <br>
                                <label style="font-size: 18px;"><i class="fa fa-user"></i> Apellidos </label>
                                <input type="text" class="form-control" required id="Apellidos" title="Ingrese sus apellidos"
                                        name="Apellidos" placeholder="Apellidos"  />                                
                                <br>
                                <label style="font-size: 18px;"><i class="fa fa-phone"></i> Teléfono </label>
                                <input type="text" onkeypress="return numeros(event)" class="form-control" required id="Telefono" title="Ingrese número de teléfono"
                                        name="Telefono" placeholder="Teléfono" />                                
                                <br>                                
                                <button class="btn btn-success form-control" type="submit" id="submit" name='submit'>
                                    <span class="fa fa-check-circle"></span> Registrarme</button>
                            </div>
                        </form>
                        <hr>
                        <div class="row justify-content-center"  style="padding-left: 5%; padding-right: 5%;">
                            <div class="col-md-5" align="left">
                                <button id="btnCancelar" class="btn btn-danger form-control">
                                    <span class="fa fa-times"></span>
                                    <a href="login.php">Cancelar</a></button>
                                    <hr>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
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
</body>

</html>