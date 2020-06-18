@extends('layouts.master')
@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title">Kirim Pesan</h4>
                    <div class="panel">
                      <div class="panel-heading">

                        <!-- Main Section -->

                        <!-- Remove This Before You Start -->
                        @if(\Session::has('alert-failed'))
                        <div class="alert alert-failed"> 
                            <div>{{Session::get('alert-failed')}}</div>
                        </div>
                        @endif
                        @if(\Session::has('alert-success'))
                        <div class="alert alert-success">
                            <div>{{Session::get('alert-success')}}</div>
                        </div>
                        @endif
                        <form action="{{ url('/sendEmail') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$petugas->email}}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Petugas:</label>
                                <input type="text" class="form-control" id="name" name="nama"  value="{{$petugas->nama_petugas}}"/>
                            </div>
                            <div class="form-group">
                                <label for="judul">Judul:</label>
                                <input type="text" class="form-control" id="judul" name="judul" value="notifikasi kendaraan"/>
                            </div>
                            <div class="form-group">
                                <label for="pesan">Pesan:</label>
                                <textarea class="form-control" id="pesan" name="pesan">waktunya membayar pajak</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-md btn-primary">Send Email</button>
                    </div>
                </form>

                <!-- /.content -->
            </section>
            <!-- /.main-section -->
        </div>
    </div>
</div>
</div>
</div>

</div>
</form>
@endsection