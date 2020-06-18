@section('js')

@extends('layouts.master')

@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title">Tambah Data Petugas</h4>
                    <div class="panel">
                      <div class="panel-heading">

                        <form method="POST" action="{{ route('petugas.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>Nama Petugas</label>
                                <input type="text" name="nama_petugas" class="form-control" placeholder="Nama Petugas ..">

                                @if($errors->has('nama_petugas'))
                                <div class="text-danger">
                                    {{ $errors->first('nama_petugas')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea type="text" name="alamat" class="form-control" placeholder="Alamat .."></textarea> 

                                @if($errors->has('alamat'))
                                <div class="text-danger">
                                    {{ $errors->first('alamat')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>No Telefon</label>
                                <input type="text" name="no_hp" class="form-control" placeholder="No Telp ..">

                                @if($errors->has('no_hp'))
                                <div class="text-danger">
                                    {{ $errors->first('no_hp')}}
                                </div>
                                @endif
                            </div>


                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Email ..">

                                @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary" id="submit">
                        Tambah
                    </button>
                    <button type="reset" class="btn btn-danger">
                        Reset
                    </button>
                    <a href="{{route('petugas.index')}}" class="btn btn-light pull-right">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</form>
@endsection
