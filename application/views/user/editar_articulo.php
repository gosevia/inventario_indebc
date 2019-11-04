        <div class="register-container" style="margin:1rem; ">
            <h2>Editar artículo</h2>
            <?php echo form_open_multipart('index.php/admin/editar_articulo'); ?>
                <div class ="form-group">
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo $articulo->nombre; ?>">
                </div>
                <div class ="form-group">
                    <input type="text" class="form-control" name="marca" placeholder="Marca" value="<?php echo $articulo->marca; ?>">
                </div>
                <div class ="form-group">
                    <input type="text" class="form-control" name="modelo" placeholder="Modelo" value="<?php echo $articulo->modelo; ?>">
                </div>
                <div class ="form-group">
                    <input type="number" class="form-control" name="inventario" placeholder="Número de inventario" value="<?php echo $articulo->num_inventario; ?>">
                </div>
                <div class ="form-group">
                    <input type="text" class="form-control" name="serie" placeholder="Número de serie"value="<?php echo $articulo->num_serie; ?>">
                </div>
                <p style="color: red; font-weight: bold;">NOTA: MANTENER EN BLANCO LOS SIGUIENTES CAMPOS DE VALORES QUE DESEA CONSERVAR. SOLO MODIFIQUE LOS CAMPOS QUE DESEA CAMBIAR.</p>
                <div class ="form-group">
                    <label for="categoriaSelect" class="font-weight-bold">Categoría</label>
                    <div>
                        <select id="categoriaSelect" class="form-control" name="categoria" value="<?php echo set_value('categoria');?>">
                            <option></option>
                            <?php
                                foreach($categorias as $row){
                                    $categoria_name = $row['nombre'];
                                    echo "<option value='$categoria_name'>$categoria_name</option>";
                                }
                            ?>
                        </select>
                    </div>                
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold" for="complejoSelect" >Instalación</label>
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
                <label class="font-weight-bold" for="direccionSelect">Dirección</label>
                    <div>
                        <select id="direccionSelect" class="form-control" name="direccion" value="<?php echo set_value('direccion');?>">
                            <option></option>
                            <option value = 'Dirección General'>Dirección General</option>
                            <option value = 'Dirección Administrativa'>Dirección Administrativa</option>
                            <option value = 'DANC Y CF'>DANC Y CF</option>
                            <option value = 'Dirección Promoción e Imagen'>Dirección Promoción e Imagen</option>
                            <option value = 'Dirección de Desarrollo del Deporte'>Dirección de Desarrollo del Deporte</option>
                            <option value = 'Dirección de Infraestructura Deportiva'>Dirección de Infraestructura Deportiva</option>
                        </select>
                    </div>  
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold">Edificio</label>
                    <input type="text" class="form-control" name="edificio" placeholder="Edificio" value="<?php echo set_value('edificio');?>">
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold" for="encargadoSelect" >Encargado del artículo (Administradores)</label>
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
                    <label class="font-weight-bold">Fecha de compra</label>
                    <input type="date" class="form-control" name="fecha_compra" value="<?php echo $articulo->fecha_compra; ?>">
                </div>
                <p style="color: red; font-weight: bold;">NOTA: LOS ARCHIVOS QUE ESTÉN SELECCIONADOS SERÁN ELIMINADOS.</p>
                <div class ="form-group">
                    <label class="font-weight-bold">Recibo</label><br />
                    <?php foreach($recibo as $file): ?>
                        <input class="check-with-img" type="checkbox" name="recibosCheck[]" value="<?php echo $file['id']; ?>">
                        <label class="label-for-check">
                            <img class="thumbnail-container" src="<?php echo base_url('uploads/receipt/'.$file['file_name']); ?>" alt="Imagen no disponible" width="100" />
                        </label>
                    <?php endforeach; ?>
                    <input type="file" class="form-control" name="recibos[]" multiple value="<?php echo set_value('recibos[]');?>">
                    <br>
                    <p style="background-color:#99ccff; border-left: 6px solid blue;">Se pueden registrar un máximo de 3 imágenes para el recibo. Las extensiones permitidas son: .jpg, .jpeg y .png</p>
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold">Foto(s)</label><br />
                    <?php $counter = 0; foreach($imagen as $file): ?>
                        <input class="check-with-img" type="checkbox" name="imgCheck[]" value="<?php echo $file['id']; ?>">
                        <label class="label-for-check">
                            <img class="thumbnail-container" src="<?php echo base_url('uploads/image/'.$file['file_name']); ?>" alt="Imagen no disponible" width="100" />
                        </label>
                    <?php endforeach; ?>
                    <input type="file" class="form-control" name="files[]" multiple value="<?php echo set_value('files[]');?>">
                    <br>
                    <p style="background-color:#99ccff; border-left: 6px solid blue;">Se pueden registrar un máximo de 3 imágenes para las fotos. Las extensiones permitidas son: .jpg, .jpeg y .png</p>
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold">Documento de resguardo</label><br />
                    <a href="<?php echo base_url('uploads/resguardo/'.$resguardo->file_name); ?>" target="_blank">Ver documento</a>
                    <input type="file" class="form-control" name="userfile" value="<?php echo set_value('userfile');?>">
                    <br>
                    <p style="background-color:#99ccff; border-left: 6px solid blue;">Subir archivo para reemplazar el actual. Las extensiones permitidas son: .jpg, .jpeg, .png y .pdf</p>
                </div>
                <div class="row">
                    <div class="col padding">
                        <input type='hidden' id='detalle' name='detalle' value='<?php echo $articulo->idArticulo; ?>' />
                        <input type='hidden' id='actualizar' name='actualizar' value='ready' />
                        <button type="submit" name="iniciar" class="btn btn-outline-dark">
                            <i class="fa fa-pencil-square-o"></i> Actualizar
                        </button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
