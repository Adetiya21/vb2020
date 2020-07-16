<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// fun halaman login
	public function index()
	{
		$this->load->view('pelatih/v_login');
	}

	// proses login
	public function login()
	{
		// recaptcha google
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			// menampilkan pesan error
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Klik Recaptcha</strong> 
				</div>');
			redirect('pelatih','refresh');
		} else {
			//load form validasi
			$this->load->library('form_validation');

			// field form validasi
			$config = array(
				array('field' => 'email','label' => "email",'rules' => 'required' ),
				array('field' => 'password','label' => 'Password','rules' => 'required',)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{
				// menampilkan pesan error
				$this->session->set_flashdata('email', set_value('email') );
				$this->session->set_flashdata('password', set_value('password') );
				$this->session->set_flashdata('error', validation_errors());
				redirect('pelatih','refresh');
			}else{
				// load databases dengan filter email
				$query = $this->DButama->GetDBWhere('tb_pelatih', array('email' => $this->input->post('email'), ));
				if ($query->num_rows() == 0 ) {
					// menampilkan pesan error
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

							// menyimpan data ke session admin
							$this->session->set_userdata($sess_data);
							$this->session->unset_userdata('user_logged_in'); //mengeluarkan session user
							$this->session->unset_userdata('admin_logged_in');  //mengeluarkan session admin
							redirect('pelatih/home', 'refresh');
						}
					}else{
						// menampilkan pesan error
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

	// proses logout
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