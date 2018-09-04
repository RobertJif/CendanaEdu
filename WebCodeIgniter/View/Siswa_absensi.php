<?php 

include 'Siswa_header.php';
include 'koneksi.php';
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
  function validateForm(){
    var w = document.forms["myForm"]["id_tahunsemester"].value;
    
    if (w == ""){
      alert("Tahun Ajaran harus dipilih");
      return false;
    } 
  }
    
    function updateTextInput(val) {
          document.getElementById('textInput').value=val; 
        }
</script>

   <section class="content-header" >
      <h1>
        Absensi Siswa
        <small>SMA Cendana Pekanbaru</small>
      </h1>
      <ol class="breadcrumb">
    
      </ol>
    </section>
 
    <!-- Main content -->
    <section class="content">
      <div class="row" >
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            
               <form role="form" action="<?php echo base_url('Siswa_controller/Tampilsiswa_absensi_absensipersemester')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
         

        


               <div class="form-group">
                  <label for="Tahunajaran">Pilih Tahun Ajaran dan Semester</label>
                  <select class="form-control" name="id_tahunsemester" id="id_tahunsemester">
                  <option  value = "" >-- Pilih Tahun ajaran dan semester --</option>
                            <?php 
                         foreach ($tahunsemester as $value) {?>
                  <option value="<?php echo $value->id_tahunsemester."|".$value->id_semester ?>"> <?php echo $value->nama_tahunajaran." - Semester ".$value->nama_semester?> </option>
                      <?php  }
                    ?>
                  </select>
                  </div>

                 
           



            
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



  <!-- /.content-wrapper -->
<?php include 'Siswa_footer.php'?>