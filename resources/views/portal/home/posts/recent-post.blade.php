<div class="blog-index w-dyn-list">
    <a href="{{ route('posts.show', $post->slug) }}" class="post-recente d-block d-sm-grid">
        <div>
            <div class="category">{{ $post->category->name }}</div>
            <h4>{{ $post->title }}</h4>
            <div class="post-details">
                <div>{{ $post->author }}</div>
                <div class="spacer-dot">•</div>
                <div>{{ formatDateWithMonth($post->publication_date) }}</div>
            </div>
        </div>
        <img src="{{ getPathStorage($post->highlightArchive->path ?? '#') }}" class="imagem-palestra-recentes" alt="imagem de palestra" loading="lazy" />
    </a>
</div>
<div class="line-spacer"></div>

