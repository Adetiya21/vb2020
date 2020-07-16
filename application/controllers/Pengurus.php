<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_pengurus';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pengurus','Model');  //load model m_pengurus
	}

	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun halaman pengurus
	public function index()
	{
		// load database pengurus berdasarkan posisi jabatan
		$data['pemilik'] = $this->DButama->GetDBWhere($this->table, array('posisi' => 'Pemilik Club'));
		$data['penasehat'] = $this->DButama->GetDBWhere($this->table, array('posisi' => 'Penasehat'));
		$data['ketua'] = $this->DButama->GetDBWhere($this->table, array('posisi' => 'Ketua'));
		$data['wketua'] = $this->DButama->GetDBWhere($this->table, array('posisi' => 'Wakil Ketua'));
		$data['pk'] = $this->DButama->GetDBWhere($this->table, array('posisi' => 'Pelatih Kepala'));
		$data['bu'] = $this->DButama->GetDBWhere($this->table, array('posisi' => 'Bagian Umum'));
		$data['sekretaris'] = $this->DButama->GetDBWhere($this->table, array('posisi' => 'Sekretaris'));
		$data['tp'] = $this->DButama->GetDBWhere($this->table, array('posisi' => 'Tim Pelatih'));
		$data['bendahara'] = $this->DButama->GetDBWhere($this->table, array('posisi' => 'Bendahara'));

		$data['title']='Struktur Kepengurusan Club';
		// fun view
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_pengurus');
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Pengurus.php */
/* Location: ./application/controllers/Pengurus.php */