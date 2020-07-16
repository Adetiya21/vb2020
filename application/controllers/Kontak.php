<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	// fun halaman pemain
	public function index()
	{
		$data['title']='Kontak Club';
		$data['kon'] = $this->DButama->GetDB('tb_kontak')->row();  //load database tb_kontak
		// fun view
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_kontak-club');
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Kontak.php */
/* Location: ./application/controllers/Kontak.php */