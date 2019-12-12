        <div class="register-container"style="margin:1rem;">
        <h2>Registrar préstamo temporal</h2>
            <?php echo validation_errors(); ?>
            <?php $submit = array('onsubmit' => "document.getElementById('articulos').disabled = false;"); ?>
            <?php if($this->session->userdata('rol')==1){
                echo form_open('index.php/admin/registrar_prestamo_temp', $submit);
             }else{
                echo form_open('index.php/soporte/registrar_prestamo_temp', $submit);
             } ?>
                <div class ="form-group">
                    <input type="number" class="form-control" name="prestamo" placeholder="Número de préstamo"value="<?php echo set_value('prestamo');?>">
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold">Fecha inicial</label>
                    <input type="date" class="form-control" name="fecha_inicial" value="<?php echo set_value('fecha_inicial');?>">
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold">Fecha final</label>
                    <input type="date" class="form-control" name="fecha_final" value="<?php echo set_value('fecha_final');?>">
                </div>

                <div class ="form-group">
                    <label class="font-weight-bold" for="encargadoSelect" >Encargado</label>
                    <div>
                        <select id="encargadoSelect" class="form-control" name="encargado" value="<?php echo set_value('encargado');?>">
                            <option></option>
                            <?php
                                foreach($administradores as $row){
                                    $encargado_name = $row['nombre'];
                                    echo"<option value='$encargado_name'>$encargado_name</option>";
                                }
                            ?>
                        </select>
                    </div>           
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold" for="prestamistaSelect" >Prestamista</label>
                    <div>
                        <select id="prestamistaSelect" class="form-control" name="prestamista" value="<?php echo set_value('prestamista');?>">
                            <option></option>
                            <?php
                                foreach($practicantes as $row){
                                    $prestamista_name = $row['nombre'];
                                    echo"<option value='$prestamista_name'>$prestamista_name</option>";
                                }
                                foreach($administradores as $row){
                                    $prestamista_name = $row['nombre'];
                                    echo"<option value='$prestamista_name'>$prestamista_name</option>";
                                }
                            ?>
                        </select>
                    </div>           
                </div>
                <div class ="form-group">
                    <label class="font-weight-bold">Empleado</label>
                    <input type="text" class="form-control" id="empleado" name="empleado" value="<?php echo set_value('empleado');?>">
                </div>
                <div class ="form-group ui-widget">
                    <label class="font-weight-bold">Artículos agregados al préstamo:</label>
                    <select name="articulosSelected[]" class="form-control" id="articulos" multiple disabled="true">
                        
                    </select>
                </div>
                <div class="row">
                    <div class="col padding">
                        <button type="submit" name="iniciar" class="btn btn-success" onclick="return confirm('¿Está seguro que quiere registrar este préstamo?')">
                            <i class="fa fa-pencil-square-o"></i> Registrar Préstamo
                        </button>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>

        <div class="consultar-table-container" style="margin-bottom:5rem;">
            <p style="background-color:#EF648E; border-left: 10px solid #691B33; padding-left: 5px" class="font-weight-bold">
                Utiliza la siguiente tabla para seleccionar los artículos deseados. Una vez seleccionados, presiona "Agregar artículos al préstamo".
                No será posible seleccionar los artículos ya prestados.            
            </p>
                    <table id="seleccionarArticulo" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th></th>
                            <th scope="col">ID</th>
                            <th scope="col"># de inventario</th>
                            <th scope="col">Nombre</th>
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
                            echo "<td>".$row['nombre']."</td>";
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
                                case 2: echo "<td id='estado3' class='prestado'>Prestado</td>"; break; 
                            }
                            echo '<td>';
                            if($this->session->userdata('rol')==1){
                                echo form_open('index.php/admin/detalles_articulo');
                            }else{
                                echo form_open('index.php/soprte/detalles_articulo');
                            }
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
        
<script type="text/javascript">
    $(document).ready( function () {
        var listaArticulos = $('#articulos');
        var table = $('#seleccionarArticulo').DataTable( {
            "language": lang_spanish,
            columnDefs: [{
            targets: 0,
            className: 'select-checkbox',
            orderable: false
            }],
            select: {
                style: 'multi',
                //selector: 'td:first-child'
                selector: 'tr:not(.no-select)'
            },
            //Validacion para no seleccionar los articulos ya prestados
            rowCallback: function(row, data, index){
                if(data[7] == 'Prestado'){
                    $('td:eq(0)', row).html('');
                    $(row).addClass('no-select');
                }
            },
            order: [[1, 'asc']],
            dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons:[
                {
                    text: 'Agregar artículos al préstamo',
                    className: 'btn btn-outline-dark',
                    action: function (){
                        var count = table.rows('.selected').count();
                        var seleccionados = table.rows('.selected').data().toArray();
                        console.log(seleccionados);
                        
                        //Agregar articulos a la selecccion multiple del prestamo. 
                        listaArticulos.empty();
                        for (i = 0; i < count; i++) {
                            listaArticulos.append('<option value="'+seleccionados[i][1]+'"selected = "true">'+seleccionados[i][1]+' '+seleccionados[i][3]+' '+seleccionados[i][4]+'</option>');
                        }

                    }
                }
            ]
        });
    });
    //<!-- para lenguaje español de la tabla 
    var lang_spanish = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
</script>

<!-- AUTOCOMPLETE INPUT-->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    var x = jQuery.noConflict();

    var emp= JSON.parse('<?php echo json_encode($empleados); ?>');
    var empleados = [];

    for (i = 0; i < emp.length; i++) {
        empleados[i] = emp[i].nombre;
    }
    
    x( function(){
        x("#empleado").autocomplete({
            source: empleados
        });
    });
</script>