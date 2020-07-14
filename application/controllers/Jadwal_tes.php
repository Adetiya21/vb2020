<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_tes extends CI_Controller {

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
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_jadwal-tes',$data);
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Jadwal_tes.php */
/* Location: ./application/controllers/Jadwal_tes.php */