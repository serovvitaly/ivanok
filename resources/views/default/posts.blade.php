
<?php
$posts = \App\Helpers\PostHelper::getPosts();
?>
@foreach($posts as $post)
    @include('default.post', ['post' => $post])
@endforeach
{!! $posts->links() !!}