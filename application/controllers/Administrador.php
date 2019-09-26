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
                $this->load->view('header');
                $this->load->view('admin/admin,'$data);
                $this->load->view('footer');
            }
        }
    }