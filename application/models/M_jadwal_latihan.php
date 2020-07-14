<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal_latihan extends CI_Model {

	var $table = 'tb_jadwal_latihan';
	var $tablepelatih = 'tb_pelatih';

	public function json() {
		$this->datatables->select('
			tb_jadwal_latihan.id,
			tb_jadwal_latihan.id_pelatih,
			tb_jadwal_latihan.hari,
			CONCAT(tb_jadwal_latihan.jam_mulai," s/d ",tb_jadwal_latihan.jam_selesai) as jam,
			tb_pelatih.nama');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_pelatih', 'tb_jadwal_latihan.id_pelatih=tb_pelatih.id');		
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_jadwal_latihan.php */
/* Location: ./application/models/M_jadwal_latihan.php */