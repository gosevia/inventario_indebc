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
        //REGISTRO DE ARTICULOS
        public function registrarArticulo(){

            //Obtener el id de la categoria seleccionada
            $categoria = $this->input->post('categoria');
            
            $this->db->where('nombre', $categoria);
            $result = $this->db->get('categoria');
            $cat_id = $result->row(0)->idCategoria;

            //Obtener el id de la instalacion seleccionada
            $instalacion = $this->input->post('instalacion');
            
            $this->db->where('instalacion', $instalacion);
            $result = $this->db->get('instalacion');
            $instalacion_id = $result->row(0)->idInstalacion;

            //Obtener el id de la Direccion seleccionada
            $direccion = $this->input->post('direccion');

            $this->db->where('instalacion_idInstalacion_fk', $instalacion_id);
            $this->db->where('direccion', $direccion);
            $result = $this->db->get('direccion');
            
            $direccion_id = $result->row(0)->idDireccion;

            //datos a insertar
            $data = array(
                'num_inventario'=> $this->input->post('inventario'),
                'num_serie'=> $this->input->post('serie'),
                'marca'=> $this->input->post('marca'),
                'modelo'=> $this->input->post('modelo'),
                'categoria_idCategoria_fk'=> $cat_id,
                'fecha_compra'=> $this->input->post('fecha_compra'),
                'instalacion_idInstalacion_fk'=> $instalacion_id,
                'direccion_idDireccion_fk'=> $direccion_id,
                'status'=> 1
            );

            return $this->db->insert('articulo',$data);
        }

        public function check_numInv_exists($numero){
            $query = $this->db->get_where('articulo',array('num_inventario'=> $numero));
            if(empty($query->row_array())){
                return true;
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

        public function getInstalaciones(){
            $q = $this->db->select('*')->from('instalacion')->order_by('instalacion','asc')->get();
            $r = $q->result_array();
            return $r;
        }

        public function getCategorias(){
            $q = $this->db->select('*')->from('categoria')->order_by('nombre','asc')->get();
            $r = $q->result_array();
            return $r;
        }
    }