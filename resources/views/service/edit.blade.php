@section('js')

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


              <form action="{{ route('service.update', $service->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}


                
                

                
                <div class="form-group">
                  <label for="exampleInputEmail1">Tgl Service</label>
                  <input name="tgl_service" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$service->tgl_service}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Tgl Penggantian Sprepart</label>
                  <input name="tgl_part" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$service->tgl_part}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Tgl Penggatian Oli</label>
                  <input name="tgl_oli" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$service->tgl_oli}}">
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
