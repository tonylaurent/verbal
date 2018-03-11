<div class="blog-post">
    <h2 class="blog-post-title">
        {{ $post->title }}
    </h2>

    <p class="blog-post-meta">
        {{ $post->created_at }}
    </p>

    <div>
        {{ $post->summary }}
    </div>

    <a href="{{ route('post.show', ['post' => $post]) }}">
        Read more
    </a>
</div>
