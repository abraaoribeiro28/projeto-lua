<div class="col-lg-6">
    <a href="{{ route('posts.show', $post->slug) }}" class="post-destaque">
        <img src="{{ getPathStorage($post->highlightArchive->path ?? '#') }}" class="imagem-palestra-destaque" loading="lazy" alt="imagem de destaque" />
        <div class="category pt-4">Mais visualizada</div>
        <h3>{{ $post->title }}</h3>
        <p class="line-2">{{ strip_tags($post->text) }}</p>
        <div class="post-details">
            <div>{{ $post->author }}</div>
            <div class="spacer-dot">•</div>
            <div>{{ formatDateWithMonth($post->publication_date) }}</div>
        </div>
    </a>
</div>
