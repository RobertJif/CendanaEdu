<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

	//UNTUK SEMUA
	public function TampilKelasSaja(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
    $_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$kelas = $this->Admin_model->getKelasPerTahun($id_tahunsemester);
	if(count($kelas)>0){
		$kelas_pilihan = "";
		$kelas_pilihan .= '<option value="">Pilih Kelas</option>';
		foreach ($kelas as $row){
			$kelas_pilihan .= '<option value="'.$row->id_kelas.'">'.$row->nama_kategorikelas.' '.$row->nama_jurusan.' '.$row->nama_kelas.'</option>';}
		echo json_encode($kelas_pilihan);}
	}

	public function TampilKelas(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$result_explode = explode('|', $id_tahunsemester);
    $id_tahunsemester = $result_explode[0];
    $id_semester = $result_explode[1];
    $_SESSION['id_semester'] = $id_semester;
    $_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$kelas = $this->Admin_model->getKelasPerTahun($id_tahunsemester);
	if(count($kelas)>0){
		$kelas_pilihan = "";
		$kelas_pilihan .= '<option value="">Pilih Kelas</option>';
		foreach ($kelas as $row){
			$kelas_pilihan .= '<option value="'.$row->id_kelas.'|'.$row->id_jurusan.'|'.$row->id_kategorikelas.'">'.$row->nama_kategorikelas.' '.$row->nama_jurusan.' '.$row->nama_kelas.'</option>';}
		echo json_encode($kelas_pilihan);}
	}


	public function TampilMataPelajaran(){
	$id_kelas = $this->input->post('id_kelas');
	$result_explode = explode('|', $id_kelas);
    $id_kelas = $result_explode[0];
    $id_jurusan = $result_explode[1];
    $id_kategorikelas = $result_explode[2];
    $id_semester = $_SESSION['id_semester'];
    $_SESSION['id_kelas'] = $id_kelas; 
    $_SESSION['id_jurusan'] = $id_jurusan ;
    $_SESSION['id_kategorikelas'] = $id_kategorikelas;
	$matapelajaran = $this->Admin_model->getMataPelajaranPerKelas($id_kelas,$id_jurusan,$id_kategorikelas,$id_semester);
	if(count($matapelajaran)>0){
		$matapelajaran_pilihan = '';
		$matapelajaran_pilihan .= '<option value="">Pilih Mata Pelajaran</option>';
		foreach ($matapelajaran as $row){
			$matapelajaran_pilihan .= '<option value="'.$row->id_matapelajaran.'">'.$row->nama_matapelajaran.'</option>';}
		echo json_encode($matapelajaran_pilihan);}
	}


	//BAGIAN KESISWAAN
	public function Tampilkes_beranda(){
		$this->load->view('Kes_beranda');
	}

	public function Coba(){
		$this->load->view('coba');
	}
	

	//PRESTASI
	
	public function Tampilkes_prestasi(){
    $data['tahunsemester'] = $this->Admin_model->getSemuaTahunSemester();
    $data['allprestasi'] = $this->Admin_model->getSemuaPrestasi();
    $this->load->view('Kes_prestasi',$data); 
	}

	public function Tampilkes_prestasi_prestasiperkelas(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$id_kelas = $this->input->post('kelas');
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_kelas'] = $id_kelas;
	$this->data['prestasi'] = $this->Admin_model->getPrestasiPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Kes_prestasi_prestasiperkelas',$this->data);
	}

	public function Tampilkes_prestasi_prestasiperkelaskembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$id_kelas = $this->input->get('id_kelas');
	$this->data['prestasi'] = $this->Admin_model->getPrestasiPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Kes_prestasi_prestasiperkelas',$this->data);
	}

	public function Tampilkes_prestasi_formtambahprestasi(){
	$id_tahunsemester = $_SESSION['id_tahunsemester'];
	$id_kelas = $_SESSION['id_kelas'];
	$result['siswaperkelas']=$this->Admin_model->getSiswaPerKelas($id_kelas,$id_tahunsemester);
	$this->load->view('Kes_prestasi_formtambahprestasi',$result);
	}

	public function Kes_prestasi_tambahprestasi(){
		$nama_prestasi = $_POST['nama_prestasi'];
		$nisn = $_POST['nisn'];
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];
		$dataprestasi = array('nama_prestasi' => $nama_prestasi,'nisn' => $nisn,'id_tahunsemester' => $id_tahunsemester,'id_kelas' => $id_kelas);
		$tambahprestasi = $this->Admin_model->tambahDataPrestasi('prestasi',$dataprestasi);
		if ($tambahprestasi > 0){
			redirect('Admin_controller/Tampilkes_prestasi_prestasiperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';}}

	public function Tampilkes_prestasi_formeditprestasi(){
	$id_prestasi=$this->input->get('id_prestasi');
	$this->data['dataEditPrestasi'] = $this->Admin_model->dataEditPrestasi($id_prestasi);
	$this->load->view('Kes_prestasi_formeditprestasi',$this->data);}

	public function Kes_prestasi_editprestasi(){
		$id_prestasi=$this->input->get('id_prestasi');
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];
		$nama_prestasi = $_POST['nama_prestasi'];
		$dataprestasi = array('nama_prestasi' => $nama_prestasi);
		$editprestasi = $this->Admin_model->editDataPrestasi('prestasi',$dataprestasi,$id_prestasi);
		if ($editprestasi > 0){
			redirect('Admin_controller/Tampilkes_prestasi_prestasiperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';
		}
	}

	//EKSKUL
	public function Tampilkes_ekskul(){
    $data['tahunsemester'] = $this->Admin_model->getSemuaTahunSemester();
     $data['allekskul'] = $this->Admin_model->getSemuaEkskul();
    $this->load->view('Kes_ekskul',$data); }

  
	public function Tampilkes_ekskul_ekskulperkelas(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$id_kelas = $this->input->post('kelas');
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_kelas'] = $id_kelas;
	$this->data['ekskul'] = $this->Admin_model->getEkskulPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Kes_ekskul_ekskulperkelas',$this->data);
	}

	public function Tampilkes_ekskul_ekskulperkelaskembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$id_kelas = $this->input->get('id_kelas');
	$this->data['ekskul'] = $this->Admin_model->getEkskulPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Kes_ekskul_ekskulperkelas',$this->data);
	}

	public function Tampilkes_ekskul_formtambahekskul(){
	$id_kelas = $_SESSION['id_kelas'];
	$id_tahunsemester = $_SESSION['id_tahunsemester'];

	$data['siswaperkelas']=$this->Admin_model->getSiswaPerKelas($id_kelas,$id_tahunsemester);
	$data['ekskul']=$this->Admin_model->getEkskul('ekskul');
	$this->load->view('Kes_ekskul_formtambahekskul',$data);
	}

	public function Tampilkes_ekskul_formtambahekskulcek(){
	$this->load->view('Kes_ekskul_formtambahekskulcek');}

	public function Kes_ekskul_tambahekskul(){
		$nisn = $_SESSION['nisn'];
		$id_ekskul = $_SESSION['id_ekskul'];
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];
		$dataekskul = array('id_ekskul' => $id_ekskul,'nisn' => $nisn,'id_tahunsemester' => $id_tahunsemester,'id_kelas' => $id_kelas);
		$tambahekskul = $this->Admin_model->tambahDataEkskul('rekapekskul',$dataekskul);
		if ($tambahekskul > 0){
			redirect('Admin_controller/Tampilkes_ekskul_ekskulperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';
		}
	}

	public function Tampilkes_ekskul_formeditekskul(){
		$id_rekapekskul=$this->input->get('id_rekapekskul');
		$_SESSION['id_rekapekskul']=$id_rekapekskul;
		$this->data['dataEditEkskul'] = $this->Admin_model->dataEditEkskul($id_rekapekskul);
		$this->load->view('Kes_ekskul_formeditekskul',$this->data);
	}


		public function Tampilkes_ekskul_formeditekskulcek(){
		$this->load->view('Kes_ekskul_formeditekskulcek');}


		public function Kur_ekskul_editekskul(){
		$id_rekapekskul=$this->input->get('id_rekapekskul');
		$id_ekskul=$_SESSION['id_ekskul'];
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];

		$dataekskul = array('id_ekskul' => $id_ekskul);
		$editekskul = $this->Admin_model->editDataEkskul('rekapekskul',$dataekskul,$id_rekapekskul);
		if ($editekskul > 0){
			redirect('Admin_controller/Tampilkes_ekskul_ekskulperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';
		}

	}

	//JENISEKSKUL

	public function Tampilkes_ekskul_jenisekskul(){
    $data['ekskul'] = $this->Admin_model->getEkskul('ekskul');
    $this->load->view('Kes_ekskul_jenisekskul',$data); }

    public function Tampilkes_ekskul_formtambahjenisekskul(){
	$this->load->view('Kes_ekskul_formtambahjenisekskul');}

	public function Kes_ekskul_tambahjenisekskul(){
	$nama_ekskul = $_POST['nama_ekskul'];
	$dataekskul = array('nama_ekskul' => $nama_ekskul);
	$tambahekskul = $this->Admin_model->tambahDataJenisEkskul('ekskul',$dataekskul);
	if ($tambahekskul > 0){
	redirect('Admin_controller/Tampilkes_ekskul_jenisekskul');
	}}

	public function Tampilkes_ekskul_formeditjenisekskul(){
	$id_ekskul=$this->input->get('id_ekskul');
	$_SESSION['id_ekskul']=$id_ekskul;
	$this->data['dataEditJenisEkskul'] = $this->Admin_model->dataEditJenisEkskul($id_ekskul);
	$this->load->view('Kes_ekskul_formeditjenisekskul',$this->data);
	}

	public function Kes_ekskul_editjenisekskul(){
	$id_ekskul=$_SESSION['id_ekskul'];
	$nama_ekskul = $_POST['nama_ekskul'];
	$dataekskul = array('nama_ekskul' => $nama_ekskul);
	$editekskul = $this->Admin_model->editDataJenisEkskul('ekskul',$dataekskul,$id_ekskul);
	if ($editekskul > 0){
	redirect('Admin_controller/Tampilkes_ekskul_jenisekskul');
	} else{
	echo'gagal disimpan';
	}}

	//PENGUMUMAN
	public function Tampilkes_pengumuman(){
    $data['pengumumanweb'] = $this->Admin_model->getPengumumanWeb();
    $this->load->view('Kes_pengumuman',$data); }

	public function Tampilkes_pengumumanandro(){
    $data['pengumumanandro'] = $this->Admin_model->getPengumumanAndro();
    $this->load->view('Kes_pengumumanandro',$data); }

	public function Tampilkes_diskusi(){
    $data['diskusi'] = $this->Admin_model->getDiskusi('diskusi');
    $this->load->view('Kes_diskusi',$data); }

        public function Tampilkes_diskusi_formtambahdiskusi(){
	$this->load->view('Kes_diskusi_formtambahdiskusi');}

	public function Kes_diskusi_tambahdiskusi(){
	$judul_diskusi = $_POST['judul_diskusi'];
	$detail_diskusi = $_POST['detail_diskusi'];
	$tanggal_diskusi = $_POST['tanggal_diskusi'];
	$datadiskusi = array('judul_diskusi' => $judul_diskusi,'detail_diskusi' => $detail_diskusi,'tanggal_diskusi' => $tanggal_diskusi);
	$tambahdiskusi = $this->Admin_model->tambahDataDiskusi('diskusi',$datadiskusi);
	if ($tambahdiskusi > 0){
	redirect('Admin_controller/Tampilkes_diskusi');
	}}


	public function Kes_diskusi_tambahkomentar(){
	$id_diskusi = $_POST['id_diskusi'];	
	$komentar = $_POST['komentar'];	
	$tanggal_komentar = $_POST['tanggal_komentar'];
	$nama = $_POST['nama'];
	$datakomentar = array('komentar' => $komentar,'tanggal_komentar' => $tanggal_komentar,'nama' => $nama,'id_diskusi' => $id_diskusi);
	$tambahkomentar = $this->Admin_model->tambahDataKomentar('komentardiskusi',$datakomentar);
	if ($tambahkomentar > 0){
	redirect('Admin_controller/Tampilkur_diskusi_komentarperdiskusi?id_diskusi='.$id_diskusi);
	}}

		public function Tampilkes_diskusi_formeditdiskusi(){
	$id_diskusi=$this->input->get('id_diskusi');
	$_SESSION['id_diskusi']=$id_diskusi;
	$this->data['dataEditDiskusi'] = $this->Admin_model->dataEditDiskusi($id_diskusi);
	$this->load->view('Kes_diskusi_formeditdiskusi',$this->data);
	}

	public function Kes_diskusi_editdiskusi(){
	$id_diskusi=$_SESSION['id_diskusi'];
	$judul_diskusi = $_POST['judul_diskusi'];
	$detail_diskusi = $_POST['detail_diskusi'];
	$datadiskusi = array('judul_diskusi' => $judul_diskusi,'detail_diskusi' => $detail_diskusi);
	$editdiskusi = $this->Admin_model->editDataDiskusi('diskusi',$datadiskusi,$id_diskusi);
	if ($editdiskusi > 0){
	redirect('Admin_controller/Tampilkes_diskusi');
	} else{
	echo'gagal disimpan';
	}}

	public function Tampilkur_diskusi_komentarperdiskusi(){
	$id_diskusi = $this->input->get('id_diskusi');
	$_SESSION['id_diskusi'] = $id_diskusi;
	$this->data['komentarperdiskusi'] = $this->Admin_model->getSemuaKomentarPerDiskusi($id_diskusi);
	$this->load->view('Kes_diskusi_komentarperdiskusi',$this->data);
}


