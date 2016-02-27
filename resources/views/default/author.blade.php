@extends('default.layouts.grid-9-3')

@section('content-9')

    <div class="row">
        <div class="col-lg-6 text-right">
            <img src="{{ $author->getImageUrl() }}" alt="{{ $author->getFullName() }}" class="img-circle media-object" style="width: 140px; display: inline-block;">
        </div>
        <div class="col-lg-6">
            <h1 class="title">{{ $author->getFullName() }}</h1>
            <p>Руководитель веб-студии. Член Российского союза писателей. <a href="http://vk.com/irena_gavrilova">vk.com/irena_gavrilova</a></p>
            <div class="row small text-center" style="font-weight: bold">
                <div class="col-lg-4"><a href="/?author={{ $author->id }}">359 публикаций</a></div>
                <div class="col-lg-4">33.9k подписчиков</div>
                <div class="col-lg-4">135 подписок</div>
            </div>
        </div>
    </div>



@endsection
