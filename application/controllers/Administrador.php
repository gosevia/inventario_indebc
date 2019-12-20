<?php
    class Administrador extends CI_Controller{

        public function menu(){
            if(!$this->session->userdata('logged_in')){
                redirect('index.php/user/login');
            }else if($this->session->userdata('rol')==2){
                redirect('index.php/soporte');
            }else if($this->session->userdata('rol')==3){
                redirect('index.php/empleado');
            }else{
                $data['articulos'] = $this->user_model->getArticulos();
                $data['instalaciones'] = $this->user_model->getInstalaciones();
                $data['categorias'] = $this->user_model->getCategorias();
                $this->load->view('header');
                $this->load->view('admin/admin',$data);
                $this->load->view('footer');
            }
        }
        public function registrar_articulo(){
            $this->form_validation->set_rules('nombre','Nombre','required');
            $this->form_validation->set_rules('marca','Marca','required');
            $this->form_validation->set_rules('modelo','Modelo','required');
            $this->form_validation->set_rules('categoria','Categoría','required');
            $this->form_validation->set_rules('instalacion','Instalación','required');
            $this->form_validation->set_rules('direccion','Dirección','required');
            $this->form_validation->set_rules('encargado','Encargado','required');

            $data['instalaciones'] = $this->user_model->getInstalaciones();
            $data['categorias'] = $this->user_model->getCategorias();
            $data['administradores'] = $this->user_model->getAdministradores();
            
            if($this->form_validation->run() === FALSE){
                $this->load->view('header');
                $this->load->view('admin/admin');
                $this->load->view('user/registrar_articulo',$data);
                $this->load->view('footer');
            }else{
                //Arreglos de los nombres de los recibos
                $filename_recibos=array();
                $filename_fotos=array();
                $filename_resguardo = 'value';

                //Preparar configuracion para subir archivos
                //Configuracion para recibo
                $config=array();
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '10000';
                $config['upload_path'] = './uploads/receipt';
                $this->load->library('upload',$config,'reciboUpload');
                $this->reciboUpload->initialize($config);
                
                //Configuracion para fotos
                $config=array();
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '10000';
                $config['upload_path'] = './uploads/image';
                $this->load->library('upload',$config,'fotoUpload');
                $this->fotoUpload->initialize($config);

                //Configuracion para resguardo
                $config=array();
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = '10000';
                $config['upload_path'] = './uploads/resguardo';
                $this->load->library('upload',$config,'resguardoUpload');
                $this->resguardoUpload->initialize($config);
                
                //Subir Recibos
    
                $count = count($_FILES['recibos']['name']);

                if($count>0){
                    if($count > 3 ){
                        $this->session->set_flashdata('3warning_recibos','El número de imágenes para el recibo ha sobrepasado el máximo de 3');
                        redirect('index.php/admin/registrar_articulo');
                    }else{
                        for($i=0;$i<$count;$i++){
                            if(!empty($_FILES['recibos']['name'][$i])){
                                $_FILES['file']['name'] = $_FILES['recibos']['name'][$i];
                                $_FILES['file']['type'] = $_FILES['recibos']['type'][$i];
                                $_FILES['file']['tmp_name'] = $_FILES['recibos']['tmp_name'][$i];
                                $_FILES['file']['error'] = $_FILES['recibos']['error'][$i];
                                $_FILES['file']['size'] = $_FILES['recibos']['size'][$i];
        
                                if($this->reciboUpload->do_upload('file')){
                                    $uploadData = $this->reciboUpload->data();
                                    $filename = $uploadData['file_name'];
                                    $filename_recibos[$i]=$filename;

                                }else{
                                    $this->session->set_flashdata('error_recibo','Ha habido un error al subir alguna(s) de las imágenes de recibo.
                                    Verifica que la imágen sea tipo jpg, jpeg o png');
                                    redirect('index.php/admin/registrar_articulo');
                                }
                            }
                        }
                    }
                }

                //Subir Fotos
                $count = count($_FILES['files']['name']);

                if($count>0){
                    if($count > 3 ){
                        $this->session->set_flashdata('3warning_fotos','El número de imágenes para las fotos ha sobrepasado el máximo de 3');
                        redirect('index.php/admin/registrar_articulo');
                    }else{
                        for($i=0;$i<$count;$i++){
                            if(!empty($_FILES['files']['name'][$i])){
                                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                                $_FILES['file']['size'] = $_FILES['files']['size'][$i];
        
                                if($this->fotoUpload->do_upload('file')){
                                    $uploadData = $this->fotoUpload->data();
                                    $filename = $uploadData['file_name'];
                                    $filename_fotos[$i]=$filename;
                                }else{
                                    $this->session->set_flashdata('error_fotos','Ha habido un error al subir alguna(s) de las imágenes de Foto.
                                    Verifica que la imágen sea tipo jpg, jpeg o png');                                
                                    redirect('index.php/admin/registrar_articulo');
                                }
                            }
                        }
                    }
                }

                //Subir resguardo
                if(!empty($_FILES['userfile']['name'])){
                    if($this->resguardoUpload->do_upload('userfile')){
                        $uploadData = $this->resguardoUpload->data();
                        $filename = $uploadData['file_name'];
                        $filename_resguardo = $filename;
                    }else{
                        $this->session->set_flashdata('error_resguardo','Ha habido un error al subir el archivo o imágen del resguardo.
                                    Verifica que sea tipo jpg, jpeg, png o pdf');                                
                                    redirect('index.php/admin/registrar_articulo');
                    }
                }

                if($this->user_model->registrarArticulo()){
                    $articulo_id = $this->db->insert_id();

                    //Guardar los recibos en las base de datos
                    foreach($filename_recibos as $filename){
                        $this->user_model->subirRecibo($filename,$articulo_id);
                    }

                    //Guardar las fotos en las base de datos
                    foreach($filename_fotos as $filename){
                        $this->user_model->subirFoto($filename,$articulo_id);
                    }

                    //Guardar archivo o imagen de resguardo
                    $this->user_model->subirResguardo($filename_resguardo, $articulo_id);

                    $this->session->set_flashdata('articulo_registrado','El artículo ha sido registrado');
                    redirect('index.php/admin/consultar_articulo');
                }else{
                    $this->session->set_flashdata('error_registrar','Ha habido un error al registrar el artículo, inténtelo de nuevo');                                
                    redirect('index.php/admin/registrar_articulo');
                }
            }
        }

        //Verificar si el Numero de inventario existe
        public function check_numInv_exists($numero){
            $this->form_validation->set_message('check_numInv_exists','Ese número de inventario ya ha sido capturado.
            Por favor ingresa otro');
            if($this->user_model->check_numInv_exists($numero)){
                return true;
            }else{
                return false;
            }
        }

        public function consultar_articulo(){
            $data['articulos'] = $this->user_model->getArticulos();
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/consultar_articulo', $data);
            $this->load->view('footer');
        }

        public function consultar_prestamo(){
            $data['prestamos'] = $this->user_model->getPrestamos();
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/consultar_prestamo', $data);
            $this->load->view('footer');
        }

        public function consultar_usuario(){
            $data['usuarios'] = $this->user_model->getAllUsers();
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/consultar_usuario', $data);
            $this->load->view('footer');
        }

        public function detalles_usuario(){
            //EVITA MENSAJE DE RESUBMISSION AL MOMENTO DE IR HACIA ATRAS EN LA PAGINA 
            header("Cache-Control: max-age=300, must-revalidate"); 

            if(isset($_POST['idUsuario'])){
                $usuarioId = $_POST['idUsuario'];
            }else{
                $usuarioId = $this->uri->segment(3);
            }
            $data['prestamos'] = $this->user_model->getPrestamosFromId($usuarioId);
            $data['usuario'] = $this->user_model->getUserInfo($usuarioId);
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/detalles_usuario', $data);
            $this->load->view('footer');
        }

        public function detalles_prestamo(){
            //EVITA MENSAJE DE RESUBMISSION AL MOMENTO DE IR HACIA ATRAS EN LA PAGINA 
            header("Cache-Control: max-age=300, must-revalidate"); 

            if(isset($_POST['detalle'])){
                $prestamoId = $_POST['detalle'];
            }else{
                $prestamoId = $this->uri->segment(3);
            }
      
            $data['prestamo'] = $this->user_model->getPrestamoInfo($prestamoId);
            $data['empleadosDB'] = $this->load->database('eusined', TRUE);
            $data['articulos'] = $this->user_model->getArticulosPrestamo($prestamoId);
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/detalles_prestamo', $data);
            $this->load->view('footer');
        }
        
        public function actualizar_usuario(){
            if(isset($_POST['idUsuario'])){
                $usuarioId = $_POST['idUsuario'];
            }else{
                $usuarioId = $this->uri->segment(3);
            }
            $rol = $_POST['rol'];
            $this->user_model->userRole($usuarioId, $rol);
            $this->session->set_flashdata('cambios_usuario','Se han guardado los cambios de usuario');
            redirect('index.php/admin/detalles_usuario/'.$usuarioId);
        }

        public function password(){
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/password');
            $this->load->view('footer');
        }

        public function verify(){
            $data['user'] = $this->user_model->getUserInfo($this->session->userdata['user_id']);
            if(empty($_POST['actual']) || empty($_POST['nuevo']) || empty($_POST['confirmar'])){
                $this->session->set_flashdata('password_change', 'Necesita llenar los 3 campos correctamente para cambiar contraseña.');
                redirect(base_url().'index.php/admin/password/');
            }
            if($data['user'][0]->{'password'} == md5($_POST['actual'])){
                if($_POST['nuevo'] == $_POST['confirmar']){
                    $password = md5($this->input->post('nuevo'));
                    $this->user_model->setPassword($this->session->userdata['user_id'], $password);
                    $this->session->unset_userdata('user_id');
                    $this->session->unset_userdata('logged_in');
                    $this->session->unset_userdata('rol');
                    $this->session->set_flashdata('password_success', 'Se ha cambiado su contraseña exitosamente. Vuelva a ingresar con los datos nuevos.');
                    redirect(base_url().'index.php/user/login');     
                }else{
                    $this->session->set_flashdata('no_match', 'Su nueva contraseña debe ser igual para los últimos 2 campos.');
                    redirect(base_url().'index.php/admin/password/');
                }
            }else{
                $this->session->set_flashdata('wrong_password', 'Su contraseña actual no es correcta. Vuelva a intentar.');
                redirect(base_url().'index.php/admin/password/');
            }
        }

        public function detalles_articulo(){
            //EVITA MENSAJE DE RESUBMISSION AL MOMENTO DE IR HACIA ATRAS EN LA PAGINA 
            header("Cache-Control: max-age=300, must-revalidate"); 

            if(isset($_POST['detalle'])){
                $articuloId = $_POST['detalle'];
                
            }else{
                $articuloId = $this->uri->segment(3);
            }
            $data['articulo'] = $this->user_model->getArticuloInfo($articuloId);
            $data['encargado'] = $this->user_model->getUserInfo($data['articulo']->encargado_fk);
            $data['empleado'] = $this->user_model->getUserInfo($data['articulo']->empleado_idEmpleado_fk);
            $data['imagen'] = $this->user_model->getImagen($articuloId);
            $data['recibo'] = $this->user_model->getRecibo($articuloId); 
            $data['resguardo'] = $this->user_model->getResguardo($articuloId);
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/detalle_articulo',$data);
            $this->load->view('footer');
        }

        public function editar_articulo(){
            //EVITA MENSAJE DE RESUBMISSION AL MOMENTO DE IR HACIA ATRAS EN LA PAGINA 
            header("Cache-Control: max-age=300, must-revalidate"); 
            
            $this->form_validation->set_rules('actualizar','Actualizar','required');
            if(isset($_POST['detalle'])){
                $articuloId = $_POST['detalle'];
            }else{
                $articuloId = $this->uri->segment(3);
            }
            $data['articulo'] = $this->user_model->getArticuloInfo($articuloId);
            $data['instalaciones'] = $this->user_model->getInstalaciones();
            $data['categorias'] = $this->user_model->getCategorias();
            $data['administradores'] = $this->user_model->getAdministradores();
            $data['imagen'] = $this->user_model->getImagen($articuloId);
            $data['recibo'] = $this->user_model->getRecibo($articuloId); 
            $data['resguardo'] = $this->user_model->getResguardo($articuloId);
            
            if($this->form_validation->run() === FALSE){
                $this->load->view('header');
                $this->load->view('admin/admin');
                $this->load->view('user/editar_articulo', $data);
                $this->load->view('footer');
            }else{
                //Arreglos de los nombres de los recibos
                $filename_recibos = array();
                $filename_fotos = array();
 
                //Preparar configuracion para subir archivos
                //Configuracion para recibo
                $config = array();
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '10000';
                $config['upload_path'] = './uploads/receipt';
                $this->load->library('upload', $config, 'reciboUpload');
                $this->reciboUpload->initialize($config);
                 
                //Configuracion para fotos
                $config = array();
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '10000';
                $config['upload_path'] = './uploads/image';
                $this->load->library('upload', $config, 'fotoUpload');
                $this->fotoUpload->initialize($config);
                 
                //Configuracion para resguardo
                $config=array();
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = '10000';
                $config['upload_path'] = './uploads/resguardo';
                $this->load->library('upload',$config,'resguardoUpload');
                $this->resguardoUpload->initialize($config);

                //Subir Recibos 
                $count = 0;
                $reciboCount = $this->user_model->getReciboCount($articuloId);
                if(!empty($_FILES['recibos']['name'][0])){
                    $count = count($_FILES['recibos']['name']);
                }

                $count = $count + $reciboCount;

                if(isset($_POST['recibosCheck'])){
                    foreach($_POST['recibosCheck'] as $recibo){
                        if(!empty($recibo)){
                            $count = $count - 1;  
                        }
                    }
                }
                
                if($count>0){
                    if($count > 3 ){
                        $this->session->set_flashdata('3warning_recibos','El número de imágenes para el recibo ha sobrepasado el máximo de 3');
                        redirect('index.php/admin/editar_articulo/'.$articuloId);
                    }else{
                        for($i=0;$i<$count;$i++){
                            if(!empty($_FILES['recibos']['name'][$i])){
                                $_FILES['file']['name'] = $_FILES['recibos']['name'][$i];
                                $_FILES['file']['type'] = $_FILES['recibos']['type'][$i];
                                $_FILES['file']['tmp_name'] = $_FILES['recibos']['tmp_name'][$i];
                                $_FILES['file']['error'] = $_FILES['recibos']['error'][$i];
                                $_FILES['file']['size'] = $_FILES['recibos']['size'][$i];
         
                                if($this->reciboUpload->do_upload('file')){
                                    $uploadData = $this->reciboUpload->data();
                                    $filename = $uploadData['file_name'];
                                    $filename_recibos[$i]=$filename;
 
                                }else{
                                    $this->session->set_flashdata('error_recibo','Ha habido un error al subir alguna(s) de las imágenes de recibo.
                                    Verifica que la imágen sea tipo jpg, jpeg o png');
                                    redirect('index.php/admin/editar_articulo/'.$articuloId);
                                }
                            }
                        }
                    }
                }
 
                //Subir Fotos
                $count = 0;
                $imgCount = $this->user_model->getImagenCount($articuloId);
                if(!empty($_FILES['files']['name'][0])){
                    $count = count($_FILES['files']['name']);
                }
                
                $count = $count + $imgCount;

                if(isset($_POST['imgCheck'])){
                    foreach($_POST['imgCheck'] as $img){
                        if(!empty($img)){
                            $count = $count - 1;  
                        }
                    }
                }
                if($count<=0){
                    $this->session->set_flashdata('0warning_img','Debe de haber al menos 1 foto para este artículo.');
                    redirect('index.php/admin/editar_articulo/'.$articuloId);
                }
                if($count>0){
                    if($count > 3 ){
                        $this->session->set_flashdata('3warning_fotos','El número de imágenes para las fotos ha sobrepasado el máximo de 3');
                        redirect('index.php/admin/editar_articulo/'.$articuloId);
                    }else{
                        for($i=0;$i<$count;$i++){
                            if(!empty($_FILES['files']['name'][$i])){
                                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                                $_FILES['file']['size'] = $_FILES['files']['size'][$i];
         
                                if($this->fotoUpload->do_upload('file')){
                                    $uploadData = $this->fotoUpload->data();
                                    $filename = $uploadData['file_name'];
                                    $filename_fotos[$i]=$filename;
                                }else{
                                    $this->session->set_flashdata('error_fotos','Ha habido un error al subir alguna(s) de las imágenes de Foto.
                                    Verifica que la imágen sea tipo jpg, jpeg o png');                                
                                    redirect('index.php/admin/editar_articulo/'.$articuloId);
                                }
                            }
                        }
                    }
                }
 
                //Subir resguardo
                if(!empty($_FILES['userfile']['name'])){
                    if($this->resguardoUpload->do_upload('userfile')){
                        $uploadData = $this->resguardoUpload->data();
                        $filename = $uploadData['file_name'];
                        $filename_resguardo = $filename;
                    }else{
                        $this->session->set_flashdata('error_resguardo','Ha habido un error al subir el archivo o imágen del resguardo.
                                    Verifica que sea tipo jpg, jpeg, png o pdf');                                
                                    redirect('index.php/admin/registrar_articulo');
                    }
                }

                if($this->user_model->actualizarArticulo()){
                    //Guardar los recibos en las base de datos
                    foreach($filename_recibos as $filename){
                        $this->user_model->subirRecibo($filename, $articuloId);
                    }
                    //Guardar las fotos en las base de datos
                    foreach($filename_fotos as $filename){
                        $this->user_model->subirFoto($filename, $articuloId);
                    }
                    //Guardar archivo o imagen de resguardo
                    if($filename_resguardo != null){
                        $this->user_model->subirResguardo($filename_resguardo, $articuloId);
                        // Eliminar el resguardo anterior
                        $resguardo = $this->user_model->getResguardoInfo($articuloId);
                        $this->user_model->deleteResguardo($resguardo[0]['id']);
                    }
                    
                    $imgArray = array();
                    if(isset($_POST['imgCheck'])){
                        foreach($_POST['imgCheck'] as $img){
                            if(!empty($img)){
                                array_push($imgArray, $img);
                            }
                        }
                        $this->user_model->deleteImagen($imgArray);
                    }
                    $reciboArray = array();
                    if(isset($_POST['recibosCheck'])){
                        foreach($_POST['recibosCheck'] as $recibo){
                            if(!empty($recibo)){
                                array_push($reciboArray, $recibo);
                            }
                        }
                        $this->user_model->deleteRecibo($reciboArray);
                    }
                    
                    $this->session->set_flashdata('articulo_actualizado','El artículo se ha actualizado');
                    redirect('index.php/admin/detalles_articulo/'.$articuloId);
                }else{
                    $this->session->set_flashdata('error_actualizar','Ha habido un error al actualizar el artículo, inténtelo de nuevo');                                
                    redirect('index.php/admin/editar_articulo/'.$articuloId);
                }
            }
        }

        public function eliminar_articulo(){
            if(isset($_POST['artID'])){
                $articuloId = $_POST['artID'];
            }else{
                $articuloId = $this->uri->segment(3);
            }
            $data['articulo'] = $this->user_model->getArticuloInfo($articuloId);
            if($data['articulo']->{'idPrestamo'} == null){
                $this->user_model->statusArticulo($articuloId, 0);
                $this->session->set_flashdata('articulo_eliminado','El artículo se ha eliminado');
                redirect('index.php/admin/consultar_articulo');
            }
            $this->session->set_flashdata('articulo_prestado','Este artículo no se puede eliminar porque actualmente está prestado');
            redirect('index.php/admin/detalles_articulo/'.$articuloId);
            /*           
            $data['instalaciones'] = $this->user_model->getInstalaciones();
            $data['categorias'] = $this->user_model->getCategorias();
            $data['administradores'] = $this->user_model->getAdministradores();
            $data['imagen'] = $this->user_model->getImagen($articuloId);
            $data['recibo'] = $this->user_model->getRecibo($articuloId); 
            */
        }

        public function view_img(){
            $img = $this->uri->segment(3);
            $tipo = $this->uri->segment(4);
            $data['tipo'] = $tipo;
            switch($tipo){
                case 0: $data['img'] = $this->user_model->getImagenInfo($img); break;
                case 1: $data['img'] = $this->user_model->getReciboInfo($img); break;
                //case 2: $data['img'] = $this->user_model->getResguardoInfo($img); break;
            }
            $this->load->view('user/fullSizeImg', $data);
        }

        public function registrar_prestamo_temp(){
            $data['articulos'] = $this->user_model->getArticulos();
            $data['administradores'] = $this->user_model->getAdministradores();
            $data['practicantes'] = $this->user_model->getPracticantes();
            $data['empleados'] = $this->user_model->getEmpleados();

            $this->form_validation->set_rules('prestamo','Número de préstamo','required');
            $this->form_validation->set_rules('fecha_inicial','Fecha inicial','required');
            $this->form_validation->set_rules('fecha_final','Fecha final','required');
            $this->form_validation->set_rules('encargado','Encargado','required');
            $this->form_validation->set_rules('prestamista','Prestamista','required');
            $this->form_validation->set_rules('empleado','Empleado','required');
            $this->form_validation->set_rules('articulosSelected[]','Artículos','required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('header',$data);
                $this->load->view('admin/admin');
                $this->load->view('user/registrar_prestamo_temp',$data);
                $this->load->view('footer');
            }else{
                if($this->user_model->registrarPrestamo(1)){
                    $this->user_model->insertPrestamoArticulo();
                    $this->session->set_flashdata('prestamo_registrado','El préstamo ha sido registrado');
                    redirect('index.php/admin/registrar_prestamo_temp');
                }else{
                    $this->session->set_flashdata('prestamo_error','Ha habido un error al registrar el préstamo a la base de datos. Inténtelo de nuevo');
                    redirect('index.php/admin/registrar_prestamo_temp');
                }
            }
        }

        public function registrar_prestamo_perm(){
            $data['articulos'] = $this->user_model->getArticulos();
            $data['administradores'] = $this->user_model->getAdministradores();
            $data['practicantes'] = $this->user_model->getPracticantes();
            $data['empleados'] = $this->user_model->getEmpleados();

            $this->form_validation->set_rules('prestamo','Número de préstamo','required');
            $this->form_validation->set_rules('fecha_inicial','Fecha inicial','required');
            $this->form_validation->set_rules('encargado','Encargado','required');
            $this->form_validation->set_rules('prestamista','Prestamista','required');
            $this->form_validation->set_rules('empleado','Empleado','required');
            $this->form_validation->set_rules('articulosSelected[]','Artículos','required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('header',$data);
                $this->load->view('admin/admin');
                $this->load->view('user/registrar_prestamo_perm',$data);
                $this->load->view('footer');
            }else{
                if($this->user_model->registrarPrestamo(2)){
                    $this->user_model->insertPrestamoArticulo();
                    $this->session->set_flashdata('prestamo_registrado','El préstamo ha sido registrado');
                    redirect('index.php/admin/registrar_prestamo_perm');
                }else{
                    $this->session->set_flashdata('prestamo_error','Ha habido un error al registrar el préstamo a la base de datos. Inténtelo de nuevo');
                    redirect('index.php/admin/registrar_prestamo_perm');
                }
            }
        }

        public function reportes(){
            $data['articulos'] = $this->user_model->getArticulos();
            $data['usuarios'] = $this->user_model->getAllUsers();
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/reportes', $data);
            $this->load->view('footer');
        }

        public function actualizar_prestamo(){
            if(isset($_POST['idPrestamo'])){
                $prestamoId = $_POST['idPrestamo'];
            }else{
                $prestamoId = $this->uri->segment(3);
            }
            $estado = $_POST['estado'];
            $observacion = $_POST['observaciones'];
            $this->user_model->actualizarPrestamo($prestamoId, $estado,$observacion);
            $this->session->set_flashdata('cambios_prestamo','Se han guardado los cambios al préstamo');
            redirect('index.php/admin/detalles_prestamo/'.$prestamoId);
        }

    }