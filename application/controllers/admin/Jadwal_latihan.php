<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_latihan extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_jadwal_latihan';
	var $tablepelatih = 'tb_pelatih';

	public function __construct()
	{
		parent::__construct();
		// cek session admin sudah login
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_jadwal_latihan','Model');  //load model m_jadwal_latihan
	}
	
	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun halaman jadwal latihan
	public function index()
	{
		$data['pelatih'] = $this->DButama->GetDB($this->tablepelatih);  //load database table tb_pelatih
		$data['title'] = 'Jadwal Latihan';
		// fun view
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_jadwal-latihan',$data);
		$this->load->view('admin/temp-footer');
	}

	// proses input
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$data = array(
				'id_pelatih' => $this->input->post('id_pelatih'),
				'hari' => $this->input->post('hari'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
			);
			// fun tambah
			$this->DButama->AddDB($this->table,$data);
			echo json_encode(array("status" => TRUE));
		}
	}

	// fun hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);  //filter berdasarkan id
			$this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			$this->DButama->DeleteDB($this->table,$where);  //fun delete
			echo json_encode(array("status" => TRUE));
		}
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

	// proses update
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('id' => $this->input->post('id'));  //filter berdasarkan id
			$query = $this->DButama->GetDBWhere($this->table,$where);  //load database
			$row = $query->row();
			$data = array(
				'id_pelatih' => $this->input->post('id_pelatih'),
				'hari' => $this->input->post('hari'),
				'jam_mulai' => $this->input->post('jam_mulai'),
				'jam_selesai' => $this->input->post('jam_selesai'),
			);
			// fun update
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));			
		}
	}

}

/* End of file Jadwal_latihan.php */
/* Location: ./application/controllers/admin/Jadwal_latihan.php */