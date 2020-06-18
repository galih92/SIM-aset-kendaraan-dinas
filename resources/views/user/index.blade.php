@extends('layouts.master')

@section('content')
@if(session('sukses'))
<div class="alert alert-success" role="alert">
	{{session('sukses')}}
</div>
@endif
<div><form class="form-inline my-2 my-lg-0 float-right" method="GET" class="/user">
</form>

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="right">
						<a href="{{ route('user.create') }}" class="btn btn-primary" class="fa fa-plus" >Input User Baru</a>
					</div>

					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Data User</h3>	
						</div>
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Username</th>
										<th>Email</th>
										<th>Level</th>
										<th>No Telp</th>
										<th>Action</th>					
									</tr>
								</thead>
								<tbody>
									@foreach($data_user as $user)
									<tr>
										<td class="py-1">
											@if($user->gambar)
											<img src="{{url('images/user/'. $user->gambar)}}" alt="image" style="margin-right: 10px; width: 50px; height: 50px" />
											@else
											<img src="{{url('images/user/default.png')}}" alt="image" style="margin-right: 10px; width: 50px; height: 50px" />
											@endif
											
											{{$user->username}}
											
										</td>
										<td>{{$user->email}}</td>
										<td>{{$user->level}}</td>
										<td>{{$user->telp}}</td>
										<td>
											<a href="/user/{{$user->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
											<a href="/user/{{$user->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin Menghapus')">Hapus</a>
											<td>
												
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

		@endsection


