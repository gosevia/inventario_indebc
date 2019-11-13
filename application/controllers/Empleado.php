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

        public function prestamos_empleado(){
            $rfc = $this->session->userdata('correo_rfc');
            $data['prestamos'] = $this->user_model->getPrestamosEmpleado($rfc);
            $this->load->view('header');
            $this->load->view('empleado/empleado');
            $this->load->view('empleado/prestamos_empleado', $data);
            $this->load->view('footer');
        }

        public function detalles_prestamo(){
            $prestamoId = $_POST['detalle'];
            $data['prestamo'] = $this->user_model->getPrestamoInfo($prestamoId);
            $data['empleadosDB'] = $this->load->database('eusined', TRUE);
            $data['articulos'] = $this->user_model->getArticulosPrestamo($prestamoId);
            $this->load->view('header');
            $this->load->view('empleado/empleado');
            $this->load->view('user/detalles_prestamo', $data);
            $this->load->view('footer');
        }

        public function password(){
            $this->load->view('header');
            $this->load->view('empleado/empleado');
            $this->load->view('user/password');
            $this->load->view('footer');
        }

        public function verify(){
            $data['user'] = $this->user_model->getUserInfo($this->session->userdata['user_id']);
            if(empty($_POST['actual']) || empty($_POST['nuevo']) || empty($_POST['confirmar'])){
                $this->session->set_flashdata('password_change', 'Necesita llenar los 3 campos correctamente para cambiar contraseña.');
                redirect(base_url().'index.php/empleado/password/');
            }
            if($data['user'][0]->{'password'} == md5($_POST['actual'])){
                if($_POST['nuevo'] == $_POST['confirmar']){
                    $password = md5($this->input->post('nuevo'));
                    $this->user_model->setPassword($this->session->userdata['user_id'], $password);
                    $this->session->unset_userdata('user_id');
                    $this->session->unset_userdata('logged_in');
                    $this->session->unset_userdata('rol');
                    $this->session->set_flashdata('password_success', 'Se ha cambiado su contraseña exitosamente. Vuelva a ingresar con los datos nuevos.');
                    redirect(base_url().'index.php/user/login');     
                }else{
                    $this->session->set_flashdata('no_match', 'Su nueva contraseña debe ser igual para los últimos 2 campos.');
                    redirect(base_url().'index.php/empleado/password/');
                }
            }else{
                $this->session->set_flashdata('wrong_password', 'Su contraseña actual no es correcta. Vuelva a intentar.');
                redirect(base_url().'index.php/empleado/password/');
            }
        }

    }