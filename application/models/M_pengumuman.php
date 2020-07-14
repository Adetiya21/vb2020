<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengumuman extends CI_Model {

	var $table = 'tb_jadwal_tes';
	var $tablepelatih = 'tb_pelatih';
	var $tablepengumuman = 'tb_pengumuman';

	public function json() {
		$this->datatables->select('
			tb_jadwal_tes.id,
			tb_jadwal_tes.id_pelatih,
			tb_jadwal_tes.tgl,
			tb_jadwal_tes.status,
			CONCAT(tb_jadwal_tes.jam_mulai," s/d ",tb_jadwal_tes.jam_selesai) as jam,
			tb_pelatih.nama');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_pelatih', 'tb_jadwal_tes.id_pelatih=tb_pelatih.id');		
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="'.site_url("admin/pengumuman/hasil/$1").'"><span class="fa fa-edit"></span> Hasil</a>
			</div>', 'id');
		return $this->datatables->generate();
	}

	public function json_pelatih() {
		$this->datatables->select('
			tb_jadwal_tes.id,
			tb_jadwal_tes.id_pelatih,
			tb_jadwal_tes.tgl,
			tb_jadwal_tes.status,
			CONCAT(tb_jadwal_tes.jam_mulai," s/d ",tb_jadwal_tes.jam_selesai) as jam,
			tb_pelatih.nama');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_pelatih', 'tb_jadwal_tes.id_pelatih=tb_pelatih.id');
		$this->datatables->where('tb_pelatih.id', $this->session->userdata('id'));		
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="'.site_url("pelatih/pengumuman/hasil/$1").'"><span class="fa fa-edit"></span> Hasil</a>
			</div>', 'id');
		return $this->datatables->generate();
	}

	public function json_anggota() {
		$this->datatables->select('
			tb_jadwal_tes.id,
			tb_jadwal_tes.id_pelatih,
			tb_jadwal_tes.tgl,
			tb_jadwal_tes.status,
			CONCAT(tb_jadwal_tes.jam_mulai," s/d ",tb_jadwal_tes.jam_selesai) as jam,
			tb_pelatih.nama');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_pelatih', 'tb_jadwal_tes.id_pelatih=tb_pelatih.id');
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="'.site_url("pengumuman-tes/hasil/$1").'"><span class="fa fa-eye"></span> Lihat Data Hasil Tes</a>
			</div>', 'id');
		return $this->datatables->generate();
	}

	public function json_hasil($id_jtes) {
		$this->datatables->select('
			tb_pengumuman.id, tb_pengumuman.id_jadwal_tes, tb_pengumuman.id_anggota, tb_pengumuman.keterangan,
			tb_jadwal_tes.id as id_jtes,
			tb_jadwal_tes.id_pelatih,
			tb_jadwal_tes.tgl,
			tb_anggota.nama as nama_anggota,
			tb_anggota.posisi, 
			tb_anggota.gambar');
		$this->datatables->from($this->tablepengumuman);
		$this->datatables->join('tb_jadwal_tes', 'tb_pengumuman.id_jadwal_tes=tb_jadwal_tes.id');
		$this->datatables->join('tb_anggota', 'tb_pengumuman.id_anggota=tb_anggota.id');
		$this->datatables->where('tb_pengumuman.id_jadwal_tes', $id_jtes);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

	public function json_hasil_anggota($id_jtes) {
		$this->datatables->select('
			tb_pengumuman.id, tb_pengumuman.id_jadwal_tes, tb_pengumuman.id_anggota, tb_pengumuman.keterangan,
			tb_jadwal_tes.id as id_jtes,
			tb_jadwal_tes.id_pelatih,
			tb_jadwal_tes.tgl,
			tb_anggota.nama as nama_anggota,
			tb_anggota.posisi, 
			tb_anggota.gambar');
		$this->datatables->from($this->tablepengumuman);
		$this->datatables->join('tb_jadwal_tes', 'tb_pengumuman.id_jadwal_tes=tb_jadwal_tes.id');
		$this->datatables->join('tb_anggota', 'tb_pengumuman.id_anggota=tb_anggota.id');
		$this->datatables->where('tb_pengumuman.id_jadwal_tes', $id_jtes);
		return $this->datatables->generate();
	}

}

/* End of file M_pengumuman.php */
/* Location: ./application/models/M_pengumuman.php */