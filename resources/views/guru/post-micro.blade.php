<div class="micro-post-item" id="post-micro-{{ $post->id }}">
    <div class="micro-post-wrapper">
        <div>
            <img style="width: 100%" src="/img/283x350/{{ $post->getMainImage() }}" />
        </div>
        <a class="micro-post-title" href="/guru/post/{{ $post->id }}">{{ $post->title }}</a>
        <p class="small" style="color: grey">{{ $post->description }}</p>
        {{--<a class="small" href="{{ $post->source_url }}">{{ $post->source_url }}</a>--}}
    </div>
</div>