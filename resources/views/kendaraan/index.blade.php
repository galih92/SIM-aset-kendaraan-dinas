
@extends('layouts.master')

@section('content')


<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">

					@if(Auth::user()->level == 'admin')
					<a href="{{ route('kendaraan.create') }}" class="btn btn-primary" class="dropdown-toggle">Tambah Kendaraan</a>
					@endif
					
					<a href="/kendaraan/exportexcel" class="btn btn-primary">EXPORT EXCEL</a>
					<a  class="btn btn-primary" data-toggle="modal" data-target="#myModal">CETAK PDF</a>



					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Data Kendaraan</h3>	
						</div>
						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nopol Kendaraan</th>
										<th>Nama Pemegang Kendaraan</th>
										<th>Jenis Kendaraan</th>
										<th>tempat Tugas</th>
										<th>Tgl STNK </th>
										<th>Tgl KIR</th>
										
										@if(Auth::user()->level == 'admin')
										<th>Opsi</th>
										@endif

									</tr>
								</thead>
								<tbody>
									<?php $no = 0;?>
									@foreach($data_kendaraan as $kendaraan)
									<?php $no++ ;?>
									<tr>

										<td>{{$no}}</td>
										<td class="py-1">
											@if($kendaraan->gambar)
											<img src="{{url('images/user/'. $kendaraan->gambar)}}" alt="image" style="margin-right: 10px; width: 50px; height: 50px" />
											@else
											<img src="{{url('images/kendaraan/default.png')}}" alt="image" style="margin-right: 10px; width: 50px; height: 50px" />
											@endif
											<a href="/kendaraan/{{$kendaraan->id}}/profile">{{$kendaraan->no_kendaraan}}</a></td>
											<td>{{$kendaraan->petugas->nama_petugas}}</td>
											<td>{{$kendaraan->jenis}}</td>
											<td>{{$kendaraan->tempat_tugas}}</td>
											<td>{{$kendaraan->tgl_berlaku}}</td>
											<td>{{$kendaraan->tgl_kir}}</td>
											
											
											@if(Auth::user()->level == 'admin')
											<td>
												<a href="/kendaraan/{{$kendaraan->id}}/edit" class="btn btn-warning btn-sm" >Edit</a>
												<a href="/kendaraan/{{$kendaraan->id}}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin Menghapus')">Hapus</a>
												@endif
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								{{$data_kendaraan->links()}}
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="{{route('rekappdf.kendaraan')}}" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="exampleModalLabel">Cetak Data Kendaraan</h4>
					</div>
					<div class="modal-body">
						<form action="{{route('rekappdf.kendaraan')}}" target="_blank" enctype="multipart/form-data">

							<div class="form-group">
								<label for="jenis" class="col-md-4 control-label">Jenis</label>
								<select class="form-control" id="jenis" name="jenis" required="">
									<option value="">--Pilih Jenis Kendaraan--</option>
									<option value="motor">Roda Dua</option>
									<option value="tosa">Roda Tiga</option>
									<option value="mobil">Roda Empat</option>
									<option value="truck angkut">Truck Angkut</option>
									<option value="truck dump">Truck Sampah</option> 
								</select>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" name="rekap-data" class="btn btn-primary" value="rekap-data">Submit</button>
							</form>
						</div></form></div>
					</div>
				</div>

				@endsection



