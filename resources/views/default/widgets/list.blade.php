@foreach($records as $record)
    @include($view, ['post' => $record])
@endforeach