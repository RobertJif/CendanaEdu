<?php include 'Siswa_header.php';?>

    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <div class="col-xs-12">
 
          <div class="box">

            <div class="box-header">
              <h3 class="box-title">   
              <table>
                <tr>
                  <td style="font-size:34px">Daftar Ekskul</td>
                </tr>
             
            </table>
               </h3>
           

           <!-- <a href="<?php echo site_url('Admin_controller/Tampilkes_pengumuman_formtambahpengumuman')?>">   
              <button style="float:right;margin-right:15px" type="button" class="btn btn-primary "> 
                Tambah
              </button>
            </a> -->
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Ekstrakulikuler yang pernah diikuti</th>
                  <th>Waktu</th>
                </tr>
                </thead>
                <tbody>
                 <?php $no = 1;

               foreach ($ekskul as $row) { 
                ?>

                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $row->nama_ekskul;?></td>
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


