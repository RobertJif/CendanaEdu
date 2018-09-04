<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	//BAGIANN KESISWAAN
	//PRESTASI
	public function getPrestasiPerKelas($id_tahunsemester,$id_kelas){
	$this->db->select('*');
	$this->db->from('prestasi');
	$this->db->join('siswa', 'prestasi.nisn = siswa.nisn');
	$this->db->where('prestasi.id_tahunsemester',$id_tahunsemester);
	$this->db->where('prestasi.id_kelas',$id_kelas);
	$query = $this->db->get();
	return $query->result();
	}

	
	public function tambahDataPrestasi($table_name,$data){
	$tambah = $this->db->insert($table_name,$data);
	return $tambah;  
	}

	public function dataEditPrestasi($id_prestasi){
	$this->db->select('*');
	$this->db->from('prestasi');
	$this->db->join('siswa', 'prestasi.nisn = siswa.nisn');
	$this->db->where('prestasi.id_prestasi',$id_prestasi);
	$query = $this->db->get();
	return $query->row();
	}

public function editDataPrestasi($table_name,$data,$id_prestasi){
		$this->db->where('id_prestasi',$id_prestasi);
		$edit = $this->db->update($table_name,$data);
		return $edit;
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

	

	public function getEkskul($table_name){
	$get_ekskul = $this->db->get($table_name);
	return $get_ekskul->result_array();
	}


	public function getDiskusi($table_name){
	$get_diskusi = $this->db->get($table_name);
	return $get_diskusi->result_array();
	}

	public function tambahDataDiskusi($table_name,$data){
		$tambah = $this->db->insert($table_name,$data);
		return $tambah;  
	}

	public function dataEditDiskusi($id_diskusi){
	$this->db->select('*');
	$this->db->from('diskusi');
	$this->db->where('id_diskusi',$id_diskusi);
	$query = $this->db->get();
	return $query->row();
	}

public function editDataDiskusi($table_name,$datadiskusi,$id_diskusi){
		$this->db->where('id_diskusi',$id_diskusi);
		$edit = $this->db->update($table_name,$datadiskusi);
		return $edit;
	}

public function getSemuaPrestasi(){
	$this->db->select('*');
	$this->db->from('prestasi');
	$this->db->join('siswa', 'prestasi.nisn = siswa.nisn');
	$this->db->join('rekaptahunsemester', 'prestasi.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$query = $this->db->get();
	return $query->result();
	}

	public function getSemuaPelanggaran(){
	$this->db->select('*');
	$this->db->from('rekappelanggaran');
	$this->db->join('siswa', 'rekappelanggaran.nisn = siswa.nisn');
	$this->db->join('rekaptahunsemester', 'rekappelanggaran.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$query = $this->db->get();
	return $query->result();
	}


public function getSemuaEkskul(){
	$this->db->select('*');
	$this->db->from('rekapekskul');
	$this->db->join('siswa', 'rekapekskul.nisn = siswa.nisn');
	$this->db->join('ekskul', 'rekapekskul.id_ekskul = ekskul.id_ekskul');
	$this->db->join('rekaptahunsemester', 'rekapekskul.id_tahunsemester = rekaptahunsemester.id_tahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$query = $this->db->get();
	return $query->result();
	}

	public function getPengumumanWeb(){
		$sql = "select * from pengumuman where level = '1'";
		$get = $this->db->query($sql);
		return $get->result();
	}

		public function getPengumumanAndro(){
		$sql = "select * from pengumuman where level = '2'";
		$get = $this->db->query($sql);
		return $get->result();
	}
	
	public function getFcmtoken(){
		$sql = 	"SELECT fcm_token FROM siswa WHERE status = '1' and fcm_token != ''";
		$get = $this->db->query($sql);
		return $get->result();
	}
		public function getNisnbelumkembalibuku($today){
		
		$sql = 	"SELECT * FROM peminjamanbuku p join buku b join siswa s on p.id_buku = b.id_buku AND p.nisn = s.nisn WHERE p.tanggal_kembali = '$today' AND p.tanggal_kembalisiswa IS NULL";
		$get = $this->db->query($sql);
		return $get->result();
	}
	

	

	public function tambahDataEkskul($table_name,$data){
		$tambah = $this->db->insert($table_name,$data);
		return $tambah;  
	}

	public function tambahDataJenisEkskul($table_name,$data){
		$tambah = $this->db->insert($table_name,$data);
		return $tambah;  
	}

	public function tambahDataPengumuman($table_name,$data){
		$tambah = $this->db->insert($table_name,$data);
		return $tambah;  
	}


	public function dataEditEkskul($id_rekapekskul){
	$this->db->select('*');
	$this->db->from('rekapekskul');
	$this->db->join('siswa', 'rekapekskul.nisn = siswa.nisn');
	$this->db->where('rekapekskul.id_rekapekskul',$id_rekapekskul);
	$query = $this->db->get();
	return $query->row();

	}
	public function editDataEkskul($table_name,$data,$id_rekapekskul){
		$this->db->where('id_rekapekskul',$id_rekapekskul);
		$edit = $this->db->update($table_name,$data);
		return $edit;
	}

	public function dataEditJenisEkskul($id_ekskul){
	$this->db->select('*');
	$this->db->from('ekskul');
	$this->db->where('id_ekskul',$id_ekskul);
	$query = $this->db->get();
	return $query->row();

	}
	

	public function dataEditPengumuman($id_pengumuman){
	$this->db->select('*');
	$this->db->from('pengumuman');
	$this->db->where('id_pengumuman',$id_pengumuman);
	$query = $this->db->get();
	return $query->row();

	}

	public function dataEditPengumumanAndro($id_pengumuman){
	$this->db->select('*');
	$this->db->from('pengumuman');
	$this->db->where('id_pengumuman',$id_pengumuman);
	$query = $this->db->get();
	return $query->row();

	}
	

	public function editDataJenisEkskul($table_name,$data,$id_ekskul){
		$this->db->where('id_ekskul',$id_ekskul);
		$edit = $this->db->update($table_name,$data);
		return $edit;
	}

public function editDataPengumuman($table_name,$data,$id_pengumuman){
		$this->db->where('id_pengumuman',$id_pengumuman);
		$edit = $this->db->update($table_name,$data);
		return $edit;
	}

public function editDataPengumumanAndro($table_name,$data,$id_pengumuman){
		$this->db->where('id_pengumuman',$id_pengumuman);
		$edit = $this->db->update($table_name,$data);
		return $edit;
	}

	//REKAPPELANGGARAN



	public function getPelanggaranPerKelas($id_tahunsemester,$id_kelas){	
	$this->db->select('*');
	$this->db->from('rekappelanggaran');
	$this->db->join('siswa', 'rekappelanggaran.nisn = siswa.nisn');
	$this->db->where('rekappelanggaran.id_tahunsemester',$id_tahunsemester);
	$this->db->where('rekappelanggaran.id_kelas',$id_kelas);
	$query = $this->db->get();
	return $query->result();
	}
	
	public function tambahDataRekappelanggaran($table_name,$data){
	$tambah = $this->db->insert($table_name,$data);
	return $tambah;  
	}



	public function dataEditRekappelanggaran($id_rekappelanggaran){
	$this->db->select('*');
	$this->db->from('rekappelanggaran');
	$this->db->join('siswa', 'rekappelanggaran.nisn = siswa.nisn');
	$this->db->where('rekappelanggaran.id_rekappelanggaran',$id_rekappelanggaran);
	$query = $this->db->get();
	return $query->row();
	}

	public function editDataRekappelanggaran($table_name,$datarekappelanggaran,$id_rekappelanggaran){
	$this->db->where('id_rekappelanggaran',$id_rekappelanggaran);
	$edit = $this->db->update($table_name,$datarekappelanggaran);
	return $edit;
	}


	////////BAGIAN KURIKULUM
	//KELAS UNTUK SEMUA

public function tambahDataSiswa($table_name,$datasiswa){
		$siswa = $this->db->insert($table_name,$datasiswa);
		return $siswa;  
	}

		public function dataEditSiswa($nisn){
	$this->db->select('*');
	$this->db->from('siswa');
	$this->db->where('nisn',$nisn);
	$query = $this->db->get();
	return $query->row();
	}

	public function editDataSiswa($table_name,$datasiswa,$nisn){
		$this->db->where('nisn',$nisn);
		$edit = $this->db->update($table_name,$datasiswa);
		return $edit;
	}

//NILAI
	public function getSemuaTahunSemester(){
	$this->db->select('*');
	$this->db->from('rekaptahunsemester');
	$this->db->join('tahunajaran', 'rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran');
	$this->db->join('semester', 'rekaptahunsemester.id_semester = semester.id_semester');
	$this->db->group_by('rekaptahunsemester.id_tahunsemester');
	$query = $this->db->get();
	return $query->result();
	}


	
	public function getKelasPerTahun($id_tahunsemester){		
	$this->db->select('*');
	$this->db->from('rekapkelas');
	$this->db->join('kelas', 'rekapkelas.id_kelas = kelas.id_kelas');
	$this->db->join('jurusan', 'kelas.id_jurusan = jurusan.id_jurusan');
	$this->db->join('kategorikelas', 'kelas.id_kategorikelas = kategorikelas.id_kategorikelas');
	$this->db->where('rekapkelas.id_tahunsemester',$id_tahunsemester);
	$this->db->group_by('rekapkelas.id_kelas');
	$query = $this->db->get();
	return $query->result();
	}

	public function getKategoriKelas($table_name){
	$get_kategorikelas = $this->db->get($table_name);
	return $get_kategorikelas->result_array();
	}
	public function tambahDataKelas($table_name,$datakelas){
		$tambah = $this->db->insert($table_name,$datakelas);
		return $tambah;  
	}
	public function tambahDataMataPelajaran($table_name,$datamatapelajaran){
		$tambah = $this->db->insert($table_name,$datamatapelajaran);
		return $tambah;  
	}
	public function dataEditKelas($id_kelas){
	$this->db->select('*');
	$this->db->from('kelas');
	$this->db->where('id_kelas',$id_kelas);
	$query = $this->db->get();
	return $query->row();
	}

public function editDataKelas($table_name,$data,$id_kelas){
		$this->db->where('id_kelas',$id_kelas);
		$edit = $this->db->update($table_name,$data);
		return $edit;
	}

	public function tambahDataRekapkelas($nisn,$id_kelas,$id_tahunsemester){
    $data = array(
        'nisn' => $nisn,
        'id_kelas' => $id_kelas,
        'id_tahunsemester' => $id_tahunsemester
    );
    $this->db->insert('rekapkelas', $data);}

    public function getRekapkelasPerKelas($id_kelas,$id_tahunsemester){	
	$this->db->select('*');
	$this->db->from('rekapkelas');
	$this->db->join('siswa', 'rekapkelas.nisn = siswa.nisn');
	$this->db->where('rekapkelas.id_kelas',$id_kelas);
	$this->db->where('rekapkelas.id_tahunsemester',$id_tahunsemester);
	$query = $this->db->get();
	return $query->result();
	}



	public function getMataPelajaranPerKelas($id_kelas,$id_jurusan,$id_kategorikelas,$id_semester){
	$this->db->select('*');
	$this->db->from('jurusan');
	$this->db->join('matapelajaran', 'jurusan.id_jurusan = matapelajaran.id_jurusan');
	$this->db->join('kategorikelas', 'matapelajaran.id_kategorikelas = kategorikelas.id_kategorikelas');
	$this->db->join('semester', 'matapelajaran.id_semester = semester.id_semester');
	$this->db->where('jurusan.id_jurusan',$id_jurusan);
	$this->db->where('semester.id_semester',$id_semester);
	$this->db->where('kategorikelas.id_kategorikelas',$id_kategorikelas);
	$query = $this->db->get();
	return $query->result();
	}

  	public function getNilaiPerKelas($id_tahunsemester,$id_kelas,$id_matapelajaran){
		
	$this->db->select('*');
	$this->db->from('nilai');
	$this->db->join('matapelajaran', 'nilai.id_matapelajaran = matapelajaran.id_matapelajaran');
	$this->db->join('siswa', 'nilai.nisn = siswa.nisn');
	$this->db->where('nilai.id_tahunsemester',$id_tahunsemester);
	$this->db->where('nilai.id_kelas',$id_kelas);
	$this->db->where('nilai.id_matapelajaran',$id_matapelajaran);
	$query = $this->db->get();
	return $query->result();
	}

	public function getSiswaPerKelas($id_kelas,$id_tahunsemester){
	$this->db->select('*');
	$this->db->from('siswa');
	$this->db->join('rekapkelas', 'siswa.nisn = rekapkelas.nisn');
	$this->db->where('rekapkelas.id_kelas',$id_kelas);
	$this->db->where('rekapkelas.id_tahunsemester',$id_tahunsemester);
	$query = $this->db->get();
	return $query->result();
	}


public function getSiswaPerNilai($nisnnya,$id_matapelajaran){
	$this->db->select('*');
	$this->db->from('siswa');
	$this->db->join('nilai', 'siswa.nisn = nilai.nisn');
	$this->db->where('nilai.nisn',$nisnnya);
	$this->db->where('nilai.id_matapelajaran',$id_matapelajaran);
	$query = $this->db->get();
	return $query->result();
	}

	public function getSemuaJurusan($table_name){
	$get_jurusan = $this->db->get($table_name);
	return $get_jurusan->result_array();
	}

	public function getSemuaSemester($table_name){
	$get_semester = $this->db->get($table_name);
	return $get_semester->result_array();
	}

	public function getSemuaKelasPerTahun($table_name,$id_tahunajaran){
	$this->db->where('id_tahunajaran',$id_tahunajaran);
	$get_kelas = $this->db->get($table_name);
	return $get_kelas->result_array();
	}

	public function getSemuaKelas($table_name){
	$this->db->select('*');
	$this->db->from('kelas');
	$this->db->join('jurusan','kelas.id_jurusan=jurusan.id_jurusan');
	$this->db->join('kategorikelas','kelas.id_kategorikelas=kategorikelas.id_kategorikelas');
	$query = $this->db->get();
	return $query->result();
	}
	

	public function getSiswa($table_name){
	$get_siswa = $this->db->get($table_name);
	return $get_siswa->result_array();
	}

	public function getSemuaTahunAjaran($table_name){
	$get_tahunajaran = $this->db->get($table_name);
	return $get_tahunajaran->result_array();
	}

	public function getSemuaTahunAjaranDistinct($table_name){
	$this->db->select('*');
	$this->db->from('tahunajaran');
	$this->db->group_by('nama_tahunajaran');
	
	$query = $this->db->get();
	return $query->result();
	}

public function tambahDataTahunAjaran($table_name,$datatahunajaran){
		$tambah = $this->db->insert($table_name,$datatahunajaran);
		return $tambah;  
	}
	public function dataEditTahunAjaran($id_tahunajaran){
	$this->db->select('*');
	$this->db->from('tahunajaran');
	$this->db->where('id_tahunajaran',$id_tahunajaran);
	$query = $this->db->get();
	return $query->row();

	}

	public function editDataTahunAjaran($table_name,$datatahunajaran,$id_tahunajaran){
		$this->db->where('id_tahunajaran',$id_tahunajaran);
		$edit = $this->db->update($table_name,$datatahunajaran);
		return $edit;
	}

public function tambahDataTahunSemester($table_name,$datatahunsemester){
		$tambah = $this->db->insert($table_name,$datatahunsemester);
		return $tambah;  
	}
public function dataEditTahunSemester($id_tahunsemester){
	$this->db->select('*');
	$this->db->from('rekaptahunsemester');
	$this->db->where('id_tahunsemester',$id_tahunsemester);
	$query = $this->db->get();
	return $query->row();

	}

	public function editDataTahunSemester($table_name,$datatahunsemester,$id_tahunsemester){
		$this->db->where('id_tahunsemester',$id_tahunsemester);
		$edit = $this->db->update($table_name,$datatahunsemester);
		return $edit;
	}

	public function getSiswaBelumBerkelas($id_tahunsemester){
	$sql = "select * from siswa s where s.nisn NOT IN (select r.nisn from rekapkelas r where r.id_tahunsemester='$id_tahunsemester') AND s.status = '1'";
		$edit = $this->db->query($sql);
		return $edit->result();
	}


//MataPelajaran
public function getSemuaMataPelajaran($table_name){
	$this->db->select('*');
	$this->db->from('matapelajaran');
	$this->db->join('jurusan','matapelajaran.id_jurusan = jurusan.id_jurusan');
	$this->db->join('semester','matapelajaran.id_semester = semester.id_semester');
	$this->db->join('kategorikelas','matapelajaran.id_kategorikelas=kategorikelas.id_kategorikelas');
	$query = $this->db->get();
	return $query->result();
	}
public function dataEditMataPelajaran($id_matapelajaran){
	$this->db->select('*');
	$this->db->from('matapelajaran');
	$this->db->where('id_matapelajaran',$id_matapelajaran);
	$query = $this->db->get();
	return $query->row();
	}

public function editDataMataPelajaran($table_name,$datamatapelajaran,$id_matapelajaran){
		$this->db->where('id_matapelajaran',$id_matapelajaran);
		$edit = $this->db->update($table_name,$datamatapelajaran);
		return $edit;
	}


	//NILAI
	public function getNilaiPerSiswa($nisn){	
	$this->db->select('*');
	$this->db->from('siswa');
	$this->db->join('nilai', 'siswa.nisn = nilai.nisn');
	$this->db->join('matapelajaran', 'nilai.id_matapelajaran = matapelajaran.id_matapelajaran');
	$this->db->where('siswa.nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}	

	


	//public function getSiswaKelas($id_kelas){
	//$this->db->select('*');
	//$this->db->from('siswa');
	//$this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
	//$this->db->join('matapelajaran',"kelas.id_jurusan = matapelajaran.id_jurusan");
	//$this->db->where('siswa.id_kelas',$id_kelas);
	//$query = $this->db->get();
	//return $query->result();
	//


	public function getMataPelajaran($id_kelas){
	$this->db->select('*');
	$this->db->from('matapelajaran');
	$this->db->join('kelas', 'matapelajaran.id_jurusan = kelas.id_jurusan');
	$this->db->where('kelas.id_kelas',$id_kelas);
	$query = $this->db->get();
	return $query->result();
	}

	public function tambahDataNilai($nilai_harian,$nilai_uts,$nilai_uas,$nilai_akhir,$predikat,$nisnnya,$id_matapelajaran){
		$data = array(
        'nilai_harian'=>$nilai_harian,
        'nilai_uts' => $nilai_uts,
        'nilai_uas' => $nilai_uas,
        'nilai_akhir' => $nilai_akhir,
        'nilai_uas' => $nilai_uas,
        'predikat' => $predikat,
        'nisn' => $nisnnya,
        'id_matapelajaran' => $id_matapelajaran,
        
	);
    $this->db->insert('nilai', $data);
}




	public function dataEditNilai($table_name,$id_nilai){
		$this->db->where('id_nilai',$id_nilai); 
		$get_nilai = $this->db->get($table_name);
		return $get_nilai->row();
	}

public function editDataNilai($table_name,$data,$id_nilai){
		$this->db->where('id_nilai',$id_nilai);
		$edit = $this->db->update($table_name,$data);
		return $edit;
	}

		public function getAbsensiPerKelas($id_tahunsemester,$id_kelas,$id_matapelajaran){
		
	$this->db->select('*');
	$this->db->from('absensi');
	$this->db->join('matapelajaran', 'absensi.id_matapelajaran = matapelajaran.id_matapelajaran');
	$this->db->join('siswa', 'absensi.nisn = siswa.nisn');
	$this->db->where('absensi.id_tahunsemester',$id_tahunsemester);
	$this->db->where('absensi.id_kelas',$id_kelas);
	$this->db->where('absensi.id_matapelajaran',$id_matapelajaran);
	$this->db->group_by('absensi.tanggal_absensi');
	$query = $this->db->get();
	return $query->result();
	}

	public function getSemuaAbsensiPerKelas($id_kelas,$id_tahunsemester){
	$this->db->select('*');
	$this->db->from('absensi');
	$this->db->join('siswa', 'absensi.nisn = siswa.nisn');
	$this->db->join('matapelajaran', 'absensi.id_matapelajaran = matapelajaran.id_matapelajaran');
	$this->db->where('absensi.id_kelas',$id_kelas);
	$this->db->where('abensi.id_tahunsemester',$id_tahunsemester);
	$this->db->group_by('absensi.tanggal_absensi');
	$this->db->group_by('absensi.id_matapelajaran');
	$query = $this->db->get();
	return $query->result();
	}

	public function getSemuaAbsensiPerAbsensi($tanggal_absensi,$id_matapelajaran,$id_kelas,$id_tahunsemester){	
	$this->db->select('*');
	$this->db->from('absensi');
	$this->db->join('siswa', 'absensi.nisn = siswa.nisn');
	$this->db->join('matapelajaran', 'absensi.id_matapelajaran = matapelajaran.id_matapelajaran');
	$this->db->where('tanggal_absensi',$tanggal_absensi);
	$this->db->where('absensi.id_matapelajaran',$id_matapelajaran);
	$this->db->where('absensi.id_tahunsemester',$id_tahunsemester);
	$this->db->where('id_kelas',$id_kelas);
	
	$query = $this->db->get();
	return $query->result();
	}

public function getSemuaKomentarPerDiskusi($id_diskusi){	
	$this->db->select('*');
	$this->db->from('komentardiskusi');
	$this->db->join('diskusi', 'komentardiskusi.id_diskusi = diskusi.id_diskusi');

	$this->db->where('komentardiskusi.id_diskusi',$id_diskusi);
	$query = $this->db->get();
	return $query->result();
	}
public function tambahDataKomentar($table_name,$data){
		$tambah = $this->db->insert($table_name,$data);
		return $tambah;  
	}



	public function tambahDataAbsensi($tanggal_absensi,$jumlahjam_absensi,$answer,$nisnnya,$id_kelas,$id_matapelajaran,$id_tahunsemester){
    $data = array(
        'tanggal_absensi'=>$tanggal_absensi,
        'jumlahjam_absensi' => $jumlahjam_absensi,
        'keterangan_absensi' => $answer,
        'nisn' => $nisnnya,
        'id_kelas' => $id_kelas,
        'id_matapelajaran' => $id_matapelajaran,
    'id_tahunsemester' => $id_tahunsemester
    );
    $this->db->insert('absensi', $data);
}

public function dataEditAbsensi($table_name,$id_absensi){
		$this->db->where('id_absensi',$id_absensi); 
		$get_absensi = $this->db->get($table_name);
		return $get_absensi->row();
	}

public function editDataAbsensi($table_name,$dataabsensi,$id_absensi){
		$this->db->where('id_absensi',$id_absensi);
		$edit = $this->db->update($table_name,$dataabsensi);
		return $edit;
	}


	//BAGIAN SARANA
	public function getSppPerKelas($id_tahunsemester,$id_kelas){
	$this->db->select('*');
	$this->db->from('rekapspp');
	$this->db->join('siswa', 'rekapspp.nisn = siswa.nisn');
	$this->db->where('rekapspp.id_tahunsemester',$id_tahunsemester);
	$this->db->where('rekapspp.id_kelas',$id_kelas);
	$query = $this->db->get();
	return $query->result();
	}

public function getSppPerSiswa($nisn){	
	$this->db->select('*');
	$this->db->from('siswa');
	$this->db->join('rekapspp', 'siswa.nisn = rekapspp.nisn');
	$this->db->where('siswa.nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}	

	public function tambahDataRekapspp($table_name,$data){
	$tambah = $this->db->insert($table_name,$data);
	return $tambah;  
	}



	public function dataEditRekapspp($id_rekapspp){
	$this->db->select('*');
	$this->db->from('rekapspp');
	$this->db->join('siswa', 'rekapspp.nisn = siswa.nisn');
	$this->db->where('rekapspp.id_rekapspp',$id_rekapspp);
	$query = $this->db->get();
	return $query->row();
	}


public function editDataRekapspp($table_name,$data,$id_rekapspp){
		$this->db->where('id_rekapspp',$id_rekapspp);
		$edit = $this->db->update($table_name,$data);
		return $edit;
	}


/////BAGIAN PERPUSTAKAAN
public function getSemuaBuku($table_name){
	$get_buku = $this->db->get($table_name);
	return $get_buku->result();
	}

public function getBukuPerKelas($id_tahunsemester,$id_kelas){
	$this->db->select('*');
	$this->db->from('peminjamanbuku');
	$this->db->join('buku', 'peminjamanbuku.id_buku = buku.id_buku');
	$this->db->join('siswa', 'peminjamanbuku.nisn = siswa.nisn');
	$this->db->where('peminjamanbuku.id_tahunsemester',$id_tahunsemester);
	$this->db->where('peminjamanbuku.id_kelas',$id_kelas);
	$query = $this->db->get();
	return $query->result();
	}

	public function getBukuPerSiswa($nisn){	
	$this->db->select('*');
	$this->db->from('siswa');
	$this->db->join('peminjamanbuku', 'siswa.nisn = peminjamanbuku.nisn');
	$this->db->where('siswa.nisn',$nisn);
	$query = $this->db->get();
	return $query->result();
	}	

	public function tambahDataPeminjamanbuku($table_name,$data){
	$tambah = $this->db->insert($table_name,$data);
	return $tambah;  
	}
	public function editStokJenisBuku($id_buku,$jumlah_buku){
		$sql = "update buku set stok_buku = stok_buku - '$jumlah_buku' where id_buku = '$id_buku'";
		$edit = $this->db->query($sql);

return $edit;
	}

public function editStokKembaliJenisBuku($id_buku,$jumlah_buku){
		$sql = "update buku set stok_buku = stok_buku + '$jumlah_buku' where id_buku = '$id_buku'";
		$edit = $this->db->query($sql);
		return $edit;
	}





	public function dataEditPeminjamanbuku($id_peminjamanbuku){
		$this->db->select('*');
	$this->db->from('peminjamanbuku');
	$this->db->join('siswa', 'peminjamanbuku.nisn = siswa.nisn');
	$this->db->join('buku', 'peminjamanbuku.id_buku = buku.id_buku');
	$this->db->where('peminjamanbuku.id_peminjamanbuku',$id_peminjamanbuku);
	$query = $this->db->get();
	return $query->row();
	}


public function editDataPeminjamanbuku($table_name,$datapeminjamanbuku,$id_peminjamanbuku){
		$this->db->where('id_peminjamanbuku',$id_peminjamanbuku);
		$edit = $this->db->update($table_name,$datapeminjamanbuku);
		return $edit;
	}



public function getBuku(){

	$this->db->select('*');
	$this->db->from('buku');
	$this->db->join('rakbuku', 'buku.id_rakbuku = rakbuku.id_rakbuku');
	$query = $this->db->get();
	return $query->result();
	}

	public function tambahDataJenisBuku($table_name,$data){
		$tambah = $this->db->insert($table_name,$data);
		return $tambah;  
	}


public function dataEditJenisBuku($id_buku){
	$this->db->select('*');
	$this->db->from('buku');
	$this->db->where('id_buku',$id_buku);
	$query = $this->db->get();
	return $query->row();

	}
	public function editDataJenisBuku($table_name,$data,$id_buku){
		$this->db->where('id_buku',$id_buku);
		$edit = $this->db->update($table_name,$data);
		return $edit;
	}

public function getRakBuku($table_name){
	$get_rakbuku = $this->db->get($table_name);
	return $get_rakbuku->result_array();
	}


	public function tambahDataRakBuku($table_name,$data){
		$tambah = $this->db->insert($table_name,$data);
		return $tambah;  
	}


public function dataEditRakBuku($id_rakbuku){
	$this->db->select('*');
	$this->db->from('rakbuku');
	$this->db->where('id_rakbuku',$id_rakbuku);
	$query = $this->db->get();
	return $query->row();

	}
	public function editDataRakBuku($table_name,$datarakbuku,$id_rakbuku){
		$this->db->where('id_rakbuku',$id_rakbuku);
		$edit = $this->db->update($table_name,$datarakbuku);
		return $edit;
	}
}