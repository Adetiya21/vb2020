<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_latihan extends CI_Controller {

	var $table = 'tb_jadwal_latihan';
	var $tablepelatih = 'tb_pelatih';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_jadwal_latihan','Model');
	}
	
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function index()
	{
		$data['pelatih'] = $this->DButama->GetDB($this->tablepelatih);
		$data['title'] = 'Jadwal Latihan';
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_jadwal-latihan',$data);
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Jadwal_latihan.php */
/* Location: ./application/controllers/Jadwal_latihan.php */