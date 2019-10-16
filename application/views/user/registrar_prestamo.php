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

        <div class="consultar-table-container">
                    <table id="registrarArticulo" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th></th>
                            <th scope="col">ID</th>
                            <th scope="col"># de inventario</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Instalación</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach($articulos as $row){
                            echo "<tr>";
                            echo "<td></td>";
                            echo "<td>".$row['idArticulo']."</td>";
                            echo "<td>".$row['num_inventario']."</td>";
                            echo "<td>".$row['marca']."</td>";
                            echo "<td>".$row['modelo']."</td>";
                            switch($row['direccion_idDireccion_fk']){
                                case 1:
                                case 7:
                                case 13:
                                case 19:
                                case 25: echo "<td>Dirección General</td>"; break;
                                case 2: 
                                case 8:
                                case 14:
                                case 20:
                                case 26: echo "<td>Dirección Administrativa</td>"; break;
                                case 3: 
                                case 9: 
                                case 15:
                                case 21:
                                case 27: echo "<td>DANC Y CF</td>"; break;
                                case 4:
                                case 10:
                                case 16:
                                case 22:
                                case 28: echo "<td>Dirección Promoción e Imagen</td>"; break;
                                case 5:
                                case 11:
                                case 17:
                                case 23:
                                case 29: echo "<td>Dirección de Desarrollo del Deporte</td>"; break;
                                case 6:
                                case 12:
                                case 18:
                                case 24:
                                case 30: echo "<td>Dirección de Infraestructura Deportiva</td>"; break;
                            }
                            switch($row['instalacion_idInstalacion_fk']){
                                case 1: echo "<td>CAR Tijuana</td>"; break;
                                case 2: echo "<td>CD Deportiva Mexicali</td>"; break;
                                case 3: echo "<td>CAR Ensenada</td>"; break;
                                case 4: echo "<td>KM43</td>"; break;
                                case 5: echo "<td>CAR San Felipe</td>"; break;
                            }
                            switch($row['status']){
                                case 0: echo "<td id='estado1'>No existe</td>"; break;
                                case 1: echo "<td id='estado2'>Activo</td>"; break;
                                case 2: echo "<td id='estado3'>Prestado</tc>"; break; 
                            }
                            echo '<td>';
                            echo form_open('index.php/admin/detalles_articulo');
                            echo "<input type='hidden' id='detalle' name='detalle' value='".$row['idArticulo']."' />";
                            echo '<button class="btn btn-outline-primary" type="submit" value=""><i class="fa fa-search" id="submit"></i></button>';
                            echo form_close();
                            echo "</td>";
                            echo "</tr>";           
                        }
                        ?>
                        </tbody>
                    </table>
                </div>