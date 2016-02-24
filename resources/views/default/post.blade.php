<div class="row">
    <div class="col-lg-12" style="margin: 20px 0">
        <h2 style="margin: 0 0 10px; display: inline-block" class="title">
            <a href="{{ $post->url }}">{{ $post->title }}</a>
        </h2>
        <p>{{ $post->getAnnotation() }}</p>
        <div class="row small" style="color: grey">
            <div class="col-lg-12">
                @include('default.widgets.stats', ['post' => $post])
            </div>
        </div>
    </div>
</div>