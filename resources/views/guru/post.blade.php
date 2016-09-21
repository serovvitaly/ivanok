@extends('guru.layout-3-9')

@section('left-side')
<hr>
    <a class="btn btn-default btn-sm" href="/guru">К списку статей</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>
        </div>
    </div>
@endsection