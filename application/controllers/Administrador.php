<?php
    class Administrador extends CI_Controller{

        public function menu(){
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('footer');
        }
    }