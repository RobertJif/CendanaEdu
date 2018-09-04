<?php 
include "koneksi.php";

	$nisn = $_POST['nisn'];
    $bulan_spp = $_POST['bulan_spp'];
    $jumlah_spp = $_POST['jumlah_spp'];
    $status_spp = $_POST['status_spp'];
	$tanggalbayar_spp = $_POST['tanggalbayar_spp'];
	$id_tahunsemester = $_SESSION['id_tahunsemester'];
	$id_kelas = $_SESSION['id_kelas'];

	
		$cek = "select * from rekapspp where nisn = '$nisn' AND bulan_spp = '$bulan_spp' AND id_kelas='$id_kelas' AND id_tahunsemester='$id_tahunsemester'";
		$cekquery = mysqli_query($conn,$cek);
		if (mysqli_num_rows($cekquery) > 0){
			?>
			<script>
				alert("SPP bulan tersebut sudah dibayar");
				window.history.back();
				//window.location = '../Admin_controller/Tampilsar_spp_formtambahrekapspp';
				</script>
				<?php 
		}else{
			session_start();
		$_SESSION['nisn'] = $nisn ;
		$_SESSION['bulan_spp'] =$bulan_spp ;
		 $_SESSION['jumlah_spp'] =  $jumlah_spp;
		 $_SESSION['status_spp'] =  $status_spp ;
		 $_SESSION['tanggalbayar_spp'] = $tanggalbayar_spp;
		$_SESSION['id_tahunsemester']=$id_tahunsemester;
$_SESSION['id_kelas']=$id_kelas;

		redirect('Admin_controller/Sar_spp_tambahrekapspp');
		}

?>
	
					

