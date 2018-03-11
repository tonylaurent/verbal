@extends('theme.layout')

@section('content')
    @each('theme.post-block', $posts, 'post')

    <nav>
        <ul class="pager">
          <li><a href="#">Previous</a></li>
          <li><a href="#">Next</a></li>
        </ul>
    </nav>
@endsection
