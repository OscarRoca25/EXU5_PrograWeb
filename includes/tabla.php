<?php
$servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
$usuarioBD = "uww4txp33fwtwsd3";
$pwd = "SOScyNtal6c2jEyoSEAz";
$nombBD = "bjmpkkoiv1c5rd7kgm65";
$db = mysqli_connect($servidor, $usuarioBD, $pwd, $nombBD);

    $query = "SELECT * FROM articulos ";
    $resultado = mysqli_query($db, $query);
    $mostrar2 = mysqli_fetch_array($resultado);


?>

<form class="form-inline my-2 my-lg-0">                    
    <button type="submit" class="btn btn-info" id="submit" name='submit' 
    style="margin-bottom:20px; "><i class="fa fa-search"></i> Buscar por Categoría</button> 

        <select name="categoria" id="categoria" class="form-control"> 
            <option> Todas </option>
            <option> Opinión </option>
            <option> Investigación </option>
            <option> Perspectiva </option>
            <option> Revisión </option>
        </select>
</form>

<div class="card" style="background-color: transparent; border-color: transparent" id="formulario"  >
    <div class="card-body" >
        <div class="row" style="text-align: center;">
            <div class="offset-md-2 col-md-8 offset-md-2">                
                <h1 style="color: white; text-align: center;"><b> Artículos </b></h1>
                <hr>
                <table class="table table-dark table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Subtitulo</th>
                            <th>Autor</th>                            
                            <th>Categoría</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM articulos";
                        $resultado = mysqli_query($db, $query);
                        if ($mostrar2) {
                            while ($mostrar = mysqli_fetch_array($resultado)) {
                                
                                $id = $mostrar["id_articulo"];
                                $titulo = $mostrar["titulo"];
                                $subtitulo = $mostrar["subtitulo"];
                                $correo = $mostrar["correo"];
                                $categoria = $mostrar["categoria"];
                                echo '<tr align="center">';
                                echo "      <td>" . $titulo . "</td>";
                                echo "      <td>" . $subtitulo . "</td>";
                                echo "      <td>" . $correo . "</td>";
                                echo "      <td>" . $categoria . "</td>";
                                echo '<td><a href="ver.php? id=' . $id. '" class="btn btn-success"><i>Leer Artículo</i></a></td>';                                
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