<?php include 'Kur_header.php'?>
<?php
include 'koneksi.php';
$id_tahunsemester = $_SESSION['id_tahunsemester'];

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
                  <td style="font-size:34px">Daftar Rekap Kelas</td>
                </tr>
                <?php foreach ($sqltahunajaran as $row) {?>
                  <tr>   
                  <td><?php echo " Tahun ajaran  ",$row['nama_tahunajaran']," - Semester ",$row['nama_semester']; }?><td>
                  </tr>
            </table>
               </h3>
             <a href="<?php echo site_url('Admin_controller/Tampilkur_rekapkelas')?>">   
              <button style="float:right;margin-right:15px" type="button" class="btn btn-primary "> 
                Kembali
              </button>
            </a>


            <a href="<?php echo site_url('Admin_controller/Tampilkur_rekapkelas_formtambahrekapkelas')?>">   
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
                  <th>Nama Kelas</th>
                    
                </tr>
                </thead>
                <tbody>
                 <?php $no = 1;

               foreach ($kelaspertahun as $row) { 
                ?>

                <tr>
                  <td><?php echo $no;?></td>
                  <td>
<a href="<?php echo site_url('Admin_controller/Tampilkur_rekapkelas_rekapkelasperkelas?id_kelas='.$row->id_kelas.'&id_tahunsemester='.$row->id_tahunsemester  )?>">
                    <?php echo $row->nama_kategorikelas.' '.$row->nama_jurusan.' '.$row->nama_kelas;?>
</a>
                  </td>
                     
                </tr>
               <?php $no++; }?>
                </tbody>
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
<?php include 'Kur_footer.php'?>


