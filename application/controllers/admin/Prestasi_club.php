<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi_club extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_prestasi';

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
		$this->load->model('m_prestasi','Model');  //load model m_prestasi
	}

	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun halaman prestasi
	public function index()
	{
		$data['title'] = 'Data Prestasi';
		// fun view
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_prestasi',$data);
		$this->load->view('admin/temp-footer');
	}

	// proses tambah
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {			
			$data = array(
				'tim' => $this->input->post('tim'),
				'tgl' => $this->input->post('tgl'),
				'hasil' => $this->input->post('hasil'),
				'keterangan' => $this->input->post('keterangan')
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

	// fun hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);  //filter berdasarkan id
			$this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			$tes = $this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			$query = $this->DButama->DeleteDB($this->table,$where); //fun delete
			echo json_encode(array("status" => TRUE));
			// hapus gambar di folder
			if($tes->gambar!==null){
                unlink("assets/assets/img/prestasi/".$tes->gambar);
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
			$query = $this->DButama->GetDBWhere($this->table,$where);  //load database
			$row = $query->row();
			$data = array(
				'tim' => $this->input->post('tim'),
				'tgl' => $this->input->post('tgl'),
				'hasil' => $this->input->post('hasil'),
				'keterangan' => $this->input->post('keterangan'),
			);
			
			// hapus gambar
			if($this->input->post('remove_photo')) 
			{
				if(file_exists('assets/assets/img/prestasi/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
					unlink('assets/assets/img/prestasi/'.$this->input->post('remove_photo'));
				$data['gambar'] = null;
			}

			// upload gambar
			if(!empty($_FILES['gambar']['name']))
			{
				$upload = $this->_do_upload();
        		//hapus gambar lama di folder
				$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
				if(file_exists('assets/assets/img/prestasi/'.$row_cek->gambar) && $row_cek->gambar)
					unlink('assets/assets/img/prestasi/'.$row_cek->gambar);
				$data['gambar'] = $upload;
			}
			// fun update
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));
			
		}
	}

	//proses upload gambar
	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/prestasi/';  //lokasi folder
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

/* End of file Prestasi_club.php */
/* Location: ./application/controllers/admin/Prestasi_club.php */