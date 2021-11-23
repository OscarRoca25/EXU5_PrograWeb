<?php
    $servidor = "bjmpkkoiv1c5rd7kgm65-mysql.services.clever-cloud.com";
    $usuarioBD = "uww4txp33fwtwsd3";
    $pdwBD = "SOScyNtal6c2jEyoSEAz";
    $nomBD = "bjmpkkoiv1c5rd7kgm65";

    $db=mysqli_connect($servidor,$usuarioBD,$pdwBD,$nomBD);

    if(!$db)
    {
        die("La conexión falló: " . mysqli_connect_error());
    } else
    {
        mysqli_query($db, "SET NAMES 'UTF8'");
    }

    //Auditor de escritores
    $sql="INSERT INTO usuarios VALUES ('susana@gmail.com', '".sha1("Susana123")."','Susana','Arzate','auditorEscritor','activo',NULL,NULL,NULL,7224308718,NULL,NULL,NULL,NULL)";

    // Escritores
    $sql="INSERT INTO usuarios VALUES ('kevin@gmail.com', '".sha1("Kevin123")."','Kevin','Flores','escritor','activo',NULL,NULL,NULL,7224308718,NULL,NULL,NULL,NULL)";
    $sql="INSERT INTO usuarios VALUES ('pablo@gmail.com', '".sha1("Pablo123")."','Pablo','Zárate','escritor','activo',NULL,NULL,NULL,7224308718,NULL,NULL,NULL,NULL)";
    $sql="INSERT INTO usuarios VALUES ('ale@gmail.com', '".sha1("Ale123")."','Alejandro','Cruz','escritor','activo',NULL,NULL,NULL,7224308718,NULL,NULL,NULL,NULL)";

    //Articulos
    $sql="INSERT INTO articulos (correo,titulo,subtitulo,fecha_publicacion,estatus_articulo,categoria,contenido) VALUES ('kevin@gmail.com','Andrómeda','Descubrimiento',CURDATE(),'activo','Galaxia','Contenidooo...')";
    $sql="INSERT INTO articulos (correo,titulo,subtitulo,fecha_publicacion,estatus_articulo,categoria,contenido) VALUES ('pablo@gmail.com','Estrella Fugaz','Definición',CURDATE(),'activo','Estrellas','Contenidooo...')";
    $sql="INSERT INTO articulos (correo,titulo,subtitulo,fecha_publicacion,estatus_articulo,categoria,contenido) VALUES ('ale@gmail.com','Planetas','Saturno',CURDATE(),'activo','Planetas','Contenidooo...')";

    if(mysqli_query($db,$sql))
    {
        echo "Nuevo registro creado, exitosamente.";
    } else
    {
        echo "Error = ". $sql ,":". mysqli_error($db);
    }
?>
