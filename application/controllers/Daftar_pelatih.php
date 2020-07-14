<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_pelatih extends CI_Controller {

	var $table = 'tb_pelatih';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pelatih','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function index()
	{
		$data['pelatih'] = $this->DButama->GetDB('tb_pelatih');
		$data['title'] = 'Data Pelatih';
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_pelatih',$data);
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Daftar_pelatih.php */
/* Location: ./application/controllers/Daftar_pelatih.php */