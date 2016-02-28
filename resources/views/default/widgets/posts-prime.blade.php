<div>
{{--
    <div class="box box-info">
        Премьера сезона,<br>не пропустите
    </div>
--}}

    <div class="head3 title text-center">
        <a href="{{ $post->getUrl() }}">
            <span onclick="yaCounter6800620.reachGoal('_WIDGET_TITLE'); return true;">{{ $post->title }}</span>
        </a>
    </div>

    <ul class="image-prime-gallery">
        <li data-thumb="/img/40x40/zootopia-8.jpg">
            <img src="/img/263x124/zootopia-8.jpg" />
        </li>
        <li data-thumb="/img/40x40/zootopia-3.jpg">
            <img src="/img/263x124/zootopia-3.jpg" />
        </li>
        <li data-thumb="/img/40x40/zootopia-5.jpg">
            <img src="/img/263x124/zootopia-5.jpg" />
        </li>
        <li data-thumb="/img/40x40/zootopia-6.jpg">
            <img src="/img/263x124/zootopia-6.jpg" />
        </li>
        <li data-thumb="/img/40x40/zootopia-9.jpg">
            <img src="/img/263x124/zootopia-9.jpg" />
        </li>
        <li data-thumb="/img/40x40/zootopia-7.jpg">
            <img src="/img/263x124/zootopia-7.jpg" />
        </li>
        <li data-thumb="/img/40x40/zootopia-4.jpg">
            <img src="/img/263x124/zootopia-4.jpg" />
        </li>
        <li data-thumb="/img/40x40/zootopia-10.jpg">
            <img src="/img/263x124/zootopia-10.jpg" />
        </li>
    </ul>
    <script src="/lib/lightslider/src/js/lightslider.js"></script>
    <script>
        $(document).ready(function() {
            $('.image-prime-gallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:9,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'center',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '.image-gallery .lslide'
                    });
                }
            });
        });
    </script>

    <div class="small" style="color: grey; margin: 5px 3px 5px;">
        @include('default.widgets.stats', [
            'post' => $post,
            'edit' => 0,
            'rubrics' => 0,
            'likes' => 0
        ])
    </div>

    <p class="text-center small">
        {{ $post->description }},
        <a class="strong" href="{{ $post->getUrl() }}">
            <span onclick="yaCounter6800620.reachGoal('_WIDGET_MORE'); return true;">читайте далее...</span>
        </a>
    </p>
{{--
    <div>
        <div class="strong title text-center">ПОСЛЕДНИЕ КОММЕНТАРИИ</div>
    </div>
--}}
</div>
<hr>
{{--@can('developer')--}}
<noindex>
@foreach(\App\Helpers\RssHelper::get('http://www.woman.ru/rss/', 6) as $rss_item)
<div>
    <strong class="title">
        <a rel="nofollow" target="_blank" href="{{ $rss_item->link }}" onclick="return redirectToRssPost('{{ base64_encode($rss_item->link) }}');">{{ $rss_item->title }}</a>
    </strong>
    <p class="small">{{ str_limit($rss_item->description, 100) }}</p>
</div>
@endforeach
</noindex>
{{--@endcan--}}
<script>
    function redirectToRssPost(url) {
        $.get('/redirect/' + url);
        return true;
    }
</script>