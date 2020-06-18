@section('js')

@extends('layouts.master')

@section('content')


<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h4 class="card-title">Edit Data Petugas</h4>
					<div class="panel">
						<div class="panel-heading">


							<form action="/petugas/{{$petugas->id}}/update" method="POST" enctype="multipart/form-data">
								{{ csrf_field() }}

								<div class="form-group{{$errors->has('nama_petugas') ? 'has-error':''}}">
									<label for="exampleInputEmail1">Nama Petugas</label>
									<input name="nama_petugas" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama Petugas" value="{{$petugas->nama_petugas}}">
									@if($errors->has('nama_petugas'))
									<span class="text-danger">
										{{ $errors->first('nama_petugas')}}
									</span> 
									@endif
								</div>

								<div class="form-group{{$errors->has('alamat') ? 'has-error':''}}">
									<label for="exampleInputEmail1">Alamat</label>
									<textarea name="alamat" class="form-control" id="exampleInputEmail1" rows="2" >{{$petugas->alamat}}</textarea>
									@if($errors->has('alamat'))
									<span class="text-danger">
										{{ $errors->first('alamat')}}
									</span> 
									@endif
								</div>

								<div class="form-group{{$errors->has('email') ? 'has-error':''}}">
									<label for="exampleInputEmail1">Email</label>
									<input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" value="{{$petugas->email}}">
									@if($errors->has('email'))
									<span class="text-danger">
										{{ $errors->first('email')}}
									</span> 
									@endif
								</div>

								<div class="form-group{{$errors->has('no_hp') ? 'has-error':''}}">
									<label for="exampleInputEmail1">No Telefon</label>
									<input name="no_hp" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No Telefon" value="{{$petugas->no_hp}}">
									@if($errors->has('no_hp'))
									<span class="text-danger">
										{{ $errors->first('no_hp')}}
									</span> 
									@endif
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Foto</label>
									<input type="file" name="foto" class="form-control">
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
