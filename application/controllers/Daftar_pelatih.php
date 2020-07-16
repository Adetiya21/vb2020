<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_pelatih extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_pelatih';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pelatih','Model');  //load model m_pelatih
	}

	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun halaman daftar pelatih
	public function index()
	{
		$data['pelatih'] = $this->DButama->GetDB('tb_pelatih');
		$data['title'] = 'Data Pelatih';
		// fun view
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_pelatih',$data);
		$this->load->view('utama/temp-footer');
	}

	// fun detail
	public function detail($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);  //filter berdasarkan id
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			echo json_encode($data);
		}
	}

}

/* End of file Daftar_pelatih.php */
/* Location: ./application/controllers/Daftar_pelatih.php */