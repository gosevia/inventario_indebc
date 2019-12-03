
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.dataTables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>

<script type="text/javascript">

    var $ = jQuery.noConflict();

    $(document).ready( function () {
        
        // Setup - add a text input to each footer cell
       // $('#reportesTable thead tr').clone(true).appendTo( '#reportesTable thead' );
        $('#reportesTable thead tr:eq(1) th').each( function (i) {
            
            if(i>5){
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
    
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            }
        } );

        var table = $('#reportesTable').DataTable( {
            "language": lang_spanish,
            orderCellsTop: true,
            fixedHeader: true,
            scrollY: false,
            scrollX: true,
            scrollCollapse: true
        });
    
    });
    //<!-- para lenguaje español de la tabla -->
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

<h3 style="text-align: center;">Reportes</h3>
        <div class="consultar-table-container">
            <table id="reportesTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col"># Inventario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col"># Serie</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Instalación</th>
                    <th scope="col">Edificio</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Encargado</th>
                    </tr>
                    <thead>
                        <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th ></th>
                        <th ></th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                </thead>
                <tbody>
                <?php 
                foreach($articulos as $row){
                    echo "<tr>";
                    echo "<td>".$row['idArticulo']."</td>";
                    echo "<td>".$row['num_inventario']."</td>";
                    echo "<td>".$row['nombre']."</td>";
                    echo "<td>".$row['marca']."</td>";
                    echo "<td>".$row['modelo']."</td>";
                    echo "<td>".$row['num_serie']."</td>";
                    switch($row['categoria_idCategoria_fk']){
                        case 1: echo "<td>Equipo de cómputo</td>"; break;
                        case 2: echo "<td>Equipo multimedia</td>"; break;
                    }
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
                    echo "<td>".$row['edificio']."</td>";
                    switch($row['status']){
                        case 0: echo "<td id='estado1'>No existe</td>"; break;
                        case 1: echo "<td id='estado2'>Activo</td>"; break;
                        case 2: echo "<td id='estado3'>Prestado</tc>"; break; 
                    }
                    $nombre = "";
                    foreach($usuarios as $row2){
                        if($row2['idUsuario'] == $row['encargado_fk']){
                            $nombre = $row2['nombre'];
                        }
                    }

                    if($nombre != ""){
                        echo "<td>".$nombre."</td>";
                    }else{
                        echo "<td>Nadie</td>";
                    }
                    echo "</tr>";           
                }
                ?>
            </tbody>
        </table>
        <div style="text-align: center; margin-bottom: 50px;">
            <button type="submit" name="generar_reporte" class="btn btn-outline-dark">
                <i class="fa fa-file-text"></i> Generar PDF
            </button>
        </div>
    </div>
