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
        // $blogs = Blog::with('author')
        //     ->where('published_at', '<=', now())
        //     ->orderBy('published_at', 'desc')
        //     ->simplePaginate(3);

        $blogs = Blog::with('author')->search()->published()
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


    public function category(Category $category)
    {
        $blogs = $category->blogs()->search()->published()->simplePaginate(3);
        $categories = Category::withCount('blogs')->get();
        $tags = Tag::limit(10)->get();
        return view('frontend.index', compact(['categories', 'tags', 'blogs']));
    }


    public function tag(Tag $tag)
    {
        $blogs = $tag->blogs()->search()->published()->simplePaginate(3);
        $categories = Category::withCount('blogs')->get();
        $tags = Tag::limit(10)->get();
        return view('frontend.index', compact(['categories', 'tags', 'blogs']));
    }

    public function show(Blog $blog)
    {
        $blogTags = $blog->tags;
        $categories = Category::withCount('blogs')->get(); #for sidebar
        $tags = Tag::limit(10)->get(); #for sidebar
        return view('frontend.blog', compact(['categories', 'tags', 'blog', 'blogTags']));
    }
}
