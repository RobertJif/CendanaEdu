<?php include 'Siswa_header.php';
include 'koneksi.php';

$nisn = $_SESSION['nisn'];
if (empty($_SESSION['nisn'])){
  echo "<script language='javascript' type='text/javascript'>
  alert('Kodenya dah gaada...!!!');

  </script>";
}else{
$today = date('Y-m-d');
$sql = "SELECT * FROM peminjamanbuku p join buku b on p.id_buku = b.id_buku WHERE p.nisn = '$nisn' AND p.tanggal_kembali < '$today' AND p.keterangandenda IS NULL";
$cek = mysqli_query($conn,$sql);
$count = mysqli_num_rows($cek);
if ($count > 0){?>
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
           
            <div class="box-body">
    
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">
                <?php foreach ($cek as $row) {
                  
                echo "Anda belum mengembalikan buku ".$row['nama_buku'] ." yang sudah jatuh tempo pada tanggal ".date('d M Y',strtotime($row['tanggal_kembali']))."<br>";
              }
                ?>
              </button>
             </div>
          </div>
        </div>
      </div>
<?php }else {}
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
   
      <h1>Selamat Datang <?php echo $this->session->userdata('loger')?>  </h1>
      <ol class="breadcrumb">
 
  
</ol>
    </section>

 <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php 
              $querytotalprestasi = "select * from prestasi where nisn ='$nisn'";
              $sqltotalprestasi = mysqli_query($conn,$querytotalprestasi);
              $totalprestasi = mysqli_num_rows($sqltotalprestasi); ?>  
                <h3><?php echo $totalprestasi; ?></h3>
              
              <p>Prestasi yang pernah diraih</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="<?php echo site_url('Siswa_controller/Tampilsiswa_prestasi')?>" class="small-box-footer">Informasi lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">


              <?php 
              $querytotalekskul = "select * from rekapekskul where nisn ='$nisn'";
              $sqltotalekskul = mysqli_query($conn,$querytotalekskul);
              $totalekskul = mysqli_num_rows($sqltotalekskul); ?>  
                <h3><?php echo $totalekskul; ?></h3>


              <p>Ekskul yang pernah diikuti </p>
            </div>
            <div class="icon">
              <i class="ion ion-filing"></i>
            </div>
            <a href="<?php echo site_url('Siswa_controller/Tampilsiswa_ekskul')?>" class="small-box-footer">Informasi lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
         <?php 
              $querytotalpelanggaran = "select * from rekappelanggaran where nisn ='$nisn'";
              $sqltotalpelanggaran = mysqli_query($conn,$querytotalpelanggaran);
              $totalpelanggaran = mysqli_num_rows($sqltotalpelanggaran); ?>  
                <h3><?php echo $totalpelanggaran; ?></h3>


              <p>peraturan yang pernah dilanggar</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert"></i>
            </div>
            <a href="<?php echo site_url('Siswa_controller/Tampilsiswa_pelanggaran')?>" class="small-box-footer">Informasi lebih lanjut<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </section>

<?php }?>
  <!-- /.content-wrapper -->




  <?php include 'Siswa_footer.php'?>