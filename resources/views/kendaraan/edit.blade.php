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
                    <h4 class="card-title">Edit Data Kendaraan</h4>
                    <div class="panel">
                        <div class="panel-heading">


                            <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                
                                <div class="form-group">
                                   <label for="exampleInputEmail1">Nama Petugas</label>
                                   <select id="petugas_id" type="text" class="form-control" name=" petugas_id" >@foreach($query as $dat)
                                    <option value="{{$dat->id}}"->{{$kendaraan->petugas->nama_petugas}}</option>
                                    <option value="{{$dat->id}}"->{{$dat->nama_petugas}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">No Kendaraan</label>
                                <input name="no_kendaraan" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$kendaraan->no_kendaraan}}" readonly="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">No Mesin</label>
                                <input name="no_mesin" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$kendaraan->no_mesin}}" readonly="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">No Rangka</label>
                                <input name="no_rangka" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$kendaraan->no_rangka}}" readonly="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Merek</label>
                                <input name="merek" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$kendaraan->merek}}">
                            </div>

                            <div class="form-group">
                                <label for="jenis" class="col-md-4 control-label">Kategori Service</label>
                                <select class="form-control" name="jenis" required="">
                                  <option value="{{$kendaraan->jenis}}">{{$kendaraan->jenis}}</option>
                                  <option value="motor">Roda Dua</option>
                                  <option value="tosa">Roda Tiga</option>
                                  <option value="mobil">Roda Empat</option>
                                  <option value="truck angkut">Truck Angkut</option>
                                  <option value="truck dump">Truck Sampah</option> 
                              </select>
                          </div>



                          <div class="form-group">
                            <label for="exampleInputEmail1">Tgl Berlaku</label>
                            <input name="tgl_berlaku" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$kendaraan->tgl_berlaku}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tgl KIR</label>
                            <input name="tgl_kir" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$kendaraan->tgl_kir}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Gambar</label>
                            <input type="file" class="uploads form-control" style="margin-top: 20px; width: 50%;" name="gambar">
                            <img class="product" width="200" height="200" @if($kendaraan->gambar) src="{{ asset('images/user/'.$kendaraan->gambar) }}" @endif />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Lokasi Tugas</label>
                            <textarea name="tempat_tugas" class="form-control" id="exampleInputEmail1" rows="2" >{{$kendaraan->tempat_tugas}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  	

    <button type="submit" class="btn btn-primar btn-warning">Simpan</button>
</form>

</div>
</div>

</div>
</div>
@endsection
