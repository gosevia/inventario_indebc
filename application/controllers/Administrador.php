<?php
    class Administrador extends CI_Controller{

        public function menu(){
            $data['articulos'] = $this->user_model->getArticulos();
            $this->load->view('header');
            $this->load->view('admin/admin', $data);
            $this->load->view('footer');
        }
    }