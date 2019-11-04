<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Sistema de Inventario INDEBC</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" />
</head>
<body>      
    <div class="container-full-image">
        <?php foreach($img as $file): ?>
            <?php if($tipo == '1'): ?>
                <img src="<?php echo base_url('uploads/receipt/'.$file['file_name']); ?>" alt="Imagen no disponible" title="<?php echo $file['file_name']; ?>" />
            <?php endif; ?>
            <?php if($tipo == '0'): ?>
                <img src="<?php echo base_url('uploads/image/'.$file['file_name']); ?>" alt="Imagen no disponible" title="<?php echo $file['file_name']; ?>" />
            <?php endif; ?>
        <?php endforeach; ?>    
    </div>
</body>
</html>