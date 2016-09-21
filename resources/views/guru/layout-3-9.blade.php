@extends('guru.layout')

@section('container')
    <div class="row">
        <div class="col-lg-2">
            @yield('left-side')
        </div>
        <div class="col-lg-10">
            @yield('content')
        </div>
    </div>
@endsection