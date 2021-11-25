
<div align="center" style="background-image: url('img/fondo_header.jpg'); background-size:cover; 
padding-top: 20px; padding-bottom: 40px; margin-bottom: 30px; margin-top: 20px">
    <h1 style="color:white">Agujeros Negros</h1>
</div>

<nav class="navbar justify-content-end navbar-dark bg-dark" style="margin-top: -25px;">
    


    <div class="navbar justify-content-end navbar-dark bg-dark" style="color: white" id="navbarSupportedContent;" >
        
        <form class="form-inline my-2 my-lg-0">
            <?php
            if (isset($_SESSION["nombre"])) {
                echo '<a class="nav-link btn btn-infoS" disabled><i class="fa fa-user" style="font-size: 25px;"></i>
                Bienvenido '. $_SESSION["nombre"] .'</a>';
            }
            ?>

            
            
            <?php
            if (isset($_SESSION["nombre"])) {             

                echo '<a  class="nav-link btn btn-danger" onclick="cerrarSesion()" style="margin-left: 15px; cursor: pointer;"><i class="fa fa-sign-out-alt" style="font-size: 25px;"></i> Cerrar Sesión</a>';
                
                
            } else {

                echo '<a id="login" class="nav-link btn btn-primary" onclick="muestraForm()" style="margin-left: 15px; cursor: pointer;"><i class="fa fa-sign-in-alt" style="font-size: 25px;"></i> Iniciar Sesión</a>';
                
                
            }
            ?>

        </form>
    </div>
</nav>




<script>
    function muestraForm() {
        $("#formulario").removeAttr("hidden");
    }
</script>