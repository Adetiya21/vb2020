<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatih extends CI_Controller {

	var $table = 'tb_pelatih';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('pelatih_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("pelatih/welcome").'")
			</script>';
		}
		$this->load->model('m_pelatih','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_pelatih();
		}
	}

	public function index()
	{
		$data['title'] = 'Data Pelatih';
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_pelatih',$data);
		$this->load->view('pelatih/temp-footer');
	}

	//view
	public function view($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}

}

/* End of file Pelatih.php */
/* Location: ./application/controllers/pelatih/Pelatih.php */