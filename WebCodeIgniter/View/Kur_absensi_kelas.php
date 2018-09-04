<?php include 'Kur_header.php';
include 'koneksi.php';
$id_tahunajaran = $_SESSION['id_tahunajaran'];
$id_jurusan = $_SESSION['id_jurusan'];
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pilih Kelas
        <small>SMA Cendana Pekanbaru</small>
      </h1>
      <ol class="breadcrumb">
          <a href="<?php echo site_url('Admin_controller/Tampilkur_absensi_jurusan?id_tahunajaran='.$id_tahunajaran)?>">   
              <button style="float:right;margin-right:15px" type="button" class="btn btn-primary "> 
                Kembali 
              </button>
            </a>
      </ol>
    </section>
	<section class="content">
  <div class="row">
  <?php foreach($hasilkelas as $data) : ?>  
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Kelas</span>
              <span class="info-box-number">
                <a href="<?php echo site_url('Admin_controller/Tampilkur_absensi_absensiperkelas?id_kelas='.$data['id_kelas'] )?>">
                <?php echo $data['nama_kelas'];?>
                </input> 
                </a> 
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
   
     <?php endforeach ?> 
      </div>
      <!-- /.row -->
  </section>
</div>

  <?php include 'Kur_footer.php'?>