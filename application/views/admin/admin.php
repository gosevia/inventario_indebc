
<ul class="nav justify-content-center">
    
    <li class="nav-item">
        <a class="nav-link" href="#">
        <i class="fa "></i> Reportes</a>
    </li>

    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Artículos</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/admin/consultar_articulo">Consultar</a>
      <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/admin/registrar_articulo">Registrar</a>
      <a class="dropdown-item" href="#">Bajas</a>
    </div>
    </li>

    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Usuarios</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Consultar</a>
      <a class="dropdown-item" href="#">Gestionar</a>
    </div>
    </li>

    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Préstamos</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/admin/registrar_prestamo">Registrar</a>
      <a class="dropdown-item" href="#">Consultar</a>
    </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>index.php/user/logout">
        <i class="fa fa-sign-out"></i> Cerrar Sesión</a>
    </li>
</ul>



<!-- Lo siguiente ya no se esta utilizando 
LO DEJO POR SI QUIERES REVISAR LO DEL DATATABLE DE AQUI.
LA TABLA SE ENCUENTRA EN USER/CONSULTAR_ARTICULO-->







<!--TABS DE NAVEGACION
<ul class="nav nav-tabs justify-content-center">
    <li class="nav-item">
        <a data-toggle="tab" class="nav-link" href="#reportes">Reportes</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Artículos</a>
        <div class="dropdown-menu">
            <a data-toggle="tab" class="dropdown-item" href="#articulos_consultar">Consultar</a>
            <a data-toggle="tab" class="dropdown-item" href="<?php echo base_url(); ?>index.php/admin/registrar_articulo">Registrar</a>
            <a data-toggle="tab" class="dropdown-item" href="#articulos_bajas">Bajas</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Usuarios</a>
        <div class="dropdown-menu">
            <a data-toggle="tab" class="dropdown-item" href="#usuarios_consultar">Consultar</a>
            <a data-toggle="tab" class="dropdown-item" href="#usuarios_gestionar">Gestionar</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Préstamos</a>
        <div class="dropdown-menu">
            <a data-toggle="tab" class="dropdown-item" href="#prestamos_registrar">Registrar</a>
            <a data-toggle="tab" class="dropdown-item" href="#prestamos_consultar">Consultar</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>index.php/user/logout">
        <i class="fa fa-sign-out"></i> Cerrar Sesión</a>
    </li>
</ul>
    -->
 <!--CONTENIDO DE CADA UNA DE LAS TABS-->
 
 <div class="tab-content">

<!--REPORTES-->

   <div id="reportes" class="tab-pane fade in active">
       <h3>Reportes</h3>
   </div>

<!--CONSULTAR ARTICULOS-->
   <div id="articulos_consultar" class="tab-pane fade">
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
   </div>
  
<!--REGISTRAR ARTICULOS-->
   <div id="" class="tab-pane fade">
       <div class="register-container" style="margin:1rem; ">
           <h2>Registrar artículo</h2>
           <?php echo validation_errors(); ?>
           <?php echo form_open('index.php/admin/'); ?>
               <div class ="form-group">
                   <input type="number" class="form-control" name="inventario" placeholder="Número de inventario">
               </div>
               <div class ="form-group">
                   <input type="text" class="form-control" name="serie" placeholder="Número de serie">
               </div>
               <div class ="form-group">
                   <input type="text" class="form-control" name="marca" placeholder="Marca">
               </div>
               <div class ="form-group">
                   <input type="text" class="form-control" name="modelo" placeholder="Modelo">
               </div>
               <div class ="form-group">
                   <label for="categoriaSelect" class="col-sm-2 control-label">Categoría</label>
                   <div>
                       <select id="categoriaSelect" class="form-control" name="categoria">
                           <?php
                               foreach($categorias as $row){
                                   $categoria_name = $row['nombre'];
                                   echo"<option value='$categoria_name'>$categoria_name</option>";
                               }
                           ?>
                       </select>
                   </div>                
               </div>
               <div class ="form-group">
                   <label for="complejoSelect" >Instalación</label>
                   <div>
                   <!-- CARGAR DIRECTAMENTE DE TABLA DE INSTALACIONES-->
                       <select id="complejoSelect" class="form-control" name="instalacion">
                           <?php
                               foreach($instalaciones as $row){
                                   $instalacion_name = $row['instalacion'];
                                   echo"<option value='$instalacion_name'>$instalacion_name</option>";
                               }
                           ?>
                       </select>
                   </div>           
               </div>
               <div class ="form-group">
               <label for="direccionSelect" >Dirección</label>
                   <div>
                        <!-- CARGAR DIRECTAMENTE DE TABLA DE DIRECCIONES DEPENDIENDO DE LA INSTALACION-->
                       <select id="direccionSelect" class="form-control" name="direccion">
                           <option value = 'Dirección General'>Dirección General</option>
                           <option value = 'Dirección Administrativa'>Dirección Administrativa</option>
                           <option value = 'DANCF Y CF' >DAN Y CF</option>
                           <option value = 'Dirección Promoción e Imagen'>Dirección Promoción e Imagen</option>
                           <option value = 'Dirección de Desarrollo del Deporte'>Dirección de Desarrollo del Deporte</option>
                           <option value = 'Dirección de Infraestructura Deportiva'>Dirección de Infraestructura Deportiva</option>
                       </select>
                   </div>  
               </div>
               <div class ="form-group">
                   <label>Fecha de compra</label>
                   <input type="date" class="form-control" name="fecha_compra">
               </div>
               <div class ="form-group">
                   <label>Recibo</label>
                   <input type="file" class="form-control" name="recibo_compra">
               </div>
               <div class ="form-group">
                   <label>Foto</label>
                   <input type="file" class="form-control" name="foto">
               </div>
               <div class="row">
                   <div class="col padding">
                       <button type="submit" name="iniciar" class="btn btn-outline-dark">
                           <i class="fa fa-pencil-square-o"></i> Registrar
                       </button>
                   </div>
               </div>
           <?php echo form_close(); ?>
       </div>
   </div>

   <div id="articulos_bajas" class="tab-pane fade">
     <h3>Bajas</h3>
     <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
   </div>

   <div id="usuarios_consultar" class="tab-pane fade">
     <h3>Consultar</h3>
     <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
   </div>

   <div id="usuarios_gestionar" class="tab-pane fade">
     <h3>Gestionar</h3>
     <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
   </div>
   
   <div id="prestamos_registrar" class="tab-pane fade">
     <h3>Registrar</h3>
     <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
   </div>

   <div id="prestamos_consultar" class="tab-pane fade">
     <h3>Consultar</h3>
     <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
   </div>
 </div>