<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_anggota';

	public function __construct()
	{
		parent::__construct();
		// cek session admin sudah login
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_anggota','Model');  //load model m_anggota
	}

	// fun json datatables data anggota
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun json datatables data calon anggota
	public function json_calon() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_calon();
		}
	}

	// fun halaman anggota
	public function index()
	{
		$data['title'] = 'Data Anggota';
		// fun view anggota
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_anggota',$data);
		$this->load->view('admin/temp-footer');
	}

	// fun halaman calon anggota
	public function calon()
	{
		$data['title'] = 'Daftar Calon Anggota';
		// fun view calon anggota
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_anggota-calon');
		$this->load->view('admin/temp-footer');
	}

	// proses tambah
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			// cek nama yang terdaftar
			$DataUser  = array('nama' => $this->input->post('nama'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				$data = array();
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = 'Nama sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
			}else{
				$pass='12345';  //default password
				$hash=password_hash($pass, PASSWORD_DEFAULT);  //membuat encrypt password
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);  //membuat data slug berdasarkan nama
				$data = array(
					'nama' => $this->input->post('nama'),
					'tmp_lahir' => $this->input->post('tmp_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'jenkel' => $this->input->post('jenkel'),
					'alamat' => $this->input->post('alamat'),
					'email' => $this->input->post('email'),
					'no_telp' => $this->input->post('no_telp'),
					'tinggi' => $this->input->post('tinggi'),
					'berat' => $this->input->post('berat'),
					'posisi' => $this->input->post('posisi'),
					'prestasi' => $this->input->post('prestasi'),
					'motivasi' => $this->input->post('motivasi'),
					'status' => $this->input->post('status'),
					'password' => $hash,
					'slug' => $slug
				);
				// upload gambar
				$gambar = $_FILES['gambar']['name'];
				if(!empty($gambar))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}
				// fun tambah
				$this->DButama->AddDB($this->table,$data);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

	// fun edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);  //filter berdasarkan id
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			echo json_encode($data);
		}
	}

	// proses update
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('id' => $this->input->post('id'));  //filter berdasarkan id
			$query = $this->DButama->GetDBWhere($this->table,$where);  //load database table tb_anggota
			$row = $query->row();

			$where_nama = array('nama' => $this->input->post('nama'));  //filter berdasarkan nama
			$cari_nama = $this->DButama->GetDBWhere($this->table,$where_nama);  //load database table tb_anggota
        	
        	// jika nama tidak di ganti
			if ($row->nama == $this->input->post('nama')) {
				$slug = url_title($this->input->post('nama'), 'dash', TRUE); //membuat data slug berdasarkan nama
				$data = array(
					'nama' => $this->input->post('nama'),
					'tmp_lahir' => $this->input->post('tmp_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'jenkel' => $this->input->post('jenkel'),
					'alamat' => $this->input->post('alamat'),
					'email' => $this->input->post('email'),
					'no_telp' => $this->input->post('no_telp'),
					'tinggi' => $this->input->post('tinggi'),
					'berat' => $this->input->post('berat'),
					'posisi' => $this->input->post('posisi'),
					'prestasi' => $this->input->post('prestasi'),
					'motivasi' => $this->input->post('motivasi'),
					'status' => $this->input->post('status'),
					'slug' => $slug
				);

				// hapus gambar
				if($this->input->post('remove_photo'))
				{
					if(file_exists('assets/assets/img/anggota/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
						unlink('assets/assets/img/anggota/'.$this->input->post('remove_photo'));
					$data['gambar'] = null;
				}

				// mengupload gambar
				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
            		//hapus gambar lama di folder
					$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
					if(file_exists('assets/assets/img/anggota/'.$row_cek->gambar) && $row_cek->gambar)
						unlink('assets/assets/img/anggota/'.$row_cek->gambar);
					$data['gambar'] = $upload;
				}

				// fun update
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
					'nama' => $this->input->post('nama'),
					'tmp_lahir' => $this->input->post('tmp_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'jenkel' => $this->input->post('jenkel'),
					'alamat' => $this->input->post('alamat'),
					'email' => $this->input->post('email'),
					'no_telp' => $this->input->post('no_telp'),
					'tinggi' => $this->input->post('tinggi'),
					'berat' => $this->input->post('berat'),
					'posisi' => $this->input->post('posisi'),
					'prestasi' => $this->input->post('prestasi'),
					'motivasi' => $this->input->post('motivasi'),
					'status' => $this->input->post('status'),
					'slug' => $slug
				);
				
				// hapus gambar
				if($this->input->post('remove_photo'))
				{
					if(file_exists('assets/assets/img/anggota/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
						unlink('assets/assets/img/anggota/'.$this->input->post('remove_photo'));
					$data['gambar'] = null;
				}

				// mengupload gambar
				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
            		//hapus gambar lama di folder
					$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
					if(file_exists('assets/assets/img/anggota/'.$row_cek->gambar) && $row_cek->gambar)
						unlink('assets/assets/img/anggota/'.$row_cek->gambar);
					$data['gambar'] = $upload;
				}
				// fun update
				$this->DButama->UpdateDB($this->table,$where,$data);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

	// fun hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);  //filter berdasarkan id
			$this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			$tes = $this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			$query = $this->DButama->DeleteDB($this->table,$where);  //fun delete
			echo json_encode(array("status" => TRUE));
			// hapus gambar di folder
			if($tes->gambar!==null){
                unlink("assets/assets/img/anggota/".$tes->gambar);
            }
		}
	}

	// proses upload gambar
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

/* End of file Anggota.php */
/* Location: ./application/controllers/admin/Anggota.php */