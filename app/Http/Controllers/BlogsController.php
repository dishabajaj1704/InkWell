<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blogs\CreateBlogRequest;
use App\Http\Requests\Blogs\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Http\Request;

class BlogsController extends Controller
{
    //

    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.blogs.create', compact([
            'categories',
            'tags'
        ]));
    }

    public function store(CreateBlogRequest $request)
    {

        //Image upload and return the name of the file whihch wil be created.
        $image_path = $request->file('image')->store('blogs');
        $data = $request->only(['title', 'excerpt', 'body', 'category_id', 'published_at']);

        $data = array_merge($data, [
            'image_path' => $image_path,
            'user_id' => auth()->user()->id
        ]);

        $blog = Blog::create($data);
        $blog->tags()->attach($request->tags);

        session()->flash('success', 'Blog created successfully');
        return redirect(route('admin.blogs.index'));
    }


    public function edit(Blog $blog)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.blogs.edit', compact([
            'categories',
            'tags',
            'blog'
        ]));

    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->only(['title', 'excerpt', 'body', 'category_id', 'published_at']);

        //if updated the image
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('blogs');
            $blog->deleteImage();
            $data = array_merge($data, ['image_path' => $image_path]);
        }

        $blog->update($data);
        $blog->tags()->sync($request->tags);

        session()->flash('success', 'Blog created successfully');
        return redirect(route('admin.blogs.index'));


    }
}
