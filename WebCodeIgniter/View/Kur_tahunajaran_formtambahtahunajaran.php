<?php include 'Kur_header.php';?>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
  function validateForm(){
   var v = document.forms["myForm"]["nama_tahunajaran"].value;
    
    if (v == ""){
      alert("Nama tahun ajaran harus diisi");
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
       <a href="<?php echo site_url('Admin_controller/Tampilkur_tahunajaran')?>">   
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
            <center>  <h3 class="box-title"> Form Tambah Tahun Ajaran</h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
               <form role="form" action="<?php echo site_url('Admin_controller/Tampilkur_tahunajaran_formtambahtahunajarancek')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
          

             

          <div class="form-group">
                  <label for="tahunajaran">Tahun Ajaran</label>
                  <input type="text" class="form-control" name="nama_tahunajaran" id="nama_tahunajaran" placeholder="Masukkan nama tahun ajaran" >
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