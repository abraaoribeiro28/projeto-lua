<?php


Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('portal.home'));
});


Breadcrumbs::for('postagem', function ($trail, $post) {
    $trail->parent('home');
    $trail->push($post->title, route('posts.show', $post->id));
});