// public function Tampilkes_pengumuman_formtambahpengumuman(){
//$this->load->view('Kes_pengumuman_formtambahpengumuman');
//}

//	public function Kes_pengumuman_tambahpengumuman(){
//		$nama_pengumuman = $_POST['nama_pengumuman'];
//		$datapengumuman = array('nama_pengumuman' => $nama_pengumuman);
//		$tambahpengumuman = $this->Admin_model->tambahDataPengumuman('pengumuman',$datapengumuman);
//		if ($tambahpengumuman > 0){
//			redirect('Admin_controller/Tampilkes_pengumuman');
//		}
//		}

		public function Tampilkes_pengumuman_formeditpengumuman(){
		$id_pengumuman=$this->input->get('id_pengumuman');
		$_SESSION['id_pengumuman']=$id_pengumuman;
		$this->data['dataEditPengumuman'] = $this->Admin_model->dataEditPengumuman($id_pengumuman);
		$this->load->view('Kes_pengumuman_formeditpengumuman',$this->data);
	}

	public function Kes_pengumuman_editpengumuman(){
		$id_pengumuman=$_SESSION['id_pengumuman'];
	$nama_pengumuman = $_POST['nama_pengumuman'];
		$datapengumuman = array('nama_pengumuman' => $nama_pengumuman);
		$editpengumuman = $this->Admin_model->editDataPengumuman('pengumuman',$datapengumuman,$id_pengumuman);
		if ($editpengumuman > 0){
			redirect('Admin_controller/Tampilkes_pengumuman');
		} else{
			echo'gagal disimpan';
		}

	}


		public function Tampilkes_pengumuman_formeditpengumumanandro(){
		$id_pengumuman=$this->input->get('id_pengumuman');
		$_SESSION['id_pengumuman']=$id_pengumuman;
		$this->data['dataEditPengumumanAndro'] = $this->Admin_model->dataEditPengumumanAndro($id_pengumuman);
		$this->load->view('Kes_pengumuman_formeditpengumumanandro',$this->data);
		
	}
	
	
	public function Kes_pengumuman_editpengumumanandro(){
		$id_pengumuman=$_SESSION['id_pengumuman'];
	$nama_pengumuman = $_POST['nama_pengumuman'];
		$datapengumuman = array('nama_pengumuman' => $nama_pengumuman);
		$editpengumuman = $this->Admin_model->editDataPengumumanandro('pengumuman',$datapengumuman,$id_pengumuman);
		$title = 'PENGUMUMAN';
		$message = $nama_pengumuman;
		
		
		if ($editpengumuman > 0){
		    
		     $this->send_notif_andro($title,$message);
            
            	redirect('Admin_controller/Tampilkes_pengumumanandro');
		} else{
			echo'gagal disimpan';
		}
	}
	
	public function send_notif_andro($title,$message){
	$host = "103.19.208.4:3306";
$db_user = "cendanap_sucy";
$db_password = "iM+_g@X~Ke=u";
$db_name = "cendanap_sia_cendana";

$con = mysqli_connect($host,$db_user,$db_password,$db_name);
if($con){
}else{
	echo "connection error";
}
		$path_to_fcm = 'https://fcm.googleapis.com/fcm/send';
		$server_key ="AAAAtsoi-Dw:APA91bFS_net4twxn_zkWnn28Mlr4orJlYxs68mPfCJ2odRBBwlIuWlcK5d7zFMqeVnFpQV1_3pbG4L65seXM-5cStuaYDVuxlzPVO2TXkjvFJRF6oE9tcp-mXLfOEUpeovl8PcoYkPB";
		$sql = "SELECT fcm_token FROM siswa WHERE status = '1' and fcm_token != ''"; 
		$result = mysqli_query($con,$sql);
		$total = mysqli_num_rows($result);
	    $datatoken = $this->Admin_model->getFcmtoken();
		$i = 0;
		      while($i < $total){ 
		$key = $datatoken[$i]->fcm_token;

		$headers = array(
 			'Authorization:key=' .$server_key,
 	         'Content-Type:application/json');
			
		 $fields = array ('to'=>$key,'notification'=>array('title'=>$title, 'body'=>$message));
	//	print_r($key);
 		$payload = json_encode($fields);
 
	 $curl_session = curl_init();
 	curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
 	curl_setopt($curl_session, CURLOPT_POST, true);
 curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
 curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

 
 $result = curl_exec($curl_session);
 $i++;
		       }
 mysqli_close($con);

	}
	
	

	//PELANGGARAN
	public function Tampilkes_pelanggaran(){
	 $data['tahunsemester'] = $this->Admin_model->getSemuaTahunSemester();
	 $data['allrekappelanggaran'] = $this->Admin_model->getSemuaPelanggaran();
    $this->load->view('Kes_pelanggaran',$data);}

    public function Tampilkes_pelanggaran_pelanggaranperkelas(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$id_kelas = $this->input->post('kelas');
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_kelas'] = $id_kelas;
	$this->data['rekappelanggaran'] = $this->Admin_model->getPelanggaranPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Kes_pelanggaran_pelanggaranperkelas',$this->data);
	}

	public function Tampilkes_pelanggaran_pelanggaranperkelaskembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$id_kelas = $this->input->get('id_kelas');
	$this->data['rekappelanggaran'] = $this->Admin_model->getPelanggaranPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Kes_pelanggaran_pelanggaranperkelas',$this->data);
	}

	public function Tampilkes_pelanggaran_formtambahrekappelanggaran(){
	$id_kelas = $_SESSION['id_kelas'];
	$id_tahunsemester = $_SESSION['id_tahunsemester'];
	$data['siswaperkelas']=$this->Admin_model->getSiswaPerKelas($id_kelas,$id_tahunsemester);
	$this->load->view('Kes_pelanggaran_formtambahrekappelanggaran',$data);
	}

	public function Kes_pelanggaran_tambahrekappelanggaran(){
		$nama_rekappelanggaran = $_POST['nama_rekappelanggaran'];
		$nisn = $_POST['nisn'];
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];
		$tanggal_rekappelanggaran=$_POST['tanggal_rekappelanggaran'];
		$datarekappelanggaran = array('nama_rekappelanggaran' => $nama_rekappelanggaran,'nisn' => $nisn,'id_tahunsemester' => $id_tahunsemester,'id_kelas' => $id_kelas,'tanggal_rekappelanggaran' => $tanggal_rekappelanggaran);
		$tambahrekappelanggaran = $this->Admin_model->tambahDataRekappelanggaran('rekappelanggaran',$datarekappelanggaran);

		//sendnotif
