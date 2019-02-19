<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Proyecto extends CI_Controller {

	private 
		$vista_master = 'index',
		$rol_id,
		$usuario_id,
		$data,
		$path_archivos;


	function __construct(){
		parent::__construct();
		//Carga la vista
		$this->data['vista'] = $this->router->class.'/'.$this->router->method;
		$this->path_archivos = $this->config->item('path_archivos');
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
						if($proyecto_result['proyecto']['fecha_firma_contrato']!=null && $proyecto_result['proyecto']['fecha_firma_contrato']!=''){
							$proyecto_result['proyecto']['fecha_firma_contrato'] = date('d/m/Y', strtotime($proyecto_result['proyecto']['fecha_firma_contrato']));
						}
						if($proyecto_result['proyecto']['fecha_inicio']!=null && $proyecto_result['proyecto']['fecha_inicio']!=''){
							$proyecto_result['proyecto']['fecha_inicio'] = date('d/m/Y', strtotime($proyecto_result['proyecto']['fecha_inicio']));
						}
						if($proyecto_result['proyecto']['fecha_entrega_estimada']!=null && $proyecto_result['proyecto']['fecha_entrega_estimada']!=''){
							$proyecto_result['proyecto']['fecha_entrega_estimada'] = date('d/m/Y', strtotime($proyecto_result['proyecto']['fecha_entrega_estimada']));
						}

						$this->data['bloqueo_valor_materiales'] = $this->m_proyecto->validarExistenciaMaterialCotizadoProyecto($proyecto_id);
						
						$this->data['proyecto'] = $proyecto_result['proyecto'];
					}
					if(isset($proyecto_result['valor_oferta'])){
						foreach ($proyecto_result['valor_oferta'] as $kvalor => $vvalor) {
							$this->data['valor_oferta'][$vvalor['proyecto_valor_oferta_tipo_id']][] = $vvalor;
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
					// Valida si el Jefe de proyecto tiene acceso al proyecto proque le pertenece
					$usuario_permitido = true;
					if ($this->rol_id != 1 && $this->rol_id != 2){
						// Solo entra aqui si es Jefe de proyecto
						$jefe_proyecto_id = $proyecto_result['proyecto']['jefe_proyecto_id'];
						$usuario_permitido = $this->validarAccesoJefeProyecto($jefe_proyecto_id);
					}
					// Aqui valida si el usuario esta permitido o no
					if ($usuario_permitido) {
						$fecha_inicio = strtotime($proyecto_result['proyecto']['fecha_inicio']);
						$fecha_entrega_estimada = strtotime($proyecto_result['proyecto']['fecha_entrega_estimada']);
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
					} else {
						redirect('/proyectos', 'refresh');
					}
					
				}else{
					redirect('/proyectos', 'refresh');
				}
			} else {
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	private function validarAccesoJefeProyecto($jefe_proyecto_id) {
		if ($jefe_proyecto_id !== null) {
			$this->load->model('m_colaborador');
			$jefe_proyecto_usuario_id =$this->m_colaborador->consultarUsuarioIDJefeProyecto($jefe_proyecto_id);
			if ($this->usuario_id !== $jefe_proyecto_usuario_id){
				return false;
			} else {
				return true;
			}

		}
	}

	public function verExtensionesProyecto($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones', 'list');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];

				$proyecto_extensiones_estados = $this->m_proyecto->consultarEstadosExtensiones();
				if($proyecto_extensiones_estados!==false){
					$this->data['extensiones_estados'] = $proyecto_extensiones_estados;
				}				

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Ver extensiones';
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
				$proyecto_estados_extensiones = $this->m_proyecto->consultarEstadosExtensiones();

				if($proyecto_estados_extensiones!==false){
					$this->data['extensiones_estados'] = $proyecto_estados_extensiones;
				}

				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){		
					$result_insert = $this->m_proyecto->insertarExtension($proyecto_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/ordenes-cambio/'.$proyecto_id.'/editar-orden-cambio/'.$result_insert['inserted_id'].'?nuevo=1', 'refresh');
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
				$proyecto_estados_extensiones = $this->m_proyecto->consultarEstadosExtensiones();
				if($proyecto_estados_extensiones!==false){
					$this->data['extensiones_estados'] = $proyecto_estados_extensiones;
				}
				
				$proyecto_extension = $this->m_proyecto->consultarExtension($extension_id);
				if($proyecto_extension!==false){
					$this->data['proyecto_extension'] = $proyecto_extension;
					$proyecto_extension_rechazo = $this->m_proyecto->consultarExtensionRechazo($extension_id);
					if ($proyecto_extension_rechazo != false) {
						$this->data['proyecto_extension_rechazo'] = $proyecto_extension_rechazo;
					}
				}

				$correos_contactos = $this->m_proyecto->consultaAllContactos(array('filtros'=>array('proyecto_id' => $proyecto_id)));
				if ($correos_contactos != false) {
					$this->data['correos_contactos'] = $correos_contactos['datos'];
				}

				
				
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					$result_insert = $this->m_proyecto->actualizarExtension($extension_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/ordenes-cambio/'.$proyecto_id.'/editar-orden-cambio/'.$extension_id.'/?editar=1', 'refresh');
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

	public function consultarExtensionCambiosProyectoAjax() {
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$result['cambios'] = $this->m_proyecto->consultarAllExtensionCambios($post_data);
			$result['cambios_totales'] = $this->m_proyecto->consultarTotalValorOfertaExtension($post_data['filtros']['proyecto_valor_oferta_id']);
			die(json_encode($result));
    	}
	}


	public function consultarTotalesExtensionCambiosProyectoAjax() {
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_proyecto->consultarTotalValorOfertaExtension($post_data);
			die(json_encode($result));
    	}
	}

	public function agregarExtensionCambioProyecto($proyecto_id, $proyecto_extension_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones_cambios', 'create');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				
				$proyecto_extension = $this->m_proyecto->consultarExtension($proyecto_extension_id);
				if($proyecto_extension!==false){
					$this->data['proyecto_extension'] = $proyecto_extension;
				}
				
				$proyecto_extensiones_unidades = $this->m_proyecto->consultarUnidadesExtensiones();
				if($proyecto_extensiones_unidades!==false){
					$this->data['extensiones_unidades'] = $proyecto_extensiones_unidades;
				}

				$proyecto_extensiones_tipos = $this->m_proyecto->consultarTiposExtensiones();
				if($proyecto_extensiones_tipos!==false){
					$this->data['extensiones_tipos'] = $proyecto_extensiones_tipos;
				}

				// carga monedas
				$monedas = $this->m_general->getMonedas();				
				if($monedas!==false){
					$this->data['monedas'] = $monedas;
				}

				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					$result_insert = $this->m_proyecto->insertarExtensionCambio($proyecto_extension_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/ordenes-cambio/'.$proyecto_id.'/editar-orden-cambio/'.$proyecto_extension_id.'?nuevo=1', 'refresh');
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

	public function editarExtensionCambioProyecto($proyecto_id, $proyecto_extension_id, $proyecto_extension_cambio_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones_cambios', 'create');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];

				$proyecto_extension_cambio = $this->m_proyecto->consultarExtensionCambio($proyecto_extension_cambio_id);
				if($proyecto_extension_cambio!==false){
					$this->data['proyecto_extension_cambio'] = $proyecto_extension_cambio;
				}
				
				$proyecto_extension = $this->m_proyecto->consultarExtension($proyecto_extension_id);
				if($proyecto_extension!==false){
					$this->data['proyecto_extension'] = $proyecto_extension;
				}
				
				$proyecto_extensiones_unidades = $this->m_proyecto->consultarUnidadesExtensiones();
				if($proyecto_extensiones_unidades!==false){
					$this->data['extensiones_unidades'] = $proyecto_extensiones_unidades;
				}

				$proyecto_extensiones_tipos = $this->m_proyecto->consultarTiposExtensiones();
				if($proyecto_extensiones_tipos!==false){
					$this->data['extensiones_tipos'] = $proyecto_extensiones_tipos;
				}

				// carga monedas
				$monedas = $this->m_general->getMonedas();				
				if($monedas!==false){
					$this->data['monedas'] = $monedas;
				}

				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					$result_insert = $this->m_proyecto->actualizarExtensionCambio($proyecto_extension_id, $proyecto_extension_cambio_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/ordenes-cambio/'.$proyecto_id.'/editar-orden-cambio/'.$proyecto_extension_id.'?nuevo=1', 'refresh');
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

	public function generarArchivoOrdenCambio($proyecto_id, $proyecto_valor_oferta_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones', 'edit');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				
				// Busca la informacion 
				$proyecto = $proyecto_result['proyecto'];
				$proyecto_extension = $this->m_proyecto->consultarExtension($proyecto_valor_oferta_id);
				

				$post_data = array(
					'filtros' => array(
						'proyecto_valor_oferta_id' => $proyecto_valor_oferta_id,
					),
				);
				$cambios = $this->m_proyecto->consultarAllExtensionCambios($post_data);
				$cambios_totales = $this->m_proyecto->consultarTotalValorOfertaExtension($post_data['filtros']['proyecto_valor_oferta_id']);
				
				$this->generarPDFOrdenCambio($proyecto_id, $proyecto, $proyecto_extension, $proyecto_valor_oferta_id, $cambios, $cambios_totales);
				
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	function generarPDFOrdenCambio($proyecto_id, $proyecto, $proyecto_extension, $proyecto_valor_oferta_id, $cambios, $cambios_totales){
		$info = array(
			'widths' => array(16, 16, 16, 38,14),
			'cols' => array (
				array(
					'nombre' => 'Cantidad',
					'tipo' => 'numeric',
					'align' => 'left'
				),
				array(
					'nombre' => 'Tipo',
					'tipo' => 'long_text',
					'align' => 'center'
				),
				array(
					'nombre' => 'Lámina arquitectónica',
					'tipo' => 'long_text',
					'align' => 'left'
				),
				array(
					'nombre' => 'Descripción',
					'tipo' => 'long_text',
					'align' => 'left'
				),
				array(
					'nombre' => 'Total',
					'tipo' => 'numeric',
					'align' => 'right'
				),
			),
		);

		$info['rows'] = array();
		$contador = 1;
	
		foreach ($cambios['datos'] as $kcambio => $vcambio) {
			
			$info['rows'][] = array(
				$vcambio['cantidad'].' '.$vcambio['proyecto_valor_oferta_extension_unidad_simbolo'],
				$vcambio['proyecto_valor_oferta_extension_tipo'],
				$vcambio['lamina_arquitectonica'],
				$vcambio['descripcion'],
				(($vcambio['tipo_operacion']==2)?'-':'').' $'.' '.round($vcambio['total'],2),
			);
			$contador++;
			
		} 
		
		$pdf = $this->generarPDFGeneral('Orden de cambio - Instatec CR');

		// set font
		$pdf->SetFont('times', 'B', 12);
		$pdf->CustomHeaderText = "";
		// add a page
		$pdf->AddPage();

		// print a block of text using Write()
		$pdf->Ln(10);
		$pdf->SetFont('times', '', 11);
		$tableTopHTML = '<table width="100%" cellpadding="2" cellspacing="0" border="0">';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td colspan="3"><strong>Orden de cambio</strong></td>';
		$tableTopHTML .= '<td colspan="2" align="right"><strong>Orden de cambio #'.$proyecto_valor_oferta_id.'</strong></td>';
		$tableTopHTML .= '</tr>';
        $tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Proyecto: </td>';
		$tableTopHTML .= '<td colspan="2">'.$proyecto['nombre_proyecto'].'</td>';
		$tableTopHTML .= '<td>Cliente: </td>';
		$tableTopHTML .= '<td>'.$proyecto['nombre_cliente'].'</td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Jefe de Proyecto: </td>';
		$tableTopHTML .= '<td colspan="2">'.$proyecto['nombre'].' '.$proyecto['apellidos'].'</td>';
		$tableTopHTML .= '<td>Teléfono: </td>';
		$tableTopHTML .= '<td>'.$proyecto['telefono'].'</td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Estado de orden: </td>';
		$tableTopHTML .= '<td colspan="2">'.$proyecto_extension['proyecto_valor_oferta_extension_estado'].'</td>';
		$tableTopHTML .= '<td></td>';
		$tableTopHTML .= '<td></td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= "</table>";
		$pdf->writeHTML($tableTopHTML);
		
		$pdf->Ln(10);
		//Si es reporte se usan tablas
		$pdf->SetFont('times', '', 10);

		$tableHTML = "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"1\"><tr>";
		foreach ($info['cols'] as $kcol => $col) {
			$tableHTML .= "<th width=\"".$info['widths'][$kcol]."%\" align=\"center\"><b>".$col['nombre']."</b></th>";
		}
		$tableHTML .= "</tr>";
		foreach ($info['rows'] as $krow => $row) {
			$tableHTML .= "<tr>";
			foreach ($row as $key => $value) {
				$tableHTML .= '<td align="'.$info['cols'][$key]['align'].'">'.$value.'</td>';
				
			}
			$tableHTML .= "</tr>";
		}
		$tableHTML .= "</table>";
		$pdf->writeHTML($tableHTML);
		
		$pdf->Ln(2);

		$tableTotalHTML = "<table width=\"100%\" border=\"0\"><tr><td width=\"72%\"></td><td width=\"28%\">";
		$tableTotalHTML .= "<table align=\"right\" cellpadding=\"4\" cellspacing=\"0\" border=\"1\">";
		$tableTotalHTML .= "<tr><td>Subtotal</td><td align=\"right\">".'$ '.round($cambios_totales['subtotal'],2)."</td></tr>";
		//$tableTotalHTML .= "<tr><td>Descuento (".$info_post['descuento']." %)</td><td align=\"right\">".(($informacion_materiales['datos'][0]['moneda_id'] == 1)?'$ ':'¢ ').$descuento_total."</td></tr>";
		$tableTotalHTML .= "<tr><td>Impuesto</td><td align=\"right\">".'$ '.round($cambios_totales['impuesto'],2)."</td></tr>";
		$tableTotalHTML .= "<tr><td><strong>Total</strong></td><td align=\"right\">".'$ '.round($cambios_totales['total'],2)."</td></tr>";
		$tableTotalHTML .= "</table>";
		$tableTotalHTML .= "</td></tr></table>";
		$pdf->writeHTML($tableTotalHTML);

		$pdf->Ln(10);

		$pdf->writeHTML('<hr>');
		$pdf->Ln(20);

		$tableFooterHTML = '<table width="100%" cellpadding="4" cellspacing="0" border="0">';
		$tableFooterHTML .= '<tr>';
		$tableFooterHTML .= '<td>APROBADO POR: </td>';
		$tableFooterHTML .= '<td colspan="2"></td>';
		$tableFooterHTML .= '<td>RECIBIDO POR: </td>';
		$tableFooterHTML .= '<td align="right"></td>';
		$tableFooterHTML .= '</tr>';
		$tableFooterHTML .= "</table>";
		$pdf->writeHTML($tableFooterHTML);

		// ---------------------------------------------------------

		//Close and output PDF document
		//$pdf->Output($filename, 'I');
		$dirname = $this->path_archivos.$proyecto_id.'/ordenes_cambio';
		$filename = 'Orden_Cambio_'.$proyecto_valor_oferta_id.'_'.$proyecto['nombre_proyecto'].'_'.date('Y_m_d').'.pdf';
		if (!file_exists($dirname.'/')) {
	    	mkdir($dirname, 0777,true);
	    }
		$pdf->Output(FCPATH.$dirname.'/'.$filename, 'FD');
		$archivo = array(
			'url_archivo' => $dirname.'/'.$filename,
			'filename' => $filename,
		);

		//Descarga el archivo
		$this->load->helper('download');
		force_download($dirname.'/'.$filename, NULL);
	}

	public function migrarExtensionesSinCambios() {
		$acceso = ($this->rol_id == 1)?true:false;
		if($acceso){
			$result_migracion = $this->m_proyecto->migrarExtensionesSinCambios();
			echo '<h1>Migracion realizada con exito</h1>';
			echo '<p>Datos migrados:</p>';
			echo '<code>'.json_encode($result_migracion).'</code>';
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function migrarPathsArchivosViejos() {
		$acceso = ($this->rol_id == 1)?true:false;
		if($acceso){
			$result_migracion = $this->m_proyecto->migrarPathsArchivosViejos();
			echo '<h1>Migracion realizada con exito</h1>';
			echo '<p>Archivos migrados:</p>';
			echo '<code>'.json_encode($result_migracion).'</code>';
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function enviarCorreoContactoExtensionAjax(){
		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones', 'edit');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
				if (isset($post_data['proyecto_id']) && is_numeric($post_data['proyecto_id']) && isset($post_data['proyecto_valor_oferta_id']) && is_numeric($post_data['proyecto_valor_oferta_id']) ) {
					// Se obtiene la informacion del proyecto
					$proyecto_id = $post_data['proyecto_id'];
					$proyecto_valor_oferta_id = $post_data['proyecto_valor_oferta_id'];
					$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
					$proyecto = $proyecto_result['proyecto'];
					// SE encripta el ID del proyecto y de la oferta
					$idToEncrypt = $proyecto_id.'|'.$proyecto_valor_oferta_id;
					$encrypted_id = $this->encrypt($idToEncrypt);
					$url_encrypted = base_url().'solicitud-aprobacion-orden-cambio/?q='.$encrypted_id;

					// Se sacan los correos
					$correos_seleccionados = array();
					if (isset($post_data['correos_seleccionados'])) {
						foreach ($post_data['correos_seleccionados'] as $kcorreo => $vcorreo) {
							if ($vcorreo === true) {
								$correos_seleccionados[] = $kcorreo;
							}
						}
					}

					$result = true;
					if (!empty($correos_seleccionados) && $url_encrypted != null) {
						$contactos = $this->m_proyecto->consultarContactosPorID($correos_seleccionados);
						if ($contactos !== false) {
							$correos = array();
							foreach ($contactos as $kcontacto => $vcontacto) {
								$correos[] = $vcontacto['correo_contacto'];
							}
							if (!empty($correos)) {
								$result = $this->enviarCorreosPorContacto($proyecto, $proyecto_valor_oferta_id, $correos, $url_encrypted);
							}
						}
					}

					die(json_encode($result));

				} else {
					$result=false;
					die(json_encode($result));
				}
	    	}
    	}else{
    		$result=false;
			die(json_encode($result));
		}
	}

	function enviarCorreosPorContacto($proyecto, $proyecto_valor_oferta_id, $correos, $url_encrypted) {
		$body_message = '<p>Hola,</p>
		<p>Solicitud aprobación Orden de Cambio #'.$proyecto_valor_oferta_id.' - '.$proyecto['nombre_proyecto'].'</p>
		<p>Ver el siguiente enlace para su aprobación:</p>
		<p><strong><a href="'.$url_encrypted.'" target="_blank">'.$url_encrypted.'</a></strong></p>
		<p>Una vez aprobada o rechazada la orden de cambio, el link quedará disponible solo para consulta.</p>
		<p>Cualquier duda o consulta, contactarse al teléfono  <a href="tel:'.$proyecto['telefono'].'">'.$proyecto['telefono'].'</a> o escríbanos al correo electrónico <a href="mailto:'.$proyecto['correo_electronico'].'">'.$proyecto['correo_electronico'].'</a>.</p>
		<p>¡Muchas gracias!</p>
		<p><strong>Instalaciones Tecnológicas INSTATEC SA</strong></p>';
		$this->load->library('email');

		$this->email->from('envios@instateccr.com', 'Instalaciones Tecnológicas INSTATEC SA');
		$this->email->to($correos);

		$this->email->subject('Orden de Cambio #'.$proyecto_valor_oferta_id.' - Proyecto: '.$proyecto['nombre_proyecto']);
		$this->email->message($body_message);

		$this->email->send();
		return true;
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
				redirect('/proyectos/ordenes-cambio/tipos-orden-cambio', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

		/* Para manejo de Contactos */

	public function verContactosProyecto($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_contactos', 'list');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];				

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Ver contactos';
				$this->load->view($this->vista_master, $this->data);
				
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function agregarContactoProyecto($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_contactos', 'create');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				// carga datos del proyecto	
				$this->data['proyecto'] = $proyecto_result['proyecto'];

				// Agarra los datos por post
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){	
					$result_insert = $this->m_proyecto->insertarContacto($proyecto_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/contactos/'.$proyecto_id.'?nuevo=1', 'refresh');
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

	public function editarContactoProyecto($proyecto_id, $contacto_id){

		$acceso = $this->m_general->validarRol($this->router->class.'_contactos', 'edit');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];

				

				$proyecto_contacto = $this->m_proyecto->consultarContacto($contacto_id);
				if($proyecto_contacto!==false){
					$this->data['proyecto_contacto'] = $proyecto_contacto;
				}

				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){		
					$result_actualizar = $this->m_proyecto->actualizarContacto($contacto_id, $post_data);
					if($result_actualizar['tipo']=='success'){
						redirect('/proyectos/contactos/'.$proyecto_id.'?editar=1', 'refresh');
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
				

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Ver gastos';
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
					$validar_gasto = $this->m_proyecto->validarGastoNuevo($proyecto_id, $post_data);
					
					if ($validar_gasto['result']) {
						$result_insert = $this->m_proyecto->insertarGasto($proyecto_id, $post_data);
						if($result_insert['tipo']=='success'){
							redirect('/proyectos/gastos/'.$proyecto_id.'?nuevo=1', 'refresh');
						}else{
							$this->data['msg'][] = $result_insert;
						}

					} else {
						$this->session->set_userdata('gasto_nuevo_temp', $post_data);
						redirect('/proyectos/gastos/'.$proyecto_id.'/validar-duplicado/'.$validar_gasto['gasto_viejo'], 'refresh');
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

	public function validarGastoDuplicado($proyecto_id, $gasto_viejo_id) {
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

				$gasto_nuevo =$this->session->userdata('gasto_nuevo_temp');
				$this->data['gasto_nuevo'] = $gasto_nuevo;

				$proyecto_gasto = $this->m_proyecto->consultarGasto($gasto_viejo_id);
				if($proyecto_gasto!==false){
					if($proyecto_gasto['fecha_gasto']!=null && $proyecto_gasto['fecha_gasto']!=''){
						$proyecto_gasto['fecha_gasto'] = date('d/m/Y', strtotime($proyecto_gasto['fecha_gasto']));
					}
					
					$this->data['proyecto_gasto'] = $proyecto_gasto;
				}

				// Agarra los datos por post
				$post_data = $this->input->post(NULL,TRUE);
				if ($post_data!=null){
					if (isset($post_data['guardar_duplicado']) && $post_data['guardar_duplicado'] == true) {
						$result_insert = $this->m_proyecto->insertarGasto($proyecto_id, $gasto_nuevo);
						if($result_insert['tipo']=='success'){
							$this->session->unset_userdata('gasto_nuevo_temp');
							redirect('/proyectos/gastos/'.$proyecto_id.'?nuevo=1', 'refresh');
						}else{
							$this->data['msg'][] = $result_insert;
						}
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
					if($proyecto_gasto['fecha_gasto']!=null && $proyecto_gasto['fecha_gasto']!=''){
						$proyecto_gasto['fecha_gasto'] = date('d/m/Y', strtotime($proyecto_gasto['fecha_gasto']));
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

	/* Para colaboradores */
	public function verColaboradores($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_colaboradores', 'view');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];				

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Ver colaboradores';
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
							if($vcol['colaborador_id'] == $value['colaborador_id']){
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

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Editar colaboradores';
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
							$this->data['fecha_gasto'] = date('d/m/Y',strtotime($proyecto_gasto['fecha_gasto']));
							
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

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Registrar tiempo de colaboradores';
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
				$this->load->model('m_colaborador');
				$jefe_proyecto_id = $this->m_colaborador->consultarJefeProyectoIdUsuario($this->usuario_id);
				$post_data['filtros']['jefe_proyecto_id'] = $jefe_proyecto_id;
			}
    		$result = $this->m_proyecto->consultaAll($post_data);
			die(json_encode($result));
    	}
	}

	public function consultaProyectosActivosAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$post_data = array();
		// aqui anade un filtro mas si el rol es de jefe de proyecto
		if($this->rol_id==3){
			$this->load->model('m_colaborador');
			$jefe_proyecto_id = $this->m_colaborador->consultarJefeProyectoIdUsuario($this->usuario_id);
			$post_data['filtros']['jefe_proyecto_id'] = $jefe_proyecto_id;
		}
		$result = $this->m_proyecto->consultaAllActivos($post_data);
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

	public function consultaContactosProyectosAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_proyecto->consultaAllContactos($post_data);
			die(json_encode($result));
    	}
	}

	public function eliminarContactoAjax(){
		$acceso = $this->m_general->validarRol($this->router->class.'_contactos', 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_proyecto->desvincularContacto($post_data['proyecto_id'], $post_data['contacto_id']);
	    		$result = $result_eliminar;
				die(json_encode($result));
	    	}
    	}else{
    		$result=false;
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

	public function eliminarExtensionCambioAjax(){
		$acceso = $this->m_general->validarRol($this->router->class.'_extensiones_cambios', 'delete');
		if($acceso){
			$this->output->set_content_type('application/json');
			$post_data = json_decode(file_get_contents("php://input"), true);
	    	if($post_data!=null){
	    		$result_eliminar = $this->m_proyecto->eliminarExtensionCambio($post_data['proyecto_valor_oferta_extension_cambio_id']);
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
						if($vcol['colaborador_id'] == $value['colaborador_id']){
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
						if($vcol['colaborador_id'] == $value['colaborador_id']){
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



	/* Para manejo de materiales */
	public function verMateriales($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales', 'list');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Ver materiales';
				$this->load->view($this->vista_master, $this->data);
				
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function editarListaMateriales($proyecto_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales', 'edit');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->load->model('m_material');
				

				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					//exit(var_export($post_data));
					$material_id = null;
					if ($post_data['agregar_material'] == 'true') {
						$datos_insert = array();
						$datos_insert = $post_data;
						$datos_relacion = array();				
						$datos_relacion = $post_data;			
						unset($datos_insert['material_id']);
						unset($datos_insert['material_unidad_id']);
						unset($datos_insert['tipo_relacion']);
						unset($datos_insert['cantidad']);
						unset($datos_insert['comentario']);
						unset($datos_insert['agregar_material']);
						$material_no_existe = $this->m_material->validarExistenciaMaterial($datos_insert);
						if($material_no_existe['tipo'] == 'success'){	
							$respuesta = $this->m_material->insertar($datos_insert);
							$material_id = $respuesta['material_id'];
							$tipo_relacion = $datos_relacion['tipo_relacion'];
							unset($datos_relacion['material']);
							unset($datos_relacion['material_codigo']);
							unset($datos_relacion['agregar_material']);
							unset($datos_relacion['material_id']);
							unset($datos_relacion['tipo_relacion']);
							$datos_relacion['material_unidad_id'] =  str_replace('number:', '', $datos_relacion['material_unidad_id']);
							$result_relacion = $this->m_proyecto->relacionarMaterialProyecto($proyecto_id, $material_id, $tipo_relacion, $datos_relacion);
							if ($result_relacion['tipo'] == 'success') {
								$result = array(
									'material_id' => $material_id, 
									'result' => array(
										'tipo' => 'success', 
										'texto' => 'Material agregado y relacionado al proyecto satisfactoriamente'
									)
								);
							} else {
								$result = array (
									'result' => array (
										'tipo' => 'warning', 
										'texto' => 'Material agregado a la base de datos pero hubo un problema al relacionarlo con el proyecto. Intentelo de nuevo'
									)
								);
							}
							
						}else{
							$result = array(
								'material_id' => $material_id, 
								'result' => array(
									'tipo' => 'danger', 
									'texto' => 'El material que intentó agregar ya existe en la Base de datos. Agreguelo desde el listado de materiales existentes'
								)
							);
						}
					} else {
						$datos_relacion = array();				
						$datos_relacion = $post_data;
						$tipo_relacion = $datos_relacion['tipo_relacion'];
						unset($datos_relacion['material']);
						unset($datos_relacion['material_codigo']);
						unset($datos_relacion['agregar_material']);
						unset($datos_relacion['tipo_relacion']);
						$material_id = str_replace('number:', '', $datos_relacion['material_id']);
						unset($datos_relacion['material_id']);
						$datos_relacion['material_unidad_id'] = str_replace('number:', '', $datos_relacion['material_unidad_id']);
						$result_relacion = $this->m_proyecto->relacionarMaterialProyecto($proyecto_id, $material_id, $tipo_relacion, $datos_relacion);
						$result = array(
							'result' => $result_relacion
						);
					}
					$this->data['respuesta_relacion'] = $result;
				}
						

				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['material_unidades'] = $this->m_material->consultaAllActiveMaterialUnidades();

				$result_materiales = $this->m_material->getAllActiveMateriales();	
				$this->data['materiales'] = $result_materiales;						

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Editar lista de materiales';
				$this->load->view($this->vista_master, $this->data);
				
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function consultarMaterialesProyectoAjax(){
		$this->load->model('m_material');
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$result_materiales = $this->m_material->getAllActiveMateriales();
			$result_materiales_iniciales_proyecto = $this->m_proyecto->consultarMaterialesInicialesProyecto($proyecto_id);
			$result_materiales_extensiones_proyecto = $this->m_proyecto->consultarMaterialesExtensionesProyecto($proyecto_id);
						
			$result = array(
				'materiales' => $result_materiales, 
				'materiales_iniciales_proyecto' => $result_materiales_iniciales_proyecto,
				'materiales_extensiones_proyecto' => $result_materiales_extensiones_proyecto,
			);
			die(json_encode($result));
    	}
	}

	public function consultarMaterialesActivosProyectoAjax(){
		$this->load->model('m_material');
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$result_materiales = $this->m_material->getAllActiveMateriales();
			$result_materiales_proyecto_activos = $this->m_proyecto->consultarMaterialesActivosProyecto($proyecto_id);
						
			$result = array(
				'materiales' => $result_materiales, 
				'materiales_proyecto_activos' => $result_materiales_proyecto_activos,
			);
			die(json_encode($result));
    	}
	}

	public function consultarMaterialesProveedoresActivosProyectoAjax(){
		$this->load->model('m_material');
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$result_materiales = $this->m_material->getAllActiveMateriales();
			$result_materiales_proyecto = $this->m_proyecto->consultarProveedoresMaterialesActivosProyecto($proyecto_id);
						
			$result = array(
				'materiales' => $result_materiales, 
				'materiales_proyecto_activos' => $result_materiales_proyecto,
			);
			die(json_encode($result));
    	}
	}

	public function actualizarInformacionMaterialProyectoAjax(){
		$this->load->model('m_material');
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		if (isset($post_data['proyecto_material_id'])) {
				$proyecto_material_id = $post_data['proyecto_material_id'];
				unset($post_data['proyecto_material_id']);
				$result_materiales = $this->m_proyecto->actualizarMaterialProyecto($proyecto_material_id, $post_data);
				if ($result_materiales){
					$result = array('datos' => 
						array(
							'resultado' => true,
							'mensaje' => 'Material actualizado con exito',
							)
						);
				} else {
					$result = array('datos' => 
						array(
							'resultado' => false,
							'mensaje' => 'Hubo un error al actualizar el material',
							)
						);
				}
				die(json_encode($result));
    		} else {
    			$result = array('datos' => 
					array(
						'resultado' => false,
						'mensaje' => 'Hubo un error al actualizar el material',
						)
					);
    			die(json_encode($result));
    		}
    	}
	}

	public function actualizarProveedorMaterialProjectoAjax() {
		$this->load->model('m_material');
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		if (isset($post_data['proyecto_material_id'])) {
				$proyecto_material_id = $post_data['proyecto_material_id'];
				if ($post_data['tiene_impuesto'] == 0) {
					$post_data['impuesto'] = '';
				}
				$result_materiales = $this->m_proyecto->actualizarProveedorMaterialProyecto($proyecto_material_id, $post_data);
				if ($result_materiales){
					$result = array('datos' => 
						array(
							'resultado' => true,
							'mensaje' => 'Información actualizado con exito',
							)
						);
				} else {
					$result = array('datos' => 
						array(
							'resultado' => false,
							'mensaje' => 'Hubo un error al actualizar la información',
							)
						);
				}
				die(json_encode($result));
    		} else {
    			$result = array('datos' => 
					array(
						'resultado' => false,
						'mensaje' => 'Hubo un error al actualizar la información',
						)
					);
    			die(json_encode($result));
    		}
    	}
	}

	public function toggleEstadoMaterialProyectoAjax(){
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		if (isset($post_data['proyecto_material_id'])) {
				$proyecto_material_id = $post_data['proyecto_material_id'];
				$result_materiales = $this->m_proyecto->toggleEstadoMaterialProyecto($proyecto_material_id);
				if ($result_materiales){
					$result = true;
				} else {
					$result = false;
				}
    		} else {
    			$result = false;
    		}
    		die(json_encode($result));
    	}
	}

	public function verSolicitudesCotizacionMateriales($proyecto_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_cotizacion', 'list');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Solicitudes cotización de materiales';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function consultarSolicitudesCotizacionMaterialesProyectoAjax() {
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$result_solicitudes = $this->m_proyecto->consultarSolicitudesCotizacionMaterialesProyecto($proyecto_id);
						
			$result = array(
				'solicitudes_cotizacion_materiales' => $result_solicitudes,
			);
			die(json_encode($result));
    	}
	}


	public function generarSolicitudCotizacionMateriales($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_cotizacion', 'create');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->load->model('m_material');
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					if (isset($post_data['generar_cotizacion_materiales_iniciales'])) {
						//Si es la lista de materiales iniciales
						if (isset($post_data['material_inicial_check']) && !empty($post_data['material_inicial_check'])) {
							// Si hay materiales seleccionados
							$informacion_materiales = $this->m_proyecto->consultarMaterialesInicialesActivosProyecto($proyecto_id, $post_data['material_inicial_check']);
						} else {
							// Si no hay materiales seleccionados
							$informacion_materiales = $this->m_proyecto->consultarMaterialesInicialesActivosProyecto($proyecto_id);
						}
					} else if (isset($post_data['generar_cotizacion_materiales_extensiones'])) {
						//Si es la lista de materiales iniciales
						if (isset($post_data['material_extension_check']) && !empty($post_data['material_extension_check'])) {
							// Si hay materiales seleccionados
							$informacion_materiales = $this->m_proyecto->consultarMaterialesExtensionesActivosProyecto($proyecto_id, $post_data['material_extension_check']);
						} else {
							// Si no hay materiales seleccionados
							$informacion_materiales = $this->m_proyecto->consultarMaterialesExtensionesActivosProyecto($proyecto_id);
						}
					}

					if ($informacion_materiales['total_rows'] > 0) {
						$this->generarXLSSolicitudCotizacionMateriales($proyecto_id, $informacion_materiales);
					}
				}
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Generar solicitud de cotización de materiales';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	/* Para generar PDF -- Obsoleta */
	/*
	function generarPDFSolicitudCotizacionMateriales($informacion_materiales){
		$proyecto = $this->m_proyecto->consultar($proyecto_id);	
		$info = array(
			'widths' => array(30, 50, 20),
			'cols' => array (
				array(
					'nombre' => 'Material',
					'tipo' => 'text',
				),
				array(
					'nombre' => 'Detalle',
					'tipo' => 'long_text',
				),
				array(
					'nombre' => 'Cantidad',
					'tipo' => 'numeric',
				),
			),
		);

		$info['rows'] = array();
		foreach ($informacion_materiales['datos'] as $kmat => $vmat) {
			$info['rows'][] = array(
				$vmat->material,
				$vmat->comentario,
				$vmat->cantidad.' '.$vmat->material_unidad,
			);
		}
		
		$this->generarPDFMateriales('Solicitud de Cotización de materiales', 'R', $info, 'Solicitud_cotizacion.pdf');
				
				
	}

	*/

	function generarXLSSolicitudCotizacionMateriales($proyecto_id, $informacion_materiales)
	{
		//crea registro en DB
		$proyecto_material_solicitud_cotizacion_id = $this->m_proyecto->insertarSolicitudCotizacionMateriales($proyecto_id);
		$proyecto_result = $this->m_proyecto->consultar($proyecto_id);

		//Estilos
		$sheetTitle = array(
			'font' => array(
				'bold' => true,
				'size' => 16,
				'name'=> 'Arial',
		    ),
			'alignment' => array(
		        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		    ),
		);


		$boldStyle = array(
			'font' => array(
				'bold' => true,
				'name'=> 'Arial',
		    ),
		);

		$centerAlign = array(
			'alignment' => array(
		        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		    ),
		);

		$leftAlign = array(
			'alignment' => array(
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
			),
		);

		$normalStyle = array(
			'font' => array(
				'name'=> 'Arial',
				'size' => 10,
		    ),
		);

		$italicStyle = array(
			'font' => array(
				'italic' => true,
		    ),
		);

		$tableTitle = array(
			'font' => array(
				'bold' => true,
				'name'=> 'Arial',
		    ),
			'alignment' => array(
		        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		    ),
		);

		$borderCell = array(
			'borders' => array(
		        'top' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		        ),
		        'bottom' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		        ),
		        'right' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		        ),
		        'left' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		        ),
		    ),
		);

		//Crea el objeto de excel
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->mergeCells('A1:B2');
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setName('Logo');
		$drawing->setDescription('Logo');
		$drawing->setPath(FCPATH.'/src/instatec_pub/images/logo.jpg');
		$drawing->setHeight(36);
		$drawing->setCoordinates('A1');
		$drawing->setWorksheet($sheet);

		$sheet->setCellValue('A3', 'Instalaciones tecnológicas INSTATEC CR');
		$sheet->getStyle('A3')->applyFromArray($boldStyle);
		$sheet->setCellValue('A4', 'Acabados especializados en construcción');
		$sheet->getStyle('A4')->applyFromArray($normalStyle);
		$sheet->getStyle('A4')->applyFromArray($italicStyle);
		$sheet->setCellValue('A5', 'Tel: +506 2101 7071 / Correo: instateccr@gmail.com');
		$sheet->getStyle('A5')->applyFromArray($normalStyle);
		$sheet->setCellValue('A6', 'Cédula Jurídica 3-101-327473');
		$sheet->getStyle('A6')->applyFromArray($normalStyle);
		$sheet->setCellValue('A8', 'Proyecto: ');
		$sheet->getStyle('A8')->applyFromArray($normalStyle);
		$sheet->getStyle('A8')->applyFromArray($boldStyle);
		$sheet->setCellValue('B8', $proyecto_result['proyecto']['nombre_proyecto']);
		$sheet->getStyle('B8')->applyFromArray($normalStyle);
		$sheet->setCellValue('A9', 'Solicitud de Cotización #: ');
		$sheet->getStyle('A9')->applyFromArray($normalStyle);
		$sheet->getStyle('A9')->applyFromArray($boldStyle);
		$sheet->setCellValue('B9',$proyecto_material_solicitud_cotizacion_id);
		$sheet->getStyle('B9')->applyFromArray($normalStyle);
		$sheet->mergeCells('A11:D11');
		$sheet->setCellValue('A11', 'Solicitud de cotización de materiales');
		$sheet->getStyle('A11')->applyFromArray($sheetTitle);


		$row = 13;

		$sheet->setCellValue('A'.$row, 'Material');
		$sheet->getStyle('A'.$row)->applyFromArray($tableTitle);
		$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
		$sheet->setCellValue('B'.$row, 'Código');
		$sheet->getStyle('B'.$row)->applyFromArray($tableTitle);
		$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
		$sheet->setCellValue('C'.$row, 'Detalle');
		$sheet->getStyle('C'.$row)->applyFromArray($tableTitle);
		$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
		$sheet->setCellValue('D'.$row, 'Cantidad');
		$sheet->getStyle('D'.$row)->applyFromArray($tableTitle);
		$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
		
		$row++;
		$suma_horas = 0;
		$suma_costo = 0;
		foreach($informacion_materiales['datos'] as $kmaterial => $vmaterial){
			$sheet->setCellValue('A'.$row, $vmaterial['material']);
			$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
			$sheet->getStyle('A'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('A'.$row)->applyFromArray($leftAlign);
			$sheet->setCellValue('B'.$row, $vmaterial['material_codigo']);
			$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
			$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);
			$sheet->setCellValue('C'.$row, $vmaterial['comentario']);
			$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
			$sheet->getStyle('C'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('C'.$row)->applyFromArray($leftAlign);
			$sheet->getStyle('C'.$row)->getAlignment()->setWrapText(true);
			$sheet->setCellValue('D'.$row, $vmaterial['cantidad'].' '.$vmaterial['material_unidad']);
			$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
			$sheet->getStyle('D'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('D'.$row)->applyFromArray($leftAlign);
			$row++;
		}


		$sheet->getColumnDimension('A')->setWidth(24);
		$sheet->getColumnDimension('B')->setWidth(14);
		$sheet->getColumnDimension('C')->setWidth(30);
		$sheet->getColumnDimension('D')->setWidth(20);

		

		//Genera el archivo
		$writer = new Xlsx($spreadsheet);
		$dirname = $this->path_archivos.$proyecto_id.'/solicitud_cotizacion';
		$filename = 'Solicitud_Cotizacion_Materiales_Proyecto_'.$proyecto_id.'_'.$proyecto_material_solicitud_cotizacion_id.'_'.date('Y_m_d').'.xlsx';

		if (!file_exists($dirname.'/')) {
	    	mkdir($dirname, 0777,true);
	    }
		$writer->save($dirname.'/'.$filename);

		//Graba en DB
		$archivo = array(
			'url_archivo' => $dirname.'/'.$filename,
			'filename' => $filename,
		);
		$this->m_proyecto->actualizarSolicitudCotizacionMateriales($proyecto_material_solicitud_cotizacion_id, $archivo);

		//Descarga el archivo
		$this->load->helper('download');
		force_download($dirname.'/'.$filename, NULL);

		/*
		// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');

		// It will be called file.xls
		header('Content-Disposition: attachment; filename="'.$filename.'"');

		
		// Write file to the browser
		$writer->save('php://output');*/
	}

	public function editarProveedoresMateriales($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_proveedores', 'edit');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->load->model('m_material');
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					
				}
				$monedas = $this->m_general->getMonedas();				
				if($monedas!==false){
					$this->data['monedas'] = $monedas;
				}

				$proveedores = $this->m_proveedor->getAllActiveProveedores();
				if($proveedores!==false){
					$this->data['proveedores'] = $proveedores;
				}
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Editar lista de materiales';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function verSolicitudesCompraMateriales($proyecto_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_solicitud_compra', 'list');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Solicitudes de compra de materiales';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function consultarSolicitudesCompraMaterialesProyectoAjax() {
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$result_solicitudes = $this->m_proyecto->consultarSolicitudesCompraMaterialesProyecto($proyecto_id);
						
			$result = array(
				'solicitudes_compra_materiales' => $result_solicitudes,
			);
			die(json_encode($result));
    	}
	}

	public function agregarSolicitudCompraMateriales ($proyecto_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_solicitud_compra', 'create');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				// carga datos del proyecto	
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					$result_insert = $this->m_proyecto->agregarSolicitudCompraMateriales($proyecto_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/materiales/'.$proyecto_id.'/solicitudes-compra-materiales/?nuevo=1', 'refresh');
					}else{
						$this->data['msg'][] = $result_insert;
					}
				}

				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Crear solicitud de compra de materiales';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
			
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function editarSolicitudCompraMateriales ($proyecto_id, $solicitud_compra_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_solicitud_compra', 'edit');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				// carga datos del proyecto	
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					$result_insert = $this->m_proyecto->editarSolicitudCompraMateriales($proyecto_id, $solicitud_compra_id, $post_data);
					if($result_insert['tipo']=='success'){
						redirect('/proyectos/materiales/'.$proyecto_id.'/solicitudes-compra-materiales/?editar=1', 'refresh');
					}else{
						$this->data['msg'][] = $result_insert;
					}
				}
				$this->data['solicitud_compra_id'] = $solicitud_compra_id;
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Editar solicitud de compra de materiales';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
			
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function verSolicitudCompraMateriales ($proyecto_id, $solicitud_compra_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_solicitud_compra', 'view');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				// carga datos del proyecto	
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					$result_update = $this->m_proyecto->cambiarEstadoSolicitudCompra($proyecto_id, $solicitud_compra_id, $post_data);
					$this->data['msg'][] = $result_update;
				}
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['estados_solicitud'] = $this->m_proyecto->consultarEstadosSolicitudCompra();
				$this->data['proyecto_material_solicitud_compra'] = $this->m_proyecto->consultarSolicitudCompra($solicitud_compra_id);
				$this->data['solicitud_compra_id'] = $solicitud_compra_id;
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Editar solicitud de compra de materiales';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
			
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function consultarMaterialesRestantesActivosProyectoAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_id = $post_data['proyecto_id'];
			$result_materiales_activos = $this->m_proyecto->consultarMaterialesRestantesActivosProyecto($proyecto_id);
			
			$result_materiales_solicitud = array();
			if (isset($post_data['proyecto_material_solicitud_compra_id'])) {
				$proyecto_material_solicitud_compra_id = $post_data['proyecto_material_solicitud_compra_id'];
				$result_materiales_solicitud = $this->m_proyecto->consultarMaterialesSolicitudCompra($proyecto_material_solicitud_compra_id);
			}
			$result = array(
				'materiales_proyecto_activos' => $result_materiales_activos,
			);

			if (!empty($result_materiales_solicitud)) {
				$result['materiales_solicitud_compra'] = $result_materiales_solicitud;
			}

			die(json_encode($result));
    	}
	}

	public function consultarMaterialesSolicitudCompraProyectoAjax () {
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$proyecto_material_solicitud_compra_id = $post_data['proyecto_material_solicitud_compra_id'];
			$result_materiales_activos = $this->m_proyecto->consultarMaterialesSolicitudCompra($proyecto_material_solicitud_compra_id);
			$result = array();
			if (!empty($result_materiales_activos)) {
				$result['materiales_solicitud_compra'] = $result_materiales_activos;
			}

			die(json_encode($result));
    	}
	}


	/* Para manejo de proformas */

	public function verSolicitudCompraMaterialesProformas ($proyecto_id, $solicitud_compra_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_solicitud_compra_proforma', 'list');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['solicitud_compra_id'] = $solicitud_compra_id;
				$this->data['proforma_estados'] = $this->m_proyecto->consultarProformasEstados();
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Solicitudes de compra de materiales - Proformas';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function consultarProformasSolicitudCompraMaterialesProyectoAjax () {
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_material_solicitud_compra_id = $post_data['proyecto_material_solicitud_compra_id'];
			$result_proformas = $this->m_proyecto->consultarProformasSolicitudMaterialesProyecto($proyecto_material_solicitud_compra_id);
						
			$result = array(
				'proformas' => $result_proformas,
			);
			die(json_encode($result));
    	}
	}

	public function actualizarEstadoProformaAjax() {
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		if (isset($post_data['proyecto_material_solicitud_compra_proforma_id']) && isset($post_data['proyecto_material_solicitud_compra_proforma_estado_id'])) {
				$proyecto_material_solicitud_compra_proforma_id = $post_data['proyecto_material_solicitud_compra_proforma_id'];
				$proyecto_material_solicitud_compra_proforma_estado_id = $post_data['proyecto_material_solicitud_compra_proforma_estado_id'];
				$result_proformas = $this->m_proyecto->actualizarEstadoProforma($proyecto_material_solicitud_compra_proforma_id, $proyecto_material_solicitud_compra_proforma_estado_id);
				if ($result_proformas){
					$result = array('datos' => 
						array(
							'resultado' => true,
							'mensaje' => 'Proforma actualizada con exito',
							)
						);
				} else {
					$result = array('datos' => 
						array(
							'resultado' => false,
							'mensaje' => 'Hubo un error al actualizar la proforma',
							)
						);
				}
				die(json_encode($result));
    		} else {
    			$result = array('datos' => 
					array(
						'resultado' => false,
						'mensaje' => 'Hubo un error al actualizar la proforma',
						)
					);
    			die(json_encode($result));
    		}
    	}
	}

	public function generarSolicitudCompraMaterialesProforma($proyecto_id, $solicitud_compra_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_solicitud_compra_proforma', 'create');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->load->model('m_material');
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					if (isset($post_data['generar_proforma'])) {
						// Busca los materiales 
						$proveedor_id = $post_data['generar_proforma'];
                                                $proyecto_name = $proyecto_result['proyecto']['nombre_proyecto'];
						$info_post = array(
							'vigencia' => $post_data['vigencia'][$proveedor_id],
							'direccion' => $post_data['direccion'][$proveedor_id],
							//'descuento' =>  $post_data['descuento'][$proveedor_id],
							'notas' =>  $post_data['notas'][$proveedor_id],
						);

						$informacion_materiales =  $this->m_proyecto->consultarMaterialesSolicitudCompraPorProveedor($proyecto_id, $solicitud_compra_id, $proveedor_id);
						if ($informacion_materiales['total_rows'] > 0) {
							$this->generarPDFProformaMateriales($proyecto_id, $proyecto_name, $solicitud_compra_id, $proveedor_id, $informacion_materiales, $info_post);
						}
					}
				}

				$proformas_aprobadas = $this->m_proyecto->consultarProformasAprobadas($solicitud_compra_id);
				$materiales_agrupados_por_proveedor =  $this->m_proyecto->consultarMaterialesAgrupadoPorProveedor($solicitud_compra_id);

				if ($proformas_aprobadas) {
					foreach ($materiales_agrupados_por_proveedor as $kmaterial_proveedor => $vmaterial) {
						foreach ($proformas_aprobadas as $korden => $vorden) {
							if($vorden['proveedor_id'] == $kmaterial_proveedor) {
								unset($materiales_agrupados_por_proveedor[$kmaterial_proveedor]);
							}
						}
					}
				}


				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['solicitud_compra_id'] = $solicitud_compra_id;
				$this->data['materiales_proforma'] = $materiales_agrupados_por_proveedor;
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Generar proforma de materiales';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	function generarPDFProformaMateriales($proyecto_id, $proyecto_name, $solicitud_compra_id, $proveedor_id, $informacion_materiales, $info_post){
		$proforma_id = $this->m_proyecto->insertarProformaMateriales($proyecto_id, $solicitud_compra_id, $proveedor_id);
		$info = array(
			'widths' => array(8	, 50, 14,14,14),
			'cols' => array (
				array(
					'nombre' => 'Item',
					'tipo' => 'numeric',
					'align' => 'center'
				),
				array(
					'nombre' => 'Descripción del producto',
					'tipo' => 'long_text',
					'align' => 'left'
				),
				array(
					'nombre' => 'Cantidad',
					'tipo' => 'numeric',
					'align' => 'center'
				),
				array(
					'nombre' => 'Precio de venta',
					'tipo' => 'numeric',
					'align' => 'right'
				),
				array(
					'nombre' => 'Total de línea',
					'tipo' => 'numeric',
					'align' => 'right'
				),
			),
		);

		$info['rows'] = array();
		$contador = 1;
		$descuento_total = 0;
		$impuesto_total = 0;
		$subtotal = 0;
		$total= 0;
		foreach ($informacion_materiales['datos'] as $kmat => $vmat) {
			$descuento_individual = 0;
			$impuesto_individual = 0;
			$info['rows'][] = array(
				$contador, 
				$vmat['material'].' ('.$vmat['material_codigo'].')'.(($vmat['comentario']!==null && $vmat['comentario']!=='')?' -- '.$vmat['comentario']:''),
				$vmat['cantidad_compra'].' '.$vmat['material_unidad'],
				(($vmat['moneda_id'] == 1)?'$':'¢').' '.round($vmat['precio_individual'],2),
				(($vmat['moneda_id'] == 1)?'$':'¢').' '.round($vmat['precio_total_linea'],2),
			);
			$contador++;
			$subtotal += $vmat['precio_total_linea'];
			/*if ($info_post['descuento'] > 0) {
				$descuento_individual = (($vmat['precio_total_linea'] / 100) * str_replace(' ', '',$info_post['descuento']));
			}*/
			if ($vmat['tiene_impuesto'] == 1) {
				//$impuesto_individual += (($vmat['precio_total_linea'] - $descuento_individual) / 100) * str_replace(' ', '',$vmat['impuesto']);
				$impuesto_individual += $vmat['precio_impuesto'];
			}
			//$descuento_total += $descuento_individual;
			$impuesto_total += $impuesto_individual;
			$total += (($vmat['precio_total_linea'] - $descuento_individual) + $impuesto_individual);
		} 
		
		$pdf = $this->generarPDFGeneral('Proforma de materiales - Instatec CR');

		// set font
		$pdf->SetFont('times', 'B', 12);
		$direccion_header = "";
		if (isset($info_post['direccion']) && $info_post['direccion'] !== '') {
			$direccion_header = $info_post['direccion'];
		}
		$pdf->CustomHeaderText = $direccion_header;
		// add a page
		$pdf->AddPage();

		// print a block of text using Write()
		$pdf->Ln(10);
		$pdf->SetFont('times', '', 11);
		$tableTopHTML = '<table width="100%" cellpadding="2" cellspacing="0" border="0">';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td colspan="3"><strong>Proforma de compra de materiales</strong></td>';
		$tableTopHTML .= '<td colspan="2" align="right"><strong>Proforma #'.$proforma_id.'</strong></td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Proveedor: </td>';
		$tableTopHTML .= '<td colspan="2">'.$informacion_materiales['datos'][0]['nombre_proveedor'].'</td>';
		$tableTopHTML .= '<td>Fecha de emisión: </td>';
		$tableTopHTML .= '<td align="right">'.date('d/m/Y').'</td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Teléfono: </td>';
		$tableTopHTML .= '<td colspan="2">'.$informacion_materiales['datos'][0]['telefono_proveedor'].'</td>';
		$tableTopHTML .= '<td>Vigencia: </td>';
		$tableTopHTML .= '<td align="right">'.$info_post['vigencia'].'</td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Correo: </td>';
		$tableTopHTML .= '<td colspan="2">'.$informacion_materiales['datos'][0]['correo_proveedor'].'</td>';
		$tableTopHTML .= '<td>Moneda: </td>';
		$tableTopHTML .= '<td align="right">'.$informacion_materiales['datos'][0]['moneda'].'</td>';
		$tableTopHTML .= '</tr>';
                $tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Proyecto: </td>';
		$tableTopHTML .= '<td colspan="2">'.$proyecto_name.'</td>';
		$tableTopHTML .= '<td></td>';
		$tableTopHTML .= '<td></td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= "</table>";
		$pdf->writeHTML($tableTopHTML);
		


		/*$pdf->Cell(0, 10, 'Proforma de compra de materiales', 1, false, 'L', 0, '', 0, false, 'M', 'M');
		$pdf->Cell(0, 10, 'Proforma #'.$proforma_id, 1, true, 'R', 0, '', 0, false, 'M', 'M');
		$pdf->SetFont('times', '', 12);
		$pdf->Cell(0, 10, 'Proveedor: ', 1, false, 'L', 0, '', 0, false, 'M', 'M');
		$pdf->Cell(0, 10, $informacion_materiales['datos'][0]['nombre_proveedor'], 1, false, 'L', 0, '', 0, false, 'M', 'M');
		$pdf->Cell(0, 10, 'Fecha de emisión: ', 1, false, 'R', 0, '', 0, false, 'M', 'M');
		$pdf->Cell(0, 10, date('d/m/Y'), 1, true,'R', 0, '', 0, false, 'M', 'M');*/


		/*$pdf->Write(0, 'Proforma de compra de materiales', '', 0, 'L', true, 0, false, false, 0);
		$pdf->SetFont('times', 'B', 12);
		$pdf->Write(0, 'Proforma #'.$proforma_id, '', 0, 'R', true, 0, false, false, 0);*/
		$pdf->Ln(10);
		//Si es reporte se usan tablas
		$pdf->SetFont('times', '', 10);

		$tableHTML = "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"1\"><tr>";
		foreach ($info['cols'] as $kcol => $col) {
			$tableHTML .= "<th width=\"".$info['widths'][$kcol]."%\" align=\"center\"><b>".$col['nombre']."</b></th>";
		}
		$tableHTML .= "</tr>";
		foreach ($info['rows'] as $krow => $row) {
			$tableHTML .= "<tr>";
			foreach ($row as $key => $value) {
				$tableHTML .= '<td align="'.$info['cols'][$key]['align'].'">'.$value.'</td>';
				
			}
			$tableHTML .= "</tr>";
		}
		$tableHTML .= "</table>";
		$pdf->writeHTML($tableHTML);
		
		$pdf->Ln(2);

		$tableTotalHTML = "<table width=\"100%\" border=\"0\"><tr><td width=\"72%\"></td><td width=\"28%\">";
		$tableTotalHTML .= "<table align=\"right\" cellpadding=\"4\" cellspacing=\"0\" border=\"1\">";
		$tableTotalHTML .= "<tr><td>Subtotal</td><td align=\"right\">".(($informacion_materiales['datos'][0]['moneda_id'] == 1)?'$ ':'¢ ').round($subtotal,2)."</td></tr>";
		//$tableTotalHTML .= "<tr><td>Descuento (".$info_post['descuento']." %)</td><td align=\"right\">".(($informacion_materiales['datos'][0]['moneda_id'] == 1)?'$ ':'¢ ').round($descuento_total,2)."</td></tr>";
		$tableTotalHTML .= "<tr><td>Impuesto</td><td align=\"right\">".(($informacion_materiales['datos'][0]['moneda_id'] == 1)?'$ ':'¢ ').round($impuesto_total,2)."</td></tr>";
		$tableTotalHTML .= "<tr><td><strong>Total</strong></td><td align=\"right\">".(($informacion_materiales['datos'][0]['moneda_id'] == 1)?'$ ':'¢ ').round($total,2)."</td></tr>";
		$tableTotalHTML .= "</table>";
		$tableTotalHTML .= "</td></tr></table>";
		$pdf->writeHTML($tableTotalHTML);

		$pdf->Ln(10);

		$notasHTML = '<p><strong>NOTAS Y CONDICIONES</strong></p>';
		$notasHTML .= '<table cellpadding="5" cellspacing="0" width="100%" border="1"><tr><td>'.$info_post['notas'].'</td></tr></table>';
		$pdf->writeHTML($notasHTML);
		$pdf->Ln(10);
		$pdf->writeHTML('<hr>');
		$pdf->Ln(20);

		$tableFooterHTML = '<table width="100%" cellpadding="4" cellspacing="0" border="0">';
		$tableFooterHTML .= '<tr>';
		$tableFooterHTML .= '<td>APROBADO POR: </td>';
		$tableFooterHTML .= '<td colspan="2"></td>';
		$tableFooterHTML .= '<td>RECIBIDO POR: </td>';
		$tableFooterHTML .= '<td align="right"></td>';
		$tableFooterHTML .= '</tr>';
		$tableFooterHTML .= "</table>";
		$pdf->writeHTML($tableFooterHTML);

		// ---------------------------------------------------------

		//Close and output PDF document
		//$pdf->Output($filename, 'I');
		$dirname = $this->path_archivos.$proyecto_id.'/proformas';
		$filename = 'Proforma_'.$proforma_id.'_'.str_replace(" ", "_", $informacion_materiales['datos'][0]['nombre_proveedor']).'_'.date('Y_m_d').'.pdf';
		if (!file_exists($dirname.'/')) {
	    	mkdir($dirname, 0777,true);
	    }
		$pdf->Output(FCPATH.$dirname.'/'.$filename, 'FD');
		$archivo = array(
			'url_archivo' => $dirname.'/'.$filename,
			'filename' => $filename,
		);
		$this->m_proyecto->actualizarProformaMateriales($proforma_id, $archivo);

		//Descarga el archivo
		//$this->load->helper('download');
		//force_download($dirname.'/'.$filename, NULL);
	}


	/* Para manejo de ordenes de compra */

	public function verSolicitudCompraMaterialesOrdenesCompra ($proyecto_id, $solicitud_compra_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_solicitud_compra_orden_compra', 'list');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['solicitud_compra_id'] = $solicitud_compra_id;
				$this->data['orden_compra_estados'] = $this->m_proyecto->consultarOrdenesCompraEstados();
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Solicitudes de compra de materiales - Ordenes de compra';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function consultarOrdenesCompraSolicitudCompraMaterialesProyectoAjax () {
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$proyecto_material_solicitud_compra_id = $post_data['proyecto_material_solicitud_compra_id'];
			$result_ordenes_por_proveedores = $this->m_proyecto->consultarOrdenesCompraSolicitudMaterialesProyecto($proyecto_material_solicitud_compra_id);
						
			$result = array(
				'ordenes_compra' => $result_ordenes_por_proveedores,
			);
			die(json_encode($result));
    	}
	}

	public function actualizarEstadoOrdenCompraAjax() {
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		if (isset($post_data['proyecto_material_solicitud_compra_orden_compra_id']) && isset($post_data['proyecto_material_solicitud_compra_orden_compra_estado_id'])) {
    			$proyecto_id = $post_data['proyecto_id'];
				$proyecto_material_solicitud_compra_orden_compra_id = $post_data['proyecto_material_solicitud_compra_orden_compra_id'];
				$proyecto_material_solicitud_compra_orden_compra_estado_id = $post_data['proyecto_material_solicitud_compra_orden_compra_estado_id'];
				$result_ordenes_compra = $this->m_proyecto->actualizarEstadoOrdenCompra($proyecto_id, $proyecto_material_solicitud_compra_orden_compra_id, $proyecto_material_solicitud_compra_orden_compra_estado_id);
				if ($result_ordenes_compra){
					$result = array('datos' => 
						array(
							'resultado' => true,
							'mensaje' => 'Orden de compra actualizada con exito',
							)
						);
				} else {
					$result = array('datos' => 
						array(
							'resultado' => false,
							'mensaje' => 'Hubo un error al actualizar la orden de compra',
							)
						);
				}
				die(json_encode($result));
    		} else {
    			$result = array('datos' => 
					array(
						'resultado' => false,
						'mensaje' => 'Hubo un error al actualizar la orden de compra',
						)
					);
    			die(json_encode($result));
    		}
    	}
	}

	public function generarSolicitudCompraMaterialesOrdenCompra($proyecto_id, $solicitud_compra_id) {
		$acceso = $this->m_general->validarRol($this->router->class.'_materiales_solicitud_compra_orden_compra', 'create');
		if($acceso){
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->load->model('m_material');
				$post_data = $this->input->post(NULL,TRUE);
				if($post_data!=null){
					if (isset($post_data['generar_orden'])) {
						// Busca los materiales 
						$proveedor_id = $post_data['generar_orden'];
                                                $proyecto_name = $proyecto_result['proyecto']['nombre_proyecto'];
						$info_post = array(
							'direccion' => $post_data['direccion'][$proveedor_id],
							//'descuento' =>  $post_data['descuento'][$proveedor_id],
							'notas' =>  $post_data['notas'][$proveedor_id],
						);

						$informacion_materiales =  $this->m_proyecto->consultarMaterialesSolicitudCompraPorProveedor($proyecto_id, $solicitud_compra_id, $proveedor_id);
						if ($informacion_materiales['total_rows'] > 0) {
							$this->generarPDFOrdenCompraMateriales($proyecto_id, $proyecto_name, $solicitud_compra_id, $proveedor_id, $informacion_materiales, $info_post);
						}
					}
				}
				$ordenes_compra_aprobadas = $this->m_proyecto->consultarOrdenesCompraAprobadas($solicitud_compra_id);
				$materiales_agrupados_por_proveedor =  $this->m_proyecto->consultarMaterialesAgrupadoPorProveedor($solicitud_compra_id);

				if ($ordenes_compra_aprobadas) {
					foreach ($materiales_agrupados_por_proveedor as $kmaterial_proveedor => $vmaterial) {
						foreach ($ordenes_compra_aprobadas as $korden => $vorden) {
							if($vorden['proveedor_id'] == $kmaterial_proveedor) {
								unset($materiales_agrupados_por_proveedor[$kmaterial_proveedor]);
							}
						}
					}
				}

				$this->data['proyecto'] = $proyecto_result['proyecto'];
				$this->data['solicitud_compra_id'] = $solicitud_compra_id;
				$this->data['materiales_orden_compra'] = $materiales_agrupados_por_proveedor;
				$this->data['title'] = 'Proyectos - '.$this->data['proyecto']['nombre_proyecto'].' - Generar orden de compra de materiales';
				$this->load->view($this->vista_master, $this->data);
			}else{
				redirect('/proyectos', 'refresh');
			}
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	function generarPDFOrdenCompraMateriales($proyecto_id, $proyecto_name, $solicitud_compra_id, $proveedor_id, $informacion_materiales, $info_post){
		$orden_compra_id = $this->m_proyecto->insertarOrdenCompraMateriales($proyecto_id, $solicitud_compra_id, $proveedor_id);
		$info = array(
			'widths' => array(8	, 50, 14,14,14),
			'cols' => array (
				array(
					'nombre' => 'Item',
					'tipo' => 'numeric',
					'align' => 'center'
				),
				array(
					'nombre' => 'Descripción del producto',
					'tipo' => 'long_text',
					'align' => 'left'
				),
				array(
					'nombre' => 'Cantidad',
					'tipo' => 'numeric',
					'align' => 'center'
				),
				array(
					'nombre' => 'Precio de venta',
					'tipo' => 'numeric',
					'align' => 'right'
				),
				array(
					'nombre' => 'Total de línea',
					'tipo' => 'numeric',
					'align' => 'right'
				),
			),
		);

		$info['rows'] = array();
		$contador = 1;
		$descuento_total = 0;
		$impuesto_total = 0;
		$subtotal = 0;
		$total= 0;
		foreach ($informacion_materiales['datos'] as $kmat => $vmat) {
			$descuento_individual = 0;
			$impuesto_individual = 0;
			$info['rows'][] = array(
				$contador, 
				$vmat['material'].' ('.$vmat['material_codigo'].')'.(($vmat['comentario']!==null && $vmat['comentario']!=='')?' -- '.$vmat['comentario']:''),
				$vmat['cantidad_compra'].' '.$vmat['material_unidad'],
				(($vmat['moneda_id'] == 1)?'$':'¢').' '.round($vmat['precio_individual'],2),
				(($vmat['moneda_id'] == 1)?'$':'¢').' '.round($vmat['precio_total_linea'],2),
			);
			$contador++;
			$subtotal += $vmat['precio_total_linea'];
			/*if ($info_post['descuento'] > 0) {
				$descuento_individual = (($vmat['precio_total_linea'] / 100) * str_replace(' ', '',$info_post['descuento']));
			}*/
			if ($vmat['tiene_impuesto'] == 1) {
				//$impuesto_individual += (($vmat['precio_total_linea'] - $descuento_individual) / 100) * str_replace(' ', '',$vmat['impuesto']);
				$impuesto_individual += $vmat['precio_impuesto'];
			}
			//$descuento_total += $descuento_individual;
			$impuesto_total += $impuesto_individual;
			$total += (($vmat['precio_total_linea'] - $descuento_individual) + $impuesto_individual);
		} 
		
		$pdf = $this->generarPDFGeneral('Orden de compra - Instatec CR');

		// set font
		$pdf->SetFont('times', 'B', 12);
		$direccion_header = "";
		if (isset($info_post['direccion']) && $info_post['direccion'] !== '') {
			$direccion_header = $info_post['direccion'];
		}
		$pdf->CustomHeaderText = $direccion_header;
		// add a page
		$pdf->AddPage();

		// print a block of text using Write()
		$pdf->Ln(10);
		$pdf->SetFont('times', '', 11);
		$tableTopHTML = '<table width="100%" cellpadding="2" cellspacing="0" border="0">';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td colspan="3"><strong>Orden de compra de materiales</strong></td>';
		$tableTopHTML .= '<td colspan="2" align="right"><strong>Orden de compra #'.$orden_compra_id.'</strong></td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Proveedor: </td>';
		$tableTopHTML .= '<td colspan="2">'.$informacion_materiales['datos'][0]['nombre_proveedor'].'</td>';
		$tableTopHTML .= '<td>Fecha de emisión: </td>';
		$tableTopHTML .= '<td align="right">'.date('d/m/Y').'</td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Teléfono: </td>';
		$tableTopHTML .= '<td colspan="2">'.$informacion_materiales['datos'][0]['telefono_proveedor'].'</td>';
		$tableTopHTML .= '<td></td>';
		$tableTopHTML .= '<td align="right"></td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Correo: </td>';
		$tableTopHTML .= '<td colspan="2">'.$informacion_materiales['datos'][0]['correo_proveedor'].'</td>';
		$tableTopHTML .= '<td>Moneda: </td>';
		$tableTopHTML .= '<td align="right">'.$informacion_materiales['datos'][0]['moneda'].'</td>';
		$tableTopHTML .= '</tr>';
                $tableTopHTML .= '<tr>';
		$tableTopHTML .= '<td>Proyecto: </td>';
		$tableTopHTML .= '<td colspan="2">'.$proyecto_name.'</td>';
		$tableTopHTML .= '<td></td>';
		$tableTopHTML .= '<td></td>';
		$tableTopHTML .= '</tr>';
		$tableTopHTML .= "</table>";
		$pdf->writeHTML($tableTopHTML);
		
		$pdf->Ln(10);
		//Si es reporte se usan tablas
		$pdf->SetFont('times', '', 10);

		$tableHTML = "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"1\"><tr>";
		foreach ($info['cols'] as $kcol => $col) {
			$tableHTML .= "<th width=\"".$info['widths'][$kcol]."%\" align=\"center\"><b>".$col['nombre']."</b></th>";
		}
		$tableHTML .= "</tr>";
		foreach ($info['rows'] as $krow => $row) {
			$tableHTML .= "<tr>";
			foreach ($row as $key => $value) {
				$tableHTML .= '<td align="'.$info['cols'][$key]['align'].'">'.$value.'</td>';
				
			}
			$tableHTML .= "</tr>";
		}
		$tableHTML .= "</table>";
		$pdf->writeHTML($tableHTML);
		
		$pdf->Ln(2);

		$tableTotalHTML = "<table width=\"100%\" border=\"0\"><tr><td width=\"72%\"></td><td width=\"28%\">";
		$tableTotalHTML .= "<table align=\"right\" cellpadding=\"4\" cellspacing=\"0\" border=\"1\">";
		$tableTotalHTML .= "<tr><td>Subtotal</td><td align=\"right\">".(($informacion_materiales['datos'][0]['moneda_id'] == 1)?'$ ':'¢ ').round($subtotal,2)."</td></tr>";
		//$tableTotalHTML .= "<tr><td>Descuento (".$info_post['descuento']." %)</td><td align=\"right\">".(($informacion_materiales['datos'][0]['moneda_id'] == 1)?'$ ':'¢ ').round($descuento_total,2)."</td></tr>";
		$tableTotalHTML .= "<tr><td>Impuesto</td><td align=\"right\">".(($informacion_materiales['datos'][0]['moneda_id'] == 1)?'$ ':'¢ ').round($impuesto_total,2)."</td></tr>";
		$tableTotalHTML .= "<tr><td><strong>Total</strong></td><td align=\"right\">".(($informacion_materiales['datos'][0]['moneda_id'] == 1)?'$ ':'¢ ').round($total,2)."</td></tr>";
		$tableTotalHTML .= "</table>";
		$tableTotalHTML .= "</td></tr></table>";
		$pdf->writeHTML($tableTotalHTML);

		$pdf->Ln(10);

		$notasHTML = '<p><strong>NOTAS Y CONDICIONES</strong></p>';
		$notasHTML .= '<table cellpadding="5" cellspacing="0" width="100%" border="1"><tr><td>'.$info_post['notas'].'</td></tr></table>';
		$pdf->writeHTML($notasHTML);
		$pdf->Ln(10);
		$pdf->writeHTML('<hr>');
		$pdf->Ln(20);

		$tableFooterHTML = '<table width="100%" cellpadding="4" cellspacing="0" border="0">';
		$tableFooterHTML .= '<tr>';
		$tableFooterHTML .= '<td>APROBADO POR: </td>';
		$tableFooterHTML .= '<td colspan="2"></td>';
		$tableFooterHTML .= '<td>RECIBIDO POR: </td>';
		$tableFooterHTML .= '<td align="right"></td>';
		$tableFooterHTML .= '</tr>';
		$tableFooterHTML .= "</table>";
		$pdf->writeHTML($tableFooterHTML);

		// ---------------------------------------------------------

		//Close and output PDF document
		//$pdf->Output($filename, 'I');
		$dirname = $this->path_archivos.$proyecto_id.'/ordenes_compra';
		$filename = 'Orden_Compra_'.$orden_compra_id.'_'.str_replace(" ", "_", $informacion_materiales['datos'][0]['nombre_proveedor']).'_'.date('Y_m_d').'.pdf';
		if (!file_exists($dirname.'/')) {
	    	mkdir($dirname, 0777,true);
	    }
		$pdf->Output(FCPATH.$dirname.'/'.$filename, 'FD');
		$archivo = array(
			'url_archivo' => $dirname.'/'.$filename,
			'filename' => $filename,
		);
		$this->m_proyecto->actualizarOrdenCompraMateriales($orden_compra_id, $archivo);

		//Descarga el archivo
		//$this->load->helper('download');
		//force_download($dirname.'/'.$filename, NULL);
	}
	
	/* Para crear solicitud de cotizacion */
	public function generarPDFMateriales($title, $tipo, $info, $filename){
		$pdf = $this->generarPDFGeneral($title);

		// set font
		$pdf->SetFont('times', 'B', 12);

		// add a page
		$pdf->AddPage();

		// set some text to print
		$txt = $title;

		// print a block of text using Write()
		$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
		$pdf->Ln(20);
		if($tipo == 'R'){
			//Si es reporte se usan tablas
			$pdf->SetFont('times', '', 10);

			$tableHTML = "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"1\"><tr>";
			foreach ($info['cols'] as $kcol => $col) {
				$tableHTML .= "<th width=\"".$info['widths'][$kcol]."%\" align=\"center\"><b>".$col['nombre']."</b></th>";
			}
			$tableHTML .= "</tr>";
			foreach ($info['rows'] as $krow => $row) {
				$tableHTML .= "<tr>";
				foreach ($row as $key => $value) {
					$tableHTML .= '<td align="'.$info['cols'][$key]['align'].'">'.$value.'</td>';
					
				}
				$tableHTML .= "</tr>";
			}
			$tableHTML .= "</table>";

			$pdf->writeHTML($tableHTML);

		}


		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output($filename, 'I');

	}

	function generarPDFGeneral($title, $sin_margen = false){
		$this->load->library('pdf');
		$pdf = new $this->pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Arlen Loaiza');
		$pdf->SetTitle($title);
		$pdf->SetSubject($title);
		$pdf->SetKeywords('InstatecCR');

		if($sin_margen) {
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
		}else{
			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			$pdf->SetHeaderMargin(8);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		}

		

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


		// set some language-dependent strings (optional)
		if (@file_exists(APPPATH.'third_party/tcpdf/examples/lang/spa.php')) {
		    require_once(APPPATH.'third_party/tcpdf/examples/lang/spa.php');
		    $pdf->setLanguageArray($l);
		}

		return $pdf;
	}



	function encrypt($input)
	{
		$iv = $this->config->item('iv_encrypt');
		$pass= $this->config->item('pass_encrypt');
		$method = $this->config->item('method_encrypt');
		$output = base64_encode(openssl_encrypt($input, $method, $pass, 0, $iv));
		$output = str_replace("=", "_", $output);
		$output = str_replace("+", "!", $output);
		return $output;
	}

	function decrypt($input)
	{
		$iv = $this->config->item('iv_encrypt');
		$pass= $this->config->item('pass_encrypt');
		$method = $this->config->item('method_encrypt');
		$input = str_replace("_", "=", $input);
		$input = str_replace("!", "+", $input);
		$output = rtrim(openssl_decrypt(base64_decode($input), $method, $pass, 0, $iv ), "\0");
		return $output;
	}
}