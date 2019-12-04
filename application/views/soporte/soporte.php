<ul class="nav nav-tabs justify-content-center">
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>index.php/soporte/reportes">Reportes</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Articulos</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/soporte/consultar_articulo">Consultar</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/soporte/registrar_articulo">Registrar</a>
        </div>
    </li>
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Préstamos</a>
    <div class="dropdown-menu">
    
      <h5 class= "dropdown-header">Registrar</h5>
      <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/soporte/registrar_prestamo_temp">Préstamo temporal</a>
      <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/soporte/registrar_prestamo_perm">Préstamo permanente</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/soporte/consultar_prestamo">Consultar</a>
    </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url(); ?>index.php/soporte/password">Cambiar contraseña</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>index.php/user/logout">
        <i class="fa fa-sign-out"></i> Cerrar Sesión</a>
    </li>
</ul>