$selectnamasiswa = $this->db->get_where('siswa',array('nisn' => $nisn ))->row();
			$data = array('logged_in' => true,
						  'namasiswa' => $selectnamasiswa->nama_siswa);
			$this->session->set_userdata($data);
		$title = 'Pelanggaran';
		$message = $this->session->userdata('namasiswa') .' telah melakukan pelanggaran berupa : '.$nama_rekappelanggaran;


		if ($tambahrekappelanggaran > 0){
		    $this->send_notif($nisn,$title,$message);
			redirect('Admin_controller/Tampilkes_pelanggaran_pelanggaranperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';
		}
	}
	
	public function send_notif($nisn,$title,$message){
		$host = "103.19.208.4:3306";
$db_user = "cendanap_sucy";
$db_password = "iM+_g@X~Ke=u";
$db_name = "cendanap_sia_cendana";

$con = mysqli_connect($host,$db_user,$db_password,$db_name);
if($con){}else{
	echo "connection error";
}
		$path_to_fcm = 'https://fcm.googleapis.com/fcm/send';
		$server_key ="AAAAtsoi-Dw:APA91bFS_net4twxn_zkWnn28Mlr4orJlYxs68mPfCJ2odRBBwlIuWlcK5d7zFMqeVnFpQV1_3pbG4L65seXM-5cStuaYDVuxlzPVO2TXkjvFJRF6oE9tcp-mXLfOEUpeovl8PcoYkPB";
		$sql = "select fcm_token from siswa where nisn=$nisn";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_row($result);
		$key = $row[0];

		$headers = array(
 			'Authorization:key=' .$server_key,
 	         'Content-Type:application/json');
			
		 $fields = array ('to'=>$key,'notification'=>array('title'=>$title, 'body'=>$message));
	//	print_r($key);
 		$payload = json_encode($fields);
 
	 $curl_session = curl_init();
 	curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
 	curl_setopt($curl_session, CURLOPT_POST, true);
 curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
 curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

 
 $result = curl_exec($curl_session);
 mysqli_close($con);

	}
	
	public function Tampilkes_pelanggaran_formeditrekappelanggaran(){
		$id_rekappelanggaran=$this->input->get('id_rekappelanggaran');
		$this->data['dataEditRekappelanggaran'] = $this->Admin_model->dataEditRekappelanggaran($id_rekappelanggaran);
		$this->load->view('Kes_pelanggaran_formeditrekappelanggaran',$this->data);
	}

	public function Kes_pelanggaran_editrekappelanggaran(){
		$id_rekappelanggaran=$this->input->get('id_rekappelanggaran');
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];
		$nama_rekappelanggaran = $_POST['nama_rekappelanggaran'];
		$tanggal_rekappelanggaran = $_POST['tanggal_rekappelanggaran'];
		
		$datarekappelanggaran = array('nama_rekappelanggaran' => $nama_rekappelanggaran,'tanggal_rekappelanggaran' => $tanggal_rekappelanggaran);
		$editrekappelanggaran = $this->Admin_model->editDataRekappelanggaran('rekappelanggaran',$datarekappelanggaran,$id_rekappelanggaran);
		if ($editrekappelanggaran > 0){
			redirect('Admin_controller/Tampilkes_pelanggaran_pelanggaranperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';
		}
	}


	//BAGIAN KURIKULUM
	public function Tampilkur_beranda(){

$host = "103.19.208.4:3306";
$db_user = "cendanap_sucy";
$db_password = "iM+_g@X~Ke=u";
$db_name = "cendanap_sia_cendana";
$con = mysqli_connect($host,$db_user,$db_password,$db_name);
$today = date('Y-m-d');
$sql = "SELECT nisn FROM peminjamanbuku p join buku b on p.id_buku = b.id_buku WHERE p.tanggal_kembali = '$today' AND p.tanggal_kembalisiswa IS NULL";
$cek = mysqli_query($con,$sql);
$count = mysqli_num_rows($cek);
$datanisn = $this->Admin_model->getNisnbelumkembalibuku($today);

if ($count > 0){
    $i = 0;
    while ($i < $count){
        $nisn = $datanisn[$i]->nisn;
        $buku = $datanisn[$i]->nama_buku;
        $nama = $datanisn[$i]->nama_siswa;
        $tanggal = date('d M Y',strtotime($datanisn[$i]->tanggal_kembali));

        $title = "PEMBERITAHUAN";
        $message =$nama.", Anda belum mengembalikan buku ".$buku." yang akan jatuh tempo pada tanggal ".$tanggal;
        $this->send_notif_pengembalianbuku($nisn,$title,$message);
        $i++;
    }
    $this->load->view('Kur_beranda');
    
}else{
		$this->load->view('Kur_beranda');
	}}
	
	public function send_notif_pengembalianbuku($nisn,$title,$message){
		$host = "103.19.208.4:3306";
$db_user = "cendanap_sucy";
$db_password = "iM+_g@X~Ke=u";
$db_name = "cendanap_sia_cendana";

$con = mysqli_connect($host,$db_user,$db_password,$db_name);
if($con){}else{
	echo "connection error";
}
		$path_to_fcm = 'https://fcm.googleapis.com/fcm/send';
		$server_key ="AAAAtsoi-Dw:APA91bFS_net4twxn_zkWnn28Mlr4orJlYxs68mPfCJ2odRBBwlIuWlcK5d7zFMqeVnFpQV1_3pbG4L65seXM-5cStuaYDVuxlzPVO2TXkjvFJRF6oE9tcp-mXLfOEUpeovl8PcoYkPB";
		$sql = "select fcm_token from siswa where nisn= $nisn";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_row($result);
		$key = $row[0];

		$headers = array(
 			'Authorization:key=' .$server_key,
 	         'Content-Type:application/json');
			
		 $fields = array ('to'=>$key,'notification'=>array('title'=>$title, 'body'=>$message));
	//	print_r($key);
 		$payload = json_encode($fields);
 
	 $curl_session = curl_init();
 	curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
 	curl_setopt($curl_session, CURLOPT_POST, true);
 curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
 curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

 
 $result = curl_exec($curl_session);
 mysqli_close($con);

	}
	
	
	
	
