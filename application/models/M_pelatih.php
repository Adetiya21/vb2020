<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelatih extends CI_Model {

	var $table = 'tb_pelatih';

	public function json() {
		$this->datatables->select('id,nama,no_telp,email,melatih,pengalaman,alamat,gambar,slug,password');
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

	public function json_pelatih() {
		$this->datatables->select('id,nama,no_telp,email,melatih,pengalaman,alamat,gambar,slug,password');
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_pelatih.php */
/* Location: ./application/models/M_pelatih.php */