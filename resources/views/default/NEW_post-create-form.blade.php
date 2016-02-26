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
                    <label for="post-note">Аннотация</label>
                    <textarea class="form-control" id="post-note"></textarea>
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
                    <textarea class="form-control" id="post-content">{{ $post->content or '' }}</textarea>
                </div>
                <hr>
                <div id="post-content-blocks"></div>
            </div>
        </div>
        <div class="col-lg-3">

            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div id="button-preview" class="btn-group" role="group">
                    <button type="button" class="btn btn-info" onclick="previewPost();"><span class="glyphicon glyphicon-eye-open"></span> Просмотр</button>
                </div>
                <div id="button-edit" class="btn-group" role="group" style="display: none">
                    <button type="button" class="btn btn-warning" onclick="editPost();"><span class="glyphicon glyphicon-pencil"></span> Редактировать</button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-success" onclick="savePost();"><span class="glyphicon glyphicon-ok"></span> Сохранить</button>
                </div>
            </div>
            <br>
            <div class="list-group-item list-group-item-warning">
                <p class="help-block small">Текстовый блок предназначен для размещения текста.</p>
                <button class="buttons-block btn btn-default btn-block" onclick="addTextBlock();">Добавить текстовый блок</button>
            </div>
            <div class="list-group-item list-group-item-info">
                <p class="help-block small">Блок картинок предназначен для размещения одиночных изображений, или нескольких изображений в виде галереи.</p>
                <button class="buttons-block btn btn-default btn-block" onclick="addImageBlock();">Добавить блок картинок</button>
            </div>
            <div class="list-group-item list-group-item-danger">
                <p class="help-block small">Блок видео предназначен для размещения ссылок на видеоролики в YouTube</p>
                <button class="buttons-block btn btn-default btn-block">Добавить блок видео</button>
            </div>
        </div>
    </div>
</div>
<script src="/ckeditor/ckeditor.js"></script>
<script>
    var _TOKEN = '{{ csrf_token() }}';
    function getToken(){
        if (!_TOKEN) {
            //
        }
        return _TOKEN;
    }
    var blocksCounter = 1;
    function getBlockNumber(){
        return blocksCounter++;
    }
    function getBlocksContentsArr(){
        var blocksContentsArr = [];
        $.each(CKEDITOR.instances, function(blockID, instance){
            blocksContentsArr.push({
                type: 'text',
                html: instance.getData()
            });
        });
        return blocksContentsArr;
    }
    function previewPost(){
        var postTitle = $('#post-title').val();
        var postNote = $('#post-note').val();
        var content = '<h1 class="lobster">'+postTitle+'</h1>';
        content += '<p><em>'+postNote+'</em></p><hr>';

        $.each(getBlocksContentsArr(), function(index, blockContent){
            content += blockContent.html;
        });

        $('.buttons-block').attr('disabled', 'disabled');

        $('#button-preview').hide();
        $('#button-edit').show();

        $('#post-editor').hide();
        $('#post-preview-container').html(content);
    }
    function editPost(){
        $('.buttons-block').attr('disabled', null);

        $('#button-preview').show();
        $('#button-edit').hide();

        $('#post-editor').show();
        $('#post-preview-container').html('');
    }
    function savePost(){
        $.ajax({
            url: '/post',
            type: 'POST',
            data: {
                _token: getToken(),
                title: $('#post-title').val(),
                note: $('#post-note').val(),
                blocks: getBlocksContentsArr()
            },
            success: function(response){
                //
            }
        });
    }
    function removeBlock(title, blockID){
        if ( ! confirm('Вы собираетесь удалить блок "' + title + '", все данные этого блока будут удалены. Продолжить?') ) {
            return false;
        }

        var currentBlockInstance = CKEDITOR.instances[blockID];
        if (currentBlockInstance) {
            currentBlockInstance.destroy();
        }

        $('#'+blockID).remove();
    }
    function addBlock(blockNumber, blockTitle, innerHtml){
        var blockID = 'content-block-'+blockNumber;
        var blockHtml = '<div id="'+blockID+'" class="form-group"><label class="block-header-label"><span class="glyphicon glyphicon-sort"></span> '+blockTitle+'</label>'
                +'<a class="small" href="#" onclick="removeBlock(\''+blockTitle+'\', \''+blockID+'\'); return false;">удалить</a>'
                +'<div class="content-block">'+innerHtml+'</div></div>';
        $('#post-content-blocks').append(blockHtml);
    }
    function addTextBlock(){
        var blockNumber = getBlockNumber();
        addBlock(blockNumber, 'Текстовый блок '+blockNumber, '<textarea rows="5" id="content-text-block-'+blockNumber+'"></textarea>');
        CKEDITOR.inline('content-text-block-'+blockNumber, {
            bodyClass: 'form-control',
            startupShowBorders: true,
            height: 500
        });
    }
    function addImageBlock(){
        var blockNumber = getBlockNumber();
        addBlock(blockNumber, 'Блок картинок '+blockNumber, '<a href="#" onclick="showImageLoaderDialog(); return false;" class="button-image-add"><span class="glyphicon glyphicon-picture"></span></a>');
    }
    function showImageLoaderDialog(){
        //
    }
</script>
@endsection