//KELOLA SISWA
	public function Tampilkur_siswa(){
    $data['siswa'] = $this->Admin_model->getSiswa('siswa');
    $this->load->view('Kur_siswa',$data); }

public function Tampilkur_siswa_formtambahsiswa(){
	$this->load->view('Kur_siswa_formtambahsiswa');
	}

public function Tampilkur_siswa_formtambahsiswacek(){
	$this->load->view('Kur_siswa_formtambahsiswacek');
	}

	public function Kur_siswa_tambahsiswa(){

		$nisn = $_SESSION['nisn'];
		$nama_siswa = $_SESSION['nama_siswa'];
		$password = $_SESSION['password'];
		$tempatlahir = $_SESSION['tempatlahir'];
		$tanggallahir = $_SESSION['tanggallahir'];
		$agama = $_SESSION['agama'];
		$jeniskelamin = $_SESSION['jeniskelamin'];
		$alamat = $_SESSION['alamat'];
		$nama_ayah = $_SESSION['nama_ayah'];
		$nama_ibu = $_SESSION['nama_ibu'];
		$telepon = $_SESSION['telepon'];
		$datasiswa = array('nisn' => $nisn,'nama_siswa' => $nama_siswa,'password' => $password,
			'password' => $password,'tempatlahir' => $tempatlahir,'tanggallahir' => $tanggallahir,'agama' => $agama,
			'jeniskelamin' => $jeniskelamin,'alamat' => $alamat,'nama_ayah' => $nama_ayah,'nama_ibu' => $nama_ibu,'telepon' => $telepon,'status' => 1,'level' => 5);
		$tambahsiswa = $this->Admin_model->tambahDataSiswa('siswa',$datasiswa);
		if ($tambahsiswa > 0){
			redirect('Admin_controller/Tampilkur_siswa');
		}
		}

public function Tampilkur_siswa_formeditsiswa(){
		$nisn=$this->input->get('nisn');
		$_SESSION['nisn']=$nisn;
		$this->data['dataEditSiswa'] = $this->Admin_model->dataEditSiswa($nisn);
		$this->load->view('Kur_siswa_formeditsiswa',$this->data);
	}
	public function Kur_siswa_editsiswa(){
		$nisn = $_POST['nisn'];
		$nama_siswa = $_POST['nama_siswa'];
		$password = $_POST['password'];
		$tempatlahir = $_POST['tempatlahir'];
		$tanggallahir = $_POST['tanggallahir'];
		$agama = $_POST['agama'];
		$jeniskelamin = $_POST['jeniskelamin'];
		$alamat = $_POST['alamat'];
		$nama_ayah = $_POST['nama_ayah'];
		$nama_ibu = $_POST['nama_ibu'];
		$telepon = $_POST['telepon'];
		$status = $_POST['status'];
		$datasiswa = array('nama_siswa' => $nama_siswa,'password' => $password,
			'password' => $password,'tempatlahir' => $tempatlahir,'tanggallahir' => $tanggallahir,'agama' => $agama,
			'jeniskelamin' => $jeniskelamin,'alamat' => $alamat,'nama_ayah' => $nama_ayah,'nama_ibu' => $nama_ibu,'telepon' => $telepon,'status' => $status);
		$editsiswa = $this->Admin_model->editDataSiswa('siswa',$datasiswa,$nisn);
		if ($editsiswa > 0){
			redirect('Admin_controller/Tampilkur_siswa');
		} else{
			echo'gagal disimpan';
		}

	}

	//KELOLA KELAS
	public function Tampilkur_kelas(){
    $data['kelas'] = $this->Admin_model->getSemuaKelas('kelas');
    $this->load->view('Kur_kelas',$data); 
	}

	
	public function Tampilkur_kelas_kelaspertahunkembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$this->data['kelas'] = $this->Admin_model->getKelasPerTahun($id_tahunsemester);
	$this->load->view('Kur_kelas_kelaspertahun',$this->data);
	}

	public function Tampilkur_kelas_formtambahkelas(){
	$data['kategorikelas']=$this->Admin_model->getKategoriKelas('kategorikelas');
	$data['jurusan']=$this->Admin_model->getSemuaJurusan('jurusan');
	$this->load->view('Kur_kelas_formtambahkelas',$data);
	}

	public function Kur_kelas_tambahkelas(){
		$id_kategorikelas = $_SESSION['id_kategorikelas'];
		$id_jurusan = $_SESSION['id_jurusan'];
		$nama_kelas = $_SESSION['nama_kelas'];
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$datakelas = array('id_kategorikelas' => $id_kategorikelas,'id_jurusan' => $id_jurusan,'nama_kelas' => $nama_kelas);
		$tambahkelas = $this->Admin_model->tambahDataKelas('kelas',$datakelas);
		if ($tambahkelas > 0){
			redirect('Admin_controller/Tampilkur_kelas');
		}
		}




	public function Tampilkur_kelas_formtambahkelascek(){
	$this->load->view('Kur_kelas_formtambahkelascek');
	}

	public function Tampilkur_kelas_formeditkelas(){
		$id_kelas=$this->input->get('id_kelas');
		$_SESSION['id_kelas']=$id_kelas;
		$this->data['dataEditKelas'] = $this->Admin_model->dataEditKelas($id_kelas);
		$this->load->view('Kur_kelas_formeditkelas',$this->data);
	}

	public function Tampilkur_kelas_formeditkelascek(){
	$this->load->view('Kur_kelas_formeditkelascek');
	}

	public function Kur_kelas_editkelas(){
		$id_kelas=$_SESSION['id_kelas'];
	$nama_kelas = $_SESSION['nama_kelas'];
		$datakelas = array('nama_kelas' => $nama_kelas);
		$editkelas = $this->Admin_model->editDataKelas('kelas',$datakelas,$id_kelas);
		if ($editkelas > 0){
			redirect('Admin_controller/Tampilkur_kelas');
		} else{
			echo'gagal disimpan';
		}

	}
	//REKAPKELAS
