<!doctype html>
<html lang="es">

<head>
    <title>Registro de Escritor</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body style="background-image: url('img/fondo.jpg'); background-attachment:fixed; background-size:cover;";>
    <div class="container">
        <?php
        require_once 'includes/header.php';
        ?>

        <?php
        require_once 'includes/formularioRegistroEscritor.php';
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
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
            $("#chkBoxPwd").change(function(){
                if($("#chkBoxPwd").prop('checked')){
                    $("#pwd").prop('type', 'text');
                }else{
                    $("#pwd").prop('type', 'password');
                }
            });
        });
    </script>

</body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $pswd = sha1($_POST["pwd"]);
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $fechNac = $_POST["fechNac"];
    $rfc = strtoupper($_POST["rfc"]);
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $referencias = $_POST["referencias"];
    $profesion = $_POST["profesion"];
    if($_POST["facebook"] == ''){
        $facebook = "null";
    }else{
        $facebook = "'".$_POST["facebook"]."'";
    }
    if($_POST["twitter"] == ''){
        $twitter = "null";
    }else{
        $twitter = "'".$_POST["twitter"]."'";
    }
    $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
    $usuarioBD = "uww4txp33fwtwsd3";
    $pwd = "SOScyNtal6c2jEyoSEAz";
    $nombBD = "bjmpkkoiv1c5rd7kgm65";
    $rol = "escritor";
    $estatus = "activo";
    $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
    if(!$db){
        die("La conexión falló: ".mysqli_connect_error());
    }else{
        mysqli_query($db, "SET NAMES 'UTF8'");
    }
    $sql = "INSERT INTO usuarios VALUES ('".$correo."', '".$pswd."', '".$nombre."', '".$apellidos."', '".$rol."', '".$estatus."', STR_TO_DATE('".$fechNac."', GET_FORMAT(date, 'JIS')), '".$rfc."', '".$direccion."', '".$telefono."', '".$referencias."', '".$profesion."', ".$facebook.", ".$twitter.");";

    if(mysqli_query($db, $sql)){
        echo "<script>$(document).ready(function(){bootbox.alert({title: '<b>Registro exitoso</b>', message: 'Su registro ha sido exitoso.<br>Se le redireccionará a la página de inicio de sesión.'});setTimeout(function(){window.location.replace('login.php')},4000)});</script>";
    }else{
        echo "<script>$(document).ready(function(){bootbox.alert({title:'<b>Error en su registro</b>', message: 'Parece ser que este correo ya fue registrado anteriormente.<br>Inicie sesión o registre un nuevo correo.'});});</script>";
    }
    
    mysqli_close($db);
}
?>


</html>