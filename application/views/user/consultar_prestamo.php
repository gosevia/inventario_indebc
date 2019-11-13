
    <h3 style="text-align: center;">Consultar préstamos</h3>
        <div class="consultar-table-container">
            <table id="solicitarTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col"># de préstamo</th>
                    <th scope="col">Fecha inicial</th>
                    <th scope="col">Fecha final</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $empleadosDB = $this->load->database('eusined', TRUE);

                foreach($prestamos as $row){
                    echo "<tr>";
                    echo "<td>".$row['idPrestamo']."</td>";
                    echo "<td>".$row['numPrestamo']."</td>";
                    echo "<td>".$row['fecha_inicio']."</td>";
                    echo "<td>".$row['fecha_fin']."</td>";

                    $empleadosDB->where('idEmpleado',$row['empleado_fk']);
                    $empleado = $empleadosDB->get('empleado');
                    $nombre = $empleado->row(0)->nombres;
                    $aPaterno = $empleado->row(0)->aPaterno;
                    $aMaterno = $empleado->row(0)->aMaterno;
                    $nombreStr = $nombre." ".$aPaterno." ".$aMaterno;
                    echo "<td>".$nombreStr."</td>";
                    switch($row['status']){
                        case 0: echo "<td id='estado1'>Concluido</td>"; break;
                        case 1: echo "<td id='estado2'>Temporal</td>"; break;
                        case 2: echo "<td id='estado3'>Permanente</tc>"; break; 
                    }
                    echo '<td>';
                    if($this->session->userdata('rol')==1){
                        echo form_open('index.php/admin/detalles_prestamo');
                    }else{
                        echo form_open('index.php/soporte/detalles_prestamo');
                    }
                    echo "<input type='hidden' id='detalle' name='detalle' value='".$row['idPrestamo']."' />";
                    echo '<button class="btn btn-outline-primary" type="submit" value=""><i class="fa fa-search" id="submit"></i></button>';
                    echo form_close();
                    echo "</td>";
                    echo "</tr>";           
                }
                ?>
            </tbody>
        </table>
    </div>
