<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //

    public function index()
    {
        $blogs = Blog::with('author')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->simplePaginate(3);

        $categories = Category::withCount('blogs')->get();
        $tags = Tag::limit(10)->get();
        return view('frontend.index', compact([
            'categories',
            'tags',
            'blogs'
        ]));

        //withCount:  pura blog object return karne ke bijaye sirfe count return karta hai

    }
}
