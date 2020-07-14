<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemain extends CI_Controller {

	var $table = 'tb_anggota';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_anggota','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_pemain();
		}
	}

	public function index()
	{
		$data['title'] = 'Data Pemain Club';
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_pemain',$data);
		$this->load->view('utama/temp-footer');
	}

	//view
	public function view($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}

}

/* End of file Pemain.php */
/* Location: ./application/controllers/Pemain.php */