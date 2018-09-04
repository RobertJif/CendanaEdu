<!DOCTYPE html>
<?php 
include 'koneksi.php';
		$id_tahunajaran = $_POST['id_tahunajaran'];
		$id_semester = $_POST['id_semester'];
	
		$cek = "select * from rekaptahunsemester where id_tahunajaran = '$id_tahunajaran' AND id_semester = '$id_semester'";
		$cekquery = mysqli_query($conn,$cek);
		if (mysqli_num_rows($cekquery) > 0){
			?>
			<script>
				alert("Tahun Semester tersebut sudah ada");
				window.location = '../Admin_controller/Tampilkur_tahunsemester_formedittahunsemester';
				</script>
				<?php 
		}else{
			session_start();
		$_SESSION['id_tahunajaran'] = $id_tahunajaran ;
		$_SESSION['id_semester'] = $id_semester ;
			
		redirect('Admin_controller/Kur_tahunsemester_edittahunsemester');
		}
?>	