public function Tampilkur_rekapkelas(){
    $data['tahunsemester'] = $this->Admin_model->getSemuaTahunSemester();
    $this->load->view('Kur_rekapkelas',$data); 
	}

	public function Tampilkur_rekapkelas_rekapkelaspertahun(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
    $_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$data['kelaspertahun'] = $this->Admin_model->getKelasPerTahun($id_tahunsemester);
	$this->load->view('Kur_rekapkelas_rekapkelaspertahun',$data); 
	}


	public function Tampilkur_rekapkelas_rekapkelaspertahunkembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
    $_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$data['kelaspertahun'] = $this->Admin_model->getKelasPerTahun($id_tahunsemester);
	$this->load->view('Kur_rekapkelas_rekapkelaspertahun',$data); 
	}

	public function Tampilkur_rekapkelas_formtambahrekapkelas(){
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
	$data['kelas']=$this->Admin_model->getSemuaKelas('kelas');
	 $data['siswabelumberkelas'] = $this->Admin_model->getSiswaBelumBerkelas($id_tahunsemester);
	$this->load->view('Kur_rekapkelas_formtambahrekapkelas',$data);
	}

	public function Tampilkur_rekapkelas_formtambahrekapkelascek(){
		$this->load->view('Kur_rekapkelas_formtambahrekapkelascek');}

	public function Kur_rekapkelas_tambahrekapkelas(){
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_POST['id_kelas'];
		$datakelas = array('id_kategorikelas' => $id_kategorikelas,'id_jurusan' => $id_jurusan,'nama_kelas' => $nama_kelas);
		$tambahkelas = $this->Admin_model->tambahDataKelas('kelas',$datakelas);
		if ($tambahkelas > 0){
			redirect('Admin_controller/Tampilkur_kelas');
		}
		}

		public function Tampilkur_rekapkelas_rekapkelasperkelas(){
	
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$id_kelas = $this->input->get('id_kelas');
	$_SESSION['id_kelas'] = $id_kelas;
	$this->data['rekapkelasperkelas'] = $this->Admin_model->getRekapkelasPerKelas($id_kelas,$id_tahunsemester);
	$this->load->view('Kur_rekapkelas_rekapkelasperkelas',$this->data);}

	//matapelajaran
	public function Tampilkur_matapelajaran(){
    $data['matapelajaran'] = $this->Admin_model->getSemuaMataPelajaran('matapelajaran');
    $this->load->view('Kur_matapelajaran',$data); 
	}

	public function Tampilkur_matapelajaran_formtambahmatapelajaran(){
	$data['kategorikelas']=$this->Admin_model->getKategoriKelas('kategorikelas');
	$data['jurusan']=$this->Admin_model->getSemuaJurusan('jurusan');
	$data['semester']=$this->Admin_model->getSemuaSemester('semester');
	$this->load->view('Kur_matapelajaran_formtambahmatapelajaran',$data);
	}

	public function Tampilkur_matapelajaran_formtambahmatapelajarancek(){
	$this->load->view('Kur_matapelajaran_formtambahmatapelajarancek');
	}


	public function Kur_matapelajaran_tambahmatapelajaran(){
		$id_kategorikelas = $_SESSION['id_kategorikelas'];
		$id_jurusan = $_SESSION['id_jurusan'];
		$id_semester = $_SESSION['id_semester'];
		$nama_matapelajaran = $_SESSION['nama_matapelajaran'];
		$datamatapelajaran = array('nama_matapelajaran' => $nama_matapelajaran, 'id_kategorikelas' => $id_kategorikelas,'id_jurusan' => $id_jurusan,'id_semester' => $id_semester);
		$tambahmatapelajaran = $this->Admin_model->tambahDataMataPelajaran('matapelajaran',$datamatapelajaran);
		if ($tambahmatapelajaran > 0){
			redirect('Admin_controller/Tampilkur_matapelajaran');
		}
		}


		public function Tampilkur_matapelajaran_formeditmatapelajaran(){
		$id_matapelajaran=$this->input->get('id_matapelajaran');
		$_SESSION['id_matapelajaran']=$id_matapelajaran;
		$this->data['dataEditMataPelajaran'] = $this->Admin_model->dataEditMataPelajaran($id_matapelajaran);
		$this->load->view('Kur_matapelajaran_formeditmatapelajaran',$this->data);
	}

	public function Tampilkur_matapelajaran_formeditmatapelajarancek(){
	$this->load->view('Kur_matapelajaran_formeditmatapelajarancek');
	}

	public function Kur_matapelajaran_editmatapelajaran(){
		$id_matapelajaran=$_SESSION['id_matapelajaran'];
	$nama_matapelajaran = $_SESSION['nama_matapelajaran'];
		$datamatapelajaran = array('nama_matapelajaran' => $nama_matapelajaran);
		$editmatapelajaran = $this->Admin_model->editDataMataPelajaran('matapelajaran',$datamatapelajaran,$id_matapelajaran);
		if ($editmatapelajaran > 0){
			redirect('Admin_controller/Tampilkur_matapelajaran');
		} else{
			echo'gagal disimpan';
		}

	}

	//tahunajaran
public function Tampilkur_tahunajaran(){
	$this->data['hasiltahunajaran'] = $this->Admin_model->getSemuaTahunAjaran('tahunajaran');

	$this->load->view('Kur_tahunajaran',$this->data);
	}

	
public function Tampilkur_tahunajaran_formtambahtahunajaran(){
	
	$this->load->view('Kur_tahunajaran_formtambahtahunajaran');
	}

	public function Tampilkur_tahunsemester(){
	$this->data['hasiltahunsemester'] = $this->Admin_model->getSemuaTahunSemester('tahunsemester');
	$this->load->view('Kur_tahunsemester',$this->data);

	}


public function Tampilkur_tahunsemester_formtambahtahunsemester(){
	$data['tahunajaran'] = $this->Admin_model->getSemuaTahunAjaranDistinct('tahunajaran');
	$data['semester'] = $this->Admin_model->getSemuaSemester('semester');	
	$this->load->view('Kur_tahunsemester_formtambahtahunsemester',$data);
	}

	public function Tampilkur_tahunsemester_formtambahtahunsemestercek(){
	$this->load->view('Kur_tahunsemester_formtambahtahunsemestercek');
	}

	public function Kur_tahunsemester_tambahtahunsemester(){
		$id_tahunajaran = $_SESSION['id_tahunajaran'];
		$id_semester = $_SESSION['id_semester'];
		$datatahunsemester = array('id_tahunajaran' => $id_tahunajaran,'id_semester' => $id_semester);
		$tambahtahunsemester = $this->Admin_model->tambahDataTahunSemester('rekaptahunsemester',$datatahunsemester);
		if ($tambahtahunsemester > 0){
			redirect('Admin_controller/Tampilkur_tahunsemester');
		}
		}

		public function Tampilkur_tahunsemester_formedittahunsemester(){
	$id_tahunsemester=$this->input->get('id_tahunsemester');
	$_SESSION['id_tahunsemester']=$id_tahunsemester;
	$data['tahunajaran'] = $this->Admin_model->getSemuaTahunAjaranDistinct('tahunajaran');
	$data['semester'] = $this->Admin_model->getSemuaSemester('semester');	
	$data['dataEditTahunSemester'] = $this->Admin_model->dataEditTahunSemester($id_tahunsemester);
	$this->load->view('Kur_tahunsemester_formedittahunsemester',$data);
	}

		public function Tampilkur_tahunsemester_formedittahunsemestercek(){
	$this->load->view('Kur_tahunsemester_formedittahunsemestercek');
	}

	public function Kur_tahunsemester_edittahunsemester(){
	$id_tahunsemester=$_SESSION['id_tahunsemester'];
	$id_tahunajaran = $_SESSION['id_tahunajaran'];
		$id_semester = $_SESSION['id_semester'];
	$datatahunsemester = array('id_tahunajaran' => $id_tahunajaran, 'id_semester' => $id_semester);
	$edittahunsemester = $this->Admin_model->editDataTahunSemester('rekaptahunsemester',$datatahunsemester,$id_tahunsemester);
	if ($edittahunsemester > 0){
	redirect('Admin_controller/Tampilkur_tahunsemester');
	} else{
	echo'gagal disimpan';
	}}


public function Tampilkur_tahunajaran_formtambahtahunajarancek(){
	
	$this->load->view('Kur_tahunajaran_formtambahtahunajarancek');
	}




public function Kur_tahunajaran_tambahtahunajaran(){
		$nama_tahunajaran = $_SESSION['nama_tahunajaran'];
		$datatahunajaran = array('nama_tahunajaran' => $nama_tahunajaran);
		$tambahtahunajaran = $this->Admin_model->tambahDataTahunAjaran('tahunajaran',$datatahunajaran);
		if ($tambahtahunajaran > 0){
			redirect('Admin_controller/Tampilkur_tahunajaran');
		}
		}

public function Tampilkur_tahunajaran_formedittahunajaran(){
	$id_tahunajaran=$this->input->get('id_tahunajaran');
	$_SESSION['id_tahunajaran']=$id_tahunajaran;
	$this->data['dataEditTahunAjaran'] = $this->Admin_model->dataEditTahunAjaran($id_tahunajaran);
	$this->load->view('Kur_tahunajaran_formedittahunajaran',$this->data);
	}

