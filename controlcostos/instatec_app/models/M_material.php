<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Material extends CI_Model {

	private $t_material = 'material',
			$t_material_unidad = 'material_unidad',
			$t_usuario = 'usuario',
			$usuario_id,
			$ip,
			$agente_usuario;
	
	function __construct()
	{
		parent::__construct();
		$this->ip = $this->input->ip_address();
		$this->agente_usuario =$this->input->user_agent();
		if($this->session->has_userdata('usuario_id')){
			$this->usuario_id = $this->session->userdata('usuario_id');
		}

		$this->load->model('m_bitacora');
    }


    function consultarMateriales($data = null){
    	if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($value!=='' && $value!=='undefined' && $value!==null  &&  $value!=='all'){
					if($key=='material' || $key=='material_codigo'){
						$this->db->like($this->t_material.'.'.$key, $value);
					}else{
						$this->db->where($this->t_material.'.'.$key, $value);
					}
				}
			}
		}
		$this->db->where($this->t_material.'.estado_registro', 1);
		/*$offset = 0;
		$cantidad_mostrar = 2;
		if(isset($data['cantidad_mostrar'])){
			$cantidad_mostrar = (int)$data['cantidad_mostrar'];
		}
		if(isset($data['pagina'])){
			$pagina = (int)$data['pagina'];
			if($pagina>1){
				$offset=$pagina*$cantidad_mostrar;
			}
		}

		$this->db->limit($cantidad_mostrar, $offset);*/
		$result_materiales = $this->db->get($this->t_material);

		//vuelve a hacer la consulta para obtener el total de rows 
		/*if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($value!=='' && $value!=='undefined' && $value!==null  &&  $value!=='all'){
					if($key=='material' || $key=='material_codigo'){
						$this->db->like($this->t_material.'.'.$key, $value);
					}else{
						$this->db->where($this->t_material.'.'.$key, $value);
					}
				}
			}
		}
		$this->db->where($this->t_material.'.estado_registro', 1);
		$total_rows = $this->db->count_all_results($this->t_material, FALSE);*/

		if($result_materiales->num_rows()>0){
			$result = array(
							'total_rows' => $result_materiales->num_rows(),
							'datos' => $result_materiales->result(),
							);

			return $result;

		}else{
			return false;
		}
	}


	function consultarMaterial($material_id){
		if($material_id!=null){
			
			$this->db->where($this->t_material.'.material_id', $material_id);
			$result_material = $this->db->get($this->t_material);
			if($result_material->num_rows()> 0){
				$result = $result_material->row();
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


    function insertar($data){
		foreach ($data as $kfield => $vfield) {
			$this->db->set($kfield, $vfield);
		}
		$this->db->set('estado_registro', 1);
		$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
		$this->db->set('usuario_id', $this->usuario_id);
		
		$this->db->insert($this->t_material);

		return array(
			'tipo' => 'success',
			'texto' => 'Material registrado con éxito',
			'material_id' => $this->db->insert_id(),
		);
	} 

	function actualizar($material_id, $data){
		
		foreach ($data as $kfield => $vfield) {
			$this->db->set($kfield, $vfield);
		}
		$this->db->where('material_id', $material_id);
		$this->db->update($this->t_material);

		$this->m_bitacora->registrarEdicionBicatora('material', $material_id);
	}


    function validarExistenciaMaterial($data, $material_id = null){
		$response = array();
		//se valida que los campos requeridos vengan
		if(isset($data['material']) && isset($data['material_codigo'])){
			if($data['material'] != '' && $data['material_codigo'] != ''){
				//primero validamos el material
				$this->db->where('material', $data['material']);
				$this->db->where('estado_registro', 1);
				// validamos que no sea la cedula del mismo colaborador que se esta consultando para cuando se esta editando un colaborador
				if($material_id!=null){
					$this->db->where('material_id !=', $material_id);
				}
				$result_material = $this->db->get($this->t_material);
				$result_material_num_rows = $result_material->num_rows();
				if ($result_material_num_rows > 0) {
					//si hay resultados es porque ya existe la cedula
					$result_material_info = $result_material->row();
					$response['tipo'] = 'danger';
					$response['texto'] = 'Ya existe un material con ese nombre.';
				}else{
					//primero validamos el material
					$this->db->where('material_codigo', $data['material_codigo']);
					$this->db->where('estado_registro', 1);
					// validamos que no sea la cedula del mismo colaborador que se esta consultando para cuando se esta editando un colaborador
					if($material_id!=null){
						$this->db->where('material_id !=', $material_id);
					}
					$result_material_codigo = $this->db->get($this->t_material);
					$result_material_codigo_num_rows = $result_material_codigo->num_rows();
					if ($result_material_codigo_num_rows > 0) {
						//si hay resultados es porque ya existe la cedula
						$result_material_codigo_info = $result_material_codigo->row();
						$response['tipo'] = 'danger';
						$response['texto'] = 'Ya existe un material con ese código.';
					}else{
						// si llego aqui es porque paso todas las validaciones
						$response['tipo'] = 'success';
					}
				}
			}else{
				$response['tipo'] = 'warning';
				$response['texto'] = 'No se introdujo el material o el código del material';
			}
		}
		return $response;
	}


	/* Para eliminar materiales */
	function eliminar($material_id){
		// Desactiva el usuario. No lo borra para guardar un historial.
		$this->db->where($this->t_proyecto_material.'.material_id', $material_id);
		$result_material_proyecto = $this->db->get($this->t_proyecto_material);
		$result_material_proyecto_count = $result_material_proyecto->num_rows();
		if($result_material_proyecto_count > 0){
			$this->db->set($this->t_material.'.estado_registro', 0);
			$this->db->where($this->t_material.'.material_id', $material_id);
			$this->db->update($this->t_material);
		}else{
			$this->db->where($this->t_material.'.material_id', $material_id);
			$this->db->delete($this->t_material);

		}
		
		return true;
	}


	/* Consultar Materiales Activos */
	function getAllActiveMateriales() {
		$this->db->where('estado_registro', 1);
		$result_materiales = $this->db->get($this->t_material);
		$result_materiales_count = $result_materiales->num_rows();
		if ($result_materiales_count > 0) {
			return $result_materiales->result();
		}else{
			return false;
		}

	}


    function consultaAllMaterialUnidades(){
		$result_unidades = $this->db->get($this->t_material_unidad);
		if($result_unidades->num_rows()>0){
			$result =  $result_unidades->result();
			return $result;

		}else{
			return false;
		}
	}

	function consultaAllActiveMaterialUnidades() {
		$this->db->where('estado_registro',1);
		$result_unidades = $this->db->get($this->t_material_unidad);
		if($result_unidades->num_rows()>0){
			$result =  $result_unidades->result();
			return $result;

		}else{
			return false;
		}
	}

	function consultarMaterialUnidades($data = null){
		if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($value!=='' && $value!=='undefined' && $value!==null  &&  $value!=='all'){
					if($key=='material_unidad'){
						$this->db->like($this->t_material_unidad.'.'.$key, $value);
					}else{
						$this->db->where($this->t_material_unidad.'.'.$key, $value);
					}
				}
			}
		}
		$this->db->where($this->t_material_unidad.'.estado_registro', 1);
		/*$offset = 0;
		$cantidad_mostrar = 2;
		if(isset($data['cantidad_mostrar'])){
			$cantidad_mostrar = (int)$data['cantidad_mostrar'];
		}
		if(isset($data['pagina'])){
			$pagina = (int)$data['pagina'];
			if($pagina>1){
				$offset=$pagina*$cantidad_mostrar;
			}
		}

		$this->db->limit($cantidad_mostrar, $offset);*/
		$result_material_unidades = $this->db->get($this->t_material_unidad);

		//vuelve a hacer la consulta para obtener el total de rows 
		/*if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($value!=='' && $value!=='undefined' && $value!==null  &&  $value!=='all'){
					if($key=='material_unidad'){
						$this->db->like($this->t_material_unidad.'.'.$key, $value);
					}else{
						$this->db->where($this->t_material_unidad.'.'.$key, $value);
					}
				}
			}
		}
		$this->db->where($this->t_material_unidad.'.estado_registro', 1);
		$total_rows = $this->db->count_all_results($this->t_material_unidad, FALSE);*/

		if($result_material_unidades->num_rows()>0){
			$result = array(
							'total_rows' => $result_material_unidades->num_rows(),
							'datos' => $result_material_unidades->result(),
							);

			return $result;

		}else{
			return false;
		}
	}


	function insertarMaterialUnidad($data){
		$this->db->where('material_unidad', $data['material_unidad']);
		$result_material_unidad = $this->db->get($this->t_material_unidad);
		$result_material_unidad_count = $result_material_unidad->num_rows();
		if($result_material_unidad_count > 0){
			$result_material_unidad_row = $result_material_unidad->row();
			if($result_material_unidad_row->estado_registro == 1){
				return array('tipo' => 'danger',
							'texto' => 'No se pudo guardar la unidad. Ya existe una con este nombre en la Base de Datos',
							);
			}else{
				$this->db->set('estado_registro', 1);
				$this->db->where('material_unidad', $data['material_unidad']);
				$this->db->update($this->t_material_unidad);
				return array('tipo' => 'success',
							'texto' => 'Unidad registrada con éxito',
							);
			}
		}else{
			foreach ($data as $kfield => $vfield) {
				$this->db->set($kfield, $vfield);
			}
			$this->db->set('estado_registro', 1);
			$this->db->set('usuario_id', $this->usuario_id);
			$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
			
			$this->db->insert($this->t_material_unidad);

			return array('tipo' => 'success',
								'texto' => 'Unidad registrada con éxito',
								);
		}
		
	}

	function editarMaterialUnidad($material_unidad_id, $data){
		
		$this->db->where('material_unidad', $data['material_unidad']);
		$this->db->where('material_unidad_id != '.$material_unidad_id);
		$result_consulta_material_unidad = $this->db->get($this->t_material_unidad);
		$result_consulta_material_unidad_count = $result_consulta_material_unidad->num_rows();
		if($result_consulta_material_unidad_count > 0){
			$result_consulta_material_unidad_row = $result_consulta_material_unidad->row();
			if($result_consulta_material_unidad_row->estado_registro == 1){
				return array('tipo' => 'danger',
							'texto' => 'No se pudo guardar la unidad. Ya existe una con este nombre en la Base de Datos',
							);
			}else{
				return array('tipo' => 'danger',
							'texto' => 'No se pudo guardar la unidad. Previamente existió una unidad con ese nombre que fue desactivada pero no eliminada porque contenia materiales relacionados. Para volver a utilizar esta unidad, intente crearla nuevamente. Esto la reactivará y le permitirá registrar nuevos materiales.',
							);
			}
		}else{
			$this->db->set('material_unidad', $data['material_unidad']);
			$this->db->where('material_unidad_id', $material_unidad_id);
			$this->db->update($this->t_material_unidad);

			return array('tipo' => 'success',
								'texto' => 'Unidad actualizada con éxito',
								);
			$this->m_bitacora->registrarEdicionBicatora('material_unidad', $material_unidad_id);
		}	
	}


	function consultaMaterialUnidad($material_unidad_id){
		if($material_unidad_id!=null){
			
			$this->db->where($this->t_material_unidad.'.material_unidad_id', $material_unidad_id);
			$result_unidad = $this->db->get($this->t_material_unidad);
			if($result_unidad->num_rows()> 0){
				$result = $result_unidad->row();
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	function eliminarMaterialUnidad($material_unidad_id){
		// Desactiva el usuario. No lo borra para guardar un historial.
		$this->db->where($this->t_proyecto_material.'.material_unidad_id', $material_unidad_id);
		$result_material_proyecto = $this->db->get($this->t_proyecto_material);
		$result_material_proyecto_count = $result_material_proyecto->num_rows();
		if($result_material_proyecto_count > 0){
			$this->db->set($this->t_material_unidad.'.estado_registro', 0);
			$this->db->where($this->t_material_unidad.'.material_unidad_id', $material_unidad_id);
			$this->db->update($this->t_material_unidad);
		}else{
			$this->db->where($this->t_material_unidad.'.material_unidad_id', $material_unidad_id);
			$this->db->delete($this->t_material_unidad);

		}
		
		return true;
	}

}