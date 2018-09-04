<?php include 'Perpus_header.php';
include 'koneksi.php'
?>


    <section class="content-header">
      
      <h1>Selamat Datang Admin <?php echo $this->session->userdata('loger')?>  </h1>
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
              $querytotalbuku = "select * from buku";
              $sqltotalbuku = mysqli_query($conn,$querytotalbuku);
              $totalbuku = mysqli_num_rows($sqltotalbuku); ?>  
                <h3><?php echo $totalbuku; ?></h3>
              
              <p>Jumlah buku</p>
            </div>
            <div class="icon">
              <i class="ion ion-navicon"></i>
            </div>
            <a href="<?php echo site_url('Admin_controller/Tampilperpus_buku_jenisbuku')?>" class="small-box-footer">Informasi lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">

  <?php 
              $querytotalpeminjamanbuku = "select * from peminjamanbuku";
              $sqltotalpeminjamanbuku = mysqli_query($conn,$querytotalpeminjamanbuku);
              $totalpeminjamanbuku = mysqli_num_rows($sqltotalpeminjamanbuku); ?>  
                <h3><?php echo $totalpeminjamanbuku; ?></h3>
             <p>Peminjaman buku  </p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
             <a href="<?php echo site_url('Admin_controller/Tampilperpus_buku')?>" class="small-box-footer">Informasi lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

            


             
            
        <!-- ./col -->
        
       
      </div>
    </section>

<?php include 'Perpus_footer.php'?>