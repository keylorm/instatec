<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Usuario extends CI_Model {

	private $t_usuario = 'usuario',
			$t_usuario_estado = 'usuario_estado',
			$t_usuario_detalle = 'usuario_detalle',
			$t_usuario_bitacora_ingreso = 'usuario_bitacora_ingreso',
			$t_usuario_rol_permiso = 'usuario_rol_permiso',
			$t_usuario_rol = 'usuario_rol',
			$t_usuario_colaborador = 'usuario_colaborador',
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
	}

	function getUserLogin($usuario){
		$this->db->where('usuario', $usuario);
		$this->db->where('estado_row', 1);
		$db_result = $this->db->get($this->t_usuario);
		if($db_result->num_rows() > 0){
			return $db_result->row();
		}else{
			return false;
		}
	}


	function registroBitacoraIngreso($usuario_id){

		
		$this->db->set('usuario_id', $usuario_id);
		$this->db->set('fecha_ingreso', date('Y-m-d H:i:s'));
		$this->db->set('ip', $this->ip);
		$this->db->set('agente_usuario', $this->agente_usuario);
		$this->db->insert($this->t_usuario_bitacora_ingreso);
		
	}

	function insertar($data){
		$this->db->where('usuario', $data['usuario']['usuario']);
		$usuario_result = $this->db->get($this->t_usuario);
		$usuario_result_count = $usuario_result->num_rows();
		$usuario_result_row = $usuario_result->row();

		$this->db->where($this->t_usuario_detalle.'.correo_electronico', $data['usuario']['correo_electronico']);
		$this->db->join($this->t_usuario, $this->t_usuario.'.usuario_id = '.$this->t_usuario_detalle.'.usuario_id');
		$usuario_detalle_result = $this->db->get($this->t_usuario_detalle);
		$usuario_detalle_result_count = $usuario_detalle_result->num_rows();
		$usuario_detalle_result_row = $usuario_detalle_result->row();

		if($usuario_result_count > 0 && $usuario_result_row->estado_row==1){
			return array('tipo' => 'danger',
							'texto' => 'Ya existe un usuario con ese nombre de usuario',
							);
		}else if($usuario_detalle_result_count > 0 && $usuario_detalle_result_row->estado_row==1){
			return array('tipo' => 'danger',
						'texto' => 'Ya existe un usuario con ese correo electrónico',
						);
		}else {
			//Si entra aqui es porque el usuario existio pero se desactivo en algun momento y hay que reingresarlo
			$respuesta_texto = '';
			$password_plaintext = $data['usuario']['password'];
			$usuario = $data['usuario']['usuario'];
			$password_hash =  password_hash( $password_plaintext, PASSWORD_DEFAULT, [ 'cost' => 10 ] );
	
			$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
			$this->db->set('rol_id', $data['usuario']['rol_id']);
			$this->db->set('estado_id', $data['usuario']['estado_id']);
			$this->db->set('usuario', $usuario);
			$this->db->set('password', $password_hash);
			$this->db->set('estado_row', 1);
			$this->db->insert($this->t_usuario);
			$usuario_id = $this->db->insert_id();
	
			$this->db->set('usuario_id', $usuario_id);
			$this->db->set('nombre', $data['usuario']['nombre']);
			$this->db->set('apellidos', $data['usuario']['apellidos']);
			$this->db->set('correo_electronico', $data['usuario']['correo_electronico']);
			$this->db->insert($this->t_usuario_detalle);

			$respuesta_texto = 'Usuario registrado con éxito.';

			if($data['usuario']['rol_id'] == 3){
				$this->load->model('m_colaborador');
				$colaborador_id = $this->m_colaborador->insertarJefeFromUser($data['usuario']);

				$this->db->set('usuario_id', $usuario_id);
				$this->db->set('colaborador_id', $colaborador_id);
				$this->db->insert($this->t_usuario_colaborador);

				$respuesta_texto .= ' Al ser un Jefe de Proyecto debe ir a la sección de "Colaboradores" y configurar su información específica de colaborador.';
			}

			return array('tipo' => 'success',
						'texto' => $respuesta_texto,
						'inserted_id'=> $usuario_id);
			
		}
	}

	function insertarJefeFromColaborador($data){
		$this->db->where('usuario', $data['usuario']);
		$usuario_result = $this->db->get($this->t_usuario);
		$usuario_result_count = $usuario_result->num_rows();
		$usuario_result_row = $usuario_result->row();

		$this->db->where($this->t_usuario_detalle.'.correo_electronico', $data['correo_electronico']);
		$this->db->join($this->t_usuario, $this->t_usuario.'.usuario_id = '.$this->t_usuario_detalle.'.usuario_id');
		$usuario_detalle_result = $this->db->get($this->t_usuario_detalle);
		$usuario_detalle_result_count = $usuario_detalle_result->num_rows();
		$usuario_detalle_result_row = $usuario_detalle_result->row();

		if($usuario_result_count > 0 && $usuario_result_row->estado_row==1){
			return array('tipo' => 'danger',
						'texto' => 'Ya existe un usuario con ese correo electrónico',
						);
		}else if($usuario_detalle_result_count > 0 && $usuario_detalle_result_row->estado_row==1){
			return array('tipo' => 'danger',
						'texto' => 'Ya existe un usuario con ese correo electrónico',
						);
		}else{
			//Si entra aqui es porque el usuario existio pero se desactivo en algun momento y no hay que ingresarlo sino reactivalro
			$respuesta_texto = '';
			$password_plaintext = $data['password'];
			$usuario = $data['usuario'];
			$password_hash =  password_hash( $password_plaintext, PASSWORD_DEFAULT, [ 'cost' => 10 ] );
	
			$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
			$this->db->set('rol_id', 3);
			$this->db->set('estado_id', $data['estado']);
			$this->db->set('usuario', $usuario);
			$this->db->set('password', $password_hash);
			$this->db->set('estado_row', 1);
			$this->db->insert($this->t_usuario);
			$usuario_id = $this->db->insert_id();
	
			$this->db->set('usuario_id', $usuario_id);
			$this->db->set('nombre', $data['nombre']);
			$this->db->set('apellidos', $data['apellidos']);
			$this->db->set('correo_electronico', $data['correo_electronico']);
			$this->db->insert($this->t_usuario_detalle);

			$respuesta_texto = 'Usuario registrado con éxito.';
			return array('tipo' => 'success',
						'texto' => $respuesta_texto,
						'inserted_id'=> $usuario_id);
		}
		
	}

	function actualizarJefeFromColaborador($data){
		if(isset($data['usuario'])){
			$respuesta_texto = '';
			$this->db->where('usuario', $data['usuario']);
			$this->db->where('estado_row', 1);
			$usuario_result = $this->db->get($this->t_usuario);
			$usuario_result_count = $usuario_result->num_rows();
			if($usuario_result_count>0){
				$usuario_result_row = $usuario_result->row();
				$usuario_id = $usuario_result_row->usuario_id;
				if (isset($data['password']) && $data['password']!='') {
					$password_plaintext = $data['password'];
					$password_hash =  password_hash( $password_plaintext, PASSWORD_DEFAULT, [ 'cost' => 10 ] );
	
					$this->db->set('password', $password_hash);
					$this->db->set('estado_id', 1);
					$this->db->where('usuario', $data['usuario']);
					$this->db->where('estado_row', 1);
					$this->db->update($this->t_usuario);
				}
				$this->db->where($this->t_usuario_detalle.'.usuario_id', $usuario_id);
				$usuario_detalle_result = $this->db->get($this->t_usuario_detalle);
				$usuario_detalle_result_count = $usuario_detalle_result->num_rows();
				$usuario_detalle_result_row = $usuario_detalle_result->row();

				if ($data['correo_electronico'] != $usuario_detalle_result_row->correo_electronico){
					$this->db->set('correo_electronico', $data['correo_electronico']);
					$this->db->where('usuario_id', $usuario_id);
					$this->db->update($this->t_usuario_detalle);
				}

				return array('tipo' => 'success',
						'texto' => $respuesta_texto,
						'inserted_id'=> $usuario_id);
			}

		}else{
			return array('tipo' => 'danger',
						'texto' => 'Hubo un error al actualizar el usuario',
						);
		}
		
	}


	function consultar($usuario_id){
		if($usuario_id!=null){
			$result = array();
			$this->db->join($this->t_usuario_detalle, $this->t_usuario_detalle.'.usuario_id = '.$this->t_usuario.'.usuario_id');
			$this->db->join($this->t_usuario_rol, $this->t_usuario_rol.'.rol_id = '.$this->t_usuario.'.rol_id');
			$this->db->where($this->t_usuario.'.usuario_id', $usuario_id);
			$result_usuario = $this->db->get($this->t_usuario);
			if($result_usuario->num_rows()> 0){
				$result['usuario'] = $this->security->xss_clean($result_usuario->row_array());				
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function actualizar($usuario_id, $data){
		//actualiza los campos
		$this->db->where('usuario', $data['usuario']['usuario']);
		$usuario_result = $this->db->get($this->t_usuario);
		$usuario_result_count = $usuario_result->num_rows();
		$usuario_result_count_result = $usuario_result->row();

		$this->db->where('correo_electronico', $data['usuario']['correo_electronico']);
		$this->db->join($this->t_usuario, $this->t_usuario.'.usuario_id = '.$this->t_usuario_detalle.'.usuario_id');
		$usuario_detalle_result = $this->db->get($this->t_usuario_detalle);
		$usuario_detalle_result_count = $usuario_detalle_result->num_rows();
		$usuario_detalle_result_count_result = $usuario_detalle_result->row();

		if(($usuario_result_count > 0) &&  ($usuario_result_count_result->usuario_id != $usuario_id) && ($usuario_result_count_result->estado_row==1)){
			return array('tipo' => 'danger',
						'texto' => 'Ya existe un usuario con ese nombre de usuario',
						);
		}else if(($usuario_detalle_result_count > 0)  &&  ($usuario_detalle_result_count_result->usuario_id != $usuario_id) && ($usuario_detalle_result_count_result->estado_row==1)){
			return array('tipo' => 'danger',
						'texto' => 'Ya existe un usuario con ese correo electrónico',
						);
		}else{
			$respuesta_texto = '';

			if(isset($data['usuario']['password'])){
				$password_plaintext = $data['usuario']['password'];
				$password_hash =  password_hash( $password_plaintext, PASSWORD_DEFAULT, [ 'cost' => 10 ] );
				$this->db->set('password', $password_hash);
			}
			
			$this->db->set('rol_id', $data['usuario']['rol_id']);
			$this->db->set('estado_id', $data['usuario']['estado_id']);
			$this->db->set('usuario', $data['usuario']['usuario']);
			$this->db->where('usuario_id',$usuario_id);
			$this->db->update($this->t_usuario);
			
			$this->db->set('nombre', $data['usuario']['nombre']);
			$this->db->set('apellidos', $data['usuario']['apellidos']);
			$this->db->set('correo_electronico', $data['usuario']['correo_electronico']);
			$this->db->where('usuario_id', $usuario_id);
			$this->db->update($this->t_usuario_detalle);

			$respuesta_texto = 'Usuario registrado con éxito.';

			if($data['usuario']['rol_id'] == 3){
				$this->load->model('m_colaborador');

				$this->db->where('usuario_id', $usuario_id);
				$result_usuario_colaborador = $this->db->get($this->t_usuario_colaborador);

				if($result_usuario_colaborador->num_rows()>0){
					$result_usuario_colaborador_result = $result_usuario_colaborador->row();
					$colaborador_id = $result_usuario_colaborador_result->colaborador_id;
					$this->m_colaborador->actualizarJefeFromUser($colaborador_id,$data['usuario']);
				}else{
					$colaborador_id = $this->m_colaborador->insertarJefeFromUser($data['usuario']);
					$this->db->set('usuario_id', $usuario_id);
					$this->db->set('colaborador_id', $colaborador_id);
					$this->db->insert($this->t_usuario_colaborador);

				}
				$respuesta_texto .= ' Al ser un Jefe de Proyecto debe ir a la sección de "Colaboradores" y configurar su información específica de colaborador.';

			}

			return array('tipo' => 'success',
						'texto' => $respuesta_texto,
						'inserted_id'=> $usuario_id);
						
		}	
		
		$this->m_bitacora->registrarEdicionBicatora('usuario', $usuario_id);
	}


	/*function registroAdmin(){
		$password_plaintext = '';
		$usuario = '';
		$password_hash =  password_hash( $password_plaintext, PASSWORD_DEFAULT, [ 'cost' => 10 ] );

		$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
		$this->db->set('rol_id', 1);
		$this->db->set('estado_id', 1);
		$this->db->set('usuario', $usuario);
		$this->db->set('password', $password_hash);
		$this->db->set('estado_row', 1);
		$this->db->insert($this->t_usuario);
	}*/


	function consultaAll($data = null){
		//Consulta primero los datos
		if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($value!=='' && $value!=='undefined' && $value!==null  &&  $value!=='all'){
					if($key=='usuario'){
						$this->db->like($key, $value);
					}else if($key=='nombre' || $key=='apellido'  || $key=='correo_electronico'){
						$this->db->like($this->t_usuario_detalle.'.'.$key, $value);
					}else if($key=='estado_id' || $key=='rol_id'){
						$this->db->where($this->t_usuario.'.'.$key, $value);
					}else{
						$this->db->where($key, $value);
					}
				}
			}
		}

		

		$this->db->where($this->t_usuario.'.estado_row', 1);

		$this->db->join($this->t_usuario_detalle, $this->t_usuario_detalle.'.usuario_id = '.$this->t_usuario.'.usuario_id');
		$this->db->join($this->t_usuario_rol, $this->t_usuario_rol.'.rol_id = '.$this->t_usuario.'.rol_id');
		/*$offset = 0;
		$this->db->join($this->t_usuario_estado, $this->t_usuario_estado.'.estado_id = '.$this->t_usuario.'.estado_id');
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
		$result_usuario = $this->db->get($this->t_usuario);

		//vuelve a hacer la consulta para obtener el total de rows 
		/*if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($value!=='' && $value!=='undefined' && $value!==null  &&  $value!=='all'){
					if($key=='usuario'){
						$this->db->like($key, $value);
					}else if($key=='nombre' || $key=='apellido'  || $key=='correo_electronico'){
						$this->db->like($this->t_usuario_detalle.'.'.$key, $value);
					}else if($key=='estado_id' || $key=='rol_id'){
						$this->db->where($this->t_usuario.'.'.$key, $value);
					}else{
						$this->db->where($key, $value);
					}
				}
			}
		}

		$this->db->set($this->t_usuario.'.estado_row', 0);

		$total_rows = $this->db->count_all_results($this->t_cliente, FALSE);*/

		if($result_usuario->num_rows()>0){
			$result = array(
							'total_rows' => $result_usuario->num_rows(),
							'datos' => $this->security->xss_clean($result_usuario->result_array()),
							);

			return $result;

		}else{
			return false;
		}
		

	}

	function eliminarUsuario($usuario_id){
		if( $usuario_id!=null ){
			// Desactiva el usuario. No lo borra para guardar un historial.
			$this->db->where('usuario_id', $usuario_id);
			$result_usuario = $this->db->get($this->t_usuario);
			$result_usuario_count = $result_usuario->num_rows();
			if($result_usuario_count>0){
				$result_usuario_row = $result_usuario->row();
				$this->db->set($this->t_usuario.'.estado_row', 0);
				$this->db->where($this->t_usuario.'.usuario_id', $usuario_id);
				$this->db->update($this->t_usuario);

				if($result_usuario_row->rol_id==3){
					$this->load->model('m_colaborador');
					$this->db->where('usuario_id', $usuario_id);
					$result_usuario_colaborador = $this->db->get($this->t_usuario_colaborador);

					if($result_usuario_colaborador->num_rows()>0){
						$result_usuario_colaborador_result = $result_usuario_colaborador->row();
						$colaborador_id = $result_usuario_colaborador_result->colaborador_id;
						$this->m_colaborador->desactivarJefeFromUser($colaborador_id);
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


	public function desactivarJefeFromColaborador($usuario_id){        
		$this->db->set('estado_row', 0);
		$this->db->where('usuario_id', $usuario_id);
        $this->db->update($this->t_usuario);
        return true;
	}

	function consultaAllRoles(){
		$this->db->where($this->t_usuario_rol.'.rol_id != 4');
		$result_roles = $this->db->get($this->t_usuario_rol);
		if($result_roles->num_rows()>0){
			$result =  $this->security->xss_clean($result_roles->result_array());
			return $result;

		}else{
			return false;
		}
	}
}