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
                    <h4 class="card-title">Tambah Data User</h4>
                    <div class="panel">
                      <div class="panel-heading">
                        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username ..">

                                @if($errors->has('username'))
                                <div class="text-danger">
                                    {{ $errors->first('username')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email ..">

                                @if($errors->has('email'))
                                <div class="text-danger">
                                    {{ $errors->first('email')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" name="telp" class="form-control" placeholder="No Telp ..">

                                @if($errors->has('telp'))
                                <div class="text-danger">
                                    {{ $errors->first('telp')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label >Gambar</label>
                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="gambar">
                                <img class="product" width="200" height="200" />
                            </div>
                            
                            <div class="form-group">
                                <label for="level" class="col-md-4 control-label">Level</label>
                                <select class="form-control" name="level" required="">
                                    <option value=""></option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                    <option value="kadin">Kepala Dinas</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>


                    <button type="submit" class="btn btn-primary" id="submit">
                        Register
                    </button>
                    <button type="reset" class="btn btn-danger">
                        Reset
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</form>
@endsection