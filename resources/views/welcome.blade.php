@extends('default.layouts.grid-9-3')

@section('content-3')
    @include('default.widgets.posts-prime', ['post' => \App\Models\PostModel::find(1901)])
    @include('default.widgets.social-content')
@endsection

@section('content-9')
    @include('default.posts')
@endsection
