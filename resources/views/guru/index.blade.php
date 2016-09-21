@extends('guru.layout-3-9')

@section('left-side')
Клуб любительниц моды
@endsection

<?php

$posts_arr = \App\Models\NewPostModel::take(15)->get();

$posts_arr_col_1 = [];
$posts_arr_col_2 = [];
$posts_arr_col_3 = [];
foreach ($posts_arr as $index => $post) {

    $index++;

    if (($index % 3) == 0) {
        $posts_arr_col_3[] = $post;
    }
    elseif (($index % 2) == 0) {
        $posts_arr_col_2[] = $post;
    }
    else {
        $posts_arr_col_1[] = $post;
    }
}


?>

@section('content')
    <div class="row">
        <div class="col-lg-4">
            @foreach($posts_arr_col_1 as $post)
                @include('guru.post-micro', ['post' => $post])
            @endforeach
        </div>
        <div class="col-lg-4">
            @foreach($posts_arr_col_2 as $post)
                @include('guru.post-micro', ['post' => $post])
            @endforeach
        </div>
        <div class="col-lg-4">
            @foreach($posts_arr_col_3 as $post)
                @include('guru.post-micro', ['post' => $post])
            @endforeach
        </div>
    </div>
    <script>
        function microPostShowContent(postId, element) {
            //$('.post-content').hide();
            $('#post-micro-'+postId+' .post-content').toggle();
        }
    </script>
@endsection