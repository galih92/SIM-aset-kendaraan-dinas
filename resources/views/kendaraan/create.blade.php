@section('js')

<script type="text/javascript">
  function readURL() {
    var input = this;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $(input).prev().attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $(function () {
    $(".uploads").change(readURL)
    $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
              return false
            })
  })



</script>
@stop

@extends('layouts.master')

@section('content')


<div class="main">
  <div class="main-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4 class="card-title">Tambah Data Kendaraan</h4>
          <div class="panel">
            <div class="panel-heading">


              <form method="POST" action="{{ route('kendaraan.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="form-group">
                 <label for="exampleInputEmail1">Nama Petugas</label>
                 <select data-live-search="true" id="petugas_id" type="text" class="form-control" name="petugas_id" >
                   <option value="">(Cari Petugas)</option>
                   <?php
                   $query = DB::table('tb_petugas')

                   ->select('tb_petugas.id','tb_petugas.nama_petugas')
                   
                   ->get();
                   ?>
                   @foreach($query as $dat)
                   <option value="{{$dat->id}}"->{{$dat->nama_petugas}}</option>
                   @endforeach
                 </select>
               </div>

               <div class="form-group">
                <label>No Kendaraan</label>
                <input type="text" name="no_kendaraan" class="form-control" value="{{old('no_kendaraan')}}" placeholder="No Kendaraan .." >

                @if($errors->has('no_kendaraan'))
                <div class="text-danger">
                  {{ $errors->first('no_kendaraan')}}
                </div>
                @endif
              </div>

              <div class="form-group">
                <label>No Mesin</label>
                <input type="text" name="no_mesin" class="form-control" value="{{old('no_mesin')}}" placeholder="No Mesin .."> 

                @if($errors->has('no_mesin'))
                <div class="text-danger">
                  {{ $errors->first('no_mesin')}}
                </div>
                @endif
              </div>

              <div class="form-group">
                <label>NO Rangka</label>
                <input type="text" name="no_rangka" class="form-control" value="{{old('no_rangka')}}" placeholder="No Rangka ..">

                @if($errors->has('no_rangka'))
                <div class="text-danger">
                  {{ $errors->first('no_rangka')}}
                </div>
                @endif
              </div>


              <div class="form-group">
                <label>Merek</label>
                <input type="text" name="merek" class="form-control" value="{{old('merek')}}"placeholder="Merek ..">

                @if($errors->has('merek'))
                <div class="text-danger">
                  {{ $errors->first('merek')}}
                </div>
                @endif
              </div>


              <div class="form-group">
                <label>Tgl Masuk</label>
                <input type="date" name="tgl_masuk" class="form-control" value="{{old('tgl_masuk')}}" placeholder="Tgl Masuk Kendaraan ..">

                @if($errors->has('tgl_masuk'))
                <div class="text-danger">
                  {{ $errors->first('tgl_masuk')}}
                </div>
                @endif
              </div>

              <div class="form-group">
                <label>Tgl KIR</label>
                <input type="date" name="tgl_kir" class="form-control" value="{{old('tgl_kir')}}" placeholder="Tgl KIR ..">

                @if($errors->has('tgl_kir'))
                <div class="text-danger">
                  {{ $errors->first('tgl_kir')}}
                </div>
                @endif
              </div>

              <div class="form-group">
                <label>Tgl Berlaku</label>
                <input type="date" name="tgl_berlaku" class="form-control" value="{{old('tgl_berlaku')}}" placeholder="Tgl Berlaku ..">

                @if($errors->has('tgl_berlaku'))
                <div class="text-danger">
                  {{ $errors->first('tgl_berlaku')}}
                </div>
                @endif
              </div>


              <div class="form-group">
                <label for="jenis" class="col-md-4 control-label">Jenis</label>
                <select class="form-control" name="jenis" required="">
                  <option value="">--Pilih Jenis Kendaraan--</option>
                  <option value="motor">Roda Dua</option>
                  <option value="tosa">Roda Tiga</option>
                  <option value="mobil">Roda Empat</option>
                  <option value="truck angkut">Truck Angkut</option>
                  <option value="truck dump">Truck Sampah</option> 
                </select>
              </div>


              <div class="form-group">
                <label >Gambar</label>
                <input type="file" class="uploads form-control" style="margin-top: 20px;" value="{{old('gambar')}}" name="gambar">
              </div>



              <div class="form-group">
                <label>Lokasi Tugas</label>
                <input type="text" name="tempat_tugas" class="form-control" value="{{old('tempat_tugas')}}" placeholder="Lokasi Tugas ..">
              </div>

            </div>
          </div>


          <button type="submit" class="btn btn-primary" id="submit">
            Tambah
          </button>
          <button type="reset" class="btn btn-danger">
            Reset
          </button>

        </div>
      </div>
    </div>
  </div>
</div>

</div>
</form>
@endsection
