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

			@if(session('sukses'))
			<div class="alert alert-success" role="alert">
				{{session('sukses')}}
			</div>
			@endif

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
				<form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}

					  <div class="form-group">
					    <label for="exampleInputEmail1">Userame</label>
					    <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" value="{{$user->username}}">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email</label>
					    <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" value="{{$user->email}}">
					  </div>

					  <div class="form-group">
					    <label for="exampleInputEmail1">No Telp</label>
					    <input name="telp" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="No telp" value="{{$user->telp}}">
					  </div>

					   <div class="form-group">
                            <label for="exampleInputEmail1">Gambar</label>
                            <input type="file" class="uploads form-control" style="margin-top: 20px; width: 50%;" name="gambar">
                             <img class="product" width="200" height="200" @if($user->gambar) src="{{ asset('images/user/'.$user->gambar) }}" @endif />
                        </div>


                       <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                                <input id="password" type="password" class="form-control" onkeyup='check();' name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
					  <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
					    <label for="exampleInputEmail1">Level</label>
                            <select class="form-control" name="level" required="">
                                <option value="admin" @if($user->level == 'admin') selected @endif>Admin</option>
                                <option value="pegawai" @if($user->level == 'panitia') selected @endif>Pegawai</option>
                         
                            </select>
					  </div>
                     

					 <button type="submit" class="btn btn-primar btn-warning">Simpan</button>
					</form>
					</div>
					</div>
				</div>
			</div>
@endsection
