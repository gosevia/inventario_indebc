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

    }