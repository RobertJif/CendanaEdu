<?php include 'Sar_header.php'?>
<?php
include 'koneksi.php';
$id_tahunsemester = $_SESSION['id_tahunsemester'];
$id_kelas = $_SESSION['id_kelas'];
$kelas = 'kelas';
$querynamakelas = "select * from $kelas where id_kelas = '$id_kelas'";
$sqlnamakelas = mysqli_query($conn,$querynamakelas); 

$querytahunajaran = "select * from rekaptahunsemester join tahunajaran join semester on rekaptahunsemester.id_tahunajaran = tahunajaran.id_tahunajaran AND rekaptahunsemester.id_semester = semester.id_semester where rekaptahunsemester.id_tahunsemester = '$id_tahunsemester'";
$sqltahunajaran = mysqli_query($conn,$querytahunajaran); 
?>




    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <div class="col-xs-12">
 
          <div class="box">

            <div class="box-header">
              <h3 class="box-title">   
              <table>
                <tr>
                  <td style="font-size:34px">Rekap Pembayaran SPP </td>
                </tr>
                <?php foreach ($sqlnamakelas as $namakelas) {?>
              <tr>
                <td><?php echo " Kelas: ",$namakelas['nama_kelas']; }?><td>
                <?php foreach ($sqltahunajaran as $row) {?>
              </tr>
                  <tr>   
                  <td><?php echo " Tahun ajaran  ",$row['nama_tahunajaran']," - Semester ",$row['nama_semester']; }?><td>
                  </tr>
            </table>
               </h3>
             <a href="<?php echo site_url('Admin_controller/Tampilsar_spp')?>">   
              <button style="float:right;margin-right:15px" type="button" class="btn btn-primary "> 
                Kembali
              </button>
            </a>


            <a href="<?php echo site_url('Admin_controller/Tampilsar_spp_formtambahrekapspp')?>">   
              <button style="float:right;margin-right:15px" type="button" class="btn btn-primary "> 
                Tambah
              </button>
            </a>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
               <thead>
                <tr>
                  <th>No</th>
                   <th>Nama </th>
                   <th>Bulan</th> 
                  <th>Jumlah</th>
                  <th>Status</th>
                  <th>Tanggal Pembayaran</th>
                  <th>Aksi</th>
                </tr>
                </thead>
              <tbody>
                 <?php $no = 1;
               foreach ($sppperkelas as $row) { ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $row->nama_siswa?></td>
                  <td><?php 
                     $bulan = date("M",strtotime($row->bulan_spp)) ;
                  echo $bulan." ".date("Y",strtotime($row->bulan_spp));
                  ?></td>
                  <td><?php echo $row->jumlah_spp?></td>
                  <td><?php echo $row->status_spp?></td>
                  <td><?php 
                    
                   $bulans = date("M",strtotime($row->tanggalbayar_spp)) ;
                   echo date("d",strtotime($row->tanggalbayar_spp))." ".$bulans." ".date("Y",strtotime($row->tanggalbayar_spp))?></td>
                  <td><a href="<?php echo site_url('Admin_controller/Tampilsar_spp_formeditrekapspp?id_rekapspp='.$row->id_rekapspp)?>">Edit</a></td>
                </tr>
               <?php $no++; }?>
                </tbody>
             <!--<tfoot>
                <tr>
                  <th>No</th>
                  <th>Nama Mata Pelajaran</th>
                 <th>Nilai Harian</th>
                  <th>Nilai UTS</th>
                  <th>Nilai UAS</th>
                   <th>Aksi</th>
                </tr>
                </tfoot>-->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php include 'Sar_footer.php'?>


