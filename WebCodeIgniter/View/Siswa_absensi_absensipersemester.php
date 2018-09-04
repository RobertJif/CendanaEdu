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
                  <td style="font-size:34px">Daftar Absensi</td>
                </tr>
             
            </table>
               </h3>
           

     <a href="<?php echo site_url('Siswa_controller/Tampilsiswa_absensi')?>">   
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
                  </tr>
                </thead>
                <tbody>
                 <?php $no = 1;

               foreach ($absensi as $row) { 
                ?>

                <tr>
                  <td><?php echo $no;?></td>
                  <td>
                    <a href="<?php echo site_url('Siswa_controller/Tampilsiswa_absensi_absensipermatpel?id_matapelajaran='.$row->id_matapelajaran )?>">
                    <?php echo $row->nama_matapelajaran;?>
                    </a>
                  </td>
                 
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


