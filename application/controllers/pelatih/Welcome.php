<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$this->load->view('pelatih/v_login');
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
			redirect('pelatih','refresh');
		} else {
			$this->load->library('form_validation');
			$config = array(
				array('field' => 'email','label' => "email",'rules' => 'required' ),
				array('field' => 'password','label' => 'Password','rules' => 'required',)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('email', set_value('email') );
				$this->session->set_flashdata('password', set_value('password') );
				$this->session->set_flashdata('error', validation_errors());
				redirect('pelatih','refresh');
			}else{
				$query = $this->DButama->GetDBWhere('tb_pelatih', array('email' => $this->input->post('email'), ));
				if ($query->num_rows() == 0 ) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Email / Password Tidak Ada</strong> 
						</div>');
					redirect('pelatih','refresh');
				}else{
					$hasil = $query->row();
					if (password_verify($this->input->post('password'), $hasil->password)) {
						foreach ($query->result() as $key ) {
							$sess_data['pelatih_logged_in'] = "Sudah_Loggin";
							$sess_data['nama'] = $key->nama;
							$sess_data['email'] = $key->email;
							$sess_data['id'] = $key->id;
							$sess_data['gambar'] = $key->gambar;
							$sess_data['slug'] = $key->slug;
							$this->session->set_userdata($sess_data);
							$this->session->unset_userdata('user_logged_in');
							redirect('pelatih/home', 'refresh');
						}
					}else{
						$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Email / Password Tidak Ada</strong> 
							</div>');
						redirect('pelatih','refresh');
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
		redirect('pelatih','refresh');
	}

}

/* End of file Welcome.php */
/* Location: ./application/controllers/pelatih/Welcome.php */