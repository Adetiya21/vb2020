<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_latihan extends CI_Controller {

	var $table = 'tb_jadwal_latihan';
	var $tablepelatih = 'tb_pelatih';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
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
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_jadwal-latihan',$data);
		$this->load->view('admin/temp-footer');
	}

	//input
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$data = array(
				'id_pelatih' => $this->input->post('id_pelatih'),
				'hari' => $this->input->post('hari'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
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
				'id_pelatih' => $this->input->post('id_pelatih'),
				'hari' => $this->input->post('hari'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
			);
			
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));			
		}
	}

}

/* End of file Jadwal_latihan.php */
/* Location: ./application/controllers/admin/Jadwal_latihan.php */