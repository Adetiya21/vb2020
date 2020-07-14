<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

	public function index()
	{
		$data['title']='Kontak Club';
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_kontak-club');
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Kontak.php */
/* Location: ./application/controllers/Kontak.php */