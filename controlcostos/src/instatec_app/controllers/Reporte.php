<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Reporte extends CI_Controller {
	
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
			$this->data['title'] = 'Reportes';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function reporteProyectosGeneral(){
		$acceso = $this->m_general->validarRol($this->router->class.'_proyecto_general', 'view');
		if($acceso){
			$post_data = $this->input->post(NULL,TRUE);
			if($post_data!=null){
				if(isset($post_data['proyecto_id'])){
					$proyecto_id = $post_data['proyecto_id'];
					$this->generarReporteProyectoEspecifico($proyecto_id);
				}
			}

			$this->data['title'] = 'Reportes de Proyecto Específico';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function reporteProyectosGeneralAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_proyecto->consultaProyectosReporteAll($post_data);
			die(json_encode($result));
    	}
	}

	public function reporteProyectoEspecifico(){
		$acceso = $this->m_general->validarRol($this->router->class.'_proyecto_especifico', 'view');
		if($acceso){

			$post_data = $this->input->post(NULL,TRUE);
			if($post_data!=null){
				if(isset($post_data['proyecto_id'])){
					$proyecto_id = $post_data['proyecto_id'];
					$this->generarReporteProyectoEspecifico($proyecto_id);
				}
			}

			$this->data['title'] = 'Reportes de Proyecto Específico';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function reporteHorasPorTrabajador(){
		$acceso = $this->m_general->validarRol($this->router->class.'_horas_por_trabajador', 'list');
		if($acceso){
			$this->load->model('m_colaborador');
			$this->data['puestos'] = $this->m_colaborador->consultaAllPuestos();
			$post_data = $this->input->post(NULL,TRUE);
			if($post_data!=null){
				
			}

			$this->data['title'] = 'Reportes de Horas por Trabajador';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function reporteHorasPorTrabajadorDetalle($colaborador_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_horas_por_trabajador', 'view');
		if($acceso){
			$this->load->model('m_colaborador');
			$this->data['puestos'] = $this->m_colaborador->consultaAllPuestos();
				
			$colaborador_result = $this->m_colaborador->consultar($colaborador_id);
			if($colaborador_result!==false){
				$this->data['colaborador'] = $colaborador_result;
			}

			$this->data['title'] = 'Reportes de Horas por Trabajador';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function reporteHorasPorTrabajadorAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_proyecto->consultaHorasLaboradasColaborador($post_data);
			die(json_encode($result));
    	}
	}

	public function reporteHorasPorProyecto(){
		$acceso = $this->m_general->validarRol($this->router->class.'_horas_por_proyecto', 'list');
		if($acceso){
			
			$post_data = $this->input->post(NULL,TRUE);
			if($post_data!=null){
				
			}

			$this->data['title'] = 'Reportes de Horas por Proyecto';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function reporteHorasPorProyectoDetalle($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_horas_por_proyecto', 'view');
		if($acceso){		
				
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result;
			}

			$this->data['title'] = 'Reportes de Horas por Proyecto';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function reporteHorasPorProyectoAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_proyecto->consultaHorasLaboradasProyecto($post_data);
			die(json_encode($result));
    	}
	}

	public function reporteGastosMaterialesPorProyecto(){
		$acceso = $this->m_general->validarRol($this->router->class.'_gastos_materiales_proyectos', 'list');
		if($acceso){
			
			$post_data = $this->input->post(NULL,TRUE);
			if($post_data!=null){
				
			}

			$this->data['title'] = 'Reportes de gastos de materiales por proyecto';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}


	public function reporteGastosMaterialesPorProyectoDetalle($proyecto_id){
		$acceso = $this->m_general->validarRol($this->router->class.'_gastos_materiales_proyectos', 'view');
		if($acceso){		
				
			$proyecto_result = $this->m_proyecto->consultar($proyecto_id);
			if($proyecto_result!==false){
				$this->data['proyecto'] = $proyecto_result;
			}

			$proveedores = $this->m_proveedor->getAllActiveProveedores();
			if($proveedores!==false){
				$this->data['proveedores'] = $proveedores;
			}

			$gasto_estados = $this->m_proyecto->consultarEstadosGastos();
			if($gasto_estados!==false){
				$this->data['gasto_estados'] = $gasto_estados;
			}

			$this->data['title'] = 'Reportes de gastos de materiales por proyecto';
			$this->load->view($this->vista_master, $this->data);
		}else{
			redirect('/acceso-denegado', 'refresh');
		}
	}

	public function reporteGastosMaterialesPorProyectoAjax(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
    		$result = $this->m_proyecto->consultaGastosMaterialesProyecto($post_data);
			die(json_encode($result));
    	}
	}
	

	public function generarReporteHorasPorTrabajador(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		$post_data = array('filtros' => $this->input->get(NULL, TRUE));
		//$this->output->set_content_type('application/json');
		//$post_data = json_decode(file_get_contents("php://input"), true);
		
    	if($post_data!=null){
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
			
			$leftAlign = array(
				'alignment' => array(
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
				),
			);

			$boldStyle = array(
				'font' => array(
					'bold' => true,
					'name'=> 'Arial',
				),
			);
			
			$normalStyle = array(
				'font' => array(
					'name'=> 'Arial',
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

			//Obtiene datos
			$this->load->model('m_colaborador');
			$horas_colaborador= $this->m_proyecto->consultaHorasLaboradasColaborador($post_data);
			$colaborador = $this->m_colaborador->consultar($post_data['filtros']['colaborador_id']);
			
			

			//Crea el objeto de excel
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->mergeCells('A1:F1');
			$sheet->setCellValue('A1', 'Reporte de horas de colaborador');
			$sheet->getStyle('A1')->applyFromArray($sheetTitle);

			$sheet->setCellValue('A3', 'Nombre:');
			$sheet->getStyle('A3')->applyFromArray($boldStyle);
			$sheet->setCellValue('B3', $colaborador['nombre'].' '.$colaborador['apellidos']);
			$sheet->getStyle('B3')->applyFromArray($normalStyle);
			$sheet->getStyle('B3')->applyFromArray($leftAlign);

			$sheet->setCellValue('D3', 'Cédula:');
			$sheet->getStyle('D3')->applyFromArray($boldStyle);
			$sheet->setCellValue('E3', $colaborador['cedula']);
			$sheet->getStyle('E3')->applyFromArray($normalStyle);
			$sheet->getStyle('E3')->applyFromArray($leftAlign);

			$sheet->setCellValue('A4', 'Seguro Social:');
			$sheet->getStyle('A4')->applyFromArray($boldStyle);
			$sheet->setCellValue('B4', $colaborador['seguro_social']);
			$sheet->getStyle('B4')->applyFromArray($normalStyle);
			$sheet->getStyle('B4')->applyFromArray($leftAlign);

			$sheet->setCellValue('D4', 'Id. Interno:');
			$sheet->getStyle('D4')->applyFromArray($boldStyle);
			$sheet->setCellValue('E4', $colaborador['identificador_interno']);
			$sheet->getStyle('E4')->applyFromArray($normalStyle);
			$sheet->getStyle('E4')->applyFromArray($leftAlign);

			$sheet->setCellValue('A5', 'Email:');
			$sheet->getStyle('A5')->applyFromArray($boldStyle);
			$sheet->setCellValue('B5', $colaborador['correo_electronico']	);
			$sheet->getStyle('B5')->applyFromArray($normalStyle);
			$sheet->getStyle('B5')->applyFromArray($leftAlign);

			$sheet->setCellValue('D5', 'Teléfono:');
			$sheet->getStyle('D5')->applyFromArray($boldStyle);
			$sheet->setCellValue('E5', $colaborador['telefono']);
			$sheet->getStyle('E5')->applyFromArray($normalStyle);
			$sheet->getStyle('E5')->applyFromArray($leftAlign);

			if(isset($post_data['filtros']['fecha_gasto_from']) && $post_data['filtros']['fecha_gasto_from']!=='' && isset($post_data['filtros']['fecha_gasto_to']) && $post_data['filtros']['fecha_gasto_to']!==''){
				
				$sheet->setCellValue('A7', 'Desde:');
				$sheet->getStyle('A7')->applyFromArray($boldStyle);
				$sheet->setCellValue('B7', $post_data['filtros']['fecha_gasto_from']);
				$sheet->getStyle('B7')->applyFromArray($normalStyle);
				$sheet->getStyle('B7')->applyFromArray($leftAlign);

				$sheet->setCellValue('D7', 'Hasta:');
				$sheet->getStyle('D7')->applyFromArray($boldStyle);
				$sheet->setCellValue('E7', $post_data['filtros']['fecha_gasto_to']);
				$sheet->getStyle('E7')->applyFromArray($normalStyle);
				$sheet->getStyle('E7')->applyFromArray($leftAlign);
			}



			

			$sheet->setCellValue('A9', 'Proyecto');
			$sheet->getStyle('A9')->applyFromArray($tableTitle);
			$sheet->getStyle('A9')->applyFromArray($borderCell);
			$sheet->setCellValue('B9', 'Fecha');
			$sheet->getStyle('B9')->applyFromArray($tableTitle);
			$sheet->getStyle('B9')->applyFromArray($borderCell);
			$sheet->setCellValue('C9', 'Horas');
			$sheet->getStyle('C9')->applyFromArray($tableTitle);
			$sheet->getStyle('C9')->applyFromArray($borderCell);
			$sheet->setCellValue('D9', 'Horas extras');
			$sheet->getStyle('D9')->applyFromArray($tableTitle);
			$sheet->getStyle('D9')->applyFromArray($borderCell);
			$sheet->setCellValue('E9', 'Costo / hora');
			$sheet->getStyle('E9')->applyFromArray($tableTitle);
			$sheet->getStyle('E9')->applyFromArray($borderCell);
			$sheet->setCellValue('F9', 'Costo');
			$sheet->getStyle('F9')->applyFromArray($tableTitle);
			$sheet->getStyle('F9')->applyFromArray($borderCell);
			$current_position = 10;
			$suma_horas = 0;
			$suma_costo = 0;
			foreach($horas_colaborador['datos'] as $khora => $vhora){
				$sheet->setCellValue('A'.$current_position, $vhora['nombre_proyecto']);
				$sheet->getStyle('A'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('A'.$current_position)->applyFromArray($normalStyle);
				$sheet->setCellValue('B'.$current_position, $vhora['fecha_gasto']);
				$sheet->getStyle('B'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('B'.$current_position)->applyFromArray($normalStyle);
				$sheet->setCellValue('C'.$current_position, $vhora['cantidad_horas'].' h.');
				$sheet->getStyle('C'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('C'.$current_position)->applyFromArray($normalStyle);
				$sheet->setCellValue('D'.$current_position, $vhora['cantidad_horas_extra'].' h.');
				$sheet->getStyle('D'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('D'.$current_position)->applyFromArray($normalStyle);
				$sheet->setCellValue('E'.$current_position, $vhora['costo_hora_mano_obra']);
				$sheet->getStyle('E'.$current_position)->getNumberFormat()->setFormatCode('₡ #,##0.00');
				$sheet->getStyle('E'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('E'.$current_position)->applyFromArray($normalStyle);
				$sheet->getStyle('E'.$current_position)->applyFromArray($leftAlign);
				$sheet->setCellValue('F'.$current_position, (($vhora['costo_hora_mano_obra'] * $vhora['cantidad_horas']) + (($vhora['costo_hora_mano_obra'] * 1.5) * $vhora['cantidad_horas_extra'])));
				$sheet->getStyle('F'.$current_position)->getNumberFormat()->setFormatCode('₡ #,##0.00');
				$sheet->getStyle('F'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('F'.$current_position)->applyFromArray($normalStyle);
				$sheet->getStyle('F'.$current_position)->applyFromArray($leftAlign);
				$current_position++;
				$suma_horas+= ($vhora['cantidad_horas'] + $vhora['cantidad_horas_extra']);
				$suma_costo+= (($vhora['costo_hora_mano_obra'] * $vhora['cantidad_horas']) + (($vhora['costo_hora_mano_obra'] * 1.5) * $vhora['cantidad_horas_extra']));
			}

			$sheet->setCellValue('E'.($current_position+2), 'Total de horas:');
			$sheet->getStyle('E'.($current_position+2))->applyFromArray($borderCell);
			$sheet->getStyle('E'.($current_position+2))->applyFromArray($boldStyle);
			$sheet->setCellValue('F'.($current_position+2), $suma_horas.' h.');
			$sheet->getStyle('F'.($current_position+2))->applyFromArray($borderCell);
			$sheet->getStyle('F'.($current_position+2))->applyFromArray($normalStyle);

			$sheet->setCellValue('E'.($current_position+3), 'Costo total:');
			$sheet->getStyle('E'.($current_position+3))->applyFromArray($borderCell);
			$sheet->getStyle('E'.($current_position+3))->applyFromArray($boldStyle);
			$sheet->setCellValue('F'.($current_position+3), $suma_costo);
			$sheet->getStyle('F'.($current_position+3))->getNumberFormat()->setFormatCode('₡ #,##0.00');
			$sheet->getStyle('F'.($current_position+3))->applyFromArray($borderCell);
			$sheet->getStyle('F'.($current_position+3))->applyFromArray($normalStyle);
			$sheet->getStyle('F'.($current_position+3))->applyFromArray($leftAlign);


			$sheet->getColumnDimension('A')->setWidth(15);
			$sheet->getColumnDimension('B')->setWidth(15);
			$sheet->getColumnDimension('C')->setWidth(15);
			$sheet->getColumnDimension('D')->setWidth(15);
			$sheet->getColumnDimension('E')->setWidth(15);
			$sheet->getColumnDimension('F')->setWidth(15);


			//Genera el archivo
			$writer = new Xlsx($spreadsheet);
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');

			// It will be called file.xls
			header('Content-Disposition: attachment; filename="Reporte_Horas_Colaborador_'.str_replace(' ', '_', $colaborador['nombre'].' '.$colaborador['apellidos']).'_'.date('Y_m_d').'.xlsx"');

			
			// Write file to the browser
			$writer->save('php://output');
    	}
	}

	public function generarReporteHorasPorProyecto(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		$post_data = array('filtros' => $this->input->get(NULL, TRUE));
		//$this->output->set_content_type('application/json');
		//$post_data = json_decode(file_get_contents("php://input"), true);
		//exit(var_export($post_data));
    	if($post_data!=null){
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
			
			$leftAlign = array(
				'alignment' => array(
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
				),
			);

			$boldStyle = array(
				'font' => array(
					'bold' => true,
					'name'=> 'Arial',
				),
			);
			
			$normalStyle = array(
				'font' => array(
					'name'=> 'Arial',
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

			//Obtiene datos
			$horas_proyecto= $this->m_proyecto->consultaHorasLaboradasProyecto($post_data);
			$proyecto = $this->m_proyecto->consultar($post_data['filtros']['proyecto_id']);
			
			

			//Crea el objeto de excel
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->mergeCells('A1:E1');
			$sheet->setCellValue('A1', 'Reporte de horas de proyecto');
			$sheet->getStyle('A1')->applyFromArray($sheetTitle);

			$sheet->setCellValue('A3', 'Nombre:');
			$sheet->getStyle('A3')->applyFromArray($boldStyle);
			$sheet->setCellValue('B3', $proyecto['proyecto']['nombre_proyecto']);
			$sheet->getStyle('B3')->applyFromArray($normalStyle);
			$sheet->getStyle('B3')->applyFromArray($leftAlign);

			$sheet->setCellValue('D3', 'Jefe de proyecto:');
			$sheet->getStyle('D3')->applyFromArray($boldStyle);
			$sheet->setCellValue('E3', $proyecto['proyecto']['nombre'] . ' ' . $proyecto['proyecto']['apellidos']);
			$sheet->getStyle('E3')->applyFromArray($normalStyle);
			$sheet->getStyle('E3')->applyFromArray($leftAlign);

			$sheet->setCellValue('A4', 'N° contrato:');
			$sheet->getStyle('A4')->applyFromArray($boldStyle);
			$sheet->setCellValue('B4', $proyecto['proyecto']['numero_contrato']);
			$sheet->getStyle('B4')->applyFromArray($normalStyle);
			$sheet->getStyle('B4')->applyFromArray($leftAlign);

			$sheet->setCellValue('D4', 'Ord. Compra:');
			$sheet->getStyle('D4')->applyFromArray($boldStyle);
			$sheet->setCellValue('E4', $proyecto['proyecto']['orden_compra']);
			$sheet->getStyle('E4')->applyFromArray($normalStyle);
			$sheet->getStyle('E4')->applyFromArray($leftAlign);

			$sheet->setCellValue('A5', 'Cliente:');
			$sheet->getStyle('A5')->applyFromArray($boldStyle);
			$sheet->setCellValue('B5', $proyecto['proyecto']['nombre_cliente']);
			$sheet->getStyle('B5')->applyFromArray($normalStyle);
			$sheet->getStyle('B5')->applyFromArray($leftAlign);

			$sheet->setCellValue('D5', 'Fecha contrato:');
			$sheet->getStyle('D5')->applyFromArray($boldStyle);
			$sheet->setCellValue('E5', $proyecto['proyecto']['fecha_firma_contrato']);
			$sheet->getStyle('E5')->applyFromArray($normalStyle);
			$sheet->getStyle('E5')->applyFromArray($leftAlign);

			$sheet->setCellValue('A6', 'Fecha inicio:');
			$sheet->getStyle('A6')->applyFromArray($boldStyle);
			$sheet->setCellValue('B6', $proyecto['proyecto']['fecha_inicio']);
			$sheet->getStyle('B6')->applyFromArray($normalStyle);
			$sheet->getStyle('B6')->applyFromArray($leftAlign);

			$sheet->setCellValue('D6', 'Fecha entrega:');
			$sheet->getStyle('D6')->applyFromArray($boldStyle);
			$sheet->setCellValue('E6', $proyecto['proyecto']['fecha_entrega_estimada']);
			$sheet->getStyle('E6')->applyFromArray($normalStyle);
			$sheet->getStyle('E6')->applyFromArray($leftAlign);

			if(isset($post_data['filtros']['fecha_gasto_from']) && $post_data['filtros']['fecha_gasto_from']!=='' && isset($post_data['filtros']['fecha_gasto_to']) && $post_data['filtros']['fecha_gasto_to']!==''){
				
				$sheet->setCellValue('A8', 'Desde:');
				$sheet->getStyle('A8')->applyFromArray($boldStyle);
				$sheet->setCellValue('B8', $post_data['filtros']['fecha_gasto_from']);
				$sheet->getStyle('B8')->applyFromArray($normalStyle);
				$sheet->getStyle('B8')->applyFromArray($leftAlign);

				$sheet->setCellValue('D8', 'Hasta:');
				$sheet->getStyle('D8')->applyFromArray($boldStyle);
				$sheet->setCellValue('E8', $post_data['filtros']['fecha_gasto_to']);
				$sheet->getStyle('E8')->applyFromArray($normalStyle);
				$sheet->getStyle('E8')->applyFromArray($leftAlign);
			}



			
			
			if($post_data['filtros']['group_by']=='dia'){
				$sheet->mergeCells('A10:B10');
				$sheet->setCellValue('A10', 'Fecha');
				$sheet->getStyle('A10')->applyFromArray($tableTitle);
				$sheet->getStyle('A10')->applyFromArray($borderCell);
				$sheet->getStyle('B10')->applyFromArray($tableTitle);
				$sheet->getStyle('B10')->applyFromArray($borderCell);
				$sheet->setCellValue('C10', 'Horas');
				$sheet->getStyle('C10')->applyFromArray($tableTitle);
				$sheet->getStyle('C10')->applyFromArray($borderCell);
				$sheet->setCellValue('D10', 'Horas extras');
				$sheet->getStyle('D10')->applyFromArray($tableTitle);
				$sheet->getStyle('D10')->applyFromArray($borderCell);
				$sheet->setCellValue('E10', 'Costo');
				$sheet->getStyle('E10')->applyFromArray($tableTitle);
				$sheet->getStyle('E10')->applyFromArray($borderCell);
			}else if($post_data['filtros']['group_by']=='colaborador'){
				$sheet->mergeCells('A10:B10');
				$sheet->setCellValue('A10', 'Colaborador');	
				$sheet->getStyle('A10')->applyFromArray($tableTitle);
				$sheet->getStyle('A10')->applyFromArray($borderCell);
				$sheet->getStyle('B10')->applyFromArray($tableTitle);
				$sheet->getStyle('B10')->applyFromArray($borderCell);
				$sheet->setCellValue('C10', 'Horas');
				$sheet->getStyle('C10')->applyFromArray($tableTitle);
				$sheet->getStyle('C10')->applyFromArray($borderCell);
				$sheet->setCellValue('D10', 'Horas extras');
				$sheet->getStyle('D10')->applyFromArray($tableTitle);
				$sheet->getStyle('D10')->applyFromArray($borderCell);
				$sheet->setCellValue('E10', 'Costo');
				$sheet->getStyle('E10')->applyFromArray($tableTitle);
				$sheet->getStyle('E10')->applyFromArray($borderCell);			
			}else if($post_data['filtros']['group_by']=='none'){
				$sheet->setCellValue('A10', 'Colaborador');	
				$sheet->getStyle('A10')->applyFromArray($tableTitle);
				$sheet->getStyle('A10')->applyFromArray($borderCell);
				$sheet->setCellValue('B10', 'Fecha');
				$sheet->getStyle('B10')->applyFromArray($tableTitle);
				$sheet->getStyle('B10')->applyFromArray($borderCell);
				$sheet->setCellValue('C10', 'Horas');
				$sheet->getStyle('C10')->applyFromArray($tableTitle);
				$sheet->getStyle('C10')->applyFromArray($borderCell);
				$sheet->setCellValue('D10', 'Horas extras');
				$sheet->getStyle('D10')->applyFromArray($tableTitle);
				$sheet->getStyle('D10')->applyFromArray($borderCell);
				$sheet->setCellValue('E10', 'Costo / hora');
				$sheet->getStyle('E10')->applyFromArray($tableTitle);
				$sheet->getStyle('E10')->applyFromArray($borderCell);
				$sheet->setCellValue('F10', 'Costo total');
				$sheet->getStyle('F10')->applyFromArray($tableTitle);
				$sheet->getStyle('F10')->applyFromArray($borderCell);
			}
			
			$current_position = 11;
			$suma_horas = 0;
			$suma_costo = 0;
			foreach($horas_proyecto['datos'] as $khora => $vhora){
				if($post_data['filtros']['group_by']=='dia'){
					$sheet->mergeCells('A'.$current_position.':B'.$current_position);
					$sheet->setCellValue('A'.$current_position, $vhora['fecha_gasto']);
					$sheet->getStyle('A'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('A'.$current_position)->applyFromArray($normalStyle);
					$sheet->getStyle('B'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('B'.$current_position)->applyFromArray($normalStyle);					
					$sheet->setCellValue('C'.$current_position, $vhora['total_horas'].' h.');
					$sheet->getStyle('C'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('C'.$current_position)->applyFromArray($normalStyle);
					$sheet->setCellValue('D'.$current_position, $vhora['total_horas_extra'].' h.');
					$sheet->getStyle('D'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('D'.$current_position)->applyFromArray($normalStyle);
					$sheet->setCellValue('E'.$current_position, $vhora['total_costo']);
					$sheet->getStyle('E'.$current_position)->getNumberFormat()->setFormatCode('₡ #,##0.00');
					$sheet->getStyle('E'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('E'.$current_position)->applyFromArray($normalStyle);
					$sheet->getStyle('E'.$current_position)->applyFromArray($leftAlign);
					$suma_horas+= ($vhora['total_horas'] + $vhora['total_horas_extra']);
					$suma_costo+= $vhora['total_costo'];
				}else if($post_data['filtros']['group_by']=='colaborador'){
					$sheet->mergeCells('A'.$current_position.':B'.$current_position);
					$sheet->setCellValue('A'.$current_position, $vhora['nombre']);
					$sheet->getStyle('A'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('A'.$current_position)->applyFromArray($normalStyle);
					$sheet->getStyle('B'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('B'.$current_position)->applyFromArray($normalStyle);					
					$sheet->setCellValue('C'.$current_position, $vhora['total_horas'].' h.');
					$sheet->getStyle('C'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('C'.$current_position)->applyFromArray($normalStyle);
					$sheet->setCellValue('D'.$current_position, $vhora['total_horas_extra'].' h.');
					$sheet->getStyle('D'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('D'.$current_position)->applyFromArray($normalStyle);
					$sheet->setCellValue('E'.$current_position, $vhora['total_costo']);
					$sheet->getStyle('E'.$current_position)->getNumberFormat()->setFormatCode('₡ #,##0.00');
					$sheet->getStyle('E'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('E'.$current_position)->applyFromArray($normalStyle);
					$sheet->getStyle('E'.$current_position)->applyFromArray($leftAlign);
					$suma_horas+= ($vhora['total_horas'] + $vhora['total_horas_extra']);
					$suma_costo+= $vhora['total_costo'];
				}else if($post_data['filtros']['group_by']=='none'){
					$sheet->setCellValue('A'.$current_position, $vhora['nombre'].' '.$vhora['apellidos']);
					$sheet->getStyle('A'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('A'.$current_position)->applyFromArray($normalStyle);
					$sheet->setCellValue('B'.$current_position, $vhora['fecha_gasto']);
					$sheet->getStyle('B'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('B'.$current_position)->applyFromArray($normalStyle);					
					$sheet->setCellValue('C'.$current_position, $vhora['cantidad_horas'].' h.');
					$sheet->getStyle('C'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('C'.$current_position)->applyFromArray($normalStyle);
					$sheet->setCellValue('D'.$current_position, $vhora['cantidad_horas_extra'].' h.');
					$sheet->getStyle('D'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('D'.$current_position)->applyFromArray($normalStyle);
					$sheet->setCellValue('E'.$current_position, $vhora['costo_hora_mano_obra']);
					$sheet->getStyle('E'.$current_position)->getNumberFormat()->setFormatCode('₡ #,##0.00');
					$sheet->getStyle('E'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('E'.$current_position)->applyFromArray($normalStyle);
					$sheet->getStyle('E'.$current_position)->applyFromArray($leftAlign);
					$sheet->setCellValue('F'.$current_position, ($vhora['cantidad_horas']*$vhora['costo_hora_mano_obra'])+($vhora['cantidad_horas_extra']*($vhora['costo_hora_mano_obra']*1.5)));
					$sheet->getStyle('F'.$current_position)->getNumberFormat()->setFormatCode('₡ #,##0.00');
					$sheet->getStyle('F'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('F'.$current_position)->applyFromArray($normalStyle);
					$sheet->getStyle('F'.$current_position)->applyFromArray($leftAlign);
					$suma_horas+= ($vhora['cantidad_horas'] + $vhora['cantidad_horas_extra']);
					$suma_costo+= ($vhora['cantidad_horas']*$vhora['costo_hora_mano_obra'])+($vhora['cantidad_horas_extra']*($vhora['costo_hora_mano_obra']*1.5));
				}
				
				$current_position++;
			}

			$letra1='E';
			$letra2='F';
			if($post_data['filtros']['group_by']=='dia' || $post_data['filtros']['group_by']=='colaborador'){
				$letra1='D';
				$letra2='E';
			}
			$sheet->setCellValue($letra1.($current_position+2), 'Total de horas:');
			$sheet->getStyle($letra1.($current_position+2))->applyFromArray($borderCell);
			$sheet->getStyle($letra1.($current_position+2))->applyFromArray($boldStyle);
			$sheet->setCellValue($letra2.($current_position+2), $suma_horas.' h.');
			$sheet->getStyle($letra2.($current_position+2))->applyFromArray($borderCell);
			$sheet->getStyle($letra2.($current_position+2))->applyFromArray($normalStyle);

			$sheet->setCellValue($letra1.($current_position+3), 'Costo total:');
			$sheet->getStyle($letra1.($current_position+3))->applyFromArray($borderCell);
			$sheet->getStyle($letra1.($current_position+3))->applyFromArray($boldStyle);
			$sheet->setCellValue($letra2.($current_position+3), $suma_costo);
			$sheet->getStyle($letra2.($current_position+3))->getNumberFormat()->setFormatCode('₡ #,##0.00');
			$sheet->getStyle($letra2.($current_position+3))->applyFromArray($borderCell);
			$sheet->getStyle($letra2.($current_position+3))->applyFromArray($normalStyle);
			$sheet->getStyle($letra2.($current_position+3))->applyFromArray($leftAlign);

			if($post_data['filtros']['group_by']=='dia' || $post_data['filtros']['group_by']=='colaborador'){
				$sheet->getColumnDimension('A')->setWidth(18);
				$sheet->getColumnDimension('B')->setWidth(18);
				$sheet->getColumnDimension('C')->setWidth(18);
				$sheet->getColumnDimension('D')->setWidth(18);
				$sheet->getColumnDimension('E')->setWidth(18);
			}else{
				$sheet->getColumnDimension('A')->setWidth(15);
				$sheet->getColumnDimension('B')->setWidth(15);
				$sheet->getColumnDimension('C')->setWidth(15);
				$sheet->getColumnDimension('D')->setWidth(15);
				$sheet->getColumnDimension('E')->setWidth(15);
				$sheet->getColumnDimension('F')->setWidth(15);
			}

			//Genera el archivo
			$writer = new Xlsx($spreadsheet);
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');

			// It will be called file.xls
			header('Content-Disposition: attachment; filename="Reporte_Horas_Proyecto_'.str_replace(' ', '_', $proyecto['proyecto']['nombre_proyecto']).'_'.date('Y_m_d').'.xlsx"');

			
			// Write file to the browser
			$writer->save('php://output');
    	}
	}



	public function generarReporteProyectoEspecifico($proyecto_id){
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
		
		$normalStyle = array(
	    	'font' => array(
				'name'=> 'Arial',
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

	    //Obtiene datos
		$datos_proyecto = $this->m_proyecto->consultaInfoProyecto(array('proyecto_id'=>$proyecto_id));
		$proyecto = $this->m_proyecto->consultar($proyecto_id);	
		//exit(var_export($proyecto['valor_oferta']));

		//Crea el objeto de excel
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$sheet->mergeCells('A1:E1');
		$sheet->setCellValue('A1', 'Reporte general de proyecto');
		$sheet->getStyle('A1')->applyFromArray($sheetTitle);

		//Carga los datos del proyecto en las primeras celdas
		if($proyecto['proyecto']['nombre_proyecto']!=null){
			$sheet->setCellValue('A3', 'Nombre de proyecto:');
			$sheet->getStyle('A3')->applyFromArray($boldStyle);
			$sheet->setCellValue('B3', $proyecto['proyecto']['nombre_proyecto']);
			$sheet->getStyle('B3')->applyFromArray($normalStyle);
		}

		if($proyecto['proyecto']['nombre_cliente']!=null){
			$sheet->setCellValue('A4', 'Cliente de proyecto:');
			$sheet->getStyle('A4')->applyFromArray($boldStyle);
			$sheet->setCellValue('B4', $proyecto['proyecto']['nombre_cliente']);
			$sheet->getStyle('B4')->applyFromArray($normalStyle);
		}

		if($proyecto['proyecto']['proyecto_estado']!=null){
			$sheet->setCellValue('A5', 'Estado de proyecto:');
			$sheet->getStyle('A5')->applyFromArray($boldStyle);
			$sheet->setCellValue('B5', $proyecto['proyecto']['proyecto_estado']);
			$sheet->getStyle('B5')->applyFromArray($normalStyle);
		}
		


		//Carga los valores de la oferta
		$valor_oferta_totales = array();
		$total_valor_oferta = 0;
		if(isset($proyecto['valor_oferta']) && !empty($proyecto['valor_oferta'])){
			//Saca sumatorias
			foreach ($proyecto['valor_oferta'] as $kvalor => $vvalor) {
				$valor_oferta_totales[$vvalor['proyecto_valor_oferta_tipo_id']]['tipo'] = $vvalor['proyecto_valor_oferta_tipo'];
				if(!isset($valor_oferta_totales[$vvalor['proyecto_valor_oferta_tipo_id']]['valor'])){
					$valor_oferta_totales[$vvalor['proyecto_valor_oferta_tipo_id']]['valor']  = (double)0;
				}
				$valor_oferta_totales[$vvalor['proyecto_valor_oferta_tipo_id']]['valor']  += (double)$vvalor['valor_oferta'];
				$total_valor_oferta+= (double)$vvalor['valor_oferta'];
			}


			$sheet->mergeCells('A12:B12');
			$sheet->setCellValue('A12', 'Valor de la oferta');
			$sheet->getStyle('A12')->applyFromArray($tableTitle);
			$sheet->getStyle('A12')->applyFromArray($borderCell);
			$sheet->getStyle('B12')->applyFromArray($borderCell);
			$sheet->setCellValue('A13', 'Tipo');
			$sheet->getStyle('A13')->applyFromArray($tableTitle);
			$sheet->getStyle('A13')->applyFromArray($borderCell);
			$sheet->setCellValue('B13', 'Valor');
			$sheet->getStyle('B13')->applyFromArray($tableTitle);
			$sheet->getStyle('B13')->applyFromArray($borderCell);
			$current_position = 14;
			foreach ($valor_oferta_totales as $kvalor => $vvalor) {
				$sheet->setCellValue('A'.$current_position, str_replace('Valor de ', '', $vvalor['tipo']));
				$sheet->getStyle('A'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('A'.$current_position)->applyFromArray($normalStyle);
				$sheet->setCellValue('B'.$current_position, $vvalor['valor']);
				$sheet->getStyle('B'.$current_position)->getNumberFormat()->setFormatCode('$ #,##0.00');
				$sheet->getStyle('B'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('B'.$current_position)->applyFromArray($normalStyle);
				$current_position++;
			}
		}

		//Carga los gastos 
		$gastos_totales = array();
		$total_gastos = 0;
		if(isset($proyecto['gastos']) && !empty($proyecto['gastos'])){
			//Saca sumatorias
			foreach ($proyecto['gastos'] as $kgasto => $vgasto) {
				$gastos_totales[$vgasto['proyecto_gasto_tipo_id']]['tipo'] = $vgasto['proyecto_gasto_tipo'];
				if(!isset($gastos_totales[$vgasto['proyecto_gasto_tipo_id']]['valor'])){
					$gastos_totales[$vgasto['proyecto_gasto_tipo_id']]['valor']  = (double)0;
				}
				$monto_gasto = (double)$vgasto['proyecto_gasto_monto'];
				if($vgasto['moneda_id']==2){
					$proyecto_tipo_cambio_venta = (double)$proyecto['tipo_cambio']['valor_venta'];							
					$monto_gasto = $monto_gasto / $proyecto_tipo_cambio_venta;
				}
				$gastos_totales[$vgasto['proyecto_gasto_tipo_id']]['valor']  += (double)round($monto_gasto,2);
				$total_gastos+=(double)round($monto_gasto,2);
			}


			$sheet->mergeCells('D12:E12');
			$sheet->setCellValue('D12', 'Gastos');
			$sheet->getStyle('D12')->applyFromArray($tableTitle);
			$sheet->getStyle('D12')->applyFromArray($borderCell);
			$sheet->getStyle('E12')->applyFromArray($borderCell);
			$sheet->setCellValue('D13', 'Tipo');
			$sheet->getStyle('D13')->applyFromArray($tableTitle);
			$sheet->getStyle('D13')->applyFromArray($borderCell);
			$sheet->setCellValue('E13', 'Valor');
			$sheet->getStyle('E13')->applyFromArray($tableTitle);
			$sheet->getStyle('E13')->applyFromArray($borderCell);
			$current_position = 14;
			foreach ($gastos_totales as $kgasto => $vgasto) {
				$sheet->setCellValue('D'.$current_position, str_replace('Gasto ', '', str_replace('de ', '', str_replace('en ', '',$vgasto['tipo']))));
				$sheet->getStyle('D'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('D'.$current_position)->applyFromArray($normalStyle);
				$sheet->setCellValue('E'.$current_position, $vgasto['valor']);
				$sheet->getStyle('E'.$current_position)->getNumberFormat()->setFormatCode('$ #,##0.00');
				$sheet->getStyle('E'.$current_position)->applyFromArray($borderCell);
				$sheet->getStyle('E'.$current_position)->applyFromArray($normalStyle);
				$current_position++;
			}
		}


		//Carga la Valor no consumido 
		if(isset($valor_oferta_totales) && !empty($valor_oferta_totales) || isset($gastos_totales) && !empty($gastos_totales)){
			$sheet->mergeCells('A22:B22');
			$sheet->setCellValue('A22', 'Saldo');
			$sheet->getStyle('A22')->applyFromArray($tableTitle);
			$sheet->getStyle('A22')->applyFromArray($borderCell);
			$sheet->getStyle('B22')->applyFromArray($borderCell);
			$sheet->setCellValue('A23', 'Tipo');
			$sheet->getStyle('A23')->applyFromArray($tableTitle);			
			$sheet->getStyle('A23')->applyFromArray($borderCell);
			$sheet->setCellValue('B23', 'Valor');
			$sheet->getStyle('B23')->applyFromArray($tableTitle);
			$sheet->getStyle('B23')->applyFromArray($borderCell);
			$current_position = 24;
			foreach ($valor_oferta_totales as $kvalor => $vvalor) {
				if($kvalor!=5 && $kvalor!=6){
					$gasto_correspondiente = 0;
					if(isset($gastos_totales[$kvalor]['valor']) && $gastos_totales[$kvalor]['valor']!=null){
						$gasto_correspondiente = $gastos_totales[$kvalor]['valor'];
					}
					$sheet->setCellValue('A'.$current_position, str_replace('Valor de ', '', $vvalor['tipo']));
					$sheet->getStyle('A'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('A'.$current_position)->applyFromArray($normalStyle);
					$sheet->setCellValue('B'.$current_position,($vvalor['valor']-$gasto_correspondiente));
					$sheet->getStyle('B'.$current_position)->getNumberFormat()->setFormatCode('$ #,##0.00');
					$sheet->getStyle('B'.$current_position)->applyFromArray($borderCell);
					$sheet->getStyle('B'.$current_position)->applyFromArray($normalStyle);
					$current_position++;
				}
			}

			// Muestra total de valor de oferta
			$sheet->setCellValue('A6', 'Valor total de la oferta:');
			$sheet->getStyle('A6')->applyFromArray($boldStyle);
			$sheet->setCellValue('B6', ($total_valor_oferta));
			$sheet->getStyle('B6')->applyFromArray($normalStyle);
			$sheet->getStyle('B6')->getNumberFormat()->setFormatCode('$ #,##0.00');

			// Muestra total de gastos
			$sheet->setCellValue('A7', 'Gastos totales:');
			$sheet->getStyle('A7')->applyFromArray($boldStyle);
			$sheet->setCellValue('B7', ($total_gastos));
			$sheet->getStyle('B7')->applyFromArray($normalStyle);
			$sheet->getStyle('B7')->getNumberFormat()->setFormatCode('$ #,##0.00');

			// Muestra total de utilidad
			$sheet->setCellValue('A8', 'Utilidad actual:');
			$sheet->getStyle('A8')->applyFromArray($boldStyle);
			$sheet->setCellValue('B8', ($total_valor_oferta-$total_gastos));
			$sheet->getStyle('B8')->applyFromArray($normalStyle);
			$sheet->getStyle('B8')->getNumberFormat()->setFormatCode('$ #,##0.00');
		}


		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);


		//Genera el archivo
		$writer = new Xlsx($spreadsheet);
		// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');

		// It will be called file.xls
		header('Content-Disposition: attachment; filename="Reporte_Proyecto_'.str_replace(' ', '_', $proyecto['proyecto']['nombre_proyecto']).'_'.date('Y_m_d').'.xlsx"');

		
		// Write file to the browser
		$writer->save('php://output');
	}


	public function generarReporteProyectosGeneral(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		$post_data = array('filtros' => $this->input->get(NULL, TRUE));
		//$this->output->set_content_type('application/json');
		//$post_data = json_decode(file_get_contents("php://input"), true);
		;
    	if($post_data!=null){
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
			
			$leftAlign = array(
				'alignment' => array(
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
				),
			);

			$boldStyle = array(
				'font' => array(
					'bold' => true,
					'name'=> 'Arial',
				),
			);
			
			$normalStyle = array(
				'font' => array(
					'name'=> 'Arial',
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

			//Obtiene datos
			$result = $this->m_proyecto->consultaProyectosReporteAll($post_data);
			
			

			//Crea el objeto de excel
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->mergeCells('A1:E1');
			$sheet->setCellValue('A1', 'Reporte de Proyectos General');
			$sheet->getStyle('A1')->applyFromArray($sheetTitle);

			$first_col = true;
			$row = 3;
			if(isset($post_data['filtros']['cliente_id']) && $post_data['filtros']['cliente_id']!=='' && $post_data['filtros']['cliente_id']!=='all'){
				if($first_col){
					$letra_col = 'A';
					$letra_val = 'B';
				}else{
					$letra_col = 'D';
					$letra_val = 'E';
				}
				$sheet->setCellValue($letra_col.$row, 'Cliente:');
				$sheet->getStyle($letra_col.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue($letra_val.$row, $result['datos'][0]['nombre_cliente']);
				$sheet->getStyle($letra_val.$row)->applyFromArray($normalStyle);
				$sheet->getStyle($letra_val.$row)->applyFromArray($leftAlign);

				if(!$first_col){
					$row++;
					$first_col = true;
				}else{
					$first_col = false;
				}
			}

			if(isset($post_data['filtros']['provincia_id']) && $post_data['filtros']['provincia_id']!=='' && $post_data['filtros']['provincia_id']!=='all'){
				if($first_col){
					$letra_col = 'A';
					$letra_val = 'B';
				}else{
					$letra_col = 'D';
					$letra_val = 'E';
				}
				$sheet->setCellValue($letra_col.$row, 'Provincia:');
				$sheet->getStyle($letra_col.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue($letra_val.$row, $result['datos'][0]['provincia']);
				$sheet->getStyle($letra_val.$row)->applyFromArray($normalStyle);
				$sheet->getStyle($letra_val.$row)->applyFromArray($leftAlign);
				
				if(!$first_col){
					$row++;
					$first_col = true;
				}else{
					$first_col = false;
				}
			}

			if(isset($post_data['filtros']['canton_id']) && $post_data['filtros']['canton_id']!=='' && $post_data['filtros']['canton_id']!=='all'){
				if($first_col){
					$letra_col = 'A';
					$letra_val = 'B';
				}else{
					$letra_col = 'D';
					$letra_val = 'E';
				}
				$sheet->setCellValue($letra_col.$row, 'Cantón:');
				$sheet->getStyle($letra_col.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue($letra_val.$row, $result['datos'][0]['canton']);
				$sheet->getStyle($letra_val.$row)->applyFromArray($normalStyle);
				$sheet->getStyle($letra_val.$row)->applyFromArray($leftAlign);	
				
				if(!$first_col){
					$row++;
					$first_col = true;
				}else{
					$first_col = false;
				}
			}	

			if(isset($post_data['filtros']['distrito_id']) && $post_data['filtros']['distrito_id']!=='' && $post_data['filtros']['distrito_id']!=='all'){
				if($first_col){
					$letra_col = 'A';
					$letra_val = 'B';
				}else{
					$letra_col = 'D';
					$letra_val = 'E';
				}
				$sheet->setCellValue($letra_col.$row, 'Distrito:');
				$sheet->getStyle($letra_col.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue($letra_val.$row, $result['datos'][0]['distrito']);
				$sheet->getStyle($letra_val.$row)->applyFromArray($normalStyle);
				$sheet->getStyle($letra_val.$row)->applyFromArray($leftAlign);

				if(!$first_col){
					$row++;
					$first_col = true;
				}else{
					$first_col = false;
				}
			}
			if(isset($post_data['filtros']['proyecto_estado_id']) && $post_data['filtros']['proyecto_estado_id']!=='' && $post_data['filtros']['proyecto_estado_id']!=='all'){
				if($first_col){
					$letra_col = 'A';
					$letra_val = 'B';
				}else{
					$letra_col = 'D';
					$letra_val = 'E';
				}

				$sheet->setCellValue($letra_col.$row, 'Estado de proyecto:');
				$sheet->getStyle($letra_col.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue($letra_val.$row, $result['datos'][0]['proyecto_estado']	);
				$sheet->getStyle($letra_val.$row)->applyFromArray($normalStyle);
				$sheet->getStyle($letra_val.$row)->applyFromArray($leftAlign);

				if(!$first_col){
					$row++;
					$first_col = true;
				}else{
					$first_col = false;
				}
			}

			if(isset($post_data['filtros']['fecha_registro_from']) && $post_data['filtros']['fecha_registro_from']!=='' && isset($post_data['filtros']['fecha_registro_to']) && $post_data['filtros']['fecha_registro_to']!==''){
				$row++;
				
				$sheet->setCellValue('A'.$row, 'F. Registro desde:');
				$sheet->getStyle('A'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('B'.$row, $post_data['filtros']['fecha_registro_from']);
				$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);

				$sheet->setCellValue('D'.$row, 'Hasta:');
				$sheet->getStyle('D'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('E'.$row, $post_data['filtros']['fecha_registro_to']);
				$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);
			}

			if(isset($post_data['filtros']['fecha_firma_contrato_from']) && $post_data['filtros']['fecha_firma_contrato_from']!=='' && isset($post_data['filtros']['fecha_firma_contrato_to']) && $post_data['filtros']['fecha_firma_contrato_to']!==''){
				$row++;
				
				$sheet->setCellValue('A'.$row, 'F. Contrato desde:');
				$sheet->getStyle('A'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('B'.$row, $post_data['filtros']['fecha_firma_contrato_from']);
				$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);

				$sheet->setCellValue('D'.$row, 'Hasta:');
				$sheet->getStyle('D'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('E'.$row, $post_data['filtros']['fecha_firma_contrato_to']);
				$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);
			}

			if(isset($post_data['filtros']['fecha_inicio_from']) && $post_data['filtros']['fecha_inicio_from']!=='' && isset($post_data['filtros']['fecha_inicio_to']) && $post_data['filtros']['fecha_inicio_to']!==''){
				$row++;
				
				$sheet->setCellValue('A'.$row, 'F. Inicio desde:');
				$sheet->getStyle('A'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('B'.$row, $post_data['filtros']['fecha_inicio_from']);
				$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);

				$sheet->setCellValue('D'.$row, 'Hasta:');
				$sheet->getStyle('D'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('E'.$row, $post_data['filtros']['fecha_inicio_to']);
				$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);
			}

			if(isset($post_data['filtros']['fecha_entrega_estimada_from']) && $post_data['filtros']['fecha_entrega_estimada_from']!=='' && isset($post_data['filtros']['fecha_entrega_estimada_to']) && $post_data['filtros']['fecha_entrega_estimada_to']!==''){
				$row++;
				
				$sheet->setCellValue('A'.$row, 'F. Entrega desde:');
				$sheet->getStyle('A'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('B'.$row, $post_data['filtros']['fecha_entrega_estimada_from']);
				$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);

				$sheet->setCellValue('D'.$row, 'Hasta:');
				$sheet->getStyle('D'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('E'.$row, $post_data['filtros']['fecha_entrega_estimada_to']);
				$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);
			}	



			$row = $row + 4;

			$sheet->setCellValue('A'.$row, 'Proyecto');
			$sheet->getStyle('A'.$row)->applyFromArray($tableTitle);
			$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
			$sheet->setCellValue('B'.$row, 'Valor de oferta');
			$sheet->getStyle('B'.$row)->applyFromArray($tableTitle);
			$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
			$sheet->setCellValue('C'.$row, 'Gastos');
			$sheet->getStyle('C'.$row)->applyFromArray($tableTitle);
			$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
			$sheet->setCellValue('D'.$row, 'Utilidad');
			$sheet->getStyle('D'.$row)->applyFromArray($tableTitle);
			$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
			$sheet->setCellValue('E'.$row, 'Avance en tiempo');
			$sheet->getStyle('E'.$row)->applyFromArray($tableTitle);
			$sheet->getStyle('E'.$row)->applyFromArray($borderCell);
			
			$row++;
			$suma_horas = 0;
			$suma_costo = 0;
			foreach($result['datos'] as $kproyecto => $vproyecto){
				$sheet->setCellValue('A'.$row, 
				/*"Nombre: ".*/$vproyecto['nombre_proyecto']/*."\n".
				"----------\n".
				"Cliente: ".$vproyecto->nombre_cliente."\n".
				"Estado: ".$vproyecto->proyecto_estado."\n".
				"N° contrato: ".$vproyecto->numero_contrato."\n".
				"Orden de Compra: ".$vproyecto->orden_compra."\n".
				"Fecha de inicio: ".$vproyecto->fecha_inicio."\n".
				"Fecha de entrega: ".$vproyecto->fecha_entrega_estimada."\n"*/
				);
				$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('A'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('A'.$row)->applyFromArray($leftAlign);
				$sheet->setCellValue('B'.$row, $vproyecto['valor_oferta']['total']);
				$sheet->getStyle('B'.$row)->getNumberFormat()->setFormatCode('$ #,##0.00');
				$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);
				$sheet->setCellValue('C'.$row, $vproyecto['gastos']['total']);
				$sheet->getStyle('C'.$row)->getNumberFormat()->setFormatCode('$ #,##0.00');
				$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('C'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('C'.$row)->applyFromArray($leftAlign);
				$utilidad_proyecto =  $vproyecto['valor_oferta']['total'] - $vproyecto['gastos']['total'];
				$sheet->setCellValue('D'.$row, $utilidad_proyecto);
				$sheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('$ #,##0.00');
				$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('D'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('D'.$row)->applyFromArray($leftAlign);
				if($utilidad_proyecto <= 0){
					$sheet->getStyle('D'.$row)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);	
				}
				if($vproyecto['proyecto_estado_id']==2){
					$sheet->setCellValue('E'.$row, $vproyecto['avance_tiempo']['porcentaje'].' % ('.$vproyecto['avance_tiempo']['dias_consumidos'].' de '.$vproyecto['avance_tiempo']['dias_proyecto'].'días)');
				}
				$sheet->getStyle('E'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);
				$row++;
			}


			$sheet->getColumnDimension('A')->setWidth(18);
			$sheet->getColumnDimension('B')->setWidth(18);
			$sheet->getColumnDimension('C')->setWidth(18);
			$sheet->getColumnDimension('D')->setWidth(18);
			$sheet->getColumnDimension('E')->setWidth(18);


			//Genera el archivo
			$writer = new Xlsx($spreadsheet);
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');

			// It will be called file.xls
			header('Content-Disposition: attachment; filename="Reporte_General_Proyectos_'.date('Y_m_d').'.xlsx"');

			
			// Write file to the browser
			$writer->save('php://output');
    	}
	}

	public function generarReporteGastosMaterialesPorProyecto(){
		//Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		$post_data = array('filtros' => $this->input->get(NULL, TRUE));
		//$this->output->set_content_type('application/json');
		//$post_data = json_decode(file_get_contents("php://input"), true);
		;
    	if($post_data!=null){
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
			
			$leftAlign = array(
				'alignment' => array(
					'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
				),
			);

			$boldStyle = array(
				'font' => array(
					'bold' => true,
					'name'=> 'Arial',
				),
			);
			
			$normalStyle = array(
				'font' => array(
					'name'=> 'Arial',
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

			//Obtiene datos
			$result = $this->m_proyecto->consultaGastosMaterialesProyecto($post_data);
			$proyecto = $this->m_proyecto->consultar($post_data['filtros']['proyecto_id']);

			//Crea el objeto de excel
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->mergeCells('A1:E1');
			$sheet->setCellValue('A1', 'Reporte de Gastos en Materiales General');
			$sheet->getStyle('A1')->applyFromArray($sheetTitle);

			$first_col = true;
			$row = 3;
			$sheet->setCellValue('A'.$row, 'Nombre:');
			$sheet->getStyle('A'.$row)->applyFromArray($boldStyle);
			$sheet->setCellValue('B'.$row, $proyecto['proyecto']['nombre_proyecto']);
			$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);

			$sheet->setCellValue('D'.$row, 'Jefe de proyecto:');
			$sheet->getStyle('D'.$row)->applyFromArray($boldStyle);
			$sheet->setCellValue('E'.$row, $proyecto['proyecto']['nombre'] . ' ' . $proyecto['proyecto']['apellidos']);
			$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);

			$row++;
			$sheet->setCellValue('A'.$row, 'N° contrato:');
			$sheet->getStyle('A'.$row)->applyFromArray($boldStyle);
			$sheet->setCellValue('B'.$row, $proyecto['proyecto']['numero_contrato']);
			$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);

			$sheet->setCellValue('D'.$row, 'Ord. Compra:');
			$sheet->getStyle('D'.$row)->applyFromArray($boldStyle);
			$sheet->setCellValue('E'.$row, $proyecto['proyecto']['orden_compra']);
			$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);

			$row++;
			$sheet->setCellValue('A'.$row, 'Cliente:');
			$sheet->getStyle('A'.$row)->applyFromArray($boldStyle);
			$sheet->setCellValue('B'.$row, $proyecto['proyecto']['nombre_cliente']);
			$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);

			$sheet->setCellValue('D'.$row, 'Fecha contrato:');
			$sheet->getStyle('D'.$row)->applyFromArray($boldStyle);
			$sheet->setCellValue('E'.$row, $proyecto['proyecto']['fecha_firma_contrato']);
			$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);

			$row++;
			$sheet->setCellValue('A'.$row, 'Fecha inicio:');
			$sheet->getStyle('A'.$row)->applyFromArray($boldStyle);
			$sheet->setCellValue('B'.$row, $proyecto['proyecto']['fecha_inicio']);
			$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);

			$sheet->setCellValue('D'.$row, 'Fecha entrega:');
			$sheet->getStyle('D'.$row)->applyFromArray($boldStyle);
			$sheet->setCellValue('E'.$row, $proyecto['proyecto']['fecha_entrega_estimada']);
			$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
			$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);
			
			if(isset($post_data['filtros']['fecha_gasto_from']) && $post_data['filtros']['fecha_gasto_from']!=='' && isset($post_data['filtros']['fecha_gasto_to']) && $post_data['filtros']['fecha_gasto_to']!==''){
				$row++;
				
				$sheet->setCellValue('A'.$row, 'F. Gasto desde:');
				$sheet->getStyle('A'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('B'.$row, $post_data['filtros']['fecha_gasto_from']);
				$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('B'.$row)->applyFromArray($leftAlign);

				$sheet->setCellValue('D'.$row, 'Hasta:');
				$sheet->getStyle('D'.$row)->applyFromArray($boldStyle);
				$sheet->setCellValue('E'.$row, $post_data['filtros']['fecha_gasto_to']);
				$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
				$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);
			}
			
			$row++;
			if(isset($post_data['filtros']['proveedor_id']) && $post_data['filtros']['proveedor_id']!=='' && $post_data['filtros']['proveedor_id']!=='all'){
				if($first_col){
					$letra_col = 'A';
					$letra_val = 'B';
				}else{
					$letra_col = 'D';
					$letra_val = 'E';
				}
				$sheet->setCellValue($letra_col.$row, 'Proveedor:');
				$sheet->getStyle($letra_col.$row)->applyFromArray($boldStyle);
				foreach($result['datos'] as $key => $value){
					$sheet->setCellValue($letra_val.$row, $result['datos'][$key]['nombre_proveedor']);
				}
				$sheet->getStyle($letra_val.$row)->applyFromArray($normalStyle);
				$sheet->getStyle($letra_val.$row)->applyFromArray($leftAlign);

				if(!$first_col){
					$row++;
					$first_col = true;
				}else{
					$first_col = false;
				}
			}
			

			
			$row = $row + 3;

			if($post_data['filtros']['group_by']=='dia'){
				$sheet->mergeCells('A'.$row.':C'.$row);
				$sheet->mergeCells('D'.$row.':E'.$row);
				$sheet->setCellValue('A'.$row, 'Fecha');
				$sheet->getStyle('A'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('B'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('C'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
				$sheet->setCellValue('D'.$row, 'Monto de Gasto');
				$sheet->getStyle('D'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('E'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('E'.$row)->applyFromArray($borderCell);
			}else if($post_data['filtros']['group_by']=='proveedor'){
				$sheet->mergeCells('A'.$row.':C'.$row);
				$sheet->mergeCells('D'.$row.':E'.$row);
				$sheet->setCellValue('A'.$row, 'Proveedor');
				$sheet->getStyle('A'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('B'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('C'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
				$sheet->setCellValue('D'.$row, 'Monto de Gasto');
				$sheet->getStyle('D'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('E'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('E'.$row)->applyFromArray($borderCell);			
			}else if($post_data['filtros']['group_by']=='none'){
				$sheet->mergeCells('A'.$row.':B'.$row);
				$sheet->mergeCells('D'.$row.':E'.$row);
				$sheet->setCellValue('A'.$row, 'Proveedor');
				$sheet->getStyle('A'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('B'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
				$sheet->setCellValue('C'.$row, 'Fecha');
				$sheet->getStyle('C'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
				$sheet->setCellValue('D'.$row, 'Monto de Gasto');
				$sheet->getStyle('D'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
				$sheet->getStyle('E'.$row)->applyFromArray($tableTitle);
				$sheet->getStyle('E'.$row)->applyFromArray($borderCell);
			}
			
			$row++;
			$suma_costo = 0;
			foreach($result['datos'] as $kresult => $vresult){
				if($post_data['filtros']['group_by']=='dia'){
					$sheet->mergeCells('A'.$row.':C'.$row);
					$sheet->setCellValue('A'.$row, $vresult['fecha_gasto']);
					$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('A'.$row)->applyFromArray($normalStyle);
					$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);	
					$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('C'.$row)->applyFromArray($normalStyle);
					$sheet->mergeCells('D'.$row.':E'.$row);
					$sheet->setCellValue('D'.$row, $vresult['proyecto_gasto_monto']);
					$sheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('$ #,##0.00');
					$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('D'.$row)->applyFromArray($normalStyle);
					$sheet->getStyle('D'.$row)->applyFromArray($leftAlign);
					$sheet->getStyle('E'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
					$suma_costo+= $vresult['proyecto_gasto_monto'];
				}else if($post_data['filtros']['group_by']=='proveedor'){
					$sheet->mergeCells('A'.$row.':C'.$row);
					$sheet->setCellValue('A'.$row, $vresult['nombre_proveedor']);
					$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('A'.$row)->applyFromArray($normalStyle);
					$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);	
					$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('C'.$row)->applyFromArray($normalStyle);
					$sheet->mergeCells('D'.$row.':E'.$row);
					$sheet->setCellValue('D'.$row, $vresult['proyecto_gasto_monto']);
					$sheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('$ #,##0.00');
					$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('D'.$row)->applyFromArray($leftAlign);
					$sheet->getStyle('D'.$row)->applyFromArray($normalStyle);
					$sheet->getStyle('E'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
					$suma_costo+= $vresult['proyecto_gasto_monto'];
				}else if($post_data['filtros']['group_by']=='none'){
					$sheet->mergeCells('A'.$row.':B'.$row);
					$sheet->setCellValue('A'.$row, $vresult['nombre_proveedor']);
					$sheet->getStyle('A'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('A'.$row)->applyFromArray($normalStyle);
					$sheet->getStyle('B'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('B'.$row)->applyFromArray($normalStyle);					
					$sheet->setCellValue('C'.$row, $vresult['fecha_gasto']);
					$sheet->getStyle('C'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('C'.$row)->applyFromArray($normalStyle);
					$sheet->mergeCells('D'.$row.':E'.$row);
					$sheet->setCellValue('D'.$row, $vresult['proyecto_gasto_monto']);
					$sheet->getStyle('D'.$row)->getNumberFormat()->setFormatCode('$ #,##0.00');
					$sheet->getStyle('D'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('D'.$row)->applyFromArray($normalStyle);
					$sheet->getStyle('E'.$row)->applyFromArray($borderCell);
					$sheet->getStyle('E'.$row)->applyFromArray($normalStyle);
					$sheet->getStyle('E'.$row)->applyFromArray($leftAlign);					
					$suma_costo+= $vresult['proyecto_gasto_monto'];
				}
				
				$row++;
			}

			
			$letra1='D';
			$letra2='E';
			
		

			$sheet->setCellValue($letra1.($row+2), 'Gasto total:');
			$sheet->getStyle($letra1.($row+2))->applyFromArray($borderCell);
			$sheet->getStyle($letra1.($row+2))->applyFromArray($boldStyle);
			$sheet->setCellValue($letra2.($row+2), $suma_costo);
			$sheet->getStyle($letra2.($row+2))->getNumberFormat()->setFormatCode('$ #,##0.00');
			$sheet->getStyle($letra2.($row+2))->applyFromArray($borderCell);
			$sheet->getStyle($letra2.($row+2))->applyFromArray($normalStyle);
			$sheet->getStyle($letra2.($row+2))->applyFromArray($leftAlign);

			
			$sheet->getColumnDimension('A')->setWidth(18);
			$sheet->getColumnDimension('B')->setWidth(18);
			$sheet->getColumnDimension('C')->setWidth(18);
			$sheet->getColumnDimension('D')->setWidth(18);
			$sheet->getColumnDimension('E')->setWidth(18);
			


			//Genera el archivo
			$writer = new Xlsx($spreadsheet);
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');

			// It will be called file.xls
			header('Content-Disposition: attachment; filename="Reporte_Gastos_Materiales_'.str_replace(' ', '_', $proyecto['proyecto']['nombre_proyecto']).'_'.date('Y_m_d').'.xlsx"');

			
			// Write file to the browser
			$writer->save('php://output');
		}
	}

}