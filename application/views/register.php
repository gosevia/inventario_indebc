        <div class="register-container">
            <h2><?= $title; ?></h2>
            <?php echo validation_errors(); ?>
            <?php echo form_open('index.php'); ?>
                <div class ="form-group">
                    <!--<label>Nombre</label>-->
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                </div>
                <div class ="form-group">
                    <!--<label>Correo electrónico</label>-->
                    <input type="email" class="form-control" name="email" placeholder="Correo electrónico">
                </div>
                <div class ="form-group">
                    <!--<label>RFC</label>-->
                    <input type="text" class="form-control" name="rfc" placeholder="RFC">
                </div>
                <div class ="form-group">
                    <!--<label>Puesto</label>-->
                    <input type="text" class="form-control" name="puesto" placeholder="Puesto">
                </div>
                <div class ="form-group">
                    <!--<label>Departamento</label>-->
                    <input type="text" class="form-control" name="departamento" placeholder="Departamento">
                </div>
                <div class ="form-group">
                    <!--<label>Municipio</label>-->
                    <input type="text" class="form-control" name="municipio" placeholder="Municipio">
                </div>
                <div class ="form-group">
                    <!--<label>Contrasenia</label>-->
                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                </div>
                <div class ="form-group">
                    <!--<label>Confirmar Contraseña</label>-->
                    <input type="password" class="form-control" name="password2" placeholder="Confirmar Contraseña">
                </div>
                <div class="row">
                    <div class="col padding">
                        <button type="submit" name="iniciar" class="btn btn-outline-dark">
                            <i class="fa fa-pencil-square-o"></i> Registrar
                        </button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>