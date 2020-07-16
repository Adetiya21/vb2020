<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function get_tokens($value="") {
		if ($this->session->userdata('vb2020') == "SudahMasukMas") {
			echo $this->security->get_csrf_hash();
		}
	}

	// fun halaman home
	public function index()
	{
		$data['ten'] = $this->DButama->GetDB('tb_club')->row();  //load database tb_club

		// filter berdasarkan tgl terbaru dengan limit yang ditampilkan sebanyak 2 data
		$data['prestasi'] = $this->db->limit('2');
		$data['prestasi'] = $this->db->order_by('tgl', 'desc');
        $data['prestasi'] = $this->DButama->GetDB('tb_prestasi');  //load database tb_prestasi

        $data['pelatih'] = $this->DButama->GetDB('tb_pelatih');  //load database tb_pelatih
        
		$data['title'] = 'Selamat Datang';
		// fun view
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_index',$data);
		$this->load->view('utama/temp-footer');
	}

	// fun login
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
							$this->session->set_userdata($sess_data);  //menyimpan data user ke session
							$this->session->unset_userdata('admin_logged_in');  //mengeluarkan session admin
							$this->session->unset_userdata('pelatih_logged_in');  //mengeluarkan session pelatih
							echo json_encode(array("status" => TRUE));
						}
					}
				}
			}
		}
	}

	// fun logout
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
