<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $table = 'tb_admin';

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
			// redirect('admin/welcome');
		}
	}

	public function index()
	{
		$data['anggota'] = $this->DButama->GetDBWhere('tb_anggota', array('status' => 'Anggota'))->num_rows();
		$data['canggota'] = $this->DButama->GetDBWhere('tb_anggota', array('status' => 'Calon Anggota'))->num_rows();
		$data['admin'] = $this->DButama->GetDB('tb_admin')->num_rows();
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
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_index');
		$this->load->view('admin/temp-footer');
	}

	public function profil($id)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
		if ($cek->num_rows() == 1) {
			$data['profil'] = $cek->row();
			$data['title'] = 'Profil';
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_profil',$data);
			$this->load->view('admin/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	function edit_profil()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'username','label' => 'Username','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/home/profil/'.$this->session->userdata('id').'','refresh');
		}else{
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
				$pass=$this->input->post('password');
				$hash=password_hash($pass, PASSWORD_DEFAULT);
				$data = array(
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'password' => $hash
				);
				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				$this->DButama->UpdateDB($this->table,$where,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong> 
							</div>');
				redirect('admin/home/profil/'.$this->session->userdata('id').'','refresh');
		
		}
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/admin/Home.php */