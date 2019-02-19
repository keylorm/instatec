<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_General extends CI_Model {

	private $t_provincia = 'provincia', 
			$t_canton = 'canton', 
			$t_distrito = 'distrito',
			$t_usuario_rol_permiso = 'usuario_rol_permiso',
			$t_moneda = 'moneda',
			$t_usuario = 'usuario',
			$t_usuario_detalle = 'usuario_detalle',
			$rol_id,
			$usuario_id;

	function __construct()
	{
		parent::__construct();
		$loggedin = $this->conectado();			
		if($loggedin){
			if($this->session->has_userdata('rol_id')){
				$this->rol_id = $this->session->userdata('rol_id');
			}
			if($this->session->has_userdata('usuario_id')){
				$this->usuario_id = $this->session->userdata('usuario_id');
			}			
		}
	}
	


	function conectado(){
		if($this->session->has_userdata('loggedin')){
			if($this->session->userdata('loggedin') == TRUE){				
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	function desconectado(){
		if($this->session->has_userdata('loggedin')){
			if($this->session->userdata('loggedin') == TRUE){				
				redirect('/', 'refresh');
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	function validarRol($modulo, $funcion){
		$this->db->where('usuario_rol_id', $this->rol_id);
		$this->db->where('modulo', $modulo);
		$this->db->where('funcion', $funcion);
		$result = $this->db->get($this->t_usuario_rol_permiso);
		if($result->num_rows()>0){
			if($result->row()->estado_permiso == 1){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function getPermisos(){
		if(isset($this->rol_id)){
			$this->db->where('usuario_rol_id', $this->rol_id);
			$this->db->where('estado_permiso', 1);
			$result = $this->db->get($this->t_usuario_rol_permiso);
			$result_count = $result->num_rows();
			$permisos = array();
			if($result_count > 0){
				$result_rows = $result->result();
				foreach ($result_rows as $krow => $vrow) {
					$permisos[$vrow->modulo][$vrow->funcion] = $vrow; 
				}
			}
			return $permisos;
		}else{
			return false;
		}
	}

	function getProvincias(){
		$provincia_result = $this->db->get($this->t_provincia);
		if($provincia_result->num_rows() > 0){
			return $this->security->xss_clean($provincia_result->result_array());
		}else{
			return false;
		}
	}

	function getCantones(){
		$canton_result = $this->db->get($this->t_canton);
		if($canton_result->num_rows() > 0){
			return $this->security->xss_clean($canton_result->result_array());
		}else{
			return false;
		}
	}

	function getDistritos(){
		$distrito_result = $this->db->get($this->t_distrito);
		if($distrito_result->num_rows() > 0){
			return $this->security->xss_clean($distrito_result->result_array());
		}else{
			return false;
		}
	}

	function getMonedas(){
		$moneda_result = $this->db->get($this->t_moneda);
		$moneda_result_num_rows = $moneda_result->num_rows();
		if($moneda_result_num_rows > 0){
			return $this->security->xss_clean($moneda_result->result_array());
		}else{
			return false;
		}
	}


	function consultaCantonesProvincia($data = null){
		//Consulta primero los datos
		if(isset($data['provincia_id'])){			
			$this->db->where('provincia_id', $data['provincia_id']);				
		}

		$result_cantones = $this->db->get($this->t_canton);

		if($result_cantones->num_rows()>0){
			$result = array(
							'total_rows' => $result_cantones->num_rows(),
							'datos' => $this->security->xss_clean($result_cantones->result_array()),
							);

			return $result;
		}else{
			return false;
		}
	}


	function consultaDistritosCantones($data = null){
		//Consulta primero los datos
		if(isset($data['canton_id'])){			
			$this->db->where('canton_id', $data['canton_id']);				
		}

		$result_distrito = $this->db->get($this->t_distrito);

		if($result_distrito->num_rows()>0){
			$result = array(
							'total_rows' => $result_distrito->num_rows(),
							'datos' => $this->security->xss_clean($result_distrito->result_array()),
							);

			return $result;
		}else{
			return false;
		}
	}

	function consultarCorreosAdmins(){
		$this->db->join($this->t_usuario_detalle, $this->t_usuario_detalle.'.usuario_id = '.$this->t_usuario.'.usuario_id');
		$this->db->where_in($this->t_usuario.'.rol_id', array(1,2));
		$this->db->where($this->t_usuario.'.estado_id', 1);
		$this->db->where($this->t_usuario.'.estado_row', 1);
		$usuarios_result = $this->db->get($this->t_usuario);
		$usuarios_result_rows = $this->security->xss_clean($usuarios_result->result_array());
		return $usuarios_result_rows;
	}
}