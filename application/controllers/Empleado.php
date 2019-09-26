<?php
    class Empleado extends CI_Controller{

        public function menu(){

            //Revisar inicio de sesion
            if(!$this->session->userdata('logged_in')){
                redirect('index.php/user/login');
            }else if($this->session->userdata('rol')==1){
                redirect('index.php/admin');
            }else if($this->session->userdata('rol')==2){
                redirect('index.php/soporte');
            }else{
                //cargar perfil de empleado
                $this->load->view('header');
                $this->load->view('empleado/empleado');
                $this->load->view('footer');
            }
        }
    }