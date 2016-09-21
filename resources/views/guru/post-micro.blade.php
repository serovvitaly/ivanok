<div class="micro-post-item" id="post-micro-{{ $post->id }}">
    <div class="micro-post-wrapper">
        <div>
            <ul class="image-prime-gallery">
                @foreach($post->images as $image)
                <li data-thumb="/img/40x40/{{ $image->file_name }}">
                    <img style="width: 100%" src="/img/283x350/{{ $image->file_name }}" />
                </li>
                @endforeach
            </ul>
        </div>
        <a class="micro-post-title" href="/guru/post/{{ $post->id }}">{{ $post->title }}</a>
        <p class="small" style="color: grey">{{ $post->description }}</p>
        <a href="#" onclick="microPostShowContent('{{ $post->id }}', this); return false;" data-show-text="Показать полный текст..." data-hide-text="Скрыть...">Показать полный текст...</a>
        <div class="small post-content" style="display: none; height: 306px; overflow-x: auto;">{!! $post->getContent() !!}</div>
        <a class="small" href="{{ $post->source_url }}">{{ $post->source_url }}</a>
        <div>
            <strong class="small">Комментарии</strong>
            <div>
                <div class="small" style="margin-bottom: 10px;">
                    <div style="padding-bottom: 2px; margin-bottom: 2px; border-bottom: 1px solid #ebebeb">
                        <div style="display: inline-block;">
                            <img style="height: 26px;" class="media-object" src="http://st-sh-1.woman.ru/womanru/legacy/r_9b91b6eb452b44e3b352e80d9884d8f0.jpg" alt="">
                        </div>
                        <div style="display: inline-block;">
                            <strong class="media-heading">Светлана Иванова</strong>
                            <div style="font-size: 10px; font-family: Tahoma;">14.04.2016, 19:30:38</div>
                        </div>
                    </div>
                    <div class="media-body" style="font-size: 11px; font-family: Tahoma">
                        Какая классная! Совершенная фигура! Я тоже хочу дойти до уровня - видно мышцы без перебора...
                        Пока никак, худею(( Великолепная девушка! Мечта фигура!
                    </div>
                </div>
                <div class="small" style="margin-bottom: 10px;">
                    <div style="padding-bottom: 3px; margin-bottom: 3px; border-bottom: 1px solid #ebebeb">
                        <div style="display: inline-block;">
                            <img style="height: 26px;" class="media-object" src="http://st-sh-1.woman.ru/womanru/legacy/r_9b91b6eb452b44e3b352e80d9884d8f0.jpg" alt="">
                        </div>
                        <div style="display: inline-block;">
                            <strong class="media-heading">Светлана Иванова</strong>
                            <div style="font-size: 10px; font-family: Tahoma;">14.04.2016, 19:30:38</div>
                        </div>
                    </div>
                    <div class="media-body" style="font-size: 11px; font-family: Tahoma">
                        Какая классная! Совершенная фигура! Я тоже хочу дойти до уровня - видно мышцы без перебора...
                        Пока никак, худею(( Великолепная девушка! Мечта фигура!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>