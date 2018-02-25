@extends('theme.layout')

@section('content')
    <div class="col-sm-8 blog-main">
        @each('theme.post-block', $posts, 'post')

      <nav>
        <ul class="pager">
          <li><a href="#">Previous</a></li>
          <li><a href="#">Next</a></li>
        </ul>
      </nav>
    </div>
@endsection
