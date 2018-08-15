<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyecto extends CI_Controller {

	private 
		$vista_master = 'index',
		$rol_id,
		$usuario_id,
		$data;


	function __construct(){
		parent::__construct();
		//Carga la vista
		$this->data['vista'] = $this->router->class.'/'.$this->router->method;
		//carga el modelo
		$this->load->model('m_proyecto');
		$this->load->model('m_cliente');
		$this->load->model('m_proveedor');
		$this->load->model('m_colaborador');
		//carga la validacion del formulario
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

		//Carga clientes
		$clientes = $this->m_cliente->getAllActiveClientes();
		$this->data['clientes'] = $clientes;

		//Carga jefes de proyecto
		$jefes_proyecto = $this->m_colaborador->getAllActiveJefesProyectos();
		$this->data['jefes_proyecto'] = $jefes_proyecto;
		
		// Carga provincias
		$provincias = $this->m_general->getProvincias();
		$this->data['provincias'] = $provincias;

		// Carga estados
		$proyecto_estados = $this->m_proyecto->getProyectoEstados();
		$this->data['proyecto_estados'] = $proyecto_estados;


		$this->data['permisos'] = $this->m_general->getPermisos();
	}


	public function index(){
		$acceso = $this->m_general->validarRol($this->router->class, 'list');
		if($acceso){
			$this->data['title'] = 'Proyectos';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function agregarProyecto(){
		$acceso = $this->m_general->validarRol($this->router->class, 'create');
		if($acceso){
			

			$post_data = $this->input->post(NULL,TRUE);
			if($post_data!=null){		
				$result_insert = $this->m_proyecto->insertar($post_data);
				if($result_insert['tipo']=='success'){
					redirect('/proyectos/ver-proyecto/'.$result_insert['inserted_id'].'?nuevo=1', 'refresh');
				}else{
					$this->data['msg'][] = $result_insert;
				}
			}

			$this->data['title'] = 'Proyectos';
			$this->load->view($this->vista_master, $this->data);
			
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function editarProyecto($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class, 'edit');
		if($acceso){
			if($proyecto_id!=null){
				$post_data = $this->input->post(NULL, TRUE);
				if($post_data!=null){
					$result_insert = $this->m_proyecto->actualizar($proyecto_id, $post_data);											
					$this->data['msg'][] = $result_insert;
					
				}

				$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
				if($proyecto_result!==false){
					if(isset($proyecto_result['proyecto'])){
						if($proyecto_result['proyecto']->fecha_firma_contrato!=null && $proyecto_result['proyecto']->fecha_firma_contrato!=''){
							$proyecto_result['proyecto']->fecha_firma_contrato = date('d/m/Y', strtotime($proyecto_result['proyecto']->fecha_firma_contrato));
						}
						if($proyecto_result['proyecto']->fecha_inicio!=null && $proyecto_result['proyecto']->fecha_inicio!=''){
							$proyecto_result['proyecto']->fecha_inicio = date('d/m/Y', strtotime($proyecto_result['proyecto']->fecha_inicio));
						}
						if($proyecto_result['proyecto']->fecha_entrega_estimada!=null && $proyecto_result['proyecto']->fecha_entrega_estimada!=''){
							$proyecto_result['proyecto']->fecha_entrega_estimada = date('d/m/Y', strtotime($proyecto_result['proyecto']->fecha_entrega_estimada));
						}
						
						
						$this->data['proyecto'] = $proyecto_result['proyecto'];
					}
					if(isset($proyecto_result['valor_oferta'])){
						foreach ($proyecto_result['valor_oferta'] as $kvalor => $vvalor) {
							$this->data['valor_oferta'][$vvalor->proyecto_valor_oferta_tipo_id][] = $vvalor;
						}
						
					}
					if(isset($proyecto_result['tipo_cambio'])){
						$this->data['tipo_cambio'] = $proyecto_result['tipo_cambio'];
					}
					
				}
				$this->data['title'] = 'Proyectos - Editar proyecto';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function verProyecto($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class, 'view');
		if($acceso){
			if($proyecto_id!=null){
				$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
				if($proyecto_result!==false){
					$fecha_inicio = strtotime($proyecto_result['proyecto']->fecha_inicio);
					$fecha_entrega_estimada = strtotime($proyecto_result['proyecto']->fecha_entrega_estimada);
					$fecha_actual = strtotime('now');
					$porcentaje_avance_proyecto = 0;
					$dias_consumidos = 0;
					$dias_proyecto = (((($fecha_entrega_estimada-$fecha_inicio)/60)/60)/24);
					if($fecha_actual > $fecha_inicio){
						$dias_consumidos = (((($fecha_actual-$fecha_inicio)/60)/60)/24);
						$this->data['dias_consumidos'] = ceil($dias_consumidos);
						if($dias_proyecto!=0){
							$porcentaje_avance_proyecto = ceil((100/$dias_proyecto)*$dias_consumidos);
							$this->data['dias_proyecto'] = ceil($dias_proyecto);
							$this->data['porcentaje'] = $porcentaje_avance_proyecto;

						}else{
							$this->data['dias_consumidos'] = ceil($dias_consumidos);
							$this->data['dias_proyecto'] = ceil($dias_proyecto);
							$this->data['porcentaje'] = $porcentaje_avance_proyecto;
						}
					}else{
						$this->data['dias_consumidos'] = ceil($dias_consumidos);
						$this->data['dias_proyecto'] = ceil($dias_proyecto);
						$this->data['porcentaje'] = $porcentaje_avance_proyecto;
					}

					// Agarra los datos por post
					$post_data = $this->input->post(NULL,TRUE);
					if($post_data!=null){	
						$datos_insert = $post_data;
						$this->data['msg'][] = $this->m_proyecto->registrarTiemposColaboradores($proyecto_id,$datos_insert);
					}
				

					$this->data['proyecto'] = $proyecto_result['proyecto'];
					$this->data['title'] = 'Proyectos - Ver proyecto';
					$this->load->view($this->vista_master, $this->data);
				}else{
					redirect('/proyectos', 'refresh');
				}
			}else{
				redirect('/proyectos', 'refresh');
			}
			
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function verExtensionesProyecto($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones', 'list');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];

				$proyecto_tipo_extensiones = $this->m_proyecto->consultarTiposExtensiones();
				if($proyecto_tipo_extensiones!==false){
					$this->data['extensiones_tipos'] = $proyecto_tipo_extensiones;
				}				

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']->nombre_proyecto.' - Ver extensiones';
				$this->load->view($this->vista_master, $this->data);
				
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}



	public function agregarExtensionProyecto($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones', 'create');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$proyecto_tipo_extensiones = $this->m_proyecto->consultarTiposExtensiones();

				if($proyecto_tipo_extensiones!==false){
					$this->data['extensiones_tipos'] = $proyecto_tipo_extensiones;
				}

				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){		
					$result_insert = $this->m_proyecto->insertarExtension($proyecto_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/extensiones/'.$proyecto_id.'?nuevo=1', 'refresh');
					}else{
						$this->data['msg'][] = $result_insert;
					}
				}

				$this->data['title'] = 'Proyectos';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
			
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function editarExtensionProyecto($proyecto_id, $extension_id){

		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones', 'edit');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$proyecto_tipo_extensiones = $this->m_proyecto->consultarTiposExtensiones();

				if($proyecto_tipo_extensiones!==false){
					$this->data['extensiones_tipos'] = $proyecto_tipo_extensiones;
				}

				$proyecto_extension = $this->m_proyecto->consultarExtension($extension_id);
				if($proyecto_extension!==false){
					$this->data['proyecto_extension'] = $proyecto_extension;
				}

				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){		
					$result_insert = $this->m_proyecto->actualizarExtension($extension_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/extensiones/'.$proyecto_id.'?editar=1', 'refresh');
					}else{
						$this->data['msg'][] = $result_insert;
					}
				}

				$this->data['title'] = 'Proyectos';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
			
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	/* Para manejo de tipos de ordenes de cambio */
	/* Para puestos de trabajo */

	public function verTiposOrdenCambio(){
		/* Esto se usa si la consulta se hace por post normal y no por angular 
		$post_data = $this->input->post(NULL, TRUE);
		if($post_data!=null){		
			exit(var_export($post_data));
		}*/
		$acceso = $this->m_general->validarRol($this->router->class.'_tipos_orden_cambio', 'list');
		if($acceso){
			$this->data['title'] = 'Proyectos - Tipos de orden de cambio';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function agregarTipoOrdenCambio(){
		$acceso = $this->m_general->validarRol($this->router->class.'_tipos_orden_cambio', 'create');
		if($acceso){
			$post_data = $this->input->post(NULL, TRUE);
			if($post_data!=null){
				$datos_insert = array();				
				$datos_insert = $post_data;
				$respuesta = $this->m_proyecto->insertarTipoOrdenCambio($datos_insert);
				$this->data['msg'][] = $respuesta;

			}

			$this->data['title'] = 'Proyecto - Extensiones - Agregar tipo de orden de cambio';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function editarTipoOrdenCambio($proyecto_valor_oferta_extension_tipo_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_tipos_orden_cambio', 'edit');
		if($acceso){
			if($proyecto_valor_oferta_extension_tipo_id!=null){
				$post_data = $this->input->post(NULL, TRUE);
				if($post_data!=null){
					$datos_insert = array();				
					$datos_insert = $post_data;
					$respuesta = $this->m_proyecto->editarTipoOrdenCambio($proyecto_valor_oferta_extension_tipo_id,$datos_insert);

					$this->data['msg'][] = $respuesta;
					
				}

				$tipo_orden_cambio_result = $this->m_proyecto->consultarTipoOrdenCambio($proyecto_valor_oferta_extension_tipo_id);
				
				if($tipo_orden_cambio_result!==false){
					$this->data['tipo_orden_cambio'] = $tipo_orden_cambio_result;
				}

				$this->data['title'] = 'Proyecto - Extensiones - Editar tipo de orden de cambio';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos/extensiones/tipos-orden-cambio', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	/* Para manejo de Gastos */

	public function verGastosProyecto($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_gastos', 'list');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];

				// carga los tipos de gasto
				$proyecto_tipo_gastos = $this->m_proyecto->consultarTiposGastos();
				if($proyecto_tipo_gastos!==false){
					$this->data['gasto_tipo'] = $proyecto_tipo_gastos;
				}

				// carga monedas
				$monedas = $this->m_general->getMonedas();				
				if($monedas!==false){
					$this->data['monedas'] = $monedas;
				}

				$proveedores = $this->m_proveedor->getAllActiveProveedores();
				if($proveedores!==false){
					$this->data['proveedores'] = $proveedores;
				}

				$gasto_estados = $this->m_proyecto->consultarEstadosGastos();
				if($gasto_estados!==false){
					$this->data['gasto_estados'] = $gasto_estados;
				}
				

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']->nombre_proyecto.' - Ver gastos';
				$this->load->view($this->vista_master, $this->data);
				
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function agregarGastoProyecto($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_gastos', 'create');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				// carga datos del proyecto	
				$this->data['proyecto'] = $proyecto_result['proyecto'];

				// carga los tipos de gasto
				$proyecto_tipo_gastos = $this->m_proyecto->consultarTiposGastos();
				if($proyecto_tipo_gastos!==false){
					$this->data['gasto_tipo'] = $proyecto_tipo_gastos;
				}

				// carga monedas
				$monedas = $this->m_general->getMonedas();				
				if($monedas!==false){
					$this->data['monedas'] = $monedas;
				}

				$proveedores = $this->m_proveedor->getAllActiveProveedores();
				if($proveedores!==false){
					$this->data['proveedores'] = $proveedores;
				}

				$gasto_estados = $this->m_proyecto->consultarEstadosGastos();
				if($gasto_estados!==false){
					$this->data['gasto_estados'] = $gasto_estados;
				}

				// Agarra los datos por post
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){	
					$result_insert = $this->m_proyecto->insertarGasto($proyecto_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/gastos/'.$proyecto_id.'?nuevo=1', 'refresh');
					}else{
						$this->data['msg'][] = $result_insert;
					}
				}

				$this->data['title'] = 'Proyectos';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
			
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function editarGastoProyecto($proyecto_id, $gasto_id){

		$acceso = $this->m_general->validarRol($this->router->class.'_gastos', 'edit');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				// carga datos del proyecto	
				$this->data['proyecto'] = $proyecto_result['proyecto'];

				// carga los tipos de gasto
				$proyecto_tipo_gastos = $this->m_proyecto->consultarTiposGastos();
				if($proyecto_tipo_gastos!==false){
					$this->data['gasto_tipo'] = $proyecto_tipo_gastos;
				}

				// carga monedas
				$monedas = $this->m_general->getMonedas();				
				if($monedas!==false){
					$this->data['monedas'] = $monedas;
				}

				$proveedores = $this->m_proveedor->getAllActiveProveedores();
				if($proveedores!==false){
					$this->data['proveedores'] = $proveedores;
				}

				$gasto_estados = $this->m_proyecto->consultarEstadosGastos();
				if($gasto_estados!==false){
					$this->data['gasto_estados'] = $gasto_estados;
				}

				$proyecto_gasto = $this->m_proyecto->consultarGasto($gasto_id);
				if($proyecto_gasto!==false){
					if($proyecto_gasto->fecha_gasto!=null && $proyecto_gasto->fecha_gasto!=''){
						$proyecto_gasto->fecha_gasto = date('d/m/Y', strtotime($proyecto_gasto->fecha_gasto));
					}
					
					$this->data['proyecto_gasto'] = $proyecto_gasto;
				}

				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){		
					$result_actualizar = $this->m_proyecto->actualizarGasto($gasto_id, $post_data);
					if($result_actualizar['tipo']=='success'){
						redirect('/proyectos/gastos/'.$proyecto_id.'?editar=1', 'refresh');
					}else{
						$this->data['msg'][] = $result_actualizar;
					}
				}

				$this->data['title'] = 'Proyectos';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
			
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	/* Para proyectos */
	public function verColaboradores($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_colaboradores', 'view');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];				

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']->nombre_proyecto.' - Ver colaboradores';
				$this->load->view($this->vista_master, $this->data);
				
			}else{
				redirect('/proyectos/ver-proyecto/'.$proyecto_id, 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function editarColaboradores($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_colaboradores', 'edit');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];	
				$result_colaboradores = $this->m_colaborador->getAllActiveSoloColaboradores();	
				$result_colaboradores_proyecto = $this->m_proyecto->consultaColaboradoresProyecto($proyecto_id);
						
				if($result_colaboradores_proyecto['datos']!=false){
					foreach ($result_colaboradores_proyecto['datos'] as $kcol => $vcol) {
						foreach ($result_colaboradores as $key => $value) {
							if($vcol->colaborador_id == $value->colaborador_id){
								unset($result_colaboradores[$key]);
							}
						}
					}
				}

				if ($this->input->get('resultado_insercion') != null) {
					if ($this->input->get('resultado_insercion')) {
						$this->data['msg'][] = array(
							'tipo' => 'success', 
							'texto' => 'Colaborador registrado y relacionado al proyecto con éxito.'
						);

					}else{
						$this->data['msg'][] = array(
							'tipo' => 'danger', 
							'texto' => 'Hubo un error al relacionar al colaborador con el proyecto.'
						);
					}
				}
				$this->data['colaboradores'] = $result_colaboradores;			

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']->nombre_proyecto.' - Editar colaboradores';
				$this->load->view($this->vista_master, $this->data);
				
			}else{
				redirect('/proyectos/ver-proyecto/'.$proyecto_id, 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function registrarTiemposColaboradores($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_colaboradores_tiempo', 'edit');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);

			if($proyecto_result!==false){
				// Para precargar un gasto si viene desde la seccion de gastos
				$input_get = $this->input->get();
				if(isset($input_get['gasto_id'])){
					$proyecto_gasto_id = $input_get['gasto_id'];
					if(is_numeric($proyecto_gasto_id)){
						$proyecto_gasto = $this->m_proyecto->consultarGasto($proyecto_gasto_id);
						if($proyecto_gasto!=false){
							$this->data['fecha_gasto'] = date('d/m/Y',strtotime($proyecto_gasto->fecha_gasto));
							
						}
					}
				}
				
				// Agarra los datos por post
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){	
					$datos_insert = $post_data;
					$this->data['msg'][] = $this->m_proyecto->registrarTiemposColaboradores($proyecto_id,$datos_insert);
				}

				$this->data['proyecto'] = $proyecto_result['proyecto'];				

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']->nombre_proyecto.' - Registrar tiempo de colaboradores';
				$this->load->view($this->vista_master, $this->data);
				
			}else{
				redirect('/proyectos/ver-proyecto/'.$proyecto_id, 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	// Ajax functions


	public function consultaProyectosAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			// aqui anade un filtro mas si el rol es de jefe de proyecto
			if($this->rol_id == 3){
				$post_data['filtros']['jefe_proyecto_id'] = $this->usuario_id;
			}
    		$result = $this->m_proyecto->consultaAll($post_data);
			die(json_encode($result));
    	}
	}

	public function consultaProyectosActivosAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$filtros = array();
		// aqui anade un filtro mas si el rol es de jefe de proyecto
		if($this->rol_id==3){
			$filtros['jefe_proyecto_id'] = $this->usuario_id;
		}
		
		$result = $this->m_proyecto->consultaAllActivos($filtros);
		die(json_encode($result));
    	
	}



	public function consultaProyectoInfoAjax(){
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$datos_proyecto = $this->m_proyecto->consultaInfoProyecto($post_data);
    		$result = $datos_proyecto;
			die(json_encode($result));
    	}
	}

	public function eliminarProyectoAjax(){
		$acceso = $this->m_general->validarRol($this->router->class, 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_proyecto->eliminarProyecto($post_data['proyecto_id']);
	    		$result = $result_eliminar;
				die(json_encode($result));
	    	}
    	}else{
    		$result=false;
			die(json_encode($result));
		}
	}


	public function consultaExtensionesProyectosAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_proyecto->consultaAllExtensionesConFiltros($post_data);
			die(json_encode($result));
    	}
	}

	public function consultaGastosProyectosAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_proyecto->consultaAllGastosConFiltros($post_data);
			die(json_encode($result));
    	}
	}

	

	public function eliminarExtensionAjax(){
		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones', 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_proyecto->eliminarExtension($post_data['extension_id']);
	    		$result = $result_eliminar;
				die(json_encode($result));
	    	}
    	}else{
    		$result=false;
			die(json_encode($result));
		}
	}

	public function eliminarGastoAjax(){
		$acceso = $this->m_general->validarRol($this->router->class.'_gastos', 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_proyecto->eliminarGasto($post_data['gasto_id']);
	    		$result = $result_eliminar;
				die(json_encode($result));
	    	}
    	}else{
    		$result=false;
			die(json_encode($result));
		}
	}


	/** Para manejo de colaboradores */

	public function consultaColaboradoresProyectoAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$result_colaboradores = $this->m_colaborador->getAllActiveSoloColaboradores();
			$result_colaboradores_proyecto = $this->m_proyecto->consultaColaboradoresProyecto($proyecto_id);
						
			if($result_colaboradores_proyecto['datos']!=false){
				foreach ($result_colaboradores_proyecto['datos'] as $kcol => $vcol) {
					foreach ($result_colaboradores as $key => $value) {
						if($vcol->colaborador_id == $value->colaborador_id){
							unset($result_colaboradores[$key]);
						}
					}
				}
			}
			$result = array('colaboradores' => $result_colaboradores, 'colaboradores_proyecto' => $result_colaboradores_proyecto);
			die(json_encode($result));
    	}
	}

	public function consultaColaboradoresActivosProyectoAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$result_colaboradores = $this->m_colaborador->getAllActiveSoloColaboradores();
			$result_colaboradores_proyecto = $this->m_proyecto->consultaColaboradoresActivosProyecto($proyecto_id);
						
			if($result_colaboradores_proyecto['datos']!=false){
				foreach ($result_colaboradores_proyecto['datos'] as $kcol => $vcol) {
					foreach ($result_colaboradores as $key => $value) {
						if($vcol->colaborador_id == $value->colaborador_id){
							unset($result_colaboradores[$key]);
						}
					}
				}
			}
			$result = array('colaboradores' => $result_colaboradores, 'colaboradores_proyecto' => $result_colaboradores_proyecto);
			die(json_encode($result));
    	}
	}

	
	public function relacionarColaboradorProyecto(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
		if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$colaborador_id = $post_data['colaborador_id'];
			$result = $this->m_proyecto->relacionarColaboradorProyecto($proyecto_id, $colaborador_id,2);
			die(json_encode($result));
		}
	}


	public function removerColaboradorProyectoAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$colaborador_id = $post_data['colaborador_id'];
			$result = $this->m_proyecto->removerColaboradorProyecto($proyecto_id, $colaborador_id);
			die(json_encode($result));
		}
	}

	public function consultaTiemposColaboradoresAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$fecha_gasto = $post_data['fecha_gasto'];
			$result = $this->m_proyecto->consultaTiemposColaboradores($proyecto_id, $fecha_gasto);
			die(json_encode($result));
		}

	}

	public function consultaCantonesAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_general->consultaCantonesProvincia($post_data);
			die(json_encode($result));
    	}
	}

	public function consultaDistritosAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_general->consultaDistritosCantones($post_data);
			die(json_encode($result));
    	}
	}


	/* Típos de Orden de Cambio */

	public function consultaTiposOrdenCambioAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_proyecto->consultarTiposOrdenCambio($post_data);
			die(json_encode($result));
    	}
	}

	public function eliminarTiposOrdenCambioAjax(){
		$acceso = $this->m_general->validarRol($this->router->class.'_tipos_orden_cambio', 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_proyecto->eliminarTipoOrdenCambio($post_data['proyecto_valor_oferta_extension_tipo_id']);
	    		$result = $result_eliminar;
				die(json_encode($result));
	    	}
    	}else{
    		$result=false;
			die(json_encode($result));
		}
	}
}