public function Tampilkur_tahunajaran_formedittahunajarancek(){
	$this->load->view('Kur_tahunajaran_formedittahunajarancek');
	}

	public function Kur_tahunajaran_edittahunajaran(){
	$id_tahunajaran=$_SESSION['id_tahunajaran'];
	$nama_tahunajaran = $_SESSION['nama_tahunajaran'];
	$datatahunajaran = array('nama_tahunajaran' => $nama_tahunajaran);
	$edittahunajaran = $this->Admin_model->editDataTahunAjaran('tahunajaran',$datatahunajaran,$id_tahunajaran);
	if ($edittahunajaran > 0){
	redirect('Admin_controller/Tampilkur_tahunajaran');
	} else{
	echo'gagal disimpan';
	}}


	//NILAI
	public function Tampilkur_nilai(){
    $data['tahunsemester'] = $this->Admin_model->getSemuaTahunSemester();
    $this->load->view('Kur_nilai',$data); 
	}

	public function Tampilkur_nilai_nilaiperkelas(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$result_explode = explode('|', $id_tahunsemester);
    $id_tahunsemester = $result_explode[0];
    $id_semester = $result_explode[1];
	$id_kelas = $this->input->post('kelas');
	$result_explode = explode('|', $id_kelas);
    $id_kelas = $result_explode[0];
    $id_jurusan = $result_explode[1];
    $id_kategorikelas = $result_explode[2];
	$id_matapelajaran = $this->input->post('matapelajaran');
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_semester'] = $id_semester;
	$_SESSION['id_kelas'] = $id_kelas;
	$_SESSION['id_jurusan'] = $id_jurusan;
	$_SESSION['id_kategorikelas'] = $id_kategorikelas;
	$_SESSION['id_matapelajaran'] = $id_matapelajaran;
	$this->data['nilai'] = $this->Admin_model->getNilaiPerKelas($id_tahunsemester,$id_kelas,$id_matapelajaran);
	$this->load->view('Kur_nilai_nilaiperkelas',$this->data);
	}

	public function Tampilkur_nilai_nilaiperkelaskembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$id_kelas = $this->input->get('id_kelas');
	$id_matapelajaran = $this->input->get('matapelajaran');
	$this->data['nilai'] = $this->Admin_model->getNilaiPerKelas($id_tahunsemester,$id_kelas,$id_matapelajaran);
	$this->load->view('Kur_nilai_nilaiperkelas',$this->data);
	}

	public function Tampilkur_nilai_formtambahnilai(){
	$id_tahunsemester = $_SESSION['id_tahunsemester'] ;
	$id_semester =$_SESSION['id_semester'] ;
	$id_kelas = $_SESSION['id_kelas'];
	$id_jurusan = $_SESSION['id_jurusan'] ;
	$id_kategorikelas = $_SESSION['id_kategorikelas'];
	$id_matapelajaran = $_SESSION['id_matapelajaran'] ;
	$result['siswaperkelas'] = $this->Admin_model->getSiswaPerKelas($id_kelas,$id_tahunsemester);
	$this->load->view('Kur_nilai_formtambahnilai',$result);
	}

	public function Tampilkur_nilai_formtambahnilaicek(){
	$this->load->view('Kur_nilai_formtambahnilaicek');}

//	public function Kur_nilai_tambahnilai(){
//		$id_kelas = $_SESSION['id_kelas'];
//$id_semester = $_SESSION['id_semester'];
//$id_jurusan =   $_SESSION['id_jurusan'];
//$id_kategorikelas = $_SESSION['id_kategorikelas'] ;
//$id_tahunsemester = $_SESSION['id_tahunsemester'] ;
//$id_matapelajaran = $_SESSION['id_matapelajaran'];
//	$this->load->model('Admin_model');
//	$i = 1;
//	while (isset ($_POST['nisn'.$i])) 
//	{


//		$nisnnya = $_POST['nisn'.$i];
//		$nilai_harian = $_POST['nilai_harian'.$i];
//		$nilai_uts = $_POST['nilai_uts'.$i];
//		$nilai_uas = $_POST['nilai_uas'.$i];
//
//		$ratarata = ($nilai_harian+$nilai_uts+$nilai_uas)/3;
//		$nilai_akhir = $ratarata;
//
//		if($nilai_akhir<75){
//			$predikat = 'D';
//			}else if(75 <= $nilai_akhir && $nilai_akhir < 83){
//			$predikat = 'C';	
//		}else if(83 <= $nilai_akhir && $nilai_akhir < 92){
//			$predikat = 'B';
//		}else if(92 <= $nilai_akhir && $nilai_akhir <= 100){
//		$predikat = 'A';
//		}
//		
//		$this->Admin_model->tambahDataNilai($nilai_harian,$nilai_uts,$nilai_uas,$nilai_akhir,$predikat,$nisnnya,$id_matapelajaran);
//		$i++;
//	}
//	redirect('Admin_controller/Tampilkur_nilai_nilaiperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas.'&matapelajaran='.$id_matapelajaran);
//	}

	public function Tampilkur_nilai_formeditnilai(){
	$id_nilai=$this->input->get('id_nilai');
	$this->data['dataEditNilai'] = $this->Admin_model->dataEditNilai('nilai',$id_nilai);
	$this->load->view('Kur_nilai_formeditnilai',$this->data);
	}

public function Kur_nilai_editnilai(){
	$id_tahunsemester = $_SESSION['id_tahunsemester'] ;
	$id_semester =$_SESSION['id_semester'] ;
	$id_kelas = $_SESSION['id_kelas'];
	$id_jurusan = $_SESSION['id_jurusan'] ;
	$id_kategorikelas = $_SESSION['id_kategorikelas'];
	$id_matapelajaran = $_SESSION['id_matapelajaran'] ;
			$nisn = $_SESSION['nisn'];
		$id_nilai=$this->input->get('id_nilai');
		$nilai_harian=$_POST['nilai_harian'];
		$nilai_uts=$_POST['nilai_uts'];
		$nilai_uas=$_POST['nilai_uas'];
$ratarata = ($nilai_harian+$nilai_uts+$nilai_uas)/3;
		$nilai_akhir = $ratarata;

		if($nilai_akhir<75){
			$predikat = 'D';
		}else if(75 <= $nilai_akhir && $nilai_akhir < 83){
			$predikat = 'C';	
		}else if(83 <= $nilai_akhir && $nilai_akhir < 92){
			$predikat = 'B';
		}else if(92 <= $nilai_akhir && $nilai_akhir <= 100){
$predikat = 'A';
		}



		$datanilai = array('nilai_harian' => $nilai_harian,'nilai_uts' => $nilai_uts,'nilai_uas' => $nilai_uas,'nilai_akhir' => $nilai_akhir,'predikat' => $predikat);
		$editnilai = $this->Admin_model->editDataNilai('nilai',$datanilai,$id_nilai);
		if ($editnilai > 0){
			redirect('Admin_controller/Tampilkur_nilai_nilaiperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas.'&matapelajaran='.$id_matapelajaran);
		} else{
			echo'gagal disimpan';
		}

	}

	//ABSENSI
	public function Tampilkur_absensi(){
	$this->data['hasiltahunsemester'] = $this->Admin_model->getSemuaTahunSemester('tahunsemester');
	$this->load->view('Kur_absensi',$this->data);}

	public function Tampilkur_absensi_absensiperkelas(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$result_explode = explode('|', $id_tahunsemester);
    $id_tahunsemester = $result_explode[0];
    $id_semester = $result_explode[1];
	$id_kelas = $this->input->post('kelas');
	$result_explode = explode('|', $id_kelas);
    $id_kelas = $result_explode[0];
    $id_jurusan = $result_explode[1];
    $id_kategorikelas = $result_explode[2];
	$id_matapelajaran = $this->input->post('matapelajaran');
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_semester'] = $id_semester;
	$_SESSION['id_kelas'] = $id_kelas;
	$_SESSION['id_jurusan'] = $id_jurusan;
	$_SESSION['id_kategorikelas'] = $id_kategorikelas;
	$_SESSION['id_matapelajaran'] = $id_matapelajaran;
	$this->data['absensi'] = $this->Admin_model->getAbsensiPerKelas($id_tahunsemester,$id_kelas,$id_matapelajaran);
	$this->load->view('Kur_absensi_absensiperkelas',$this->data);
	}

	public function Tampilkur_absensi_absensiperkelaskembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$id_kelas = $this->input->get('id_kelas');
	$id_matapelajaran = $this->input->get('id_matapelajaran');
	$this->data['absensi'] = $this->Admin_model->getAbsensiPerKelas($id_tahunsemester,$id_kelas,$id_matapelajaran);
	$this->load->view('Kur_absensi_absensiperkelas',$this->data);
	}



	public function Tampilkur_absensi_formtambahabsensi(){

	$id_tahunsemester = $_SESSION['id_tahunsemester'] ;
	$id_semester =$_SESSION['id_semester'] ;
	$id_kelas = $_SESSION['id_kelas'];
	$id_jurusan = $_SESSION['id_jurusan'] ;
	$id_kategorikelas = $_SESSION['id_kategorikelas'];
	$id_matapelajaran = $_SESSION['id_matapelajaran'] ;
	$result['siswaperkelas']=$this->Admin_model->getSiswaPerKelas($id_kelas,$id_tahunsemester);
	$result['matapelajaran']=$this->Admin_model->getMataPelajaran($id_kelas);
	
	$this->load->view('Kur_absensi_formtambahabsensi',$result);}

	public function Tampilkur_absensi_formtambahabsensicek(){
	$this->load->view('Kur_absensi_formtambahabsensicek');}


    public function Tampilkur_absensi_absensiperabsensi(){
	$tanggal_absensi = $this->input->get('tanggal_absensi');
	$_SESSION['tanggal_absensi'] = $tanggal_absensi;
	$id_matapelajaran = $this->input->get('id_matapelajaran');
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$id_kelas = $this->input->get('id_kelas');
	
	$this->data['absensiperabsensi'] = $this->Admin_model->getSemuaAbsensiPerAbsensi($tanggal_absensi,$id_matapelajaran,$id_kelas,$id_tahunsemester);
	$this->load->view('Kur_absensi_absensiperabsensi',$this->data);}

