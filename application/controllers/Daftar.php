<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_anggota';

	// fun halaman daftar
	public function index()
	{
		$data['title']='Daftar Anggota Club';
		// fun view
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_daftar');
		$this->load->view('utama/temp-footer');
	}

	//proses tambah
	public function proses()
	{
		//load form validasi
		$this->load->library('form_validation');

		// field form validasi
		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'tmp_lahir','label' => 'Tempat Lahir','rules' => 'required'),
			array('field' => 'tgl_lahir','label' => 'Tanggal Lahir','rules' => 'required'),
			array('field' => 'jenkel','label' => 'Jenis Kelamin','rules' => 'required'),
			array('field' => 'alamat','label' => 'Alamat','rules' => 'required'),
			// array('field' => 'prestasi','label' => 'Prestasi Sebelumnya','rules' => 'required'),
			// array('field' => 'tinggi','label' => 'Tinggi Badanadan','rules' => 'required'),
			// array('field' => 'berat','label' => 'Berat Badan','rules' => 'required'),
			array('field' => 'no_telp','label' => 'No.Telp','rules' => 'required'),
			array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
			array('field' => 'posisi','label' => 'Posisi','rules' => 'required'),
			array('field' => 'motivasi','label' => 'Motivasi Bergabung','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			// menampilkan pesan error
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>'.validation_errors().'</strong> 
						</div>');
			redirect('daftar','refresh');
		}else{
			// cek email yang terdaftar
			$DataUser  = array('email' => $this->input->post('email'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				// menampilkan pesan error
				$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Email Sama / Tidak Boleh Duplikat</strong> 
						</div>');
				redirect('daftar','refresh');
			}else{
				$pass=$this->input->post('password');
				$hash=password_hash($pass, PASSWORD_DEFAULT);  //membuat encrypt password

				$tgl_lahir = $this->input->post('tgl_lahir');
		        $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));  //membuat funsi tanggal sesuai format sql
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);  //membuat data slug berdasarkan nama

				$data = array(
					'nama' => $this->input->post('nama'),
					'tmp_lahir' => $this->input->post('tmp_lahir'),
					'tgl_lahir' => $tgl_lahir,
					'jenkel' => $this->input->post('jenkel'),
					'alamat' => $this->input->post('alamat'),
					'prestasi' => $this->input->post('prestasi'),
					'tinggi' => $this->input->post('tinggi'),
					'berat' => $this->input->post('berat'),
					'no_telp' => $this->input->post('no_telp'),
					'email' => $this->input->post('email'),
					'posisi' => $this->input->post('posisi'),
					'motivasi' => $this->input->post('motivasi'),
					'status' => 'Calon Anggota',
					'slug' => $slug,
					'password' => $hash
				);
				
				// mengupload gambar
				$gambar = $_FILES['gambar']['name'];
				if(!empty($gambar))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}

				// fungsi tambah akun
				$this->DButama->AddDB($this->table,$data);
				echo "<script>alert('Data kamu sudah dikirim, silahkan lakukan login untuk melihat informasi akun');</script>";
				redirect('','refresh');
			}
		}
	}

	//proses upload gambar
	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/anggota/';  //lokasi folder
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
        	$data['inputerror'][] = 'gambar';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

}

/* End of file Daftar.php */
/* Location: ./application/controllers/Daftar.php */