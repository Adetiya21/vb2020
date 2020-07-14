<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	var $table = 'tb_siswa';

	function __construct()
	{
		parent::__construct(); 
	}

	public function get_tokens($value="") {
		if ($this->session->userdata('vb2020') == "SudahMasukMas") {
			echo $this->security->get_csrf_hash();
		}
	}

	public function index()
	{
		$data['title'] = 'Selamat Datang';
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_index');
		$this->load->view('utama/temp-footer');
	}

	public function login()
	{
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Klik Recaptcha</strong> 
				</div>');
			redirect('welcome','refresh');
		} else {
			if ($this->input->is_ajax_request()) {
				$query = $this->DButama->GetDBWhere('tb_anggota', array('email' => $this->input->post('email'), ));
				if ($query->num_rows() == 0 ) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Email / Password Tidak Ada</strong> 
						</div>');
					redirect('welcome','refresh');
				}else{
					$hasil = $query->row();
					if (password_verify($this->input->post('password'), $hasil->password)) {
						foreach ($query->result() as $key ) {
							$sess_data['user_logged_in'] = "Sudah_Loggin";
							$sess_data['nama'] = $key->nama;
							$sess_data['slug'] = $key->slug;
							$sess_data['email'] = $key->email;
							$sess_data['no_telp'] = $key->no_telp;
							$sess_data['alamat'] = $key->alamat;
							$sess_data['id'] = $key->id;
							$this->session->set_userdata($sess_data);
							$this->session->unset_userdata('admin_logged_in');
							$this->session->unset_userdata('pelatih_logged_in');
							echo json_encode(array("status" => TRUE));
						}
					}
				}
			}
		}
	}

	function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		redirect('welcome','refresh');
	}

}
