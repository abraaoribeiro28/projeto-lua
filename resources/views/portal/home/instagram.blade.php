@if (isset($instagramPosts) && $instagramPosts->count())
    <section class="section bg-white">
        <div class="container">
            <h4 class="mb-4">Estamos no instagram</h4>
            <div class="row">
                @foreach ($instagramPosts as $post)
                    <div class="col-sm-6 col-xl-3">
                        <x-portal.post-instagram :url="$post->url" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@section('script')
    @parent
    <script>
        window.onload = function() {
            var script = document.createElement('script');
            script.async = true;
            script.src = "//www.instagram.com/embed.js";
            document.body.appendChild(script);
        };
    </script>
@endsection
