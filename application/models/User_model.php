<?php
    class User_model extends CI_Model{
        
        public function _construct(){
            $this->load->database();
        }

        public function login($username, $password){
   
            $this->db->where('correo_rfc', $username);
            $this->db->where('password', $password);

            $result = $this->db->get('usuario');
            
            if($result->num_rows() == 1){
                return $result->row(0)->idUsuario;
            }else{
                return false;
            }
        }
        public function getUserInfo($id){
            $q = $this->db->get_where('usuario', array('idUsuario' => $id));
            if($q->num_rows()==1){
                return $q->result();
            }else{
                return false;
            }
        }
        public function getArticulos(){
            $q = $this->db->select('*')->from('articulo')->order_by('num_inventario', 'asc')->get();
            $r = $q->result_array();
            return $r;
        }
    }