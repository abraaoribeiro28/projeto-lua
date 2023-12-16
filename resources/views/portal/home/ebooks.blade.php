@if (isset($ebooks) && $ebooks->count())
    <section class="section section-ebook">
        <div class="container">
            @foreach ($ebooks as $ebook)
                <div class="row p-3 p-md-5 rounded flex-column-reverse flex-lg-row">
                    <div class="col-lg-6 px-0">
                        <h1 class="display-4 font-italic">{{ $ebook->title }}</h1>
                        <p class="lead my-3">
                            {{ strip_tags($ebook->resume) }}
                        </p>
                        <a href="#" download class="btn bg-dark-blue text-white">Baixar E-book</a>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center justify-content-lg-end">
                        <img src="{{ getPathStorage($ebook->highlightArchive->path ?? '#') }}"
                             class="card-img-right rounded mb-4 mb-lg-0" alt="capa do e-book">
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
