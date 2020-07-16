<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_anggota extends CI_Model {

	// deklarasi var table
	var $table = 'tb_anggota';

	// load database anggota yang diakses oleh admin
	public function json() {
		$this->datatables->select('id,nama,tmp_lahir,tgl_lahir,jenkel,prestasi,tinggi,berat,posisi,email,no_telp,alamat,status,gambar,slug,password');
		$this->datatables->from($this->table);
		$this->datatables->where('status', 'Anggota');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id,slug');
		return $this->datatables->generate();
	}

	// load database calon anggota yang diakses oleh admin
	public function json_calon() {
		$this->datatables->select('id,nama,tmp_lahir,tgl_lahir,jenkel,prestasi,tinggi,berat,posisi,email,no_telp,alamat,status,gambar,slug,password');
		$this->datatables->from($this->table);
		$this->datatables->where('status', 'Calon Anggota');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id,slug');
		return $this->datatables->generate();
	}

	// load database anggota yang diakses oleh pelatih
	public function json_pelatih() {
		$this->datatables->select('id,nama,tmp_lahir,tgl_lahir,jenkel,prestasi,tinggi,berat,posisi,email,no_telp,alamat,status,gambar,slug,password');
		$this->datatables->from($this->table);
		$this->datatables->where('status', 'Anggota');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			</div>', 'id,slug');
		return $this->datatables->generate();
	}

	// load database calon anggota yang diakses oleh pelatih
	public function json_pelatih_calon() {
		$this->datatables->select('id,nama,tmp_lahir,tgl_lahir,jenkel,prestasi,tinggi,berat,posisi,email,no_telp,alamat,status,gambar,slug,password');
		$this->datatables->from($this->table);
		$this->datatables->where('status', 'Calon Anggota');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span></a>
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			</div>', 'id,slug');
		return $this->datatables->generate();
	}

	// load database anggota di frontend
	public function json_pemain() {
		$this->datatables->select('id,nama,tmp_lahir,tgl_lahir,jenkel,prestasi,tinggi,berat,posisi,email,no_telp,alamat,status,gambar,slug,password');
		$this->datatables->from($this->table);
		$this->datatables->where('status', 'Anggota');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-primary btn-rounded btn-sm" href="javascript:void(0)" title="View" onclick="view($1)"> <span class="fa fa-eye"></span> Detail</a>
			</div>', 'id,slug');
		return $this->datatables->generate();
	}
}

/* End of file M_anggota.php */
/* Location: ./application/models/M_anggota.php */