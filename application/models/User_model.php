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

        public function actualizarArticulo(){
            $data = array();
            if(trim($this->input->post('nombre'), "\x00..\x1F") != null && trim($this->input->post('nombre'), "\x00..\x1F") != ''){
                $data['nombre'] = $this->input->post('nombre');
            }
            if(trim($this->input->post('inventario'), "\x00..\x1F") != null && trim($this->input->post('inventario'), "\x00..\x1F") != ''){
                $data['num_inventario'] = $this->input->post('inventario');
            }
            if(trim($this->input->post('serie'), "\x00..\x1F") != null && trim($this->input->post('serie'), "\x00..\x1F") != ''){
                $data['num_serie'] = $this->input->post('serie');
            }
            if(trim($this->input->post('marca'), "\x00..\x1F") != null && trim($this->input->post('marca'), "\x00..\x1F") != ''){
                $data['marca'] = $this->input->post('marca');
            }
            if(trim($this->input->post('modelo'), "\x00..\x1F") != null && trim($this->input->post('modelo'), "\x00..\x1F") != ''){
                $data['modelo'] = $this->input->post('modelo');
            }
            //Cargar base de datos de empleados
            $empleadosDB = $this->load->database('eusined', TRUE);

            //Obtener el id de la categoria seleccionada
            if(trim($this->input->post('categoria'), "\x00..\x1F") != null && trim($this->input->post('categoria'), "\x00..\x1F") != ''){
                $categoria = $this->input->post('categoria');
                $this->db->where('nombre', $categoria);
                $result = $this->db->get('categoria');
                $cat_id = $result->row(0)->idCategoria;
                $date['categoria_idCategoria_fk'] = $cat_id;
            }
            
            //Obtener el id de la instalacion seleccionada
            if(trim($this->input->post('instalacion'), "\x00..\x1F") != null && trim($this->input->post('instalacion'), "\x00..\x1F") != ''){
                $instalacion = $this->input->post('instalacion');
                $this->db->where('instalacion', $instalacion);
                $result = $this->db->get('instalacion');
                $instalacion_id = $result->row(0)->idInstalacion;
                $data['instalacion_idInstalacion_fk'] = $instalacion_id;
            }            
            
            //Obtener el id de la Direccion seleccionada
            if(isset($data['instalacion_idInstalacion_fk']) && (trim($this->input->post('direccion'), "\x00..\x1F") == null || trim($this->input->post('direccion'), "\x00..\x1F") == '')){
                $art = $this->user_model->getArticuloInfo($this->input->post('detalle'));   //Get articulo
                $this->db->where('idDireccion', $art->direccion_idDireccion_fk);    //Get direccion id from articulo
                $dir = $this->db->get('direccion');
                $dirName = $dir->row(0)->direccion; //Get direccion name
                $this->db->where('instalacion_idInstalacion_fk', $data['instalacion_idInstalacion_fk']);
                $this->db->where('direccion', $dirName);
                $result = $this->db->get('direccion');  //Get new direccion with same name as the old one, but with new instalacion id
                $direccion_id = $result->row(0)->idDireccion;
                $data['direccion_idDireccion_fk'] = $direccion_id;
            }else if(trim($this->input->post('direccion'), "\x00..\x1F") != null && trim($this->input->post('direccion'), "\x00..\x1F") != ''){    
                $direccion = $this->input->post('direccion');
                $inst = $this->user_model->getArticuloInfo($this->input->post('detalle'));
                $this->db->where('instalacion_idInstalacion_fk', $inst->instalacion_idInstalacion_fk);
                $this->db->where('direccion', $direccion);
                $result = $this->db->get('direccion');
                $direccion_id = $result->row(0)->idDireccion;
                $data['direccion_idDireccion_fk'] = $direccion_id;
            }

            //Obtener el id del encargado de la base de datos de empleados
            if(trim($this->input->post('encargado'), "\x00..\x1F") != null && trim($this->input->post('encargado'), "\x00..\x1F") != ''){
                $encargado = $this->input->post('encargado');
                $this->db->where('nombre', $encargado);
                $result = $this->db->get('usuario');
                $rfc = $result->row(0)->correo_rfc;
                $empleadosDB->where('RFC', $rfc);
                $result = $empleadosDB->get('empleado');
                $encargado_id = $result->row(0)->idEmpleado;
                $data['encargado_fk'] = $encargado_id;
            }
            /*
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'num_inventario' => $this->input->post('inventario'),
                'num_serie' => $this->input->post('serie'),
                'marca' => $this->input->post('marca'),
                'modelo' => $this->input->post('modelo'),
                'categoria_idCategoria_fk' => $cat_id,
                'encargado_fk' => $encargado_id,
                'fecha_compra' => $this->input->post('fecha_compra'),
                'direccion_idDireccion_fk' => $direccion_id,
                'instalacion_idInstalacion_fk' => $instalacion_id,
                'status' => 1
            );*/    
            $this->db->where('idArticulo', $this->input->post('detalle'));
            return $this->db->update('articulo', $data);
        }

        //sube el recibo en base la ID del articulo
        public function subirRecibo($recibo,$articulo_id){

            $data = array(
                'articuloId_fk'=>$articulo_id,
                'file_name'=>$recibo,
                'uploaded_on'=>date("Y-m-d H:i:s"),
            );

            return $this->db->insert('recibo',$data);
        }

        //sube la foto en base la ID del articulo
        public function subirFoto($foto, $articulo_id){

            $data = array(
                'articuloId_fk'=>$articulo_id,
                'file_name'=>$foto,
                'uploaded_on'=>date("Y-m-d H:i:s"),
            );

            return $this->db->insert('imagen',$data);
        }

        public function subirResguardo($resguardo, $articulo_id){

            $data = array(
                'articuloId_fk'=>$articulo_id,
                'file_name'=>$resguardo,
                'uploaded_on'=>date("Y-m-d H:i:s"),
            );

            return $this->db->insert('resguardo',$data);
        }

        public function deleteRecibo($recibos){
            foreach($recibos as $recibo){
                $name = $this->user_model->getReciboInfo($recibo);
                //ELIMINAR ARCHIVO DEL SERVIDOR Y LUEGO DE LA BASE DE DATOS
                //EL PATH ABSOLUTO PUEDE SER DIFERENTE AL SUBIR EL PROYECTO O PARA UNA MAQUINA DIFERENTE
                if(unlink($_SERVER['DOCUMENT_ROOT'].'/inventario_indebc/uploads/receipt/'.$name[0]['file_name'])){
                    $this->db->where("id", $recibo);
                    $this->db->delete("recibo");
                }else{
                    die("ERROR DELETING RECIBO");
                }
            }
            return;
        }

        public function deleteImagen($imgs){
            foreach($imgs as $img){
                $name = $this->user_model->getImagenInfo($img);
                //ELIMINAR ARCHIVO DEL SERVIDOR Y LUEGO DE LA BASE DE DATOS
                //EL PATH ABSOLUTO PUEDE SER DIFERENTE AL SUBIR EL PROYECTO O PARA UNA MAQUINA DIFERENTE
                if(unlink($_SERVER['DOCUMENT_ROOT'].'/inventario_indebc/uploads/image/'.$name[0]['file_name'])){
                    $this->db->where("id", $img);
                    $this->db->delete("imagen");
                }else{
                    die("ERROR DELETING IMG");
                }
            }
            return;
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

        public function getImagenInfo($id){
            $q = $this->db->get_where('imagen', array('id' => $id));
            $r = $q->result_array();
            return $r;
        }

        public function getReciboInfo($id){
            $q = $this->db->get_where('recibo', array('id' => $id));
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

        public function getImagenCount($id){
            $q = $this->db->get_where('imagen', array('articuloId_fk' => $id));
            $rows = $q->num_rows();
            return $rows;
        }

        public function getReciboCount($id){
            $q = $this->db->get_where('recibo', array('articuloId_fk' => $id));
            $rows = $q->num_rows();
            return $rows;
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

        public function getPracticantes(){
            $q = $this->db->get_where('usuario', array('rol' => 2, 'status' => 1));
            $r = $q->result_array();
            return $r;
        }

        public function getEmpleados(){
            $q = $this->db->get_where('usuario', array('rol' => 3, 'status' => 1));
            $r = $q->result_array();
            return $r;
        }
    }