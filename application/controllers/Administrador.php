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
                
                $this->user_model->registrarArticulo();

                //obtener el articulo
                $articulo_id = $this->db->insert_id();

                //Preparar configuracion para subir archivos
                //Configuracion para recibo
                $config=array();
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '10000';
                $config['upload_path'] = './uploads/receipt';
                $this->load->library('upload',$config,'reciboUpload');
                $this->reciboUpload->initialize($config);
                
                //Configuracion para fotos
                $config=array();
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '10000';
                $config['upload_path'] = './uploads/image';
                $this->load->library('upload',$config,'fotoUpload');
                $this->fotoUpload->initialize($config);
                
                //Subir Recibo
                /*
                if($this->reciboUpload->do_upload('userfile')){
                    $data = array('upload_data'=>$this->reciboUpload->data());
                    $filename = $_FILES['userfile']['name'];  
                    $this->user_model->subirRecibo($filename, $articulo_id);
                }
                */

                $count = count($_FILES['recibos']['name']);

                if($count>0){
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
                                
                                $this->user_model->subirRecibo($filename,$articulo_id);
                            }
                        }
                    }
                }



                //Subir Fotos
                $count = count($_FILES['files']['name']);

                if($count>0){
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
                                
                                $this->user_model->subirFoto($filename,$articulo_id);
                            }
                        }
                    }
                }

                $this->session->set_flashdata('articulo_registrado','El artículo ha sido registrado');
                redirect('index.php/admin/consultar_articulo');
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
            $data['imagen'] = $this->user_model->getImagen($_POST['detalle']);
            $data['recibo'] = $this->user_model->getRecibo($_POST['detalle']); 
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('user/detalle_articulo',$data);
            $this->load->view('footer');
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