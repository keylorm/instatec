<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Proyecto extends CI_Model {
	
	private $t_proyecto = 'proyecto',
			$t_proyecto_estado = 'proyecto_estado',
			$t_proyecto_valor_oferta = 'proyecto_valor_oferta',
			$t_proyecto_tipo_cambio = 'proyecto_tipo_cambio',
			$t_proyecto_valor_oferta_tipo = 'proyecto_valor_oferta_tipo',
			$t_proyecto_valor_oferta_extension_detalle = 'proyecto_valor_oferta_extension_detalle',
			$t_proyecto_valor_oferta_extension_tipo = 'proyecto_valor_oferta_extension_tipo',
			$t_proyecto_gasto = 'proyecto_gasto',
			$t_proyecto_gasto_tipo = 'proyecto_gasto_tipo',
			$t_proyecto_gasto_estado = 'proyecto_gasto_estado',
			$t_proyecto_gasto_monto = 'proyecto_gasto_monto',
			$t_proyecto_gasto_detalle = 'proyecto_gasto_detalle',
			$t_proyecto_gasto_mano_obra = 'proyecto_gasto_mano_obra',
			$t_proyecto_colaborador = 'proyecto_colaborador',
			$t_cliente = 'cliente',
			$t_proveedor = 'proveedor',
			$t_distrito = 'distrito',
			$t_canton = 'canton',
			$t_provincia = 'provincia',
			$t_moneda = 'moneda',
			$t_colaborador = 'colaborador',
			$t_colaborador_puesto = 'colaborador_puesto',
			$t_colaborador_costo_hora = 'colaborador_costo_hora',
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
			return $proyecto_estado_result->result();
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
							'datos' => $result_proyecto->result(),
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
			$result = $result_proyecto->result();
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
			if(isset($filtros['jefe_proyecto_id'])){
				$where  = '('.$this->t_proyecto.'.jefe_proyecto_id = '.$filtros['jefe_proyecto_id'].') AND ';
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
							'datos' => $result_proyecto->result(),
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
							'datos' => $result_proyecto->result(),
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
			$datos['fecha_firma_contrato'] = ($datos['fecha_firma_contrato']!='' && $datos['fecha_firma_contrato']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_firma_contrato']))):'';
			$datos['fecha_inicio'] = ($datos['fecha_inicio']!='' && $datos['fecha_inicio']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_inicio']))):'';
			$datos['fecha_entrega_estimada'] = ($datos['fecha_entrega_estimada']!='' && $datos['fecha_entrega_estimada']!=null )?date('Y-m-d', strtotime(str_replace('/','-',$datos['fecha_entrega_estimada']))):'';
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
				$result['proyecto'] = $result_proyecto->row();
				
				// Obtiene los valores de la oferta
				$this->db->join($this->t_proyecto_valor_oferta_tipo, $this->t_proyecto_valor_oferta_tipo.'.proyecto_valor_oferta_tipo_id = '.$this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_tipo_id', 'LEFT');
				$this->db->join($this->t_moneda, $this->t_moneda.'.moneda_id = '.$this->t_proyecto_valor_oferta.'.moneda_id');
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->order_by($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_tipo_id', 'ASC');
				$result_valor_oferta = $this->db->get($this->t_proyecto_valor_oferta);
				if($result_valor_oferta->num_rows()>0){
					$result['valor_oferta'] = $result_valor_oferta->result();
				}
				
				// Obtiene el tipo de cambio
				$this->db->where('proyecto_id', $proyecto_id);
				$result_tipo_cambio = $this->db->get($this->t_proyecto_tipo_cambio);
				if($result_tipo_cambio->num_rows()>0){
					$result['tipo_cambio'] = $result_tipo_cambio->row();
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
					$result['gastos'] = $result_gastos->result();
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
					$proyecto = $result_proyecto->row();

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
					$result_valor_oferta_result = $result_valor_oferta->result();
					foreach ($result_valor_oferta_result as $kvalor => $vvalor) {
						$valor_oferta_tmp[$vvalor->proyecto_valor_oferta_tipo_id][] = $vvalor->valor_oferta;
					}


					$result_valor_oferta_tipo = $this->db->get($this->t_proyecto_valor_oferta_tipo);
					$result_valor_oferta_tipo_num_rows = $result_valor_oferta_tipo->num_rows();
					if($result_valor_oferta_tipo_num_rows>0){
						$result_valor_oferta_tipo_result = $result_valor_oferta_tipo->result();
						foreach ($result_valor_oferta_tipo_result as $kvtipo => $vvtipo) {
							if(isset($valor_oferta_tmp[$vvtipo->proyecto_valor_oferta_tipo_id])){
								$subtotal = 0;
								foreach ($valor_oferta_tmp[$vvtipo->proyecto_valor_oferta_tipo_id] as $kv => $vv) {
									$subtotal+=(double)$vv;
									$total_valor_oferta += (double)$vv;
								}
								$valor_oferta_array[$vvtipo->proyecto_valor_oferta_tipo_id] = array('tipo_id' => $vvtipo->proyecto_valor_oferta_tipo_id,
																									'tipo' => $vvtipo->proyecto_valor_oferta_tipo,
																									'valor' => $subtotal);
							}
						}
						
					}
				}
				$result_array['valor_oferta']['desgloce'] = $valor_oferta_array;
				$result_array['valor_oferta']['total'] = $total_valor_oferta;
				if(isset($proyecto->valor_compra) && $proyecto->valor_compra!=null && $proyecto->valor_compra!=''){
					$result_array['valor_oferta']['total_colones'] = $total_valor_oferta * $proyecto->valor_compra;
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
					$result_gastos_result = $result_gastos->result();
					foreach ($result_gastos_result as $kvalor => $vvalor) {
						$monto_gasto = $vvalor->proyecto_gasto_monto;
						if($vvalor->moneda_id==2){
							$proyecto_tipo_cambio_venta = $proyecto->valor_venta;							
							$monto_gasto = $monto_gasto / $proyecto_tipo_cambio_venta;
						}
						$gastos_tmp[$vvalor->proyecto_gasto_tipo_id][] = $monto_gasto;
					}


					$result_gastos_tipo = $this->db->get($this->t_proyecto_gasto_tipo);
					$result_gastos_tipo_num_rows = $result_gastos_tipo->num_rows();
					if($result_gastos_tipo_num_rows >0){
						$result_gastos_tipo_result = $result_gastos_tipo->result();
						foreach ($result_gastos_tipo_result as $kvtipo => $vvtipo) {
							if(isset($gastos_tmp[$vvtipo->proyecto_gasto_tipo_id])){
								$subtotal = 0;
								foreach ($gastos_tmp[$vvtipo->proyecto_gasto_tipo_id] as $kv => $vv) {
									$subtotal+=(double)$vv;
									$total_gastos += (double)$vv;
								}
								$gastos_array[$vvtipo->proyecto_gasto_tipo_id] = array('tipo_id' => $vvtipo->proyecto_gasto_tipo_id,
																						'tipo' => $vvtipo->proyecto_gasto_tipo,
																						'valor' => $subtotal);
							}
						}
						
					}
				}
				$result_array['gastos']['desgloce'] = $gastos_array;
				$result_array['gastos']['total'] = $total_gastos;
				if(isset($proyecto->valor_compra) && $proyecto->valor_compra!=null && $proyecto->valor_compra!=''){
					$result_array['gastos']['total_colones'] = $total_gastos * $proyecto->valor_compra;
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
					$result_tiempo_colaboradores_rows = $result_tiempo_colaboradores->result();
					foreach ($result_tiempo_colaboradores_rows as $ktiempo => $vtiempo) {
						if(!isset($tiempo_por_colaborador[$vtiempo->colaborador_id])){
							$tiempo_por_colaborador[$vtiempo->colaborador_id] = array(
								'detalle' => $vtiempo,
								'total_semanal' => 0,
								'total_mensual' => 0,
								'total_diario' => 0,
								'total' => 0,
							);
							$total_colaboradores++;
						}
						if($vtiempo->fecha_gasto >= date('Y-m-01')){
							$tiempo_mensual += ($vtiempo->cantidad_horas+ $vtiempo->cantidad_horas_extra);
							$tiempo_por_colaborador[$vtiempo->colaborador_id]['total_mensual'] += ($vtiempo->cantidad_horas+ $vtiempo->cantidad_horas_extra);
						}

						if($vtiempo->fecha_gasto >= date('Y-m-d', strtotime('monday this week'))){
							$tiempo_semanal += ($vtiempo->cantidad_horas+ $vtiempo->cantidad_horas_extra);
							$tiempo_por_colaborador[$vtiempo->colaborador_id]['total_semanal'] += ($vtiempo->cantidad_horas+ $vtiempo->cantidad_horas_extra);
						}
						if($vtiempo->fecha_gasto == date('Y-m-d')){
							$tiempo_diario += ($vtiempo->cantidad_horas+ $vtiempo->cantidad_horas_extra);
							$tiempo_por_colaborador[$vtiempo->colaborador_id]['total_diario'] += ($vtiempo->cantidad_horas+ $vtiempo->cantidad_horas_extra);
						}

						$tiempo_total += ($vtiempo->cantidad_horas+ $vtiempo->cantidad_horas_extra);
						$tiempo_por_colaborador[$vtiempo->colaborador_id]['total'] += ($vtiempo->cantidad_horas+ $vtiempo->cantidad_horas_extra);
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
						$this->db->where($this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_id', $vvalor->proyecto_valor_oferta_id);
						$this->db->delete($this->t_proyecto_valor_oferta_extension_detalle);		
					}
				}
				//Borra el valor de la oferta
				$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_id', $proyecto_id);
				$this->db->delete($this->t_proyecto_valor_oferta);
			}


			// Borra el tipo de cambio
			$this->db->where($this->t_proyecto_tipo_cambio.'.proyecto_id', $proyecto_id);
			$this->db->delete($this->t_proyecto_tipo_cambio);

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
				$result= $result_extensiones->result();
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
		$this->db->join($this->t_proyecto_valor_oferta_extension_detalle, $this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_id = '.$this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', 'LEFT');
		$this->db->join($this->t_proyecto_valor_oferta_extension_tipo, $this->t_proyecto_valor_oferta_extension_tipo.'.proyecto_valor_oferta_extension_tipo_id = '.$this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_extension_tipo_id', 'LEFT');
		
		$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_tipo_id', 6);

		if(isset($data['filtros'])){			
			foreach ($data['filtros'] as $key => $value) {
				if($value!='' && $value!='undefined' && $value!=null  &&  $value!='all'){
					if($key=='proyecto_valor_oferta_extension_tipo_id'){
						$this->db->where($this->t_proyecto_valor_oferta_extension_detalle.'.'.$key, $value);
					}else if($key=='fecha_registro'){
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
							'datos' => $result_extensiones->result(),
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
			return $result_extensiones_tipos->result();
		}else{
			return false;
		}

	}


	function consultarExtension($extension_id){
		if($extension_id!=null){
			$this->db->join($this->t_proyecto_valor_oferta_extension_detalle, $this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_id = '.$this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', 'LEFT');
			$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', $extension_id);
			$proyecto_valor_oferta_extension_result = $this->db->get($this->t_proyecto_valor_oferta);
			if($proyecto_valor_oferta_extension_result->num_rows() > 0){
				return $proyecto_valor_oferta_extension_result->row();
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
				unset($datos['proyecto_valor_oferta_extension_tipo_id']);
				unset($datos['proyecto_valor_oferta_extension_descripcion']);
				$this->db->where('proyecto_valor_oferta_id', $extension_id);
				$this->db->update($this->t_proyecto_valor_oferta, $datos);

				unset($datos2['valor_oferta']);
				$this->db->where('proyecto_valor_oferta_id', $extension_id);
				$this->db->update($this->t_proyecto_valor_oferta_extension_detalle, $datos2);
				return array('tipo' => 'success',
						'texto' => 'Extensión editada con éxito',
						'inserted_id'=> $extension_id);
			}else{
				return array('tipo' => 'danger',
						'texto' => 'No la extensión indicada en la Base de Datos',
						'inserted_id'=> $extension_id);
			}
		}
	}

	function insertarExtension($proyecto_id,$datos){
		if($proyecto_id!=null && $datos!=null){

		
			$datos2 = $datos;			
			$datos['fecha_registro'] = date('Y-m-d H:i:s');			
			$datos['moneda_id'] = 1;
			$datos['proyecto_id'] = $proyecto_id;
			$datos['proyecto_valor_oferta_tipo_id'] = 6;
			$datos['estado_registro'] = 1;
			$datos['valor_oferta'] = str_replace(' ', '',$datos['valor_oferta']);
			unset($datos['proyecto_valor_oferta_extension_tipo_id']);
			unset($datos['proyecto_valor_oferta_extension_descripcion']);
			$this->db->insert($this->t_proyecto_valor_oferta, $datos);
			$proyecto_valor_oferta_id = $this->db->insert_id();

			$datos2['proyecto_valor_oferta_id'] = $proyecto_valor_oferta_id;
			unset($datos2['valor_oferta']);
			$this->db->insert($this->t_proyecto_valor_oferta_extension_detalle, $datos2);
			

			return array('tipo' => 'success',
						'texto' => 'Extensión ingresada con éxito',
						'inserted_id'=> $proyecto_valor_oferta_id);
			

		}
	}

	function eliminarExtension($extension_id){
		if( $extension_id!=null ){
			$this->db->where($this->t_proyecto_valor_oferta_extension_detalle.'.proyecto_valor_oferta_id', $extension_id);
			$this->db->delete($this->t_proyecto_valor_oferta_extension_detalle);		
			
			$this->db->where($this->t_proyecto_valor_oferta.'.proyecto_valor_oferta_id', $extension_id);
			$this->db->delete($this->t_proyecto_valor_oferta);

			return true;
		}else{
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
				$result= $result_extensiones->result();
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
		$this->db->select($this->t_proyecto_gasto.'.*, '.$this->t_proyecto_gasto_monto.'.proyecto_gasto_monto, '.$this->t_proyecto_gasto_monto.'.moneda_id, '.$this->t_proyecto_gasto_detalle.'.proveedor_id, '.$this->t_proyecto_gasto_detalle.'.numero_factura, '.$this->t_proyecto_gasto_estado.'.proyecto_gasto_estado, '.$this->t_proveedor.'.nombre_proveedor, '.$this->t_proyecto_gasto_tipo.'.proyecto_gasto_tipo, '.$this->t_moneda.'.*');

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

		$this->db->order_by($this->t_proyecto_gasto.'.fecha_registro', 'DESC');
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
							'datos' => $result_gastos->result(),
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
			$result_gastos_tipos_result = $result_gastos_tipos->result();
			return $result_gastos_tipos_result;
		}else{
			return false;
		}

	}

	function consultarEstadosGastos(){
		$result_gasto_estado = $this->db->get($this->t_proyecto_gasto_estado);
		$result_gasto_estado_num_rows = $result_gasto_estado->num_rows(); //Previniendo que en futuras versiones de php el retorno de funciones no se pueda evaluar en un if

		if($result_gasto_estado_num_rows>0){
			$result_gasto_estado_result = $result_gasto_estado->result();
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
				return $proyecto_gasto_result->row();
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
			if($datos['proyecto_gasto_tipo_id'] == 1 || $datos['proyecto_gasto_tipo_id'] == 3){
				unset($datos['proveedor_id']); 
				unset($datos['numero_factura']);
				unset($datos['proyecto_gasto_estado_id']);
			}
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
			unset($datos2['proyecto_gasto_estado_id']);
			$this->db->insert($this->t_proyecto_gasto_monto, $datos2);

			//Registra el detalle del gasto
			if($datos['proyecto_gasto_tipo_id'] == 1 || $datos['proyecto_gasto_tipo_id'] == 3){
				$datos3['proyecto_gasto_id'] = $proyecto_gasto_id;
				unset($datos3['proyecto_gasto_tipo_id']);
				unset($datos3['fecha_gasto']);
				unset($datos3['proyecto_gasto_monto']);
				unset($datos3['moneda_id']);
				$this->db->insert($this->t_proyecto_gasto_detalle, $datos3);
			}
			

			return array('tipo' => 'success',
						'texto' => 'Proyecto ingresado con éxito',
						'inserted_id'=> $proyecto_gasto_id);
			

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
				if($datos['proyecto_gasto_tipo_id'] == 1 || $datos['proyecto_gasto_tipo_id'] == 3){
					unset($datos['proveedor_id']); 
					unset($datos['numero_factura']);
					unset($datos['proyecto_gasto_estado_id']);
				}
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
						$this->db->insert($this->t_proyecto_gasto_monto, $datos2);
					}
				}


				//Registra el detalle del gasto
				if($datos['proyecto_gasto_tipo_id'] == 1 || $datos['proyecto_gasto_tipo_id'] == 3){		

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
			$this->db->where($this->t_proyecto_colaborador.'.estado_registro', 1);
			$this->db->where($this->t_colaborador.'.estado', 1);
			$this->db->where($this->t_colaborador.'.estado_row', 1);
			$result_colaboradores = $this->db->get($this->t_proyecto_colaborador);
			$result_colaboradores_count = $result_colaboradores->num_rows();
			if($result_colaboradores_count> 0){
				$result = array(
							'total_rows' => $result_colaboradores_count,
							'datos' => $result_colaboradores->result(),
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
				$result_colaboradores_rows = $result_colaboradores->result();
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
				$result_proyecto_gasto_col_rows = $result_proyecto_gasto_col->result();
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

				$result_gasto_registrado_row = $result_gasto_registrado->row();
				$proyecto_gasto_id = $result_gasto_registrado_row->proyecto_gasto_id;			

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
							'datos' => $result_horas->result(),
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
						$result_fetch = $result_horas->result();
						
					}
					if($data['filtros']['group_by'] == 'colaborador'){
						$result_tmp = $result_horas->result();
						$result_colaboradores = array();
						foreach ($result_tmp as $key => $value) {
							$result_colaboradores[$value->colaborador_id]['nombre'] = $value->nombre.' '.$value->apellidos;
							$result_colaboradores[$value->colaborador_id]['total_horas'] = (isset($result_colaboradores[$value->colaborador_id]['total_horas'])) ? $result_colaboradores[$value->colaborador_id]['total_horas'] + $value->cantidad_horas : $value->cantidad_horas;
							$result_colaboradores[$value->colaborador_id]['total_horas_extra'] = (isset($result_colaboradores[$value->colaborador_id]['total_horas_extra'])) ? $result_colaboradores[$value->colaborador_id]['total_horas_extra'] + $value->cantidad_horas_extra : $value->cantidad_horas_extra;
							$costo_row = (($value->cantidad_horas * $value->costo_hora_mano_obra) + ($value->cantidad_horas_extra * ($value->costo_hora_mano_obra * 1.5)));
							$result_colaboradores[$value->colaborador_id]['total_costo'] = (isset($result_colaboradores[$value->colaborador_id]['total_costo'])) ? $result_colaboradores[$value->colaborador_id]['total_costo'] + $costo_row : $costo_row;
						}

						foreach ($result_colaboradores as $kcola => $vcola) {
							$result_fetch[] = (object)$vcola;
						}
					}

					if($data['filtros']['group_by'] == 'none'){
						$result_fetch = $result_horas->result();
						
					}
				}else{
					$result_fetch = $result_horas->result();
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
			$proyectos_result = $result_proyecto->result();
			//exit(var_export($proyectos_result));
			foreach($proyectos_result as $kproyecto => $vproyecto){
				$proyecto = $vproyecto;
				$proyecto_id = $vproyecto->proyecto_id;

				//Para valor de la oferta
				$total_valor_oferta = 0;
				$valor_oferta_tmp = array();
				$valor_oferta_array = array();
				$this->db->where('proyecto_id', $proyecto_id);
				$this->db->order_by('proyecto_valor_oferta_tipo_id', 'ASC');
				$result_valor_oferta = $this->db->get($this->t_proyecto_valor_oferta);
				$result_valor_oferta_num_rows = $result_valor_oferta->num_rows();
				if($result_valor_oferta_num_rows>0){
					$result_valor_oferta_result = $result_valor_oferta->result();
					foreach ($result_valor_oferta_result as $kvalor => $vvalor) {
						$valor_oferta_tmp[$vvalor->proyecto_valor_oferta_tipo_id][] = $vvalor->valor_oferta;
					}


					$result_valor_oferta_tipo = $this->db->get($this->t_proyecto_valor_oferta_tipo);
					$result_valor_oferta_tipo_num_rows = $result_valor_oferta_tipo->num_rows();
					if($result_valor_oferta_tipo_num_rows>0){
						$result_valor_oferta_tipo_result = $result_valor_oferta_tipo->result();
						foreach ($result_valor_oferta_tipo_result as $kvtipo => $vvtipo) {
							if(isset($valor_oferta_tmp[$vvtipo->proyecto_valor_oferta_tipo_id])){
								$subtotal = 0;
								foreach ($valor_oferta_tmp[$vvtipo->proyecto_valor_oferta_tipo_id] as $kv => $vv) {
									$subtotal+=(double)$vv;
									$total_valor_oferta += (double)$vv;
								}
								$valor_oferta_array[$vvtipo->proyecto_valor_oferta_tipo_id] = array('tipo_id' => $vvtipo->proyecto_valor_oferta_tipo_id,
																									'tipo' => $vvtipo->proyecto_valor_oferta_tipo,
																									'valor' => $subtotal);
							}
						}
						
					}
				}
				$proyectos_result[$kproyecto]->valor_oferta['desgloce'] = $valor_oferta_array;
				$proyectos_result[$kproyecto]->valor_oferta['total'] = $total_valor_oferta;
				if(isset($proyecto->valor_compra) && $proyecto->valor_compra!=null && $proyecto->valor_compra!=''){
					$proyectos_result[$kproyecto]->valor_oferta['total_colones'] = $total_valor_oferta * $proyecto->valor_compra;
				}else{
					$proyectos_result[$kproyecto]->valor_oferta['total_colones'] = $total_valor_oferta * $this->config->item('tipo_cambio_compra');
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
					$result_gastos_result = $result_gastos->result();
					foreach ($result_gastos_result as $kvalor => $vvalor) {
						$monto_gasto = $vvalor->proyecto_gasto_monto;
						if($vvalor->moneda_id==2){
							$proyecto_tipo_cambio_venta = $proyecto->valor_venta;							
							$monto_gasto = $monto_gasto / $proyecto_tipo_cambio_venta;
						}
						$gastos_tmp[$vvalor->proyecto_gasto_tipo_id][] = $monto_gasto;
					}


					$result_gastos_tipo = $this->db->get($this->t_proyecto_gasto_tipo);
					$result_gastos_tipo_num_rows = $result_gastos_tipo->num_rows();
					if($result_gastos_tipo_num_rows >0){
						$result_gastos_tipo_result = $result_gastos_tipo->result();
						foreach ($result_gastos_tipo_result as $kvtipo => $vvtipo) {
							if(isset($gastos_tmp[$vvtipo->proyecto_gasto_tipo_id])){
								$subtotal = 0;
								foreach ($gastos_tmp[$vvtipo->proyecto_gasto_tipo_id] as $kv => $vv) {
									$subtotal+=(double)$vv;
									$total_gastos += (double)$vv;
								}
								$gastos_array[$vvtipo->proyecto_gasto_tipo_id] = array('tipo_id' => $vvtipo->proyecto_gasto_tipo_id,
																						'tipo' => $vvtipo->proyecto_gasto_tipo,
																						'valor' => $subtotal);
							}
						}
						
					}
				}
				$proyectos_result[$kproyecto]->gastos['desgloce'] = $gastos_array;
				$proyectos_result[$kproyecto]->gastos['total'] = $total_gastos;
				if(isset($proyecto->valor_compra) && $proyecto->valor_compra!=null && $proyecto->valor_compra!=''){
					$proyectos_result[$kproyecto]->gastos['total_colones'] = $total_gastos * $proyecto->valor_compra;
				}else{
					$proyectos_result[$kproyecto]->gastos['total_colones'] = $total_gastos * $this->config->item('tipo_cambio_compra');
				}


				$fecha_inicio = strtotime($vproyecto->fecha_inicio);
				$fecha_entrega_estimada = strtotime($vproyecto->fecha_entrega_estimada);
				$fecha_actual = strtotime('now');
				$porcentaje_avance_proyecto = 0;
				$dias_consumidos = 0;
				$dias_proyecto = (((($fecha_entrega_estimada-$fecha_inicio)/60)/60)/24);
				if($fecha_actual > $fecha_inicio){
					$dias_consumidos = (((($fecha_actual-$fecha_inicio)/60)/60)/24);
					$proyectos_result[$kproyecto]->avance_tiempo['dias_consumidos'] = ceil($dias_consumidos);
					if($dias_proyecto!=0){
						$porcentaje_avance_proyecto = ceil((100/$dias_proyecto)*$dias_consumidos);
						$proyectos_result[$kproyecto]->avance_tiempo['dias_proyecto'] = ceil($dias_proyecto);
						$proyectos_result[$kproyecto]->avance_tiempo['porcentaje'] = $porcentaje_avance_proyecto;

					}else{
						$proyectos_result[$kproyecto]->avance_tiempo['dias_consumidos'] = ceil($dias_consumidos);
						$proyectos_result[$kproyecto]->avance_tiempo['dias_proyecto'] = ceil($dias_proyecto);
						$proyectos_result[$kproyecto]->avance_tiempo['porcentaje'] = $porcentaje_avance_proyecto;
					}
				}else{
					$proyectos_result[$kproyecto]->avance_tiempo['dias_consumidos'] = ceil($dias_consumidos);
					$proyectos_result[$kproyecto]->avance_tiempo['dias_proyecto'] = ceil($dias_proyecto);
					$proyectos_result[$kproyecto]->avance_tiempo['porcentaje'] = $porcentaje_avance_proyecto;	
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
						$result_tmp = $result_horas->result();
						$result_fetch = array();
						foreach($result_tmp as $kresult => $vresult){
							$proyecto_gasto_monto = 0;
							if($vresult->moneda_id==2){
								if(isset($vresult->valor_venta) && $vresult->valor_venta!=null && $vresult->valor_venta!=''){
									$proyecto_gasto_monto = $vresult->proyecto_gasto_monto / $vresult->valor_venta;
								}else{
									$proyecto_gasto_monto = $vresult->proyecto_gasto_monto / $this->config->item('tipo_cambio_venta');
								}
							}else{
								$proyecto_gasto_monto = $vresult->proyecto_gasto_monto;
							}
							$result_fetch[$vresult->fecha_gasto]['fecha_gasto'] = $vresult->fecha_gasto;
							$result_fetch[$vresult->fecha_gasto]['proyecto_gasto_monto'] = (isset($result_fetch[$vresult->fecha_gasto]['proyecto_gasto_monto'])) ? $result_fetch[$vresult->fecha_gasto]['proyecto_gasto_monto'] + $proyecto_gasto_monto : $proyecto_gasto_monto;
						}
					}
					if($data['filtros']['group_by'] == 'proveedor'){
						$result_tmp = $result_horas->result();
						$result_fetch = array();
						foreach($result_tmp as $kresult => $vresult){
							$proyecto_gasto_monto = 0;
							if($vresult->moneda_id==2){
								if(isset($vresult->valor_venta) && $vresult->valor_venta!=null && $vresult->valor_venta!=''){
									$proyecto_gasto_monto = $vresult->proyecto_gasto_monto / $vresult->valor_venta;
								}else{
									$proyecto_gasto_monto = $vresult->proyecto_gasto_monto / $this->config->item('tipo_cambio_venta');
								}
							}else{
								$proyecto_gasto_monto = $vresult->proyecto_gasto_monto;
							}
							$result_fetch[$vresult->proveedor_id]['nombre_proveedor'] = $vresult->nombre_proveedor;
							$result_fetch[$vresult->proveedor_id]['proyecto_gasto_monto'] = (isset($result_fetch[$vresult->proveedor_id]['proyecto_gasto_monto'])) ? $result_fetch[$vresult->proveedor_id]['proyecto_gasto_monto'] + $proyecto_gasto_monto : $proyecto_gasto_monto;
						}
					}

					if($data['filtros']['group_by'] == 'none'){
						$result_tmp = $result_horas->result();
						$result_fetch = array();
						foreach($result_tmp as $kresult => $vresult){
							$proyecto_gasto_monto = 0;
							if($vresult->moneda_id==2){
								if(isset($vresult->valor_venta) && $vresult->valor_venta!=null && $vresult->valor_venta!=''){
									$proyecto_gasto_monto = $vresult->proyecto_gasto_monto / $vresult->valor_venta;
								}else{
									$proyecto_gasto_monto = $vresult->proyecto_gasto_monto / $this->config->item('tipo_cambio_venta');
								}
							}else{
								$proyecto_gasto_monto = $vresult->proyecto_gasto_monto;
							}
							$result_fetch[]= array(
											'fecha_gasto' => $vresult->fecha_gasto,
											'nombre_proveedor' => $vresult->nombre_proveedor,
											'proyecto_gasto_monto' => $proyecto_gasto_monto);
						}
						
						
					}
				}else{
					$result_fetch = $result_horas->result();
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
}