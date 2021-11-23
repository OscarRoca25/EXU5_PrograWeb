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
        <h2 style= color:white>Por favor proporcione sus credenciales</h2>
        <div class="row">
            <div class="offset-md-2 col-md-8 offset-md-2">
                <div class="card text-white" style="width: 70%; background:linear-gradient(black,gray)">
                    <div class="card-header" align="center">
                        <h3><span class="fa fa-unlock" style="font-size: 25px; margin-left: 5px;"></span> Login</h3>
                    </div>
                    <br>
                    <form action="login.php" method="POST" id="formLogin" name="formLogin">
                        <div class="card-body" align="left" style="padding-left: 15%; padding-right: 15%;">
                            <label id="lblError" class="error"></label><br>
                            <label style="font-size: 18px;"><i class="fa fa-user"></i> Usuario </label>
                            <input type="mail" class="form-control" required id="usuario" title="El correo debe ser example@gmail.com"
                                    name="usuario" placeholder="Usuario" pattern="[a-zA-Z0-9]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}" />
                            <label id="errorUsuario" class="error"></label>
                            <br>
                            <label style="font-size: 18px;"><i class="fa fa-lock"></i> Contraseña </label>
                            <input type="password" class="form-control" id="contrasenia" minlength="6" required 
                                    name="contrasenia" placeholder="Contraseña" 
                                    pattern="(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{4,16}" title="La contraseña debe ser de mínimo 6 caracteres, 1 letra mayúscula y 1 número."/>
                            <label id="errorContraseña"></label>
                            <br>
                            <label><input type="checkbox" id="cbox1" value="first_checkbox" />Mostrar contraseña</label><br>
                            <button id="btnIniciar" class="btn btn-success form-control" type="submit" name="btnIniciar">
                                <span class="fa fa-door-open"></span>
                                Iniciar
                            </button>
                        </div>
                    </form>
                    <hr>
                    <div class="row" style="padding-left: 5%; padding-right: 5%;">
                        <div class="col-md-5" align="left">
                            <button id="btnCancelar" class="btn btn-danger form-control">
                                <span class="fa fa-times"></span>
                                <a href="index.php">Cancelar</a></button>
                        </div>
                        <div class="col-md-7" align="right">
                            <p><label style="margin-right: 15%;">¿No te has registrado?</label> <br>
                                <a href="registroLector.php" style="color: white; margin-right: 10%;"><i><u>Registro Lector</u></i></a>
                                
                                <a href="registroEscritor.php" style="color: white;"><i><u> Registro Escritor</u></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

