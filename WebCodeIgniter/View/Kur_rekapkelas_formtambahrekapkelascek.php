<!DOCTYPE html>
<?php 
include 'koneksi.php';


$id_tahunsemester = $_SESSION['id_tahunsemester'] ;
$id_kelas = $this->input->post('id_kelas');

$i = 1;
while (isset($_POST['nisn'.$i])){
	if (isset($_POST['pilihan'.$i])){
	$nisn = $_POST['nisn'.$i];
	$cek = "select * from rekapkelas where nisn = '$nisn' AND id_kelas = '$id_kelas' AND id_tahunsemester = '$id_tahunsemester'";
	$cekquery = mysqli_query($conn,$cek);
	if (mysqli_num_rows($cekquery) > 0){
		?>
			<script>
				alert("Rekap kelas untuk <?php echo $nisn ;?> tersebut sudah ada");

				//window.location = '../Admin_controller/Tampilkur_nilai_formtambahnilai';
			</script>
				<?php
 
	}else{
	$nisn = $_POST['nisn'.$i];
	$this->Admin_model->tambahDataRekapkelas($nisn,$id_kelas,$id_tahunsemester);
		
	}}
$i++;
		}
		redirect('Admin_controller/Tampilkur_rekapkelas_rekapkelaspertahunkembali?id_tahunsemester='.$id_tahunsemester);
?>	