    <?php echo validation_errors(); ?>
        <br />
        <div class="login-container">
            <h4><strong>INDEBC | SISTEMA DE INVENTARIO</strong></h4>
            <?php echo form_open('index.php/user/login'); ?>
                <div class="row">
                    <div class="col-md col-md-offset-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text user"><i id="user" class="fa fa-user"></i></span>   
                            <input type="text" class="form-control" name="rfc" placeholder="Ingrese su RFC (empleado) o correo (soporte)" value="<?php echo set_value('rfc');?>">
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i id="lock" class="fa fa-lock fa-lg"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Contraseña">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col padding">
                        <button type="submit" name="iniciar" class="btn btn-outline-dark">
                            <i class="fa fa-sign-in"></i> Iniciar Sesión
                        </button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>