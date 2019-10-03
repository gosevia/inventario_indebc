
    <h3 style="text-align: center;">Consultar</h3>
        <table id="solicitarTable" class="table table-striped table-bordered">
            <thead>
                <tr>
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
                echo "<td>".$row['num_inventario']."</td>";
                echo "<td>".$row['marca']."</td>";
                echo "<td>".$row['modelo']."</td>";
                switch($row['direccion_idDireccion_fk']){
                    case 1: echo "<td>Dirección General</td>"; break;
                    case 2: echo "<td>Dirección Administrativa</td>"; break;
                    case 3: echo "<td>DANC Y CF</td>"; break;
                    case 4: echo "<td>Dirección Promoción e Imagen</td>"; break;
                    case 5: echo "<td>Dirección de Desarrollo del Deporte</td>"; break;
                    case 6: echo "<td>Dirección de Infraestructura Deportiva</td>"; break;
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
                echo form_open('#');
                echo "<input type='hidden' id='detalle' name='detalle' value='".$row['num_inventario']."' />";
                echo '<button class="btn btn-outline-primary" type="submit" value=""><i class="fa fa-search" id="submit"></i></button>';
                echo form_close();
                echo "</td>";
                echo "</tr>";           
            }
            ?>
        </tbody>
    </table>
