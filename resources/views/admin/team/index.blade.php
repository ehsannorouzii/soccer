@extends('layouts.admin_layout')


@push('style')
    <link rel="stylesheet" href="{{url('/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('title')
    <h1>فهرست تیم ها</h1>
@endsection
@section('content')

    <div class="box">
        <div class="box-header">
            @if(session('success'))

                <div class="alert alert-success">
                    <h5>{{session('success')}}</h5>
                </div>
            @endif
            <div style="margin-top: 10px">
                <a class="btn-lg btn-success" title="ایجاد تیم جدید" href="{{route('team.create')}}">
                    <i class="fa fa-plus"  style="color:white" ></i></a>
            </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th> لوگو</th>
                    <th>نام تیم</th>
                    <th>مربی</th>
                    <th>کشور</th>
                   
                    <th colspan="2">عملیات</th>
                </tr>
                </thead>
                <tbody>
                {{--{{dd($users)}}--}}
                @php
                {{$i=1;}}
                @endphp
              
                @foreach($teams as $team)
                    <tr>

                        <td>{{$i}}</td>
                        @if ($team->logo)
                        <td> <img width="50px" height="50px" src="{{$team->logo}}" style=""></td>
                        @else
                            <td> <img src="{{ url('images/no_avatar.png') }}" id="output" width="50"></td>
                        @endif
                        <td>{{$team->name}}</td>
                        <td>{{$team->coachName}}</td>
                        <td>{{$team->country}}</td>

                       
                      
                        @php
                        {{$i++;}}
                        @endphp

                        <td>
                            <button title="ویرایش تیم" class="btn btn-primary"> <a href="{{route('team.edit',[$team->id])}}">
                                    <i class="fa fa-pencil"  style="color:white" ></i></a></button>
                        </td>
                        <td>

                            <a class="btn btn-danger onclick" title="حذف تیم" style="color: white;"
                               data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-trash"  style="color:white" ></i></a>



                        </td>


                    </tr>

                    {{--start modal --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">حذف تیم</h5>

                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    آیا از حذف تیم اطمینان دارید؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                            onclick="del_row('{{ route('team.destroy', $team->id) }}','{{Session::token()}}')">
                                        حذف
                                    </button>
                                    <button type="button" class="btn btn-default"
                                            data-dismiss="modal">بستن
                                    </button>


                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach


                </tbody>

            </table>
            {{ $teams->links() }}
        </div>

    </div>



@endsection

@push('script')
    <script src="{{ url('/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{ url('/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ url('/AdminLTE/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- page script -->
    <script>
        $(function () {

            $('#example1').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true
            })
        })
    </script>
    <script>
        function del_row(url, token) {
            $(".onclick").click(function () {
                $("#exampleModal").show("slow");
            });
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", url);
            var hiddenField1 = document.createElement("input");
            hiddenField1.setAttribute("name", "_method");
            hiddenField1.setAttribute("value", 'DELETE');
            form.appendChild(hiddenField1);
            var hiddenField2 = document.createElement("input");
            hiddenField2.setAttribute("name", "_token");
            hiddenField2.setAttribute("value", token);
            form.appendChild(hiddenField2);
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    </script>


@endpush