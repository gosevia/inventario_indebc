<?php
    class Cron_model extends CI_Model{
        
        public function _construct(){
            $this->load->database();
        }

        public function actualizarPrestamo(){
            //FUNCION QUE REVISA LA FECHA DE TODOS LOS PRESTAMOS TEMPORALES Y ACTUALIZA SU ESTATUS EN CASO
            //DE QUE LA FECHA HAYA PASADO
            
            echo 'actualizando prestamos';
            $actualDate = date('Y-m-d');
            echo $actualDate;
            $prestamos = $this->user_model->getPrestamos();

            foreach($prestamos as $prestamo){
                $datePrestamo = $prestamo['fecha_fin'];
                echo " ";
                echo $datePrestamo;
                if($actualDate > $datePrestamo && $datePrestamo != null){
                    $data = array(
                        'status'=>0
                    );
                    $this->db->where("idPrestamo", $prestamo['idPrestamo']);
                    $this->db->update("prestamo", $data);
                }
            }

        }
    }
