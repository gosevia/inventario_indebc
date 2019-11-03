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
      <!--<a class="dropdown-item" href="#">Bajas</a>-->
    </div>
    </li>

    <li class="nav-item">
    <!--<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Usuarios</a>
    <div class="dropdown-menu">-->
      <a class="nav-link" href="<?php echo base_url(); ?>index.php/admin/consultar_usuario">Usuarios</a>
      <!--<a class="dropdown-item" href="#">Gestionar</a>
    </div>-->
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
