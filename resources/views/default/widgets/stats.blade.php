<div class="liner">
    <span class="glyphicon glyphicon-eye-open"></span> {{ $post->counter | 0 }}
</div>
<div class="liner">
    <span class="glyphicon glyphicon-heart"></span> {{ $post->likes | 0 }}
</div>
<div class="liner" title="{{ $post->author->name }}">
    <img src="{{ $post->author->getImageUrl() }}" alt="{{ $post->author->name }}" class="img-circle media-object" style="width: 16px; display: inline-block">
    <strong><a href="/author/{{ $post->author->getLogin() }}"> {{ $post->author->getLogin() }}</a></strong>
</div>
{{-- <div class="liner">
    <span class="glyphicon glyphicon-comment"></span>
    <a href="{{ $post->url }}#comments">Оставить комментарий</a>
</div> --}}
<div class="liner">
    <span class="glyphicon glyphicon-time"></span>
    <span>{{ $post->getHumanDate() }}</span>
</div>
@if( Gate::allows('update-post', $post) and ( ! isset($edit) or $edit != 0 ) )
<div class="liner">
    <div class="btn-group btn-group-xs">
        <a href="/post/{{ $post->id }}/edit" class="btn btn-warning btn-xs">
            <span class="glyphicon glyphicon-pencil"></span> Редактировать
        </a>
        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            @if( Gate::allows('publication-post', $post) )
                @if($post->isPublished())
                    <li><a href="/post/{{ $post->id }}/set-int?is_published=0">
                        <span class="glyphicon glyphicon-off"></span> Снять с публикации
                    </a></li>
                @else
                    <li><a href="/post/{{ $post->id }}/set-int?is_published=1">
                        <span class="glyphicon glyphicon-ok"></span> Опубликовать
                    </a></li>
                @endif
                @if($post->isActual())
                    <li><a href="/post/{{ $post->id }}/set-int?is_actual=0">
                        <span class="glyphicon glyphicon-eye-close"></span> Скрыть
                    </a></li>
                @else
                    <li><a href="/post/{{ $post->id }}/set-int?is_actual=1">
                        <span class="glyphicon glyphicon-eye-open"></span> Показать
                    </a></li>
                @endif
            @endif
        </ul>
    </div>
</div>
@endif

@if( ! isset($rubrics) or $rubrics != 0 )
<div class="row">
    <div class="col-lg-12">
        @foreach($post->rubrics()->get() as $rubric)
            <a href="#"><strong>{{ $rubric->title }}</strong></a>,
        @endforeach
    </div>
</div>
@endif