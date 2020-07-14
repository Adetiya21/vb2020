<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_tes extends CI_Controller {

	var $table = 'tb_jadwal_tes';
	var $tablepelatih = 'tb_pelatih';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('pelatih_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("pelatih/welcome").'")
			</script>';
		}
		$this->load->model('m_jadwal_tes','Model');
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
		$data['title'] = 'Jadwal Tes';
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_jadwal-tes',$data);
		$this->load->view('pelatih/temp-footer');
	}

	//input
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$data = array(
				'id_pelatih' => $this->session->userdata('id'),
				'tgl' => $this->input->post('tgl'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
				'status' => $this->input->post('status'),
			);
			$this->DButama->AddDB($this->table,$data);
			echo json_encode(array("status" => TRUE));
		}
	}

	//hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$this->DButama->GetDBWhere($this->table,$where)->row();
			$this->DButama->DeleteDB($this->table,$where);
			echo json_encode(array("status" => TRUE));
		}
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
				'id_pelatih' => $this->session->userdata('id'),
				'tgl' => $this->input->post('tgl'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
				'status' => $this->input->post('status'),
			);
			
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));			
		}
	}

}

/* End of file Jadwal_tes.php */
/* Location: ./application/controllers/pelatih/Jadwal_tes.php */