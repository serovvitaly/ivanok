@extends('default.layouts.grid-9-3')

@section('content-3')
    @can('developer')
        @include('default.widgets.posts-prime', ['post' => \App\Models\PostModel::find(1900)])
    @endcan
@endsection

@section('content-9')
    @include('default.posts')
@endsection
