<style>
    a, a:link, a:visited, a:hover, a:active{
        color: white;
    }
    .error{
        color:red;
        margin-left: 2%;
    }

    input[type=checkbox] {
        display: none;
    }

    input[type=checkbox] + label {  
        height: 30px;
        width: 30px;
        background-image: url('img/eye-solid.svg');
        display: inline-block;
    }

    input[type=checkbox]:checked + label {
        background-image: url('img/eye-slash-solid.svg');
        background-repeat: no-repeat;
    }
    input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }

    input[type=number] { -moz-appearance:textfield; }
    
</style>
<div class="card" style="background-color: transparent; border-color: transparent" id="formulario">
    <div class="card-body"  align="center">
        <h2 style= color:white>Llene el formulario para crear su registro</h2>
        <div class="row">
            <div class="offset-md-2 col-md-8 offset-md-2">
                <div class="card text-white" style="width: 70%; background:linear-gradient(black,gray)">
                    <div class="card-header" align="center">
                        <h3><span class="fa fa-file-alt" style="font-size: 25px; margin-left: 5px;"></span> Registro</h3>
                    </div>
                    <form action="registroEscritor.php" method="POST" id="formRegistroEscritor" name="formRegistroEscritor">
                        <div class="card-body" align="left" style="padding-left: 5%; padding-right: 5%; text-align: left;">
                            <label>Los campos con asterísco (*) son obligatorios.</label><br>
                            <label for="correo" style="font-size: 18px;"> <i class="fa fa-at" aria-hidden="true"></i> Correo: </label><label class="error">*</label><br>
                            <input class="form-control" type="email" name="correo" id="correo" placeholder="Correo" pattern="[a-zA-Z0-9_-.]+@([a-zA-Z0-9-]{2,}[.])+[a-zA-Z]{2,4}" title="Ingrese una dirección de correo electrónico válida" required>
                            <label for="pwd" style="font-size: 18px;"> <i class="fa fa-key" aria-hidden="true"></i> Contraseña: </label><label class="error">*</label><br>
                            <div class="row">
                                <div class="col-md-10">
                                    <input class="form-control" type="password" name="pwd" id="pwd" placeholder="Contraseña" style="width: 120%;" minlength="6" pattern="(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{4,16}" title="La contraseña debe ser de mínimo 6 caracteres, 1 letra mayúscula y 1 número." required>
                                </div>
                                <div class="col-md-2" style="margin-top: 5px; margin-left: 0%; padding-left: 0%;">
                                    <input type="checkbox"  id="chkBoxPwd"><label for="chkBoxPwd"></label> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nombre"><i class="fa fa-user" aria-hidden="true"></i> Nombre:</label><label class="error">*</label>
                                    <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóú ]+" title="El nombre solo puede incluir letras." required>
                                </div>
                                <div class="col-md-6">
                                    <label for="apellidos"><i class="fa fa-users" aria-hidden="true"></i> Apellido(s):</label><label class="error">*</label>
                                    <input class="form-control" type="text" name="apellidos" id="apellidos" placeholder="Apellido" pattern="[A-Za-zÁÉÍÓÚáéíóú ]+" title="El apellido solo puede incluir letras." required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <label for="fechNac"><i class="fa fa-birthday-cake" aria-hidden="true"></i> Fecha de nacimiento:</label><label class="error">*</label>
                                    <input class="form-control" type="date" name="fechNac" id="fechNac" placeholder="dd/mm/yyyy"  title="La fecha debe escribirse con el formato solicitado 'dd/mm/yyyy'" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="rfc"><i class="fa fa-hashtag" aria-hidden="true"></i> RFC:</label><label class="error">*</label>
                                    <input class="form-control" type="text" name="rfc" id="rfc" placeholder="RFC" pattern="[A-Za-z]{4,4}[0-9]{6,6}[A-Za-z]{2,2}[0-9]" title="Ingrese un formato de RFC válido. Ejemplo: ABCD990101XY9" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="direccion"><i class="fa fa-globe-americas" aria-hidden="true"></i> Dirección:</label><label class="error">*</label>
                                    <input class="form-control" type="text" name="direccion" id="direccion" placeholder="Dirección" title="Ingrese la dirección de su domicilio." required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="telefono"><i class="fa fa-phone" aria-hidden="true"></i> Teléfono:</label><label class="error">*</label>
                                    <input class="form-control" type="number" name="telefono" id="telefono" placeholder="Teléfono" minlength="6" pattern="[0-9]{10,10}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="referencias"><i class="fa fa-books" aria-hidden="true"></i> Referencias:</label><label class="error">*</label>
                                    <input class="form-control" type="text" name="referencias" id="referencias" placeholder="Link (enlace) a algún trabajo publicado por usted previamente." title="Ingrese el link de alguno de sus artículos publicados previamente en algún otro sitio web." required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <label for="profesion"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Profesión:</label><label class="error">*</label>
                                    <input class="form-control" type="text" name="profesion" id="profesion" placeholder="Profesión" title="Ingrese su profesión." required>
                                </div>
                            </div>
                            <div class="row" style="padding-left: 30%;">
                                <h4><i class="fas fa-user-friends"></i> Redes sociales</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="facebook"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook:</label>
                                    <input class="form-control" type="text" name="facebook" id="facebook" placeholder="Usuario de Facebook" title="Ingrese su nombre de usuario de su cuenta de Facebook">
                                </div>
                                <div class="col-md-6">
                                    <label for="twitter"><i class="fab fa-twitter"></i> Twitter:</label>
                                    <input class="form-control" type="text" name="twitter" id="twitter" placeholder="Usuario de Twitter" title="Ingrese su nombre de usuario de su cuenta de Twitter">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <button id="btnRegistrar" class="btn btn-success form-control" type="submit" name="btnRegistrar">
                                    <span class="fas fa-file-alt "></span> 
                                    Registrarme
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row" style="padding-left: 5%; padding-right: 5%;">
                        <div class="col-md-5" align="left">
                            <button id="btnCancelar" class="btn btn-danger form-control">
                                <span class="fa fa-times"></span>
                                <a href="index.php">Cancelar</a></button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>