<?php include 'Kur_header.php';
      include 'koneksi.php';
?>


  <script>
  function validateForm(){
   var a = document.forms["myForm"]["nisn"].value;
    var b = document.forms["myForm"]["nama_siswa"].value;
    var c = document.forms["myForm"]["password"].value;
    var d = document.forms["myForm"]["tempatlahir"].value;
    var e = document.forms["myForm"]["tanggallahir"].value;
var f = document.forms["myForm"]["agama"].value;
var g = document.forms["myForm"]["jeniskelamin"].value;
var h = document.forms["myForm"]["alamat"].value;
var i = document.forms["myForm"]["nama_ayah"].value;
var j = document.forms["myForm"]["nama_ibu"].value;
var k = document.forms["myForm"]["telepon"].value;
var l = document.forms["myForm"]["status"].value;
    
    if (a == ""){
      alert("Nomor Induk Siswa harus diisi");
      return false;
    }else if (b == ""){
      alert("Nama Siswa harus diisi");
      return false;
    }else if (c == ""){
      alert("Password harus diisi");
      return false;
    }else if (d == ""){
      alert("Tempat lahir harus diisi");
      return false;
    }else if (e == ""){
      alert("Tanggal lahir harus diisi");
      return false;
    }else if (f == ""){
      alert("Agama harus diisi");
      return false;
    }else if (g == ""){
      alert("Jenis kelamin harus diisi");
      return false;
    }else if (h == ""){
      alert("Alamat harus diisi");
      return false;
    }else if (i == ""){
      alert("Nama Ayah harus diisi");
      return false;
    }else if (j == ""){
      alert("Nama Ibu harus diisi");
      return false;
    }else if (k == ""){
      alert("Telepon Orangtua harus diisi");
      return false;
    }else if (l == ""){
      alert("Status harus diisi");
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
     <a href="<?php echo site_url('Admin_controller/Tampilkur_siswa')?>">   
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
            <center>  <h3 class="box-title"> Form Edit Siswa</h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <?php 
                if ($dataEditSiswa){
                  $nisn = $dataEditSiswa->nisn;
                  $nama_siswa = $dataEditSiswa->nama_siswa;
                  $password = $dataEditSiswa->password;
                  $tempatlahir = $dataEditSiswa->tempatlahir;
                  $tanggallahir = $dataEditSiswa->tanggallahir;
                  $agama = $dataEditSiswa->agama;
                  $jeniskelamin = $dataEditSiswa->jeniskelamin;
                  $alamat = $dataEditSiswa->alamat;
                  $nama_ayah = $dataEditSiswa->nama_ayah;
                  $nama_ibu = $dataEditSiswa->nama_ibu;
                  $telepon = $dataEditSiswa->telepon;
                  $status = $dataEditSiswa->status;
                }  else{
                     $nisn = "";
                  $nama_siswa = "";
                  $password = "";
                  $tempatlahir = "";
                  $tanggallahir = "";
                  $agama = "";
                  $jeniskelamin = "";
                  $alamat = "";
                  $nama_ayah = "";
                  $nama_ibu = "";
                  $telepon = "";
                  $status = "";

                  }

              ?>


               <form role="form" action="<?php echo site_url('Admin_controller/Kur_siswa_editsiswa')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
            
              <div class="form-group">
                  <label for="nisn">Nomor Induk Siswa</label>
                  <input type="text" class="form-control" name="nisn" id="nisn" placeholder="Isi Nomor Induk Siswa..." value="<?php echo $nisn;?> " readonly>
                </div>
          

          <div class="form-group">
                  <label for="namasiswa">Nama Lengkap Siswa</label>
                  <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Isi Nama Lengkap Siswa..." value="<?php echo $nama_siswa;?> ">
                </div>
          
           <div class="form-group">
                  <label for="password">Password</label>
                  <input type="text" class="form-control" name="password" id="password" placeholder="Isi Password Siswa..." value="<?php echo $password;?> ">
                </div>

          <div class="form-group">
                  <label for="tempatlahir">Tempat Lahir</label>
                  <input type="text" class="form-control" name="tempatlahir" id="tempatlahir" placeholder="Isi Tempat Lahir Siswa..." value="<?php echo $tempatlahir;?> ">
                </div>

                  <div class="form-group">
                  <label for="tanggallahir">Tanggal Lahir Siswa </label>
            
                  <input name="tanggallahir" id="tanggallahir" class="form-control"  placeholder="Pilih Tanggal Lahir Siswa..." type="text"  onfocus="(this.type='date')" onblur="(this.type='text')" value="<?php echo $tanggallahir;?> "></input>
                </div>
         
          <div class="form-group">
                  <label for="agama">Agama</label>
                  <input type="text" class="form-control" name="agama" id="agama" placeholder="Isi Agama Siswa..." value="<?php echo $agama;?> ">
                </div>
          
          <div class="form-group">
                  <label for="jeniskelamin">Jenis Kelamin</label>
                  <br>
                      <input type='radio' name='jeniskelamin' value="lakilaki" font size='4'>&nbsp;Laki - Laki</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type='radio' name='jeniskelamin' value="perempuan"  font size='4'>&nbsp;  Perempuan</font>
                  </div>
         
          <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Isi Alamat Siswa..." value="<?php echo $alamat;?> ">
                </div>
                 <div class="form-group">
                  <label for="namaayah">Nama Ayah</label>
                  <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Isi Nama Ayah Siswa..." value="<?php echo $nama_ayah;?>" >
                </div>
                <div class="form-group">
                  <label for="namaibu">Nama Ibu</label>
                  <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Isi Nama Ibu Siswa..." value="<?php echo $nama_ibu;?>">
                </div>
      
          <div class="form-group">
                  <label for="telepon">Telepon</label>
                  <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Isi Telepon Siswa..." value="<?php echo $telepon;?> ">
                </div>
        
              <div class="form-group">
                  <label for="status">Status</label>
                  <br>
                      <input type='radio' name='status' value="1" font size='4'>&nbsp;Aktif</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type='radio' name='status' value="0"  font size='4'>&nbsp;  Tidak Aktif</font>
                  </div>

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