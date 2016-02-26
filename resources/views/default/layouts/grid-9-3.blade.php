@extends('default.layout')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            @yield('content-9')
        </div>
        <div class="col-lg-3">
            <div id="right-scrollbar">
                @yield('content-3')
            </div>
            <script>
                $(function(){
                    $("#right-scrollbar").sticky({topSpacing: 10});
                })
            </script>
        </div>
    </div>
@endsection