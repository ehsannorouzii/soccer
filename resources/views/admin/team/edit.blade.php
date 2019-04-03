@extends('layouts.admin_layout')
@section('title')
    <h1>ویرایش تیم</h1>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"> ویرایش تیم</h3>
        </div>

        <form action="{{route('team.update',[$team->id])}}" method="post" role="form" class="form" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="box-body">

                <div class="form-group col-md-8">
                    <label for="name">نام تیم</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$team->name}}">
                </div>

                <div class="form-group col-md-8">
                    <label for="coachName">نام مربی</label>
                    <input type="text" name="coachName" class="form-control" id="coachName" value="{{$team->coachName}}" >
                </div>
                
                <div class="form-group col-md-8">
                    <label for="country"> کشور </label>
                    <input type="text" name="country" class="form-control" id="country" value="{{$team->country}}" >
                </div>
              
                <div class="form-group col-md-8">
                    <label for="logo">لوگو تیم : </label>
                    <input type="file" name="logo" id="logo" onchange="loadFile(event)" style="display:none">
                    <img src="{{ url('images/no_avatar.png') }}" id="output" width="100" onclick="select_file()">
                </div>      

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">ویرایش</button>
            </div>
        </form>
    </div>

@endsection
@push('script')

<script>
    select_file = function () {
        document.getElementById('logo').click();
    };
    loadFile = function (event) {
        var render = new FileReader;
        render.onload = function () {
            var output = document.getElementById('output');
            output.src = render.result;
        };
        render.readAsDataURL(event.target.files[0]);
    }
</script>

@endpush