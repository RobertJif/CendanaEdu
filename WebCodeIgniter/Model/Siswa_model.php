<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

	//BAGIANN KESISWAAN
	//PRESTASI
	public function getSiswa($nisn){
	$this->db->select('*');
	$this->db->from('siswa');
	$this->db->where('nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}

	public function getPelanggaran($nisn){
	$this->db->select('*');
	$this->db->from('rekappelanggaran');
	$this->db->join('rekaptahunsemester', 'rekappelanggaran.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->where('nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}

	public function getEkskul($nisn){
	$this->db->select('*');
	$this->db->from('rekapekskul');
	$this->db->join('ekskul', 'rekapekskul.id_ekskul = ekskul.id_ekskul');
	$this->db->join('rekaptahunsemester', 'rekapekskul.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->where('nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}

	public function getPrestasi($nisn){
	$this->db->select('*');
	$this->db->from('prestasi');
	$this->db->join('rekaptahunsemester', 'prestasi.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->where('nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}

	public function getPeminjamanbuku($nisn){
	$this->db->select('*');
	$this->db->from('peminjamanbuku');
	$this->db->join('buku', 'peminjamanbuku.id_buku = buku.id_buku');
	$this->db->join('rekaptahunsemester', 'peminjamanbuku.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->where('nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}

	public function getNilai($nisn){
	$this->db->select('*');
	$this->db->from('nilai');
	$this->db->join('matapelajaran', 'nilai.id_matapelajaran = matapelajaran.id_matapelajaran');
	$this->db->join('rekaptahunsemester', 'nilai.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->where('nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}

	public function getAbsensi($nisn,$id_matapelajaran,$id_tahunsemester){
	$this->db->select('*');
	$this->db->from('absensi');
	$this->db->join('matapelajaran', 'absensi.id_matapelajaran = matapelajaran.id_matapelajaran');
	$this->db->join('rekaptahunsemester', 'absensi.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->where('absensi.nisn',$nisn);
	$this->db->where('absensi.id_matapelajaran',$id_matapelajaran);
	$this->db->where('absensi.id_tahunsemester',$id_tahunsemester);
	$query = $this->db->get();
	return $query->result();
	}

		//EKSKUL
	public function getEkskulPerKelas($id_tahunsemester,$id_kelas){
		
	$this->db->select('*');
	$this->db->from('rekapekskul');
	$this->db->join('siswa', 'rekapekskul.nisn = siswa.nisn');
	$this->db->join('ekskul', 'rekapekskul.id_ekskul = ekskul.id_ekskul');
	$this->db->where('rekapekskul.id_tahunsemester',$id_tahunsemester);
	$this->db->where('rekapekskul.id_kelas',$id_kelas);
	$query = $this->db->get();
	return $query->result();
	}

	public function getNilaiPerTahunSemester($nisn){
	$this->db->select('*');
	$this->db->from('rekaptahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->join('nilai', 'rekaptahunsemester.id_tahunsemester = nilai.id_tahunsemester');
	$this->db->where('nilai.nisn',$nisn);
	$this->db->group_by('rekaptahunsemester.id_tahunsemester');
	$query = $this->db->get();
	return $query->result();
	}

	public function getKelasPerTahun($id_tahunsemester,$nisn){		
	$this->db->select('*');
	$this->db->from('nilai');
	$this->db->join('kelas', 'nilai.id_kelas = kelas.id_kelas');
	$this->db->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
	$this->db->join('kategorikelas', 'kelas.id_kategorikelas = kategorikelas.id_kategorikelas');
	$this->db->join('rekaptahunsemester', 'nilai.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->where('nilai.id_tahunsemester',$id_tahunsemester);
	$this->db->where('nilai.nisn',$nisn);
	$this->db->group_by('nilai.id_kelas');
	$query = $this->db->get();
	return $query->result();
	}

	public function getNilaiPerSemester($id_tahunsemester,$nisn){
		
	$this->db->select('*');
	$this->db->from('nilai');
	$this->db->join('rekaptahunsemester', 'nilai.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('kelas', 'nilai.id_kelas = kelas.id_kelas');
	$this->db->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
	$this->db->join('kategorikelas', 'kelas.id_kategorikelas = kategorikelas.id_kategorikelas');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->join('matapelajaran', 'nilai.id_matapelajaran = matapelajaran.id_matapelajaran');
	$this->db->join('siswa', 'nilai.nisn = siswa.nisn');
	$this->db->where('nilai.id_tahunsemester',$id_tahunsemester);
	$this->db->where('nilai.nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}

public function getAbsenPerTahunSemester($nisn){
	$this->db->select('*');
	$this->db->from('rekaptahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->join('absensi', 'rekaptahunsemester.id_tahunsemester = absensi.id_tahunsemester');
	$this->db->where('absensi.nisn',$nisn);
	$this->db->group_by('rekaptahunsemester.id_tahunsemester');
	$query = $this->db->get();
	return $query->result();
	}

public function getAbsensiPerSemester($id_tahunsemester,$nisn){
		
	$this->db->select('*');
	$this->db->from('absensi');
	$this->db->join('rekaptahunsemester', 'absensi.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('kelas', 'absensi.id_kelas = kelas.id_kelas');
	$this->db->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
	$this->db->join('kategorikelas', 'kelas.id_kategorikelas = kategorikelas.id_kategorikelas');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->join('matapelajaran', 'absensi.id_matapelajaran = matapelajaran.id_matapelajaran');
	$this->db->join('siswa', 'absensi.nisn = siswa.nisn');
	$this->db->where('absensi.id_tahunsemester',$id_tahunsemester);
	$this->db->where('absensi.nisn',$nisn);
	$this->db->group_by('absensi.id_matapelajaran');
	$query = $this->db->get();
	return $query->result();
	}

	
}