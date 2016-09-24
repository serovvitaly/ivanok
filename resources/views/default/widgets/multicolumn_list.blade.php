<?php
/**
 * @var $post \App\Models\NewPostModel
 */
?>
<div class="row">
    @foreach($multi_column_arr as $column_index => $column_arr)
    <div class="col-lg-4" id="list-column-{{ $column_index }}">
        @foreach($column_arr as $post_html)
            {!! $post_html !!}
        @endforeach
    </div>
    @endforeach
</div>