<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'../vendor/autoload.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
	public function __construct()
	{
		parent::__construct();
	}
	public function load_view($view, $data = [])
	{
		$ci =& get_instance();
		$html = $ci->load->view($view, $data, TRUE);
		$this->loadHtml($html);
		$this->setPaper('A4', 'portrait');
		$this->render();
		$this->stream("laporan.pdf", array("Attachment" => false));
	}
}
