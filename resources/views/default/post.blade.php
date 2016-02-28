<div class="row" itemscope itemtype="http://schema.org/BlogPosting">
    <div class="col-lg-12" style="margin: 20px 0">
        <h2 itemprop="headline" style="margin: 0 0 10px; display: inline-block" class="title">
            <a itemprop="url" href="{{ $post->url }}">{{ $post->title }}</a>
        </h2>
        <!-- post_id : {{ $post->id }} -->
        <p itemprop="description">{{ $post->getAnnotation() }}</p>
        <div class="row small" style="color: grey">
            <div class="col-lg-12">
                @include('default.widgets.stats', ['post' => $post])
            </div>
        </div>
    </div>
</div>