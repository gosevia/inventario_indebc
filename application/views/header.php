<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Sistema de Inventario INDEBC</title>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/datatables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"/>
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" />
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.6/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>


<script type="text/javascript">

    var $ = jQuery.noConflict();

    $(document).ready( function () {
        $('#solicitarTable').DataTable( {
            "language": lang_spanish
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

</head>
<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <p class="lead">
                <img id="logoOficial" src="<?php echo 'http://www.indebc.gob.mx/main/img/logoOficial.png'; ?>" width="300" />
            </p>    
        </div>
        <div class="container">

        <?php if($this->session->flashdata('login_failed')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('login_failed').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('user_loggedin')): ?>
            <?php echo '<p class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('user_loggedin').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('user_loggedout')): ?>
            <?php echo '<p class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('user_loggedout').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('cambios_usuario')): ?>
            <?php echo '<p class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('cambios_usuario').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('inactive_account')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('inactive_account').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('articulo_registrado')): ?>
            <?php echo '<p class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('articulo_registrado').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('articulo_eliminado')): ?>
            <?php echo '<p class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('articulo_eliminado').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('articulo_prestado')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('articulo_prestado').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('articulo_actualizado')): ?>
            <?php echo '<p class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('articulo_actualizado').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('error_registrar')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('error_registrar').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('error_actualizar')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('error_actualizar').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('error_recibo')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('error_recibo').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('error_fotos')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('error_fotos').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('error_resguardo')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('error_resguardo').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('3warning_recibos')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('3warning_recibos').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('3warning_fotos')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('3warning_fotos').'</p>'; ?>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('0warning_img')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('0warning_img').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('prestamo_registrado')): ?>
            <?php echo '<p class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('prestamo_registrado').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('password_change')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('password_change').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('password_success')): ?>
            <?php echo '<p class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('password_success').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('no_match')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('no_match').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('wrong_password')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('wrong_password').'</p>'; ?>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('prestamo_error')): ?>
            <?php echo '<p class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>' .$this->session->flashdata('prestamo_error').'</p>'; ?>
        <?php endif; ?>
</div>
