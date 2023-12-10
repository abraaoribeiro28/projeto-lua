<x-portal-layout>

    {{ Breadcrumbs::render('postagem', $post) }}

    <section class="section section-palestras show">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 col-sm-12 mx-auto mb-4 text-center">
                    @isset($post->highlightArchive->path)
                        <img src="{{ getPathStorage($post->highlightArchive->path ?? '#') }}" alt="Imagem destaque"
                             class="rounded"
                             style="max-height: 500px;">
                    @endisset
                </div>

            </div>

            <div>
                {!! $post->text !!}
            </div>
        </div>
    </section>
</x-portal-layout>
