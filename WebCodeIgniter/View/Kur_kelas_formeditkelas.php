<?php include 'Kur_header.php';
      include 'koneksi.php';
?>


  <script>
  function validateForm(){
    var w = document.forms["myForm"]["nama_kelas"].value;

    
    if (w == ""){
      alert("Nama kelas harus diisi");
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
     <a href="<?php echo site_url('Admin_controller/Tampilkur_kelas')?>">   
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
            <center>  <h3 class="box-title"> Form Edit Kelas</h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <?php 
                if ($dataEditKelas){
                  $id_kelas = $dataEditKelas->id_kelas;
                  $nama_kelas = $dataEditKelas->nama_kelas;
                  $id_jurusan = $dataEditKelas->id_jurusan;
                  $id_kategorikelas = $dataEditKelas->id_kategorikelas;
                }  else{
                    $id_kelas = "";
                  $nama_kelas = "";
                  $id_jurusan = "";
                  $id_kategorikelas = "";

                  }

              ?>


               <form role="form" action="<?php echo site_url('Admin_controller/Tampilkur_kelas_formeditkelascek')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
            
          <input type="hidden" name="id_kelas" value="<?php echo $id_kelas?>"></input>
          <input type="hidden" name="id_jurusan" value="<?php echo $id_jurusan?>"></input>
          <input type="hidden" name="id_kategorikelas" value="<?php echo $id_kategorikelas?>"></input>

                <div class="form-group">
                  <label for="eksul">Nama Kelas</label>
                  <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" value="<?php echo $nama_kelas;?> " >
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