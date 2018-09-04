<?php include 'Perpus_header.php';?>
<?php
include 'koneksi.php';
$id_tahunsemester = $_SESSION['id_tahunsemester'];
$id_kelas = $_SESSION['id_kelas'];

$querynamakelas = "select * from kelas join kategorikelas join jurusan on kelas.id_jurusan = jurusan.id_jurusan AND kelas.id_kategorikelas = kategorikelas.id_kategorikelas  where kelas.id_kelas = '$id_kelas'";
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
                  <td style="font-size:34px">Daftar Peminjaman Buku</td>
                </tr>
                <?php foreach ($sqlnamakelas as $namakelas) {?>
              <tr>
                <td><?php echo " Kelas: ",$namakelas['nama_kategorikelas']," ",$namakelas['nama_jurusan']," ",$namakelas['nama_kelas']; }?><td>
               <?php foreach ($sqltahunajaran as $row) {?>
              </tr>
                  <tr>   
                  <td><?php echo " Tahun ajaran  ",$row['nama_tahunajaran']," - Semester ",$row['nama_semester']; }?><td>
                  </tr>
            </table>
               </h3>
             <a href="<?php echo site_url('Admin_controller/Tampilperpus_buku')?>">   
              <button style="float:right;margin-right:15px" type="button" class="btn btn-primary "> 
                Kembali
              </button>
            </a>


            <a href="<?php echo site_url('Admin_controller/Tampilperpus_buku_formtambahpeminjamanbuku')?>">   
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
                  <th>Nama Siswa</th>
                   <th>Judul Buku</th> 
                    <th>Jumlah</th> 
                    <th>Tanggal Pinjam</th> 
                    <th>Tanggal Jatuh Tempo</th> 
                    <th>Tanggal Mengembalikan</th> 
                    <th>Keterangan Denda</th> 
                  <th>Keterangan Buku</th>
                </tr>
                </thead>
                <tbody>
                 <?php $no = 1;

               foreach ($buku as $row) { 
                ?>

                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $row->nama_siswa;?></td>
                  <td><?php echo $row->nama_buku;?></td>
                  <td><?php echo $row->jumlah_buku;?></td>
                  <td>
                    <?php echo date("d",strtotime($row->tanggal_pinjam))." ".date("M",strtotime($row->tanggal_pinjam))." ".date("Y",strtotime($row->tanggal_pinjam));?>
                  </td>
                  <td>
                                      <?php echo date("d",strtotime($row->tanggal_kembali))." ".date("M",strtotime($row->tanggal_kembali))." ".date("Y",strtotime($row->tanggal_kembali));?>
                  </td>
                  <td><?php 
                     if (isset($row->tanggal_kembalisiswa)){
                     echo date("d",strtotime($row->tanggal_kembalisiswa))." ".date("M",strtotime($row->tanggal_kembalisiswa))." ".date("Y",strtotime($row->tanggal_kembalisiswa));
                     }else {
                      echo "Belum Mengembalikan";
                     }
                      
                  ?></td>
                  <td>
                    <?php 
                     if (isset($row->keterangandenda)){
                      echo $row->keterangandenda;
                     }else {
                      echo "-";
                     }
                      
                  ?>
                </td>
                 <td>
                  <?php if (isset($row->tanggal_kembalisiswa)){
                    echo "Sudah kembali"; 
                  }
                  else{ ?>
<a href="<?php echo site_url('Admin_controller/Tampilperpus_buku_formeditpeminjamanbuku?id_peminjamanbuku='.$row->id_peminjamanbuku)?>">Ingin mengembalikan?</a></td>
                  
              <?php  } ?>
                  
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
<?php include 'Perpus_footer.php'?>


