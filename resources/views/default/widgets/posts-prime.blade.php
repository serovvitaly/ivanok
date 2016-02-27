<div>



    <div class="box box-info">
        Премьера сезона,<br>не пропустите
    </div>

    <a href="{{ $post->getUrl() }}">
        <img alt="" src="/img/zootopia-0.jpg" style="width: 100%">
    </a>

    <div class="row small" style="color: grey">
        <div class="col-lg-12">
            @include('default.widgets.stats', ['post' => $post, 'edit' => 0, 'rubrics' => 0])
        </div>
    </div>

    <div class="head3 title text-center">
        <a href="{{ $post->getUrl() }}">{{ $post->title }}</a>
    </div>
    <p class="text-center small">
        {{ $post->description }}, <a class="strong" href="{{ $post->getUrl() }}">читайте далее...</a>
    </p>

    <div>
        <div class="strong title text-center">ПОСЛЕДНИЕ КОММЕНТАРИИ</div>
    </div>

</div>