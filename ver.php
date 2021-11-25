<?php
session_start();
$servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
$usuarioBD = "uww4txp33fwtwsd3";
$pwd = "SOScyNtal6c2jEyoSEAz";
$nombBD = "bjmpkkoiv1c5rd7kgm65";
$db = new mysqli($servidor, $usuarioBD, $pwd, $nombBD);

if (!$db) {
    echo 'Error de conexión: ' . mysqli_connect_error();
}

if ($_SERVER['REQUEST_METHOD'] == "GET"  ){
    $id = $_GET['id'];

} elseif($_SERVER['REQUEST_METHOD'] == "POST" ){
    $id = $_POST['id_articulo'];
}

if (isset($_POST['submit'])) {

    $correo = $_SESSION['correo'];
    $id_articulo =  $_POST['id_articulo'];  
    $contenido = $_POST ['comentario'] ;
    

    $sql = "INSERT INTO `comentarios`(`id_articulo`, `correo`,`estatus_comentario`,`contenido`)
    VALUES ('$id_articulo','$correo','Publicado','$contenido')"; 

    if(mysqli_query($db, $sql)){

    //header('Location: ./ver.php');
    echo "<form action='ver.php' method='POST' id='formulario' > <input hidden type='number' id='id_articulo' name='id_articulo' value='$id'/> </form> ";
    echo "<script> window.onload = function(){document.getElementById('formulario').submit()}; </script>";

    }else{
    echo "Error: " . $sql . ":" . mysqli_error($db);

    }

    mysqli_close($db);
}


//Iniciar sesión
$sql = "SELECT * FROM articulos ". "WHERE id_articulo = $id  ";

$sqls = "SELECT * FROM comentarios c, usuarios u WHERE c.correo= u.correo AND estatus_comentario= 'Publicado' AND ". "id_articulo = $id  ";

    

$resultado = mysqli_query($db, $sql);

if ($resultado->num_rows == 1) {
    $articulo = mysqli_fetch_assoc($resultado);
}
$comentarios = "" ;
$comentariosRes = mysqli_query($db, $sqls); 
while($query = mysqli_fetch_array($comentariosRes)){

                          $comentarios .= $query['nombre'] . " (". $query['correo'] . ") " .  ": \n " . $query['contenido'] . " \n\n" ;

                        }

?>

<!doctype html>
<html lang="en">

<head>
    <title>Información</title>
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
                echo '<a href="lector.php" class="nav-link btn btn-warning" " style="margin-left: 15px; cursor: pointer;"><i class="fa fa-sign-out-alt" style="font-size: 25px;"></i> Regresar</a>';            
            ?>

        </form>
    </div>
</nav>     

        <br>

        <div class="card" style="background-color: transparent; border-color: transparent">
            <div class="card-body" style="background-color: transparent; border-color: transparent" align="center">

                <div class="row" style="border-color: white; border-radius: 15px;">
                    <div class="offset-md-2 col-md-8 offset-md-2">
                        <div class="card text-white" style="width: 100%; background:linear-gradient(rgb(46, 17, 83),rgb(12, 67, 131))">
                            <div class="card-header" align="center">                                
                            </div>
                            <br>
                            <form action="ver.php" method="POST">
                                <div class="card-body" align="left" style="padding-left: 15%; padding-right: 15%;">
                                    <label style="font-size: 18px;"><i class="fa fa-file"></i> Artículo </label>
                                    <input readonly type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $articulo['titulo'] ?>" />
                                    <br>
                                    <label style="font-size: 18px;"><i class="fa fa-file"></i> Subtitulo </label>
                                    <textarea readonly id="contenido" style=" width: 100%; height: 75px; max-height:100%; background-color: #ffffff; color:grey"  > <?php echo $articulo['subtitulo'] ?> </textarea>
                                    <br>
                                    <label style="font-size: 18px;"><i class="fa fa-file"></i> Contenido </label>
                                    <br>
                                    <textarea readonly id="contenido" style=" width: 100%; height: 500px; max-height:100%; background-color: #ffffff; color:grey" > <?php echo $articulo['contenido'] ?> </textarea>
                                    <br>
                                    <label style="font-size: 18px;"><i class="fa fa-comments"></i> Comentarios </label>
                                    <textarea readonly id="comentarios" style=" width: 100%; height: 250px; max-height:100%; background-color: #ffffff; color:grey" > <?php echo $comentarios ?> </textarea>                                    
                                    <br>
                                    <input required type="text" class="form-control" id="comentario" name="comentario" placeholder="Comentar" />                                    
                                    <input hidden type="number" id="id_articulo" name="id_articulo" value="<?php echo $articulo['id_articulo'] ?>"/>
                                    <br>
                                    
                                </div>                                
                                <button type="submit" class="btn btn-success" id="submit" name='submit' style="margin-bottom:20px ;"><i class="fa fa-edit"></i> Aceptar</button>
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