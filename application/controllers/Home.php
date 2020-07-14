<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $table = 'tb_siswa';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('siswa_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("welcome").'")
			</script>';
		}
	}
	

	public function index()
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('nis'=> $this->session->userdata('nis')));
		$nilai = $this->session->userdata('nis');
		if ($cek->num_rows() == 1) {
			$data['title'] = 'Dashboard Siswa';
			$data['profil'] = $cek->row();
			// $data['nilai'] = $this->DButama->GetDBWhere('tb_nilaisiswa', array('nis' => $nilai))->row();
			$data['mapel'] = $this->DButama->GetDB('tb_mapel')->num_rows();

			$where = array('tb_nilaisiswa.id_kelas' => $this->session->userdata('id_kelas'));
			$query = $this->db->where($where);
			$where1 = array('tb_nilaisiswa.nis' => $this->session->userdata('nis'));
			$query = $this->db->where($where1);			
			$query = $this->db->select('id, sum(h1) as jh1, sum(h2) as jh2, sum(h3) as jh3, sum(uts) as juts, sum(uas) as juas, sum(total) as jtotal, sum(rata) as jrata');	
			$query = $this->db->from('tb_nilaisiswa');
			$query = $this->db->get();
			$data['nilai'] = $query->row();
			
			$this->load->view('siswa/temp-header',$data);
			$this->load->view('siswa/v_index',$data);
			$this->load->view('siswa/temp-footer');
		}else{
			redirect('error404','refresh');
		}

	}

	public function profil($nis)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('nis'=> $nis));
		if ($cek->num_rows() == 1) {
			$title = array('title' => 'Profil', );
			$data['kelas'] = $this->db->order_by('nama_kelas', 'asc');
			$data['kelas'] = $this->DButama->GetDB('tb_kelas');
			$data['profil'] = $cek->row();
			$this->load->view('siswa/temp-header',$title);
			$this->load->view('siswa/v_profil',$data);
			$this->load->view('siswa/temp-footer');
		}else{
			// redirect('error404','refresh');
		}
	}

	function edit_profil()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'nis','label' => 'nis','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('/home/profil/'.$this->session->userdata('nis').'','refresh');
		}else{
			$where  = array('nis' => $this->input->post('nis'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$tgl_lahir = $this->input->post('tgl_lahir');
	        $tgl_lahir = date('Y-m-d', strtotime($tgl_lahir));        
			$pass=$this->input->post('password');
			$hash=password_hash($pass, PASSWORD_DEFAULT);
			$data = array(

				'nama' => $this->input->post('nama'),
				'id_kelas' => $this->input->post('id_kelas'),
				'tmp_lahir' => $this->input->post('tmp_lahir'),
				'tgl_lahir' => $tgl_lahir,
				'jenkel' => $this->input->post('jenkel'),
				'agama' => $this->input->post('agama'),
				'alamat' => $this->input->post('alamat'),				
				'password' => $hash
			);

			$this->DButama->UpdateDB($this->table,$where,$data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Akun anda sudah diperbaharui</strong> 
						</div>');
			redirect('home/profil/'.$this->session->userdata('nis').'','refresh');
		
		}
	}

	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/ktp/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('foto_ktp')) //upload and validate
        {
        	$this->session->set_flashdata('upload_error', 'Upload error: '.$this->upload->display_errors('',''));
        	// redirect('/home/profil/'.$this->session->userdata('id').'','refresh');
        }
        return $this->upload->data('file_name');
    }
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */