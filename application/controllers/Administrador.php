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
    
           // $this->form_validation->set_rules('inventario', 'Número de Inventario','callback_check_numInv_exists');
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
            $this->load->view('user/consultar_articulo',$data);
            $this->load->view('footer');
        }

        public function detalles_articulo(){
            $data['articulo'] = $this->user_model->getArticuloInfo($_POST['detalle']);
            $data['encargado'] = $this->user_model->getUserInfo($data['articulo']->encargado_fk);
            $data['empleado'] = $this->user_model->getUserInfo($data['articulo']->empleado_idEmpleado_fk);
            $data['imagen'] = $this->user_model->getImagen($_POST['detalle']);
            $data['recibo'] = $this->user_model->getRecibo($_POST['detalle']); 
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/detalle_articulo',$data);
            $this->load->view('footer');
        }

        public function view_img(){
            $img = $this->uri->segment(3);
            $tipo = $this->uri->segment(4);
            $data['tipo'] = $tipo;
            if($tipo == '0'){
                $data['img'] = $this->user_model->getImagenInfo($img);
            }else{
                $data['img'] = $this->user_model->getReciboInfo($img);
            }
            $this->load->view('user/fullSizeImg', $data);
        }

        public function registrar_prestamo(){
    
            if($this->form_validation->run() === FALSE){
                $this->load->view('header');
                $this->load->view('admin/admin');
                $this->load->view('user/registrar_prestamo');
                $this->load->view('footer');
            }else{
                
            }
        }
    }