<div class="blog-post">
    <h2 class="blog-post-title">
        {{ $post->title }}
    </h2>

    <p class="blog-post-meta">
        January 1, 2014 by
    </p>

    <div>
        {{ $post->content }}
    </div>

    <a href="{{ route('post.show', ['post' => $post]) }}">
        Read more
    </a>
</div>
