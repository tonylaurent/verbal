@extends('theme.layout')

@section('title', $post->title)
@section('description', $post->summary)

@section('content')
    @if ($post->image)
        <img src="/storage/{{ $post->image }}" style="width: 100%" />
    @endif

    <div>
        {!! $post->html !!}
    </div>
@endsection
