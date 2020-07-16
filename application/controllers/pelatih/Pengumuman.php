<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_jadwal_tes';
	var $tablepelatih = 'tb_pelatih';

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
		$this->load->model('m_pengumuman','Model');  //load model m_pengumuman
	}

	// fun json datatables pengumuman
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_pelatih();
		}
	}

	// fun json datatables hasil pengumuman
	public function json_hasil($id_jtes) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_hasil($id_jtes);
		}
	}

	// fun halaman pengumuman
	public function index()
	{
		$data['title'] = 'Pengumuman Tes';
		// fun view
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_pengumuman',$data);
		$this->load->view('pelatih/temp-footer');
	}

	// fun halaman hasil pengumuman
	public function hasil($id_jtes)
	{
		$data['id_jtes'] = $id_jtes;
		$data['anggota'] = $this->DButama->GetDB('tb_anggota');  //load database table tb_anggota
		$data['jtes'] = $this->DButama->GetDB('tb_jadwal_tes');  //load database table tb_jadwal_tes
		$data['title'] = 'Hasil Pengumuman Tes';
		// fun view
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_pengumuman-hasil',$data);
		$this->load->view('pelatih/temp-footer');
	}

	// fun tambah
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$data = array(
				'id_jadwal_tes' => $this->input->post('id_jadwal_tes'),
				'id_anggota' => $this->input->post('id_anggota'),
				'keterangan' => $this->input->post('keterangan')
			);
			// fun tambah pengumuman
			$this->DButama->AddDB('tb_pengumuman',$data);

			// mengupdate status anggota
			$ket = $this->input->post('keterangan');
			if ($ket=='Lulus') {
				$where  = array('id' => $this->input->post('id_anggota'));  //filter berdasarkan id_anggota
				$query = $this->DButama->GetDBWhere('tb_anggota',$where);  //load database table tb_anggota
				$row = $query->row();
				$data1 = array(
					'status' => 'Anggota'
				);
				// fun update status anggota
				$this->DButama->UpdateDB('tb_anggota',$where,$data1);
			}
			echo json_encode(array("status" => TRUE));
		}
	}

	//hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);  //filter berdasarkan id
			$this->DButama->GetDBWhere('tb_pengumuman',$where)->row();  //load database
			$this->DButama->DeleteDB('tb_pengumuman',$where);  //fun delete
			echo json_encode(array("status" => TRUE));
		}
	}

}

/* End of file Pengumuman.php */
/* Location: ./application/controllers/pelatih/Pengumuman.php */