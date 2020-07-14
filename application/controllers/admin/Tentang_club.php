<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang_club extends CI_Controller {

	var $table = 'tb_club';

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
		$data['title'] = 'Informasi Tentang Club';
		$cek = $this->DButama->GetDB($this->table);
		$data['tentang'] = $cek->row();
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_tentang-club',$data);
		$this->load->view('admin/temp-footer');
	}

	public function proses()
	{
		$this->load->library('form_validation');
		$config = array(
			array('field' => 'nama','label' => 'Nama Club','rules' => 'required',),
			array('field' => 'arti_logo','label' => 'Arti Logo','rules' => 'required'),
			array('field' => 'sejarah','label' => 'Sejarah','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>'.validation_errors().'</strong> 
							</div>');
			redirect('admin/tentang-club','refresh');
		}else{

			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$data = array(
				'nama' => $this->input->post('nama'),
				'arti_logo' => $this->input->post('arti_logo'),
				'sejarah' => $this->input->post('sejarah')
			);
			$gambar = $_FILES['gambar']['name'];
			if(!empty($gambar))
			{
				$upload = $this->_do_upload();
				$data['gambar'] = $upload;
			}
			$this->DButama->UpdateDB($this->table,$where,$data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Data sudah di perbaharui</strong> 
							</div>');
			redirect('admin/tentang-club','refresh');
		}
	}

	//proses upload gambar
	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/logo/';
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

/* End of file Tentang_club.php */
/* Location: ./application/controllers/admin/Tentang_club.php */