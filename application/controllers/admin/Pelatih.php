<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatih extends CI_Controller {

	var $table = 'tb_pelatih';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_pelatih','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function index()
	{
		$data['title'] = 'Data Pelatih';
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_pelatih',$data);
		$this->load->view('admin/temp-footer');
	}

	//input
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$DataUser  = array('email' => $this->input->post('email'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				$data = array();
				$data['inputerror'][] = 'email';
				$data['error_string'][] = 'Email sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
			}else{
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$pass='12345';
				$hash=password_hash($pass, PASSWORD_DEFAULT);
				$data = array(
					'email' => $this->input->post('email'),
					'nama' => $this->input->post('nama'),
					'no_telp' => $this->input->post('no_telp'),
					'melatih' => $this->input->post('melatih'),
					'pengalaman' => $this->input->post('pengalaman'),
					'alamat' => $this->input->post('alamat'),
					'password' => $hash,
					'slug' => $slug					
				);
				$gambar = $_FILES['gambar']['name'];
				if(!empty($gambar))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}
				$this->DButama->AddDB($this->table,$data);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

	//hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$this->DButama->GetDBWhere($this->table,$where)->row();
			$tes = $this->DButama->GetDBWhere($this->table,$where)->row();
			$query = $this->DButama->DeleteDB($this->table,$where);
			echo json_encode(array("status" => TRUE));
			if($tes->gambar!==null){
                unlink("assets/assets/img/pelatih/".$tes->gambar);
            }
		}
	}

	//edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}

	//proses update
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$where_nama = array('nama' => $this->input->post('nama'));
			$cari_nama = $this->DButama->GetDBWhere($this->table,$where_nama);
        	
        	// jika nama tidak di ganti
			if ($row->nama == $this->input->post('nama')) {
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'email' => $this->input->post('email'),
					'nama' => $this->input->post('nama'),
					'no_telp' => $this->input->post('no_telp'),
					'melatih' => $this->input->post('melatih'),
					'pengalaman' => $this->input->post('pengalaman'),
					'alamat' => $this->input->post('alamat'),
					'slug' => $slug
				);

				if($this->input->post('remove_photo')) // hapus gambar
				{
					if(file_exists('assets/assets/img/pelatih/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
						unlink('assets/assets/img/pelatih/'.$this->input->post('remove_photo'));
					$data['gambar'] = null;
				}

				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
            		//hapus gambar lama di folder
					$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
					if(file_exists('assets/assets/img/pelatih/'.$row_cek->gambar) && $row_cek->gambar)
						unlink('assets/assets/img/pelatih/'.$row_cek->gambar);
					$data['gambar'] = $upload;
				}

				$this->DButama->UpdateDB($this->table,$where,$data);
				echo json_encode(array("status" => TRUE));
	        
	        // jika nama di ganti ternyata duplikat
			} else if ($cari_nama->num_rows() == 1) {
            	$data = array();
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = 'Nama sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
	        
	        // jika nama di ganti
			}else{
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'email' => $this->input->post('email'),
					'nama' => $this->input->post('nama'),
					'no_telp' => $this->input->post('no_telp'),
					'melatih' => $this->input->post('melatih'),
					'pengalaman' => $this->input->post('pengalaman'),
					'alamat' => $this->input->post('alamat'),
					'slug' => $slug
				);
				
				if($this->input->post('remove_photo')) // hapus gambar
				{
					if(file_exists('assets/assets/img/pelatih/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
						unlink('assets/assets/img/pelatih/'.$this->input->post('remove_photo'));
					$data['gambar'] = null;
				}

				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
            		//hapus gambar lama di folder
					$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
					if(file_exists('assets/assets/img/pelatih/'.$row_cek->gambar) && $row_cek->gambar)
						unlink('assets/assets/img/pelatih/'.$row_cek->gambar);
					$data['gambar'] = $upload;
				}
				$this->DButama->UpdateDB($this->table,$where,$data);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

	//proses upload gambar
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
        	$data['inputerror'][] = 'gambar';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }


}

/* End of file Pelatih.php */
/* Location: ./application/controllers/admin/Pelatih.php */