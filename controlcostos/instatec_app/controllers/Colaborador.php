<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaborador extends CI_Controller {

	private 
		$vista_master = 'index',
		$data;


	function __construct(){
		parent::__construct();

		//Carga la vista
		$this->data['vista'] = $this->router->class.'/'.$this->router->method;
		$this->load->model('m_colaborador');
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
			
			$this->data['puestos'] = $this->m_colaborador->consultaAllPuestos();
			$this->data['title'] = 'Colaboradores';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function agregarColaborador(){
		$acceso = $this->m_general->validarRol($this->router->class, 'create');
		if($acceso){
			$post_data = $this->input->post(NULL, TRUE);
			if($post_data!=null){
				$datos_insert = array();				
				$datos_insert = $post_data;
				$datos_insert['moneda_id'] = 2;
				$colaborador_no_existente = $this->m_colaborador->validarExistenciaUsuario($datos_insert);
				if($colaborador_no_existente['tipo'] == 'success'){	
					$respuesta = $this->m_colaborador->insertar($datos_insert);
					$this->data['msg'][] = $respuesta;
				}else{
					$this->data['post_data'] = $post_data;
					$this->data['msg'][] = $colaborador_no_existente;
				}

			}

			// carga monedas
			$monedas = $this->m_general->getMonedas();				
			if($monedas!==false){
				$this->data['monedas'] = $monedas;
			}

			$this->data['puestos'] = $this->m_colaborador->consultaAllPuestos();
			$this->data['title'] = 'Colaboradores - Agregar colaborador';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function editarColaborador($colaborador_id){
		$acceso = $this->m_general->validarRol($this->router->class, 'edit');
		if($acceso){
			if($colaborador_id!=null){
				$post_data = $this->input->post(NULL, TRUE);
				if($post_data!=null){
					$datos_insert = array();
					$post_data['colaborador_puesto_id'] = str_replace('number:','',$post_data['colaborador_puesto_id']);				
					$datos_insert = $post_data;
					$datos_insert['moneda_id'] = 2;	
					$colaborador_no_existente = $this->m_colaborador->validarExistenciaUsuario($datos_insert, $colaborador_id);
					if($colaborador_no_existente['tipo'] == 'success'){	
						$respuesta = $this->m_colaborador->actualizar($colaborador_id,$datos_insert);
						$this->data['msg'][] = array('tipo' => 'success', 'texto' => 'Colaborador actualizado correctamente.');
					}else{
						$this->data['post_data'] = $post_data;
						$this->data['msg'][] = $colaborador_no_existente;
					}
				}

				// carga monedas
				$monedas = $this->m_general->getMonedas();				
				if($monedas!==false){
					$this->data['monedas'] = $monedas;
				}

				$this->data['puestos'] = $this->m_colaborador->consultaAllPuestos();
				
				$colaborador_result = $this->m_colaborador->consultar($colaborador_id);
				
				if($colaborador_result!==false){
					$this->data['colaborador'] = $colaborador_result;
				}

				$this->data['title'] = 'Colaboradores - Editar colaborador';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/colaboradores', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	/* Consultas AJAX */

	public function consultaColaboradoresAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_colaborador->consultaAll($post_data);
			die(json_encode($result));
    	}
	}

	public function eliminarColaboradorAjax(){
		$acceso = $this->m_general->validarRol($this->router->class, 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_colaborador->eliminarColaborador($post_data['colaborador_id']);
	    		$result = $result_eliminar;
				die(json_encode($result));
	    	}
    	}else{
    		$result=false;
			die(json_encode($result));
		}
	}
}
