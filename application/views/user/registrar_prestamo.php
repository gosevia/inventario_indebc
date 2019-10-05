        <div class="register-container"style="margin:1rem;">
        <h2>Registrar préstamo</h2>
            <?php echo validation_errors(); ?>
            <?php echo form_open('index.php/admin/registrar_prestamo'); ?>
                <div class ="form-group">
                    <input type="number" class="form-control" name="prestamo" placeholder="Número de prestamo"value="<?php echo set_value('prestamo');?>">
                </div>
                <div class ="form-group">
                    <label>Fecha inicial</label>
                    <input type="date" class="form-control" name="fecha_inicial" value="<?php echo set_value('fecha_inicial');?>">
                </div>
                <div class ="form-group">
                    <label>Fecha final</label>
                    <input type="date" class="form-control" name="fecha_final" value="<?php echo set_value('fecha_final');?>">
                </div>
                <div class ="form-group">
                    <label>Artículos</label>
                    <input type="text" class="form-control" name="articulos" value="<?php echo set_value('articulos');?>">
                </div>
                <div class ="form-group">
                    <label>Encargado</label>
                    <input type="text" class="form-control" name="encargado" value="<?php echo set_value('encargado');?>">
                </div>
                <div class ="form-group">
                    <label>Prestamista</label>
                    <input type="text" class="form-control" name="prestamista" value="<?php echo set_value('prestamista');?>">
                </div>
                <div class ="form-group">
                    <label>Empleado</label>
                    <input type="text" class="form-control" name="empleado" value="<?php echo set_value('empleado');?>">
                </div>
            <?php echo form_close(); ?>
        </div>