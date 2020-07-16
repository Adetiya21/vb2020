<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sejarah extends CI_Controller {

	// fun halaman sejarah
	public function index()
	{
		$data['ten'] = $this->DButama->GetDB('tb_club')->row();   //load database tb_club
		$data['title']='Sejarah dan Arti Logo Club';
		// fun view
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_sejarah-club',$data);
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Sejarah.php */
/* Location: ./application/controllers/Sejarah.php */