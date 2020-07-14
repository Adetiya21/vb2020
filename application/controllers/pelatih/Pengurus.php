<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus extends CI_Controller {

	var $table = 'tb_pengurus';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('pelatih_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("pelatih/welcome").'")
			</script>';
		}
		$this->load->model('m_pengurus','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function index()
	{
		$data['title'] = 'Data Pengurus';
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_pengurus',$data);
		$this->load->view('pelatih/temp-footer');
	}

}

/* End of file Pengurus.php */
/* Location: ./application/controllers/pelatih/Pengurus.php */