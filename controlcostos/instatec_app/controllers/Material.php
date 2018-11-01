<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	private 
		$vista_master = 'index',
		$data;


	function __construct(){
		parent::__construct();

		//Carga la vista
		$this->data['vista'] = $this->router->class.'/'.$this->router->method;
		$this->load->model('m_material');
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
			$this->data['title'] = 'Materiales';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function consultaMaterialesAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_material->consultarMateriales($post_data);
			die(json_encode($result));
    	}
	}


	/* Para Agregar Materiales */

	public function agregarMaterial(){
		$acceso = $this->m_general->validarRol($this->router->class, 'create');
		if($acceso){
			$post_data = $this->input->post(NULL, TRUE);
			if($post_data!=null){
				$datos_insert = array();				
				$datos_insert = $post_data;
				$puesto_no_existe = $this->m_material->validarExistenciaMaterial($datos_insert);
				if($puesto_no_existe['tipo'] == 'success'){	
					$respuesta = $this->m_material->insertar($datos_insert);
					$this->data['msg'][] = $respuesta;
				}else{
					$this->data['post_data'] = $post_data;
					$this->data['msg'][] = $puesto_no_existe;
				}

			}

			$this->data['title'] = 'Materiales - Agregar material';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	/* Para editar Materiales */
	public function editarMaterial($material_id){
		$acceso = $this->m_general->validarRol($this->router->class, 'edit');
		if($acceso){
			if($material_id!=null){
				$post_data = $this->input->post(NULL, TRUE);
				if($post_data!=null){
					$datos_insert = array();				
					$datos_insert = $post_data;
					$puesto_no_existe = $this->m_material->validarExistenciaMaterial($datos_insert, $material_id);
					if($puesto_no_existe['tipo'] == 'success'){	
						$respuesta = $this->m_material->actualizar($material_id,$datos_insert);
						$this->data['msg'][] = array('tipo' => 'success', 'texto' => 'Material actualizado correctamente.');
					}else{
						$this->data['post_data'] = $post_data;
						$this->data['msg'][] = $puesto_no_existe;
					}
				}

				$material_result = $this->m_material->consultarMaterial($material_id);
				
				if($material_result!==false){
					$this->data['material'] = $material_result;
				}

				$this->data['title'] = 'Materiales - Editar material';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/materiales', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	/* Eliminar material */

	public function eliminarMaterialAjax(){
		$acceso = $this->m_general->validarRol($this->router->class, 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_material->eliminar($post_data['material_id']);
	    		$result = $result_eliminar;
				die(json_encode($result));
	    	}
    	}else{
    		$result=false;
			die(json_encode($result));
		}
	}



	/* Para manejo de Unidades */

	public function verUnidades(){
		/* Esto se usa si la consulta se hace por post normal y no por angular 
		$post_data = $this->input->post(NULL, TRUE);
		if($post_data!=null){		
			exit(var_export($post_data));
		}*/
		$acceso = $this->m_general->validarRol($this->router->class.'_unidad', 'list');
		if($acceso){
			$this->data['title'] = 'Materiales - Unidades';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function agregarUnidad(){
		$acceso = $this->m_general->validarRol($this->router->class.'_unidad', 'create');
		if($acceso){
			$post_data = $this->input->post(NULL, TRUE);
			if($post_data!=null){
				$datos_insert = array();				
				$datos_insert = $post_data;
				$respuesta = $this->m_material->insertarMaterialUnidad($datos_insert);
				$this->data['msg'][] = $respuesta;

			}

			$this->data['title'] = 'Materiales - Agregar unidad';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function editarUnidad($material_unidad_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_unidad', 'edit');
		if($acceso){
			if($material_unidad_id!=null){
				$post_data = $this->input->post(NULL, TRUE);
				if($post_data!=null){
					$datos_insert = array();				
					$datos_insert = $post_data;
					$respuesta = $this->m_material->editarMaterialUnidad($material_unidad_id,$datos_insert);

					$this->data['msg'][] = $respuesta;
					
				}

				$unidad_result = $this->m_material->consultaMaterialUnidad($material_unidad_id);
				
				if($unidad_result!==false){
					$this->data['unidad'] = $unidad_result;
				}

				$this->data['title'] = 'Materiales - Editar unidad';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/materiales/unidades', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function consultaUnidadAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_material->consultarMaterialUnidades($post_data);
			die(json_encode($result));
    	}
	}

	public function eliminarUnidadAjax(){
		$acceso = $this->m_general->validarRol($this->router->class.'_unidad', 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_material->eliminarMaterialUnidad($post_data['material_unidad_id']);
	    		$result = $result_eliminar;
				die(json_encode($result));
	    	}
    	}else{
    		$result=false;
			die(json_encode($result));
		}
	}
}