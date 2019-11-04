    <div class="password-container">
        <h3 style="text-align: center">Cambiar Contraseña</h3>
        <?php echo form_open('index.php/admin/verify'); ?>
            <div class="row">
                <div class="col-md col-md-offset-4">
                    <div class="input-group mb-3">   
                        <input type="password" class="form-control" name="actual" placeholder="Contraseña actual">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" name="nuevo" placeholder="Nueva contraseña">
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" name="confirmar" placeholder="Confirmar nueva contraseña">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col padding">
                    <button type="submit" name="guardar" class="btn btn-primary">
                        <i class="fa fa-floppy-o"></i> Guardar
                    </button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>