<?php include 'Kur_header.php';?>

<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
  function validateForm(){
   var v = document.forms["myForm"]["id_kategorikelas"].value;
    var w = document.forms["myForm"]["id_jurusan"].value;
        var y = document.forms["myForm"]["id_semester"].value;
var z = document.forms["myForm"]["nama_matapelajaran"].value;
    
    if (v == ""){
      alert("Tingkat kelas harus dipilih");
      return false;
    }else if (w == ""){
      alert("Jurusan harus diisi");
      return false;
    }else if (y == ""){
      alert("Semester harus diisi");
    return false;
  }else if (z == ""){
      alert("Nama mata pelajaran harus diisi");
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
       <a href="<?php echo site_url('Admin_controller/Tampilkur_kelas')?>">   
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
            <center>  <h3 class="box-title"> Form Tambah Mata Pelajaran</h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
               <form role="form" action="<?php echo site_url('Admin_controller/Tampilkur_matapelajaran_formtambahmatapelajarancek')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
          

              <div class="form-group">
                  <label for="Siswa">Pilih Tingkatan Kelas</label>
                  <select class="form-control" name="id_kategorikelas" id="id_kategorikelas" >
                  <option  value = "" >-- Pilih Tingkatan Kelas --</option>
                            <?php 
                         foreach ($kategorikelas as $value) {?>
                  <option value="<?php echo $value['id_kategorikelas'] ?>"> <?php echo $value['nama_kategorikelas'] ?> </option>
                      <?php  }
                    ?>
                  </select>
                  </div>

                <div class="form-group">
                  <label for="ekskul">Pilih Jurusan</label>
                  <select class="form-control" name="id_jurusan" id="id_jurusan">
                   <option  value = "" >-- Pilih Jurusan --</option>
                     <?php foreach ($jurusan as $row ) {?>
                        <option value="<?php echo $row['id_jurusan']?>">
                        <?php echo $row['nama_jurusan']; ?>
                            </option>
                   <?php  }?>
                       </select>
                </div>

                <div class="form-group">
                  <label for="ekskul">Pilih Semester</label>
                  <select class="form-control" name="id_semester" id="id_semester">
                   <option  value = "" >-- Pilih Semester --</option>
                     <?php foreach ($semester as $row ) {?>
                        <option value="<?php echo $row['id_semester']?>">
                        <?php echo $row['nama_semester']; ?>
                            </option>
                   <?php  }?>
                       </select>
                </div>

                <div class="form-group">
                  <label for="nama_matapelajaran">Nama Mata Pelajaran</label>
                  <input type="text" class="form-control" name="nama_matapelajaran" id="nama_matapelajaran" placeholder="Isi Nama Mata Pelajaran..." >
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