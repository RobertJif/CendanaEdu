<?php include 'Perpus_header.php';
      include 'koneksi.php';
?>


  <script>
  function validateForm(){
    var w = document.forms["myForm"]["nama_rakbuku"].value;
    
    if (w == ""){
      alert("Nama rak buku harus diisi");
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
     <a href="<?php echo site_url('Admin_controller/Tampilperpus_rakbuku')?>">   
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
            <center>  <h3 class="box-title"> Form Edit Rak Buku</h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <?php 
                if ($dataEditRakBuku){
                  $id_rakbuku = $dataEditRakBuku->id_rakbuku;
                  $nama_rakbuku = $dataEditRakBuku->nama_rakbuku;
                }  else{
                    $id_rakbuku = "";
                  $nama_rakbuku = "";
                  }

              ?>


               <form role="form" action="<?php echo site_url('Admin_controller/Perpus_rakbuku_editrakbuku')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
            
          <input type="hidden" name="id_buku" value="<?php echo $id_rakbuku?>"></input>
                <div class="form-group">
                  <label for="eksul">Nama Rak Buku</label>
                  <input type="text" class="form-control" name="nama_rakbuku" id="nama_rakbuku" value="<?php echo $nama_rakbuku;?> " >
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

<?php include 'Perpus_footer.php'?>