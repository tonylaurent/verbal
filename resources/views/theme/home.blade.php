@extends('theme.layout')

@section('title', config('app.name'))
@section('description', 'The official example template of creating a blog with Bootstrap.')

@section('content')
    @each('theme.post-block', $posts, 'post')

    <nav>
        <ul class="pager">
          <li><a href="#">Previous</a></li>
          <li><a href="#">Next</a></li>
        </ul>
    </nav>
@endsection
