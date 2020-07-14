<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sejarah extends CI_Controller {

	public function index()
	{
		$data['title']='Sejarah dan Arti Logo Club';
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_sejarah-club');
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Sejarah.php */
/* Location: ./application/controllers/Sejarah.php */