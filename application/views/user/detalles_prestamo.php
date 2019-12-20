<h3 style="text-align: center;">Detalles de préstamo</h3>
    <div class="detalles-container">
        <div class="detalles-table-container">
            <?php 
                if($this->session->userdata('rol')==1){
                    echo form_open('index.php/admin/actualizar_prestamo');
                }else{
                    echo form_open('index.php/soporte/actualizar_prestamo');
                } 
            ?>
            <table class="table table-striped table-bordered">
                <tr>
                <th scope="col">ID</th>
                <td><?php echo $prestamo->idPrestamo; ?></td>
                </tr>
                <tr>
                <th scope="col">Número de préstamo</th>
                <td><?php echo $prestamo->numPrestamo; ?></td>
                </tr>
                <tr>
                <th scope="col">Fecha Inicial</th>
                <td><?php echo $prestamo->fecha_inicio; ?></td>
                </tr>
                <tr>
                <th scope="col">Fecha Final</th>
                <td><?php echo $prestamo->fecha_fin; ?></td>
                </tr>
                <tr>
                <th scope="col">Autorizado por:</th>
                <td><?php 
                $this->db->where('idUsuario',$prestamo->encargado_fk);
                $encargado = $this->db->get('usuario');
                $nombre = $encargado->row(0)->nombre;
                echo $nombre; ?></td>
                </tr>
                <tr>
                <th scope="col">Prestamista</th>
                <td><?php 
                $this->db->where('idUsuario',$prestamo->prestamista_fk);
                $prestamista = $this->db->get('usuario');
                $nombre = $prestamista->row(0)->nombre;
                echo $nombre; ?></td>
                </tr>
                <tr>
                <th scope="col">Empleado</th>
                <td><?php 
                $empleadosDB->where('idEmpleado',$prestamo->empleado_fk);
                $empleado = $empleadosDB->get('empleado');
                $nombre = $empleado->row(0)->nombres;
                $aPaterno = $empleado->row(0)->aPaterno;
                $aMaterno = $empleado->row(0)->aMaterno;
                $nombreStr = $nombre." ".$aPaterno." ".$aMaterno;
                echo $nombreStr; ?></td>
                </tr>
                <tr>
                <th scope="row">Observaciones</th>
                <td>
                <textarea class="form-control" name="observaciones"  value="<?php echo set_value('observaciones');?>"><?php if($prestamo->observaciones != null) {echo $prestamo->observaciones;} ?></textarea>
                </td>
                </tr>
                <tr>
                <th scope="col">Estado</th>
                <td>
                <?php if($this->session->userdata('rol')==3){ 
                    switch($prestamo->status){
                        case 0: echo "Concluido"; break;
                        case 1: echo "Temporal"; break;
                        case 2: echo "Permanente"; break;
                    }
                }else{
                    $options = array(
                        0 => 'Concluido',
                        1 => 'Temporal',
                        2 => 'Permanente'
                    );
                    echo form_dropdown('estado', $options, $prestamo->status);
                }?>
                <td>
                </tr>  
            </table>
            <?php if($this->session->userdata('rol')!=3 ){?>
                <div class="row">
                <div class="col padding">
                    <input type='hidden' id='idPrestamo' name='idPrestamo' value='<?php echo $prestamo->idPrestamo; ?>' />
                    <button type="submit" name="editar" class="btn btn-outline-dark">
                        <i class="fa fa-pencil-square-o"></i> Guardar cambios
                    </button>
                </div>
            </div>
            <?php }?>
            <?php echo form_close(); ?>
        </div>
        
        <div class="prestamos-container">
            <table class="table table-striped table-bordered">
            <th colspan="7">Artículos:</th>
            <tr class="table-success">
                <th><strong>ID:</strong><br></th>
                <th><strong># Inventario:</strong><br></th>
                <th><strong>Nombre:</strong><br></th>
                <th><strong>Marca:</strong><br></th>
                <th><strong>Modelo:</strong><br></th>
                <th><strong>Estado:</strong><br></th>
                <th><strong>Detalles:</strong><br></th>
            </tr>    
            <?php 
            if($articulos){
                foreach($articulos as $row){
                    echo "<tr><th>".$row['idArticulo']."</th>";
                    echo "<th>".$row['num_inventario']."</th><th>".$row['nombre']."</th>";
                    echo "<th>".$row['marca']."</th><th>".$row['modelo']."</th>";
                    switch($row['status']){
                        case 0: echo "<th id='estado1'>No existe</th>"; break;
                        case 1: echo "<th id='estado2'>Activo</th>"; break;
                        case 2: echo "<th id='estado3'>Prestado</th>"; break; 
                    }
                    echo form_open('index.php/admin/detalles_articulo');
                    echo "<th><input type='hidden' id='detalle' name='detalle' value='".$row['idArticulo']."' />";
                    echo '<button class="btn btn-outline-primary" type="submit" value=""><i class="fa fa-search" id="submit"></i></button></th>';
                    echo form_close();
                    echo "</tr>";
                }
            }
                
            ?>
            </table>
        </div>
    </div>