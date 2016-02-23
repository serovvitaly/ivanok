@extends('default.layouts.grid-9-3')

@section('content-9')
    @foreach($posts as $post)
        <div class="row">
            <div class="col-lg-12">
                <h2 class="title"><a href="{{ $post->url }}">{{ $post->title }}</a></h2>
                <a href="/post/{{ $post->id }}/edit">редактировать</a>
                <p>{{ $post->getHumanDate() }}</p>
            </div>
        </div>
    @endforeach
    {!! $posts->links() !!}
@endsection