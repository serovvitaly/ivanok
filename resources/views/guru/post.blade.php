@extends('default.layouts.grid-9-3')

@section('left-side')
<hr>
    <a class="btn btn-default btn-sm" href="/guru">К списку статей</a>
@endsection

@section('content-3')
    <div>
        <div class="head3 title">НЕМНОГО ПОДРОБНОСТЕЙ</div>
        <table class="table small table-condensed">
            <tr>
                <td>8,1</td>
                <td>
                    <a target="_blank" href="http://www.imdb.com/title/tt2948356/?ref_=nv_sr_3">
                        <span onclick="yaCounter6800620.reachGoal('_PART_BTN_IMDB'); return true;">IMDb</span>
                    </a>
                </td>
            </tr>
            <tr>
                <td>8,8</td>
                <td>
                    <a target="_blank" href="http://www.kinopoisk.ru/film/775276/">
                        <span onclick="yaCounter6800620.reachGoal('_PART_BTN_KINOP'); return true;">КиноПоиск</span>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Премьера</td>
                <td>3 марта 2016</td>
            </tr>
            <tr>
                <td>Режиссёр</td>
                <td>Байрон Ховард, Рич Мур, Джаред Буш</td>
            </tr>
            <tr>
                <td>Время</td>
                <td>108 мин.</td>
            </tr>
            <tr>
                <td>Страна</td>
                <td>США</td>
            </tr>
            <tr>
                <td>Год производства</td>
                <td>2016</td>
            </tr>
            <tr>
                <td>Оригинальное название</td>
                <td>Zootopia</td>
            </tr>
        </table>

        {{--
        <button type="button" class="btn btn-danger btn-block btn-lg font-condensed"><strong>Я пойду!</strong> уже идет 247</button>
        --}}
    </div>
    <hr>
    <div class="head3 title">В кинотеатрах с 27 февраля:</div>
    <div class="list-group title">
        <a target="_blank" href="afisha.yandex.ru/events/557ec2c6cc1c7206dae6d306" class="list-group-item">
            <p class="list-group-item-text" onclick="yaCounter6800620.reachGoal('_PART_BTN_YA'); return true;">Яндекс.Афиша «Зверополис»</p>
        </a>
        <a target="_blank" href="https://kassa.rambler.ru/movie/63402" class="list-group-item">
            <p class="list-group-item-text" onclick="yaCounter6800620.reachGoal('_PART_BTN_RK'); return true;">Рамблер-Касса «Зверополис»</p>
        </a>
        <a target="_blank" href="https://afisha.mail.ru/cinema/movies/877169_zootopiya/" class="list-group-item">
            <p class="list-group-item-text" onclick="yaCounter6800620.reachGoal('_PART_BTN_AM'); return true;">Афиша Mail.Ru «Зверополис»</p>
        </a>
    </div>
    <hr>
    <div class="title">Поделитесь с друзьями:</div>
    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,twitter" data-counter="" data-size="m"></div>
@endsection

@section('content-9')
    <div class="row">
        <div class="col-lg-12">
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->description }}</p>
            <div style="width: 500px; margin: 10px auto;">
                <ul class="image-prime-gallery">
                    @foreach($post->images as $image)
                        <li data-thumb="/img/100x100/{{ $image->file_name }}">
                            <img style="width: 100%" src="/img/500x620/{{ $image->file_name }}" />
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                {!! $post->getContent() !!}
            </div>
        </div>
    </div>
@endsection