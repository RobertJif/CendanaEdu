<?php include 'Kur_header.php';
$id_tahunsemester = $_SESSION['id_tahunsemester'];
?>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
  function validateForm(){
   var v = document.forms["myForm"]["id_kelas"].value;
    var w = document.forms["myForm"]["id_jurusan"].value;
    
    if (v == ""){
      alert("Kelas harus dipilih");
      return false;
    }else if (w == ""){
      alert("Jurusan harus diisi");
      return false;
    }}
    
    function updateTextInput(val) {
          document.getElementById('textInput').value=val; 
        }


</script>



    <section class="content-header">
      <h1>
       

      </h1>
       <ol class="breadcrumb">
       <a href="<?php echo site_url('Admin_controller/Tampilkur_rekapkelas_rekapkelaspertahunkembali?id_tahunsemester='.$id_tahunsemester)?>">   
              <button style="float:right;margin-right:15px" type="button" class="btn btn-primary "> 
                Kembali
              </button>
            </a>
       
      </ol>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row" style="margin-left:250px;margin-right:-250px">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            <center>  <h3 class="box-title"> Form Tambah Rekap Kelas</h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
               <form role="form" action="<?php echo site_url('Admin_controller/Tampilkur_rekapkelas_formtambahrekapkelascek')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
          

                          
           
              <table id="example1" class="table table-bordered table-striped">
                 <div class="form-group">
                  <label for="kelas">Pilih Kelas</label>
                  <select class="form-control" id="id_kelas" name="id_kelas" >
                  <option  value = "" >-- Pilih Kelas --</option>
                            <?php 
                         foreach ($kelas as $value) {?>
                  <option value="<?php echo $value->id_kelas ?>"> <?php echo $value->nama_kategorikelas." ".$value->nama_jurusan." ".$value->nama_kelas ?> </option>
                      <?php  }
                    ?>
                  </select>
                  </div>
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                 

                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                 <?php $i = 1;

               foreach ($siswabelumberkelas as $row) { 
                ?>

                <tr>
                  <td><?php echo $i;?></td>
                  <td><input type="hidden" name="nisn<?= $i?>" id="nisn" value="<?php echo $row->nisn; ?>" ><?php echo $row->nisn;?></input> </td>
                  <td><?php echo $row->nama_siswa;?></td>
                  

                  
                  <td><input type='checkbox' name='pilihan<?= $i?>'  font size='4'></input></td>
                </tr>
               <?php $i++; }?>
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
            <!-- /.box-body -->
              
            
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <center>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </center>
              </div>
            </form>

                  </div>
          <!-- /.box -->

         

        </div>
        <!--/.col (left) -->
        <!-- right column -->
       
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


<?php include 'Kur_footer.php'?>