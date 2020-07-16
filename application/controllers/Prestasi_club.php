<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi_club extends CI_Controller {

    // fun halaman prestasi
	public function i($page=0)
    {
        $data['title']='Prestasi Club';
        $query =  $this->db->order_by('tgl', 'desc');
        $query = $this->DButama->GetDB('tb_prestasi');
        $jml = $query;

        $config['base_url'] = base_url('').'prestasi-club/i/';
        $config['total_rows'] = $jml->num_rows();;
        $config['per_page'] = 12;
        $config['uri_segment'] = 3;

        /*Class bootstrap pagination yang digunakan*/
        $config['full_tag_open'] = "<ul class='pagination modal-2' style='position:relative; top:-25px;'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li  class='active'><a style='background:#5adc0a;color:#fff'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);

        $data['halaman']    = $this->pagination->create_links();
        $query = $this->db->order_by('tgl', 'desc');
        $query = $this->db->get('tb_prestasi', $config['per_page'], $page);
        $data['prestasi'] = $query;
        // fun view
        $this->load->view('utama/temp-header',$data);
        $this->load->view('utama/v_prestasi-club',$data);
        $this->load->view('utama/temp-footer');
    }

    // meredirect halaman prestasi ke fun i
	public function index()
	{
		redirect('prestasi-club/i','refresh');
	}

}

/* End of file Prestasi_club.php */
/* Location: ./application/controllers/Prestasi_club.php */