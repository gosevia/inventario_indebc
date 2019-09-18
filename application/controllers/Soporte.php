<?php
    class Soporte extends CI_Controller{

        public function menu(){
            $this->load->view('header');
            $this->load->view('soporte/soporte');
            $this->load->view('footer');
        }
    }