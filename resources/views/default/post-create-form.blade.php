@extends('default.layouts.grid-9-3')

@section('content')
<style>
    .content-block{
        border-top: 1px dotted;
        border-bottom: 1px dotted;
        border-color: #CCCCCC;
        padding: 2px 0;
    }
    .content-block p{
        margin: 0;
    }
    .block-header-label {
        padding-right: 10px;
        cursor: move;
    }
    .block-header-label .glyphicon {
        color: red;
    }
    .button-image-add {
        border: 1px solid #B0C1DD;
        background: #EEEEEE;
        color: #B0C1DD;
        padding: 30px 36px 22px;
        display: inline-block;
        font-size: 48px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div id="post-preview-container"></div>
            <div id="post-editor">
                <div class="form-group">
                    <label for="post-title">Заголовок</label>
                    <input class="form-control" id="post-title" placeholder="введите заголовок статьи..." value="{{ $post->title or '' }}">
                </div>
                <div class="form-group">
                    <label for="post-keywords">Meta: keywords</label>
                    <input class="form-control" id="post-keywords" placeholder="введите заголовок статьи..." value="{{ $post->keywords or '' }}">
                </div>
                <div class="form-group">
                    <label for="post-description">Meta: description</label>
                    <textarea class="form-control" id="post-description">{{ $post->description or '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="post-content">Контент</label>
                    <textarea rows="20" class="form-control" id="post-content">{{ $post->content or '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-3">

            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-success" onclick="savePost({{ $post->id or 0 }});"><span class="glyphicon glyphicon-ok"></span> Сохранить</button>
                </div>
                <div class="btn-group" role="group">
                    <a class="btn btn-default" href="/post">Отмена</a>
                </div>
            </div>
            <hr>
            <strong>Рубрика</strong>
            <div class="checkbox">
                <label>
                    <input type="radio" value="" name="post-category">
                    Здоровье
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="radio" value="" name="post-category">
                    Воспитание
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="radio" value="" name="post-category">
                    Развитие
                </label>
            </div>
        </div>
    </div>
</div>
<script src="/ckeditor/ckeditor.js"></script>
<script>

    CKEDITOR.replace('post-content');

    var _TOKEN = '{{ csrf_token() }}';
    function getToken(){
        if (!_TOKEN) {
            //
        }
        return _TOKEN;
    }
    function editPost(){
        $('.buttons-block').attr('disabled', null);

        $('#button-preview').show();
        $('#button-edit').hide();

        $('#post-editor').show();
        $('#post-preview-container').html('');
    }
    function savePost(postId){

        $.ajax({
            url: '/post' + (postId ? ('/' + postId) : ''),
            type: postId ? 'PUT' : 'POST',
            data: {
                _token: getToken(),
                title: $('#post-title').val(),
                keywords: $('#post-keywords').val(),
                description: $('#post-description').val(),
                content: CKEDITOR.instances['post-content'].getData()
            },
            success: function(response){
                window.location = '/post';
            }
        });
    }
    function cancelPost(){
        //
    }
</script>
@endsection
