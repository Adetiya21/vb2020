<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_tes extends CI_Controller {

	var $table = 'tb_jadwal_tes';
	var $tablepelatih = 'tb_pelatih';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url().'")
			</script>';
		}
		$this->load->model('m_pengumuman','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_anggota();
		}
	}

	public function json_hasil($id_jtes) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_hasil_anggota($id_jtes);
		}
	}

	public function index()
	{
		$data['title'] = 'Pengumuman Tes';
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_pengumuman',$data);
		$this->load->view('utama/temp-footer');
	}

	public function hasil($id_jtes)
	{
		$data['id_jtes'] = $id_jtes;
		$data['anggota'] = $this->DButama->GetDB('tb_anggota');
		$data['jtes'] = $this->DButama->GetDB('tb_jadwal_tes');
		$data['title'] = 'Hasil Pengumuman Tes';
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_pengumuman-hasil',$data);
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Pengumuman_tes.php */
/* Location: ./application/controllers/Pengumuman_tes.php */