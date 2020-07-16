<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_anggota';

	public function __construct()
	{
		parent::__construct();
		// cek session pelatih sudah login
		if ($this->session->userdata('pelatih_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("pelatih/welcome").'")
			</script>';
		}
		$this->load->model('m_anggota','Model');  //load model m_anggota
	}

	// fun json datatables data anggota
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_pelatih();
		}
	}

	// fun json datatables data calon anggota
	public function json_calon() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_pelatih_calon();
		}
	}

	// fun halaman anggota
	public function index()
	{
		$data['title'] = 'Data Anggota';
		// fun view anggota
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_anggota',$data);
		$this->load->view('pelatih/temp-footer');
	}

	// fun halaman calon anggota
	public function calon()
	{
		$data['title'] = 'Daftar Calon Anggota';
		// fun view calon anggota
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_anggota-calon');
		$this->load->view('pelatih/temp-footer');
	}

	// fun edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);  //filter berdasarkan id
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			echo json_encode($data);
		}
	}

	//proses update
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('id' => $this->input->post('id'));  //filter berdasarkan id
			$query = $this->DButama->GetDBWhere($this->table,$where);  //load database table tb_anggota
			$row = $query->row();
			$data = array(
				'status' => $this->input->post('status')
			);
			// fun update
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));
		}
	}

}

/* End of file Anggota.php */
/* Location: ./application/controllers/pelatih/Anggota.php */