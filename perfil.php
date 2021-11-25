<?php
session_start();
$servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
$usuarioBD = "uww4txp33fwtwsd3";
$pwd = "SOScyNtal6c2jEyoSEAz";
$nombBD = "bjmpkkoiv1c5rd7kgm65";
$db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);

if (!$db) {
    echo 'Error de conexión: ' . mysqli_connect_error();
}
$id = $_SESSION['correo'];


//Iniciar sesión
$sql = "SELECT * FROM usuarios ". "WHERE correo = '$id'  ";

$resultado = mysqli_query($db, $sql);
if ($resultado->num_rows == 1) {    
    $usuarios = mysqli_fetch_assoc($resultado);
}
if (isset($_POST['submit'])) {

    $direccion = $_POST['direccion'];
    $telefono =  $_POST['telefono'];  
    $facebook = $_POST ['facebook'] ;
    $twitter = $_POST ['twitter'] ;
    $correo = $_POST ['usuario'] ;


    $sql = "UPDATE usuarios SET direccion = '$direccion', telefono = '$telefono', facebook = '$facebook', twitter = '$twitter'  WHERE correo = '$correo'";

    $resultado = mysqli_query($db, $sql);
    if ($resultado) {

        //header('Location: ./admin.php');
        echo "<form action='perfil.php' method='POST' id='formulario' > <input hidden type='text' id='correo' name='correo' value='$id'/> </form> ";
        echo "<script> window.onload = function(){document.getElementById('formulario').submit()}; </script>";
    } else {
        echo "Error: " . $sql . ":" . mysqli_error($db);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Editar</title>
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

        <br>

        <div class="card">
            <div class="card-body" style="background:linear-gradient(rgb(46, 17, 83),rgb(12, 67, 131))">
                <a href="lector.php" class="btn btn-warning" style="font-size: 18px; margin-bottom: 25px;"><i class="fa fa-arrow-circle-left"></i> Regresar </a>
                <a href="comentarios.php" class="btn btn-secondary" style="font-size: 18px; margin-bottom: 25px;"><i class="fa fa-file"></i> Ver tus Comentarios </a>
                <br>
                <div class="row" style="border-color: white; border-radius: 15px;"  align="center">
                    <div class="offset-md-2 col-md-8 offset-md-2">
                        <div class="card text-white" style="width: 70%; background:linear-gradient(rgb(46, 17, 83),rgb(12, 67, 131))">
                            <div class="card-header" align="center">
                                <h2>Datos Personales</h2>
                            </div>
                            <br>
                            <form action="perfil.php" method="POST">
                                <div class="card-body" align="left" style="padding-left: 15%; padding-right: 15%;">                                
                                <label style="font-size: 18px;"><i class="fa fa-envelope-open"></i> Correo Electrónico </label>
                                <input readonly type="text" class="form-control" id="usuario" name="usuario" value= "<?php echo $usuarios['correo'] ?>"/> 
                                <br>
                                <label style="font-size: 18px;"><i class="fa fa-user-circle"></i> Nombre </label>
                                <input readonly type="text" class="form-control" id="nombre" name="nombre" value= "<?php echo $usuarios['nombre'] ?>"/>  
                                <br>                                                              
                                <label style="font-size: 18px;"><i class="fa fa-user-circle"></i> Apellidos </label>
                                <input readonly type="text" class="form-control" id="apellidos" name="apellidos"  value= "<?php echo $usuarios['apellidos'] ?>"/>                                
                                <br>
                                <label style="font-size: 18px;"><i class="fa fa-home"></i> Dirección </label>
                                <input type="text" class="form-control" id="direccion" name="direccion"  value= "<?php echo $usuarios['direccion'] ?>"/>                                
                                <br>
                                <label style="font-size: 18px;"><i class="fa fa-phone"></i> Teléfono </label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value= "<?php echo $usuarios['telefono'] ?>"/>                                
                                <br>                                 
                                <div class="row">
                                    <div class="col-md-6">
                                    <label style="font-size: 18px;"><i class="fab fa-facebook"></i> Facebook </label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" value= "<?php echo $usuarios['facebook'] ?>"/>
                                    </div>
                                    <div class="col-md-6">                                     
                                    <label style="font-size: 18px;"><i class="fab fa-twitter"></i> Twitter </label>
                                    <input type="text" class="form-control" id="twitter" name="twitter" value= "<?php echo $usuarios['twitter'] ?>"/>                                
                                    </div>
                                </div>
                                                                
                                
                                        <input hidden type="text" class="form-control" id="correo" name="correo" value="<?php echo $id; ?>">
                                </div>
                                <button type="submit" class="btn btn-success" id="submit" name='submit' style="margin-bottom:20px ;"><i class="fa fa-save"></i> Guardar Cambios</button>

                            </form>
                            <br>
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