<?php include 'Siswa_header.php';
$id_tahunsemester = $_SESSION['id_tahunsemester'];
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
                  <td style="font-size:34px">Daftar Absensi</td>
                </tr>
             
            </table>
               </h3>
           

           <a href="<?php echo site_url('Siswa_controller/Tampilsiswa_absensi_absensipersemesterkembali?id_tahunsemester='.$id_tahunsemester)?>">   
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
                  <th>No.</th>
                  <th>Mata Pelajaran</th>
                  <th>Tanggal</th>
                  <th>Jumlah Jam</th>
                  <th>Keterangan </th>
                  <th>Tahun Ajaran</th>
                </tr>
                </thead>
                <tbody>
                 <?php $no = 1;

               foreach ($absensi as $row) { 
                ?>

                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $row->nama_matapelajaran;?></td>
                  <td><?php echo date("d-M-Y",strtotime($row->tanggal_absensi));?></td>
                  <td><?php echo $row->jumlahjam_absensi;?></td>
                  <td><?php echo $row->keterangan_absensi;?></td>
                  <td>Tahun Ajaran <?php echo $row->nama_tahunajaran;?> Semester <?php echo $row->nama_semester;?></td>
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
<?php include 'Kes_footer.php'?>


