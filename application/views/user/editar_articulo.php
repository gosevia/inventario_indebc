        <div class="register-container" style="margin:1rem; ">
            <h2>Editar artículo</h2>
            <?php 
                if($this->session->userdata('rol')==1){
                    echo form_open_multipart('index.php/admin/editar_articulo');
                }else{
                    echo form_open_multipart('index.php/soporte/editar_articulo');
                } 
            ?>
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
                    <input type="text" class="form-control" name="serie" placeholder="Número de serie" value="<?php echo $articulo->num_serie; ?>">
                </div>
                <div class ="form-group">
                    <label for="categoriaSelect" class="font-weight-bold">Categoría</label>
                    <div>
                        <?php
                            $options = array();
                            foreach($categorias as $row){
                                $options[$row['idCategoria']] = $row['nombre'];
                            }
                            echo form_dropdown('categoria', $options, $articulo->categoria_idCategoria_fk, "class='form-control'");
                        ?>
                    </div>                
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold" for="complejoSelect" >Instalación</label>
                    <div>
                        <?php
                            $options = array();
                            foreach($instalaciones as $row){
                                $options[$row['idInstalacion']] = $row['instalacion'];
                            }
                            echo form_dropdown('instalacion', $options, $articulo->instalacion_idInstalacion_fk, "class='form-control'");
                        ?>
                    </div>           
                </div>
                <div class ="form-group">
                <label class="font-weight-bold" for="direccionSelect">Dirección</label>
                    <div>
                        <?php
                        $options = array(
                            'Dirección General' => 'Dirección General',
                            'Dirección Administrativa' => 'Dirección Administrativa',
                            'DANC Y CF' => 'DANC Y CF',
                            'Dirección Promoción e Imagen' => 'Dirección Promoción e Imagen',
                            'Dirección de Desarrollo del Deporte' => 'Dirección de Desarrollo del Deporte',
                            'Dirección de Infraestructura Deportiva' => 'Dirección de Infraestructura Deportiva'
                        );
                        switch($articulo->direccion_idDireccion_fk){
                            case 1:
                            case 7:
                            case 13:
                            case 19:
                            case 25: $currentDir = "Dirección General"; break;
                            case 2: 
                            case 8:
                            case 14:
                            case 20:
                            case 26: $currentDir = "Dirección Administrativa"; break;
                            case 3: 
                            case 9: 
                            case 15:
                            case 21:
                            case 27: $currentDir = "DANC Y CF"; break;
                            case 4:
                            case 10:
                            case 16:
                            case 22:
                            case 28: $currentDir = "Dirección Promoción e Imagen"; break;
                            case 5:
                            case 11:
                            case 17:
                            case 23:
                            case 29: $currentDir = "Dirección de Desarrollo del Deporte"; break;
                            case 6:
                            case 12:
                            case 18:
                            case 24:
                            case 30: $currentDir = "Dirección de Infraestructura Deportiva"; break;
                        }
                        echo form_dropdown('direccion', $options, $currentDir, "class='form-control'");
                        ?>
                    </div>  
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold">Edificio</label>
                    <input type="text" class="form-control" name="edificio" placeholder="Edificio" value="<?php echo $articulo->edificio; ?>">
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold" for="encargadoSelect" >Encargado del artículo (Administradores)</label>
                    <div>
                        <?php
                            $options = array();
                            foreach($administradores as $row){
                                $options[$row['idUsuario']] = $row['nombre'];
                            }
                            echo form_dropdown('encargado', $options, $articulo->encargado_fk, "class='form-control'");
                        ?>
                    </div>           
                </div>
                <div class ="form-group">
                <label class="font-weight-bold" for="estado">Estado del artículo</label>
                    <div>
                        <select id="estadoSelect" class="form-control" name="estado" value="<?php echo $articulo->status;?>">
                            <option></option>
                            <?php if($articulo->status == 0){ ?>
                                <option value = '0' selected = "selected">Baja</option>
                            <?php }else{?>
                                <option value = '0'>Baja</option>
                            <?php } ?>

                            <?php if($articulo->status == 1){ ?>
                                <option value = '1' selected = "selected">Activo</option>
                            <?php }else{?>
                                <option value = '1'>Activo</option>
                            <?php } ?>

                            <?php if($articulo->status == 2){ ?>
                                <option value = '2' selected = "selected">Prestado</option>
                            <?php }else{?>
                                <option value = '2'>Prestado</option>
                            <?php } ?>
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
