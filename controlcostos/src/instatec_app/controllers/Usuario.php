<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	private 
		$vista_master = 'index',
		$data;


	function __construct(){
		parent::__construct();

		//Carga la vista
		$this->data['vista'] = $this->router->class.'/'.$this->router->method;
		$this->load->model('m_usuario');
		$this->load->library('form_validation');

		//comprueba si hay una sesion iniciada
		$loggedin = $this->m_general->conectado();
		$this->data['loggedin'] = $loggedin;	
		if($loggedin){
			if($this->session->has_userdata('rol_id')){
				$this->rol_id = $this->session->userdata('rol_id');
				$this->data['rol_id'] = $this->rol_id;
			}
			if($this->session->has_userdata('usuario_id')){
				$this->usuario_id = $this->session->userdata('usuario_id');
				$this->data['usuario_id'] = $this->usuario_id;
			}			
		}else{
			redirect('/login', 'refresh');
		}

		$this->data['permisos'] = $this->m_general->getPermisos();
	}

	public function index()	{
		/* Esto se usa si la consulta se hace por post normal y no por angular 
		$post_data = $this->input->post(NULL, TRUE);
		if($post_data!=null){		
			exit(var_export($post_data));
		}*/
		$acceso = $this->m_general->validarRol($this->router->class, 'list');
		if($acceso){
			
			$this->data['roles'] = $this->m_usuario->consultaAllRoles();
			$this->data['title'] = 'Usuarios';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function agregarUsuario(){
		$acceso = $this->m_general->validarRol($this->router->class, 'create');
		if($acceso){
			$post_data = $this->input->post(NULL, TRUE);
			if($post_data!=null){
				$datos_insert = array();				
				$datos_insert['usuario'] = $post_data;
				$respuesta = $this->m_usuario->insertar($datos_insert);

				$this->data['msg'][] = $respuesta;

			}

			$this->data['roles'] = $this->m_usuario->consultaAllRoles();
			$this->data['title'] = 'Usuarios - Agregar usuario';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function editarUsuario($usuario_id){
		$acceso = $this->m_general->validarRol($this->router->class, 'edit');
		if($acceso){
			if($usuario_id!=null){
				$post_data = $this->input->post(NULL, TRUE);
				if($post_data!=null){
					$datos_update = array();
					$datos_update['usuario'] = $post_data;
					$this->m_usuario->actualizar($usuario_id, $datos_update);

					$this->data['msg'][] = array(
										'tipo' => 'success',
										'texto' => 'Usuario actualizado con éxito.');
				}
				
				$usuario_result = $this->m_usuario->consultar($usuario_id);
				if($usuario_result!==false){
					$this->data['usuario'] = $usuario_result['usuario'];
				}

				$this->data['roles'] = $this->m_usuario->consultaAllRoles();
				$this->data['title'] = 'Usuarios - Editar usuario';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/usuarios', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	/* Consultas AJAX */

	public function consultaUsuariosAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			if($this->rol_id==2){
				$post_data['filtros']['rol_id'] = 3;
			}
    		$result = $this->m_usuario->consultaAll($post_data);
			die(json_encode($result));
    	}
	}

	public function eliminarUsuarioAjax(){
		$acceso = $this->m_general->validarRol($this->router->class, 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_usuario->eliminarUsuario($post_data['usuario_id']);
	    		$result = $result_eliminar;
				die(json_encode($result));
	    	}
    	}else{
    		$result=false;
			die(json_encode($result));
		}
	}
}
