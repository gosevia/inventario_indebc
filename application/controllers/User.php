<?php
    class User extends CI_Controller{
        public function index(){
            $this->load->view('header');
            $this->load->view('login');
            $this->load->view('footer');
        }
        
        public function register(){
            $data['title'] = 'Registrar';

            $this->form_validation->set_rules('nombre', 'Nombre','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('rfc','RFC','required');
            $this->form_validation->set_rules('puesto','Puesto','required');
            $this->form_validation->set_rules('departamento','Departamento','required');
            $this->form_validation->set_rules('municipio','Municipio','required');
            $this->form_validation->set_rules('instalacion','Instalacion','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('password2','Confirm','matches[password]');

            if($this->form_validation->run() === FALSE){
                $this->load->view('header');
                $this->load->view('register', $data);
                $this->load->view('footer');
            }else{
                die('Continue');
            }
        }

        public function login(){
            
        }

        public function admin(){
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('footer');
        }
    }
