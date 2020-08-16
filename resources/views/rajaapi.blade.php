<!DOCTYPE html>
<html>
<head>
  @section('title','Raja Api')
  @include('templates.head')

</head>

<body>
  <!-- Sidenav -->
  @include('templates.sidebar')
  <!-- Sidenav -->

  <!-- Main content -->
  <div class="main-content" id="panel">
    
    <!-- Topnav -->
    @include('templates.topbar')
    <!-- Topnav -->

    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0"><i class="fa fa-database"></i> Raja API</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Data Raja API</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Wilayah</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Header -->

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-12">
          <div class="card px-3 py-3">
            <div class="row mt-3">
              <div class="col-12">
                <h2>Daftar Provinsi</h2>
                <p class="wilayah"></p>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="table">
                    <thead>
                      <th>No</th>
                      <th>Wilayah</th>
                    </thead>
                    <tbody id="tbody">
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12">
                <h2>Daftar Kelurahan</h2>
                <p class="wilayah-kelurahan"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label>Pilih provinsi</label>
                  <select class="form-control select-wilayah">
                   
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label>Pilih kota/kabupaten</label>
                  <select class="form-control select-kota">
                   <option selected disabled>--Pilih provinsi terlebih dahulu--</option>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label>Pilih kecamatan</label>
                  <select class="form-control select-kecamatan">
                    <option selected disabled>--Pilih kota/kab terlebih dahulu--</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="table-kelurahan">
                    <thead>
                      <th>No</th>
                      <th>Kelurahan</th>
                    </thead>
                    <tbody id="tbody-kelurahan">
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      @include('templates.footer')
      <!-- Footer -->
    </div>
    <!-- Page Content -->
  </div>
  <!-- Argon Scripts -->

  <!-- Script -->
  @include('templates.script')
  <script type="text/javascript">
    $(function(){
      load_wilayah();
      load_select_wilayah();

      $(document).on('change','.select-wilayah',function(){
        let val = $(this).val();
        $('#tbody-kelurahan').find('tr').remove();
        if(val == ""){
          let option_kota = '<option value="" selected>--Pilih provinsi terlebih dahulu--</option>';
          let option_kecamatan = '<option value="" selected>--Pilih kota/kab terlebih dahulu--</option>';
          $('.wilayah-kelurahan').html('');
          $('.select-kota').html(option_kota);
          $('.select-kecamatan').html(option_kecamatan);
        }
        else{
          let option_kecamatan = '<option value="" selected>--Pilih kota/kab terlebih dahulu--</option>';
          $('.select-kecamatan').html(option_kecamatan);
          load_kota(val);
        }
      })
      $(document).on('change','.select-kota',function(){
        $('#tbody-kelurahan').find('tr').remove();
        let val = $(this).val();
        if(val == ""){
          let option_kelurahan = '<option value="" selected>--Pilih kota terlebih dahulu--</option>';
          $('.wilayah-kelurahan').html('');
          $('.select-kecamatan').html(option_kelurahan);
        }
        else{
          load_kecamatan(val);
        }
      })
      $(document).on('change','.select-kecamatan',function(){
        $('#tbody-kelurahan').find('tr').remove();
        let val = $(this).val();
        if(val == ""){
          let html = '<tr><td colspan="2" class="text-center">Pilih kecamatan terlebih dahulu</td></tr>';
          $('#tbody-kelurahan').html(html);
        }
        else{
          load_kelurahan(val);
        }
      })
    })

    function load_wilayah(){
      $.ajax({
        url : base_url + 'rajaapi/provinsi',
        method : "GET",
        dataType : "JSON",
        beforeSend : function(){
          let html = '<tr><td colspan="2" class="text-center">Loading....</td></tr>';
          $('#tbody').html(html);
        },
        success : function(resp){
            console.log(resp);
            let html = "";
            if(resp["code"] == 200){
              $.each(resp.data,function(index,element){
                html += '<tr>'+
                          '<td>'+(index+1)+'</td>'+
                          '<td>'+element["name"]+'</td>'+
                        '</tr>';
              })

              $('#tbody').html(html);
              $('.wilayah').html(" Ditemukan "+resp.data.length+' wilayah rajaapi')  
            }
            else{
              alert(resp.data);
            }
            
          
        },
        error : function(){
          swal({   
            title: "Koneksi Terputus!",   
            type: "error", 
            text: "Klik tombol dibawah dan halaman akan reload otomatis",
            confirmButtonColor: "#469408",   
          })
          .then((value) => {
            // location.reload();
          })
        }
      })
    }
    function load_select_wilayah(){
      $.ajax({
        url : base_url + 'rajaapi/provinsi',
        method : "GET",
        dataType : "JSON",
        beforeSend : function(){
          let html = '<option disabled="true" selected>Loading...</option>';
          $('.select-wilayah').html(html);
        },
        success : function(resp){
            console.log(resp);
            let html = "";
            if(resp.code == 200){
              let html = '<option value="" selected>--Pilih wilayah--</option>';
              $.each(resp.data,function(index,element){
                html += '<option value="'+element["id"]+'">'+element["name"]+'</option>';
              })

              $('.select-wilayah').html(html);  
            }
            else{
              alert(resp.data);
            }
        },
        error : function(){
          swal({   
            title: "Koneksi Terputus!",   
            type: "error", 
            text: "Klik tombol dibawah dan halaman akan reload otomatis",
            confirmButtonColor: "#469408",   
          })
          .then((value) => {
            location.reload();
          })
        }
      })
    }
    function load_kota(id_provinsi){
      $.ajax({
        url : base_url + 'rajaapi/kota?id_provinsi='+id_provinsi,
        method : "GET",
        dataType : "JSON",
        beforeSend : function(){
          $('.select-kota').attr('disabled',true);
          $('.select-kota').html("<option selected>Loading...</option>");
        },
        success : function(resp){
            $('.select-kota').removeAttr('disabled');

            console.log(resp);
            if(resp.code == 200){
              let html = '<option value="" selected>--Pilih kota/kabupaten--</option>';
              $.each(resp.data,function(index,element){
                html += '<option value="'+element["id"]+'">'+element["name"]+'</option>';
              })
              $('.select-kota').html(html);
            }
            else{
              alert(resp.data);
            }
            
          
        },
        error : function(){
          swal({   
            title: "Koneksi Terputus!",   
            type: "error", 
            text: "Klik tombol dibawah dan halaman akan reload otomatis",
            confirmButtonColor: "#469408",   
          })
          .then((value) => {
            location.reload();
          })
        }
      })
    }
    function load_kecamatan(id_kota){
      $.ajax({
        url : base_url + 'rajaapi/kecamatan?id_kota='+id_kota,
        method : "GET",
        dataType : "JSON",
        beforeSend : function(){
          $('.select-kecamatan').attr('disabled',true);
          $('.select-kecamatan').html("<option selected>Loading...</option>");
        },
        success : function(resp){
            $('.select-kecamatan').removeAttr('disabled');

            console.log(resp);
            if(resp.code == 200){
              let html = "";
              html = '<option selected value="">--Pilih kecamatan--</option>';
              $.each(resp.data,function(index,element){
                html += '<option value="'+element["id"]+'">'+element["name"]+'</option>';
              })

              $('.select-kecamatan').html(html);
            }
            else{
              alert(resp.data);
            }
            
          
        },
        error : function(){
          swal({   
            title: "Koneksi Terputus!",   
            type: "error", 
            text: "Klik tombol dibawah dan halaman akan reload otomatis",
            confirmButtonColor: "#469408",   
          })
          .then((value) => {
            location.reload();
          })
        }
      })
    }
    function load_kelurahan(id_kecamatan){
      $.ajax({
        url : base_url + 'rajaapi/kelurahan?id_kecamatan='+id_kecamatan,
        method : "GET",
        dataType : "JSON",
        beforeSend : function(){
          let html = '<tr><td colspan="2" class="text-center">Loading....</td></tr>';
          $('#tbody-kelurahan').html(html);
        },
        success : function(resp){

            console.log(resp);
            let html = "";
            if(resp["code"] == 200){
              $.each(resp.data,function(index,element){
                html += '<tr>'+
                          '<td>'+(index+1)+'</td>'+
                          '<td>'+element["name"]+'</td>'+
                        '</tr>';
              })

              $('#tbody-kelurahan').html(html);
              $('.wilayah-kelurahan').html(" Ditemukan "+resp.data.length+' kelurahan rajaapi')  
            }
            else{
              alert(resp.data);
            }
            
          
        },
        error : function(){
          swal({   
            title: "Koneksi Terputus!",   
            type: "error", 
            text: "Klik tombol dibawah dan halaman akan reload otomatis",
            confirmButtonColor: "#469408",   
          })
          .then((value) => {
            location.reload();
          })
        }
      })
    }
  </script>
  <!-- Script -->
</body>

</html>