<?php include 'Kur_header.php';
      include 'koneksi.php';
?>


  <script>
  function validateForm(){
    var w = document.forms["myForm"]["nama_matapelajaran"].value;

    
    if (w == ""){
      alert("Nama mata pelajaran harus diisi");
      return false;
    }
  }
    
    function updateTextInput(val) {
          document.getElementById('textInput').value=val; 
        }
</script>



    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       

      </h1>
     <a href="<?php echo site_url('Admin_controller/Tampilkur_matapelajaran')?>">   
              <button style="float:right;margin-right:15px" type="button" class="btn btn-primary "> 
                Kembali
              </button>
            </a>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row" style="margin-left:250px;margin-right:-250px">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            <center>  <h3 class="box-title"> Form Edit Mata Pelajaran</h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <?php 
                if ($dataEditMataPelajaran){
                  $id_matapelajaran = $dataEditMataPelajaran->id_matapelajaran;
                  $nama_matapelajaran = $dataEditMataPelajaran->nama_matapelajaran;
                  $id_jurusan = $dataEditMataPelajaran->id_jurusan;
                  $id_kategorikelas = $dataEditMataPelajaran->id_kategorikelas;
                  $id_semester = $dataEditMataPelajaran->id_semester;
                }  else{
                  $id_matapelajaran = "";
                  $nama_matapelajaran = "";
                  $id_jurusan = "";
                  $id_kategorikelas = "";
                  $id_semester = "";
  
                  }

              ?>


               <form role="form" action="<?php echo site_url('Admin_controller/Tampilkur_matapelajaran_formeditmatapelajarancek')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
            
          <input type="hidden" name="id_matapelajaran" value="<?php echo $id_matapelajaran?>"></input>
          <input type="hidden" name="id_jurusan" value="<?php echo $id_jurusan?>"></input>
          <input type="hidden" name="id_kategorikelas" value="<?php echo $id_kategorikelas?>"></input>
          <input type="hidden" name="id_semester" value="<?php echo $id_semester?>"></input>
                <div class="form-group">
                  <label for="matapelajaran">Nama Mata Pelajaran</label>
                  <input type="text" class="form-control" name="nama_matapelajaran" id="nama_matapelajaran" value="<?php echo $nama_matapelajaran;?> " >
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

<?php include 'Kur_footer.php'?>