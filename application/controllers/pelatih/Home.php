<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $table = 'tb_pelatih';

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('pelatih_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("pelatih/welcome").'")
			</script>';
		}
	}

	public function index()
	{
		$data['anggota'] = $this->DButama->GetDBWhere('tb_anggota', array('status' => 'Anggota'))->num_rows();
		$data['canggota'] = $this->DButama->GetDBWhere('tb_anggota', array('status' => 'Calon Anggota'))->num_rows();
		$data['pelatih'] = $this->DButama->GetDB('tb_pelatih')->num_rows();
		$data['pengurus'] = $this->DButama->GetDB('tb_pengurus')->num_rows();
		$data['jtes'] = $this->DButama->GetDB('tb_jadwal_tes')->num_rows();
		$data['jlat'] = $this->DButama->GetDB('tb_jadwal_latihan')->num_rows();
		$data['prestasi'] = $this->DButama->GetDB('tb_prestasi')->num_rows();
		$data['cang'] = $this->db->order_by('id', 'desc');
		$data['cang'] = $this->db->limit('5');
		$data['cang'] = $this->DButama->GetDBWhere('tb_anggota', array('status' => 'Calon Anggota'));
		$query = $this->db->order_by('tb_jadwal_tes.tgl', 'desc');
		$query = $this->db->limit('5');
		$query = $this->db->select('tb_jadwal_tes.id,tb_jadwal_tes.id_pelatih,tb_jadwal_tes.tgl,CONCAT(tb_jadwal_tes.jam_mulai," s/d ",tb_jadwal_tes.jam_selesai) as jam,tb_pelatih.nama');
	    $query = $this->db->from('tb_jadwal_tes');
	    $query = $this->db->join('tb_pelatih', 'tb_jadwal_tes.id_pelatih = tb_pelatih.id', 'left');
	    $query = $this->db->get();
	    $data['kjtes'] = $query;
		$data['title'] = 'Dashboard';
		$this->load->view('pelatih/temp-header',$data);
		$this->load->view('pelatih/v_index');
		$this->load->view('pelatih/temp-footer');
	}

	public function profil($id)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
		if ($cek->num_rows() == 1) {
			$title = array('title' => 'Profil', );
			$data['profil'] = $cek->row();
			$this->load->view('pelatih/temp-header',$title);
			$this->load->view('pelatih/v_profil',$data);
			$this->load->view('pelatih/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	function edit_profil()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'no_telp','label' => 'No Telp','rules' => 'required',),
			array('field' => 'alamat','label' => 'Alamat','rules' => 'required',),
			array('field' => 'pengalaman','label' => 'Pengalaman','rules' => 'required',),
			array('field' => 'melatih','label' => 'Melatih','rules' => 'required',),
			array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>'.validation_errors().'</strong> 
							</div>');
			redirect('pelatih/home/profil/'.$this->session->userdata('id').'','refresh');
		}else{
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$pass=$this->input->post('password');
				$hash=password_hash($pass, PASSWORD_DEFAULT);
				$data = array(
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'no_telp' => $this->input->post('no_telp'),
					'pengalaman' => $this->input->post('pengalaman'),
					'melatih' => $this->input->post('melatih'),
					'no_telp' => $this->input->post('no_telp'),
					'alamat' => $this->input->post('alamat'),
					'slug' => $slug,
					'password' => $hash
				);
				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}
				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				$this->DButama->UpdateDB($this->table,$where,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong> 
							</div>');
				redirect('pelatih/home/profil/'.$this->session->userdata('id').'','refresh');
		
		}
	}

	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/pelatih/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
        	$this->session->set_flashdata('upload_error', 'Upload error: '.$this->upload->display_errors('',''));
        	// redirect('/home/profil/'.$this->session->userdata('id').'','refresh');
        }
        return $this->upload->data('file_name');
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/pelatih/Home.php */