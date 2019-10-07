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
    
            $this->form_validation->set_rules('inventario', 'Número de Inventario','required|callback_check_numInv_exists');
            $this->form_validation->set_rules('serie','Número de Serie','required');
            $this->form_validation->set_rules('marca','Marca','required');
            $this->form_validation->set_rules('modelo','Modelo','required');
            $this->form_validation->set_rules('categoria','Categoría','required');
            $this->form_validation->set_rules('instalacion','Instalación','required');
            $this->form_validation->set_rules('direccion','Dirección','required');

            $data['instalaciones'] = $this->user_model->getInstalaciones();
            $data['categorias'] = $this->user_model->getCategorias();
            
            if($this->form_validation->run() === FALSE){
                $this->load->view('header');
                $this->load->view('admin/admin');
                $this->load->view('user/registrar_articulo',$data);
                $this->load->view('footer');
            }else{
                $this->user_model->registrarArticulo();

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