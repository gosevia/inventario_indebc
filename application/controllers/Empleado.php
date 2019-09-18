<?php
    class Empleado extends CI_Controller{
       

        public function menu(){
            $this->load->view('header');
            $this->load->view('empleado/empleado');
            $this->load->view('footer');
        }
    }