<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ebook;
use App\Models\Admin\InstagramPost;
use App\Models\Admin\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Responsável por carregar a página inicial do portal.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        $mostViewedPost = Cache::remember('mostViewedPost', 3600, function () {
            return Post::with('highlightArchive')
                ->where('status', true)
                ->orderByDesc('clicks')
                ->first();
        });

        $posts = Cache::remember('posts', 3600, function () use($mostViewedPost) {
            return Post::with('category', 'highlightArchive')
                ->where('status', true)
                ->where('id', '<>', $mostViewedPost->id)
                ->orderByDesc('publication_date')
                ->orderBy('id', 'desc')
                ->limit(3)
                ->get();
        });

        $instagramPosts = Cache::remember('instagramPosts', 3600, function () {
            return InstagramPost::where('status', true)->get();
        });

        $ebooks = Cache::remember('ebooks', 3600, function () {
            return Ebook::with('archives', 'highlightArchive')
                ->where('status', true)
                ->orderByDesc('publication_date')
                ->get();
        });

        return view('portal.home.index', compact('posts', 'mostViewedPost', 'instagramPosts', 'ebooks'));
    }
}