public function Tampilkur_absensi_formeditabsensi(){

	$id_absensi=$this->input->get('id_absensi');
	$tanggal_absensi=$this->input->get('tanggal_absensi');
	$_SESSION['tanggal_absensi'] = $tanggal_absensi;
	$this->data['dataEditAbsensi'] = $this->Admin_model->dataEditAbsensi('absensi',$id_absensi);
	$this->load->view('Kur_absensi_formeditabsensi',$this->data);
	}


public function Kur_absensi_editabsensi(){
	$id_tahunsemester = $_SESSION['id_tahunsemester'] ;
	$id_semester =$_SESSION['id_semester'] ;
	$id_kelas = $_SESSION['id_kelas'];
	$id_jurusan = $_SESSION['id_jurusan'] ;
	$id_kategorikelas = $_SESSION['id_kategorikelas'];
	$id_matapelajaran = $_SESSION['id_matapelajaran'] ;
	$tanggal_absensi = $_SESSION['tanggal_absensi'];	
		$id_absensi=$this->input->get('id_absensi');
	$keterangan_absensi = $_POST['pilihan'];


		$dataabsensi = array('keterangan_absensi' => $keterangan_absensi);
		$editabsensi = $this->Admin_model->editDataAbsensi('absensi',$dataabsensi,$id_absensi);
		if ($editabsensi > 0){
			redirect('Admin_controller/Tampilkur_absensi_absensiperabsensi?tanggal_absensi='.$tanggal_absensi.'&id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas.'&id_matapelajaran='.$id_matapelajaran);
		} else{
			echo'gagal disimpan';
		}

	}


	//BAGIAN SARANA
	public function Tampilsar_Beranda(){
	$this->load->view('Sar_beranda');}

	//SPP
		public function Tampilsar_spp(){
	$this->data['tahunsemester'] = $this->Admin_model->getSemuaTahunSemester('tahunsemester');
	$this->load->view('Sar_spp',$this->data);}

	public function Tampilsar_spp_sppperkelas(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$id_kelas = $this->input->post('kelas');
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_kelas'] = $id_kelas;
	$this->data['sppperkelas'] = $this->Admin_model->getSppPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Sar_spp_sppperkelas',$this->data);
	}

	public function Tampilsar_spp_sppperkelaskembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$id_kelas = $this->input->get('id_kelas');
	$this->data['sppperkelas'] = $this->Admin_model->getSppPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Sar_spp_sppperkelas',$this->data);
	}

	public function Tampilsar_spp_formtambahrekapspp(){
	$id_kelas = $_SESSION['id_kelas'];
	$id_tahunsemester = $_SESSION['id_tahunsemester'];
	$data['siswaperkelas']=$this->Admin_model->getSiswaPerKelas($id_kelas,$id_tahunsemester);
	$this->load->view('Sar_spp_formtambahrekapspp',$data);
	}

	public function Tampilsar_spp_formtambahrekapsppcek(){
	$id_kelas = $_SESSION['id_kelas'];
	$id_tahunsemester = $_SESSION['id_tahunsemester'];
	$this->load->view('Sar_spp_formtambahrekapsppcek');}

	public function Sar_spp_tambahrekapspp(){
		$nisn = $_SESSION['nisn'];
		$bulan_spp = $_SESSION['bulan_spp'];
		$jumlah_spp = $_SESSION['jumlah_spp'];
		$status_spp = $_SESSION['status_spp'];
		$tanggalbayar_spp = $_SESSION['tanggalbayar_spp'];
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];
		$datarekapspp = array('bulan_spp' => $bulan_spp,'jumlah_spp' => $jumlah_spp,'status_spp' => $status_spp,'tanggalbayar_spp' => $tanggalbayar_spp,'nisn' => $nisn,'id_kelas' => $id_kelas,'id_tahunsemester' => $id_tahunsemester);
		$tambahrekapspp = $this->Admin_model->tambahDataRekapspp('rekapspp',$datarekapspp);
		if ($tambahrekapspp > 0){
			redirect('Admin_controller/Tampilsar_spp_sppperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';
		}
	}

	public function Tampilsar_spp_formeditrekapspp(){
		$id_rekapspp=$this->input->get('id_rekapspp');
		$_SESSION['id_rekapspp'] = $id_rekapspp;
		$this->data['dataEditRekapspp'] = $this->Admin_model->dataEditRekapspp($id_rekapspp);
		$this->load->view('Sar_spp_formeditrekapspp',$this->data);
	}


	public function Sar_spp_editrekapspp(){
		$nisn = $_POST['nisn'];
		$id_rekapspp = $_POST['id_rekapspp'];
		$bulan_spp = $_POST['bulan_spp'];
		$jumlah_spp = $_POST['jumlah_spp'];
		$status_spp = $_POST['status_spp'];
		$tanggalbayar_spp = $_POST['tanggalbayar_spp'];
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];
		$datarekapspp = array('jumlah_spp'=>$jumlah_spp,'status_spp'=>$status_spp);
		$editrekapspp = $this->Admin_model->editDataRekapspp('rekapspp',$datarekapspp,$id_rekapspp);
		if ($editrekapspp > 0){
			redirect('Admin_controller/Tampilsar_spp_sppperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';
		}
	}

	public function Tampilsar_buku(){
	$data['tahunsemester'] = $this->Admin_model->getSemuaTahunSemester();
	$this->load->view('Sar_buku',$data);}



	public function Tampilsar_buku_bukuperkelas(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$id_kelas = $this->input->post('kelas');
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_kelas'] = $id_kelas;
	$this->data['buku'] = $this->Admin_model->getBukuPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Sar_buku_bukuperkelas',$this->data);
	}


	public function Tampilsar_buku_bukuperkelaskembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$id_kelas = $this->input->get('id_kelas');
	$this->data['buku'] = $this->Admin_model->getBukuPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Sar_buku_bukuperkelas',$this->data);
	}


