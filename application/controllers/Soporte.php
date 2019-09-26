<?php
    class Soporte extends CI_Controller{

        public function menu(){

            if(!$this->session->userdata('logged_in')){
                redirect('index.php/user/login');
            }else if($this->session->userdata('rol')==1){
                redirect('index.php/admin');
            }else if($this->session->userdata('rol')==3){
                redirect('index.php/empleado');
            }else{
                $this->load->view('header');
                $this->load->view('soporte/soporte');
                $this->load->view('footer');
            }
        }
    }