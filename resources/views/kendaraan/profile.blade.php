@extends('layouts.master')

@section('content')
<!doctype html>
<html lang="en">

<div class="main">
	<!-- MAIN CONTENT -->
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-profile">
				<div class="clearfix">
					<!-- LEFT COLUMN -->
					<div class="profile-left">
						<!-- PROFILE HEADER -->
						<div class="profile-header">
							<div class="overlay"></div>
							<div class="profile-main">
								<img src="{{$kendaraan->petugas->getFoto()}}" class="img-circle" alt="Avatar" style="margin-right: 10px; width: 130px; height: 130px" >
								<h3 class="name">{{$kendaraan->petugas->nama_petugas}}</h3>
								<span class="online-status status-available">Available</span>
							</div>
							<div class="profile-stat">
								<div class="row">
									<div class="col-md-4 stat-item">
										45 <span>Projects</span>
									</div>
									<div class="col-md-4 stat-item">
										15 <span>Awards</span>
									</div>
									<div class="col-md-4 stat-item">
										2174 <span>Points</span>
									</div>
								</div>
							</div>
						</div>
						<!-- END PROFILE HEADER -->
						<!-- PROFILE DETAIL -->
						<div class="profile-detail">
							<div class="profile-info">
								<h4 class="heading">Basic Info</h4>
								<ul class="list-unstyled list-justify">
									<li>Nama Petugas <span>{{$kendaraan->petugas->nama_petugas}}</span></li>
									<li>Alamat <span>{{$kendaraan->petugas->alamat}}</span></li>
									<li>No Telepon <span>{{$kendaraan->petugas->no_hp}}</span></li>
									<li>Email <span>{{$kendaraan->petugas->email}}</span></li>
								</ul>
							</div>
							<div class="text-center"><a href="/petugas/{{$kendaraan->petugas_id}}/edit" class="btn btn-primary">Edit Profile</a></div>

						</div>
						<!-- END PROFILE DETAIL -->
					</div>
					<!-- END LEFT COLUMN -->
					<!-- RIGHT COLUMN -->
					<div class="profile-right">
						<h4 class="heading">Kendaraan</h4>

						<!-- TABBED CONTENT -->
						<div class="custom-tabs-line tabs-line-bottom left-aligned">
							<ul class="nav" role="tablist">
								<li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Data Kendaraan</a></li>

							</ul>
						</div>
						<div class="profile-detail">
							<div class="profile-info">
								<h4 class="heading">Basic Info</h4>
								<ul class="list-unstyled list-justify">
									<li>No Kendaraan<span>{{$kendaraan->no_kendaraan}}</span></li>
									<li>Tempat Tugas <span>{{$kendaraan->tempat_tugas}}</span></li>
									<li>Jenis <span>{{$kendaraan->jenis}}</span></li>
									<li>Tgl Berlaku <span>{{$kendaraan->tgl_berlaku}}</span></li>
									<li>Tgl KIR <span>{{$kendaraan->tgl_kir}}</span></li>
								</ul>
							</div>
							<div class="text-center"><a  href="/kendaraan/{{$kendaraan->id}}/edit"class="btn btn-primary">Edit Kendaraan</a></div>
							<div class="profile-info">
								<h4 class="heading">Foto Kendaraan</h4>
								<ul class="list-inline social-icons">
									<div class="form-group">
										<img class="product" width="200" height="200" @if($kendaraan->gambar) src="{{ asset('images/user/'.$kendaraan->gambar) }}" @endif />
									</div>
								</ul>
							</div>
						</div>
						<!-- END TABBED CONTENT -->
					</div>
					<!-- END RIGHT COLUMN -->
				</div>
			</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->
</div>

</html>

@endsection