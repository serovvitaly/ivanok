@extends('default.layouts.grid-9-3')

@section('content-9')
<div itemscope itemtype="http://schema.org/BlogPosting">
    @foreach($post->rubrics()->get() as $rubric)
        <meta itemprop="genre" content="{{ $rubric->title }}">
    @endforeach
    <h1 itemprop="headline" class="title text-center">{{ $post->title }}</h1>

    <div class="row small" style="color: grey; margin-bottom: 20px;">
        <div class="col-lg-12">
            @include('default.widgets.stats', ['post' => $post])
        </div>
    </div>

    <article class="content" itemprop="text" itemprop="articleBody">
        {!! $post->getContent() !!}
    </article>
</div>

    <hr>
    <div>
        <h3 class="lobster">Автор</h3>
        <div class="media">
            <div class="media-left media-middle">
                <img src="http://ivanok.ru/img/ful64z7uyiY.jpg" alt="Ирина Гаврилова" class="img-circle media-object" style="width: 60px;">
            </div>
            <div class="media-body">
                <h4 class="media-heading">Ирина Гаврилова</h4>
                Руководитель веб-студии. Член Российского союза писателей.
            </div>
        </div>
    </div>
    <hr>
    <div style="margin: 50px 0;">
        <a name="comments"></a>
        <h3 class="lobster">Комментарии</h3>
        <hr class="no-border">
        {{--
        <div id="comments-list">
            <textarea id="comment-text" class="form-control" rows="3" placeholder="...введите такст, и нажмите - Отправить"></textarea>
            <div style="height: 10px;"></div>
            <button class="btn btn-primary btn-xs" onclick="sendComment();">Отправить</button>
            <script>
                function sendComment(){

                    if ( $('#comment-text').val() == '' ) return;

                    App.ajax.request({
                        url: '/comment',
                        type: 'post',
                        data: {
                            post_id: '1',
                            text: $('#comment-text').val()
                        },
                        afterSuccess: function(data){
                            //
                        }
                    });
                }
            </script>

        </div>
        --}}
    </div>
@endsection
