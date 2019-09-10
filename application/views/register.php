<h2><?= $title; ?></h2>
<?php echo validation_erros(); ?>
<?php echo form_open('user/register'); ?>
    <div class ="form-group">
        <label>Nombre</label>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre">
    </div>
    <div class ="form-group">
        <label>E-mail</label>
        <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
    <div class ="form-group">
        <label>RFC</label>
        <input type="text" class="form-control" name="rfc" placeholder="RFC">
    </div>
    <div class ="form-group">
        <label>Puesto</label>
        <input type="text" class="form-control" name="puesto" placeholder="Puesto">
    </div>
    <div class ="form-group">
        <label>Departamento</label>
        <input type="text" class="form-control" name="departamento" placeholder="Departamento">
    </div>
    <div class ="form-group">
        <label>Municipio</label>
        <input type="text" class="form-control" name="municipio" placeholder="Municipio">
    </div>
    <div class ="form-group">
        <label>Contrasenia</label>
        <input type="password" class="form-control" name="password" placeholder="Contrasenia">
    </div>
    <div class ="form-group">
        <label>Confirmar Contrasenia</label>
        <input type="password" class="form-control" name="password2" placeholder="Nombre">
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
<?php echo form_close(); ?>