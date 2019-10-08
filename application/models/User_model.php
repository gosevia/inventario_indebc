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

            //Cargar base de datos de empleados
            $empleadosDB = $this->load->database('eusined', TRUE);

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

            //Obtener el id del encargado de la base de datos de empleados
            $encargado = $this->input->post('encargado');
            $this->db->where('nombre', $encargado);
            $result = $this->db->get('usuario');
            
            $rfc = $result->row(0)->correo_rfc;
            $empleadosDB->where('RFC',$rfc);
            $result = $empleadosDB->get('empleado');

            $encargado_id = $result->row(0)->idEmpleado;

            //datos a insertar
            $data = array(
                'nombre'=>$this->input->post('nombre'),
                'num_inventario'=> $this->input->post('inventario'),
                'num_serie'=> $this->input->post('serie'),
                'marca'=> $this->input->post('marca'),
                'modelo'=> $this->input->post('modelo'),
                'categoria_idCategoria_fk'=> $cat_id,
                'encargado_fk'=> $encargado_id,
                'fecha_compra'=> $this->input->post('fecha_compra'),
                'direccion_idDireccion_fk'=> $direccion_id,
                'instalacion_idInstalacion_fk'=> $instalacion_id,
                'status'=> 1
            );

            return $this->db->insert('articulo',$data);
        }

        //sube el recibo en base la ID del articulo
        public function subirRecibo($recibo,$articulo_id){
            
            //Ubicar el articulo
            $this->db->where('idArticulo', $articulo_id);
            $result = $this->db->get('articulo');
            $idArt = $result->row(0)->idArticulo;

            $data = array(
                'articuloId_fk'=>$idArt,
                'file_name'=>$recibo,
                'uploaded_on'=>date("Y-m-d H:i:s"),
            );

            return $this->db->insert('recibo',$data);
        }

        //sube la foto en base la ID del articulo
        public function subirFoto($foto, $articulo_id){
            //Ubicar el articulo
            $this->db->where('idArticulo', $articulo_id);
            $result = $this->db->get('articulo');
            $idArt = $result->row(0)->idArticulo;

            $data = array(
                'articuloId_fk'=>$idArt,
                'file_name'=>$foto,
                'uploaded_on'=>date("Y-m-d H:i:s"),
            );

            return $this->db->insert('imagen',$data);
        }

        public function check_numInv_exists($numero){
            $query = $this->db->get_where('articulo', array('num_inventario'=> $numero));
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

        public function getImagen($id){
            $q = $this->db->get_where('imagen', array('articuloId_fk' => $id));
            $r = $q->result_array();
            return $r;
        }

        public function getRecibo($id){
            $q = $this->db->get_where('recibo', array('articuloId_fk' => $id));
            $r = $q->result_array();
            return $r;
        }

        public function getArticuloInfo($id){
            $q = $this->db->get_where('articulo', array('idArticulo' => $id));
            if($q->num_rows()==1){
                return $q->result()[0]; 
            }else{
                return false;
            }
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

        public function getAdministradores(){
            $q = $this->db->get_where('usuario', array('rol' => 1));
            $r = $q->result_array();
            return $r;
        }
    }