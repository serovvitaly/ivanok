<div class="row">
    <div class="col-lg-12" style="margin: 15px 0">
        <div class="small">{{ $post->getHumanDate() }}</div>
        <h2 style="margin: 0 0 10px" class="title"><a href="{{ $post->url }}">{{ $post->title }}</a></h2>
        <div class="row small" style="color: grey">
            <div class="col-lg-2">
                <span class="glyphicon glyphicon-eye-open"></span> {{ $post->counter | 8 }}
                <span class="glyphicon glyphicon-heart"></span> {{ $post->likes | 3 }}
            </div>
            <div class="col-lg-1">
                <strong><a href="#">@irgav</a></strong>
            </div>
            <div class="col-lg-4">
                <span class="glyphicon glyphicon-comment"></span>
                <a href="{{ $post->url }}#comments">Оставить комментарий</a>
            </div>
        </div>
    </div>
</div>