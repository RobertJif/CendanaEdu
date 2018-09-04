<?php 

include 'Kur_header.php';
include 'koneksi.php';
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script>
  function validateForm(){
    var w = document.forms["myForm"]["id_tahunsemester"].value;
    var x = document.forms["myForm"]["kelas"].value;
    var z = document.forms["myForm"]["matapelajaran"].value;
    
    if (w == ""){
      alert("Tahun Ajaran harus dipilih");
      return false;
    } else if (x == ""){
      alert("Kelas harus dipilih");
      return false;
    }else if (z == ""){
      alert("Mata pelajaran harus dipilih");
      return false;
    }
  }
    
    function updateTextInput(val) {
          document.getElementById('textInput').value=val; 
        }
</script>

   <section class="content-header" >
      <h1>
        Kelola Nilai
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
            
               <form role="form" action="<?php echo base_url('Admin_controller/Tampilkur_nilai_nilaiperkelas')?>" method="POST" name="myForm" onSubmit="return validateForm()">
              <div class="box-body">
         

        


               <div class="form-group">
                  <label for="Tahunajaran">Plih Tahun Ajaran dan Semester</label>
                  <select class="form-control" name="id_tahunsemester" id="id_tahunsemester">
                  <option  value = "" >-- Pilih Tahun ajaran dan semester --</option>
                            <?php 
                         foreach ($tahunsemester as $value) {?>
                  <option value="<?php echo $value->id_tahunsemester."|".$value->id_semester ?>"> <?php echo $value->nama_tahunajaran." - Semester ".$value->nama_semester?> </option>
                      <?php  }
                    ?>
                  </select>
                  </div>

                 
            <div class="form-group">
 

                <label for="kelas">Pilih Kelas:</label>
                <select name="kelas" class="form-control" id="kelas" disabled="">
                <option>-- Pilih Kelas -- </option>
                </select>
            </div> 

<div class="form-group">
 

                <label for="matapelajaran">Pilih Mata Pelajaran:</label>
                <select name="matapelajaran" class="form-control" id="matapelajaran" disabled="">
                <option>-- Pilih Mata Pelajaran -- </option>
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
<?php include 'Kur_footer.php'?>


<script type="text/javascript">
$(document).ready(function(){
    /* Populate data to state dropdown */ 
    $('#id_tahunsemester').on('change',function(){
  var id_tahunsemester = $(this).val();
     if(id_tahunsemester == '')
          {
            $('#kelas').prop('disabled',true);
           }
           else{
              $('#kelas').prop('disabled',false);
              $.ajax({
                url:"<?php echo base_url('Admin_controller/TampilKelas') ?> ",
                type:"POST",     
        data:{"id_tahunsemester" : id_tahunsemester},
                dataType: 'json',
                success:function(data){
                  $('#kelas').html(data);
                },
                error:function(){
                  alert('Kelas untuk tahun ajaran ini belum ada');
                } 
            }); 
           }
         
   });
    $('#kelas').on('change',function(){
  var id_kelas = $(this).val();
     if(id_kelas == '')
          {
            $('#matapelajaran').prop('disabled',true);
           }
           else{
              $('#matapelajaran').prop('disabled',false);
              $.ajax({
                url:"<?php echo base_url('Admin_controller/TampilMataPelajaran') ?> ",
                type:"POST",     
              data:{"id_kelas" : id_kelas},
                dataType: 'json',
                success:function(data){
                  $('#matapelajaran').html(data);
                },
                error:function(){
                  alert('Mata pelajaran untuk kelas ini belum ada');
                } 
            }); 
           }
         
   });
});
</script>


