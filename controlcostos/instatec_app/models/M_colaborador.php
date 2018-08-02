<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Colaborador extends CI_Model {

	private $t_colaborador = 'colaborador',
			$t_colaborador_costo_hora = 'colaborador_costo_hora',
			$t_colaborador_puesto = 'colaborador_puesto',
			$t_usuario_colaborador = 'usuario_colaborador',
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


    public function insertarJefeFromUser($data){
        $this->db->set('colaborador_puesto_id', 1);
        $this->db->set('nombre', $data['nombre']);
		$this->db->set('apellidos', $data['apellidos']);
		$this->db->set('estado', 1);
		$this->db->set('estado_row', 1);
		$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
        $this->db->set('correo_electronico', $data['correo_electronico']);
        $this->db->insert($this->t_colaborador);
        $colaborador_id = $this->db->insert_id();
        return $colaborador_id;
	}
	
	public function actualizarJefeFromUser($colaborador_id, $data){
        $this->db->set('nombre', $data['nombre']);
		$this->db->set('apellidos', $data['apellidos']);
		$this->db->set('estado', 1);
		$this->db->set('estado_row', 1);
		$this->db->set('correo_electronico', $data['correo_electronico']);
		$this->db->where('colaborador_id', $colaborador_id);
        $this->db->update($this->t_colaborador);
        return true;
	}

	public function desactivarJefeFromUser($colaborador_id){        
		$this->db->set('estado_row', 0);
		$this->db->where('colaborador_id', $colaborador_id);
        $this->db->update($this->t_colaborador);
        return true;
	}
	
	function consultaAll($data = null){
		//Consulta primero los datos
		if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($value!=='' && $value!=='undefined' && $value!==null  &&  $value!=='all'){
					if($key=='nombre' || $key=='apellidos'  || $key=='alias' || $key=='correo_electronico'  || $key=='cedula'  || $key=='seguro_social'  || $key=='identificador_interno' ){
						$this->db->like($this->t_colaborador.'.'.$key, $value);
					}else{
						$this->db->where($this->t_colaborador.'.'.$key, $value);
					}
				}
			}
		}
		$this->db->where($this->t_colaborador.'.estado_row', 1);
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
		$this->db->join($this->t_colaborador_puesto, $this->t_colaborador_puesto.'.colaborador_puesto_id = '.$this->t_colaborador.'.colaborador_puesto_id');
		$result_colaborador = $this->db->get($this->t_colaborador);

		//vuelve a hacer la consulta para obtener el total de rows 
		/*if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($key=='nombre' || $key=='apellidos'  || $key=='correo_electronico'  || $key=='cedula'  || $key=='seguro_social'  || $key=='identificador_interno' ){
					$this->db->like($this->t_colaborador.'.'.$key, $value);
				}else{
					$this->db->where($this->t_colaborador.'.'.$key, $value);
				}
			}
		}
		$this->db->where($this->t_colaborador.'.estado_row', 1);
		$this->db->join($this->t_colaborador_puesto, $this->t_colaborador_puesto.'.colaborador_puesto_id = '.$this->t_colaborador.'.colaborador_puesto_id');
		$total_rows = $this->db->count_all_results($this->t_colaborador, FALSE);*/

		if($result_colaborador->num_rows()>0){
			$result = array(
							'total_rows' => $result_colaborador->num_rows(),
							'datos' => $result_colaborador->result(),
							);

			return $result;

		}else{
			return false;
		}
		

	}

	function getAllActiveColaboradores(){
		$this->db->where('estado', 1);
		$this->db->where('estado_row', 1);
		$colaborador_result = $this->db->get($this->t_colaborador);
		if($colaborador_result->num_rows() > 0){
			return $colaborador_result->result();
		}else{
			return false;
		}
	}

	function getAllActiveSoloColaboradores(){
		$this->db->join($this->t_colaborador_puesto, $this->t_colaborador_puesto.'.colaborador_puesto_id = '.$this->t_colaborador.'.colaborador_puesto_id');
		$this->db->where($this->t_colaborador.'.estado', 1);
		$this->db->where($this->t_colaborador.'.estado_row', 1);
		$this->db->where($this->t_colaborador.'.colaborador_puesto_id != 1');
		$colaborador_result = $this->db->get($this->t_colaborador);
		if($colaborador_result->num_rows() > 0){
			return $colaborador_result->result();
		}else{
			return false;
		}
	}
	


	function insertar($data){
		$colaborador_data = $data;
		unset($data['costo_hora']);
		unset($data['moneda_id']);
		unset($data['usuario']);
		unset($data['password']);
		unset($data['repetir_contrasena']);
		foreach ($data as $kfield => $vfield) {
			$this->db->set($kfield, $vfield);
		}
		$this->db->set('estado_row', 1);
		$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
		
		$this->db->insert($this->t_colaborador);
		$colaborador_id = $this->db->insert_id();

		$this->db->set('costo_hora', str_replace(' ', '',$colaborador_data['costo_hora']));
		$this->db->set('moneda_id', $colaborador_data['moneda_id']);
		$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
		$this->db->set('estado_costo', 1);
		$this->db->set('colaborador_id', $colaborador_id);				
		$this->db->insert($this->t_colaborador_costo_hora);
		
		if($data['colaborador_puesto_id'] == 1){
			$this->load->model('m_usuario');
			$respuesta_insertar_jefe = $this->m_usuario->insertarJefeFromColaborador($colaborador_data);

			if(isset($respuesta_insertar_jefe['inserted_id'])){
				$usuario_id = $respuesta_insertar_jefe['inserted_id'];
				$this->db->set('usuario_id', $usuario_id);
				$this->db->set('colaborador_id', $colaborador_id);
				$this->db->insert($this->t_usuario_colaborador);
			}else{
				return $respuesta_insertar_jefe;
			}

		}

		return array('tipo' => 'success',
							'texto' => 'Colaborador registrado con éxito',
							);
		
	}

	function consultar($colaborador_id){
		if($colaborador_id!=null){
			//consulta el colaborador para obtener el rol
			$this->db->where('colaborador_id', $colaborador_id);
			$this->db->where('estado_row', 1);
			$result_colaborador_actual = $this->db->get($this->t_colaborador);
			$result_colaborador_actual_row = $result_colaborador_actual->row();


			$result = array();
			$this->db->join($this->t_colaborador_costo_hora, $this->t_colaborador_costo_hora.'.colaborador_id = '.$this->t_colaborador.'.colaborador_id AND '.$this->t_colaborador_costo_hora.'.estado_costo = 1', 'LEFT');
			if($result_colaborador_actual_row->colaborador_puesto_id == 1){
				//hace este join si es un jefe de proyecto para traerse el usuario
				$this->db->join($this->t_usuario_colaborador, $this->t_usuario_colaborador.'.colaborador_id = '.$this->t_colaborador.'.colaborador_id');
				$this->db->join($this->t_usuario, $this->t_usuario.'.usuario_id = '.$this->t_usuario_colaborador.'.usuario_id');
			}
			$this->db->where($this->t_colaborador.'.colaborador_id', $colaborador_id);
			$result_colaborador = $this->db->get($this->t_colaborador);
			if($result_colaborador->num_rows()> 0){
				$result = $result_colaborador->row();
							
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function actualizar($colaborador_id, $data){
		//actualiza los campos
		$colaborador_costo = $data;
		unset($data['costo_hora']);
		unset($data['moneda_id']);
		unset($data['usuario']);
		unset($data['password']);
		unset($data['repetir_contrasena']);
		foreach ($data as $kfield => $vfield) {
			$this->db->set($kfield, $vfield);
		}
		$this->db->where('colaborador_id', $colaborador_id);
		$this->db->update($this->t_colaborador);


		// Comprueab si el costo de la hora o la moneda cambio para ver si es necesario volverlo a registrar en la tabla
		$this->db->where('colaborador_id', $colaborador_id);
		$this->db->where('estado_costo', 1);
		$result_costo_actual = $this->db->get($this->t_colaborador_costo_hora);
		$result_costo_actual_count = $result_costo_actual->num_rows();
		if($result_costo_actual_count > 0){
			$result_costo_actual_row = $result_costo_actual->row();
			if($result_costo_actual_row->moneda_id!=$colaborador_costo['moneda_id'] || $result_costo_actual_row->costo_hora!=$colaborador_costo['costo_hora']){
				/* Si entra aqui es porque la moneda o el costo hora cambio. entonces 
				primero se cambia el estado del costo actual a 0 para no borrar ese dato en caso de que se ocupe saber luego */
				$this->db->set('estado_costo', 0);
				$this->db->where('colaborador_id', $colaborador_id);
				$this->db->where('estado_costo', 1);
				$this->db->update($this->t_colaborador_costo_hora);
				
				// Inserat el nuevo registro
				$this->db->set('costo_hora', str_replace(' ', '', $colaborador_costo['costo_hora']));
				$this->db->set('moneda_id', $colaborador_costo['moneda_id']);
				$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
				$this->db->set('estado_costo', 1);
				$this->db->set('colaborador_id', $colaborador_id);				
				$this->db->insert($this->t_colaborador_costo_hora);	
			}
		}else{
			//Inserta el nuevo registro
			$this->db->set('costo_hora', str_replace(' ', '',  $colaborador_costo['costo_hora']));
			$this->db->set('moneda_id', $colaborador_costo['moneda_id']);
			$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
			$this->db->set('estado_costo', 1);
			$this->db->set('colaborador_id', $colaborador_id);				
			$this->db->insert($this->t_colaborador_costo_hora);	
		}

		$this->m_bitacora->registrarEdicionBicatora('colaborador', $colaborador_id);
	}


	function eliminarColaborador($colaborador_id){
		if( $colaborador_id!=null ){
			// Desactiva el usuario. No lo borra para guardar un historial.
			$this->db->where('colaborador_id', $colaborador_id);
			$result_colaborador = $this->db->get($this->t_colaborador);
			$result_colaborador_count = $result_colaborador->num_rows();
			if($result_colaborador_count>0){
				$result_colaborador_row = $result_colaborador->row();
				$this->db->set($this->t_colaborador.'.estado_row', 0);
				$this->db->where($this->t_colaborador.'.colaborador_id', $colaborador_id);
				$this->db->update($this->t_colaborador);

				if($result_colaborador_row->colaborador_puesto_id==1){
					$this->load->model('m_usuario');
					$this->db->where('colaborador_id', $colaborador_id);
					$result_usuario_colaborado = $this->db->get($this->t_usuario_colaborador);

					if($result_usuario_colaborado->num_rows()>0){
						$result_usuario_colaborado_result = $result_usuario_colaborado->row();
						$usuario_id = $result_usuario_colaborado_result->usuario_id;
						$this->m_usuario->desactivarJefeFromColaborador($usuario_id);
					}
				}
	
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	function consultaAllPuestos(){
		$result_puestos = $this->db->get($this->t_colaborador_puesto);
		if($result_puestos->num_rows()>0){
			$result =  $result_puestos->result();
			return $result;

		}else{
			return false;
		}
	}

	function getAllActiveJefesProyectos(){
		$this->db->where('colaborador_puesto_id', 1);
		$this->db->where('estado', 1);
		$this->db->where('estado_row', 1);
		$result_jefes = $this->db->get($this->t_colaborador);
		$result_jefes_rows = $result_jefes->result();
		$result_jefes_count = $result_jefes->num_rows();
		if($result_jefes_count > 0){
			return $result_jefes_rows;
		}else{
			return false;
		}
	}


	function validarExistenciaUsuario($data, $colaborador_id = null){
		$response = array();
		//se valida que los campos requeridos vengan
		if(isset($data['cedula']) && isset($data['seguro_social']) && isset($data['identificador_interno'])){
			if($data['cedula']!='' && $data['seguro_social'] != '' && $data['identificador_interno']!=''){
				//primero validamos la cedula
				$this->db->where('cedula', $data['cedula']);
				// validamos que no sea la cedula del mismo colaborador que se esta consultando para cuando se esta editando un colaborador
				if($colaborador_id!=null){
					$this->db->where('colaborador_id !=', $colaborador_id);
				}
				$result_consulta = $this->db->get($this->t_colaborador);
				$result_consulta_num_rows = $result_consulta->num_rows();
				if ($result_consulta_num_rows > 0) {
					//si hay resultados es porque ya existe la cedula
					$result_consulta_info = $result_consulta->row();
					$response['tipo'] = 'danger';
					$response['texto'] = 'La cédula ingresada ya se encuetra registrada en el sistema para el usuario: '.$result_consulta_info->nombre.' '.$result_consulta_info->apellidos;
				}else{
					// si no hay resultados entonces consultamos por seguro social
					$this->db->where('seguro_social', $data['seguro_social']);
					if($colaborador_id!=null){
						$this->db->where('colaborador_id !=', $colaborador_id);
					}
					$result_consulta2 = $this->db->get($this->t_colaborador);
					$result_consulta2_num_rows = $result_consulta2->num_rows();
					if ($result_consulta2_num_rows > 0) {
						// si hay resultados es porque ya existe el seguro social
						$result_consulta2_info = $result_consulta2->row();
						$response['tipo'] = 'danger';
						$response['texto'] = 'El número de seguro social ingresado ya se encuetra registrado en el sistema para el usuario: '.$result_consulta2_info->nombre.' '.$result_consulta2_info->apellidos;
					}else{
						// si no hay resultados consultamos por identificador interno
						$this->db->where('identificador_interno', $data['identificador_interno']);
						if($colaborador_id!=null){
							$this->db->where('colaborador_id !=', $colaborador_id);
						}
						$result_consulta3 = $this->db->get($this->t_colaborador);
						$result_consulta3_num_rows = $result_consulta3->num_rows();
						if ($result_consulta3_num_rows > 0) {
							// si hay resultados es porque ya existe ese identificador registrado
							$result_consulta3_info = $result_consulta3->row();
							$response['tipo'] = 'danger';
							$response['texto'] = 'El identificador interno ingresado ya se encuetra registrado en el sistema para el usuario: '.$result_consulta3_info->nombre.' '.$result_consulta3_info->apellidos;
						}else{
							// si llego aqui es porque paso todas las validaciones
							$response['tipo'] = 'success';
						}
					}
				}
			}else{
				$response['tipo'] = 'warning';
				$response['texto'] = 'No se introdujeron todos los campos requeridos para este colaborador';
			}
		}
		return $response;
	}

	
}