/////PERPUSTAKAAN
	public function Tampilperpus_beranda(){
	$this->load->view('Perpus_beranda');}

	public function Tampilperpus_buku(){
	$data['tahunsemester'] = $this->Admin_model->getSemuaTahunSemester();
	$this->load->view('Perpus_buku',$data);}



	public function Tampilperpus_buku_bukuperkelas(){
	$id_tahunsemester = $this->input->post('id_tahunsemester');
	$id_kelas = $this->input->post('kelas');
	$_SESSION['id_tahunsemester'] = $id_tahunsemester;
	$_SESSION['id_kelas'] = $id_kelas;
	$this->data['buku'] = $this->Admin_model->getBukuPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Perpus_buku_bukuperkelas',$this->data);
	}


	public function Tampilperpus_buku_bukuperkelaskembali(){
	$id_tahunsemester = $this->input->get('id_tahunsemester');
	$id_kelas = $this->input->get('id_kelas');
	$this->data['buku'] = $this->Admin_model->getBukuPerKelas($id_tahunsemester,$id_kelas);
	$this->load->view('Perpus_buku_bukuperkelas',$this->data);
	}

	public function Tampilperpus_buku_formtambahpeminjamanbuku(){
	$id_kelas = $_SESSION['id_kelas'];
	$id_tahunsemester = $_SESSION['id_tahunsemester'];
	$result['buku'] = $this->Admin_model->getSemuaBuku('buku'); 
	$data['siswaperkelas']=$this->Admin_model->getSiswaPerKelas($id_kelas,$id_tahunsemester);
	$this->load->view('Perpus_buku_formtambahpeminjamanbuku',$data + $result);
	}

public function Tampilperpus_buku_formtambahpeminjamanbukucek(){
	$id_kelas = $_SESSION['id_kelas'];
	$id_tahunsemester = $_SESSION['id_tahunsemester'];
	$this->load->view('Perpus_buku_formtambahpeminjamanbukucek');}

 
	public function Perpus_buku_tambahpeminjamanbuku(){
		$nisn = $_SESSION['nisn'];
		$id_buku = $_SESSION['id_buku'];
		$jumlah_buku = $_SESSION['jumlah_buku'];
		$tanggal_pinjam = $_SESSION['tanggal_pinjam'];
		$tanggal_kembali = $_SESSION['tanggal_kembali'];
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];
		$editbuku = $this->Admin_model->editStokJenisBuku($id_buku,$jumlah_buku);
		$datapeminjamanbuku = array('id_buku' => $id_buku,'jumlah_buku' => $jumlah_buku,'tanggal_pinjam' => $tanggal_pinjam,'tanggal_kembali' => $tanggal_kembali,'nisn' => $nisn,'id_tahunsemester' => $id_tahunsemester,'id_kelas' => $id_kelas);
		$tambahpeminjamanbuku = $this->Admin_model->tambahDataPeminjamanBuku('peminjamanbuku',$datapeminjamanbuku);
				if ($tambahpeminjamanbuku > 0){
			redirect('Admin_controller/Tampilperpus_buku_bukuperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';
		}
	}

	public function Tampilperpus_buku_formeditpeminjamanbuku(){
		$id_peminjamanbuku=$this->input->get('id_peminjamanbuku');
		$this->data['dataEditPeminjamanbuku'] = $this->Admin_model->dataEditPeminjamanbuku($id_peminjamanbuku);
		$this->load->view('Perpus_buku_formeditpeminjamanbuku',$this->data);
	}

	public function Tampilperpus_buku_formeditpeminjamanbukucek(){
	$this->load->view('Perpus_buku_formeditpeminjamanbukucek');}



	public function Perpus_buku_editpeminjamanbuku(){
		$nisn = $_SESSION['nisn'];
		$id_peminjamanbuku = $_SESSION['id_peminjamanbuku'];
		$id_tahunsemester = $_SESSION['id_tahunsemester'];
		$id_kelas = $_SESSION['id_kelas'];
		$id_buku = $_SESSION['id_buku'];
		$jumlah_buku = $_SESSION['jumlah_buku'];
		$tanggal_pinjam = $_SESSION['tanggal_pinjam'];
		$tanggal_kembali = $_SESSION['tanggal_kembali'];
		$tanggal_kembalisiswa = $_SESSION['tanggal_kembalisiswa'];
		$keterangandenda = $_SESSION['keterangandenda'];
		$editbuku = $this->Admin_model->editStokKembaliJenisBuku($id_buku,$jumlah_buku);
		$datapeminjamanbuku = array('id_buku' => $id_buku,'jumlah_buku'=>$jumlah_buku,'tanggal_pinjam'=>$tanggal_pinjam,'tanggal_kembali'=>$tanggal_kembali,'tanggal_kembalisiswa'=>$tanggal_kembalisiswa,
			'keterangandenda'=> $keterangandenda);
		$editpeminjamanbuku = $this->Admin_model->editDataPeminjamanbuku('peminjamanbuku',$datapeminjamanbuku,$id_peminjamanbuku);
		if ($editpeminjamanbuku > 0){
			redirect('Admin_controller/Tampilperpus_buku_bukuperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas);
		} else{
			echo'gagal disimpan';
		}
	}

	  public function Tampilperpus_buku_jenisbuku(){
    $result['buku'] = $this->Admin_model->getBuku();
    $this->load->view('Perpus_buku_jenisbuku',$result); }

    public function Tampilperpus_buku_formtambahjenisbuku(){
    	$data['rakbuku'] = $this->Admin_model->getRakBuku('rakbuku');
	$this->load->view('Perpus_buku_formtambahjenisbuku',$data);
	}

	public function Perpus_buku_tambahjenisbuku(){
		$nama_buku = $_POST['nama_buku'];
		$stok_buku = $_POST['stok_buku'];
		$id_rakbuku = $_POST['id_rakbuku'];
		$databuku = array('nama_buku' => $nama_buku,'stok_buku' => $stok_buku,'id_rakbuku' => $id_rakbuku);
		$tambahbuku = $this->Admin_model->tambahDataJenisBuku('buku',$databuku);
		if ($tambahbuku > 0){
			redirect('Admin_controller/Tampilperpus_buku_jenisbuku');
		}
		}

		public function Tampilperpus_buku_formeditjenisbuku(){
		$id_buku=$this->input->get('id_buku');
		$_SESSION['id_buku']=$id_buku;
		$data['rakbuku'] = $this->Admin_model->getRakBuku('rakbuku');
		$data['dataEditJenisBuku'] = $this->Admin_model->dataEditJenisBuku($id_buku);
		$this->load->view('Perpus_buku_formeditjenisbuku',$data);
	}

	public function Perpus_buku_editjenisbuku(){
		$id_buku=$_SESSION['id_buku'];
	$nama_buku = $_POST['nama_buku'];
	$stok_buku=$_POST['stok_buku'];
	$id_rakbuku = $_POST['id_rakbuku'];
		$databuku = array('nama_buku' => $nama_buku,'stok_buku' => $stok_buku,'id_rakbuku' => $id_rakbuku);
		$editbuku = $this->Admin_model->editDataJenisBuku('buku',$databuku,$id_buku);
		if ($editbuku > 0){
			redirect('Admin_controller/Tampilperpus_buku_jenisbuku');
		} else{
			echo'gagal disimpan';
		}

	}
public function Tampilperpus_rakbuku(){
    $data['rakbuku'] = $this->Admin_model->getRakBuku('rakbuku');
    $this->load->view('Perpus_rakbuku',$data); }

 public function Tampilperpus_rakbuku_formtambahrakbuku(){
	$this->load->view('Perpus_rakbuku_formtambahrakbuku');
	}

	public function Perpus_rakbuku_tambahrakbuku(){
		$nama_rakbuku = $_POST['nama_rakbuku'];
		$datarakbuku = array('nama_rakbuku' => $nama_rakbuku);
		$tambahrakbuku = $this->Admin_model->tambahDataRakBuku('rakbuku',$datarakbuku);
		if ($tambahrakbuku > 0){
			redirect('Admin_controller/Tampilperpus_rakbuku');
		}
		}

		public function Tampilperpus_rakbuku_formeditrakbuku(){
		$id_rakbuku=$this->input->get('id_rakbuku');
		$_SESSION['id_rakbuku']=$id_rakbuku;
		$this->data['dataEditRakBuku'] = $this->Admin_model->dataEditRakBuku($id_rakbuku);
		$this->load->view('Perpus_rakbuku_formeditrakbuku',$this->data);
	}

	public function Perpus_rakbuku_editrakbuku(){
		$id_rakbuku=$_SESSION['id_rakbuku'];
	$nama_rakbuku = $_POST['nama_rakbuku'];
		$datarakbuku = array('nama_rakbuku' => $nama_rakbuku);
		$editrakbuku = $this->Admin_model->editDataRakBuku('rakbuku',$datarakbuku,$id_rakbuku);
		if ($editrakbuku > 0){
			redirect('Admin_controller/Tampilperpus_rakbuku');
		} else{
			echo'gagal disimpan';
		}

	}


}

