<?php
/**
 * @var $multi_column_list
 */
?>
@extends('default.layouts.grid-9-3')

@section('left-side')
Клуб любительниц моды
@endsection

@section('content')
    {!!  $multi_column_list !!}
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="btn btn-primary btn-lg btn-block" onclick="showMore();">Показать ещё</div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <script>
        var globalOffset = 0;
        function microPostShowContent(postId, element) {
            //$('.post-content').hide();
            $('#post-micro-'+postId+' .post-content').toggle();
        }
        function showMore() {
            globalOffset += 15;
            $.get('/guru/', {
                ajax: 1,
                offset: globalOffset
            }, function(data){
                $.each(data, function(key, columnHtml){
                    $('#list-column-'+key).append(columnHtml);
                });
            });
        }
    </script>
@endsection