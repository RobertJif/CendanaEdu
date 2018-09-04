<!DOCTYPE html>
<?php 
include 'koneksi.php';
		$id_kategorikelas = $_POST['id_kategorikelas'];
		$id_jurusan = $_POST['id_jurusan'];
		$nama_kelas = $_POST['nama_kelas'];

	

		$cek = "select * from kelas where id_kategorikelas = '$id_kategorikelas' AND id_jurusan = '$id_jurusan' AND nama_kelas = '$nama_kelas'";
		$cekquery = mysqli_query($conn,$cek);
		if (mysqli_num_rows($cekquery) > 0){
			?>
			<script>
				alert("Nama Kelas tersebut sudah ada");	
				window.history.back();
				</script>
				<?php 
		}else{
			session_start();
		$_SESSION['id_kategorikelas'] = $id_kategorikelas ;
		$_SESSION['id_jurusan'] = $id_jurusan ;
		$_SESSION['nama_kelas'] =$nama_kelas ;
		 	
		redirect('Admin_controller/Kur_kelas_tambahkelas');
		}
?>	