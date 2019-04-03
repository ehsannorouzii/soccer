@extends('layouts.admin_layout')
@section('title')
    <h1>افزودن بازیکن جدید</h1>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"> ایجاد بازیکن</h3>
        </div>

        <form action="{{route('player.store')}}" method="post" role="form" class="form" enctype="multipart/form-data">
            @csrf
            <div class="box-body">

                <div class="form-group col-md-8">
                    <label for="name">نام </label>
                    <input type="text" name="name" class="form-control" id="name" >
                </div>

                <div class="form-group col-md-8">
                    <label for="lastname">نام خانوادگی</label>
                    <input type="text" name="lastname" class="form-control" id="lastname" >
                </div>
                
                <div class="form-group col-md-8">
                    <label for="age"> سن </label>
                    <input type="text" name="age" class="form-control" id="age" >
                </div>

                <div class="form-group col-md-8">
                    <label for="nationality"> ملیت </label>
                    <input type="text" name="nationality" class="form-control" id="nationality" >
                </div>

                <div class="form-group  col-md-8 " dir="rtl">
                    <label for="team_id">انتخاب تیم</label>
                  
                    <select name="team_id" id="team_id" class="form-control selectpicker" data-live-search="true" dir="rtl">
                    <option value="" style="text-align: right" ></option>

                    @foreach ($teams as $team)
                    <option value="{{$team->id}}">{{$team->name}}</option>

                    @endforeach
                       
                    </select>

                   
                   
                </div>
                <div class="form-group col-md-8">
                    <label for="image">تصویر</label>
                    <input type="file" name="image" id="image" onchange="loadFile(event)" style="display:none">
                    <img src="{{ url('images/no_avatar.png') }}" id="output" width="100" onclick="select_file()">
                </div>
              
                    

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">ثبت</button>
            </div>
        </form>
    </div>

@endsection
@push('script')

<script>
    select_file = function () {
        document.getElementById('image').click();
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