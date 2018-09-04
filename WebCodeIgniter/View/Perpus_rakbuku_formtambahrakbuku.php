<?php include 'Perpus_header.php';?>


  <script>
  function validateForm(){
   var v = document.forms["myForm"]["nama_rakbuku"].value;
    
    if (v == ""){
      alert("Nama rak buku harus diisi");
      return false;
    }
  }
    
    function updateTextInput(val) {
          document.getElementById('textInput').value=val; 
        }
</script>



    <section class="content-header">
      <h1>
       

      </h1>
       <ol class="breadcrumb">
       <a href="<?php echo site_url('Admin_controller/Tampiperpus_rakbuku')?>">   
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
            <center>  <h3 class="box-title"> Form Tambah Rak Buku</h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <form role="form" action="<?php echo site_url('Admin_controller/Perpus_rakbuku_tambahrakbuku')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
          


                <div class="form-group">
                  <label for="nama_rakbuku">Nama Rak Buku</label>
                  <input type="text" class="form-control" name="nama_rakbuku" id="nama_rakbuku"/>
                   
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