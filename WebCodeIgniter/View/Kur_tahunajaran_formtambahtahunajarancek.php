<!DOCTYPE html>
<?php 
include 'koneksi.php';
		$nama_tahunajaran = $_POST['nama_tahunajaran'];

	

		$cek = "select * from tahunajaran where nama_tahunajaran = '$nama_tahunajaran'";
		$cekquery = mysqli_query($conn,$cek);
		if (mysqli_num_rows($cekquery) > 0){
			?>
			<script>
				alert("Nama Tahun ajaran tersebut sudah ada");	
				window.history.back();
				</script>
				<?php 
		}else{
			session_start();
		$_SESSION['nama_tahunajaran'] =$nama_tahunajaran ;
		 	
		redirect('Admin_controller/Kur_tahunajaran_tambahtahunajaran');
		}
?>	