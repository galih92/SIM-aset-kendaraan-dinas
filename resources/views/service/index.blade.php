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
					<div class="right">

						<!-- tablist -->
						@if(Auth::user()->level=='admin')
						<a href="/service/exportexcel" class="btn btn-primary">EXPORT EXCEL</a>
						<a href="/service/exportpdf" class="btn btn-primary">EXPORT PDF</a>
						<a  class="btn btn-primary" data-toggle="modal" data-target="#myModal">Cetak</a>
						@endif
						<div class="panel">
							<div class="custom-tabs-line tabs-line-bottom left-aligned">
								<ul class="nav" role="tablist">
									<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Pengajuan</a></li>
									<li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Selesai </a></li>
								</ul>
							</div>
							<div class="tab-content">
								<div class="tab-pane fade in active" id="tab-bottom-left1">
									<table id="" class="table table-bordered table-striped ">
										<thead>
											<tr>
												<th>No</th>
												<th>No Kedaraan</th>							
												<th>Nama pemegang kendaraan</th>
												<th>Tgl Service</th>
												<th>Kategori</th>
												<th>Status</th>
												<th>Opsi</th>

											</tr>
										</thead>
										<tbody>
											<?php $no = 0;?>
											@foreach($data_service_pengajuan as $service)
											<?php $no++ ;?>
											<tr>
												<td>{{$no}}</td>
												<td><a data-no_kendaraan="{{$service->no_kendaraan}}" data-tgl_service="{{$service->tgl_service}}" data-kategori_service="{{$service->kategori_service}}" data-foto_service="{{$service->foto_service}}" data-status="$service->status" data-toggle="modal" data-target="#exampleModal">{{$service->no_kendaraan}}</a></td>	
												<td>{{$service->nama_petugas}}</td>
												<td>{{$service->tgl_service}}</td>
												<td>{{$service->kategori_service}}</td>
												<td>{{$service->status}}</td>
												<td>
													@if(Auth::user()->level=='admin')
													<a href="/service/{{$service->id}}/update2" class="btn btn-warning btn-sm">Update</a>

													<a href="/service/{{$service->id}}/terima" class="btn btn-danger btn-sm">Terima</a>
													@endif

												</td>
											</tr>
										</tbody>
										@endforeach
									</table>
									{{$data_service_pengajuan->links()}}
								</div>


								<div class="tab-pane fade" id="tab-bottom-left2">
									<table id="" class="table table-bordered table-striped ">
										<thead>
											<tr>
												<th>No</th>
												<th>No Kedaraan</th>							
												<th>Nama pemegang kendaraan</th>
												<th>Tgl Service</th>
												<th>Kategori</th>
												<th>Status</th>


											</tr>
										</thead>
										<tbody>
											<?php $no = 0;?>
											@foreach($data_service_diterima as $service)
											<?php $no++ ;?>
											<tr>
												<td>{{$no}}</td>
												<td><a data-no_kendaraan="{{$service->no_kendaraan}}" data-tgl_service="{{$service->tgl_service}}" data-kategori_service="{{$service->kategori_service}}" data-foto_service="{{$service->foto_service}}" data-status="$service->status" data-toggle="modal" data-target="#exampleModal">{{$service->no_kendaraan}}</a></td>	
												<td>{{$service->nama_petugas}}</td>
												<td>{{date('d-m-Y', strtotime($service->created_at))}}</td>
												<td>{{$service->kategori_service}}</td>
												<td>{{$service->status}}</td>

											</tr>
										</tbody>
										@endforeach
									</table>
									{{$data_service_pengajuan->links()}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLabel">PENGAJUAN KENDARAAN</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="exampleInputEmail1">No Kendaraan</label>
						<input name="no_kendaraan" type="text" class="form-control" id="no_kendaraan" aria-describedby="emailHelp">
					</div>

					<div class="form-group">
						<label for="exampleInputEmail1">Tgl Service</label>
						<input name="tgl_service" type="date" class="form-control" id="tgl_service" aria-describedby="emailHelp">
					</div>

					<div class="form-group">
						<label for="exampleInputEmail1">Kategori Service</label>
						<input name="kategori_service" type="text" class="form-control" id="kategori_service" aria-describedby="emailHelp">
					</div>

					<div class="form-group">
						<label for="exampleInputEmail1">Status Seevice</label>
						<input name="status" type="text" class="form-control" id="status" aria-describedby="emailHelp">
					</div>
					<div class="form-group-">
						<label for="exampleInputEmail1">Foto Sevice</label>
						<div><img class="product" width="200" height="200" id="foto_service" name="foto_service"></div>	
					</div>

				</form>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<a href="" class="btn btn-danger btn-sm">Terima</a>


				</div></div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="{{route('rekappdf.service')}}" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" id="exampleModalLabel">Cetak Data Servis</h4>
					</div>
					<div class="modal-body">
						<form action="{{route('rekappdf.service')}}" target="_blank" enctype="multipart/form-data">

							<div class="form-group">
								<label for="status" class="col-md-4 control-label">Jenis</label>
								<select class="form-control" id="status" name="status" required="">
									<option value="">--Pilih Status Kendaraan--</option>
									<option value="diterima">Diterima</option>
									<option value="pengajuan">Pengajuan</option>
									<option value="selesai">Selesai</option>
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



				<script>

					$('#exampleModal-edit').on('show.bs.modal',function(event){
						var button = $(event.relatedTarget)
						var no_kendaraan=button.data('no_kendaraan')
						var tgl_service=button.data('tgl_service')
						var kategori_service=button.data('kategori_service')
						var status=button.data('status')
						var foto_service=button.data('foto_service')

						var modal = $(this)

						modal.find('.modal-title').text('PENGAJUAN SERVICE');
						modal.find('.modal-body' #no_kendaraan).val(no_kendaraan);
					})
				</script>