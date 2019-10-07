<h3 style="text-align: center;">Detalles de Artículo</h3>
<div class="detalles-table-container">
    <table class="table table-striped table-bordered">
        <tr>
        <th scope="row">ID</th>
        <td><?php echo $articulo->idArticulo; ?></td>
        </tr>
        <tr>
        <th scope="row"># de inventario</th>
        <td><?php echo $articulo->num_inventario; ?></td>
        </tr>
        <tr>
        <th scope="row">Marca</th>
        <td><?php echo $articulo->marca; ?></td>
        </tr>
        <tr>
        <th scope="row">Modelo</th>
        <td><?php echo $articulo->modelo; ?></td>
        </tr>
        <tr>
        <th scope="row">Nombre</th>
        <td><?php echo $articulo->nombre; ?></td>
        </tr>
        <tr>
        <th scope="row">Fecha de compra</th>
        <td><?php echo $articulo->fecha_compra; ?></td>
        </tr>
        <tr>
        <th scope="row">Categoría</th>
        <?php 
            switch($articulo->categoria_idCategoria_fk){
                case 1: echo "<td>Equipo de cómputo</td>"; break;
                case 2: echo "<td>Equipo multimedia</td>"; break;
            }
        ?>
        </tr>
        <tr>
        <th scope="row">Encargado</th>
        <td></td>
        </tr>
        <tr>
        <th scope="row">Prestado a</th>
        <td></td>
        </tr>
        <tr>
        <th scope="row">Dirección</th>
        <?php 
            switch($articulo->direccion_idDireccion_fk){
                case 1: echo "<td>Dirección General</td>"; break;
                case 2: echo "<td>Dirección Administrativa</td>"; break;
                case 3: echo "<td>DANC Y CF</td>"; break;
                case 4: echo "<td>Dirección Promoción e Imagen</td>"; break;
                case 5: echo "<td>Dirección de Desarrollo del Deporte</td>"; break;
                case 6: echo "<td>Dirección de Infraestructura Deportiva</td>"; break;
            }
        ?>
        </tr>
        <tr>
        <th scope="row">Instalación</th>
        <?php 
            switch($articulo->instalacion_idInstalacion_fk){
                case 1: echo "<td>CAR Tijuana</td>"; break;
                case 2: echo "<td>CD Deportiva Mexicali</td>"; break;
                case 3: echo "<td>CAR Ensenada</td>"; break;
                case 4: echo "<td>KM43</td>"; break;
                case 5: echo "<td>CAR San Felipe</td>"; break;
            }
        ?>
        </tr>
        <tr>
        <th scope="row">Estado</th>
        <?php
            switch($articulo->status){
                case 0: echo "<td id='estado1'>No existe</td>"; break;
                case 1: echo "<td id='estado2'>Activo</td>"; break;
                case 2: echo "<td id='estado3'>Prestado</tc>"; break; 
            }
        ?>
        </tr>
    </table>
    <div class="row">
        <div class="col padding">
            <button type="submit" name="editar" class="btn btn-outline-primary">
                <i class="fa fa-pencil-square-o"></i> Editar
            </button>
        </div>
    </div>
    <div class="image-container">
        <ul style="list-style-type:none">
            <?php if(!empty($recibo)){ foreach($recibo as $file){ ?>
                <li>
                    <img class="imagen-inventario" src="<?php echo base_url('uploads/receipt/'.$file['file_name']); ?>" >
                </li>
                <?php } }else{ ?>
                <p>Sin recibo...</p>
                <?php } ?>
            </ul>
        </div>
    <div class="recibo-container">
        <ul style="list-style-type:none">
            <?php if(!empty($imagen)){ foreach($imagen as $file){ ?>
                <li>
                    <img class="imagen-inventario" src="<?php echo base_url('uploads/image/'.$file['file_name']); ?>" >
                </li>
                <?php } }else{ ?>
                <p>Sin imágenes...</p>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>