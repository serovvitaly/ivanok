@extends('default.layouts.grid-9-3')

@section('left-side')
<hr>
    <a class="btn btn-default btn-sm" href="/guru">К списку статей</a>
@endsection

@section('content-3')
    <div>
        <div class="head3 title">ИНТЕРЕСНЫЕ СТАТЬИ</div>
        @include('default.widgets.list', [
            'records' => \App\Models\NewPostModel::where('status', '=', 1)
                ->where('id', '<>', $post->id)
                ->offset(rand(0, 95))
                ->take(5)
                ->get(),
            'view' => 'default.widgets.post',
        ])
    </div>
@endsection

@section('content-9')
    <div class="row">
        <div class="col-lg-12">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>
            <div style="width: 500px; margin: 10px auto;">
                <ul class="image-prime-gallery">
                    @foreach($post->images as $image)
                        <li data-thumb="/img/100x100/{{ $image->file_name }}">
                            <img style="width: 100%" src="/img/500x620/{{ $image->file_name }}" />
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                {!! $post->getContent() !!}
            </div>
        </div>
    </div>
@endsection