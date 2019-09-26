<?php
    class User extends CI_Controller{
        public function index(){

            if(!$this->session->userdata('logged_in')){
                $this->load->view('header');
                $this->load->view('login');
                $this->load->view('footer');
            }else if($this->session->userdata('rol')==1){
                redirect('index.php/admin');
            }else if($this->session->userdata('rol')==2){
                redirect('index.php/soporte');
            }else{
                redirect('index.php/empleado');
            }
            
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

            if($this->session->userdata('logged_in')){
                if($this->session->userdata('rol')==1){
                    redirect('index.php/admin');
                }else if($this->session->userdata('rol')==2){
                    redirect('index.php/soporte');
                }else{
                    redirect('index.php/empleado');
                }
            }

            $this->form_validation->set_rules('rfc','RFC','required');
            $this->form_validation->set_rules('password','Password','required');

            if($this->form_validation->run() === FALSE){
                $this->load->view('header');
                $this->load->view('login');
                $this->load->view('footer');
            }else{
                $username = $this->input->post('rfc');
                $password = md5($this->input->post('password'));
                //print($username);
                $user_id = $this->user_model->login($username, $password);
                if($user_id){
                    $userInfo = $this->user_model->getUserInfo($user_id);
                    // revisar si la cuenta está activa
                    if($userInfo[0]->status == 1){
                        // guardar info de sesión
                        $user_data = array(
                            'user_id' => $userInfo[0]->idUsuario,
                            'rol' => $userInfo[0]->rol,
                            'logged_in' => true
                        );
                        $this->session->set_userdata($user_data);
                        switch($userInfo[0]->rol){
                            case 1: redirect('index.php/admin'); break;
                            case 2: redirect('index.php/soporte'); break; // cambiar en el futuro
                            case 3: redirect('index.php/empleado'); break; // cambiar en el futuro
                            default: redirect(base_url()); $this->session->set_flashdata('login_failed', 'Clave o usuario incorrectos');
                        }
                        // será necesario el mensaje de loggedin?
                        //$this->session->set_flashdata('user_loggedin', 'Has ingresado al sistema');
                    }else{
                        $this->session->set_flashdata('inactive_account', 'Cuenta inactiva');
                        redirect('index.php/user/login');    
                    }
                }else{
                    $this->session->set_flashdata('login_failed', 'Clave o usuario incorrectos');
                    redirect('index.php/user/login');
                }
            }
        }
        public function logout(){
            if(!$this->session->userdata('logged_in')){
                redirect(base_url().'index.php/user/login');
            }
            // Eliminar datos de usuario
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('rol');
            $this->session->set_flashdata('user_loggedout', 'Se ha cerrado la sessión.');
            redirect(base_url().'index.php/user/login');
        }
    }
