<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatih extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_pelatih';

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
		$this->load->model('m_pelatih','Model');  //load model m_pelatih
	}

	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_pelatih();
		}
	}

	// fun halaman pelatih
	public function index()
	{
		$data['title'] = 'Data Pelatih';
		// fun view
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_pelatih',$data);
		$this->load->view('pelatih/temp-footer');
	}

	// fun view
	public function view($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);  //filter berdasarkan id
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			echo json_encode($data);
		}
	}

}

/* End of file Pelatih.php */
/* Location: ./application/controllers/pelatih/Pelatih.php */