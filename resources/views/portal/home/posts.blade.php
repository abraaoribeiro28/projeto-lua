@if ($mostViewedPost && $posts)
    <section class="section section-post">
        <div class="container">
            <div class="row">
                @include('portal.home.posts.featured-post', ['post' => $mostViewedPost])

                <div class="col-lg-6 ps-md-4 mt-5 pt-5 pt-lg-0 mt-lg-0">
                    <h4>Últimas palestras</h4>
                    @each('portal.home.posts.recent-post', $posts, 'post')
                </div>
            </div>
        </div>
    </section>
@endif
