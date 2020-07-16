<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_prestasi extends CI_Model {

	// deklarasi var table
	var $table = 'tb_prestasi';

	// load database prestasi
	public function json() {
		$this->datatables->select('id,tgl,gambar,keterangan,hasil,tim');
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id,slug');
		return $this->datatables->generate();
	}

}

/* End of file M_prestasi.php */
/* Location: ./application/models/M_prestasi.php */