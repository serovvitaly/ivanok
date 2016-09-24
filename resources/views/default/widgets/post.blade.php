<div class="micro-post-item" id="post-micro-{{ $record->id }}">
    <div class="micro-post-wrapper">
        {{--<div>
            <img style="width: 100%" src="/img/250x200/{{ $record->getMainImage() }}" />
        </div>--}}
        <a class="micro-post-title" href="/guru/post/{{ $record->id }}">{{ $record->title }}</a>
        <p class="small" style="color: grey">{{ $record->description }}</p>
    </div>
</div>