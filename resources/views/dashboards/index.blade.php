@extends('layouts.master')
<!doctype html>
<html lang="en">
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
						<div class="col-md-4">
							<div class="metric">
								<span class="icon"><i class="lnr lnr-user"></i></span>
								<p>
									<span class="number">{{$data_kendaraan->count()}}</span>
									<span class="title"><a href="" data-toggle="modal" data-target="#tampil_kendaraan">Kendaraan</a></span>
								</p>
							</div>
						</div>


						<div class="col-md-4">
							<div class="metric">
								<span class="icon"><i class="fa fa-shopping-bag"></i></span>
								<p>
									<span class="number">{{$data_petugas->count()}}</span>
									<span class="title">Petugas</span>
								</p>
							</div>
						</div>

						<div class="col-md-4">
							<div class="metric">
								<span class="icon"><i class="fa fa-eye"></i></span>
								<p>
									<span class="number">{{$data_service->count()}}</span>
									<span class="title"><a href="" data-toggle="modal" data-target="#tampil_service">Service</a></span>
								</p>
							</div>
						</div>
						
					</div>
				</div>
			</div>

			
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Data Kendaraan Yang Akan Membayar Pajak dan KIR</h3>	
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
								@if(Auth::user()->level=='admin')
								<th>Bayar Pajak/Kir</th>
								@endif
							</tr>
						</thead>
						<tbody>

							<?php $no = 0;?>
							@foreach($data_kendaraan as $kendaraan)
							<?php 
							$waktu = $mytime->diffInDays($kendaraan->tgl_berlaku & $kendaraan->tgl_kir);
							if ($waktu <= 30) {
		                    # code...
								$no++ ;?>
								<tr>
									<td>{{$no}}</td>
									<td><a href="/kendaraan/{{$kendaraan->id}}/profile">{{$kendaraan->no_kendaraan}}</a></td>
									<td>{{$kendaraan->petugas->nama_petugas}}</td>

									<?php
									$waktu = $mytime->diffInDays($kendaraan->tgl_berlaku);
									if ($waktu > 359) {
										$waktu = floor($waktu/360)." Tahun ";
									}else if ($waktu >30 ){
										$waktu = floor($waktu/30)."Bulan";
									}else{
										$waktu = $waktu ." Hari";
									}
									?>

									<td> {{$waktu}}</td>

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
									@if(Auth::user()->level=='admin')
									<td>
										<a href="/kendaraan/{{$kendaraan->id}}/bayar_pajak" class="btn btn-primary btn-sm">Pajak</a>
										<a href="/kendaraan/{{$kendaraan->id}}/bayar_kir" class="btn btn-success btn-sm">KIR</a>
									</td>
									@endif
								</tr>
								<?php
							}
							?>
							@endforeach
						</tbody>
					</table>			
				</div>
			</div>	
			@if(Auth::user()->level == 'kadin')
			<div class="row">
				<div class="col-md-6">
					<!-- START MULTI CHARTS KENDARAAN -->
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><a href="" data-toggle="modal" data-target="#tampil_kendaraan">Kendaraan</a></h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
								<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
							</div>
						</div>
						<div class="panel-body no-padding">
							<div id="chartKendaraan"></div>	
						</div>
					</div>
					<!-- START MULTI CHARTS KENDARAAN -->
				</div>
				<!-- START MULTI CHARTS SERVICE -->
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><a href="" data-toggle="modal" data-target="#tampil_service">Recent Service</a></h3>
							<div class="right">
								<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
								<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
							</div>
						</div>
						<div class="panel-body no-padding">
							<div id="chartService"></div>	
						</div>
					</div>
					<!-- END MULTI CHARTS SERVICE -->

					<!-- -------------------------START MODAL KENDARAAN ---------------------------->
					<div class="modal fade" id="tampil_kendaraan" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content" style="border-radius: 10px;width: 102%;">
								<div class="modal-header">
									<h3 class="modal-title" id="mediumModalLabel">Data Kedaraan</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<?php 
								?>
								<div class="table table-bordered table-striped">
									<center>
										<?php
										$hitung_motor = DB::table('tb_kendaraan')->where('jenis','motor')->count();
										$hitung_tosa = DB::table('tb_kendaraan')->where('jenis','tosa')->count();
										$hitung_mobil = DB::table('tb_kendaraan')->where('jenis','mobil')->count();
										$hitung_truck = DB::table('tb_kendaraan')->where('jenis','truck dump')->count();
										$hitung_dump = DB::table('tb_kendaraan')->where('jenis','truck angkut')->count();
										?>
										<table border>
											<thead style="text-align:center;font-weight: bold;background-color: lightblue;">
												<td>JUMLAH MOTOR</td>
												<td>JUMLAH MOBI</td>
												<td>JUMLAH TOSA</td>
												<td>JUMLAH TRUCK</td>
											</thead>
											<tbody style="text-align:center;font-weight: bold;padding: 0px 30px 0px 30px;">
												<td><h2>{!!$hitung_motor!!}</h2></td>
												<td><h2>{!!$hitung_mobil!!}</h2></td>
												<td><h2>{!!$hitung_tosa!!}</h2></td>
												<td><h2>{!!$hitung_truck!!}</h2></td>
											</tbody>
										</table>
									</center>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Tutup</button>
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->
					<!-- -------------------------START MODAL SERVICE ---------------------------->
					<div class="modal fade" id="tampil_service" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content" style="border-radius: 10px;width: 102%;">
								<div class="modal-header">
									<h3 class="modal-title" id="mediumModalLabel">Detail data Service</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<?php 
								?>
								<div class="modal-body">
									<center>
										<?php
										$hitung_service = DB::table('tb_service')->count();
										$hitung_pengajuan = DB::table('tb_service')->where('status','pengajuan')->count();
										$hitung_diterima = DB::table('tb_service')->where('status','diterima')->count();
										$hitung_selesai = DB::table('tb_service')->where('status','selesai')->count();
										?>
										<table border>
											<thead style="text-align:center;font-weight: bold;background-color: lightblue; padding: 0px 30px 0px 30px;">
												<td>JUMLAH PENGAJUAN</td>
												<td>JUMLAH DITERIMA</td>
												<td>JUMLAH SEESAI</td>

											</thead>
											<tbody style="text-align:center;font-weight: bold;">
												<td><h2>{!!$hitung_pengajuan!!}</h2></td>
												<td><h2>{!!$hitung_diterima!!}</h2></td>
												<td><h2>{!!$hitung_selesai!!}</h2></td>

											</tbody>
										</table>
									</center>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Tutup</button>
								</div>
							</div>
						</div>
					</div>
					<!-- END MODAL -->


					@stop
					<?php
					$hitung_motor = DB::table('tb_kendaraan')->where('jenis','motor')->count();
					$hitung_tosa = DB::table('tb_kendaraan')->where('jenis','tosa')->count();
					$hitung_mobil = DB::table('tb_kendaraan')->where('jenis','mobil')->count();
					$hitung_truck = DB::table('tb_kendaraan')->where('jenis','truck dump')->count();
					$hitung_dump = DB::table('tb_kendaraan')->where('jenis','truck angkut')->count();
					?>

					@section('footer')
					<script src="https://code.highcharts.com/highcharts.js"></script>
					
					<script>
						//Build the chart Service
						Highcharts.chart('chartKendaraan', {
							chart: {
								plotBackgroundColor: null,
								plotBorderWidth: null,
								plotShadow: false,
								type: 'pie'
							},
							title: {
								text: 'Data Kendaraan Pada, {{$now}}'  
							},
							tooltip: {
								pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
							},
							accessibility: {
								point: {
									valueSuffix: '%'
								}
							},
							plotOptions: {
								pie: {
									allowPointSelect: true,
									cursor: 'pointer',
									dataLabels: {
										enabled: false
									},
									showInLegend: true
								}
							},
							series: [{
								name: 'Kendaraan',
								colorByPoint: true,
								data: [{
									name: 'Roda Dua',
									y: {!!$hitung_motor!!},

								}, {
									name: 'Roda Tiga',
									y: {!!$hitung_tosa!!}
								},{
									name: 'Roda Empat',
									y: {!!$hitung_mobil!!}
								}, {
									name: 'Truck Muatan',
									y: {!!$hitung_truck!!}
								}, {
									name: 'Truck Dump',
									y: {!!$hitung_dump!!}
								}]
							}]
						});
					</script>

					<?php
					$hitung_service = DB::table('tb_service')->count();
					$hitung_pengajuan = DB::table('tb_service')->where('status','pengajuan')->count();
					$hitung_diterima = DB::table('tb_service')->where('status','diterima')->count();
					$hitung_selesai = DB::table('tb_service')->where('status','selesai')->count();
					?>

					<script src="https://code.highcharts.com/highcharts.js"></script>
					<script>
					// Build the chart Kendaraan
					Highcharts.chart('chartService', {
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false,
							type: 'pie'
						},
						title: {
							text: 'Data Service Pada, {{$now}}'  
						},
						tooltip: {
							pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						accessibility: {
							point: {
								valueSuffix: '%'
							}
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: false
								},
								showInLegend: true
							}
						},
						series: [{
							name: 'Service',
							colorByPoint: true,
							data: [{
								name: 'Service',
								y: {!!$hitung_service!!},

							}, {
								name: 'Pengajuan',
								y: {!!$hitung_pengajuan!!}
							},{
								name: 'Proses',
								y: {!!$hitung_diterima!!}
							}, {
								name: 'Selesai',
								y: {!!$hitung_selesai!!}
							}]
						}]
					});

				</script>
				@endif
				</html>
				@stop



