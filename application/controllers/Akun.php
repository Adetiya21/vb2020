<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	var $table = 'tb_anggota';

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url().'")
			</script>';
		}
	}

	public function index()
	{
		redirect('akun/i/'.$this->session->userdata('id'),'refresh');
	}

	public function i($id)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
		if ($cek->num_rows() == 1) {
			$data['profil'] = $cek->row();
			$data['title']='Data Akun';
			$this->load->view('utama/temp-header',$data);
			$this->load->view('utama/v_akun');
			$this->load->view('utama/temp-footer');
		} else {
			redirect('error404','refresh');
		}
	}

	//proses tambah
	public function proses()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'tmp_lahir','label' => 'Tempat Lahir','rules' => 'required'),
			array('field' => 'tgl_lahir','label' => 'Tanggal Lahir','rules' => 'required'),
			array('field' => 'jenkel','label' => 'Jenis Kelamin','rules' => 'required'),
			array('field' => 'alamat','label' => 'Alamat','rules' => 'required'),
			array('field' => 'prestasi','label' => 'Prestasi Sebelumnya','rules' => 'required'),
			array('field' => 'tinggi','label' => 'Tinggi Badanadan','rules' => 'required'),
			array('field' => 'berat','label' => 'Berat Badan','rules' => 'required'),
			array('field' => 'no_telp','label' => 'No.Telp','rules' => 'required'),
			array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
			array('field' => 'posisi','label' => 'Posisi','rules' => 'required'),
			array('field' => 'motivasi','label' => 'Motivasi Bergabung','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>'.validation_errors().'</strong> 
						</div>');
			redirect('akun/i/'.$this->session->userdata('id'),'refresh');
		} else {
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$where_email = array('email' => $this->input->post('email'));
			$cari_email = $this->DButama->GetDBWhere($this->table,$where_email);
			$pass=$this->input->post('password');
			$hash=password_hash($pass, PASSWORD_DEFAULT);
			$tgl_lahir = $this->input->post('tgl_lahir');
	        $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));
			$slug = url_title($this->input->post('nama'), 'dash', TRUE);			

			// jika email tidak di ganti
			if ($row->email == $this->input->post('email')) {
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
					'slug' => $slug,
					'password' => $hash
				);
				
				if($this->input->post('remove_photo')) // hapus gambar
				{
					if(file_exists('assets/assets/img/anggota/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
						unlink('assets/assets/img/anggota/'.$this->input->post('remove_photo'));
					$data['gambar'] = null;
				}

				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
	        		//hapus gambar lama di folder
					$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
					if(file_exists('assets/assets/img/anggota/'.$row_cek->gambar) && $row_cek->gambar)
						unlink('assets/assets/img/anggota/'.$row_cek->gambar);
					$data['gambar'] = $upload;
				}

				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				$this->DButama->UpdateDB($this->table,$where,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong></div>');
				redirect('akun/i/'.$this->session->userdata('id'),'refresh');

			// jika email di ganti ternyata duplikat
			} else if ($cari_email->num_rows() == 1) {
            	$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Email Sama / Tidak Boleh Duplikat</strong> 
						</div>');
				redirect('akun/i/'.$this->session->userdata('id'),'refresh');
	        
	        // jika email di ganti
			}else{
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
					'slug' => $slug,
					'password' => $hash
				);
				
				if($this->input->post('remove_photo')) // hapus gambar
				{
					if(file_exists('assets/assets/img/anggota/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
						unlink('assets/assets/img/anggota/'.$this->input->post('remove_photo'));
					$data['gambar'] = null;
				}

				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
	        		//hapus gambar lama di folder
					$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
					if(file_exists('assets/assets/img/anggota/'.$row_cek->gambar) && $row_cek->gambar)
						unlink('assets/assets/img/anggota/'.$row_cek->gambar);
					$data['gambar'] = $upload;
				}

				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				$this->DButama->UpdateDB($this->table,$where,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong></div>');
				redirect('akun/i/'.$this->session->userdata('id'),'refresh');
			}
			
		}
	}

	//proses upload gambar
	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/anggota/';
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

/* End of file Akun.php */
/* Location: ./application/controllers/Akun.php */