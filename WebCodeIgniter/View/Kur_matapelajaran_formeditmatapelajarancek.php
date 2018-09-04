<!DOCTYPE html>
<?php 
include 'koneksi.php';
		$id_matapelajaran = $_POST['id_matapelajaran'];
		$id_kategorikelas = $_POST['id_kategorikelas'];
		$id_jurusan = $_POST['id_jurusan'];
		$id_semester = $_POST['id_semester'];
		$nama_matapelajaran = $_POST['nama_matapelajaran'];

	

		$cek = "select * from kelas where id_kategorikelas = '$id_kategorikelas' AND id_jurusan = '$id_jurusan' AND nama_kelas = '$nama_kelas'";
		$cekquery = mysqli_query($conn,$cek);
		if (mysqli_num_rows($cekquery) > 0){
			?>
			<script>
				alert("Nama mata pelajaran tersebut sudah ada");	
				window.history.back();
				</script>
				<?php 
		}else{
			session_start();
		$_SESSION['id_matapelajaran'] = $id_matapelajaran;	
		$_SESSION['id_kategorikelas'] = $id_kategorikelas ;
		$_SESSION['id_jurusan'] = $id_jurusan ;
		$_SESSION['nama_matapelajaran'] =$nama_matapelajaran ;
		$_SESSION['id_semester'] = $id_semester; 	
		redirect('Admin_controller/Kur_matapelajaran_editmatapelajaran');
		}
?>	