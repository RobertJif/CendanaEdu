<?php include 'Kur_header.php';?>





    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <div class="col-xs-12">
 
          <div class="box">

            <div class="box-header">
              <h3 class="box-title">   
              <table>
                <tr>
                  <td style="font-size:34px">Daftar Siswa</td>
                </tr>
             
            </table>
               </h3>
           

            <a href="<?php echo site_url('Admin_controller/Tampilkur_siswa_formtambahsiswa')?>">   
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
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Agama</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Nama Ayah</th>
                  <th>Nama Ibu</th>
                  <th>Telepon</th>
                  <th>Status</th>

                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                 <?php $no = 1;

               foreach ($siswa as $row) { 
                ?>

                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $row['nisn'];?></td>
                  <td><?php echo $row['nama_siswa'];?></td>
                  <td><?php echo $row['tempatlahir'];?></td>
                  <td><?php echo $row['tanggallahir'];?></td>
                  <td><?php echo $row['agama'];?></td>
                  <td><?php echo $row['jeniskelamin'];?></td>
                  <td><?php echo $row['alamat'];?></td>
                  <td><?php echo $row['nama_ayah'];?></td>
                  <td><?php echo $row['nama_ibu'];?></td>
                  <td><?php echo $row['telepon'];?></td>
                  <td><?php if ($row['status'] == 1){
                    echo "Aktif";
                  }else {echo "Tidak Aktif";}?></td>

                  
                  <td><a href="<?php echo site_url('Admin_controller/Tampilkur_siswa_formeditsiswa?nisn='.$row['nisn'])?>">Edit</a></td>
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


