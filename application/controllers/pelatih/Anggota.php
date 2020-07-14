<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	var $table = 'tb_anggota';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('pelatih_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("pelatih/welcome").'")
			</script>';
		}
		$this->load->model('m_anggota','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_pelatih();
		}
	}

	public function json_calon() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_pelatih_calon();
		}
	}

	public function index()
	{
		$data['title'] = 'Data Anggota';
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_anggota',$data);
		$this->load->view('pelatih/temp-footer');
	}

	public function calon()
	{
		$data['title'] = 'Daftar Calon Anggota';
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_anggota-calon');
		$this->load->view('pelatih/temp-footer');
	}

	//edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}

	//proses update
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$data = array(
				'status' => $this->input->post('status')
			);
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));
		}
	}

}

/* End of file Anggota.php */
/* Location: ./application/controllers/pelatih/Anggota.php */