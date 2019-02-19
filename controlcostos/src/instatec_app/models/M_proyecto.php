<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Proyecto extends CI_Model {
	
	private $t_proyecto = 'proyecto',
			$t_proyecto_estado = 'proyecto_estado',
			$t_proyecto_valor_oferta = 'proyecto_valor_oferta',
			$t_proyecto_tipo_cambio = 'proyecto_tipo_cambio',
			$t_proyecto_valor_oferta_tipo = 'proyecto_valor_oferta_tipo',
			$t_proyecto_valor_oferta_extension_detalle = 'proyecto_valor_oferta_extension_detalle',
			$t_proyecto_valor_oferta_extension = 'proyecto_valor_oferta_extension',
			$t_proyecto_valor_oferta_extension_estado = 'proyecto_valor_oferta_extension_estado',
			$t_proyecto_valor_oferta_extension_cambio = 'proyecto_valor_oferta_extension_cambio',
			$t_proyecto_valor_oferta_extension_tipo = 'proyecto_valor_oferta_extension_tipo',
			$t_proyecto_valor_oferta_extension_unidad = 'proyecto_valor_oferta_extension_unidad',
			$t_proyecto_valor_oferta_extension_rechazo = 'proyecto_valor_oferta_extension_rechazo',
			$t_contacto = 'contacto',
			$t_proyecto_contacto = 'proyecto_contacto',
			$t_proyecto_gasto = 'proyecto_gasto',
			$t_proyecto_gasto_tipo = 'proyecto_gasto_tipo',
			$t_proyecto_gasto_estado = 'proyecto_gasto_estado',
			$t_proyecto_gasto_monto = 'proyecto_gasto_monto',
			$t_proyecto_gasto_detalle = 'proyecto_gasto_detalle',
			$t_proyecto_gasto_mano_obra = 'proyecto_gasto_mano_obra',
			$t_proyecto_gasto_material = 'proyecto_gasto_material',
			$t_proyecto_colaborador = 'proyecto_colaborador',
			$t_usuario_detalle = 'usuario_detalle',
			$t_usuario = 'usuario',
			$t_usuario_colaborador = 'usuario_colaborador',
			$t_cliente = 'cliente',
			$t_proveedor = 'proveedor',
			$t_proveedor_correo = 'proveedor_correo',
			$t_proveedor_telefono = 'proveedor_telefono',
			$t_distrito = 'distrito',
			$t_canton = 'canton',
			$t_provincia = 'provincia',
			$t_moneda = 'moneda',
			$t_colaborador = 'colaborador',
			$t_colaborador_puesto = 'colaborador_puesto',
			$t_colaborador_costo_hora = 'colaborador_costo_hora',
			$t_material = 'material',
			$t_material_unidad = 'material_unidad',
			$t_proyecto_material = 'proyecto_material',
			$t_proyecto_material_detalle = 'proyecto_material_detalle',
			$t_proyecto_material_estado = 'proyecto_material_estado',
			$t_proyecto_material_solicitud_cotizacion = 'proyecto_material_solicitud_cotizacion',
			$t_proyecto_material_solicitud_compra = 'proyecto_material_solicitud_compra',
			$t_proyecto_material_solicitud_compra_estado = 'proyecto_material_solicitud_compra_estado',
			$t_proyecto_material_solicitud_compra_detalle = 'proyecto_material_solicitud_compra_detalle',
			$t_proyecto_material_solicitud_compra_proforma = 'proyecto_material_solicitud_compra_proforma',
			$t_proyecto_material_solicitud_compra_proforma_estado ='proyecto_material_solicitud_compra_proforma_estado',
			$t_proyecto_material_solicitud_compra_orden_compra = 'proyecto_material_solicitud_compra_orden_compra',
			$t_proyecto_material_solicitud_compra_orden_compra_estado ='proyecto_material_solicitud_compra_orden_compra_estado',
			$rol_id,
			$usuario_id;

	function __construct()
	{
		parent::__construct();

		$loggedin = $this->m_general->conectado();			
		if($loggedin){
			if($this->session->has_userdata('rol_id')){
				$this->rol_id = $this->session->userdata('rol_id');
			}
			if($this->session->has_userdata('usuario_id')){
				$this->usuario_id = $this->session->userdata('usuario_id');
			}			
		}
		$this->load->model('m_bitacora');
	}

	function getProyectoEstados(){
		$proyecto_estado_result = $this->db->get($this->t_proyecto_estado);
		if($proyecto_estado_result->num_rows() > 0){
			return $this->security->xss_clean($proyecto_estado_result->result_array());
		}else{
			return false;
		}
	}

	function consultaAll($data = null){
		//Consulta primero los datos
		$this->db->join($this->t_cliente, $this->t_cliente.'.cliente_id = '.$this->t_proyecto.'.cliente_id', 'LEFT');
		$this->db->join($this->t_proyecto_estado, $this->t_proyecto_estado.'.proyecto_estado_id = '.$this->t_proyecto.'.proyecto_estado_id', 'LEFT');
		$this->db->join($this->t_distrito, $this->t_distrito.'.distrito_id = '.$this->t_proyecto.'.distrito_id', 'LEFT');
		$this->db->join($this->t_canton, $this->t_canton.'.canton_id = '.$this->t_distrito.'.canton_id', 'LEFT');
		$this->db->join($this->t_provincia, $this->t_provincia.'.provincia_id = '.$this->t_canton.'.provincia_id', 'LEFT');
		if(isset($data['filtros'])){			
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='nombre_proyecto' || $key=='numero_contrato' || $key=='orden_compra'){
						$this->db->like($this->t_proyecto.'.'.$key, $value);
					}else if($key=='provincia_id'){
						$this->db->where($this->t_canton.'.'.$key, $value);
					}else if($key=='canton_id'){
						$this->db->where($this->t_distrito.'.'.$key, $value);
					}else if($key=='fecha_registro' || $key=='fecha_firma_contrato' || $key=='fecha_inicio' || $key=='fecha_entrega_estimada'){
						if($value['from']!='' && $value['from']!='undefined' && $value['from']!='IS NULL'){
							$value['from'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['from'])));
							$this->db->where($this->t_proyecto.'.'.$key.'>="'.$value['from'].'"');
						}

						if($value['to']!='' && $value['to']!='undefined' && $value['to']!='IS NULL'){
							$value['to'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['to'])));
							$this->db->where($this->t_proyecto.'.'.$key.'<="'.$value['to'].'"');	
						}
					}else{
						$this->db->where($this->t_proyecto.'.'.$key, $value);
					}
					
				}
			}
		}
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
		$result_proyecto = $this->db->get($this->t_proyecto);

		//vuelve a hacer la consulta para obtener el total de rows 

		/*
		$this->db->join($this->t_cliente, $this->t_cliente.'.cliente_id = '.$this->t_proyecto.'.cliente_id');
		$this->db->join($this->t_proyecto_estado, $this->t_proyecto_estado.'.proyecto_estado_id = '.$this->t_proyecto.'.proyecto_estado_id');
		$this->db->join($this->t_distrito, $this->t_distrito.'.distrito_id = '.$this->t_proyecto.'.distrito_id');
		$this->db->join($this->t_canton, $this->t_canton.'.canton_id = '.$this->t_distrito.'.canton_id');
		$this->db->join($this->t_provincia, $this->t_provincia.'.provincia_id = '.$this->t_canton.'.provincia_id');
		if(isset($data['filtros'])){			
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='nombre_proyecto' || $key=='numero_contrato' || $key=='orden_compra'){
						$this->db->like($this->t_proyecto.'.'.$key, $value);
					}else if($key=='provincia_id'){
						$this->db->where($this->t_canton.'.'.$key, $value);
					}else if($key=='canton_id'){
						$this->db->where($this->t_distrito.'.'.$key, $value);
					}else if($key=='fecha_registro' || $key=='fecha_firma_contrato' || $key=='fecha_inicio' || $key=='fecha_entrega_estimada'){
						if($value['from']!='' && $value['from']!='undefined' && $value['from']!='IS NULL'){
							$value['from'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['from'])));
							$this->db->where($this->t_proyecto.'.'.$key.'>="'.$value['from'].'"');
						}

						if($value['to']!='' && $value['to']!='undefined' && $value['to']!='IS NULL'){
							$value['to'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['to'])));
							$this->db->where($this->t_proyecto.'.'.$key.'<="'.$value['to'].'"');	
						}
					}else{
						$this->db->where($this->t_proyecto.'.'.$key, $value);
					}
					
				}
			}
		}
		$total_rows = $this->db->count_all_results($this->t_cliente, FALSE);*/
		//exit(var_export($this->db->last_query()));
		if($result_proyecto->num_rows()>0){
			$result = array(
							'total_rows' => $result_proyecto->num_rows(),
							'datos' => $this->security->xss_clean($result_proyecto->result_array()),
							);

			return $result;

		}else{
			return false;
		}
		

	}

	function consultaAllSimple(){
		$result_proyecto = $this->db->get($this->t_proyecto);
		$result_proyecto_num_rows = $result_proyecto->num_rows();
		if($result_proyecto_num_rows > 0){
			$result = $this->security->xss_clean($result_proyecto->result_array());
			return $result;

		}else{
			return false;
		}
	}

	function consultaAllActivos($filtros = array()){
		$this->db->join($this->t_cliente, $this->t_cliente.'.cliente_id = '.$this->t_proyecto.'.cliente_id', 'LEFT');
		$this->db->join($this->t_proyecto_estado, $this->t_proyecto_estado.'.proyecto_estado_id = '.$this->t_proyecto.'.proyecto_estado_id', 'LEFT');
		$this->db->join($this->t_distrito, $this->t_distrito.'.distrito_id = '.$this->t_proyecto.'.distrito_id', 'LEFT');
		$this->db->join($this->t_canton, $this->t_canton.'.canton_id = '.$this->t_distrito.'.canton_id', 'LEFT');
		$this->db->join($this->t_provincia, $this->t_provincia.'.provincia_id = '.$this->t_canton.'.provincia_id', 'LEFT');
		$where = '';
		if(!empty($filtros)){
			if(isset($filtros['filtros']['jefe_proyecto_id'])){
				$where  = '('.$this->t_proyecto.'.jefe_proyecto_id = '.$filtros['filtros']['jefe_proyecto_id'].') AND ';
			}
		}
		$where .= '('.$this->t_proyecto.'.proyecto_estado_id = 1 OR '.$this->t_proyecto.'.proyecto_estado_id = 2 )';
		$this->db->where($where);
		$this->db->order_by($this->t_proyecto.'.fecha_registro', 'DESC');
		$result_proyecto = $this->db->get($this->t_proyecto, 10, 0);
		$result_proyecto_num_rows = $result_proyecto->num_rows();
		//exit(var_export($this->db->last_query()));
		if($result_proyecto_num_rows>0){
			$result = array(
							'total_rows' => $result_proyecto_num_rows,
							'datos' => $this->security->xss_clean($result_proyecto->result_array()),
							);

			return $result;

		}else{
			return false;
		}
	}

	function consultaProyectosPorCliente($cliente_id){
		$this->db->join($this->t_cliente, $this->t_cliente.'.cliente_id = '.$this->t_proyecto.'.cliente_id', 'LEFT');
		$this->db->join($this->t_proyecto_estado, $this->t_proyecto_estado.'.proyecto_estado_id = '.$this->t_proyecto.'.proyecto_estado_id', 'LEFT');
		$this->db->join($this->t_distrito, $this->t_distrito.'.distrito_id = '.$this->t_proyecto.'.distrito_id', 'LEFT');
		$this->db->join($this->t_canton, $this->t_canton.'.canton_id = '.$this->t_distrito.'.canton_id', 'LEFT');
		$this->db->join($this->t_provincia, $this->t_provincia.'.provincia_id = '.$this->t_canton.'.provincia_id', 'LEFT');
		$where = '';
		
		if(isset($cliente_id)){
			$where  = '('.$this->t_proyecto.'.cliente_id = '.$cliente_id.')';
		}
		
		$this->db->where($where);
		$this->db->order_by($this->t_proyecto.'.fecha_registro', 'DESC');
		$result_proyecto = $this->db->get($this->t_proyecto, 10, 0);
		$result_proyecto_num_rows = $result_proyecto->num_rows();
		//exit(var_export($this->db->last_query()));
		if($result_proyecto_num_rows>0){
			$result = array(
							'total_rows' => $result_proyecto_num_rows,
							'datos' => $this->security->xss_clean($result_proyecto->result_array()),
							);

			return $result;

		}else{
			return false;
		}
	}

	function insertar($datos){
		if($datos!=null){

		
			$datos2 = $datos;			
			$datos['usuario_id'] = $this->usuario_id;
			$datos['fecha_registro'] = date('Y-m-d H:i:s');
			$datos['fecha_firma_contrato'] = ($datos['fecha_firma_contrato']!='' && $datos['fecha_firma_contrato']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_firma_contrato']))):'0000-00-00';
			$datos['fecha_inicio'] = ($datos['fecha_inicio']!='' && $datos['fecha_inicio']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_inicio']))):'0000-00-00';
			$datos['fecha_entrega_estimada'] = ($datos['fecha_entrega_estimada']!='' && $datos['fecha_entrega_estimada']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_entrega_estimada']))):'0000-00-00';
			$datos['moneda_id'] = 1;
			unset($datos['provincia_id']);
			unset($datos['canton_id']);
			unset($datos['valor_oferta']);
			unset($datos['tipocambio']);
			$this->db->insert($this->t_proyecto, $datos);
			$proyecto_id = $this->db->insert_id();

			//Crea la relacion del jefe de proyecto en la tabla de colaboradores
			$this->relacionarColaboradorProyecto($proyecto_id, $datos['jefe_proyecto_id'],1);

			foreach ($datos2['valor_oferta'] as $kfield => $vfield) {
				$this->db->set('proyecto_valor_oferta_tipo_id', $kfield);
				$this->db->set('proyecto_id', $proyecto_id);
				$this->db->set('moneda_id', 1);
				$this->db->set('valor_oferta', str_replace(' ', '',$vfield));
				$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
				$this->db->set('estado_registro', 1);
				$this->db->insert($this->t_proyecto_valor_oferta);

				if($kfield==4){
					//Si entra aqui es porque el valor administrativo también se registra como un gasto automáticamente
					$this->db->set('proyecto_id', $proyecto_id);
					$this->db->set('usuario_id', $this->usuario_id);
					$this->db->set('proyecto_gasto_tipo_id', $kfield);
					$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
					$this->db->set('fecha_gasto', date('Y-m-d'));
					$this->db->insert($this->t_proyecto_gasto);
					$gasto_id = $this->db->insert_id();

					$this->db->set('proyecto_gasto_id', $gasto_id);
					$this->db->set('moneda_id', 1);
					$this->db->set('proyecto_gasto_monto', str_replace(' ', '',$vfield));	
					$this->db->set('estado_registro', 1);				
					$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
					$this->db->insert($this->t_proyecto_gasto_monto);
				}
			}
			
			$this->db->set('proyecto_id', $proyecto_id);
			$this->db->set('moneda_base_id', 1);
			$this->db->set('moneda_destino_id', 2);
			$this->db->set('valor_compra', str_replace(' ', '',$datos2['tipocambio']['valor_compra']));
			$this->db->set('valor_venta', str_replace(' ', '',$datos2['tipocambio']['valor_venta']));
			$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
			$this->db->insert($this->t_proyecto_tipo_cambio);
			

			return array('tipo' => 'success',
						'texto' => 'Proyecto ingresado con éxito',
						'inserted_id'=> $proyecto_id);
			

		}
		
	}


	function actualizar($proyecto_id, $datos){
		//actualiza los campos

		if($proyecto_id!=null && $datos!=null){
			$datos2 = $datos;			
			$datos['fecha_firma_contrato'] = ($datos['fecha_firma_contrato']!='' && $datos['fecha_firma_contrato']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_firma_contrato']))):'';
			$datos['fecha_inicio'] = ($datos['fecha_inicio']!='' && $datos['fecha_inicio']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_inicio']))):'';
			$datos['fecha_entrega_estimada'] = ($datos['fecha_entrega_estimada']!='' && $datos['fecha_entrega_estimada']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_entrega_estimada']))):'';
			unset($datos['provincia_id']);
			unset($datos['canton_id']);
			unset($datos['valor_oferta']);
			unset($datos['tipocambio']);
			$this->db->where('proyecto_id', $proyecto_id);
			$this->db->update($this->t_proyecto, $datos);		
			
			//Crea la relacion del jefe de proyecto en la tabla de colaboradores
			$this->relacionarColaboradorProyecto($proyecto_id, $datos['jefe_proyecto_id'],1);

			foreach ($datos2['valor_oferta'] as $kfield => $vfield) {
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->where('proyecto_valor_oferta_tipo_id', $kfield);
				$result_valor = $this->db->get($this->t_proyecto_valor_oferta);

				$this->db->set('valor_oferta', str_replace(' ', '',$vfield));
				if($result_valor->num_rows()>0){
					$this->db->where('proyecto_id', $proyecto_id);
					$this->db->where('proyecto_valor_oferta_tipo_id', $kfield);
					$this->db->update($this->t_proyecto_valor_oferta);
				}else{
					$this->db->set('proyecto_valor_oferta_tipo_id', $kfield);
					$this->db->set('proyecto_id', $proyecto_id);
					$this->db->set('moneda_id', 1);
					$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
					$this->db->set('estado_registro', 1);
					$this->db->insert($this->t_proyecto_valor_oferta);
				}


				if($kfield==4){
					//Si entra aqui es porque el valor administrativo también se registra como un gasto automáticamente		
					//obtiene el id del gasto correspondiente			
					$this->db->where('proyecto_id', $proyecto_id);
					$this->db->where('proyecto_gasto_tipo_id', $kfield);
					$result_gasto = $this->db->get($this->t_proyecto_gasto);
					$result_gasto_num_rows = $result_gasto->num_rows();
					if($result_gasto_num_rows > 0){
						$result_gasto_result = $result_gasto->row();
						$gasto_id = $result_gasto_result->proyecto_gasto_id;

						//actualiza el monto anterior para guardar el registro
						$this->db->where('proyecto_gasto_id', $gasto_id);
						$this->db->where('estado_registro', 1);				
						$result_gasto_monto = $this->db->get($this->t_proyecto_gasto_monto);
						$result_gasto_monto_num_rows = $result_gasto_monto->num_rows();
						if($result_gasto_monto_num_rows > 0){
							$monto_nuevo = str_replace(' ', '',$vfield);
							$result_gasto_monto_result = $result_gasto_monto->row();
							if($result_gasto_monto_result->proyecto_gasto_monto != $monto_nuevo){
								$this->db->set('estado_registro', 0);
								$this->db->where('proyecto_gasto_id', $gasto_id);
								$this->db->where('estado_registro', 1);
								$this->db->update($this->t_proyecto_gasto_monto);
								

								// inserta el monto del nuevo valor
								$this->db->set('proyecto_gasto_id', $gasto_id);
								$this->db->set('moneda_id', 1);
								$this->db->set('proyecto_gasto_monto', str_replace(' ', '',$vfield));	
								$this->db->set('estado_registro', 1);	
								$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
								$this->db->insert($this->t_proyecto_gasto_monto);
							}
						}

						
					}else{
						//Si entra aqui es porque el valor administrativo no habia registrado el gasto antes
						$this->db->set('proyecto_id', $proyecto_id);
						$this->db->set('usuario_id', $this->usuario_id);
						$this->db->set('proyecto_gasto_tipo_id', $kfield);
						$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
						$this->db->set('fecha_gasto', date('Y-m-d'));
						$this->db->insert($this->t_proyecto_gasto);
						$gasto_id = $this->db->insert_id();

						$this->db->set('proyecto_gasto_id', $gasto_id);
						$this->db->set('moneda_id', 1);
						$this->db->set('proyecto_gasto_monto', str_replace(' ', '',$vfield));	
						$this->db->set('estado_registro', 1);				
						$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
						$this->db->insert($this->t_proyecto_gasto_monto);
					}

				}

			}

			$this->db->where('proyecto_id', $proyecto_id);
			$result_tipo_cambio = $this->db->get($this->t_proyecto_tipo_cambio);

			$this->db->set('valor_compra', str_replace(' ', '',$datos2['tipocambio']['valor_compra']));
			$this->db->set('valor_venta', str_replace(' ', '',$datos2['tipocambio']['valor_venta']));
			if($result_tipo_cambio->num_rows()>0){
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->update($this->t_proyecto_tipo_cambio);
			}else{
				$this->db->set('proyecto_id', $proyecto_id);
				$this->db->set('moneda_base_id', 1);
				$this->db->set('moneda_destino_id', 2);
				$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
				$this->db->insert($this->t_proyecto_tipo_cambio);
			}

			
			

			$this->m_bitacora->registrarEdicionBicatora('proyecto', $proyecto_id);

			return array('tipo' => 'success',
						'texto' => 'Proyecto editado con éxito',
						'inserted_id'=> $proyecto_id);

		}else{
			return array('tipo' => 'danger',
						'texto' => 'Hubo un error al actualizar el proyecto. Favor contactar al administrador del sistema.',
						'inserted_id'=> $proyecto_id);
		}
	}


	function consultar($proyecto_id){
		if($proyecto_id!=null){
			$result = array();
			$this->db->join($this->t_proyecto_estado, $this->t_proyecto_estado.'.proyecto_estado_id = '.$this->t_proyecto.'.proyecto_estado_id', 'LEFT');
			$this->db->join($this->t_cliente, $this->t_cliente.'.cliente_id = '.$this->t_proyecto.'.cliente_id', 'LEFT');
			$this->db->join($this->t_distrito, $this->t_distrito.'.distrito_id = '.$this->t_proyecto.'.distrito_id', 'LEFT');
			$this->db->join($this->t_canton, $this->t_canton.'.canton_id = '.$this->t_distrito.'.canton_id', 'LEFT');
			$this->db->join($this->t_provincia, $this->t_provincia.'.provincia_id = '.$this->t_canton.'.provincia_id', 'LEFT');
			$this->db->join($this->t_colaborador, $this->t_colaborador.'.colaborador_id = '.$this->t_proyecto.'.jefe_proyecto_id', 'LEFT');
			$this->db->where('proyecto_id', $proyecto_id);
			$result_proyecto = $this->db->get($this->t_proyecto);
			if($result_proyecto->num_rows()> 0){
				//Datos de proyecto
				$result['proyecto'] = $this->security->xss_clean($result_proyecto->row_array());
				
				// Obtiene los valores de la oferta
				$this->db->join($this->t_proyecto_valor_oferta_tipo, $this->t_proyecto_valor_oferta_tipo.'.proyecto_valor_oferta_tipo_id = '.$this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_tipo_id', 'LEFT');
				$this->db->join($this->t_moneda, $this->t_moneda.'.moneda_id = '.$this->t_proyecto_valor_oferta.'.moneda_id');
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->order_by($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_tipo_id', 'ASC');
				$result_valor_oferta = $this->db->get($this->t_proyecto_valor_oferta);
				if($result_valor_oferta->num_rows()>0){
					$valores_ofertas = $this->security->xss_clean($result_valor_oferta->result_array());

					// Recorremos todos los valores para ver si hay extensiones que no estan aprobadas para no contarlas en el total
					foreach ($valores_ofertas as $kvalor => $vvalor) {
						$saltar_valor_oferta = false;
							
						// Validamos si el tipo de valor de oferta es una orden de cambio y revisamos su estado para ver si esta aprobado o no
						if($vvalor['proyecto_valor_oferta_tipo_id'] == 6) {
							$this->db->where($this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_id', $vvalor['proyecto_valor_oferta_id']);
							$proyecto_valor_oferta_extension = $this->db->get($this->t_proyecto_valor_oferta_extension);
							$proyecto_valor_oferta_extension_count = $proyecto_valor_oferta_extension->num_rows();
							if ($proyecto_valor_oferta_extension_count > 0) {
								$proyecto_valor_oferta_extension_result = $proyecto_valor_oferta_extension->row_array();
								if ($proyecto_valor_oferta_extension_result['proyecto_valor_oferta_extension_estado_id'] != 2) {
									$saltar_valor_oferta = true;
								}
							}
						}
	
						if ($saltar_valor_oferta) {
							unset($valores_ofertas[$kvalor]);
						}
					}

					$result['valor_oferta'] = $valores_ofertas;
				}
				
				// Obtiene el tipo de cambio
				$this->db->where('proyecto_id', $proyecto_id);
				$result_tipo_cambio = $this->db->get($this->t_proyecto_tipo_cambio);
				if($result_tipo_cambio->num_rows()>0){
					$result['tipo_cambio'] = $this->security->xss_clean($result_tipo_cambio->row_array());
				}

				//Obtiene gastos
				$this->db->join($this->t_proyecto_gasto_tipo, $this->t_proyecto_gasto_tipo.'.proyecto_gasto_tipo_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 'LEFT');
				$this->db->join($this->t_proyecto_gasto_monto, $this->t_proyecto_gasto_monto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_monto.'.estado_registro = 1', 'LEFT');
				$this->db->join($this->t_proyecto_gasto_detalle, $this->t_proyecto_gasto_detalle.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id', 'LEFT');
				$this->db->join($this->t_proyecto_gasto_estado, $this->t_proyecto_gasto_estado.'.proyecto_gasto_estado_id = '.$this->t_proyecto_gasto_detalle.'.proyecto_gasto_estado_id', 'LEFT');
				$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_gasto_detalle.'.proveedor_id', 'LEFT');
				$this->db->join($this->t_moneda, $this->t_moneda.'.moneda_id = '.$this->t_proyecto_gasto_monto.'.moneda_id', 'LEFT');
				$this->db->select($this->t_proyecto_gasto.'.*, '.$this->t_proyecto_gasto_monto.'.proyecto_gasto_monto, '.$this->t_proyecto_gasto_monto.'.moneda_id, '.$this->t_proyecto_gasto_detalle.'.proveedor_id, '.$this->t_proyecto_gasto_detalle.'.numero_factura, '.$this->t_proyecto_gasto_estado.'.proyecto_gasto_estado, '.$this->t_proveedor.'.nombre_proveedor, '.$this->t_proyecto_gasto_tipo.'.proyecto_gasto_tipo, '.$this->t_moneda.'.*');

				
				$this->db->where($this->t_proyecto_gasto.'.proyecto_id', $proyecto_id);
				$this->db->order_by($this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 'ASC');			
				$result_gastos = $this->db->get($this->t_proyecto_gasto);			
				if($result_gastos->num_rows()>0){
					$result['gastos'] = $this->security->xss_clean($result_gastos->result_array());
				}	




				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	function consultaInfoProyecto($datos){
		if($datos!=null){
			if(isset($datos['proyecto_id'])){
				$proyecto_id = $datos['proyecto_id'];

				// Consulta los datos del proyecto
				$this->db->join($this->t_proyecto_estado, $this->t_proyecto_estado.'.proyecto_estado_id = '.$this->t_proyecto.'.proyecto_estado_id', 'LEFT');
				$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto.'.proyecto_id', 'LEFT');
				$this->db->where($this->t_proyecto.'.proyecto_id', $proyecto_id);
				$result_proyecto = $this->db->get($this->t_proyecto);
				$result_proyecto_num_rows = $result_proyecto->num_rows();
				if($result_proyecto_num_rows > 0){
					$proyecto = $this->security->xss_clean($result_proyecto->row_array());

				}

				$result_array = array();

				//Para valor de la oferta
				$total_valor_oferta = 0;
				$valor_oferta_tmp = array();
				$valor_oferta_array = array();
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->order_by('proyecto_valor_oferta_tipo_id', 'ASC');
				$result_valor_oferta = $this->db->get($this->t_proyecto_valor_oferta);
				$result_valor_oferta_num_rows = $result_valor_oferta->num_rows();
				if($result_valor_oferta_num_rows>0){
					$result_valor_oferta_result = $this->security->xss_clean($result_valor_oferta->result_array());
					foreach ($result_valor_oferta_result as $kvalor => $vvalor) {
						$saltar_valor_oferta = false;
						
						// Validamos si el tipo de valor de oferta es una orden de cambio y revisamos su estado para ver si esta aprobado o no
						if($vvalor['proyecto_valor_oferta_tipo_id'] == 6) {
							$this->db->where($this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_id', $vvalor['proyecto_valor_oferta_id']);
							$proyecto_valor_oferta_extension = $this->db->get($this->t_proyecto_valor_oferta_extension);
							$proyecto_valor_oferta_extension_count = $proyecto_valor_oferta_extension->num_rows();
							if ($proyecto_valor_oferta_extension_count > 0) {
								$proyecto_valor_oferta_extension_result = $proyecto_valor_oferta_extension->row_array();
								if ($proyecto_valor_oferta_extension_result['proyecto_valor_oferta_extension_estado_id'] != 2) {
									$saltar_valor_oferta = true;
								}
							}
						}

						if (!$saltar_valor_oferta) {
							$valor_oferta_tmp[$vvalor['proyecto_valor_oferta_tipo_id']][] = $vvalor['valor_oferta'];
						}
					}


					$result_valor_oferta_tipo = $this->db->get($this->t_proyecto_valor_oferta_tipo);
					$result_valor_oferta_tipo_num_rows = $result_valor_oferta_tipo->num_rows();
					if($result_valor_oferta_tipo_num_rows>0){
						$result_valor_oferta_tipo_result = $this->security->xss_clean($result_valor_oferta_tipo->result_array());
						foreach ($result_valor_oferta_tipo_result as $kvtipo => $vvtipo) {
							if(isset($valor_oferta_tmp[$vvtipo['proyecto_valor_oferta_tipo_id']])){
								$subtotal = 0;
								foreach ($valor_oferta_tmp[$vvtipo['proyecto_valor_oferta_tipo_id']] as $kv => $vv) {
									$subtotal+=(double)$vv;
									$total_valor_oferta += (double)$vv;
								}
								$valor_oferta_array[$vvtipo['proyecto_valor_oferta_tipo_id']] = array('tipo_id' => $vvtipo['proyecto_valor_oferta_tipo_id'],
																									'tipo' => $vvtipo['proyecto_valor_oferta_tipo'],
																									'valor' => $subtotal);
							}
						}
						
					}
				}
				$result_array['valor_oferta']['desgloce'] = $valor_oferta_array;
				$result_array['valor_oferta']['total'] = $total_valor_oferta;
				if(isset($proyecto['valor_compra']) && $proyecto['valor_compra']!=null && $proyecto['valor_compra']!=''){
					$result_array['valor_oferta']['total_colones'] = $total_valor_oferta * $proyecto['valor_compra'];
				}else{
					$result_array['valor_oferta']['total_colones'] = $total_valor_oferta * $this->config->item('tipo_cambio_compra');
				}




				// Para manejo de gastos
				$total_gastos = 0;
				$gastos_tmp = array();
				$gastos_array = array();

				$this->db->join($this->t_proyecto_gasto_tipo, $this->t_proyecto_gasto_tipo.'.proyecto_gasto_tipo_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 'LEFT');
				$this->db->join($this->t_proyecto_gasto_monto, $this->t_proyecto_gasto_monto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_monto.'.estado_registro = 1', 'LEFT');
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->order_by($this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 'ASC');
				$result_gastos = $this->db->get($this->t_proyecto_gasto);
				$result_gastos_num_rows = $result_gastos->num_rows();
				if($result_gastos_num_rows >0){
					$result_gastos_result = $this->security->xss_clean($result_gastos->result_array());
					foreach ($result_gastos_result as $kvalor => $vvalor) {
						$monto_gasto = $vvalor['proyecto_gasto_monto'];
						if($vvalor['moneda_id']==2){
							$proyecto_tipo_cambio_venta = $proyecto['valor_venta'];							
							$monto_gasto = $monto_gasto / $proyecto_tipo_cambio_venta;
						}
						$gastos_tmp[$vvalor['proyecto_gasto_tipo_id']][] = $monto_gasto;
					}


					$result_gastos_tipo = $this->db->get($this->t_proyecto_gasto_tipo);
					$result_gastos_tipo_num_rows = $result_gastos_tipo->num_rows();
					if($result_gastos_tipo_num_rows >0){
						$result_gastos_tipo_result = $this->security->xss_clean($result_gastos_tipo->result_array());
						foreach ($result_gastos_tipo_result as $kvtipo => $vvtipo) {
							if(isset($gastos_tmp[$vvtipo['proyecto_gasto_tipo_id']])){
								$subtotal = 0;
								foreach ($gastos_tmp[$vvtipo['proyecto_gasto_tipo_id']] as $kv => $vv) {
									$subtotal+=(double)$vv;
									$total_gastos += (double)$vv;
								}
								$gastos_array[$vvtipo['proyecto_gasto_tipo_id']] = array('tipo_id' => $vvtipo['proyecto_gasto_tipo_id'],
																						'tipo' => $vvtipo['proyecto_gasto_tipo'],
																						'valor' => $subtotal);
							}
						}
						
					}
				}
				$result_array['gastos']['desgloce'] = $gastos_array;
				$result_array['gastos']['total'] = $total_gastos;
				if(isset($proyecto['valor_compra']) && $proyecto['valor_compra']!=null && $proyecto['valor_compra']!=''){
					$result_array['gastos']['total_colones'] = $total_gastos * $proyecto['valor_compra'];
				}else{
					$result_array['gastos']['total_colones'] = $total_gastos * $this->config->item('tipo_cambio_compra');
				}


				// Para obtener horas trabajadas
				$tiempo_mensual = 0;
				$tiempo_semanal = 0;
				$tiempo_diario = 0;
				$tiempo_total = 0;
				$total_colaboradores = 0;
				$tiempo_por_colaborador = array();
				$this->db->select(
					$this->t_colaborador.'.colaborador_id,'.
					$this->t_colaborador.'.nombre,'.
					$this->t_colaborador.'.apellidos,'.
					$this->t_proyecto_gasto.'.fecha_gasto,'.
					$this->t_proyecto_colaborador.'.estado_registro,'.
					$this->t_proyecto_colaborador.'.tipo_relacion,'.
					$this->t_proyecto_gasto_mano_obra.'.cantidad_horas,'.
					$this->t_proyecto_gasto_mano_obra.'.cantidad_horas_extra,'.
					$this->t_proyecto_gasto_mano_obra.'.costo_hora_mano_obra'
				);
				$this->db->join($this->t_proyecto_gasto, $this->t_proyecto_gasto.'.proyecto_gasto_id ='.$this->t_proyecto_gasto_mano_obra.'.proyecto_gasto_id');
				$this->db->join($this->t_proyecto_colaborador, $this->t_proyecto_colaborador.'.proyecto_colaborador_id ='.$this->t_proyecto_gasto_mano_obra.'.proyecto_colaborador_id');
				$this->db->join($this->t_colaborador, $this->t_colaborador.'.colaborador_id ='.$this->t_proyecto_colaborador.'.colaborador_id');
				$this->db->where($this->t_proyecto_gasto.'.proyecto_id', $proyecto_id);
				$this->db->where($this->t_proyecto_gasto_mano_obra.'.estado_registro', 1);
				$result_tiempo_colaboradores = $this->db->get($this->t_proyecto_gasto_mano_obra);
				$result_tiempo_colaboradores_count = $result_tiempo_colaboradores->num_rows();
				if($result_tiempo_colaboradores_count > 0){
					$result_tiempo_colaboradores_rows = $this->security->xss_clean($result_tiempo_colaboradores->result_array());
					foreach ($result_tiempo_colaboradores_rows as $ktiempo => $vtiempo) {
						if(!isset($tiempo_por_colaborador[$vtiempo['colaborador_id']])){
							$tiempo_por_colaborador[$vtiempo['colaborador_id']] = array(
								'detalle' => $vtiempo,
								'total_semanal' => 0,
								'total_mensual' => 0,
								'total_diario' => 0,
								'total' => 0,
							);
							$total_colaboradores++;
						}
						if($vtiempo['fecha_gasto'] >= date('Y-m-01')){
							$tiempo_mensual += ($vtiempo['cantidad_horas']+ $vtiempo['cantidad_horas_extra']);
							$tiempo_por_colaborador[$vtiempo['colaborador_id']]['total_mensual'] += ($vtiempo['cantidad_horas']+ $vtiempo['cantidad_horas_extra']);
						}

						if($vtiempo['fecha_gasto'] >= date('Y-m-d', strtotime('monday this week'))){
							$tiempo_semanal += ($vtiempo['cantidad_horas']+ $vtiempo['cantidad_horas_extra']);
							$tiempo_por_colaborador[$vtiempo['colaborador_id']]['total_semanal'] += ($vtiempo['cantidad_horas']+ $vtiempo['cantidad_horas_extra']);
						}
						if($vtiempo['fecha_gasto'] == date('Y-m-d')){
							$tiempo_diario += ($vtiempo['cantidad_horas']+ $vtiempo['cantidad_horas_extra']);
							$tiempo_por_colaborador[$vtiempo['colaborador_id']]['total_diario'] += ($vtiempo['cantidad_horas']+ $vtiempo['cantidad_horas_extra']);
						}

						$tiempo_total += ($vtiempo['cantidad_horas']+ $vtiempo['cantidad_horas_extra']);
						$tiempo_por_colaborador[$vtiempo['colaborador_id']]['total'] += ($vtiempo['cantidad_horas']+ $vtiempo['cantidad_horas_extra']);
					}

					
					$result_array['tiempo_colaboradores']['desgloce'] = $tiempo_por_colaborador;
				}
				$result_array['tiempo_colaboradores']['totales'] = array(
					'tiempo_mensual' => $tiempo_mensual,
					'tiempo_semanal' => $tiempo_semanal,
					'tiempo_diario' => $tiempo_diario,
					'tiempo_total' => $tiempo_total,
					'total_colaboradores' => $total_colaboradores,
				);


				return $result_array;
			}
		}else{
			return false;
		}
	}


	function eliminarProyecto($proyecto_id){
		if( $proyecto_id!=null ){

			//Elimina los gastos
			$this->db->where('proyecto_id', $proyecto_id);
			$gastos = $this->db->get($this->t_proyecto_gasto);
			$gastos_num_rows = $gastos->num_rows();
			if($gastos_num_rows > 0){
				$gastos_result = $gastos->result();
				foreach ($gastos_result as $kgasto => $vgasto) {
					//Elimina los montos
					$this->db->where('proyecto_gasto_id', $vgasto->proyecto_gasto_id);
					$this->db->delete($this->t_proyecto_gasto_monto);

					//Elimina los detalles
					$this->db->where('proyecto_gasto_id', $vgasto->proyecto_gasto_id);
					$this->db->delete($this->t_proyecto_gasto_detalle);	

					//Elimina los detalles
					$this->db->where('proyecto_gasto_id', $vgasto->proyecto_gasto_id);
					$this->db->delete($this->t_proyecto_gasto_mano_obra);

					//Elimina las relaciones con materiales
					$this->db->where('proyecto_gasto_id', $vgasto->proyecto_gasto_id);
					$this->db->delete($this->t_proyecto_gasto_material);					
				}


				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->delete($this->t_proyecto_gasto);
			}

			//Elimina los valores de oferta
			$this->db->where('proyecto_id', $proyecto_id);
			$valores_oferta = $this->db->get($this->t_proyecto_valor_oferta);
			$valores_oferta_num_rows = $valores_oferta->num_rows();
			if($valores_oferta_num_rows > 0){
				$valores_oferta_result = $valores_oferta->result();
				foreach ($valores_oferta_result as $kvalor => $vvalor) {
					//Si es un valor de tipo extension borra la extension
					if($vvalor->proyecto_valor_oferta_tipo_id==6){
						// Elimina lo datos de comentarios en caso de ser una orden rechazada
						$this->db->where($this->t_proyecto_valor_oferta_extension_rechazo.'.proyecto_valor_oferta_id', $vvalor->proyecto_valor_oferta_id);
						$this->db->delete($this->t_proyecto_valor_oferta_extension_rechazo);	

						// Elimina los cambios de esta orden de cambio
						$this->db->where($this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_id', $vvalor->proyecto_valor_oferta_id);
						$this->db->delete($this->t_proyecto_valor_oferta_extension_cambio);	

						$this->db->where($this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_id', $vvalor->proyecto_valor_oferta_id);
						$this->db->delete($this->t_proyecto_valor_oferta_extension);		
					}
				}
				//Borra el valor de la oferta
				$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_id', $proyecto_id);
				$this->db->delete($this->t_proyecto_valor_oferta);
			}


			// Borra el tipo de cambio
			$this->db->where($this->t_proyecto_tipo_cambio.'.proyecto_id', $proyecto_id);
			$this->db->delete($this->t_proyecto_tipo_cambio);

			//Elimina los materiales
			$this->db->where('proyecto_id', $proyecto_id);
			$materiales = $this->db->get($this->t_proyecto_material);
			$materiales_num_rows = $materiales->num_rows();
			if($materiales_num_rows > 0){
				$materiales_result = $materiales->result();
				foreach ($materiales_result as $kmaterial => $vmaterial) {
					// Borra los detalles de materiales
					$this->db->where($this->t_proyecto_material_detalle.'.proyecto_material_id', $vmaterial->proyecto_material_id);
					$this->db->delete($this->t_proyecto_material_detalle);
				}
				//Borra los materiales
				$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
				$this->db->delete($this->t_proyecto_material);
			}

			$this->db->where('proyecto_id', $proyecto_id);
			$solicitudes_cotizacion = $this->db->get($this->t_proyecto_material_solicitud_cotizacion);
			$solicitudes_cotizacion_num_rows = $solicitudes_cotizacion->num_rows();
			if($solicitudes_cotizacion_num_rows > 0){
				//Borra las cotizaciones
				$this->db->where($this->t_proyecto_material_solicitud_cotizacion.'.proyecto_id', $proyecto_id);
				$this->db->delete($this->t_proyecto_material_solicitud_cotizacion);
			}

			// Borra informacion de proformas y ordenes de materiales
			$this->db->where($this->t_proyecto_material_solicitud_compra.'.proyecto_id', $proyecto_id);
			$solicitud_compra = $this->db->get($this->t_proyecto_material_solicitud_compra);
			$solicitud_compra_count = $solicitud_compra->num_rows();
			if($solicitud_compra_count > 0){
				$solicitud_compra_rows = $solicitud_compra->result();
				foreach ($solicitud_compra_rows as $ksolicitud => $vsolicitud) {
					$this->db->where('proyecto_material_solicitud_compra_id', $vsolicitud->proyecto_material_solicitud_compra_id);
					$this->db->delete($this->t_proyecto_material_solicitud_compra_proforma);

					$this->db->where('proyecto_material_solicitud_compra_id', $vsolicitud->proyecto_material_solicitud_compra_id);
					$this->db->delete($this->t_proyecto_material_solicitud_compra_orden_compra);

					$this->db->where('proyecto_material_solicitud_compra_id', $vsolicitud->proyecto_material_solicitud_compra_id);
					$this->db->delete($this->t_proyecto_material_solicitud_compra_detalle);
				}
				//Borra las solicitudes de compra
				$this->db->where($this->t_proyecto_material_solicitud_compra.'.proyecto_id', $proyecto_id);
				$this->db->delete($this->t_proyecto_material_solicitud_compra);
			}

			// Borra el proyecto
			$this->db->where($this->t_proyecto.'.proyecto_id', $proyecto_id);
			$this->db->delete($this->t_proyecto);

			return true;
		}else{
			return false;
		}
	}



	/* Esta consulta es para los casos en que se consulta desde php y no por angular o jquery */

	function consultaAllExtensiones($proyecto_id){
		if($proyecto_id!=null){
			$this->db->join($this->t_proyecto_valor_oferta_extension_detalle, $this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_id = '.$this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', 'LEFT');
			$this->db->join($this->t_proyecto_valor_oferta_extension_tipo, $this->t_proyecto_valor_oferta_extension_tipo.'.proyecto_valor_oferta_extension_tipo_id = '.$this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_extension_tipo_id', 'LEFT');
			$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_tipo_id', 6);
			$result_extensiones = $this->db->get($this->t_proyecto_valor_oferta);
			if($result_extensiones->num_rows()> 0){
				$result= $this->security->xss_clean($result_extensiones->result_array());
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	/*Esta consulta es para los casos en que se consulta por angular y confiltros*/


	function consultaAllExtensionesConFiltros($data){
		//Consulta primero los datos
		$this->db->select($this->t_proyecto_valor_oferta.'.*, '.$this->t_proyecto_valor_oferta_extension.'.*, '.$this->t_proyecto_valor_oferta_extension_estado.'.proyecto_valor_oferta_extension_estado');
		$this->db->join($this->t_proyecto_valor_oferta_extension, $this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_id = '.$this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', 'LEFT');
		$this->db->join($this->t_proyecto_valor_oferta_extension_estado, $this->t_proyecto_valor_oferta_extension_estado.'.proyecto_valor_oferta_extension_estado_id = '.$this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_extension_estado_id', 'LEFT');
		

		$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_tipo_id', 6);

		if(isset($data['filtros'])){			
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='proyecto_valor_oferta_extension_estado_id'){
						$this->db->where($this->t_proyecto_valor_oferta_extension_estado.'.'.$key, $value);
					} else if($key=='fecha_registro'){
						if($value['from']!='' && $value['from']!='undefined' && $value['from']!='IS NULL'){
							$value['from'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['from'])));
							$this->db->where($this->t_proyecto_valor_oferta.'.'.$key.'>="'.$value['from'].'"');
						}

						if($value['to']!='' && $value['to']!='undefined' && $value['to']!='IS NULL'){
							$value['to'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['to'])));
							$this->db->where($this->t_proyecto_valor_oferta.'.'.$key.'<="'.$value['to'].'"');	
						}
					}else{
						$this->db->where($this->t_proyecto_valor_oferta.'.'.$key, $value);
					}
					
				}
			}
		}

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

		$this->db->order_by($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', 'ASC');

		$result_extensiones = $this->db->get($this->t_proyecto_valor_oferta);

		//vuelve a hacer la consulta para obtener el total de rows 

		/*
		$this->db->join($this->t_proyecto_valor_oferta_extension_detalle, $this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_id = '.$this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', 'LEFT');
		$this->db->join($this->t_proyecto_valor_oferta_extension_tipo, $this->t_proyecto_valor_oferta_extension_tipo.'.proyecto_valor_oferta_extension_tipo_id = '.$this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_extension_tipo_id', 'LEFT');
		
		$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_tipo_id', 6);

		if(isset($data['filtros'])){			
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='fecha_registro'){
						if($value['from']!='' && $value['from']!='undefined' && $value['from']!='IS NULL'){
							$value['from'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['from'])));
							$this->db->where($this->t_proyecto_valor_oferta.'.'.$key.'>="'.$value['from'].'"');
						}

						if($value['to']!='' && $value['to']!='undefined' && $value['to']!='IS NULL'){
							$value['to'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['to'])));
							$this->db->where($this->t_proyecto_valor_oferta.'.'.$key.'<="'.$value['to'].'"');	
						}
					}else{
						$this->db->where($this->t_proyecto_valor_oferta.'.'.$key, $value);
					}
					
				}
			}
		}
		$total_rows = $this->db->count_all_results($this->t_cliente, FALSE);*/

		if($result_extensiones->num_rows()>0){
			$result = array(
							'total_rows' => $result_extensiones->num_rows(),
							'datos' => $this->security->xss_clean($result_extensiones->result_array()),
							);

			return $result;

		}else{
			return false;
		}
		

	}

	function consultarTiposExtensiones(){
		$this->db->where('estado_registro', 1);
		$result_extensiones_tipos = $this->db->get($this->t_proyecto_valor_oferta_extension_tipo);

		if($result_extensiones_tipos->num_rows()>0){
			return $this->security->xss_clean($result_extensiones_tipos->result_array());
		}else{
			return false;
		}

	}

	function consultarEstadosExtensiones(){
		$result_extensiones_estados = $this->db->get($this->t_proyecto_valor_oferta_extension_estado);

		if($result_extensiones_estados->num_rows()>0){
			return $this->security->xss_clean($result_extensiones_estados->result_array());
		}else{
			return false;
		}

	}

	function consultarUnidadesExtensiones(){
		$result_extensiones_unidades = $this->db->get($this->t_proyecto_valor_oferta_extension_unidad);

		if($result_extensiones_unidades->num_rows()>0){
			return $this->security->xss_clean($result_extensiones_unidades->result_array());
		}else{
			return false;
		}

	}


	function consultarExtension($extension_id){
		if($extension_id!=null){
			$this->db->join($this->t_proyecto_valor_oferta_extension_estado, $this->t_proyecto_valor_oferta_extension_estado.'.proyecto_valor_oferta_extension_estado_id = '.$this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_extension_estado_id');
			$this->db->where($this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_id', $extension_id);
			$proyecto_valor_oferta_extension_result = $this->db->get($this->t_proyecto_valor_oferta_extension);
			if($proyecto_valor_oferta_extension_result->num_rows() > 0){
				return $this->security->xss_clean($proyecto_valor_oferta_extension_result->row_array());
			}else{
				return false;
			}
		}
	}


	function actualizarExtension($extension_id, $datos){
		if($extension_id!=null && $datos!=null){
			$this->db->where('proyecto_valor_oferta_id', $extension_id);
			$proyecto_valor_oferta_extension_result = $this->db->get($this->t_proyecto_valor_oferta);
			if($proyecto_valor_oferta_extension_result->num_rows() > 0){ 
				$datos2 = $datos;
				$datos3 = $datos;
				unset($datos2['comentarios']);
				$datos2['tiene_impuesto'] = str_replace('number:', '', $datos2['tiene_impuesto']);
				if (isset($datos2['proyecto_valor_oferta_extension_estado_id'])) {
					$datos2['proyecto_valor_oferta_extension_estado_id'] = str_replace('number:', '', $datos2['proyecto_valor_oferta_extension_estado_id']);
				}
				$this->db->where('proyecto_valor_oferta_id', $extension_id);
				$this->db->update($this->t_proyecto_valor_oferta_extension, $datos2);

				unset($datos['proyecto_valor_oferta_extension_estado_id']);
				unset($datos['tiene_impuesto']);
				unset($datos['impuesto']);
				unset($datos['comentarios']);
				$totales_valor_oferta = $this->consultarTotalValorOfertaExtension($extension_id);
				$datos['valor_oferta'] = $totales_valor_oferta['total'];
				$this->db->where('proyecto_valor_oferta_id', $extension_id);
				$this->db->update($this->t_proyecto_valor_oferta, $datos);

				if (isset($datos3['comentarios']) && $datos3['comentarios'] != '') {
					$this->db->where('proyecto_valor_oferta_id', $extension_id);
					$comentarios = $this->db->get($this->t_proyecto_valor_oferta_extension_rechazo);
					$comentarios_count = $comentarios->num_rows();
					if ($comentarios_count > 0) {
						$this->db->set('comentarios', $datos3['comentarios']);
						$this->db->where('proyecto_valor_oferta_id', $extension_id);
						$this->db->update($this->t_proyecto_valor_oferta_extension_rechazo);
					} else {
						$this->db->set('comentarios', $datos3['comentarios']);
						$this->db->set('proyecto_valor_oferta_id', $extension_id);
						$this->db->insert($this->t_proyecto_valor_oferta_extension_rechazo);
					}

				}

				return array('tipo' => 'success',
						'texto' => 'Extensión editada con éxito',
						'inserted_id'=> $extension_id);
			}else{
				return array('tipo' => 'danger',
						'texto' => 'No existe la extensión indicada en la Base de Datos',
						'inserted_id'=> $extension_id);
			}
		}
	}

	function insertarExtension($proyecto_id,$datos){
		if($proyecto_id!=null && $datos!=null){
			$datos2 = $datos;	
			$datos3 = $datos;		
			$datos['fecha_registro'] = date('Y-m-d H:i:s');			
			$datos['moneda_id'] = 1;
			$datos['proyecto_id'] = $proyecto_id;
			$datos['proyecto_valor_oferta_tipo_id'] = 6;
			$datos['estado_registro'] = 1;
			//$datos['valor_oferta'] = str_replace(' ', '',$datos['valor_oferta']);
			$datos['valor_oferta'] = 0;
			unset($datos['proyecto_valor_oferta_extension_estado_id']);
			unset($datos['tiene_impuesto']);
			unset($datos['impuesto']);
			unset($datos['comentarios']);
			$this->db->insert($this->t_proyecto_valor_oferta, $datos);
			$proyecto_valor_oferta_id = $this->db->insert_id();

			unset($datos2['comentarios']);
			$datos2['proyecto_valor_oferta_id'] = $proyecto_valor_oferta_id;
			$datos2['proyecto_valor_oferta_extension_codigo'] = '';
			
			if (!isset($datos2['proyecto_valor_oferta_extension_estado_id'])) {
				$datos2['proyecto_valor_oferta_extension_estado_id'] = 1;
			}

			if ($datos2['tiene_impuesto'] == 0) {
				$datos2['impuesto'] = 0;
			}
			$this->db->insert($this->t_proyecto_valor_oferta_extension, $datos2);

			$proyecto_valor_oferta_extension_id = $this->db->insert_id();
			$codigo_extension = $proyecto_id.'-'.$proyecto_valor_oferta_id;
			$this->db->set('proyecto_valor_oferta_extension_codigo', $codigo_extension);
			$this->db->where('proyecto_valor_oferta_extension_id', $proyecto_valor_oferta_extension_id);
			$this->db->update($this->t_proyecto_valor_oferta_extension);
			

			if (isset($datos3['comentarios']) && $datos3['comentarios'] != '') {
				$this->db->set('comentarios', $datos3['comentarios']);
				$this->db->set('proyecto_valor_oferta_id', $proyecto_valor_oferta_id);
				$this->db->insert($this->t_proyecto_valor_oferta_extension_rechazo);

			}

			return array('tipo' => 'success',
						'texto' => 'Extensión ingresada con éxito',
						'inserted_id'=> $proyecto_valor_oferta_id);
			

		}
	}

	function eliminarExtension($extension_id){
		if( $extension_id!=null ){
			// Elimina lo datos de comentarios en caso de ser una orden rechazada
			$this->db->where($this->t_proyecto_valor_oferta_extension_rechazo.'.proyecto_valor_oferta_id', $extension_id);
			$this->db->delete($this->t_proyecto_valor_oferta_extension_rechazo);	

			// Elimina los cambios de esta orden de cambio
			$this->db->where($this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_id', $extension_id);
			$this->db->delete($this->t_proyecto_valor_oferta_extension_cambio);	

			// Elimina la extension
			$this->db->where($this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_id', $extension_id);
			$this->db->delete($this->t_proyecto_valor_oferta_extension);		


			// elimina el valor de la oferta
			$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', $extension_id);
			$this->db->delete($this->t_proyecto_valor_oferta);

			return true;
		}else{
			return false;
		}
	}


	function consultarExtensionRechazo($extension_id) {
		$this->db->where('proyecto_valor_oferta_id', $extension_id);
		$result_rechazo = $this->db->get($this->t_proyecto_valor_oferta_extension_rechazo);
		$result_rechazo_count = $result_rechazo->num_rows();
		if ($result_rechazo_count > 0) {
			return $this->security->xss_clean($result_rechazo->row_array());
		} else {
			return false;
		}
	}


	function consultarAllExtensionCambios($data) {
		//Consulta primero los datos
		$this->db->select($this->t_proyecto_valor_oferta_extension_cambio.'.*, '.$this->t_proyecto_valor_oferta_extension_tipo.'.proyecto_valor_oferta_extension_tipo, '.$this->t_proyecto_valor_oferta_extension_unidad.'.proyecto_valor_oferta_extension_unidad, '.$this->t_proyecto_valor_oferta_extension_unidad.'.proyecto_valor_oferta_extension_unidad_simbolo');
		$this->db->join($this->t_proyecto_valor_oferta_extension_tipo, $this->t_proyecto_valor_oferta_extension_tipo.'.proyecto_valor_oferta_extension_tipo_id = '.$this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_extension_tipo_id', 'LEFT');
		$this->db->join($this->t_proyecto_valor_oferta_extension_unidad, $this->t_proyecto_valor_oferta_extension_unidad.'.proyecto_valor_oferta_extension_unidad_id = '.$this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_extension_unidad_id', 'LEFT');
		
		if(isset($data['filtros'])){			
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='proyecto_valor_oferta_extension_tipo_id'){
						$this->db->where($this->t_proyecto_valor_oferta_extension_tipo.'.'.$key, $value);
					}else{
						$this->db->where($this->t_proyecto_valor_oferta_extension_cambio.'.'.$key, $value);
					}
					
				}
			}
		}

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
		$this->db->order_by($this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_extension_cambio_id', 'ASC');

		$result_extensiones_cambios = $this->db->get($this->t_proyecto_valor_oferta_extension_cambio);
		$result_extensiones_cambios_result = $this->security->xss_clean($result_extensiones_cambios->result_array());

		// Consutla la informacion del proyecto
		$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', $data['filtros']['proyecto_valor_oferta_id']);
		$this->db->join($this->t_proyecto, $this->t_proyecto.'.proyecto_id = '.$this->t_proyecto_valor_oferta.'.proyecto_id');
		$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto.'.proyecto_id', 'LEFT');
		$proyecto_result = $this->db->get($this->t_proyecto_valor_oferta);
		$proyecto = $proyecto_result->row_array();

		foreach ($result_extensiones_cambios_result as $key => $value) {
			if ($value['moneda_id'] == 2) {
				$proyecto_tipo_cambio_venta = $proyecto['valor_venta'];							
				$result_extensiones_cambios_result[$key]['total'] = $value['total'] / $proyecto_tipo_cambio_venta;
			}
		}



		if($result_extensiones_cambios->num_rows()>0){
			$result = array(
							'total_rows' => $result_extensiones_cambios->num_rows(),
							'datos' => $result_extensiones_cambios_result,
							);

			return $result;

		}else{
			return false;
		}
	}

	function consultarExtensionCambio($proyecto_extension_cambio_id) {
		if($proyecto_extension_cambio_id !== null){
			$this->db->where($this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_extension_cambio_id', $proyecto_extension_cambio_id);
			$proyecto_valor_oferta_extension_cambios_result = $this->db->get($this->t_proyecto_valor_oferta_extension_cambio);
			if($proyecto_valor_oferta_extension_cambios_result->num_rows() > 0){
				return $this->security->xss_clean($proyecto_valor_oferta_extension_cambios_result->row_array());
			}else{
				return false;
			}
		}
	}


	
	function insertarExtensionCambio($proyecto_extension_id, $datos) {
		if($proyecto_extension_id !== null && $datos!=null){
			foreach ($datos as $key => $value) {
				$datos[$key] = str_replace('number:', '', $value);
			}
			$datos['proyecto_valor_oferta_id'] = $proyecto_extension_id;
			$datos['precio_unitario'] = str_replace(' ', '', $datos['precio_unitario']);
			$datos['total'] = str_replace(' ', '', $datos['total']);
			$this->db->insert($this->t_proyecto_valor_oferta_extension_cambio, $datos);
			$proyecto_valor_oferta_extension_cambio_id = $this->db->insert_id();

			$this->actualizarTotalValorOfertaExtension($proyecto_extension_id);

			return array('tipo' => 'success',
						'texto' => 'Extensión ingresada con éxito',
						'inserted_id'=> $proyecto_valor_oferta_extension_cambio_id);
			

		}
	}

	function actualizarExtensionCambio($proyecto_extension_id, $proyecto_extension_cambio_id, $datos) {
		if($proyecto_extension_cambio_id !== null && $datos!=null){
			foreach ($datos as $key => $value) {
				$datos[$key] = str_replace('number:', '', $value);
			}
			$datos['precio_unitario'] = str_replace(' ', '', $datos['precio_unitario']);
			$datos['total'] = str_replace(' ', '', $datos['total']);
			$this->db->where($this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_extension_cambio_id', $proyecto_extension_cambio_id);
			$this->db->update($this->t_proyecto_valor_oferta_extension_cambio, $datos);
			$proyecto_valor_oferta_extension_cambio_id = $this->db->insert_id();

			$this->actualizarTotalValorOfertaExtension($proyecto_extension_id);


			return array('tipo' => 'success',
						'texto' => 'Extensión actualizada con éxito',
						'inserted_id'=> $proyecto_valor_oferta_extension_cambio_id);
			

		}
	}


	function eliminarExtensionCambio($proyecto_extension_cambio_id){
		if( $proyecto_extension_cambio_id!=null ){
			$this->db->where($this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_extension_cambio_id', $proyecto_extension_cambio_id);
			$result_extension = $this->db->get($this->t_proyecto_valor_oferta_extension_cambio);
			$result_extension_row = $result_extension->row_array();
			$proyecto_extension_id = $result_extension_row['proyecto_valor_oferta_id'];

			$this->db->where($this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_extension_cambio_id', $proyecto_extension_cambio_id);
			$this->db->delete($this->t_proyecto_valor_oferta_extension_cambio);

			$this->actualizarTotalValorOfertaExtension($proyecto_extension_id);
			return true;
		}else{
			return false;
		}
	}


	function consultarTotalValorOfertaExtension($proyecto_extension_id) {
		// Consutla la informacion del proyecto
		$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', $proyecto_extension_id);
		$this->db->join($this->t_proyecto, $this->t_proyecto.'.proyecto_id = '.$this->t_proyecto_valor_oferta.'.proyecto_id');
		$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto.'.proyecto_id', 'LEFT');
		$proyecto_result = $this->db->get($this->t_proyecto_valor_oferta);
		$proyecto = $proyecto_result->row_array();

		$this->db->join($this->t_proyecto_valor_oferta_extension, $this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_id = '.$this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_id');
		$this->db->where($this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_id', $proyecto_extension_id);
		$proyecto_valor_oferta_extension_cambios_result = $this->db->get($this->t_proyecto_valor_oferta_extension_cambio);
		$proyecto_valor_oferta_extension_cambios_result_count = $proyecto_valor_oferta_extension_cambios_result->num_rows();
		if ($proyecto_valor_oferta_extension_cambios_result_count > 0){
			$proyecto_valor_oferta_extension_cambios_result_rows = $proyecto_valor_oferta_extension_cambios_result->result_array();
			$subtotal = 0;
			$impuesto = 0;
			$total = 0;
			foreach ($proyecto_valor_oferta_extension_cambios_result_rows as $kcambio => $vcambio) {
				$total_cambio = $vcambio['total'];
				if ($vcambio['tipo_operacion'] == 2) {
					$total_cambio = $total_cambio * -1;
				}

				//Convertir a Dolares si esta en colones

				if($vcambio['moneda_id']==2){
					$proyecto_tipo_cambio_venta = $proyecto['valor_venta'];							
					$total_cambio = $total_cambio / $proyecto_tipo_cambio_venta;
				}

				$subtotal = $subtotal + $total_cambio;
			}
			
			if ($subtotal > 0) {
				if ($proyecto_valor_oferta_extension_cambios_result_rows[0]['tiene_impuesto'] == 1){
					if ($proyecto_valor_oferta_extension_cambios_result_rows[0]['impuesto'] !== '' && $proyecto_valor_oferta_extension_cambios_result_rows[0]['impuesto'] !== null && $proyecto_valor_oferta_extension_cambios_result_rows[0]['impuesto'] > 0) {
						$impuesto = ($subtotal / 100) * $proyecto_valor_oferta_extension_cambios_result_rows[0]['impuesto'];
					}
				}
			}

			$total = $subtotal + $impuesto;

			$result = array(
				'subtotal' => $subtotal,
				'impuesto' => $impuesto,
				'total' => $total,
			);
			return $result;
		}else{
			return false;
		}
	}

	function actualizarTotalValorOfertaExtension($extension_id) {
		// Consutla la informacion del proyecto
		$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', $extension_id);
		$this->db->join($this->t_proyecto, $this->t_proyecto.'.proyecto_id = '.$this->t_proyecto_valor_oferta.'.proyecto_id');
		$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto.'.proyecto_id', 'LEFT');
		$proyecto_result = $this->db->get($this->t_proyecto_valor_oferta);
		$proyecto = $proyecto_result->row_array();


		$this->db->join($this->t_proyecto_valor_oferta_extension, $this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_id = '.$this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_id');
		$this->db->where($this->t_proyecto_valor_oferta_extension_cambio.'.proyecto_valor_oferta_id', $extension_id);
		$proyecto_valor_oferta_extension_cambios_result = $this->db->get($this->t_proyecto_valor_oferta_extension_cambio);
		$proyecto_valor_oferta_extension_cambios_result_count = $proyecto_valor_oferta_extension_cambios_result->num_rows();
		if ($proyecto_valor_oferta_extension_cambios_result_count > 0){
			$proyecto_valor_oferta_extension_cambios_result_rows = $proyecto_valor_oferta_extension_cambios_result->result_array();
			$subtotal = 0;
			$impuesto = 0;
			$total = 0;
			foreach ($proyecto_valor_oferta_extension_cambios_result_rows as $kcambio => $vcambio) {
				$total_cambio = $vcambio['total'];
				if ($vcambio['tipo_operacion'] == 2) {
					$total_cambio = $total_cambio * -1;
				}

				//Convertir a Dolares si esta en colones

				if($vcambio['moneda_id']==2){
					$proyecto_tipo_cambio_venta = $proyecto['valor_venta'];							
					$total_cambio = $total_cambio / $proyecto_tipo_cambio_venta;
				}


				$subtotal = $subtotal + $total_cambio;
			}
			
			if ($subtotal > 0) {
				if ($proyecto_valor_oferta_extension_cambios_result_rows[0]['tiene_impuesto'] == 1){
					if ($proyecto_valor_oferta_extension_cambios_result_rows[0]['impuesto'] !== '' && $proyecto_valor_oferta_extension_cambios_result_rows[0]['impuesto'] !== null && $proyecto_valor_oferta_extension_cambios_result_rows[0]['impuesto'] > 0) {
						$impuesto = ($subtotal / 100) * $proyecto_valor_oferta_extension_cambios_result_rows[0]['impuesto'];
					}
				}
			}

			$total = $subtotal + $impuesto;

			$this->db->set('valor_oferta', $total);
			$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', $proyecto_valor_oferta_extension_cambios_result_rows[0]['proyecto_valor_oferta_id']);
			$this->db->update($this->t_proyecto_valor_oferta);
		}else{
			return false;
		}
	}


	function migrarExtensionesSinCambios() {
		$this->db->join($this->t_proyecto_valor_oferta, $this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id = '.$this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_id');
		$result_extensiones_viejas = $this->db->get($this->t_proyecto_valor_oferta_extension_detalle);
		$result_extensiones_viejas_rows = $result_extensiones_viejas->result_array();

		$extensiones = array();
		$extensiones_cambios = array();
		foreach ($result_extensiones_viejas_rows as $koferta => $voferta) {
			$extension_nueva = array(
				'proyecto_valor_oferta_id' => $voferta['proyecto_valor_oferta_id'],
				'proyecto_valor_oferta_extension_estado_id' => 2,
				'proyecto_valor_oferta_extension_codigo' => $voferta['proyecto_id'].'-'.$voferta['proyecto_valor_oferta_id'],
				'tiene_impuesto' => 0,
				'impuesto' => 0,
			);

			$extension_cambio_nueva = array(
				'proyecto_valor_oferta_id' => $voferta['proyecto_valor_oferta_id'],
				'proyecto_valor_oferta_extension_tipo_id' => $voferta['proyecto_valor_oferta_extension_tipo_id'],
				'tipo_operacion' => ($voferta['valor_oferta'] >= 0)?1:2,
				'lamina_arquitectonica' => '',
				'cantidad' => 1,
				'proyecto_valor_oferta_extension_unidad_id' => 4,
				'moneda_id' => 1,
				'precio_unitario' => $voferta['valor_oferta'],
				'total' => $voferta['valor_oferta'],
				'descripcion' => $voferta['proyecto_valor_oferta_extension_descripcion'],
			);
			$extensiones[] = $extension_nueva;
			$extensiones_cambios[] = $extension_cambio_nueva;
			$this->db->insert($this->t_proyecto_valor_oferta_extension, $extension_nueva);
			$this->db->insert($this->t_proyecto_valor_oferta_extension_cambio, $extension_cambio_nueva);
		}
		return array(
			'extensiones' => $extensiones,
			'extensiones_cambios' => $extensiones_cambios,
		);
	}

	function migrarPathsArchivosViejos() {
		$archivos = array();
		$ordenes_compra = $this->db->get($this->t_proyecto_material_solicitud_compra_orden_compra);
		$ordenes_compra_count = $ordenes_compra->num_rows();
		if ($ordenes_compra_count > 0) {
			$ordenes_compra_rows = $ordenes_compra->result_array();
			foreach ($ordenes_compra_rows as $korden => $vorden) {
				$url_archivo_migrado = str_replace('instatec_pub', 'src/instatec_pub', $vorden['url_archivo']);
				$this->db->set('url_archivo', $url_archivo_migrado);
				$this->db->where('proyecto_material_solicitud_compra_orden_compra_id', $vorden['proyecto_material_solicitud_compra_orden_compra_id']);
				$this->db->update($this->t_proyecto_material_solicitud_compra_orden_compra);
				$archivos[] = $url_archivo_migrado;
			}
		}

		$proformas = $this->db->get($this->t_proyecto_material_solicitud_compra_proforma);
		$proformas_count = $proformas->num_rows();
		if ($proformas_count > 0) {
			$proformas_rows = $proformas->result_array();
			foreach ($proformas_rows as $kproforma => $vproforma) {
				$url_archivo_migrado = str_replace('instatec_pub', 'src/instatec_pub', $vproforma['url_archivo']);
				$this->db->set('url_archivo', $url_archivo_migrado);
				$this->db->where('proyecto_material_solicitud_compra_proforma_id', $vproforma['proyecto_material_solicitud_compra_proforma_id']);
				$this->db->update($this->t_proyecto_material_solicitud_compra_proforma);
				$archivos[] = $url_archivo_migrado;
			}
		}

		$cotizaciones = $this->db->get($this->t_proyecto_material_solicitud_cotizacion);
		$cotizaciones_count = $cotizaciones->num_rows();
		if ($cotizaciones_count > 0) {
			$cotizaciones_rows = $cotizaciones->result_array();
			foreach ($cotizaciones_rows as $kcotizacion => $vcotizacion) {
				$url_archivo_migrado = str_replace('instatec_pub', 'src/instatec_pub', $vcotizacion['url_archivo']);
				$this->db->set('url_archivo', $url_archivo_migrado);
				$this->db->where('proyecto_material_solicitud_cotizacion_id', $vcotizacion['proyecto_material_solicitud_cotizacion_id']);
				$this->db->update($this->t_proyecto_material_solicitud_cotizacion);
				$archivos[] = $url_archivo_migrado;
			}
		}

		return $archivos;
		
	}

	

	function rechazarOrdenCambioCliente($data){
		if ($data != null) {
			$this->db->set('proyecto_valor_oferta_extension_estado_id', 3);
			$this->db->where('proyecto_valor_oferta_id', $data['proyecto_valor_oferta_id']);
			$this->db->update($this->t_proyecto_valor_oferta_extension);

			$this->db->set('proyecto_valor_oferta_id', $data['proyecto_valor_oferta_id']);
			$this->db->set('comentarios', $data['comentarios']);
			$this->db->insert($this->t_proyecto_valor_oferta_extension_rechazo);
			
		}

	}

	function aprobarOrdenCambioCliente($data){
		if ($data != null) {
			$this->db->set('proyecto_valor_oferta_extension_estado_id', 2);
			$this->db->where('proyecto_valor_oferta_id', $data['proyecto_valor_oferta_id']);
			$this->db->update($this->t_proyecto_valor_oferta_extension);
		}
	}

	/* Para manejo de contactos */
	function consultaAllContactos($filtros){
		if($filtros['filtros']['proyecto_id']!=null){
			$this->db->join($this->t_contacto, $this->t_contacto.'.contacto_id = '.$this->t_proyecto_contacto.'.contacto_id', 'LEFT');
			$this->db->where($this->t_proyecto_contacto.'.proyecto_id', $filtros['filtros']['proyecto_id']);
			$result_contactos = $this->db->get($this->t_proyecto_contacto);
			if($result_contactos->num_rows()> 0){
				$result = array(
					'total_rows' => $result_contactos->num_rows(),
					'datos' =>  $this->security->xss_clean($result_contactos->result_array()),
				);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function insertarContacto($proyecto_id,$datos){
		if($proyecto_id!=null && $datos!=null){
			$this->db->where($this->t_contacto.'.correo_contacto', $datos['correo_contacto']);
			$contacto_existente = $this->db->get($this->t_contacto);
			$contacto_existente_count = $contacto_existente->num_rows();
			if ($contacto_existente_count > 0) {
				$contacto_existente_row = $contacto_existente->row_array();
				$contacto_id = $contacto_existente_row['contacto_id'];
				// Actualiza el contacto
				$this->db->where($this->t_contacto.'.correo_contacto', $datos['correo_contacto']);
				$this->db->update($this->t_contacto, $datos);
			} else {
				// Ingresa el contacto nuevo
				$this->db->insert($this->t_contacto, $datos);
				$contacto_id = $this->db->insert_id();
			}
			
			$this->db->set('proyecto_id', $proyecto_id);
			$this->db->set('contacto_id', $contacto_id);
			$this->db->insert($this->t_proyecto_contacto);

			return array('tipo' => 'success',
						'texto' => 'Contacto registrado con éxito',
						'inserted_id'=> $contacto_id);
			

		}
	}

	function actualizarContacto($contacto_id,$datos){
		if($contacto_id!=null && $datos!=null){
			$this->db->where($this->t_contacto.'.contacto_id', $contacto_id);
			$contacto_existente = $this->db->get($this->t_contacto);
			$contacto_existente_count = $contacto_existente->num_rows();
			if ($contacto_existente_count > 0) {
				// Actualiza el contacto
				$this->db->where($this->t_contacto.'.contacto_id', $contacto_id);
				$this->db->update($this->t_contacto, $datos);
			}

			return array('tipo' => 'success',
						'texto' => 'Contacto actualizado con éxito',
						'inserted_id'=> $contacto_id);
			

		}
	}

	function consultarContacto($contacto_id){
		if($contacto_id!=null){
			$this->db->where($this->t_contacto.'.contacto_id', $contacto_id);
			$contacto_existente = $this->db->get($this->t_contacto);
			$contacto_existente_count = $contacto_existente->num_rows();
			if($contacto_existente_count > 0){
				return $this->security->xss_clean($contacto_existente->row_array());
			}else{
				return false;
			}
		}
	}


	function desvincularContacto($proyecto_id, $contacto_id){
		if($proyecto_id!=null && $contacto_id!=null){
			$this->db->where($this->t_proyecto_contacto.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_contacto.'.contacto_id', $contacto_id);
			$contacto_proyecto_existenate = $this->db->get($this->t_proyecto_contacto);
			$contacto_proyecto_existenate_count = $contacto_proyecto_existenate->num_rows();
			if ($contacto_proyecto_existenate_count > 0){
				$this->db->where($this->t_proyecto_contacto.'.contacto_id', $contacto_id);
				$total_contactos = $this->db->get($this->t_proyecto_contacto);
				$total_contactos_count = $total_contactos->num_rows();

				$this->db->where($this->t_proyecto_contacto.'.proyecto_id', $proyecto_id);
				$this->db->where($this->t_proyecto_contacto.'.contacto_id', $contacto_id);
				$this->db->delete($this->t_proyecto_contacto);
				if ($total_contactos_count < 2) {
					// Si solo habia un proyecto con este contacto se elimina el contacto del todo de la base de datos
					$this->eliminarContacto($contacto_id);
				}
				return true;
			}
			return false;
		} else {
			return false;
		}
	}

	function eliminarContacto($contacto_id){
		if($contacto_id!=null){
			$this->db->where($this->t_contacto.'.contacto_id', $contacto_id);
			$this->db->delete($this->t_contacto);
		}
	}

	function consultarContactosPorID($correos_ids) {
		$this->db->where_in($this->t_contacto.'.contacto_id', $correos_ids);
		$correos_result = $this->db->get($this->t_contacto);
		$correos_result_count = $correos_result->num_rows();
		if ($correos_result_count > 0) {
			return $this->security->xss_clean($correos_result->result_array());
		} else {
			return false;
		}
	}


	/* Para manejo de gastos */



	/* Esta consulta es para los casos en que se consulta desde php y no por angular o jquery */

	function consultaAllGastos($proyecto_id){
		if($proyecto_id!=null){
			$this->db->join($this->t_proyecto_valor_oferta_extension_detalle, $this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_id = '.$this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', 'LEFT');
			$this->db->join($this->t_proyecto_valor_oferta_extension_tipo, $this->t_proyecto_valor_oferta_extension_tipo.'.proyecto_valor_oferta_extension_tipo_id = '.$this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_extension_tipo_id', 'LEFT');
			$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_tipo_id', 6);
			$result_extensiones = $this->db->get($this->t_proyecto_valor_oferta);
			if($result_extensiones->num_rows()> 0){
				$result= $this->security->xss_clean($result_extensiones->result_array());
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	/*Esta consulta es para los casos en que se consulta por angular y confiltros*/


	function consultaAllGastosConFiltros($data){
		//Consulta primero los datos
		$this->db->join($this->t_proyecto_gasto_tipo, $this->t_proyecto_gasto_tipo.'.proyecto_gasto_tipo_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 'LEFT');
		$this->db->join($this->t_proyecto_gasto_monto, $this->t_proyecto_gasto_monto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_monto.'.estado_registro = 1', 'LEFT');
		$this->db->join($this->t_proyecto_gasto_detalle, $this->t_proyecto_gasto_detalle.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id', 'LEFT');
		$this->db->join($this->t_proyecto_gasto_estado, $this->t_proyecto_gasto_estado.'.proyecto_gasto_estado_id = '.$this->t_proyecto_gasto_detalle.'.proyecto_gasto_estado_id', 'LEFT');
		$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_gasto_detalle.'.proveedor_id', 'LEFT');
		$this->db->join($this->t_moneda, $this->t_moneda.'.moneda_id = '.$this->t_proyecto_gasto_monto.'.moneda_id', 'LEFT');
		$this->db->join($this->t_proyecto_gasto_material, $this->t_proyecto_gasto_material.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id', 'LEFT');
		$this->db->join($this->t_proyecto_material_solicitud_compra_orden_compra, $this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_orden_compra_id = '.$this->t_proyecto_gasto_material.'.proyecto_material_solicitud_compra_orden_compra_id', 'LEFT');
		$this->db->select($this->t_proyecto_gasto.'.*, '.$this->t_proyecto_gasto_monto.'.proyecto_gasto_monto, '.$this->t_proyecto_gasto_monto.'.moneda_id, '.$this->t_proyecto_gasto_detalle.'.proveedor_id, '.$this->t_proyecto_gasto_detalle.'.numero_factura, '.$this->t_proyecto_gasto_estado.'.proyecto_gasto_estado, '.$this->t_proveedor.'.nombre_proveedor, '.$this->t_proyecto_gasto_tipo.'.proyecto_gasto_tipo, '.$this->t_moneda.'.*,'.$this->t_proyecto_gasto_material.'.proyecto_material_solicitud_compra_orden_compra_id, '.$this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_id');

		if(isset($data['filtros'])){			
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='proveedor_id' || $key=='proyecto_gasto_estado_id'){
						$this->db->where($this->t_proyecto_gasto_detalle.'.'.$key, $value);
					}else if($key=='numero_factura'){
						$this->db->like($this->t_proyecto_gasto_detalle.'.'.$key, $value);
					}else if($key=='fecha_registro' || $key=='fecha_gasto'){
						if($value['from']!='' && $value['from']!='undefined' && $value['from']!='IS NULL'){
							$value['from'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['from'])));
							$this->db->where($this->t_proyecto_gasto.'.'.$key.'>="'.$value['from'].'"');
						}

						if($value['to']!='' && $value['to']!='undefined' && $value['to']!='IS NULL'){
							$value['to'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['to'])));
							$this->db->where($this->t_proyecto_gasto.'.'.$key.'<="'.$value['to'].'"');	
						}

					}else{
						$this->db->where($this->t_proyecto_gasto.'.'.$key, $value);
					}
					
				}
			}
		}

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

		$this->db->order_by($this->t_proyecto_gasto.'.fecha_gasto', 'DESC');
		$result_gastos = $this->db->get($this->t_proyecto_gasto);

		//vuelve a hacer la consulta para obtener el total de rows 

		/*
		$this->db->join($this->t_proyecto_gasto_tipo, $this->t_proyecto_gasto_tipo.'.proyecto_gasto_tipo_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 'LEFT');
		$this->db->join($this->t_proyecto_gasto_monto, $this->t_proyecto_gasto_monto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_monto.'.estado_registro = 1', 'LEFT');
		$this->db->join($this->t_proyecto_gasto_detalle, $this->t_proyecto_gasto_detalle.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id', 'LEFT');
		$this->db->join($this->t_proyecto_gasto_detalle, $this->t_proyecto_gasto_detalle.'.proyecto_gasto_estado_id = '.$this->t_proyecto_gasto_estado.'.proyecto_gasto_estado_id', 'LEFT');
		$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_gasto_detalle.'.proveedor_id', 'LEFT');

		if(isset($data['filtros'])){			
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='proveedor_id' || $key=='proyecto_gasto_estado_id'){
						$this->db->where($this->t_proyecto_gasto_detalle.'.'.$key, $value);
					}else if($key=='numero_factura'){
						$this->db->like($this->t_proyecto_gasto_detalle.'.'.$key, $value);
					}else if($key=='fecha_registro' || $key=='fecha_gasto'){
						if($value['from']!='' && $value['from']!='undefined' && $value['from']!='IS NULL'){
							$value['from'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['from'])));
							$this->db->where($this->t_proyecto_gasto.'.'.$key.'>="'.$value['from'].'"');
						}

						if($value['to']!='' && $value['to']!='undefined' && $value['to']!='IS NULL'){
							$value['to'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['to'])));
							$this->db->where($this->t_proyecto_gasto.'.'.$key.'<="'.$value['to'].'"');	
						}

					}else{
						$this->db->where($this->t_proyecto_gasto.'.'.$key, $value);
					}
					
				}
			}
		} 	
		$total_rows = $this->db->count_all_results($this->t_cliente, FALSE);*/
		$result_gastos_num_rows = $result_gastos->num_rows();
		if($result_gastos_num_rows>0){
			$result = array(
							'total_rows' => $result_gastos_num_rows,
							'datos' => $this->security->xss_clean($result_gastos->result_array()),
							);

			return $result;

		}else{
			return false;
		}
		

	}

	function consultarTiposGastos(){
		$result_gastos_tipos = $this->db->get($this->t_proyecto_gasto_tipo);
		$result_gastos_tipos_num_rows = $result_gastos_tipos->num_rows(); //Previniendo que en futuras versiones de php el retorno de funciones no se pueda evaluar en un if

		if($result_gastos_tipos_num_rows>0){
			$result_gastos_tipos_result = $this->security->xss_clean($result_gastos_tipos->result_array());
			return $result_gastos_tipos_result;
		}else{
			return false;
		}

	}

	function consultarEstadosGastos(){
		$result_gasto_estado = $this->db->get($this->t_proyecto_gasto_estado);
		$result_gasto_estado_num_rows = $result_gasto_estado->num_rows(); //Previniendo que en futuras versiones de php el retorno de funciones no se pueda evaluar en un if

		if($result_gasto_estado_num_rows>0){
			$result_gasto_estado_result = $this->security->xss_clean($result_gasto_estado->result_array());
			return $result_gasto_estado_result;
		}else{
			return false;
		}

	}

	function consultarGasto($gasto_id){
		if($gasto_id!=null){
			$this->db->join($this->t_proyecto_gasto_tipo, $this->t_proyecto_gasto_tipo.'.proyecto_gasto_tipo_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 'LEFT');
			$this->db->join($this->t_proyecto_gasto_monto, $this->t_proyecto_gasto_monto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_monto.'.estado_registro = 1', 'LEFT');
			$this->db->join($this->t_proyecto_gasto_detalle, $this->t_proyecto_gasto_detalle.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id', 'LEFT');
			$this->db->join($this->t_proyecto_gasto_estado, $this->t_proyecto_gasto_estado.'.proyecto_gasto_estado_id = '.$this->t_proyecto_gasto_detalle.'.proyecto_gasto_estado_id', 'LEFT');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_gasto_detalle.'.proveedor_id', 'LEFT');
			$this->db->where($this->t_proyecto_gasto.'.proyecto_gasto_id', $gasto_id);
			$proyecto_gasto_result = $this->db->get($this->t_proyecto_gasto);
			$proyecto_gasto_result_num_rows = $proyecto_gasto_result->num_rows();
			if($proyecto_gasto_result_num_rows > 0){
				return $this->security->xss_clean($proyecto_gasto_result->row_array());
			}else{
				return false;
			}
		}
	}

	function insertarGasto($proyecto_id, $datos){
		if($proyecto_id!=null && $datos!=null){

		
			$datos2 = $datos;
			$datos3 = $datos;
			//Registra el gasto			
			$datos['usuario_id'] = $this->usuario_id;
			$datos['proyecto_id'] = $proyecto_id;
			$datos['fecha_registro'] = date('Y-m-d H:i:s');
			$datos['fecha_gasto'] = ($datos['fecha_gasto']!='' && $datos['fecha_gasto']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_gasto']))):'';
			unset($datos['moneda_id']);
			unset($datos['proyecto_gasto_monto']);
			unset($datos['proveedor_id']); 
			unset($datos['numero_factura']);
			unset($datos['proyecto_gasto_estado_id']);
			unset($datos['gasto_detalle']);
			$datos['tiene_desgloce'] = 0;
			$this->db->insert($this->t_proyecto_gasto, $datos);
			$proyecto_gasto_id = $this->db->insert_id();
			
			//Registra el monto
			$datos2['proyecto_gasto_id'] = $proyecto_gasto_id;
			$datos2['estado_registro'] = 1;
			$datos2['fecha_registro'] = date('Y-m-d H:i:s');
			$datos2['proyecto_gasto_monto'] = str_replace(' ', '', $datos2['proyecto_gasto_monto']);
			unset($datos2['proyecto_gasto_tipo_id']);
			unset($datos2['fecha_gasto']);
			unset($datos2['proveedor_id']);
			unset($datos2['numero_factura']);
			unset($datos2['gasto_detalle']);
			unset($datos2['proyecto_gasto_estado_id']);
			$this->db->insert($this->t_proyecto_gasto_monto, $datos2);

			//Registra el detalle del gasto
			
			$datos3['proyecto_gasto_id'] = $proyecto_gasto_id;
			unset($datos3['proyecto_gasto_tipo_id']);
			unset($datos3['fecha_gasto']);
			unset($datos3['proyecto_gasto_monto']);
			unset($datos3['moneda_id']);
			$this->db->insert($this->t_proyecto_gasto_detalle, $datos3);
			
			

			return array('tipo' => 'success',
						'texto' => 'Proyecto ingresado con éxito',
						'inserted_id'=> $proyecto_gasto_id);
			

		}
		
	}

	function validarGastoNuevo($proyecto_id, $datos) {
		$this->db->join($this->t_proyecto_gasto_monto, $this->t_proyecto_gasto_monto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_monto.'.estado_registro = 1', 'LEFT');	
		$this->db->join($this->t_proyecto_gasto_detalle, $this->t_proyecto_gasto_detalle.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id');
		$this->db->where($this->t_proyecto_gasto.'.proyecto_id', $proyecto_id);
		$this->db->where($this->t_proyecto_gasto_detalle.'.proveedor_id', $datos['proveedor_id']);
		$this->db->where($this->t_proyecto_gasto_detalle.'.numero_factura', $datos['numero_factura']);
		$this->db->where($this->t_proyecto_gasto_monto.'.proyecto_gasto_monto', str_replace(' ', '',$datos['proyecto_gasto_monto']));
		$proyecto_gasto_existente = $this->db->get($this->t_proyecto_gasto);
		$proyecto_gasto_existente_count = $proyecto_gasto_existente->num_rows();
		if ($proyecto_gasto_existente_count > 0) {
			$proyecto_gasto_existente_row = $proyecto_gasto_existente->row_array();
			return array(
				'result' => false, 
				'gasto_viejo' => $proyecto_gasto_existente_row['proyecto_gasto_id'],
			);
		} else {
			return array(
				'result' => true
			);
		}
	}
	


	function actualizarGasto($gasto_id, $datos){
		if($gasto_id!=null && $datos!=null){
			$this->db->where('proyecto_gasto_id', $gasto_id);
			$proyecto_gasto_result = $this->db->get($this->t_proyecto_gasto);
			$proyecto_gasto_result_num_rows = $proyecto_gasto_result->num_rows();
			if($proyecto_gasto_result_num_rows > 0){
				//limpia caracteres que vienen de angular
				foreach ($datos as $key => $value) {
					$datos[$key] = str_replace('number:', '', $value);
				}

				$datos2 = $datos;
				$datos3 = $datos;
				//Registra el gasto			
				$datos['fecha_gasto'] = ($datos['fecha_gasto']!='' && $datos['fecha_gasto']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_gasto']))):'';
				unset($datos['moneda_id']);
				unset($datos['proyecto_gasto_monto']);
                                unset($datos['proveedor_id']); 
                                unset($datos['numero_factura']);
                                unset($datos['proyecto_gasto_estado_id']);
                                unset($datos['gasto_detalle']);
				$this->db->where('proyecto_gasto_id', $gasto_id);
				$this->db->update($this->t_proyecto_gasto, $datos);
				$proyecto_gasto_id = $gasto_id;
				
				//Registra el monto
				//Primero cambia el estado de la fila actual
				$this->db->where('proyecto_gasto_id', $gasto_id);
				$this->db->where('estado_registro', 1);
				$result_monto = $this->db->get($this->t_proyecto_gasto_monto);
				$result_monto_num_rows = $result_monto->num_rows();
				if($result_monto_num_rows > 0){
					$result_monto_result = $result_monto->row();
					if($result_monto_result->proyecto_gasto_monto != $datos2['proyecto_gasto_monto'] || $result_monto_result->moneda_id != $datos2['moneda_id']){
						$this->db->set('estado_registro', 0);
						$this->db->where('proyecto_gasto_id', $gasto_id);
						$this->db->where('estado_registro', 1);
						$this->db->update($this->t_proyecto_gasto_monto);
						
						//inserta una nueva fila con el nuevo valor de monto
						$datos2['proyecto_gasto_id'] = $proyecto_gasto_id;
						$datos2['estado_registro'] = 1;
						$datos2['fecha_registro'] = date('Y-m-d H:i:s');
						$datos2['proyecto_gasto_monto'] = str_replace(' ', '', $datos2['proyecto_gasto_monto']);
						unset($datos2['proyecto_gasto_tipo_id']);
						unset($datos2['fecha_gasto']);
						unset($datos2['proveedor_id']);
						unset($datos2['numero_factura']);
						unset($datos2['proyecto_gasto_estado_id']);
						unset($datos2['gasto_detalle']);
						$this->db->insert($this->t_proyecto_gasto_monto, $datos2);
					}
				}


				//Registra el detalle del gasto	

                                $this->db->where('proyecto_gasto_id', $gasto_id);
                                $result_detalle = $this->db->get($this->t_proyecto_gasto_detalle);
                                $result_detalle_num_rows = $result_detalle->num_rows();

                                unset($datos3['proyecto_gasto_tipo_id']);
                                unset($datos3['fecha_gasto']);
                                unset($datos3['proyecto_gasto_monto']);
                                unset($datos3['moneda_id']);
                                if($result_detalle_num_rows > 0){
                                        $this->db->where('proyecto_gasto_id', $gasto_id);
                                        $this->db->update($this->t_proyecto_gasto_detalle, $datos3);

                                }else{
                                        $datos3['proyecto_gasto_id'] = $proyecto_gasto_id;
                                        $this->db->insert($this->t_proyecto_gasto_detalle, $datos3);
                                }
                                
				return array('tipo' => 'success',
						'texto' => 'Extensión editada con éxito',
						'inserted_id'=> $gasto_id);
			}else{
				return array('tipo' => 'danger',
						'texto' => 'No se pudo ingresar la extensión indicada en la Base de Datos',
						'inserted_id'=> $gasto_id);
			}
		}
	}

	function eliminarGasto($gasto_id){
		if( $gasto_id!=null ){
			$this->db->where($this->t_proyecto_gasto_monto.'.proyecto_gasto_id', $gasto_id);
			$this->db->delete($this->t_proyecto_gasto_monto);	

			$this->db->where($this->t_proyecto_gasto_detalle.'.proyecto_gasto_id', $gasto_id);
			$this->db->delete($this->t_proyecto_gasto_detalle);		
			
			$this->db->where($this->t_proyecto_gasto.'.proyecto_gasto_id', $gasto_id);
			$this->db->delete($this->t_proyecto_gasto);

			return true;
		}else{
			return false;
		}
	}



	/** Para manejo de colaboradores */
	function consultaColaboradoresProyecto($proyecto_id){
		if($proyecto_id!=null){
			$this->db->join($this->t_colaborador, $this->t_colaborador.'.colaborador_id = '.$this->t_proyecto_colaborador.'.colaborador_id', 'LEFT');
			$this->db->join($this->t_colaborador_puesto, $this->t_colaborador_puesto.'.colaborador_puesto_id = '.$this->t_colaborador.'.colaborador_puesto_id');
			$this->db->where($this->t_proyecto_colaborador.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_colaborador.'.estado', 1);
			$this->db->where($this->t_colaborador.'.estado_row', 1);
			$result_colaboradores = $this->db->get($this->t_proyecto_colaborador);
			$result_colaboradores_count = $result_colaboradores->num_rows();
			if($result_colaboradores_count> 0){
				$result = array(
							'total_rows' => $result_colaboradores_count,
							'datos' => $this->security->xss_clean($result_colaboradores->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function consultaColaboradoresActivosProyecto($proyecto_id){
		if($proyecto_id!=null){
			$this->db->join($this->t_colaborador, $this->t_colaborador.'.colaborador_id = '.$this->t_proyecto_colaborador.'.colaborador_id', 'LEFT');
			$this->db->join($this->t_colaborador_puesto, $this->t_colaborador_puesto.'.colaborador_puesto_id = '.$this->t_colaborador.'.colaborador_puesto_id');
			$this->db->where($this->t_proyecto_colaborador.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_colaborador.'.estado_registro', 1);
			$this->db->where($this->t_colaborador.'.estado', 1);
			$this->db->where($this->t_colaborador.'.estado_row', 1);
			$result_colaboradores = $this->db->get($this->t_proyecto_colaborador);
			$result_colaboradores_count = $result_colaboradores->num_rows();
			if($result_colaboradores_count> 0){
				$result = array(
							'total_rows' => $result_colaboradores_count,
							'datos' => $this->security->xss_clean($result_colaboradores->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function relacionarColaboradorProyecto($proyecto_id, $colaborador_id, $tipo_relacion){
		if($proyecto_id!=null && $colaborador_id!=null){
			// Pregunta si el colaborador ya esta ligado al proyecto
			$this->db->where('proyecto_id', $proyecto_id);
			$this->db->where('colaborador_id', $colaborador_id);
			$result_colaborador = $this->db->get($this->t_proyecto_colaborador);
			$result_colaborador_count = $result_colaborador->num_rows();
			if($result_colaborador_count==0){
				// Si no esta ligado entonces entra a insertarlo

				if($tipo_relacion==1){
					//Aqui pregunta si el nuevo colaborador es un jefe de proyecto y si ya hay uno en BD lo desactiva para insertar el nuevo
					$this->db->where('tipo_relacion', 1);
					$this->db->where('estado_registro', 1);
					$this->db->where('proyecto_id', $proyecto_id);
					$result_actual_jefe = $this->db->get($this->t_proyecto_colaborador);
					$result_actual_jefe_count = $result_actual_jefe->num_rows();
					if($result_actual_jefe_count>0){
						$result_actual_jefe_result = $result_actual_jefe->result();
						
						foreach ($result_actual_jefe_result as $key => $value) {
							$this->db->set('estado_registro', 0);
							$this->db->where('proyecto_colaborador_id', $value->proyecto_colaborador_id);
							$this->db->update($this->t_proyecto_colaborador);
						}
					}
				}
				$this->db->set('proyecto_id', $proyecto_id);
				$this->db->set('colaborador_id', $colaborador_id);
				$this->db->set('tipo_relacion', $tipo_relacion);
				$this->db->set('fecha_registro',  date('Y-m-d H:i:s'));
				$this->db->set('estado_registro', 1);
				$this->db->insert($this->t_proyecto_colaborador);
			}else{
				if($tipo_relacion==1){
					//Aqui pregunta si el nuevo colaborador es un jefe de proyecto y si ya hay uno en BD lo desactiva para insertar el nuevo
					$this->db->where('tipo_relacion', 1);
					$this->db->where('estado_registro', 1);
					$this->db->where('proyecto_id', $proyecto_id);
					$result_actual_jefe = $this->db->get($this->t_proyecto_colaborador);
					$result_actual_jefe_count = $result_actual_jefe->num_rows();
					if($result_actual_jefe_count>0){
						$result_actual_jefe_result = $result_actual_jefe->result();
						
						foreach ($result_actual_jefe_result as $key => $value) {
							$this->db->set('estado_registro', 0);
							$this->db->where('proyecto_colaborador_id', $value->proyecto_colaborador_id);
							$this->db->update($this->t_proyecto_colaborador);
						}
					}
				}
				
				$this->db->set('estado_registro', 1);	
				$this->db->set('tipo_relacion', $tipo_relacion);
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->where('colaborador_id', $colaborador_id);
				$this->db->update($this->t_proyecto_colaborador);
				
			}
			return true;
			
		}else{
			return false;
		}
	}
	
	
	function removerColaboradorProyecto($proyecto_id, $colaborador_id){
		if($proyecto_id!=null && $colaborador_id!=null){
			$this->db->where('proyecto_id', $proyecto_id);
			$this->db->where('colaborador_id', $colaborador_id);
			$result_colaborador = $this->db->get($this->t_proyecto_colaborador);
			$result_colaborador_count = $result_colaborador->num_rows();
			if($result_colaborador_count>0){
				$this->db->set('estado_registro', 0);
				$this->db->where('colaborador_id', $colaborador_id);
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->update($this->t_proyecto_colaborador);
			}
			return true;
			
		}else{
			return false;
		}
	}


	function consultaTiemposColaboradores($proyecto_id, $fecha_gasto){
		if($proyecto_id!=null && $fecha_gasto!=null){
			$result = array();

			//Lista de colaboradores
			$this->db->join($this->t_colaborador, $this->t_colaborador.'.colaborador_id = '.$this->t_proyecto_colaborador.'.colaborador_id', 'LEFT');
			$this->db->join($this->t_colaborador_puesto, $this->t_colaborador_puesto.'.colaborador_puesto_id = '.$this->t_colaborador.'.colaborador_puesto_id');
			$this->db->join($this->t_colaborador_costo_hora, $this->t_colaborador_costo_hora.'.colaborador_id = '.$this->t_colaborador.'.colaborador_id AND '.$this->t_colaborador_costo_hora.'.estado_costo = 1', 'LEFT');
			$this->db->where($this->t_proyecto_colaborador.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_colaborador.'.estado_registro', 1);
			$this->db->where($this->t_colaborador.'.estado', 1);
			$this->db->where($this->t_colaborador.'.estado_row', 1);
			$this->db->order_by($this->t_colaborador_puesto.'.colaborador_puesto_id', 'ASC');
			$result_colaboradores = $this->db->get($this->t_proyecto_colaborador);
			$result_colaboradores_count = $result_colaboradores->num_rows();
			if($result_colaboradores_count> 0){
				$result_colaboradores_rows = $this->security->xss_clean($result_colaboradores->result_array());
				$result['colaboradores_proyecto'] = $result_colaboradores_rows;
			}


			//Consulta gasto reportado
			$this->db->join($this->t_proyecto_gasto_mano_obra, $this->t_proyecto_gasto_mano_obra.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id');	
			$this->db->join($this->t_proyecto_colaborador, $this->t_proyecto_colaborador.'.proyecto_colaborador_id = '.$this->t_proyecto_gasto_mano_obra.'.proyecto_colaborador_id');	
			$this->db->join($this->t_colaborador, $this->t_colaborador.'.colaborador_id = '.$this->t_proyecto_colaborador.'.colaborador_id');	
			$this->db->join($this->t_colaborador_puesto, $this->t_colaborador_puesto.'.colaborador_puesto_id = '.$this->t_colaborador.'.colaborador_puesto_id');
			$this->db->where($this->t_proyecto_gasto.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_gasto.'.fecha_gasto', date('Y-m-d', strtotime(str_replace('/','-',$fecha_gasto))));
			$this->db->where($this->t_proyecto_gasto.'.tiene_desgloce', 1);
			$this->db->where($this->t_proyecto_gasto_mano_obra.'.estado_registro', 1);
			$this->db->order_by($this->t_colaborador_puesto.'.colaborador_puesto_id', 'ASC');
			$result_proyecto_gasto_col = $this->db->get($this->t_proyecto_gasto);
			$result_proyecto_gasto_col_count = $result_proyecto_gasto_col->num_rows();
			if($result_proyecto_gasto_col_count>0){
				$result_proyecto_gasto_col_rows = $this->security->xss_clean($result_proyecto_gasto_col->result_array());
				$result['colaboradores_tiempos'] = $result_proyecto_gasto_col_rows;
			}else{
				$result['colaboradores_tiempos'] = false;
			}
			return $result;
		}else{
			return false;
		}
	}

	function registrarTiemposColaboradores($proyecto_id, $datos_insertar){
		if($proyecto_id!=null && $datos_insertar!=null){

			//Si no hay gasto registrado para esta fecha
			$colaboradores_horas = $datos_insertar['horas_colaborador'];
			$total_gasto = 0;
			$proyecto_gasto_id = null;


			$this->db->where('proyecto_id', $proyecto_id);
			$this->db->where('fecha_gasto', ($datos_insertar['fecha_registro_gasto']!='' && $datos_insertar['fecha_registro_gasto']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos_insertar['fecha_registro_gasto']))):'');
			$this->db->where('proyecto_gasto_tipo_id', 2);
			$this->db->where('tiene_desgloce', 1);
			$result_gasto_registrado = $this->db->get($this->t_proyecto_gasto);
			$result_gasto_registrado_count = $result_gasto_registrado->num_rows();
			if($result_gasto_registrado_count>0){
				//Si ya el gasto existe

				$result_gasto_registrado_row = $this->security->xss_clean($result_gasto_registrado->row_array());
				$proyecto_gasto_id = $result_gasto_registrado_row['proyecto_gasto_id'];			

			}else{
				//Si el gasto no existe Registra el gasto	
				$datos_gasto = array();		
				$datos_gasto['usuario_id'] = $this->usuario_id;
				$datos_gasto['proyecto_id'] = $proyecto_id;
				$datos_gasto['fecha_registro'] = date('Y-m-d H:i:s');
				$datos_gasto['fecha_gasto'] = ($datos_insertar['fecha_registro_gasto']!='' && $datos_insertar['fecha_registro_gasto']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos_insertar['fecha_registro_gasto']))):'';
				$datos_gasto['proyecto_gasto_tipo_id'] = 2;
				$datos_gasto['tiene_desgloce'] = 1;
				
				$this->db->insert($this->t_proyecto_gasto, $datos_gasto);
				$proyecto_gasto_id = $this->db->insert_id();
			}

			if($proyecto_gasto_id!=null){
				//Inserta el registro del gasto por cada colaborador
				foreach ($colaboradores_horas as $key => $value) {
					$this->db->where($this->t_colaborador.'.colaborador_id', $key);
					$this->db->where($this->t_colaborador_costo_hora.'.estado_costo', 1);
					$this->db->join($this->t_colaborador_costo_hora, $this->t_colaborador_costo_hora.'.colaborador_id = '.$this->t_colaborador.'.colaborador_id');
					$this->db->join($this->t_proyecto_colaborador, $this->t_proyecto_colaborador.'.colaborador_id = '.$this->t_colaborador.'.colaborador_id');
					$colaborador_result = $this->db->get($this->t_colaborador);	
					$colaborador_result_count = $colaborador_result->num_rows();
					if($colaborador_result_count>0){
						$colaborador_result_row = $colaborador_result->row();
						
						$horas_extra = (isset($datos_insertar['horas_extra_colaborador'][$key])) ? $datos_insertar['horas_extra_colaborador'][$key] : 0;
						$costo_colaborador = ($value * $colaborador_result_row->costo_hora);
						$costo_colaborador_horas_extra = $horas_extra * ($colaborador_result_row->costo_hora * 1.5);
						$total_gasto += ($costo_colaborador + $costo_colaborador_horas_extra);

						//consulta si hay registro de hora previo ya realizado
						$this->db->where('proyecto_gasto_id', $proyecto_gasto_id);
						$this->db->where('proyecto_colaborador_id', $colaborador_result_row->proyecto_colaborador_id);
						$this->db->where('estado_registro', 1);
						$result_gasto_mo = $this->db->get($this->t_proyecto_gasto_mano_obra);
						$result_gasto_mo_count = $result_gasto_mo->num_rows();
	
						if($result_gasto_mo_count > 0){
							$result_gasto_mo_row = $result_gasto_mo->row();
							// Si hay inserta uno nuevo luego de actualizar el anterior
							$this->db->set('estado_registro', 0);
							$this->db->where('proyecto_gasto_id', $proyecto_gasto_id);
							$this->db->where('proyecto_colaborador_id', $colaborador_result_row->proyecto_colaborador_id);
							$this->db->where('estado_registro', 1);
							$this->db->update($this->t_proyecto_gasto_mano_obra);
	
							$this->db->set('proyecto_gasto_id', $proyecto_gasto_id);
							$this->db->set('proyecto_colaborador_id', $colaborador_result_row->proyecto_colaborador_id);
							$this->db->set('usuario_id', $this->usuario_id);
							$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
							$this->db->set('cantidad_horas', $value);
							$this->db->set('cantidad_horas_extra', $horas_extra);
							$this->db->set('costo_hora_mano_obra', $colaborador_result_row->costo_hora);
							$this->db->set('estado_registro', 1);
							$this->db->insert($this->t_proyecto_gasto_mano_obra);
						}else{
							// si no hay solo inserta uno nuevo
							$this->db->set('proyecto_gasto_id', $proyecto_gasto_id);
							$this->db->set('proyecto_colaborador_id', $colaborador_result_row->proyecto_colaborador_id);
							$this->db->set('usuario_id', $this->usuario_id);
							$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
							$this->db->set('cantidad_horas', $value);
							$this->db->set('cantidad_horas_extra', $horas_extra);
							$this->db->set('costo_hora_mano_obra', $colaborador_result_row->costo_hora);
							$this->db->set('estado_registro', 1);
							$this->db->insert($this->t_proyecto_gasto_mano_obra);
							
						}
					}
				}
				
	
				//Registra el monto
				$this->db->where('proyecto_gasto_id', $proyecto_gasto_id);
				$this->db->where('estado_registro', 1);
				$result_gasto_monto = $this->db->get($this->t_proyecto_gasto_monto);
				$result_gasto_monto_count = $result_gasto_monto->num_rows();
				if($result_gasto_monto_count>0){
					$result_gasto_monto_row = $result_gasto_monto->row();
					if(str_replace(' ', '', $total_gasto) != $result_gasto_monto_row->proyecto_gasto_monto){
						$this->db->set('estado_registro', 0);
						$this->db->where('proyecto_gasto_monto_id', $result_gasto_monto_row->proyecto_gasto_monto_id);
						$this->db->update($this->t_proyecto_gasto_monto);

						$gasto_monto['proyecto_gasto_id'] = $proyecto_gasto_id;
						$gasto_monto['moneda_id'] = 2;
						$gasto_monto['estado_registro'] = 1;
						$gasto_monto['fecha_registro'] = date('Y-m-d H:i:s');
						$gasto_monto['proyecto_gasto_monto'] = str_replace(' ', '', $total_gasto);
						
						$this->db->insert($this->t_proyecto_gasto_monto, $gasto_monto);
					}
				}else{
					$gasto_monto['proyecto_gasto_id'] = $proyecto_gasto_id;
					$gasto_monto['moneda_id'] = 2;
					$gasto_monto['estado_registro'] = 1;
					$gasto_monto['fecha_registro'] = date('Y-m-d H:i:s');
					$gasto_monto['proyecto_gasto_monto'] = str_replace(' ', '', $total_gasto);
					
					$this->db->insert($this->t_proyecto_gasto_monto, $gasto_monto);
				}

			
	
				return array('tipo' => 'success',
							'texto' => 'Registro ingresado con éxito',
							'inserted_id'=> $proyecto_gasto_id);

			}


		}
	}
	

	/*Para validaciones*/

	function consultarNumeroContrato($numero_contrato){
		$this->db->where('numero_contrato', $numero_contrato);
		$proyecto_result = $this->db->get($this->t_proyecto);
		if($proyecto_result->num_rows()>0){
			return array('tipo' => 'success',
						'texto' => 'Ya existe un proyecto con este numero de contrato.'
						);
		}else{
			return false;
		}
	}

	function consultarOrdenCompra($orden_combra){
		$this->db->where('orden_combra', $orden_combra);
		$proyecto_result = $this->db->get($this->t_proyecto);
		if($proyecto_result->num_rows()>0){
			return array('tipo' => 'success',
						'texto' => 'Ya existe un proyecto con esta orden de compra'
						);
		}else{
			return false;
		}
	}


	/** Para reportes */

	/** Para consultar horas por colaborador en reporte */

	function consultaHorasLaboradasColaborador($data){
		//exit(var_export($data));
		if(isset($data['filtros']['colaborador_id'])){
			$this->db->join($this->t_proyecto_colaborador, $this->t_proyecto_colaborador.'.proyecto_colaborador_id = '.$this->t_proyecto_gasto_mano_obra.'.proyecto_colaborador_id');
			$this->db->join($this->t_proyecto_gasto, $this->t_proyecto_gasto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto_mano_obra.'.proyecto_gasto_id');
			$this->db->join($this->t_proyecto, $this->t_proyecto.'.proyecto_id = '.$this->t_proyecto_gasto.'.proyecto_id');
			$this->db->where($this->t_proyecto_colaborador.'.colaborador_id', $data['filtros']['colaborador_id']);
			$this->db->where($this->t_proyecto_gasto_mano_obra.'.estado_registro', 1);
			
			if(isset($data['filtros']['fecha_gasto_from']) && $data['filtros']['fecha_gasto_from']!='' && $data['filtros']['fecha_gasto_from']!='undefined' && $data['filtros']['fecha_gasto_from']!='IS NULL'){
				$data['filtros']['fecha_gasto_from'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_gasto_from'])));
				$this->db->where($this->t_proyecto_gasto.'.fecha_gasto >= "'.$data['filtros']['fecha_gasto_from'].'"');
			}

			if(isset($data['filtros']['fecha_gasto_to']) && $data['filtros']['fecha_gasto_to']!='' && $data['filtros']['fecha_gasto_to']!='undefined' && $data['filtros']['fecha_gasto_to']!='IS NULL'){
				$data['filtros']['fecha_gasto_to'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_gasto_to'])));
				$this->db->where($this->t_proyecto_gasto.'.fecha_gasto <= "'.$data['filtros']['fecha_gasto_to'].'"');
			}

			if(isset($data['filtros']['nombre_proyecto']) && $data['filtros']['nombre_proyecto']!='' && $data['filtros']['nombre_proyecto']!='undefined' && $data['filtros']['nombre_proyecto']!='IS NULL'){
				$this->db->like($this->t_proyecto.'.nombre_proyecto', $data['filtros']['nombre_proyecto']);
			}

			$this->db->order_by($this->t_proyecto_gasto.'.fecha_gasto', 'ASC');
			$result_horas = $this->db->get($this->t_proyecto_gasto_mano_obra);
			$result_horas_rows = $result_horas->num_rows();
			if($result_horas_rows>0){
				$result = array(
							'total_rows' => $result_horas_rows,
							'datos' => $this->security->xss_clean($result_horas->result_array()),
							);
				return $result;
			}else{	
				return false;
			}
		}
	}

	function consultaHorasLaboradasProyecto($data){
		if(isset($data['filtros']['proyecto_id'])){
			$select = '';
			if(isset($data['filtros']['group_by'])){
				if($data['filtros']['group_by'] == 'dia'){
					$select = $this->t_proyecto_gasto.'.fecha_gasto, '.$this->t_proyecto_gasto_monto.'.proyecto_gasto_monto as total_costo';
					$this->db->select_sum($this->t_proyecto_gasto_mano_obra.'.cantidad_horas_extra', 'total_horas_extra');
					$this->db->select_sum($this->t_proyecto_gasto_mano_obra.'.cantidad_horas', 'total_horas');
				}
				if($data['filtros']['group_by'] == 'colaborador'){
					$select = $this->t_colaborador.'.colaborador_id, '.$this->t_colaborador.'.nombre, '.$this->t_colaborador.'.apellidos, '.$this->t_proyecto_gasto_mano_obra.'.costo_hora_mano_obra, '.$this->t_proyecto_gasto_mano_obra.'.cantidad_horas, '.$this->t_proyecto_gasto_mano_obra.'.cantidad_horas_extra';
				}

				if($data['filtros']['group_by'] == 'none'){
					$select = $this->t_colaborador.'.colaborador_id, '.$this->t_colaborador.'.nombre, '.$this->t_colaborador.'.apellidos, '.$this->t_proyecto_gasto.'.fecha_gasto, '.$this->t_proyecto_gasto_mano_obra.'.costo_hora_mano_obra, '.$this->t_proyecto_gasto_mano_obra.'.cantidad_horas, '.$this->t_proyecto_gasto_mano_obra.'.cantidad_horas_extra';
				}
			}
			$this->db->select($select);
			$this->db->join($this->t_proyecto_gasto_monto, $this->t_proyecto_gasto_monto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_monto.'.estado_registro = 1');
			$this->db->join($this->t_proyecto_gasto_mano_obra, $this->t_proyecto_gasto_mano_obra.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_mano_obra.'.estado_registro = 1');
			if(isset($data['filtros']['group_by'])){
				if($data['filtros']['group_by'] == 'dia'){
	
				}
				if($data['filtros']['group_by'] == 'colaborador'){
					$this->db->join($this->t_proyecto_colaborador, $this->t_proyecto_colaborador.'.proyecto_colaborador_id = '.$this->t_proyecto_gasto_mano_obra.'.proyecto_colaborador_id');
					$this->db->join($this->t_colaborador, $this->t_colaborador.'.colaborador_id = '.$this->t_proyecto_colaborador.'.colaborador_id');
				}

				if($data['filtros']['group_by'] == 'none'){
					$this->db->join($this->t_proyecto_colaborador, $this->t_proyecto_colaborador.'.proyecto_colaborador_id = '.$this->t_proyecto_gasto_mano_obra.'.proyecto_colaborador_id');
					$this->db->join($this->t_colaborador, $this->t_colaborador.'.colaborador_id = '.$this->t_proyecto_colaborador.'.colaborador_id');
				}
			}
			$this->db->where($this->t_proyecto_gasto.'.proyecto_id', $data['filtros']['proyecto_id']);
			$this->db->where($this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 2);
			$this->db->where($this->t_proyecto_gasto.'.tiene_desgloce', 1);
			
			if(isset($data['filtros']['fecha_gasto_from']) && $data['filtros']['fecha_gasto_from']!='' && $data['filtros']['fecha_gasto_from']!='undefined' && $data['filtros']['fecha_gasto_from']!='IS NULL'){
				$data['filtros']['fecha_gasto_from'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_gasto_from'])));
				$this->db->where($this->t_proyecto_gasto.'.fecha_gasto >= "'.$data['filtros']['fecha_gasto_from'].'"');
			}

			if(isset($data['filtros']['fecha_gasto_to']) && $data['filtros']['fecha_gasto_to']!='' && $data['filtros']['fecha_gasto_to']!='undefined' && $data['filtros']['fecha_gasto_to']!='IS NULL'){
				$data['filtros']['fecha_gasto_to'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_gasto_to'])));
				$this->db->where($this->t_proyecto_gasto.'.fecha_gasto <= "'.$data['filtros']['fecha_gasto_to'].'"');
			}


			if(isset($data['filtros']['group_by'])){
				if($data['filtros']['group_by'] == 'dia'){
					$this->db->group_by($this->t_proyecto_gasto_mano_obra.'.proyecto_gasto_id');
					$this->db->order_by($this->t_proyecto_gasto.'.fecha_gasto', 'ASC');
				}
				if($data['filtros']['group_by'] == 'colaborador'){
					//$this->db->group_by($this->t_proyecto_gasto_mano_obra.'.proyecto_colaborador_id');
					$this->db->order_by($this->t_colaborador.'.colaborador_puesto_id', 'ASC');
				}
				if($data['filtros']['group_by'] == 'none'){
					$this->db->order_by($this->t_proyecto_gasto.'.fecha_gasto', 'ASC');
				}
			}
			$result_horas = $this->db->get($this->t_proyecto_gasto);
			$result_horas_rows = $result_horas->num_rows();
			if($result_horas_rows>0){
				$result_fetch = array();
				if(isset($data['filtros']['group_by'])){
					if($data['filtros']['group_by'] == 'dia'){
						$result_fetch = $this->security->xss_clean($result_horas->result_array());
						
					}
					if($data['filtros']['group_by'] == 'colaborador'){
						$result_tmp = $this->security->xss_clean($result_horas->result_array());
						$result_colaboradores = array();
						foreach ($result_tmp as $key => $value) {
							$result_colaboradores[$value['colaborador_id']]['nombre'] = $value['nombre'].' '.$value['apellidos'];
							$result_colaboradores[$value['colaborador_id']]['total_horas'] = (isset($result_colaboradores[$value['colaborador_id']]['total_horas'])) ? $result_colaboradores[$value['colaborador_id']]['total_horas'] + $value['cantidad_horas'] : $value['cantidad_horas'];
							$result_colaboradores[$value['colaborador_id']]['total_horas_extra'] = (isset($result_colaboradores[$value['colaborador_id']]['total_horas_extra'])) ? $result_colaboradores[$value['colaborador_id']]['total_horas_extra'] + $value['cantidad_horas_extra'] : $value['cantidad_horas_extra'];
							$costo_row = (($value['cantidad_horas'] * $value['costo_hora_mano_obra']) + ($value['cantidad_horas_extra'] * ($value['costo_hora_mano_obra'] * 1.5)));
							$result_colaboradores[$value['colaborador_id']]['total_costo'] = (isset($result_colaboradores[$value['colaborador_id']]['total_costo'])) ? $result_colaboradores[$value['colaborador_id']]['total_costo'] + $costo_row : $costo_row;
						}

						$result_fetch = $result_colaboradores;
						
					}

					if($data['filtros']['group_by'] == 'none'){
						$result_fetch = $this->security->xss_clean($result_horas->result_array());
						
					}
				}else{
					$result_fetch = $this->security->xss_clean($result_horas->result_array());
				}		
				$result = array(
							'total_rows' => $result_horas_rows,
							'datos' => $result_fetch,
							);
				return $result;
			}else{	
				return false;
			}
		}
	}

	function consultaProyectosReporteAll($data = null){
		//Consulta primero los datos
		$this->db->join($this->t_cliente, $this->t_cliente.'.cliente_id = '.$this->t_proyecto.'.cliente_id', 'LEFT');
		$this->db->join($this->t_proyecto_estado, $this->t_proyecto_estado.'.proyecto_estado_id = '.$this->t_proyecto.'.proyecto_estado_id', 'LEFT');
		$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto.'.proyecto_id', 'LEFT');		
		$this->db->join($this->t_distrito, $this->t_distrito.'.distrito_id = '.$this->t_proyecto.'.distrito_id', 'LEFT');
		$this->db->join($this->t_canton, $this->t_canton.'.canton_id = '.$this->t_distrito.'.canton_id', 'LEFT');
		$this->db->join($this->t_provincia, $this->t_provincia.'.provincia_id = '.$this->t_canton.'.provincia_id', 'LEFT');
		if(isset($data['filtros'])){	
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='nombre_proyecto' || $key=='numero_contrato' || $key=='orden_compra'){
						$this->db->like($this->t_proyecto.'.'.$key, $value);
					}else if($key=='provincia_id'){
						$this->db->where($this->t_canton.'.'.$key, $value);
					}else if($key=='canton_id'){
						$this->db->where($this->t_distrito.'.'.$key, $value);
					}else if($key=='fecha_registro' || $key=='fecha_firma_contrato' || $key=='fecha_inicio' || $key=='fecha_entrega_estimada'){
						//exit(var_export($data['filtros']));		
						if($value['from']!='' && $value['from']!='undefined' && $value['from']!='IS NULL'){
							$value['from'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['from'])));
							$this->db->where($this->t_proyecto.'.'.$key.'>="'.$value['from'].'"');
						}

						if($value['to']!='' && $value['to']!='undefined' && $value['to']!='IS NULL'){
							$value['to'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['to'])));
							$this->db->where($this->t_proyecto.'.'.$key.'<="'.$value['to'].'"');	
						}
					}else{
						$this->db->where($this->t_proyecto.'.'.$key, $value);
					}
					
				}
			}
		}
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
		$this->db->order_by($this->t_proyecto.'.proyecto_estado_id', 'ASC');
		$this->db->order_by($this->t_proyecto.'.fecha_inicio', 'ASC');
		$result_proyecto = $this->db->get($this->t_proyecto);

		//vuelve a hacer la consulta para obtener el total de rows 

		/*
		$this->db->join($this->t_cliente, $this->t_cliente.'.cliente_id = '.$this->t_proyecto.'.cliente_id', 'LEFT');
		$this->db->join($this->t_proyecto_estado, $this->t_proyecto_estado.'.proyecto_estado_id = '.$this->t_proyecto.'.proyecto_estado_id', 'LEFT');
		$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto.'.proyecto_id', 'LEFT');		
		$this->db->join($this->t_distrito, $this->t_distrito.'.distrito_id = '.$this->t_proyecto.'.distrito_id', 'LEFT');
		$this->db->join($this->t_canton, $this->t_canton.'.canton_id = '.$this->t_distrito.'.canton_id', 'LEFT');
		$this->db->join($this->t_provincia, $this->t_provincia.'.provincia_id = '.$this->t_canton.'.provincia_id', 'LEFT');
		if(isset($data['filtros'])){			
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='nombre_proyecto' || $key=='numero_contrato' || $key=='orden_compra'){
						$this->db->like($this->t_proyecto.'.'.$key, $value);
					}else if($key=='provincia_id'){
						$this->db->where($this->t_canton.'.'.$key, $value);
					}else if($key=='canton_id'){
						$this->db->where($this->t_distrito.'.'.$key, $value);
					}else if($key=='fecha_registro' || $key=='fecha_firma_contrato' || $key=='fecha_inicio' || $key=='fecha_entrega_estimada'){
						if($value['from']!='' && $value['from']!='undefined' && $value['from']!='IS NULL'){
							$value['from'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['from'])));
							$this->db->where($this->t_proyecto.'.'.$key.'>="'.$value['from'].'"');
						}

						if($value['to']!='' && $value['to']!='undefined' && $value['to']!='IS NULL'){
							$value['to'] = date('Y-m-d', strtotime(str_replace('/', '-', $value['to'])));
							$this->db->where($this->t_proyecto.'.'.$key.'<="'.$value['to'].'"');	
						}
					}else{
						$this->db->where($this->t_proyecto.'.'.$key, $value);
					}
					
				}
			}
		}
		$total_rows = $this->db->count_all_results($this->t_cliente, FALSE);*/
		//exit(var_export($this->db->last_query()));
		if($result_proyecto->num_rows()>0){
			$proyectos_result = array();
			$proyectos_result = $this->security->xss_clean($result_proyecto->result_array());
			//exit(var_export($proyectos_result));
			foreach($proyectos_result as $kproyecto => $vproyecto){
				$proyecto = $vproyecto;
				$proyecto_id = $vproyecto['proyecto_id'];

				//Para valor de la oferta
				$total_valor_oferta = 0;
				$valor_oferta_tmp = array();
				$valor_oferta_array = array();
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->order_by('proyecto_valor_oferta_tipo_id', 'ASC');
				$result_valor_oferta = $this->db->get($this->t_proyecto_valor_oferta);
				$result_valor_oferta_num_rows = $result_valor_oferta->num_rows();
				if($result_valor_oferta_num_rows>0){
					$result_valor_oferta_result = $this->security->xss_clean($result_valor_oferta->result_array());
					foreach ($result_valor_oferta_result as $kvalor => $vvalor) {
						$saltar_valor_oferta = false;
						
						// Validamos si el tipo de valor de oferta es una orden de cambio y revisamos su estado para ver si esta aprobado o no
						if($vvalor['proyecto_valor_oferta_tipo_id'] == 6) {
							$this->db->where($this->t_proyecto_valor_oferta_extension.'.proyecto_valor_oferta_id', $vvalor['proyecto_valor_oferta_id']);
							$proyecto_valor_oferta_extension = $this->db->get($this->t_proyecto_valor_oferta_extension);
							$proyecto_valor_oferta_extension_count = $proyecto_valor_oferta_extension->num_rows();
							if ($proyecto_valor_oferta_extension_count > 0) {
								$proyecto_valor_oferta_extension_result = $proyecto_valor_oferta_extension->row_array();
								if ($proyecto_valor_oferta_extension_result['proyecto_valor_oferta_extension_estado_id'] != 2) {
									$saltar_valor_oferta = true;
								}
							}
						}

						if (!$saltar_valor_oferta) {
							$valor_oferta_tmp[$vvalor['proyecto_valor_oferta_tipo_id']][] = $vvalor['valor_oferta'];
						}
					}


					$result_valor_oferta_tipo = $this->db->get($this->t_proyecto_valor_oferta_tipo);
					$result_valor_oferta_tipo_num_rows = $result_valor_oferta_tipo->num_rows();
					if($result_valor_oferta_tipo_num_rows>0){
						$result_valor_oferta_tipo_result = $this->security->xss_clean($result_valor_oferta_tipo->result_array());
						foreach ($result_valor_oferta_tipo_result as $kvtipo => $vvtipo) {
							if(isset($valor_oferta_tmp[$vvtipo['proyecto_valor_oferta_tipo_id']])){
								$subtotal = 0;
								foreach ($valor_oferta_tmp[$vvtipo['proyecto_valor_oferta_tipo_id']] as $kv => $vv) {
									$subtotal+=(double)$vv;
									$total_valor_oferta += (double)$vv;
								}
								$valor_oferta_array[$vvtipo['proyecto_valor_oferta_tipo_id']] = array('tipo_id' => $vvtipo['proyecto_valor_oferta_tipo_id'],
																									'tipo' => $vvtipo['proyecto_valor_oferta_tipo'],
																									'valor' => $subtotal);
							}
						}
						
					}
				}
				$proyectos_result[$kproyecto]['valor_oferta']['desgloce'] = $valor_oferta_array;
				$proyectos_result[$kproyecto]['valor_oferta']['total'] = $total_valor_oferta;
				if(isset($proyecto['valor_compra']) && $proyecto['valor_compra']!=null && $proyecto['valor_compra']!=''){
					$proyectos_result[$kproyecto]['valor_oferta']['total_colones'] = $total_valor_oferta * $proyecto['valor_compra'];
				}else{
					$proyectos_result[$kproyecto]['valor_oferta']['total_colones'] = $total_valor_oferta * $this->config->item('tipo_cambio_compra');
				}
				




				// Para manejo de gastos
				$total_gastos = 0;
				$gastos_tmp = array();
				$gastos_array = array();

				$this->db->join($this->t_proyecto_gasto_tipo, $this->t_proyecto_gasto_tipo.'.proyecto_gasto_tipo_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 'LEFT');
				$this->db->join($this->t_proyecto_gasto_monto, $this->t_proyecto_gasto_monto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_monto.'.estado_registro = 1', 'LEFT');
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->order_by($this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 'ASC');
				$result_gastos = $this->db->get($this->t_proyecto_gasto);
				$result_gastos_num_rows = $result_gastos->num_rows();
				if($result_gastos_num_rows >0){
					$result_gastos_result = $this->security->xss_clean($result_gastos->result_array());
					foreach ($result_gastos_result as $kvalor => $vvalor) {
						$monto_gasto = $vvalor['proyecto_gasto_monto'];
						if($vvalor['moneda_id']==2){
							$proyecto_tipo_cambio_venta = $proyecto['valor_venta'];							
							$monto_gasto = $monto_gasto / $proyecto_tipo_cambio_venta;
						}
						$gastos_tmp[$vvalor['proyecto_gasto_tipo_id']][] = $monto_gasto;
					}


					$result_gastos_tipo = $this->db->get($this->t_proyecto_gasto_tipo);
					$result_gastos_tipo_num_rows = $result_gastos_tipo->num_rows();
					if($result_gastos_tipo_num_rows >0){
						$result_gastos_tipo_result = $this->security->xss_clean($result_gastos_tipo->result_array());
						foreach ($result_gastos_tipo_result as $kvtipo => $vvtipo) {
							if(isset($gastos_tmp[$vvtipo['proyecto_gasto_tipo_id']])){
								$subtotal = 0;
								foreach ($gastos_tmp[$vvtipo['proyecto_gasto_tipo_id']] as $kv => $vv) {
									$subtotal+=(double)$vv;
									$total_gastos += (double)$vv;
								}
								$gastos_array[$vvtipo['proyecto_gasto_tipo_id']] = array('tipo_id' => $vvtipo['proyecto_gasto_tipo_id'],
																						'tipo' => $vvtipo['proyecto_gasto_tipo'],
																						'valor' => $subtotal);
							}
						}
						
					}
				}
				$proyectos_result[$kproyecto]['gastos']['desgloce'] = $gastos_array;
				$proyectos_result[$kproyecto]['gastos']['total'] = $total_gastos;
				if(isset($proyecto['valor_compra']) && $proyecto['valor_compra']!=null && $proyecto['valor_compra']!=''){
					$proyectos_result[$kproyecto]['gastos']['total_colones'] = $total_gastos * $proyecto['valor_compra'];
				}else{
					$proyectos_result[$kproyecto]['gastos']['total_colones'] = $total_gastos * $this->config->item('tipo_cambio_compra');
				}


				$fecha_inicio = strtotime($vproyecto['fecha_inicio']);
				$fecha_entrega_estimada = strtotime($vproyecto['fecha_entrega_estimada']);
				$fecha_actual = strtotime('now');
				$porcentaje_avance_proyecto = 0;
				$dias_consumidos = 0;
				$dias_proyecto = (((($fecha_entrega_estimada-$fecha_inicio)/60)/60)/24);
				if($fecha_actual > $fecha_inicio){
					$dias_consumidos = (((($fecha_actual-$fecha_inicio)/60)/60)/24);
					$proyectos_result[$kproyecto]['avance_tiempo']['dias_consumidos'] = ceil($dias_consumidos);
					if($dias_proyecto!=0){
						$porcentaje_avance_proyecto = ceil((100/$dias_proyecto)*$dias_consumidos);
						$proyectos_result[$kproyecto]['avance_tiempo']['dias_proyecto'] = ceil($dias_proyecto);
						$proyectos_result[$kproyecto]['avance_tiempo']['porcentaje'] = $porcentaje_avance_proyecto;

					}else{
						$proyectos_result[$kproyecto]['avance_tiempo']['dias_consumidos'] = ceil($dias_consumidos);
						$proyectos_result[$kproyecto]['avance_tiempo']['dias_proyecto'] = ceil($dias_proyecto);
						$proyectos_result[$kproyecto]['avance_tiempo']['porcentaje'] = $porcentaje_avance_proyecto;
					}
				}else{
					$proyectos_result[$kproyecto]['avance_tiempo']['dias_consumidos'] = ceil($dias_consumidos);
					$proyectos_result[$kproyecto]['avance_tiempo']['dias_proyecto'] = ceil($dias_proyecto);
					$proyectos_result[$kproyecto]['avance_tiempo']['porcentaje'] = $porcentaje_avance_proyecto;	
				}

			}
			$result = array(
							'total_rows' => $result_proyecto->num_rows(),
							'datos' => $proyectos_result,
							);

			return $result;

		}else{
			return false;
		}
		

	}

	function consultaGastosMaterialesProyecto($data){
		if(isset($data['filtros']['proyecto_id'])){
			$select = $this->t_proyecto_tipo_cambio.'.valor_venta, '.$this->t_proveedor.'.proveedor_id, '.$this->t_proveedor.'.nombre_proveedor, '.$this->t_proyecto_gasto.'.fecha_gasto, '.$this->t_proyecto_gasto_monto.'.proyecto_gasto_monto , '.$this->t_proyecto_gasto_monto.'.moneda_id, '.$this->t_proyecto_gasto_estado.'.proyecto_gasto_estado';
				
			$this->db->select($select);
			$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto_gasto.'.proyecto_id');
			$this->db->join($this->t_proyecto_gasto_monto, $this->t_proyecto_gasto_monto.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id AND '.$this->t_proyecto_gasto_monto.'.estado_registro = 1');
			$this->db->join($this->t_proyecto_gasto_detalle, $this->t_proyecto_gasto_detalle.'.proyecto_gasto_id = '.$this->t_proyecto_gasto.'.proyecto_gasto_id');
			$this->db->join($this->t_proyecto_gasto_estado, $this->t_proyecto_gasto_estado.'.proyecto_gasto_estado_id = '.$this->t_proyecto_gasto_detalle.'.proyecto_gasto_estado_id');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_gasto_detalle.'.proveedor_id');
			$this->db->where($this->t_proyecto_gasto.'.proyecto_id', $data['filtros']['proyecto_id']);
			$this->db->where($this->t_proyecto_gasto.'.proyecto_gasto_tipo_id', 1);

			if($data['filtros']['proveedor_id']!='' && $data['filtros']['proveedor_id']!='undefined' && $data['filtros']['proveedor_id']!=null  &&  $data['filtros']['proveedor_id']!='all'){
				$this->db->where($this->t_proyecto_gasto_detalle.'.proveedor_id', $data['filtros']['proveedor_id']);
			}

			if($data['filtros']['proyecto_gasto_estado_id']!='' && $data['filtros']['proyecto_gasto_estado_id']!='undefined' && $data['filtros']['proyecto_gasto_estado_id']!=null  &&  $data['filtros']['proyecto_gasto_estado_id']!='all'){
				$this->db->where($this->t_proyecto_gasto_detalle.'.proyecto_gasto_estado_id', $data['filtros']['proyecto_gasto_estado_id']);
			}

			if(isset($data['filtros']['fecha_gasto_from']) && $data['filtros']['fecha_gasto_from']!='' && $data['filtros']['fecha_gasto_from']!='undefined' && $data['filtros']['fecha_gasto_from']!='IS NULL'){
				$data['filtros']['fecha_gasto_from'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_gasto_from'])));
				$this->db->where($this->t_proyecto_gasto.'.fecha_gasto >= "'.$data['filtros']['fecha_gasto_from'].'"');
			}

			if(isset($data['filtros']['fecha_gasto_to']) && $data['filtros']['fecha_gasto_to']!='' && $data['filtros']['fecha_gasto_to']!='undefined' && $data['filtros']['fecha_gasto_to']!='IS NULL'){
				$data['filtros']['fecha_gasto_to'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_gasto_to'])));
				$this->db->where($this->t_proyecto_gasto.'.fecha_gasto <= "'.$data['filtros']['fecha_gasto_to'].'"');
			}


			if(isset($data['filtros']['group_by'])){
				
				if($data['filtros']['group_by'] == 'proveedor'){
					//$this->db->group_by($this->t_proyecto_gasto_mano_obra.'.proyecto_colaborador_id');
					$this->db->order_by($this->t_proveedor.'.proveedor_id', 'ASC');
				}
				if($data['filtros']['group_by'] == 'none' || $data['filtros']['group_by'] == 'dia'){
					$this->db->order_by($this->t_proyecto_gasto.'.fecha_gasto', 'ASC');
				}
			}
			$result_horas = $this->db->get($this->t_proyecto_gasto);
			$result_horas_rows = $result_horas->num_rows();
			if($result_horas_rows>0){
				$result_fetch = array();
				if(isset($data['filtros']['group_by'])){
					if($data['filtros']['group_by'] == 'dia'){
						$result_tmp = $this->security->xss_clean($result_horas->result_array());
						$result_fetch = array();
						foreach($result_tmp as $kresult => $vresult){
							$proyecto_gasto_monto = 0;
							if($vresult['moneda_id']==2){
								if(isset($vresult['valor_venta']) && $vresult['valor_venta']!=null && $vresult['valor_venta']!=''){
									$proyecto_gasto_monto = $vresult['proyecto_gasto_monto'] / $vresult['valor_venta'];
								}else{
									$proyecto_gasto_monto = $vresult['proyecto_gasto_monto'] / $this->config->item('tipo_cambio_venta');
								}
							}else{
								$proyecto_gasto_monto = $vresult['proyecto_gasto_monto'];
							}
							$result_fetch[$vresult['fecha_gasto']]['fecha_gasto'] = $vresult['fecha_gasto'];
							$result_fetch[$vresult['fecha_gasto']]['proyecto_gasto_monto'] = (isset($result_fetch[$vresult['fecha_gasto']]['proyecto_gasto_monto'])) ? $result_fetch[$vresult['fecha_gasto']]['proyecto_gasto_monto'] + $proyecto_gasto_monto : $proyecto_gasto_monto;
						}
					}
					if($data['filtros']['group_by'] == 'proveedor'){
						$result_tmp = $this->security->xss_clean($result_horas->result_array());
						$result_fetch = array();
						foreach($result_tmp as $kresult => $vresult){
							$proyecto_gasto_monto = 0;
							if($vresult['moneda_id']==2){
								if(isset($vresult['valor_venta']) && $vresult['valor_venta']!=null && $vresult['valor_venta']!=''){
									$proyecto_gasto_monto = $vresult['proyecto_gasto_monto'] / $vresult['valor_venta'];
								}else{
									$proyecto_gasto_monto = $vresult['proyecto_gasto_monto'] / $this->config->item('tipo_cambio_venta');
								}
							}else{
								$proyecto_gasto_monto = $vresult['proyecto_gasto_monto'];
							}
							$result_fetch[$vresult['proveedor_id']]['nombre_proveedor'] = $vresult['nombre_proveedor'];
							$result_fetch[$vresult['proveedor_id']]['proyecto_gasto_monto'] = (isset($result_fetch[$vresult['proveedor_id']]['proyecto_gasto_monto'])) ? $result_fetch[$vresult['proveedor_id']]['proyecto_gasto_monto'] + $proyecto_gasto_monto : $proyecto_gasto_monto;
						}
					}

					if($data['filtros']['group_by'] == 'none'){
						$result_tmp = $this->security->xss_clean($result_horas->result_array());
						$result_fetch = array();
						foreach($result_tmp as $kresult => $vresult){
							$proyecto_gasto_monto = 0;
							if($vresult['moneda_id']==2){
								if(isset($vresult['valor_venta']) && $vresult['valor_venta']!=null && $vresult['valor_venta']!=''){
									$proyecto_gasto_monto = $vresult['proyecto_gasto_monto'] / $vresult['valor_venta'];
								}else{
									$proyecto_gasto_monto = $vresult['proyecto_gasto_monto'] / $this->config->item('tipo_cambio_venta');
								}
							}else{
								$proyecto_gasto_monto = $vresult['proyecto_gasto_monto'];
							}
							$result_fetch[]= array(
											'fecha_gasto' => $vresult['fecha_gasto'],
											'nombre_proveedor' => $vresult['nombre_proveedor'],
											'proyecto_gasto_monto' => $proyecto_gasto_monto);
						}
						
						
					}
				}else{
					$result_fetch = $this->security->xss_clean($result_horas->result_array());
				}		
				$result = array(
							'total_rows' => $result_horas_rows,
							'datos' => $result_fetch,
							);
				return $result;
			}else{	
				return false;
			}
		}
	}


	/* Tipos de Orden de Cambio */

	function consultarTiposOrdenCambio($data = null){
		if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($value!=='' && $value!=='undefined' && $value!==null  &&  $value!=='all'){
					if($key=='proyecto_valor_oferta_extension_tipo'){
						$this->db->like($this->t_proyecto_valor_oferta_extension_tipo.'.'.$key, $value);
					}else{
						$this->db->where($this->t_proyecto_valor_oferta_extension_tipo.'.'.$key, $value);
					}
				}
			}
		}
		$this->db->where($this->t_proyecto_valor_oferta_extension_tipo.'.estado_registro', 1);

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
		$result_proyecto_valor_oferta_extension_tipos = $this->db->get($this->t_proyecto_valor_oferta_extension_tipo);

		//vuelve a hacer la consulta para obtener el total de rows 
		/*if(isset($data['filtros'])){
			foreach ($data['filtros'] as $key => $value) {
				if($value!=='' && $value!=='undefined' && $value!==null  &&  $value!=='all'){
					if($key=='puesto'){
						$this->db->like($this->t_proyecto_valor_oferta_extension_tipo.'.'.$key, $value);
					}else{
						$this->db->where($this->t_proyecto_valor_oferta_extension_tipo.'.'.$key, $value);
					}
				}
			}
		}
		$this->db->where($this->t_proyecto_valor_oferta_extension_tipo.'.estado_registro', 1);

		$total_rows = $this->db->count_all_results($this->t_proyecto_valor_oferta_extension_tipo, FALSE);*/

		if($result_proyecto_valor_oferta_extension_tipos->num_rows()>0){
			$result = array(
							'total_rows' => $result_proyecto_valor_oferta_extension_tipos->num_rows(),
							'datos' => $this->security->xss_clean($result_proyecto_valor_oferta_extension_tipos->result_array()),
							);

			return $result;

		}else{
			return false;
		}
	}


	function insertarTipoOrdenCambio($data){
		$this->db->where('proyecto_valor_oferta_extension_tipo', $data['proyecto_valor_oferta_extension_tipo']);
		$result_consulta_tipo_orden_cambio = $this->db->get($this->t_proyecto_valor_oferta_extension_tipo);
		$result_consulta_tipo_orden_cambio_count = $result_consulta_tipo_orden_cambio->num_rows();
		if($result_consulta_tipo_orden_cambio_count > 0){
			$result_consulta_tipo_orden_cambio_row = $result_consulta_tipo_orden_cambio->row();
			if($result_consulta_tipo_orden_cambio_row->estado_registro == 1){
				return array('tipo' => 'danger',
							'texto' => 'No se pudo guardar el tipo de orden de cambio. Ya existe uno con este nombre en la Base de Datos',
							);
			}else{
				$this->db->set('estado_registro', 1);
				$this->db->where('proyecto_valor_oferta_extension_tipo', $data['proyecto_valor_oferta_extension_tipo']);
				$this->db->update($this->t_proyecto_valor_oferta_extension_tipo);
				return array('tipo' => 'success',
							'texto' => 'Tipo de orden de cambio registrado con éxito',
							);
			}
		}else{
			foreach ($data as $kfield => $vfield) {
				$this->db->set($kfield, $vfield);
			}
			$this->db->set('estado_registro', 1);
			$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
			
			$this->db->insert($this->t_proyecto_valor_oferta_extension_tipo);

			return array('tipo' => 'success',
								'texto' => 'Tipo de orden de cambio registrado con éxito',
								);
		}
		
		
	}

	function editarTipoOrdenCambio($proyecto_valor_oferta_extension_tipo_id, $data){
		$this->db->where('proyecto_valor_oferta_extension_tipo', $data['proyecto_valor_oferta_extension_tipo']);
		$this->db->where('proyecto_valor_oferta_extension_tipo_id != '.$proyecto_valor_oferta_extension_tipo_id);
		$result_consulta_tipo_orden_cambio = $this->db->get($this->t_proyecto_valor_oferta_extension_tipo);
		$result_consulta_tipo_orden_cambio_count = $result_consulta_tipo_orden_cambio->num_rows();
		if($result_consulta_tipo_orden_cambio_count > 0){
			$result_consulta_tipo_orden_cambio_row = $result_consulta_tipo_orden_cambio->row();
			if($result_consulta_tipo_orden_cambio_row->estado_registro == 1){
				return array('tipo' => 'danger',
							'texto' => 'No se pudo guardar el tipo de orden de cambio. Ya existe uno con este nombre en la Base de Datos',
							);
			}else{
				return array('tipo' => 'danger',
							'texto' => 'No se pudo guardar el tipo de orden de cambio. Previamente existió un tipo de orden de cambio con ese nombre que fue desactivado pero no eliminado porque contenia registros relacionados. Para volver a utilizar este tipo de orden de cambio, intente crearlo nuevamente. Esto lo reactivará y le permitirá crear nuevas ordenes de cambio de ese tipo.',
							);
			}
		}else{
			$this->db->set('proyecto_valor_oferta_extension_tipo', $data['proyecto_valor_oferta_extension_tipo']);
			$this->db->where('proyecto_valor_oferta_extension_tipo_id', $proyecto_valor_oferta_extension_tipo_id);
			$this->db->update($this->t_proyecto_valor_oferta_extension_tipo);

			return array('tipo' => 'success',
								'texto' => 'Tipo de orden de cambio actualizado con éxito',
								);
			$this->m_bitacora->registrarEdicionBicatora('proyecto_valor_oferta_extension_tipo', $proyecto_valor_oferta_extension_tipo_id);
		}		
	}


	function consultarTipoOrdenCambio($proyecto_valor_oferta_extension_tipo_id){
		if($proyecto_valor_oferta_extension_tipo_id!=null){
			
			$this->db->where($this->t_proyecto_valor_oferta_extension_tipo.'.proyecto_valor_oferta_extension_tipo_id', $proyecto_valor_oferta_extension_tipo_id);
			$result_puesto = $this->db->get($this->t_proyecto_valor_oferta_extension_tipo);
			if($result_puesto->num_rows()> 0){
				$result = $this->security->xss_clean($result_puesto->row_array());
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	function eliminarTipoOrdenCambio($proyecto_valor_oferta_extension_tipo_id){
		// Desactiva el usuario. No lo borra para guardar un historial.
		$this->db->where($this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_extension_tipo_id', $proyecto_valor_oferta_extension_tipo_id);
		$result_extensiones_detalle = $this->db->get($this->t_proyecto_valor_oferta_extension_detalle);
		$result_extensiones_detalle_count = $result_extensiones_detalle->num_rows();
		if($result_extensiones_detalle_count > 0){
			$this->db->set($this->t_proyecto_valor_oferta_extension_tipo.'.estado_registro', 0);
			$this->db->where($this->t_proyecto_valor_oferta_extension_tipo.'.proyecto_valor_oferta_extension_tipo_id', $proyecto_valor_oferta_extension_tipo_id);
			$this->db->update($this->t_proyecto_valor_oferta_extension_tipo);
		}else{
			$this->db->where($this->t_proyecto_valor_oferta_extension_tipo.'.proyecto_valor_oferta_extension_tipo_id', $proyecto_valor_oferta_extension_tipo_id);
			$this->db->delete($this->t_proyecto_valor_oferta_extension_tipo);

		}
		
		return true;
	}


	/* Para manejo de materiales */

	function consultarMaterialesInicialesProyecto($proyecto_id, $proyecto_materiales_id = null) {
		if($proyecto_id!=null){
			$this->db->select($this->t_proyecto_material.'.*, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material_estado.'.proyecto_material_estado');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_proyecto_material_estado, $this->t_proyecto_material_estado.'.proyecto_material_estado_id = '.$this->t_proyecto_material.'.proyecto_material_estado_id');
			$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material.'.proyecto_material_tipo', 1);

			// Si hay Ids de materiales ligados al proyecto
			if ($proyecto_materiales_id !== null) {
				$this->db->where($this->t_proyecto_material.'.proyecto_material_id IN ('.implode(',', $proyecto_materiales_id).')');
			}

			$this->db->order_by($this->t_proyecto_material.'.proyecto_material_id', 'ASC');
			$result_materiales = $this->db->get($this->t_proyecto_material);
			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $this->security->xss_clean($result_materiales->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function consultarMaterialesExtensionesProyecto($proyecto_id, $proyecto_materiales_id = null) {
		if($proyecto_id!=null){
			$this->db->select($this->t_proyecto_material.'.*, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material_estado.'.proyecto_material_estado');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_proyecto_material_estado, $this->t_proyecto_material_estado.'.proyecto_material_estado_id = '.$this->t_proyecto_material.'.proyecto_material_estado_id');
			$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material.'.proyecto_material_tipo', 2);

			// Si hay Ids de materiales ligados al proyecto
			if ($proyecto_materiales_id !== null) {
				$this->db->where($this->t_proyecto_material.'.proyecto_material_id IN ('.implode(',', $proyecto_materiales_id).')');
			}

			$this->db->order_by($this->t_proyecto_material.'.proyecto_material_id', 'ASC');
			$result_materiales = $this->db->get($this->t_proyecto_material);
			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $this->security->xss_clean($result_materiales->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function consultarMaterialesActivosProyecto($proyecto_id, $proyecto_materiales_id = null) {
		if($proyecto_id!=null){
			$this->db->select($this->t_proyecto_material.'.*, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material_estado.'.proyecto_material_estado, '.$this->t_proveedor.'.*');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_proyecto_material_estado, $this->t_proyecto_material_estado.'.proyecto_material_estado_id = '.$this->t_proyecto_material.'.proyecto_material_estado_id');
			$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1', 'LEFT');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_material_detalle.'.proveedor_id AND '.$this->t_proveedor.'.estado_proveedor = 1', 'LEFT');
			$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material.'.estado_registro', 1);

			// Si hay Ids de materiales ligados al proyecto
			if ($proyecto_materiales_id !== null) {
				$this->db->where($this->t_proyecto_material.'.proyecto_material_id IN ('.implode(',', $proyecto_materiales_id).')');
			}

			$this->db->order_by($this->t_proyecto_material.'.proyecto_material_id', 'ASC');
			$result_materiales = $this->db->get($this->t_proyecto_material);
			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $this->security->xss_clean($result_materiales->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function consultarMaterialesInicialesActivosProyecto($proyecto_id, $proyecto_materiales_id = null) {
		if($proyecto_id!=null){
			$this->db->select($this->t_proyecto_material.'.*, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material_estado.'.proyecto_material_estado');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_proyecto_material_estado, $this->t_proyecto_material_estado.'.proyecto_material_estado_id = '.$this->t_proyecto_material.'.proyecto_material_estado_id');
			$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material.'.proyecto_material_tipo', 1);
			$this->db->where($this->t_proyecto_material.'.estado_registro', 1);

			// Si hay Ids de materiales ligados al proyecto
			if ($proyecto_materiales_id !== null) {
				$this->db->where($this->t_proyecto_material.'.proyecto_material_id IN ('.implode(',', $proyecto_materiales_id).')');
			}

			$this->db->order_by($this->t_proyecto_material.'.proyecto_material_id', 'ASC');
			$result_materiales = $this->db->get($this->t_proyecto_material);
			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $this->security->xss_clean($result_materiales->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function consultarMaterialesExtensionesActivosProyecto($proyecto_id, $proyecto_materiales_id = null) {
		if($proyecto_id!=null){
			$this->db->select($this->t_proyecto_material.'.*, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material_estado.'.proyecto_material_estado');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_proyecto_material_estado, $this->t_proyecto_material_estado.'.proyecto_material_estado_id = '.$this->t_proyecto_material.'.proyecto_material_estado_id');
			$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material.'.proyecto_material_tipo', 2);
			$this->db->where($this->t_proyecto_material.'.estado_registro', 1);

			// Si hay Ids de materiales ligados al proyecto
			if ($proyecto_materiales_id !== null) {
				$this->db->where($this->t_proyecto_material.'.proyecto_material_id IN ('.implode(',', $proyecto_materiales_id).')');
			}

			$this->db->order_by($this->t_proyecto_material.'.proyecto_material_id', 'ASC');
			$result_materiales = $this->db->get($this->t_proyecto_material);
			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $this->security->xss_clean($result_materiales->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function consultarProveedoresMaterialesActivosProyecto($proyecto_id, $proyecto_materiales_id = null) {
		if($proyecto_id!=null){
			$this->db->select($this->t_proyecto_material.'.*, '.$this->t_proyecto_material_detalle.'.proveedor_id, '.$this->t_proyecto_material_detalle.'.moneda_id, '.$this->t_proyecto_material_detalle.'.precio, '.$this->t_proyecto_material_detalle.'.tiene_impuesto, '.$this->t_proyecto_material_detalle.'.impuesto, '.$this->t_proveedor.'.nombre_proveedor, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material_estado.'.proyecto_material_estado, '.$this->t_moneda.'.simbolo');
			$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1', 'LEFT');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_material_detalle.'.proveedor_id', 'LEFT');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_moneda, $this->t_moneda.'.moneda_id = '.$this->t_proyecto_material_detalle.'.moneda_id', 'LEFT');
			$this->db->join($this->t_proyecto_material_estado, $this->t_proyecto_material_estado.'.proyecto_material_estado_id = '.$this->t_proyecto_material.'.proyecto_material_estado_id');
			$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material.'.estado_registro', 1);

			// Si hay Ids de materiales ligados al proyecto
			if ($proyecto_materiales_id !== null) {
				$this->db->where($this->t_proyecto_material.'.proyecto_material_id IN ('.implode(',', $proyecto_materiales_id).')');
			}

			$this->db->order_by($this->t_proyecto_material.'.proyecto_material_id', 'ASC');
			$result_materiales = $this->db->get($this->t_proyecto_material);
			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $this->security->xss_clean($result_materiales->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function consultarProveedoresMaterialesInicialesActivosProyecto($proyecto_id, $proyecto_materiales_id = null) {
		if($proyecto_id!=null){
			$this->db->select($this->t_proyecto_material.'.*, '.$this->t_proyecto_material_detalle.'.proveedor_id, '.$this->t_proyecto_material_detalle.'.moneda_id, '.$this->t_proyecto_material_detalle.'.precio, '.$this->t_proyecto_material_detalle.'.tiene_impuesto, '.$this->t_proyecto_material_detalle.'.impuesto, '.$this->t_proveedor.'.nombre_proveedor, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material_estado.'.proyecto_material_estado, '.$this->t_moneda.'.simbolo');
			$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1', 'LEFT');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_material_detalle.'.proveedor_id', 'LEFT');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_moneda, $this->t_moneda.'.moneda_id = '.$this->t_proyecto_material_detalle.'.moneda_id', 'LEFT');
			$this->db->join($this->t_proyecto_material_estado, $this->t_proyecto_material_estado.'.proyecto_material_estado_id = '.$this->t_proyecto_material.'.proyecto_material_estado_id');
			$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material.'.proyecto_material_tipo', 1);
			$this->db->where($this->t_proyecto_material.'.estado_registro', 1);

			// Si hay Ids de materiales ligados al proyecto
			if ($proyecto_materiales_id !== null) {
				$this->db->where($this->t_proyecto_material.'.proyecto_material_id IN ('.implode(',', $proyecto_materiales_id).')');
			}

			$this->db->order_by($this->t_proyecto_material.'.proyecto_material_id', 'ASC');
			$result_materiales = $this->db->get($this->t_proyecto_material);
			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $this->security->xss_clean($result_materiales->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function consultarProveedoresMaterialesExtensionesActivosProyecto($proyecto_id, $proyecto_materiales_id = null) {
		if($proyecto_id!=null){
			$this->db->select($this->t_proyecto_material.'.*, '.$this->t_proyecto_material_detalle.'.proveedor_id, '.$this->t_proyecto_material_detalle.'.moneda_id, '.$this->t_proyecto_material_detalle.'.precio, '.$this->t_proyecto_material_detalle.'.tiene_impuesto, '.$this->t_proyecto_material_detalle.'.impuesto, '.$this->t_proveedor.'.nombre_proveedor, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material_estado.'.proyecto_material_estado, '.$this->t_moneda.'.simbolo');
			$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1', 'LEFT');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_material_detalle.'.proveedor_id', 'LEFT');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_moneda, $this->t_moneda.'.moneda_id = '.$this->t_proyecto_material_detalle.'.moneda_id', 'LEFT');
			$this->db->join($this->t_proyecto_material_estado, $this->t_proyecto_material_estado.'.proyecto_material_estado_id = '.$this->t_proyecto_material.'.proyecto_material_estado_id');
			$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material.'.proyecto_material_tipo', 2);
			$this->db->where($this->t_proyecto_material.'.estado_registro', 1);

			// Si hay Ids de materiales ligados al proyecto
			if ($proyecto_materiales_id !== null) {
				$this->db->where($this->t_proyecto_material.'.proyecto_material_id IN ('.implode(',', $proyecto_materiales_id).')');
			}

			$this->db->order_by($this->t_proyecto_material.'.proyecto_material_id', 'ASC');
			$result_materiales = $this->db->get($this->t_proyecto_material);
			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $this->security->xss_clean($result_materiales->result_array()),
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	function relacionarMaterialProyecto($proyecto_id, $material_id, $tipo_relacion,  $datos_relacion) {
		if ($proyecto_id!=null && $material_id!=null) {
			// Pregunta si el material ya esta ligado al proyecto
			if ($tipo_relacion == 1){
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->where('material_id', $material_id);
				$this->db->where('proyecto_material_tipo', 1);
				$result_proyecto_material = $this->db->get($this->t_proyecto_material);
				$result_proyecto_material_count = $result_proyecto_material->num_rows();
				if ($result_proyecto_material_count > 0) {
					// Si el material que se esta agregando es de la lista inicial retorna error porque ya existe uno registrado previamente (ya arriba se agrego la condicion si es un material de la lista inicial)
					$result = array('tipo' => 'danger',
						'texto' => 'Ya este material se encuentra relacionado. Si desea modificar su cantidad, búsquelo en el listado inferior y modifique su información. Si es una extensión de la lista inicial, vaya a la sección de extension de materiales y agreguelo ahí'
					);
				} else {
					//Si entra aqui es que es un material que se agrega como extension de la lista inicial
					$this->db->set('proyecto_id', $proyecto_id);
					$this->db->set('material_id', $material_id);
					$this->db->set('usuario_id', $this->usuario_id);
					$this->db->set('proyecto_material_tipo', $tipo_relacion);
					foreach ($datos_relacion as $key => $value) {
						$this->db->set($key, $value);
					}
					$this->db->set('proyecto_material_estado_id', 1);
					$this->db->set('fecha_registro',  date('Y-m-d H:i:s'));
					$this->db->set('estado_registro', 1);
					$this->db->insert($this->t_proyecto_material);

					$proyecto_material_id = $this->db->insert_id();
					$this->db->set('proyecto_material_id', $proyecto_material_id );
					$this->db->set('fecha_registro',  date('Y-m-d H:i:s'));
					$this->db->set('estado_registro', 1);
					$this->db->insert($this->t_proyecto_material_detalle);

					$result = array('tipo' => 'success',
						'texto' => 'Material agregado con éxito al proyecto'
					);
				}
			} else {
				//Si entra aqui es que es un material que se agrega como extension de la lista inicial
				$this->db->set('proyecto_id', $proyecto_id);
				$this->db->set('material_id', $material_id);
				$this->db->set('usuario_id', $this->usuario_id);
				$this->db->set('proyecto_material_tipo', $tipo_relacion);
				foreach ($datos_relacion as $key => $value) {
					$this->db->set($key, $value);
				}
				$this->db->set('proyecto_material_estado_id', 1);
				$this->db->set('fecha_registro',  date('Y-m-d H:i:s'));
				$this->db->set('estado_registro', 1);
				$this->db->insert($this->t_proyecto_material);

				$proyecto_material_id = $this->db->insert_id();
				$this->db->set('proyecto_material_id', $proyecto_material_id );
				$this->db->set('fecha_registro',  date('Y-m-d H:i:s'));
				$this->db->set('estado_registro', 1);
				$this->db->insert($this->t_proyecto_material_detalle);

				$result = array('tipo' => 'success',
						'texto' => 'Material agregado con éxito al proyecto'
					);
			}
		}else{
			$result = array('tipo' => 'danger',
					'texto' => 'Hubo un error al relacionar el material al proyecto.'
				);
		}
		return $result;
	}

	function actualizarMaterialProyecto($proyecto_material_id, $datos) {
		if (isset($proyecto_material_id) && $proyecto_material_id !== null) {
			if (isset($datos) && !empty($datos)) {
				foreach ($datos as $key => $value) {
					$this->db->set($key, $value);
				}
				$this->db->where('proyecto_material_id', $proyecto_material_id);
				$this->db->update($this->t_proyecto_material);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function actualizarProveedorMaterialProyecto($proyecto_material_id, $datos) {
		if (isset($proyecto_material_id) && $proyecto_material_id !== null) {
			if (isset($datos) && !empty($datos)) {
				$datos['precio'] = str_replace(' ', '', $datos['precio']);
				$datos['impuesto'] = str_replace(' ', '', $datos['impuesto']);
				$this->db->where('proyecto_material_id', $proyecto_material_id);
				$this->db->where('estado_registro', 1);
				$result_proyecto = $this->db->get($this->t_proyecto_material_detalle);
				$result_proyecto_count = $result_proyecto->num_rows();
				if ($result_proyecto_count > 0) {
					$this->db->set('estado_registro', 0);
					$this->db->where('estado_registro', 1);
					$this->db->where('proyecto_material_id', $proyecto_material_id);
					$this->db->update($this->t_proyecto_material_detalle);
				} 

				$this->db->where('proyecto_material_id', $proyecto_material_id);
				$this->db->where('estado_registro', 1);
				$result_material_proyecto = $this->db->get($this->t_proyecto_material);
				$result_material_proyecto_count = $result_material_proyecto->num_rows();
				if ($result_material_proyecto_count > 0) {
					$result_material_proyecto_row = $result_material_proyecto->row();
					if ($result_material_proyecto_row->proyecto_material_estado_id == 1) {
						// Cambia el estado del material la primera vez que se registra el proveedor
						$this->db->set('proyecto_material_estado_id', 2);
						$this->db->where('proyecto_material_id', $proyecto_material_id);
						$this->db->where('estado_registro', 1);
						$this->db->update($this->t_proyecto_material);
					}
				} 
				

				$this->db->set('usuario_id', $this->usuario_id);
				$this->db->set('estado_registro', 1);
				$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
				foreach ($datos as $key => $value) {
					$this->db->set($key, $value);
				}
				$this->db->where('proyecto_material_id', $proyecto_material_id);
				$this->db->insert($this->t_proyecto_material_detalle);

				$this->actualizarValorOfertaMaterialesProyecto($proyecto_material_id);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function actualizarValorOfertaMaterialesProyecto($proyecto_material_id) {
		if($proyecto_material_id!==null) {
			$this->db->where('proyecto_material_id', $proyecto_material_id);
			$this->db->where('estado_registro', 1);
			$result_material_proyecto = $this->db->get($this->t_proyecto_material);
			$result_material_proyecto_count = $result_material_proyecto->num_rows();
			if ($result_material_proyecto_count > 0) {
				$result_material_proyecto_row = $result_material_proyecto->row();
				
				//Cargamos el proyecto
				$proyecto_id = $result_material_proyecto_row->proyecto_id;
				$this->db->where($this->t_proyecto.'.proyecto_id', $proyecto_id);
				$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto.'.proyecto_id');
				$proyecto_result = $this->db->get($this->t_proyecto);
				$proyecto = $proyecto_result->row();

				//Obtiene todos de materiales de este proyecto
				$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
				$this->db->where($this->t_proyecto_material.'.estado_registro', 1);
				$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1');
				$result_todos_materiales_proyecto = $this->db->get($this->t_proyecto_material);
				$result_todos_materiales_proyecto_count = $result_todos_materiales_proyecto->num_rows();

				// Valor acumulado de oferta de materiales
				$total_valor_oferta_materiales = 0;
				if ($result_todos_materiales_proyecto_count > 0) {
					$result_todos_materiales_proyecto_rows = $result_todos_materiales_proyecto->result();
					foreach ($result_todos_materiales_proyecto_rows as $kmaterial => $vmaterial) {
						$monto_gasto = $vmaterial->precio;
						if($vmaterial->moneda_id==2){
							$proyecto_tipo_cambio_venta = $proyecto->valor_venta;							
							$monto_gasto = $monto_gasto / $proyecto_tipo_cambio_venta;
						}
						if ($vmaterial->tiene_impuesto == 1){
							$monto_gasto = $monto_gasto + (($monto_gasto / 100) * str_replace(' ', '',$vmaterial->impuesto));
						}
						$array[$vmaterial->proyecto_material_id]['impuesto'] = $vmaterial->impuesto;
						$array[$vmaterial->proyecto_material_id]['monto_con_impuesto'] = $monto_gasto;
						$total_valor_oferta_materiales += $monto_gasto;
					}
				}
				
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->where('proyecto_valor_oferta_tipo_id', 1);
				$result_valor = $this->db->get($this->t_proyecto_valor_oferta);
				$result_valor_count = $result_valor->num_rows();

				$this->db->set('valor_oferta', str_replace(' ', '',$total_valor_oferta_materiales));
				if ($result_valor_count > 0) {
					$this->db->where('proyecto_id', $proyecto_id);
					$this->db->where('proyecto_valor_oferta_tipo_id', 1);
					$this->db->update($this->t_proyecto_valor_oferta);
				} else {
					$this->db->set('proyecto_valor_oferta_tipo_id', 1);
					$this->db->set('proyecto_id', $proyecto_id);
					$this->db->set('moneda_id', 1);
					$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
					$this->db->set('estado_registro', 1);
					$this->db->insert($this->t_proyecto_valor_oferta);
				}
			}
		}
	}

	function validarExistenciaMaterialCotizadoProyecto($proyecto_id) {
		$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
		$this->db->where($this->t_proyecto_material.'.estado_registro', 1);
		$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1');
		$result_todos_materiales_proyecto = $this->db->get($this->t_proyecto_material);
		$result_todos_materiales_proyecto_count = $result_todos_materiales_proyecto->num_rows();

		if ($result_todos_materiales_proyecto_count > 0) {
			return true;
		} else {
			return false;
		}
	}

	function toggleEstadoMaterialProyecto($proyecto_material_id) {
		if (isset($proyecto_material_id) && $proyecto_material_id !== null) {
			$this->db->where('proyecto_material_id', $proyecto_material_id);
			$result_material =  $this->db->get($this->t_proyecto_material);
			$result_material_count = $result_material->num_rows();
			if ($result_material_count > 0){
				$result_material_result = $result_material->row();
				if ($result_material_result->estado_registro == 0) {
					$this->db->set('estado_registro', 1);
				} else {
					$this->db->set('estado_registro', 0);
				}
				$this->db->where('proyecto_material_id', $proyecto_material_id);
				$this->db->update($this->t_proyecto_material);
				return true;
			}else {
				return false;
			}			
		} else {
			return false;
		}
	}


	function insertarSolicitudCotizacionMateriales($proyecto_id) {
		$this->db->set('proyecto_id', $proyecto_id);
		$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
		$this->db->insert($this->t_proyecto_material_solicitud_cotizacion);
		return $this->db->insert_id();
	}

	function actualizarSolicitudCotizacionMateriales($proyecto_material_solicitud_cotizacion_id, $datos) {
		foreach ($datos as $key => $value) {
			$this->db->set($key, $value);
		}
		$this->db->where('proyecto_material_solicitud_cotizacion_id', $proyecto_material_solicitud_cotizacion_id);
		$this->db->update($this->t_proyecto_material_solicitud_cotizacion);
	}

	function consultarSolicitudesCotizacionMaterialesProyecto($proyecto_id) {
		if ($proyecto_id !== null) {
			$this->db->where('proyecto_id', $proyecto_id);
			$result_solicitudes = $this->db->get($this->t_proyecto_material_solicitud_cotizacion);

			$result_solicitudes_count = $result_solicitudes->num_rows();
			if($result_solicitudes_count> 0){
				$result = array(
							'total_rows' => $result_solicitudes_count,
							'datos' => $this->security->xss_clean($result_solicitudes->result_array()),
							);
				return $result;
			}else{
				return false;
			}
			
		} else {
			return false;
		}
	}

	function consultarSolicitudesCompraMaterialesProyecto ($proyecto_id) {
		if ($proyecto_id !== null) {
			$this->db->where($this->t_proyecto.'.proyecto_id', $proyecto_id);
			$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto.'.proyecto_id');
			$proyecto_result = $this->db->get($this->t_proyecto);
			$proyecto = $this->security->xss_clean($proyecto_result->row_array());

			$this->db->where($this->t_proyecto_material_solicitud_compra.'.proyecto_id', $proyecto_id);
			$this->db->join($this->t_usuario_detalle, $this->t_usuario_detalle.'.usuario_id = '.$this->t_proyecto_material_solicitud_compra.'.usuario_id');
			$this->db->join($this->t_proyecto_material_solicitud_compra_estado, $this->t_proyecto_material_solicitud_compra_estado.'.proyecto_material_solicitud_compra_estado_id = '.$this->t_proyecto_material_solicitud_compra.'.proyecto_material_solicitud_compra_estado_id');
			$result_solicitudes = $this->db->get($this->t_proyecto_material_solicitud_compra);

			$result_solicitudes_count = $result_solicitudes->num_rows();
			if($result_solicitudes_count> 0){
				$result_solicitudes_rows = $this->security->xss_clean($result_solicitudes->result_array());
				foreach ($result_solicitudes_rows as $ksolicitud => $vsolicitud) {
					$this->db->select($this->t_proyecto_material_solicitud_compra_detalle.'.cantidad as cantidad_compra, '.$this->t_proyecto_material_detalle.'.precio, '.$this->t_proyecto_material_detalle.'.moneda_id, '.$this->t_proyecto_material.'.cantidad, '.$this->t_proyecto_material_detalle.'.tiene_impuesto, '.$this->t_proyecto_material_detalle.'.impuesto');
					$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_solicitud_compra_id', $vsolicitud['proyecto_material_solicitud_compra_id']);
					$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.estado_registro', 1);
					$this->db->join($this->t_proyecto_material, $this->t_proyecto_material.'.proyecto_material_id = '.$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id');
					$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1');
					$result_solicitudes_detalle = $this->db->get($this->t_proyecto_material_solicitud_compra_detalle);
					$result_solicitudes_detalle_count = $result_solicitudes_detalle->num_rows();
					$total_solicitud_compra = 0;
					if ($result_solicitudes_detalle_count > 0) {
						$result_solicitudes_detalle_rows = $this->security->xss_clean($result_solicitudes_detalle->result_array());
						foreach ($result_solicitudes_detalle_rows as $ksolicitud_detalle => $vsolicitud_detalle) {
							$monto_gasto_individual = $vsolicitud_detalle['precio'] / $vsolicitud_detalle['cantidad'];
							if($vsolicitud_detalle['moneda_id']==2){
								$proyecto_tipo_cambio_venta = $proyecto['valor_venta'];							
								$monto_gasto_individual = $monto_gasto_individual / $proyecto_tipo_cambio_venta;
							}
							if ($vsolicitud_detalle['tiene_impuesto'] == 1){
								$monto_gasto_individual = $monto_gasto_individual + (($monto_gasto_individual / 100) * str_replace(' ', '',$vsolicitud_detalle['impuesto']));
							}

							$total_solicitud_compra += $monto_gasto_individual * $vsolicitud_detalle['cantidad_compra'];
						}
					}

					$result_solicitudes_rows[$ksolicitud]['costo_solicitud'] = $total_solicitud_compra;

				}
				$result = array(
							'total_rows' => $result_solicitudes_count,
							'datos' => $result_solicitudes_rows,
							);
				return $result;
			}else{
				return false;
			}
			
		} else {
			return false;
		}
	}


	function consultarMaterialesRestantesActivosProyecto ($proyecto_id, $proyecto_materiales_id = null) {
		if($proyecto_id!=null){
			$this->db->select($this->t_proyecto_material.'.*, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material_estado.'.proyecto_material_estado');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_proyecto_material_estado, $this->t_proyecto_material_estado.'.proyecto_material_estado_id = '.$this->t_proyecto_material.'.proyecto_material_estado_id');
			$this->db->where($this->t_proyecto_material.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material.'.estado_registro', 1);

			// Si hay Ids de materiales ligados al proyecto
			if ($proyecto_materiales_id !== null) {
				$this->db->where($this->t_proyecto_material.'.proyecto_material_id IN ('.implode(',', $proyecto_materiales_id).')');
			}

			$this->db->order_by($this->t_proyecto_material.'.proyecto_material_id', 'ASC');
			$result_materiales = $this->db->get($this->t_proyecto_material);
			$result_materiales_count = $result_materiales->num_rows();

			// Busca los materiales comprados
			$this->db->select(
				$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id, '.
				$this->t_proyecto_material_solicitud_compra_detalle.'.cantidad'
			);
			$this->db->join($this->t_proyecto_material_solicitud_compra, $this->t_proyecto_material_solicitud_compra.'.proyecto_material_solicitud_compra_id = '.$this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_id');
			$this->db->join($this->t_proyecto_material_solicitud_compra_detalle, $this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_solicitud_compra_id = '.$this->t_proyecto_material_solicitud_compra.'.proyecto_material_solicitud_compra_id AND '.$this->t_proyecto_material_solicitud_compra_detalle.'.estado_registro = 1');
			$this->db->join($this->t_proyecto_material,  $this->t_proyecto_material.'.proyecto_material_id = '.$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id AND '.$this->t_proyecto_material.'.estado_registro = 1');
			$this->db->join($this->t_proyecto_material_detalle,  $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.proveedor_id = '.$this->t_proyecto_material_solicitud_compra_orden_compra.'.proveedor_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1');
			$this->db->join($this->t_material,  $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id');
			$this->db->where($this->t_proyecto_material_solicitud_compra.'.proyecto_id', $proyecto_id);
			$this->db->where($this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_orden_compra_estado_id', 3);
			$this->db->order_by($this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id', 'ASC');
			$materiales_comprados = $this->db->get($this->t_proyecto_material_solicitud_compra_orden_compra);
			$materiales_comprados_count = $materiales_comprados->num_rows();
			//exit(json_encode($materiales_comprados->result()));
			//Valida si hay materiales asignados al proyecto
			if($result_materiales_count> 0){
				$result_materiales_rows = $this->security->xss_clean($result_materiales->result_array());
				//recorre todos los materiales para ver si han comprado alguno
				foreach ($result_materiales_rows as $kmaterial => $vmaterial) {
					$materiales_comprados_total_cantidad = 0;
					// Si hay materiales comprados entonces los recorre y suma las cantidades
					if ($materiales_comprados_count > 0) {
						$materiales_comprados_rows = $this->security->xss_clean($materiales_comprados->result_array());
						foreach ($materiales_comprados_rows as $kmaterial_comprado => $vmaterial_comprado) {
							if ($vmaterial_comprado['proyecto_material_id'] == $vmaterial['proyecto_material_id']) {
								$materiales_comprados_total_cantidad += $vmaterial_comprado['cantidad'];
							}
						}
					}
					$result_materiales_rows[$kmaterial]['cantidad_restante'] = (double)$vmaterial['cantidad'] - (double)$materiales_comprados_total_cantidad;
				}
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $result_materiales_rows,
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	function consultarMaterialesSolicitudCompra ($proyecto_material_solicitud_compra_id) {
		if($proyecto_material_solicitud_compra_id!=null){
			$this->db->select($this->t_proyecto_material_solicitud_compra_detalle.'.cantidad as cantidad_compra, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material.'.*, '.$this->t_proveedor.'.proveedor_id, '.$this->t_proveedor.'.nombre_proveedor');
			$this->db->join($this->t_proyecto_material, $this->t_proyecto_material.'.proyecto_material_id = '.$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id');
			$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_material_detalle.'.proveedor_id');
			$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
			$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.estado_registro', 1);

			$result_materiales = $this->db->get($this->t_proyecto_material_solicitud_compra_detalle);
			$result_materiales_count = $result_materiales->num_rows();

			//Valida si hay materiales asignados al proyecto
			if($result_materiales_count > 0){
				$result_materiales_rows = $this->security->xss_clean($result_materiales->result_array());
				$result = array(
							'total_rows' => $result_materiales_count,
							'datos' => $result_materiales_rows,
							);
				return $result;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	function agregarSolicitudCompraMateriales ($proyecto_id, $data) {
		if ($proyecto_id !== null) {
			if ($data !== null) {
				if (isset($data['material_check']) && !empty($data['material_check'])) {
					$validacion = false;
					foreach ($data['material_check'] as $kmaterial => $vmaterial) {
						foreach ($data['cantidad'] as $kcantidad => $vcantidad) {
							if($kcantidad == $kmaterial) {
								if ($vcantidad > 0){
									$validacion = true;
								}
							}
						}
					}

					if ($validacion) {
						$this->db->set('proyecto_id', $proyecto_id);
						$this->db->set('usuario_id', $this->usuario_id);
						if ($this->rol_id == 3) {
							$this->db->set('proyecto_material_solicitud_compra_estado_id', 1);
						} else {
							$this->db->set('proyecto_material_solicitud_compra_estado_id', 2);
						}
						$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
						$this->db->insert($this->t_proyecto_material_solicitud_compra);
						$proyecto_material_solicitud_compra_id = $this->db->insert_id();

						foreach ($data['material_check'] as $kmaterial => $vmaterial) {
							if ($data['cantidad'][$kmaterial] > 0) {
								$this->db->set('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
								$this->db->set('proyecto_material_id', $kmaterial);
								$this->db->set('cantidad', $data['cantidad'][$kmaterial]);
								$this->db->set('estado_registro', 1);
								$this->db->insert($this->t_proyecto_material_solicitud_compra_detalle);
							}
						}

						return array(
							'tipo' => 'success',
							'texto' => 'Se creó la solicitud de compra exitosamente',
						);

					} else {
						return array(
							'tipo' => 'danger',
							'texto' => 'No se ingresó la cantidad para ningún material seleccionado',
						);
					}
				} else {
					return array(
						'tipo' => 'danger',
						'texto' => 'No se seleccionó ningún material para hacer la solicitud',
					);
				}
			} else {
				return array(
					'tipo' => 'danger',
					'texto' => 'No se ingresaron datos para registrar',
				);
			}
		} else {
			return array(
				'tipo' => 'danger',
				'texto' => 'Hubo un error en la operación. Proyecto no definido',
			);
		}
	}

	function editarSolicitudCompraMateriales ($proyecto_id, $proyecto_material_solicitud_compra_id, $data) {
		if ($proyecto_id !== null && $proyecto_material_solicitud_compra_id !== null) {
			if ($data !== null) {
				if (isset($data['material_check']) && !empty($data['material_check'])) {
					$validacion = false;
					foreach ($data['material_check'] as $kmaterial => $vmaterial) {
						foreach ($data['cantidad'] as $kcantidad => $vcantidad) {
							if($kcantidad == $kmaterial) {
								if ($vcantidad > 0 && $vcantidad !== ''){
									$validacion = true;
								}
							}
						}
					}

					$this->db->where('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
					$result_materiales_solicitud = $this->db->get($this->t_proyecto_material_solicitud_compra_detalle);
					$result_materiales_solicitud_count = $result_materiales_solicitud->num_rows();


					if ($validacion) {
						// Se verifica primero la lista almacenada para editarla
						if ($result_materiales_solicitud_count > 0){
							$result_materiales_solicitud_rows = $result_materiales_solicitud->result();
							foreach ($result_materiales_solicitud_rows as $kmatsolicitud => $vmatsolicitud) {
								if (isset($data['material_check'][$vmatsolicitud->proyecto_material_id])) {
									$this->db->set('cantidad', $data['cantidad'][$vmatsolicitud->proyecto_material_id]);
									$this->db->set('estado_registro', 1);
									$this->db->where('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
									$this->db->where('proyecto_material_id', $vmatsolicitud->proyecto_material_id);
									$this->db->update($this->t_proyecto_material_solicitud_compra_detalle);
									unset($data['material_check'][$vmatsolicitud->proyecto_material_id]);
									unset($data['cantidad'][$vmatsolicitud->proyecto_material_id]);
									unset($result_materiales_solicitud_rows[$kmatsolicitud]);
								} else {
									$this->db->set('estado_registro', 0);
									$this->db->where('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
									$this->db->where('proyecto_material_id', $vmatsolicitud->proyecto_material_id);
									$this->db->update($this->t_proyecto_material_solicitud_compra_detalle);
								}
							}
						}
						
						foreach ($data['material_check'] as $kmaterial => $vmaterial) {
							if ($data['cantidad'][$kmaterial] > 0) {
								$this->db->set('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
								$this->db->set('proyecto_material_id', $kmaterial);
								$this->db->set('cantidad', $data['cantidad'][$kmaterial]);
								$this->db->set('estado_registro', 1);
								$this->db->insert($this->t_proyecto_material_solicitud_compra_detalle);
							}
						}

						return array(
							'tipo' => 'success',
							'texto' => 'Se creó la solicitud de compra exitosamente',
						);

					} else {
						return array(
							'tipo' => 'danger',
							'texto' => 'No se ingresó la cantidad para ningún material seleccionado',
						);
					}
				} else {
					return array(
						'tipo' => 'danger',
						'texto' => 'No se seleccionó ningún material para hacer la solicitud',
					);
				}
			} else {
				return array(
					'tipo' => 'danger',
					'texto' => 'No se ingresaron datos para registrar',
				);
			}
		} else {
			return array(
				'tipo' => 'danger',
				'texto' => 'Hubo un error en la operación. Proyecto no definido',
			);
		}
	}

	function consultarEstadosSolicitudCompra() {
		$result_estados = $this->db->get($this->t_proyecto_material_solicitud_compra_estado);
		$result_estados_count = $result_estados->num_rows();
		if ($result_estados_count > 0) {
			return $this->security->xss_clean($result_estados->result_array());
		} else {
			return false;
		}
	}

	function consultarSolicitudCompra ($proyecto_material_solicitud_compra_id) {
		$this->db->where('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
		$result_solicitud = $this->db->get($this->t_proyecto_material_solicitud_compra);
		$result_solicitud_count = $result_solicitud->num_rows();
		if ($result_solicitud_count > 0) {
			return $this->security->xss_clean($result_solicitud->row_array());
		} else {
			return false;
		}
	}

	function cambiarEstadoSolicitudCompra ($proyecto_id, $proyecto_material_solicitud_compra_id, $data) {

		$this->db->set('proyecto_material_solicitud_compra_estado_id', $data['proyecto_material_solicitud_compra_estado_id']);
		$this->db->where('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
		$this->db->update($this->t_proyecto_material_solicitud_compra);
		return array(
			'tipo' => 'success',
			'texto' => 'Se actualizó el estado de la solicitud correctamente',
		);
	}

	

	/* Para manejo de proformas */

	function consultarProformasSolicitudMaterialesProyecto($proyecto_material_solicitud_compra_id) {
		if ($proyecto_material_solicitud_compra_id !== null) {
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_material_solicitud_compra_proforma.'.proveedor_id');
			$this->db->join($this->t_proyecto_material_solicitud_compra_proforma_estado, $this->t_proyecto_material_solicitud_compra_proforma_estado.'.proyecto_material_solicitud_compra_proforma_estado_id = '.$this->t_proyecto_material_solicitud_compra_proforma.'.proyecto_material_solicitud_compra_proforma_estado_id');
			$this->db->where('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
			$this->db->order_by($this->t_proyecto_material_solicitud_compra_proforma.'.proyecto_material_solicitud_compra_proforma_id', 'ASC');
			$result_proformas = $this->db->get($this->t_proyecto_material_solicitud_compra_proforma);

			$result_proformas_count = $result_proformas->num_rows();
			if($result_proformas_count> 0){
				$proveedores = array();
				$result_proformas_rows =$this->security->xss_clean($result_proformas->result_array());
				foreach ($result_proformas_rows as $korden => $vorden) {
					$proveedores[$vorden['proveedor_id']]['proveedor_id'] = $vorden['proveedor_id'];
					$proveedores[$vorden['proveedor_id']]['nombre_proveedor'] = $vorden['nombre_proveedor'];
					$proveedores[$vorden['proveedor_id']]['proformas'][] = $vorden;
				}
				$result = array(
							'total_rows' => $result_proformas_count,
							'datos' => $proveedores,
							);
				return $result;
			}else{
				return false;
			}
			
		} else {
			return false;
		}
	}

	function consultarProformasAprobadas($proyecto_material_solicitud_compra_id){
		$this->db->select('proveedor_id');
		$this->db->where('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
		//ordenes de compra aprobadas
		$this->db->where('proyecto_material_solicitud_compra_proforma_estado_id', 3);
		$proformas_aprobadas = $this->db->get($this->t_proyecto_material_solicitud_compra_proforma);
		$proformas_aprobadas_count = $proformas_aprobadas->num_rows();
		if ($proformas_aprobadas_count > 0) {
			$proformas_aprobadas_rows = $this->security->xss_clean($proformas_aprobadas->result_array());
			return $proformas_aprobadas_rows;
		} else {
			return false;
		}
	}

	function consultarMaterialesAgrupadoPorProveedor ($proyecto_material_solicitud_compra_id) {
		if ($proyecto_material_solicitud_compra_id !== null) {
			$this->db->select($this->t_proyecto_material_solicitud_compra_detalle.'.cantidad as cantidad_compra, '.$this->t_material.'.material, '.$this->t_material.'.material_codigo, '.$this->t_material_unidad.'.material_unidad, '.$this->t_proyecto_material.'.*, '.$this->t_proveedor.'.proveedor_id, '.$this->t_proveedor.'.nombre_proveedor');
			$this->db->join($this->t_proyecto_material, $this->t_proyecto_material.'.proyecto_material_id = '.$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id', 'LEFT');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id', 'LEFT');
			$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1', 'LEFT');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_material_detalle.'.proveedor_id', 'LEFT');
			$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
			$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.estado_registro', 1);
			$result_materiales = $this->db->get($this->t_proyecto_material_solicitud_compra_detalle);

			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result_materiales_rows = $this->security->xss_clean($result_materiales->result_array());
				$materiales_x_proveedor = array();
				foreach ($result_materiales_rows as $kmaterial => $vmaterial) {
					$materiales_x_proveedor[$vmaterial['proveedor_id']]['nombre_proveedor'] = $vmaterial['nombre_proveedor'];
					$materiales_x_proveedor[$vmaterial['proveedor_id']]['materiales'][] = $vmaterial;
				}
				return $materiales_x_proveedor;
			}else{
				return false;
			}
			
		} else {
			return false;
		}
	}

	function consultarMaterialesSolicitudCompraPorProveedor ($proyecto_id, $proyecto_material_solicitud_compra_id, $proveedor_id) {
		if ($proyecto_material_solicitud_compra_id !== null) {
			$this->db->where($this->t_proyecto.'.proyecto_id', $proyecto_id);
			$this->db->join($this->t_proyecto_tipo_cambio, $this->t_proyecto_tipo_cambio.'.proyecto_id = '.$this->t_proyecto.'.proyecto_id');
			$proyecto_result = $this->db->get($this->t_proyecto);
			$proyecto = $proyecto_result->row();

			$this->db->select(
				$this->t_proyecto_material_solicitud_compra_detalle.'.cantidad as cantidad_compra, '.
				$this->t_proyecto_material_detalle.'.precio, '.
				$this->t_proyecto_material_detalle.'.moneda_id, '.
				$this->t_proyecto_material.'.cantidad, '.
				$this->t_proyecto_material_detalle.'.tiene_impuesto, '.
				$this->t_proyecto_material_detalle.'.impuesto, '.
				$this->t_material.'.material, '.
				$this->t_material.'.material_codigo, '.
				$this->t_material_unidad.'.material_unidad, '.
				$this->t_proyecto_material.'.*, '.
				$this->t_proveedor.'.proveedor_id, '.
				$this->t_proveedor.'.nombre_proveedor, '.
				$this->t_moneda.'.moneda, '.
				$this->t_moneda.'.simbolo');
			$this->db->join($this->t_proyecto_material, $this->t_proyecto_material.'.proyecto_material_id = '.$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id', 'LEFT');
			$this->db->join($this->t_material, $this->t_material.'.material_id = '.$this->t_proyecto_material.'.material_id', 'LEFT');
			$this->db->join($this->t_material_unidad, $this->t_material_unidad.'.material_unidad_id = '.$this->t_proyecto_material.'.material_unidad_id', 'LEFT');
			$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1', 'LEFT');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_material_detalle.'.proveedor_id', 'LEFT');
			$this->db->join($this->t_moneda, $this->t_moneda.'.moneda_id = '.$this->t_proyecto_material_detalle.'.moneda_id', 'LEFT');
			$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
			$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.estado_registro', 1);
			$this->db->where($this->t_proyecto_material_detalle.'.proveedor_id', $proveedor_id);
			$result_materiales = $this->db->get($this->t_proyecto_material_solicitud_compra_detalle);
			$result_materiales_count = $result_materiales->num_rows();
			if($result_materiales_count> 0){
				$result_materiales_rows = $this->security->xss_clean($result_materiales->result_array());
				foreach ($result_materiales_rows as $ksolicitud_detalle => $vsolicitud_detalle) {
					$monto_gasto_individual = $vsolicitud_detalle['precio'] / $vsolicitud_detalle['cantidad'];
					$monto_impuesto = 0;
					/*if($vsolicitud_detalle['moneda_id']==2){
						$proyecto_tipo_cambio_venta = $proyecto->valor_venta;							
						$monto_gasto_individual = $monto_gasto_individual / $proyecto_tipo_cambio_venta;
					}*/
					if ($vsolicitud_detalle['tiene_impuesto'] == 1){
						$monto_impuesto = (($monto_gasto_individual / 100) * str_replace(' ', '',$vsolicitud_detalle['impuesto'])) * $vsolicitud_detalle['cantidad_compra'];
					}
					$result_materiales_rows[$ksolicitud_detalle]['precio_individual'] = $monto_gasto_individual;
					$result_materiales_rows[$ksolicitud_detalle]['precio_impuesto'] = $monto_impuesto;
					$result_materiales_rows[$ksolicitud_detalle]['precio_total_linea'] = $monto_gasto_individual * $vsolicitud_detalle['cantidad_compra'];

					$this->db->where('proveedor_id', $proveedor_id);
					$result_correo = $this->db->get($this->t_proveedor_correo);
					$result_correo_count = $result_correo->num_rows();
					if ($result_correo_count > 0) {
						$result_correo_row = $this->security->xss_clean($result_correo->row_array());
						$result_materiales_rows[$ksolicitud_detalle]['correo_proveedor'] = $result_correo_row['correo_proveedor'];
					} else {
						$result_materiales_rows[$ksolicitud_detalle]['correo_proveedor'] = '';
					}

					$this->db->where('proveedor_id', $proveedor_id);
					$result_telefono = $this->db->get($this->t_proveedor_telefono);
					$result_telefono_count = $result_telefono->num_rows();
					if ($result_telefono_count > 0 ) {
						$result_telefono_row = $this->security->xss_clean($result_telefono->row_array());
						$result_materiales_rows[$ksolicitud_detalle]['telefono_proveedor'] = $result_telefono_row['telefono_proveedor'];
					} else {
						$result_materiales_rows[$ksolicitud_detalle]['telefono_proveedor'] = '';
					}

				}

				$result = array(
					'total_rows' => $result_materiales_count,
					'datos' => $result_materiales_rows,
				);
				return $result;
			}else{
				return false;
			}
		} else {
			return false;
		}
	}

	function insertarProformaMateriales($proyecto_id, $proyecto_material_solicitud_compra_id, $proveedor_id) {
		$this->db->set('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
		$this->db->set('proyecto_material_solicitud_compra_proforma_estado_id', 1);
		$this->db->set('usuario_id', $this->usuario_id);
		$this->db->set('proveedor_id', $proveedor_id);
		$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
		$this->db->insert($this->t_proyecto_material_solicitud_compra_proforma);
		return $this->db->insert_id();
	}

	function actualizarProformaMateriales($proyecto_material_solicitud_compra_proforma_id, $datos) {
		foreach ($datos as $key => $value) {
			$this->db->set($key, $value);
		}
		$this->db->where('proyecto_material_solicitud_compra_proforma_id', $proyecto_material_solicitud_compra_proforma_id);
		$this->db->update($this->t_proyecto_material_solicitud_compra_proforma);
	}

	function consultarProformasEstados(){
		$result_estados = $this->db->get($this->t_proyecto_material_solicitud_compra_proforma_estado);
		$result_estados_count = $result_estados->num_rows();
		if ($result_estados_count > 0){
			return $this->security->xss_clean($result_estados->result_array());
		} else {
			return false;
		}
	}

	function actualizarEstadoProforma($proyecto_material_solicitud_compra_proforma_id, $proyecto_material_solicitud_compra_proforma_estado_id) {
		$this->db->set('proyecto_material_solicitud_compra_proforma_estado_id', $proyecto_material_solicitud_compra_proforma_estado_id);
		$this->db->where('proyecto_material_solicitud_compra_proforma_id', $proyecto_material_solicitud_compra_proforma_id);
		$this->db->update($this->t_proyecto_material_solicitud_compra_proforma);
		return array(
			'tipo' => 'success',
			'texto' => 'Se actualizó el estado de la proforma correctamente',
		);

	}


	/* Para manejo de ordenes de compra */

	function consultarOrdenesCompraSolicitudMaterialesProyecto($proyecto_material_solicitud_compra_id) {
		if ($proyecto_material_solicitud_compra_id !== null) {
			$this->db->select($this->t_proyecto_material_solicitud_compra_orden_compra.'.*, '.$this->t_proveedor.'.nombre_proveedor, '.$this->t_proyecto_material_solicitud_compra_orden_compra_estado.'.proyecto_material_solicitud_compra_orden_compra_estado');
			$this->db->join($this->t_proveedor, $this->t_proveedor.'.proveedor_id = '.$this->t_proyecto_material_solicitud_compra_orden_compra.'.proveedor_id');
			$this->db->join($this->t_proyecto_material_solicitud_compra_orden_compra_estado, $this->t_proyecto_material_solicitud_compra_orden_compra_estado.'.proyecto_material_solicitud_compra_orden_compra_estado_id = '.$this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_orden_compra_estado_id');
			$this->db->where('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
			$this->db->order_by($this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_orden_compra_id', 'ASC');
			$result_ordenes_compra = $this->db->get($this->t_proyecto_material_solicitud_compra_orden_compra);

			$result_ordenes_compra_count = $result_ordenes_compra->num_rows();
			if($result_ordenes_compra_count> 0){
				$proveedores = array();
				$result_ordenes_compra_rows = $this->security->xss_clean($result_ordenes_compra->result_array());
				foreach ($result_ordenes_compra_rows as $korden => $vorden) {
					$proveedores[$vorden['proveedor_id']]['proveedor_id'] = $vorden['proveedor_id'];
					$proveedores[$vorden['proveedor_id']]['nombre_proveedor'] = $vorden['nombre_proveedor'];
					$proveedores[$vorden['proveedor_id']]['ordenes_compra'][] = $vorden;
				}
				$result = array(
							'total_rows' => $result_ordenes_compra_count,
							'datos' => $proveedores,
							);
				return $result;
			}else{
				return false;
			}
			
		} else {
			return false;
		}
	}

	function consultarOrdenesCompraAprobadas($proyecto_material_solicitud_compra_id){
		$this->db->select('proveedor_id');
		$this->db->where('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
		//ordenes de compra aprobadas
		$this->db->where('proyecto_material_solicitud_compra_orden_compra_estado_id', 3);
		$ordenes_aprobadas = $this->db->get($this->t_proyecto_material_solicitud_compra_orden_compra);
		$ordenes_aprobadas_count = $ordenes_aprobadas->num_rows();
		if ($ordenes_aprobadas_count > 0) {
			$ordenes_aprobadas_rows = $this->security->xss_clean($ordenes_aprobadas->result_array());
			return $ordenes_aprobadas_rows;
		} else {
			return false;
		}
	}

	function insertarOrdenCompraMateriales($proyecto_id, $proyecto_material_solicitud_compra_id, $proveedor_id) {
		$this->db->set('proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
		$this->db->set('proyecto_material_solicitud_compra_orden_compra_estado_id', 1);
		$this->db->set('usuario_id', $this->usuario_id);
		$this->db->set('proveedor_id', $proveedor_id);
		$this->db->set('fecha_registro', date('Y-m-d H:i:s'));
		$this->db->insert($this->t_proyecto_material_solicitud_compra_orden_compra);
		return $this->db->insert_id();
	}

	function actualizarOrdenCompraMateriales($proyecto_material_solicitud_compra_orden_compra_id, $datos) {
		foreach ($datos as $key => $value) {
			$this->db->set($key, $value);
		}
		$this->db->where('proyecto_material_solicitud_compra_orden_compra_id', $proyecto_material_solicitud_compra_orden_compra_id);
		$this->db->update($this->t_proyecto_material_solicitud_compra_orden_compra);
	}

	function consultarOrdenesCompraEstados(){
		$result_estados = $this->db->get($this->t_proyecto_material_solicitud_compra_orden_compra_estado);
		$result_estados_count = $result_estados->num_rows();
		if ($result_estados_count > 0){
			return $this->security->xss_clean($result_estados->result_array());
		} else {
			return false;
		}
	}

	function actualizarEstadoOrdenCompra($proyecto_id, $proyecto_material_solicitud_compra_orden_compra_id, $proyecto_material_solicitud_compra_orden_compra_estado_id) {
		// Consulta el estado previo de la orden de compra
		$this->db->where('proyecto_material_solicitud_compra_orden_compra_id', $proyecto_material_solicitud_compra_orden_compra_id);
		$estado_previo = $this->db->get($this->t_proyecto_material_solicitud_compra_orden_compra);
		$estado_previo_count = $estado_previo->num_rows();
		$stado_previo_row = null;
		if ($estado_previo_count > 0) {
			$estado_previo_row = $estado_previo->row();
		}

		// Actualiza el estado
		$this->db->set('proyecto_material_solicitud_compra_orden_compra_estado_id', $proyecto_material_solicitud_compra_orden_compra_estado_id);
		$this->db->where('proyecto_material_solicitud_compra_orden_compra_id', $proyecto_material_solicitud_compra_orden_compra_id);
		$this->db->update($this->t_proyecto_material_solicitud_compra_orden_compra);
		// Cambia el estado de los materiales
		$this->cambiarEstadoMaterialesPorOrdenDespuesCompra($proyecto_id);

		// Si la orden antes no estaba aprobada y ahora si
		if($estado_previo_row->proyecto_material_solicitud_compra_orden_compra_estado_id != 3 && $proyecto_material_solicitud_compra_orden_compra_estado_id == 3){
			$this->registrarGastoMaterialOrdenCompra($proyecto_id, $proyecto_material_solicitud_compra_orden_compra_id);
		} else if ($estado_previo_row->proyecto_material_solicitud_compra_orden_compra_estado_id == 3 && $proyecto_material_solicitud_compra_orden_compra_estado_id != 3){
			$this->eliminarGastoMaterialOrdenCompra($proyecto_material_solicitud_compra_orden_compra_id);
		}
		return array(
			'tipo' => 'success',
			'texto' => 'Se actualizó el estado de la orden de compra correctamente',
		);

	}

	function cambiarEstadoMaterialesPorOrdenDespuesCompra ($proyecto_id) {
		// Buscamos materiales de esta solicitud
		$this->db->select(
			$this->t_proyecto_material.'.proyecto_material_id, '.
			$this->t_proyecto_material.'.proyecto_material_estado_id, '.
			$this->t_proyecto_material.'.material_id, '.
			$this->t_proyecto_material.'.proyecto_id, '.
			$this->t_proyecto_material.'.proyecto_material_tipo, '.
			$this->t_proyecto_material.'.cantidad as cantidad_inicial, '.
			$this->t_proyecto_material_detalle.'.proveedor_id, '.
			$this->t_proyecto_material_detalle.'.precio, '.
			$this->t_proyecto_material_solicitud_compra.'.proyecto_material_solicitud_compra_id, '.
			$this->t_proyecto_material_solicitud_compra.'.proyecto_material_solicitud_compra_estado_id, '.
			$this->t_proyecto_material_solicitud_compra_detalle.'.cantidad as cantidad_comprada, '.
			$this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_orden_compra_id, '.
			$this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_orden_compra_estado_id'
		);
		$this->db->join($this->t_proyecto_material_solicitud_compra_orden_compra, $this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_id = '.$this->t_proyecto_material_solicitud_compra.'.proyecto_material_solicitud_compra_id');
		$this->db->join($this->t_proyecto_material_solicitud_compra_detalle, $this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_solicitud_compra_id = '.$this->t_proyecto_material_solicitud_compra.'.proyecto_material_solicitud_compra_id AND '.$this->t_proyecto_material_solicitud_compra_detalle.'.estado_registro = 1');
		$this->db->join($this->t_proyecto_material, $this->t_proyecto_material.'.proyecto_material_id = '.$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id AND '.$this->t_proyecto_material.'.estado_registro = 1');
		$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.proveedor_id = '.$this->t_proyecto_material_solicitud_compra_orden_compra.'.proveedor_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1');
		$this->db->where($this->t_proyecto_material_solicitud_compra.'.proyecto_id', $proyecto_id);
		$this->db->where($this->t_proyecto_material_solicitud_compra_orden_compra.'.proyecto_material_solicitud_compra_orden_compra_estado_id', 3);
		$result_materiales = $this->db->get($this->t_proyecto_material_solicitud_compra);
		$result_materiales_count = $result_materiales->num_rows();

		//recorre todos los materiales para ver si han comprado alguno
		$materiales_agotados = array();
		$materiales_consumidos_parcialmente = array();
			
			//Valida si hay materiales asignados al proyecto
		if($result_materiales_count> 0){
			$result_materiales_rows = $result_materiales->result();
			$materiales_comprados_total_cantidad = array();
			$materiales_restantes = array();
			$materiales_comprados_ids = array();
			// Carga la cantidad de materiales iniciales
			foreach ($result_materiales_rows as $kmaterial => $vmaterial) {
				$materiales_restantes[$vmaterial->proyecto_material_id] = (double)$vmaterial->cantidad_inicial;
				$materiales_comprados_total_cantidad[$vmaterial->proyecto_material_id] = 0;
				$materiales_comprados_ids[] = $vmaterial->proyecto_material_id;
			}

			// Suma las compras
			foreach ($result_materiales_rows as $kmaterial => $vmaterial) {
				$materiales_comprados_total_cantidad[$vmaterial->proyecto_material_id] += (double)$vmaterial->cantidad_comprada;
			}

			//resta los materiales comprados a la cantidad inicial
			foreach ($materiales_restantes as $kmaterial => $vmaterial) {
				$cantidad_restante = $vmaterial - $materiales_comprados_total_cantidad[$kmaterial];

				if ($cantidad_restante > 0){
					$materiales_consumidos_parcialmente[] = $kmaterial;
				} else {
					$materiales_agotados[] = $kmaterial;
				}
			}
			
			// Actualiza los materiales parcialmente consumidos
			if (!empty($materiales_consumidos_parcialmente)) {
				// Cambia el estado del material la primera vez que se registra el proveedor
				$this->db->set('proyecto_material_estado_id', 3);
				$this->db->where_in('proyecto_material_id', $materiales_consumidos_parcialmente);
				$this->db->where('estado_registro', 1);
				$this->db->update($this->t_proyecto_material);
			}

			// Actualiza los materiales consumidos
			if (!empty($materiales_agotados)) {
				// Cambia el estado del material la primera vez que se registra el proveedor
				$this->db->set('proyecto_material_estado_id', 4);
				$this->db->where_in('proyecto_material_id', $materiales_agotados);
				$this->db->where('estado_registro', 1);
				$this->db->update($this->t_proyecto_material);
			}

			// Actualiza los materiales que no han sido consumidos del todo (en caso de una reversion)
			$this->db->select($this->t_proyecto_material_detalle.'.proyecto_material_id');
			$this->db->join($this->t_proyecto_material, $this->t_proyecto_material.'.proyecto_material_id = '.$this->t_proyecto_material_detalle.'.proyecto_material_id AND '.$this->t_proyecto_material.'.estado_registro = 1');
			$this->db->where($this->t_proyecto_material_detalle.'.estado_registro', 1);
			$this->db->where('proyecto_id', $proyecto_id);
			$this->db->where_not_in($this->t_proyecto_material_detalle.'.proyecto_material_id', $materiales_comprados_ids);
			$result_materiales_cotizados_no_consumidos = $this->db->get($this->t_proyecto_material_detalle);
			$result_materiales_cotizados_no_consumidos_count = $result_materiales_cotizados_no_consumidos->num_rows();
			if ($result_materiales_cotizados_no_consumidos_count > 0) {
				$result_materiales_cotizados_no_consumidos_rows = $result_materiales_cotizados_no_consumidos->result();
				$result_materiales_cotizados_no_consumidos_ids = array();
				foreach ($result_materiales_cotizados_no_consumidos_rows as $key => $value) {
					$result_materiales_cotizados_no_consumidos_ids[] = $value->proyecto_material_id;
				}
				
				$this->db->set('proyecto_material_estado_id', 2);
				$this->db->where_in('proyecto_material_id', $result_materiales_cotizados_no_consumidos_ids);
				$this->db->where('estado_registro', 1);
				$this->db->update($this->t_proyecto_material);
			}
		}
	}


	function registrarGastoMaterialOrdenCompra($proyecto_id, $proyecto_material_solicitud_compra_orden_compra_id) { //TODO
		if($proyecto_material_solicitud_compra_orden_compra_id !== null) {
			$this->db->where('proyecto_material_solicitud_compra_orden_compra_id', $proyecto_material_solicitud_compra_orden_compra_id);
			$ordenes_compra =  $this->db->get($this->t_proyecto_material_solicitud_compra_orden_compra);
			$ordenes_compra_row =  $ordenes_compra->row();
			$proveedor_id = $ordenes_compra_row->proveedor_id;
			$url_archivo = $ordenes_compra_row->url_archivo;
			$proyecto_material_solicitud_compra_id = $ordenes_compra_row->proyecto_material_solicitud_compra_id;

			$this->db->select(
				$this->t_proyecto_material.'.proyecto_material_id, '.
				$this->t_proyecto_material.'.proyecto_material_estado_id, '.
				$this->t_proyecto_material.'.material_id, '.
				$this->t_proyecto_material.'.proyecto_id, '.
				$this->t_proyecto_material.'.proyecto_material_tipo, '.
				$this->t_proyecto_material.'.cantidad as cantidad_inicial, '.
				$this->t_proyecto_material_detalle.'.proveedor_id, '.
				$this->t_proyecto_material_detalle.'.precio, '.
				$this->t_proyecto_material_detalle.'.tiene_impuesto, '.
				$this->t_proyecto_material_detalle.'.impuesto, '.
				$this->t_proyecto_material_detalle.'.moneda_id, '.
				$this->t_proyecto_material_solicitud_compra_detalle.'.cantidad as cantidad_comprada'
			);
			$this->db->join($this->t_proyecto_material, $this->t_proyecto_material.'.proyecto_material_id = '.$this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_id AND '.$this->t_proyecto_material.'.estado_registro = 1');
			$this->db->join($this->t_proyecto_material_detalle, $this->t_proyecto_material_detalle.'.proyecto_material_id = '.$this->t_proyecto_material.'.proyecto_material_id AND '.$this->t_proyecto_material_detalle.'.estado_registro = 1');
			$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.proyecto_material_solicitud_compra_id', $proyecto_material_solicitud_compra_id);
			$this->db->where($this->t_proyecto_material_solicitud_compra_detalle.'.estado_registro', 1);
			$this->db->where($this->t_proyecto_material_detalle.'.proveedor_id', $proveedor_id);
			$result_materiales_proveedor = $this->db->get($this->t_proyecto_material_solicitud_compra_detalle);
			$result_materiales_proveedor_count = $result_materiales_proveedor->num_rows();
			$total_orden_compra = 0;
			$moneda_id = 1;
			if ($result_materiales_proveedor_count > 0) {
				$result_materiales_proveedor_rows = $result_materiales_proveedor->result();
				foreach ($result_materiales_proveedor_rows as $korden => $vorden) {
					$monto_gasto_individual = $vorden->precio / $vorden->cantidad_inicial;
					if ($vorden->tiene_impuesto == 1){
						$monto_gasto_individual = $monto_gasto_individual + (($monto_gasto_individual / 100) * str_replace(' ', '',$vorden->impuesto));
					}
					if ($vorden->moneda_id != 1){
						$moneda_id = $vorden->moneda_id;
					}

					$total_orden_compra += $monto_gasto_individual * $vorden->cantidad_comprada;
				}
				

			}

			$proyecto_gasto_id = null;
			$this->db->where('proyecto_material_solicitud_compra_orden_compra_id', $proyecto_material_solicitud_compra_orden_compra_id);
			$result_relacion_material_gasto = $this->db->get($this->t_proyecto_gasto_material);
			$result_relacion_material_gasto_count = $result_relacion_material_gasto->num_rows();

			$gasto_nuevo = true;
			if ($result_relacion_material_gasto_count) {
				// Si entra aqui ya hay un gasto relacionado
				$result_relacion_material_gasto_row = $result_relacion_material_gasto->row();
				$proyecto_gasto_id = $result_relacion_material_gasto_row->proyecto_gasto_id;
				$gasto_nuevo = false;
			} else {
				// Si entra aqui no hay gasto registrado, Entonces lo registra
				$datos_gasto = array();		
				$datos_gasto['usuario_id'] = $this->usuario_id;
				$datos_gasto['proyecto_id'] = $proyecto_id;
				$datos_gasto['fecha_registro'] = date('Y-m-d H:i:s');
				$datos_gasto['fecha_gasto'] = date('Y-m-d');
				$datos_gasto['proyecto_gasto_tipo_id'] = 1;
				$datos_gasto['tiene_desgloce'] = 1;
				
				$this->db->insert($this->t_proyecto_gasto, $datos_gasto);
				$proyecto_gasto_id = $this->db->insert_id();

				$this->db->set('proyecto_gasto_id', $proyecto_gasto_id);
				$this->db->set('proyecto_material_solicitud_compra_orden_compra_id', $proyecto_material_solicitud_compra_orden_compra_id);
				$this->db->insert($this->t_proyecto_gasto_material);
			}

			if($proyecto_gasto_id!=null){
				if (!$gasto_nuevo){
					//Actualiza el monto anterior a 0
					$this->db->where('proyecto_gasto_id', $proyecto_gasto_id);
					$this->db->where('estado_registro', 1);
					$result_gasto_monto = $this->db->get($this->t_proyecto_gasto_monto);
					$result_gasto_monto_count = $result_gasto_monto->num_rows();
					if ($result_gasto_monto_count > 0) {
						$result_gasto_monto_row = $result_gasto_monto->row();
						$proyecto_gasto_monto_id = $result_gasto_monto_row->proyecto_gasto_monto_id;
						$this->db->set('estado_registro', 0);
						$this->db->where('proyecto_gasto_monto_id', $proyecto_gasto_monto_id);
						$this->db->update($this->t_proyecto_gasto_monto);
					}					
				}

				//Registra el monto
				$datos['proyecto_gasto_id'] = $proyecto_gasto_id;
				$datos['estado_registro'] = 1;
				$datos['moneda_id'] = $moneda_id;
				$datos['fecha_registro'] = date('Y-m-d H:i:s');
				$datos['proyecto_gasto_monto'] = str_replace(' ', '', $total_orden_compra);
				$this->db->insert($this->t_proyecto_gasto_monto, $datos);

				//Registra el detalle del gasto
				$datos2['proyecto_gasto_id'] = $proyecto_gasto_id;
				$datos2['proveedor_id'] = $proveedor_id;
				$datos2['proyecto_gasto_estado_id'] = 2;
				$datos2['numero_factura'] = '';
				$datos2['gasto_detalle'] = 'Gasto registrado por orden de compra de materiales # '.$proyecto_material_solicitud_compra_orden_compra_id.'. El link para descargar el archivo es '.base_url().$url_archivo;
				$this->db->insert($this->t_proyecto_gasto_detalle, $datos2);
			}
		} else {
			return false;
		}

	}

	function eliminarGastoMaterialOrdenCompra($proyecto_material_solicitud_compra_orden_compra_id) {
		$this->db->where('proyecto_material_solicitud_compra_orden_compra_id', $proyecto_material_solicitud_compra_orden_compra_id);
		$result_relacion_gasto_orden_compra = $this->db->get($this->t_proyecto_gasto_material);
		$result_relacion_gasto_orden_compra_count = $result_relacion_gasto_orden_compra->num_rows();

		if ($result_relacion_gasto_orden_compra_count > 0) {
			$result_relacion_gasto_orden_compra_rows = $result_relacion_gasto_orden_compra->row();

			$proyecto_gasto_id = $result_relacion_gasto_orden_compra_rows->proyecto_gasto_id;

			$this->db->where('proyecto_gasto_id', $proyecto_gasto_id);
			$this->db->delete($this->t_proyecto_gasto_detalle);

			$this->db->where('proyecto_gasto_id', $proyecto_gasto_id);
			$this->db->delete($this->t_proyecto_gasto_monto);

			$this->db->where('proyecto_gasto_id', $proyecto_gasto_id);
			$this->db->delete($this->t_proyecto_gasto_material);

			$this->db->where('proyecto_gasto_id', $proyecto_gasto_id);
			$this->db->delete($this->t_proyecto_gasto);
		}
	}
}