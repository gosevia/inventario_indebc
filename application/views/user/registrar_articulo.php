
        <div class="register-container" style="margin:1rem; ">
            <h2>Registrar artículo</h2>
            <?php echo validation_errors(); ?>
            <?php echo form_open_multipart('index.php/admin/registrar_articulo'); ?>
                <div class ="form-group">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo set_value('nombre');?>">
                </div>
                <div class ="form-group">
                    <input type="text" class="form-control" name="marca" placeholder="Marca" value="<?php echo set_value('marca');?>">
                </div>
                <div class ="form-group">
                    <input type="text" class="form-control" name="modelo" placeholder="Modelo" value="<?php echo set_value('modelo');?>">
                </div>
                <div class ="form-group">
                    <input type="number" class="form-control" name="inventario" placeholder="Número de inventario"value="<?php echo set_value('inventario');?>">
                </div>
                <div class ="form-group">
                    <input type="text" class="form-control" name="serie" placeholder="Número de serie"value="<?php echo set_value('serie');?>">
                </div>
                <div class ="form-group">
                    <label for="categoriaSelect" class="col-sm-2 control-label">Categoría</label>
                    <div>
                        <select id="categoriaSelect" class="form-control" name="categoria" value="<?php echo set_value('categoria');?>">
                            <option></option>
                            <?php
                                foreach($categorias as $row){
                                    $categoria_name = $row['nombre'];
                                    echo"<option value='$categoria_name'>$categoria_name</option>";
                                }
                            ?>
                        </select>
                    </div>                
                </div>
                <div class ="form-group">
                    <label for="complejoSelect" >Instalación</label>
                    <div>
                    <!-- CARGAR DIRECTAMENTE DE TABLA DE INSTALACIONES-->
                        <select id="complejoSelect" class="form-control" name="instalacion" value="<?php echo set_value('instalacion');?>">
                            <option></option>
                            <?php
                                foreach($instalaciones as $row){
                                    $instalacion_name = $row['instalacion'];
                                    echo"<option value='$instalacion_name'>$instalacion_name</option>";
                                }
                            ?>
                        </select>
                    </div>           
                </div>
                <div class ="form-group">
                <label for="direccionSelect" >Dirección</label>
                    <div>
                        <select id="direccionSelect" class="form-control" name="direccion" value="<?php echo set_value('direccion');?>">
                            <option></option>
                            <option value = 'Dirección General'>Dirección General</option>
                            <option value = 'Dirección Administrativa'>Dirección Administrativa</option>
                            <option value = 'DANC Y CF' >DANC Y CF</option>
                            <option value = 'Dirección Promoción e Imagen'>Dirección Promoción e Imagen</option>
                            <option value = 'Dirección de Desarrollo del Deporte'>Dirección de Desarrollo del Deporte</option>
                            <option value = 'Dirección de Infraestructura Deportiva'>Dirección de Infraestructura Deportiva</option>
                        </select>
                    </div>  
                </div>
                <div class ="form-group">
                    <label for="encargadoSelect" >Encargado del artículo</label>
                    <div>
                    <!-- CARGAR DIRECTAMENTE DE TABLA DE INSTALACIONES-->
                        <select id="encargadoSelect" class="form-control" name="encargado" value="<?php echo set_value('encargado');?>">
                            <option></option>
                            <?php
                                foreach($administradores as $row){
                                    $encargado_name = $row['nombre'];
                                    echo"<option value='$encargado_name'>$encargado_name</option>";
                                }
                            ?>
                        </select>
                    </div>           
                </div>
                <div class ="form-group">
                    <label>Fecha de compra</label>
                    <input type="date" class="form-control" name="fecha_compra" value="<?php echo set_value('fecha_compra');?>">
                </div>
                <div class ="form-group">
                    <label>Recibo</label>
                    <input type="file" class="form-control" name="recibos[]" multiple value="<?php echo set_value('recibos[]');?>">
                </div>
                <div class ="form-group">
                    <label>Foto(s)</label>
                    <input type="file" class="form-control" name="files[]" multiple value="<?php echo set_value('files[]');?>">
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
