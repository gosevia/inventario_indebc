
    <h3 style="text-align: center;">Consultar usuarios</h3>
        <div class="consultar-table-container">
            <table id="solicitarTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">RFC / Correo</th>
                    <th scope="col">Estado</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach($usuarios as $row){
                    echo "<tr>";
                    echo "<td>".$row['idUsuario']."</td>";
                    echo "<td>".$row['nombre']."</td>";
                    echo "<td>".$row['correo_rfc']."</td>";
                    switch($row['status']){
                        case 0: echo "<td>No Activo</td>"; break;
                        case 1: echo "<td>Activo</td>"; break;
                    }
                    echo '<td>';
                    echo form_open('index.php/admin/detalles_usuario');
                    echo "<input type='hidden' id='idUsuario' name='idUsuario' value='".$row['idUsuario']."' />";
                    echo '<button class="btn btn-outline-primary" type="submit" value=""><i class="fa fa-search" id="submit"></i></button>';
                    echo form_close();
                    echo "</td>";
                    echo "</tr>";           
                }
                ?>
            </tbody>
        </table>
    </div>
