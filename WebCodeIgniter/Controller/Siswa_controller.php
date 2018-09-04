<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_controller extends CI_Controller {


	public function Tampilsiswa_Beranda()
	{

		$this->load->view('Siswa_beranda');
	}

	public function Tampilsiswa_profil(){
		$nisn = $_SESSION['nisn'];
		$data['siswa'] = $this->Siswa_model->getSiswa($nisn);
		$this->load->view('Siswa_profil',$data);
	}
	
	public function Tampilsiswa_pelanggaran(){
		$nisn = $_SESSION['nisn'];
		$data['pelanggaran'] = $this->Siswa_model->getPelanggaran($nisn);
		$this->load->view('Siswa_pelanggaran',$data);
	}
	public function Tampilsiswa_prestasi(){
		$nisn = $_SESSION['nisn'];
		$data['prestasi'] = $this->Siswa_model->getPrestasi($nisn);
		$this->load->view('Siswa_prestasi',$data);
	}

	public function Tampilsiswa_ekskul(){
		$nisn = $_SESSION['nisn'];
		$data['ekskul'] = $this->Siswa_model->getEkskul($nisn);
		$this->load->view('Siswa_ekskul',$data);
	}

	public function Tampilsiswa_peminjamanbuku(){
		$nisn = $_SESSION['nisn'];
		$data['peminjamanbuku'] = $this->Siswa_model->getPeminjamanbuku($nisn);
		$this->load->view('Siswa_peminjamanbuku',$data);
	}

//	public function Tampilsiswa_nilai(){
//		$nisn = $_SESSION['nisn'];
//		$data['nilai'] = $this->Siswa_model->getNilai($nisn);
//		$this->load->view('Siswa_nilai',$data);
//	}

	public function Tampilsiswa_absensi(){
		$nisn = $_SESSION['nisn'];
$data['tahunsemester'] = $this->Siswa_model->getAbsenPerTahunSemester($nisn);
		$this->load->view('Siswa_absensi',$data);
	}

	public function Tampilsiswa_nilai(){
		$nisn = $_SESSION['nisn'];

    $data['tahunsemester'] = $this->Siswa_model->getNilaiPerTahunSemester($nisn);
    $this->load->view('Siswa_nilai',$data); 
	}


	public function TampilKelas(){
		$nisn = $_SESSION['nisn'];
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$result_explode = explode('|', $id_tahunsemester);
    $id_tahunsemester = $result_explode[0];
    $id_semester = $result_explode[1];
    $_SESSION['id_semester'] = $id_semester;
    $_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$kelas = $this->Siswa_model->getKelasPerTahun($id_tahunsemester,$nisn);
	if(count($kelas)>0){
		$kelas_pilihan = "";
		$kelas_pilihan .= '<option value="">Pilih Kelas</option>';
		foreach ($kelas as $row){
			$kelas_pilihan .= '<option value="'.$row->id_kelas.'|'.$row->id_jurusan.'|'.$row->id_kategorikelas.'">'.$row->nama_kategorikelas.' '.$row->nama_jurusan.' '.$row->nama_kelas.'</option>';}
		echo json_encode($kelas_pilihan);}
	}

public function Tampilsiswa_nilai_nilaipersemester(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$result_explode = explode('|', $id_tahunsemester);
    $id_tahunsemester = $result_explode[0];
    $id_semester = $result_explode[1];
	//$id_kelas = $this->input->post('kelas');
	//$result_explode = explode('|', $id_kelas);
    //$id_kelas = $result_explode[0];
    //$id_jurusan = $result_explode[1];
   // $id_kategorikelas = $result_explode[2];
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_semester'] = $id_semester;
	//$_SESSION['id_kelas'] = $id_kelas;
	//$_SESSION['id_jurusan'] = $id_jurusan;
	//$_SESSION['id_kategorikelas'] = $id_kategorikelas;
	$nisn = $_SESSION['nisn'];
	$this->data['nilai'] = $this->Siswa_model->getNilaiPerSemester($id_tahunsemester,$nisn);
	$this->load->view('Siswa_nilai_nilaipersemester',$this->data);
	}

public function Tampilsiswa_absensi_absensipersemester(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$result_explode = explode('|', $id_tahunsemester);
    $id_tahunsemester = $result_explode[0];
    $id_semester = $result_explode[1];
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_semester'] = $id_semester;
	$nisn = $_SESSION['nisn'];
	$this->data['absensi'] = $this->Siswa_model->getAbsensiPerSemester($id_tahunsemester,$nisn);
	$this->load->view('Siswa_absensi_absensipersemester',$this->data);
	}

	public function Tampilsiswa_absensi_absensipersemesterkembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$nisn = $_SESSION['nisn'];
	$this->data['absensi'] = $this->Siswa_model->getAbsensiPerSemester($id_tahunsemester,$nisn);
	$this->load->view('Siswa_absensi_absensipersemester',$this->data);
	}


public function Tampilsiswa_absensi_absensipermatpel(){
$id_matapelajaran = $this->input->get('id_matapelajaran');
	$id_tahunsemester = $_SESSION['id_tahunsemester'];
	$nisn = $_SESSION['nisn'];
$data['absensi'] = $this->Siswa_model->getAbsensi($nisn,$id_matapelajaran,$id_tahunsemester);
	$this->load->view('Siswa_absensi_absensipermatpel',$data);


}


	}