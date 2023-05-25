<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    //

    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }
}
