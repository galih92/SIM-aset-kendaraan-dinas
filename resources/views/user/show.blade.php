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
          <h4 class="card-title">Detail <b>{{$user->username}}</b></h4>
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title">Data User</h3> 

              <div class="form-group">
                <label for="exampleInputEmail1">Foto</label>
                <input type="file" class="uploads form-control" style="margin-top: 20px; width: 50%;" name="gambar">
                <img class="product" width="200" height="200" @if(user->gambar) src="{{ asset('images/user/'.$user->gambar) }}" @endif />
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Nama User </label>
                <input class="form-control" value="{{$user->username}}" readonly="">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input class="form-control" value="{{$user->emai}}" readonly="">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">No telefon</label>
                <textarea class="form-control" readonly="" >{{$user->telp}}</textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Level</label>
                <textarea class="form-control" readonly="" >{{$user->level}}</textarea>
              </div>

              <button  href="{{route('petugas.index')}}" class="btn btn-primar btn-warning">Back</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
