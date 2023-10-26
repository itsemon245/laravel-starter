@extends('blog::layouts.master')

@section('content')
     <h1>Index of {!! config('$STUDLY_NAME$.name') !!}</h1>

    <p>
        This view is loaded from module: {!! config('blog.name') !!}
    </p>
@endsection
