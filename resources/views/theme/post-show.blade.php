@extends('theme.layout')

@section('title', $post->title)
@section('description', $post->summary)

@section('content')
    @if ($post->image_path)
        <img src="/storage/{{ $post->image_path }}" style="width: 100%" />
    @endif

    <div>
        {{ $post->content }}
    </div>
@endsection
