@extends('layouts.master')
<script type="text/javascript">
	function showTime() {
		var date = new Date(),
		utc = new Date(Date.UTC(
			date.getFullYear(),
			date.getMonth(),
			date.getDate(),
			date.getHours(),
			date.getMinutes(),
			date.getSeconds()
			));

		document.getElementById('time').innerHTML = utc.toLocaleTimeString();
	}

	setInterval(showTime, 1000);
</script>

@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">

			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Data Dashboard</h3>	
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-3">
							<div class="metric">
								<span class="icon"><i class="lnr lnr-user"></i></span>
								<p>
									<span class="number">{{$data_kendaraan->count()}}</span>
									<span class="title">Kendaraan</span>
								</p>
							</div>
						</div>


						<div class="col-md-3">
							<div class="metric">
								<span class="icon"><i class="fa fa-shopping-bag"></i></span>
								<p>
									<span class="number">{{$data_petugas->count()}}</span>
									<span class="title">Petugas</span>
								</p>
							</div>
						</div>

						<div class="col-md-3">
							<div class="metric">
								<span class="icon"><i class="fa fa-eye"></i></span>
								<p>
									<span class="number">{{$data_service->count()}}</span>
									<span class="title">Service</span>
								</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="metric">
								<span class="icon"><i class="fa fa-bar-chart"></i></span>
								<p>
									<span class="number">#</span>
									<span class="title">STNK</span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			@if(Auth::user()->level == 'admin')
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Data Kendaraan</h3>	
				</div>


				<div class="panel-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Nopol Kendaraan</th>
								<th>Nama Pemegang Kendaraan</th>
								<th>Tgl STNK</th>
								<th>Tgl KIR</th>
								<th>Opsi</th>

							</tr>
						</thead>
						<tbody>

							<?php $no = 0;?>
							@foreach($data_kendaraan as $kendaraan)
							<?php 
							$waktu = $mytime->diffInDays($kendaraan->tgl_berlaku);
							if ($waktu <= 60) {
		                    # code...
								$no++ ;?>
								<tr>
									<td>{{$no}}</td>
									<td>{{$kendaraan->no_kendaraan}}</td>
									<td>{{$kendaraan->petugas->nama_petugas}}</td>

									<?php
									$waktu = $mytime->diffInDays($kendaraan->tgl_berlaku);
									if ($waktu > 359) {
										$waktu = floor($waktu/360)." Tahun";
									}else if($waktu >30){
										$waktu = floor($waktu/30)."Bulan";
									}else{
										$waktu = $waktu ." Hari";
									}
									?>

									<td>{{$waktu}}</td>

									<?php
									$kir = $mytime->diffInDays($kendaraan->tgl_kir);
									if ($kir > 359) {
										$kir = floor($kir/360)." Tahun";
									}else if($kir >30){
										$kir = floor($kir/30)."Bulan";
									}else{
										$kir = $kir ." Hari";
									}
									?>

									<td>{{$kir}}</td>
									<td>
										<a href="/petugas/{{$kendaraan->petugas->id}}/email" class="btn btn-warning btn-sm">Kirim Pesan</a>
										<a href="/kendaraan/{{$kendaraan->id}}/update2" class="btn btn-primary btn-sm">Update</a>
									</td>
								</tr>
								<?php
							}
							?>
							@endforeach
						</tbody>
					</table>			
				</div>
			</div>	
			
			
			@stop

			
			
