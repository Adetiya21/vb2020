<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_guru extends CI_Model {

	var $table = 'tb_guru';

	public function json() {
		$this->datatables->select('tb_guru.nip,
			tb_guru.id_kelas,
			tb_guru.id_mapel,
			tb_guru.nama,
			tb_guru.jenkel,
			tb_guru.agama,
			tb_guru.alamat,
			tb_guru.no_telp,
			tb_guru.password,
			tb_kelas.id,
			tb_kelas.nama_kelas,
			tb_mapel.id,
			tb_mapel.nama_mapel,
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_kelas', 'tb_guru.id_kelas=tb_kelas.id');
		$this->datatables->join('tb_mapel', 'tb_guru.id_mapel=tb_mapel.id');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'nip');
		return $this->datatables->generate();
	}

	public function json_guru() {
		$this->datatables->select('tb_guru.nip,
			tb_guru.id_kelas,
			tb_guru.id_mapel,
			tb_guru.nama,
			tb_guru.jenkel,
			tb_guru.agama,
			tb_guru.alamat,
			tb_guru.no_telp,
			tb_guru.password,
			tb_kelas.id,
			tb_kelas.nama_kelas,
			tb_mapel.id,
			tb_mapel.nama_mapel,
			');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_kelas', 'tb_guru.id_kelas=tb_kelas.id');
		$this->datatables->join('tb_mapel', 'tb_guru.id_mapel=tb_mapel.id');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			</div>', 'nip');
		return $this->datatables->generate();
	}

}

/* End of file M_guru.php */
/* Location: ./application/models/M_guru.php */