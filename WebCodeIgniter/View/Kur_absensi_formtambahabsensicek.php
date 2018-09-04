<!DOCTYPE html>
<?php 
include 'koneksi.php';

$id_kelas = $_SESSION['id_kelas'];
$id_semester = $_SESSION['id_semester'];
$id_jurusan =   $_SESSION['id_jurusan'];
$id_kategorikelas = $_SESSION['id_kategorikelas'] ;
$id_tahunsemester = $_SESSION['id_tahunsemester'] ;
$id_matapelajaran = $_SESSION['id_matapelajaran'];
$tanggal_absensi = $_POST['tanggal_absensi'] ;
$jumlahjam_absensi = $_POST['jumlahjam_absensi'];

$i = 1;
while (isset($_POST['nisn'.$i])){
	$nisn = $_POST['nisn'.$i];

	$cek = "select * from absensi where nisn = '$nisn' AND id_matapelajaran = '$id_matapelajaran' AND tanggal_absensi = '$tanggal_absensi'";
	$cekquery = mysqli_query($conn,$cek);
	if (mysqli_num_rows($cekquery) > 0){
		?>
			<script>
				alert("Absen untuk <?php echo $nisn ;?> tersebut sudah ada");

				//window.location = '../Admin_controller/Tampilkur_nilai_formtambahnilai';
			</script>
				<?php
 
	}else{
	
		$answer = $_POST['pilihan'.$i];
		$nisnnya = $_POST['nisn'.$i];
		$this->Admin_model->tambahDataAbsensi($tanggal_absensi,$jumlahjam_absensi,$answer,$nisnnya,$id_kelas,$id_matapelajaran,$id_tahunsemester);
		
	}
$i++;
		}
		redirect('Admin_controller/Tampilkur_absensi_absensiperkelaskembali?id_tahunsemester='.$id_tahunsemester.'&id_kelas='.$id_kelas.'&id_matapelajaran='.$id_matapelajaran);
?>	