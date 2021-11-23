
<?php session_start(); ?>
<!doctype html>
<html lang="es">

<head>
    <title>EXU5</title>
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
        require_once 'includes/formulario.php';
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
<!--<script src="js/acciones.js" text="text/javascript"></script> -->    

<script>
    $(document).ready(function(){
        $("#cbox1").change(function(){
            if($("#cbox1").prop('checked')){
                $("#contrasenia").prop('type', 'text');
            }else{
                $("#contrasenia").prop('type', 'password');
            }
        });
    });
</script>

</body>


<?php
$userTyped = $pswTyped = $credencialIncorrecta = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $mailTyped = $_POST["usuario"];
    $pswTyped = sha1($_POST["contrasenia"]);

    $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
    $usuarioBD = "uww4txp33fwtwsd3";
    $pwd = "SOScyNtal6c2jEyoSEAz";
    $nombBD = "bjmpkkoiv1c5rd7kgm65";

    $rol = "";
    $bandera = false;
    $mensaje = "Usuario o contraseña incorrectos";

    $db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);
    if(!$db){
        die("La conexión falló: ".mysqli_connect_error());
    }else{
        mysqli_query($db, "SET NAMES 'UTF8'");
    }
    $sql = "SELECT * FROM usuarios WHERE correo = '".$mailTyped."'";

            $resultados = mysqli_query($db, $sql);

            while($query = mysqli_fetch_array($resultados)){
                if($query['correo'] == $mailTyped && $query['pwd'] == $pswTyped){       
                    $statusCuenta = $query['estatus'];
                    if($statusCuenta == 'activo'){
                        $bandera=true;
                        $rol = $query['rol'];
                        $nombre = $query['nombre']." ".$query['apellidos'];
                    }elseif($statusCuenta == 'suspendido'){
                        $bandera = false;
                        $mensaje = "Su cuenta está temporalmente suspendida.";
                    }elseif($statusCuenta == 'eliminado'){
                        $bandera = false;
                        $mensaje = "Está cuenta ha sido eliminada por incumplir las normas de nuestra comunidad.";
                    }else{
                        $bandera = false;
                        $mensaje = "Usuario o contraseña incorrectos.";
                    }
                }else{
                    $mensaje = $mensaje = "Usuario o contraseña incorrectos.";
                    $bandera=false;
                }
            }
            mysqli_close($db);

            if($bandera){
                $_SESSION['nombre'] = $nombre;
                $_SESSION['correo'] = $mailTyped;
                switch($rol){
                    case 'lector':
                        echo"<script>window.location.replace('lector.php');</script>";
                        break;
                    case 'escritor':
                        echo"<script>window.location.replace('escritor.php');</script>";
                        break;
                    case 'auditorEscritor':
                        echo"<script>window.location.replace('auditorEscritor.php');</script>";
                        break;
                    case 'auditorLector':
                        echo"<script>window.location.replace('auditorLector.php');</script>";
                        break;
                }
                
            }else{
                echo'<script>$(document).ready(function(){$("#lblError").html("'.$mensaje.'")});</script>';
            }
}
?>

</html>

