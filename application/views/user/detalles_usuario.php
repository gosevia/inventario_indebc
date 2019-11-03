    <h3 style="text-align: center;">Detalles de usuario</h3>
    <div class="detalles-container">
        <div class="detalles-table-container">
            <?php echo form_open('index.php/admin/actualizar_usuario'); ?>
            <table class="table table-striped table-bordered">
                <tr>
                <th scope="col">ID</th>
                <td><?php echo $usuario[0]->idUsuario; ?></td>
                </tr>
                <tr>
                <th scope="col">Nombre</th>
                <td><?php echo $usuario[0]->nombre; ?></td>
                </tr>
                <tr>
                <th scope="col">RFC / Correo</th>
                <td><?php echo $usuario[0]->correo_rfc; ?></td>
                </tr>
                <tr>
                <th scope="col">Estado</th>
                <?php
                    switch($usuario[0]->status){
                        case 0: echo "<td>No Activo</td>"; break;
                        case 1: echo "<td>Activo</td>"; break;
                    }
                ?>
                </tr>
                <tr>
                <th scope="col">Rol</th>
                <td>
                <?php 
                    $options = array(
                        1 => 'Administrador',
                        2 => 'Soporte',
                        3 => 'Empleado'
                    );
                    echo form_dropdown('rol', $options, $usuario[0]->rol);
                ?>
                </td>
                </tr>
            </table>
            <div class="row">
                <div class="col padding">
                    <input type='hidden' id='idUsuario' name='idUsuario' value='<?php echo $usuario[0]->idUsuario; ?>' />
                    <button type="submit" name="editar" class="btn btn-outline-dark">
                        <i class="fa fa-pencil-square-o"></i> Guardar cambios
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="prestamos-container">
            <table class="table table-striped table-bordered">
            <?php 
                if($prestamos == null){
                    echo "<tr><td><strong>Este usuario no tiene préstamos a su nombre.</strong></td></tr>";
                }else{
                    foreach($prestamos as $row){
                        echo "<tr><td><strong>ID:</strong> ".$row['idPrestamo']." <strong>Estatus:</strong> ";
                        switch($row['status']){
                            case 0: echo "Concluido"; break;
                            case 1: echo "Temporal"; break;
                            case 2: echo "Permanente"; break; 
                        }
                        echo "</td></tr>";
                    }
                }
            ?>
            </table>
        </div>
    </div>