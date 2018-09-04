<?php include 'Kur_header.php';
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
              <table  style="font-size:23px">
                <tr>
  <td style="font-size:34px">Daftar Rekap Kelas</td>
                </tr>
                <?php foreach ($sqlnamakelas as $data) {?>
              <tr>
               <td><?php echo "Kelas : ",$data['nama_kategorikelas']," ",$data['nama_jurusan']," ",$data['nama_kelas']; ?><td>
               </tr>
               <tr>
                  <?php foreach ($sqltahunajaran as $row) {?>
                   <td><?php echo " Tahun ajaran  ",$row['nama_tahunajaran']," - Semester ",$row['nama_semester']; }?><td>
               </tr> 
         <?php
        
        } ?>
      </table>
               </h3>
            
      <a href="<?php echo site_url('Admin_controller/Tampilkur_rekapkelas_rekapkelaspertahunkembali?id_tahunsemester='.$id_tahunsemester)?>">   
              <button style="float:right;margin-right:15px" type="button" class="btn btn-primary "> 
                Kembali
              </button>
            </a>



        

            </div>
           

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                   <th>Nama Siswa</th>
                    
                </tr>
                </thead>
                <tbody>
                 <?php $no = 1;
               foreach ($rekapkelasperkelas as $data) { ?>
                <tr>
                
                  <td>                                      
                   <?php echo $no;?>
                  </td>  

                    <td><?php echo $data->nisn ?></td>
                    <td><?php echo $data->nama_siswa ?></td>
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




  <?php include 'Kur_footer.php'?>