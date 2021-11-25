<?php
$servidor = "localhost";
$usuarioBD = "root";
$pdwBD = "";
$nomBD = "examenu3u4";
$db = mysqli_connect($servidor, $usuarioBD, $pdwBD, $nomBD);

$query = "SELECT * FROM corredor";
$resultado = mysqli_query($db, $query);
$mostrar2 = mysqli_fetch_array($resultado);

?>
<br>
<div class="card">
    <div class="card-body" style="background:linear-gradient(rgb(46, 17, 83),rgb(12, 67, 131)); border-radius: 15px;">
        <a href="crear.php" class="btn btn-success" style="font-size: 18px;">Ingresar nuevo </a>
        <br>
        <br>
        <div class="row" style="text-align: center;">
            <div class="offset-md-2 col-md-8 offset-md-2">
                <h1 style="color: white; text-align: center;"><b>Lista de Corredores</b></h1>
                <hr>
                <table class="table table-dark table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Edad</th>
                            <th>Peso</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM corredor";
                        $resultado = mysqli_query($db, $query);
                        if ($mostrar2) {
                            while ($mostrar = mysqli_fetch_array($resultado)) {

                                $id = $mostrar["id_corredor"];
                                $nombre = $mostrar["Nombre"];
                                $edad = $mostrar["Edad"];
                                $peso = $mostrar["Peso"];
                                echo '<tr align="center">';
                                echo "      <td>" . $nombre . "</td>";
                                echo "      <td>" . $edad . "</td>";
                                echo "      <td>" . $peso . "</td>";
                                echo '<td><a href="editar.php?id=' . $id . '" class="btn btn-success"><i>Editar</i></a></td>';
                                echo '<td><a href="eliminar.php?id=' . $id . '" class="btn btn-danger"><i>Borrar</i></a></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr>
                                <td colspan="5">Sin registros</td>   
                                </tr>';
                        }




                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>