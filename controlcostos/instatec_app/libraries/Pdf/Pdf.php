<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'third_party/tcpdf/tcpdf.php';


class Pdf extends TCPDF
{
	function Header() 
	{
		$image_file = FCPATH.'/instatec_pub/images/logo.jpg';
        $this->Image($image_file, 10, 10, 60, '', 'JPG', '', 'T', true, 300, '', false, false, 0, false, false, false);
		$this->SetFont('times', 'B', 12);
		$this->Cell(0, 10, 'Instalaciones Tecnológicas INSTATEC CR', 0, true, 'R', 0, '', 0, false, 'M', 'M');
		$this->SetFont('times', 'I', 10);
		$this->Cell(0, 10, 'Acabados especializados en construcción', 0, true, 'R', 0, '', 0, false, 'M', 'M');
		$this->SetFont('times', '', 10);
		$this->Cell(0, 10, 'Tel: +506 2101 7071 / Correo: instateccr@gmail.com', 0, true, 'R', 0, '', 0, false, 'M', 'M');
		$this->Cell(0, 10, 'Cédula Jurídica 3-101-327473', 0, true, 'R', 0, '', 0, false, 'M', 'M');
		$this->Cell(0, 10, $this->CustomHeaderText, 0, true, 'R', 0, '', 0, false, 'M', 'M');
		$this->Ln(20);
	}

	function Footer(){
		$this->SetY(-15);
		$this->SetFont('times', 'I', 10);
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}