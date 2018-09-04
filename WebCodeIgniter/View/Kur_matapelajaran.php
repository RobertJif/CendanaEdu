<?php include 'Kur_header.php'?>
<?php
include 'koneksi.php';

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
                  <td style="font-size:34px">Daftar Mata Pelajaran</td>
                </tr>
          
                
            </table>
               </h3>
           


            <a href="<?php echo site_url('Admin_controller/Tampilkur_matapelajaran_formtambahmatapelajaran')?>">   
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
                  <th>Nama Mata Pelajaran</th>
                  <th>Kelas</th>
                  <th>Semester</th>
                    
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                 <?php $no = 1;

               foreach ($matapelajaran as $row) { 
                ?>

                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $row->nama_matapelajaran?></td>
                  <td><?php echo $row->nama_kategorikelas.' '.$row->nama_jurusan;?></td>
                  <td><?php echo $row->nama_semester;?></td>
                  
                  <td><a href="<?php echo site_url('Admin_controller/Tampilkur_matapelajaran_formeditmatapelajaran?id_matapelajaran='.$row->id_matapelajaran)?>">Edit</a></td>
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
<?php include 'Kur_footer.php'?>


