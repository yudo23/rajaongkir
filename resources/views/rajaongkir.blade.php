<!DOCTYPE html>
<html>
<head>
  @section('title','Raja Ongkir')
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
              <h6 class="h2 text-white d-inline-block mb-0"><i class="fa fa-database"></i> Raja Ongkir</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Data Raja Ongkir</a></li>
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
                <h2>Daftar Wilayah</h2>
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
              <div class="col-6">
                <h2>Daftar Kota/Kabupaten</h2>
                <p class="wilayah-kota"></p>
                <div class="form-group">
                  <label>Pilih wilayah</label>
                  <select class="form-control select-wilayah">
                   
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="table-kota">
                    <thead>
                      <th>No</th>
                      <th>Kota/Kabupaten</th>
                    </thead>
                    <tbody id="tbody-kota">
                      
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
        if(val == ""){
          $('.wilayah-kota').html('')
          $('#tbody-kota').html('<tr><td colspan="2" class="text-center">Pilih wilayah terlebih dahulu</td></tr>')
        }
        else{
          load_kota(val);
        }
      })
    })

    function load_wilayah(){
      $.ajax({
        url : base_url + 'rajaongkir/wilayah',
        method : "GET",
        dataType : "JSON",
        beforeSend : function(){
          let html = '<tr><td colspan="2" class="text-center">Loading....</td></tr>';
          $('#tbody').html(html);
        },
        success : function(resp){
            console.log(resp);
            let html = "";
            if(resp.rajaongkir.status["code"] == 200){
              $.each(resp.rajaongkir.results,function(index,element){
                html += '<tr>'+
                          '<td>'+(index+1)+'</td>'+
                          '<td>'+element["province"]+'</td>'+
                        '</tr>';
              })

              $('#tbody').html(html);
              $('.wilayah').html(" Ditemukan "+resp.rajaongkir.results.length+' wilayah rajaongkir')  
            }
            else{
              alert(resp.rajaongkir.status["description"]);
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
    function load_select_wilayah(){
      $.ajax({
        url : base_url + 'rajaongkir/wilayah',
        method : "GET",
        dataType : "JSON",
        beforeSend : function(){
          let html = '<option disabled="true" selected>Loading...</option>';
          $('.select-wilayah').html(html);
        },
        success : function(resp){
            console.log(resp);
            let html = "";
            if(resp.rajaongkir.status["code"] == 200){
              let html = '<option value="" selected>--Pilih wilayah--</option>';
              $.each(resp.rajaongkir.results,function(index,element){
                html += '<option value="'+element["province_id"]+'">'+element["province"]+'</option>';
              })

              $('.select-wilayah').html(html);  
            }
            else{
              alert(resp.rajaongkir.status["description"]);
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
    function load_kota(id_wilayah){
      $.ajax({
        url : base_url + 'rajaongkir/kota?id_wilayah='+id_wilayah,
        method : "GET",
        dataType : "JSON",
        beforeSend : function(){
          $('#tbody-kota').html('<tr><td colspan="2" class="text-center">Loading...</td></tr>')
        },
        success : function(resp){
            console.log(resp);
            let html = "";
            if(resp.rajaongkir.status["code"] == 200){
              $.each(resp.rajaongkir.results,function(index,element){
                html += '<tr>'+
                          '<td>'+(index+1)+'</td>'+
                          '<td>'+element["type"]+" "+element["city_name"]+'</td>'+
                        '</tr>';
              })

              $('#tbody-kota').html(html);
              $('.wilayah-kota').html(" Ditemukan "+resp.rajaongkir.results.length+' kota/kabupaten rajaongkir')  
            }
            else{
              alert(resp.rajaongkir.status["description"]);
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