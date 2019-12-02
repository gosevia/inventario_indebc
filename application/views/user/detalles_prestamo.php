<h3 style="text-align: center;">Detalles de préstamo</h3>
    <div class="detalles-container">
        <div class="detalles-table-container">
            <?php 
                if($this->session->userdata('rol')==1){
                    echo form_open('index.php/admin/detalles_prestamo');
                }else{
                    echo form_open('index.php/soporte/detalles_prestamo');
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
                <th scope="col">Estado</th>
                <?php
                    switch($prestamo->status){
                        case 0: echo "<td>Concluido</td>"; break;
                        case 1: echo "<td>Temporal</td>"; break;
                        case 2: echo "<td>Permanente</td>"; break;
                    }
                ?>
                </tr>  
            </table>
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