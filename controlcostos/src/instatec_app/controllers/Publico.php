<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';

class Publico extends CI_Controller {




	function __construct(){
		parent::__construct();
		//carga el modelo
		$this->load->model('m_proyecto');
		//carga la validacion del formulario
		$this->load->library('form_validation');

		
	}


	public function comprobacionOrdenCambioCliente(){
        $get_data = $_GET;
        if (isset( $get_data['q'])) {
            $data_encrypted = $get_data['q'];
            
            $data_decrypted = $this->decrypt($data_encrypted);
            $data = explode('|',$data_decrypted);
            if (is_array($data)) {
                if (count($data) == 2) {
                    $proyecto_id = $data[0];
                    $extension_id = $data[1];
                    $proyecto = $this->m_proyecto->consultar($proyecto_id);
                    $proyecto_extension = $this->m_proyecto->consultarExtension($extension_id);
                    $array_filtro_format = array(
                        'filtros' => array(
                            'proyecto_valor_oferta_id' => $extension_id,
                        )
                    );
                    $this->data['proyecto'] = $proyecto['proyecto'];
                    $this->data['proyecto_extension'] = $proyecto_extension;
                    $this->data['title'] = 'Proyectos';
                    $this->load->view('publico/comprobacionOrdenCambioCliente', $this->data);

                } else {
                    redirect('/pagina-no-encontrada', 'refresh');
                }

            } else {
                redirect('/pagina-no-encontrada', 'refresh');
            }
        
        }else{
			redirect('/pagina-no-encontrada', 'refresh');
		}
		
    }

    public function consultaExtensionCambiosAjax(){
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

    public function rechazarOrdenCambio() {
         //Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$result['cambios'] = $this->m_proyecto->rechazarOrdenCambioCliente($post_data);
			$this->enviarNotificacionAdmins($post_data, 2);
			die(json_encode($result));
    	}
    }

    public function aprobarOrdenCambio() {
         //Se usa esta forma para obtener los post de angular. Si se usa jquery se descomenta la otra forma		
		//$post_data = $this->input->post(NULL, TRUE);
		$this->output->set_content_type('application/json');
		$post_data = json_decode(file_get_contents("php://input"), true);
    	if($post_data!=null){
			$result['cambios'] = $this->m_proyecto->aprobarOrdenCambioCliente($post_data);
			$this->enviarNotificacionAdmins($post_data, 1);
			die(json_encode($result));
    	}
	}

	function enviarNotificacionAdmins($post_data, $tipo) {
		$this->load->model('m_general');
		$proyecto_valor_oferta_id = $post_data['proyecto_valor_oferta_id'];
		$proyecto_id = $post_data['proyecto_id'];
		$extension = $this->m_proyecto->consultarExtension($proyecto_valor_oferta_id);
		$proyecto = $this->m_proyecto->consultar($proyecto_id);


		$admins = $this->m_general->consultarCorreosAdmins();
		$correos_admins = array();
		if (!empty($admins)) {
			foreach ($admins as $kadmin => $vadmin) {
				if ($vadmin['usuario']==='keylormg') {
					$correos_admins[] = $vadmin['correo_electronico'];
				}
			}
		}

		if ($proyecto['proyecto']['correo_electronico']!=='') {
			$correos_admins[] = $proyecto['proyecto']['correo_electronico'];
		}
		
		if (!empty($correos_admins)) {
			$body_message = '<p>¡Hola!</p>
			<p>La orden de cambio <strong># '.$proyecto_valor_oferta_id.'</strong> del proyecto <strong>'.$proyecto['proyecto']['nombre_proyecto'].'</strong> ha sido <strong>'.(($tipo==1)?'Aprobada':'Rechazada').'</strong></p>';
			if ($tipo==2) {
				$body_message .= '<p>El motivo del rechazo es el siguiente: </p><br />';
				$body_message .= '<p>'.$post_data['comentarios'].'</p><br />';
				$body_message .= '------------------------------------------------------------';
			}
			
			$body_message .= '<p>Para ver más detalles sobre la orden de cambio, diríjase a la plataforma Centro de Costos de Instatec:  <a href="'.base_url().'" target="_blank">'.base_url().'</a></p>
			<p>¡Muchas gracias!</p>
			<p><strong>Instalaciones Tecnológicas INSTATEC SA</strong></p>';
			$this->load->library('email');
	
			$this->email->from('envios@instateccr.com', 'Instalaciones Tecnológicas INSTATEC CR');
			$this->email->to($correos_admins);
	
			$this->email->subject((($tipo==1)?'Aprobada':'Rechazada').' Orden de Cambio #'.$proyecto_valor_oferta_id.' - Proyecto: '.$proyecto['proyecto']['nombre_proyecto']);
			$this->email->message($body_message);
	
			$this->email->send();
			return true;

		} else {
			return false;
		}
	}


    public function errorPaginaNoEncontrada(){
		$this->data['title'] = 'Pagina no encontrada';
		$this->load->view('publico/paginaNoEncontrada', $this->data);
	}

    private function encrypt($input)
	{
		$iv = $this->config->item('iv_encrypt');
		$pass= $this->config->item('pass_encrypt');
		$method = $this->config->item('method_encrypt');
		$output = base64_encode(openssl_encrypt($input, $method, $pass, 0, $iv));
		$output = str_replace("=", "_", $output);
		$output = str_replace("+", "!", $output);
		return $output;
	}

	private function decrypt($input)
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