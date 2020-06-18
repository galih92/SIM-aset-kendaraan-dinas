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
                    <h4 class="card-title">Tambah Data Service</h4>
                    <div class="panel">
                      <div class="panel-heading">


                        <form method="POST" action="{{ route('service.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{$errors->has('kendaraan_id') ? 'has-error':''}}">
                                <label for="exampleInputEmail1">Pilih Kendaraan</label>
                                <select id="kendaraan_id" type="text" class="form-control" name="kendaraan_id" >
                                    <option value="">(Cari Kendaraan)</option>
                                    <?php
                                    $query = DB::table('tb_kendaraan')
                                    ->get();
                                    ?>
                                    @foreach($query as $dat)
                                    <option value="{{$dat->id}}"->{{$dat->no_kendaraan}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('kendaraan_id'))
                                <div class="text-danger">
                                    {{ $errors->first('kendaraan_id')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group{{$errors->has('tgl_service') ? 'has-error':''}}">
                                <label>Tanggal Service</label>
                                <input type="date" name="tgl_service" class="form-control" placeholder="Tanggal Service ..">

                                @if($errors->has('tgl_service'))
                                <div class="text-danger">
                                    {{ $errors->first('tgl_service')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="kategori_service" class="col-md-4 control-label">Kategori Service</label>
                                <select class="form-control" name="kategori_service" required="">
                                    <option value="">--Pilih kategori--</option>
                                    <option value="pergantian part">Penggantian Sparepart</option>
                                    <option value="oli">Penggantian Oli</option>
                                    <option value="service rutin">Service Rutin</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="bukti_pembayaran" class="col-md-4 control-label">Bukti Pembayaran</label>
                                <img width="200" height="200" />
                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="bukti_pembayaran">
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
