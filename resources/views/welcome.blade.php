@extends('default.layouts.grid-9-3')

@section('content-3')
    @include('default.widgets.list', [
            'records' => \App\Models\NewPostModel::where('status', '=', 1)
                ->offset(rand(0, 95))
                ->take(5)
                ->get(),
            'view' => 'default.widgets.post',
        ])
@endsection

@section('content-9')
    @include('default.posts')
@endsection
