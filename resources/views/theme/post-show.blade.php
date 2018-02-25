@extends('theme.layout')

@section('content')
    <div class="col-sm-8 blog-main">
        @if ($post->image_path)
            <img src="/storage/{{ $post->image_path }}" style="width: 100%" />
        @endif

        <h1>{{ $post->title }}</h1>

        <div>
            {{ $post->content }}
        </div>
    </div>
@endsection
