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
           
            $this->form_validation->set_rules('rfc','RFC','required');
            $this->form_validation->set_rules('password','Password','required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('header');
                $this->load->view('login');
                $this->load->view('footer');
            }else{
                
                $username = $this->input->post('rfc');
                $password = md5($this->input->post('password'));

                print($username);
                $user_id = $this->user_model->login($username, $password);

                if($user_id){
                    //Crear Sesion
                    /*Linea de prueba
                    die('SUCCESS');*/

                    $this->session->set_flashdata('user_loggedin', 'Has ingresado al sistema');
                    redirect('index.php/admin');
                }else{
                    $this->session->set_flashdata('login_failed', 'Clave o usuario incorrectos');
                    redirect('index.php/user/login');
                }
            }
        }

        public function admin(){
            $this->load->view('header');
            $this->load->view('admin/admin');
            $this->load->view('footer');
        }
    }
