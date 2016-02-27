<div>



    <div class="box box-info">
        Премьера сезона,<br>не пропустите
    </div>

    <a href="{{ $post->getUrl() }}">
        <img alt="" src="/img/zootopia-0.jpg" style="width: 100%">
    </a>

    <div class="small color-grey text-center" style="margin: 5px 0 5px;">
        <div class="liner">
            <span class="glyphicon glyphicon-eye-open"></span> 0
        </div>
        <div class="liner">
            <span class="glyphicon glyphicon-heart"></span> 0
        </div>
        <div class="liner">
            <img src="http://ivanok.ru/img/ful64z7uyiY.jpg" alt="Ирина Гаврилова" class="img-circle media-object" style="width: 16px; display: inline-block">
            <strong><a href="/author/"> irgav</a></strong>
        </div>
        <div class="liner">
            <a href="{{ $post->getUrl() }}#comments" type="Оставить комментарий">
                <span class="glyphicon glyphicon-comment"></span>
                0
            </a>
        </div>
        <div class="liner">
            <span class="glyphicon glyphicon-time"></span>
            <span>{{ $post->getHumanDate() }}</span>
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