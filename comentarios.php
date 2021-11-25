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
$sql = "SELECT * FROM comentarios ". "WHERE correo = '$id'  ";
$resultado = mysqli_query($db, $sql);


$resultado = mysqli_query($db, $sql);
if ($resultado->num_rows == 1) {    
    $usuarios = mysqli_fetch_assoc($resultado);
}

if (isset($_POST['submit'])) {

    $contenido = $_POST ['comentario'] ;      

    $sql = "UPDATE comentarios SET estatus_comentario = 'Eliminado' WHERE comentarios.contenido = '$contenido'";

    $resultado = mysqli_query($db, $sql);
    if ($resultado) {
        
        echo "<form action='comentarios.php' method='POST' id='formulario' > <input hidden type='text' id='correo' name='correo' value='$id'/> </form> ";
        echo "<script> window.onload = function(){document.getElementById('formulario').submit()}; </script>";
    } else {
        echo "Error: " . $sql . ":" . mysqli_error($db);
    }
}

//Iniciar sesión

$sqls = "SELECT * FROM comentarios c, usuarios u WHERE c.correo= u.correo AND estatus_comentario= 'Publicado'";
$resultado = mysqli_query($db, $sqls);
$mostrar2 = mysqli_fetch_array($resultado);
    

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
                <a href="perfil.php" class="btn btn-warning" style="font-size: 18px; margin-bottom: 25px;"><i class="fa fa-arrow-circle-left"></i> Regresar </a>
                <br>
                <div class="row" style="border-color: white; border-radius: 15px;"  align="center">
                    <div class="offset-md-2 col-md-8 offset-md-2">                        
                        <div class="card text-white" style="width: 70%; background:linear-gradient(rgb(46, 17, 83),rgb(12, 67, 131))">
                            <div class="card-header" align="center">
                                <h2>Comentarios Publicados</h2>
                            </div>
                            <br>
                            <table class="table table-dark table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Comentario</th>                                    
                                    <th></th>
                                </tr>
                            </thead>
                                <tbody>
                                <?php

                        $query = "SELECT contenido, id_articulo FROM comentarios WHERE  estatus_comentario = 'Publicado' AND correo='$id' ";
                        


                        $resultado = mysqli_query($db, $query);                      

                        if ($mostrar2) {
                            while ($mostrar = mysqli_fetch_array($resultado)) {
                                                                
                                $comentario = $mostrar["contenido"];                                
                                echo '<tr align="center">';
                                echo "      <td>" . $comentario . "</td>";                                
                                echo '<td> <button type="submit" class="btn btn-danger" id="submit";"><i class="fa fa-trash"></i> Borrar Comentario</button></td>';                                
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr>
                                <td colspan="5">Sin comentarios</td>   
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>                                                                                              
                                        <input hidden type="text" class="form-control" id="correo" name="correo" value="<?php echo $id; ?>">                                
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