<h3 style="text-align: center;">Mis préstamos</h3>
        <div class="consultar-table-container">
            <table id="solicitarTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col"># de préstamo</th>
                    <th scope="col">Fecha inicial</th>
                    <th scope="col">Fecha final</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if($prestamos != null){
                    foreach($prestamos as $row){
                        echo "<tr>";
                        echo "<td>".$row['idPrestamo']."</td>";
                        echo "<td>".$row['numPrestamo']."</td>";
                        echo "<td>".$row['fecha_inicio']."</td>";
                        echo "<td>".$row['fecha_fin']."</td>";
                        switch($row['status']){
                            case 0: echo "<td id='estado1'>Concluido</td>"; break;
                            case 1: echo "<td id='estado2'>Temporal</td>"; break;
                            case 2: echo "<td id='estado3'>Permanente</tc>"; break; 
                        }
                        echo '<td>';
                        echo form_open('index.php/empleado/detalles_prestamo');
                        echo "<input type='hidden' id='detalle' name='detalle' value='".$row['idPrestamo']."' />";
                        echo '<button class="btn btn-outline-primary" type="submit" value=""><i class="fa fa-search" id="submit"></i></button>';
                        echo form_close();
                        echo "</td>";
                        echo "</tr>";           
                    }
                }
                ?>
            </tbody>
        </table>
    </div>