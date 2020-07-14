<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	var $table = 'tb_jadwal_tes';
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
		$this->load->model('m_pengumuman','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function json_hasil($id_jtes) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_hasil($id_jtes);
		}
	}

	public function index()
	{
		$data['title'] = 'Pengumuman Tes';
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_pengumuman',$data);
		$this->load->view('admin/temp-footer');
	}

	public function hasil($id_jtes)
	{
		$data['id_jtes'] = $id_jtes;
		$data['anggota'] = $this->DButama->GetDB('tb_anggota');
		$data['jtes'] = $this->DButama->GetDB('tb_jadwal_tes');
		$data['title'] = 'Hasil Pengumuman Tes';
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_pengumuman-hasil',$data);
		$this->load->view('admin/temp-footer');
	}

	//input
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			// manambah data pengumuman
			$data = array(
				'id_jadwal_tes' => $this->input->post('id_jadwal_tes'),
				'id_anggota' => $this->input->post('id_anggota'),
				'keterangan' => $this->input->post('keterangan')
			);
			$this->DButama->AddDB('tb_pengumuman',$data);

			// mengupdate status anggota
			$ket = $this->input->post('keterangan');
			if ($ket=='Lulus') {
				$where  = array('id' => $this->input->post('id_anggota'));
				$query = $this->DButama->GetDBWhere('tb_anggota',$where);
				$row = $query->row();
				$data1 = array(
					'status' => 'Anggota'
				);
				$this->DButama->UpdateDB('tb_anggota',$where,$data1);
			}
			echo json_encode(array("status" => TRUE));
		}
	}

	//hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$this->DButama->GetDBWhere('tb_pengumuman',$where)->row();
			$this->DButama->DeleteDB('tb_pengumuman',$where);
			echo json_encode(array("status" => TRUE));
		}
	}

}

/* End of file Pengumuman.php */
/* Location: ./application/controllers/admin/Pengumuman.php */