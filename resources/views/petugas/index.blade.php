<!doctype html>
<html lang="en">
@extends('layouts.master')

@section('content')
<script>
	$(document).ready( function () {
		$('#table_id').DataTable();
	} );
</script>
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="right">
						<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user-plus"></i>
							Tambah Data Petugas
						</button>
					</div>


					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Data Pemegang Kendaraan</h3>	
						</div>
						<div class="panel-body">
							<table id="table_id" class=" table table-striped table-bordered" >
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Petugas</th>
										<th>Alamat</th>
										<th>NO HP</th>
										<th>Email</th>
										<th>Opsi</th>	
									</tr>
								</thead>
								<tbody>
									<?php $no=0; ?>
									@foreach($data_petugas as $petugas)
									<?php $no++; ?>

									<tr>
										<td>{{$no++}}</td>
										<td>{{$petugas->nama_petugas}}</td>
										<td>{{$petugas->alamat}}</td>
										<td>{{$petugas->no_hp}}</td>
										<td>{{$petugas->email}}</td>
										<td><a href="/petugas/{{$petugas->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
											<a href="/petugas/{{$petugas->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin Menghapus')">Hapus</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</html>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Petugas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="/petugas/create" method="POST">
					{{csrf_field()}}
					<div class="form-group{{$errors->has('nama_petugas') ? 'has-error':''}}">
						<label for="exampleInputEmail1">Nama Lengkap</label>
						<input name="nama_petugas" type="text" class="form-control" id="nama_petugas" aria-describedby="emailHelp" placeholder="Nama Lengkap" value="{{old('nama_petugas')}}">
						@if($errors->has('nama_petugas'))
						<span class="text-danger">
							{{ $errors->first('nama_petugas')}}
						</span> 
						@endif
					</div>

					<div class="form-group{{$errors->has('alamat') ? 'has-error':''}}">
						<label for="exampleInputEmail1">Alamat Rumah</label>
						<textarea name="alamat" class="form-control" id="alamat" rows="3" placeholder="alamat" value="{{old('alamat')}}"></textarea>
						@if($errors->has('alamat'))
						<span class="text-danger">
							{{ $errors->first('alamat')}}
						</span> 
						@endif
					</div>

					<div class="form-group{{$errors->has('email') ? 'has-error':''}}">
						<label for="exampleInputEmail1">Email</label>
						<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp"  placeholder="email" value="{{old('email')}}">
						@if($errors->has('email'))
						<span class="text-danger">
							{{ $errors->first('email')}}
						</span> 
						@endif
					</div>

					<div class="form-group{{$errors->has('no_hp') ? 'has-error':''}}">
						<label for="exampleInputPassword1">No Hp</label>
						<input name="no_hp" type="number" class="form-control" id="exampleInputPassword1" placeholder="+62 *** *** ***" value="{{old('no_hp')}}">
						@if($errors->has('no_hp'))
						<span class="text-danger">
							{{ $errors->first('no_hp')}}
						</span> 
						@endif
					</div>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection



