<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_club extends CI_Controller {

	var $table = 'tb_kontak';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
	}

	public function index()
	{
		$data['title'] = 'Informasi Kontak Club';
		$cek = $this->DButama->GetDB($this->table);
		$data['kontak'] = $cek->row();
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_kontak-club',$data);
		$this->load->view('admin/temp-footer');
	}

	public function proses()
	{
		$this->load->library('form_validation');
		$config = array(
			array('field' => 'no_telp','label' => 'No Telp','rules' => 'required',),
			array('field' => 'facebook','label' => 'Facebook','rules' => 'required'),
			array('field' => 'instagram','label' => 'Instagram','rules' => 'required'),
			array('field' => 'alamat','label' => 'Alamat','rules' => 'required'),
			array('field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
			array('field' => 'tmp_latihan','label' => 'Tempat Latihan','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>'.validation_errors().'</strong> 
							</div>');
			redirect('admin/kontak-club','refresh');
		}else{

			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$data = array(
				'no_telp' => $this->input->post('no_telp'),
				'facebook' => $this->input->post('facebook'),
				'instagram' => $this->input->post('instagram'),
				'alamat' => $this->input->post('alamat'),
				'email' => $this->input->post('email'),
				'tmp_latihan' => $this->input->post('tmp_latihan')
			);

			$this->DButama->UpdateDB($this->table,$where,$data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Data sudah di perbaharui</strong> 
							</div>');
			redirect('admin/kontak-club','refresh');
		}
	}

}

/* End of file Kontak_club.php */
/* Location: ./application/controllers/admin/Kontak_club.php */