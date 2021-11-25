<br>
<div class="card" style="background-color: transparent; border-color: transparent" id="formulario" hidden >
    <div class="card-body"  align="center">
        <h2 style= color:white>Por favor proporcione sus credenciales</h2>
        <div class="row">
            <div class="offset-md-2 col-md-8 offset-md-2">
                <div class="card text-white" style="width: 70%; background:linear-gradient(black,gray)">
                    <div class="card-header" align="center">
                        <h3><span class="fa fa-unlock" style="font-size: 25px; margin-left: 5px;"></span> Login</h3>
                    </div>
                    <br>
                    <form action="index.php" method="POST" id="formLogin">
                        <div class="card-body" align="left" style="padding-left: 15%; padding-right: 15%;">
                            <label style="font-size: 18px;"><i class="fa fa-user"></i> Usuario </label>
                            <input type="text" class="form-control" required id="inUsuario" title="El correo debe ser example@gmail.com"
                                    name="inUsuario" placeholder="Usuario" pattern="[a-zA-Z0-9]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}" />
                            <label id="errorUsuario"></label>
                            <br>
                            <label style="font-size: 18px;"><i class="fa fa-eye"></i> Contraseña </label>
                            <input type="password" class="form-control" id="inContraseña" minlength="4" required 
                                    name="inContraseña" placeholder="Contraseña" 
                                    pattern="(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{4,16}" title="La contraseña debe ser de mínimo 6 caracteres, 1 letra mayúscula y 1 número."/>
                            <label id="errorContraseña"></label>
                            <br>
                            <label><input type="checkbox" id="cbox1" value="first_checkbox" />Recordarme</label><br>
                            <button id="btnIniciar" class="btn btn-success form-control" type="submit" name="submit">
                                <span class="fa fa-door-open"></span>
                                Iniciar
                            </button>
                        </div>
                    </form>
                    <hr>
                    <div class="row" style="padding-left: 5%; padding-right: 5%;">
                        <div class="col-md-5" align="left">
                            <button id="btnCancelar" onclick="mostrar()" class="btn btn-danger form-control">
                                <span class="fa fa-times"></span>
                                Cancelar</button>
                        </div>
                        <div class="col-md-7" align="right">
                            <p>¿No te has registrado? <a href="#" style="color: white;"> <br> <i><u>Registro Lector</u></i></a></p>
                            <p><a href="#" style="color: white;"><i><u> Registro Escritor</u></i></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<script>
    function mostrar() {
        $("#formulario").attr("hidden", true);
        $("#inUsuario").val('');
        $("#inContraseña").val('');
        $("#errorUsuario").html("");
        $("#errorContraseña").html("");
    }
</script>