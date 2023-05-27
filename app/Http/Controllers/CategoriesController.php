<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware(['validateAdmin'])->only(['edit', 'update', 'destroy', 'trash', 'create']);
    }
    public function index()
    {
        //
        // $categories = Category::paginate(2);
        //$categories = Category::latest()->paginate(2);
        $categories = Category::orderBy('id', 'desc')->paginate(4);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        //
        // dd($request);

        // $data=request()->all();
        // request()->validate([
        //     'name'=>'required|min:3|max:255'
        // ]);
        $userId = auth()->user()->id;
        Category::create([
            'name' => $request->name,
            'created_by' => $userId,
            'last_updated_by' => $userId
        ]);

        // session()->put('success','Category created successfully...');
        session()->flash('success', 'Category create successfully...');
        return redirect(route('admin.categories.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $category->name = $request->name;
        $category->save();

        session()->flash('success', 'Category updated successfully...');
        return redirect(route('admin.categories.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request, Category $category)
    // {
    //     //TODO:Validte whether the category has post associated with it.uf not then only proceed.

    //     $category->delete();
    //     session()->flash('success', 'Category deleted successfully...');
    //     return redirect(route('admin.categories.index'));

    // }
    public function trash(Category $category)
    {
        //dd($blog);
        $category->delete();
        session()->flash('success', 'Category Deleted Successfully');
        return redirect(route('admin.categories.index'));
    }

    public function destroy(int $blogId)
    {
        $blog = Blog::onlyTrashed()->find($blogId);
        $blog->deleteImage();
        $blog->forceDelete();

        session()->flash('success', 'Blog Destroyed Successfully');
        return redirect(route('admin.blogs.trashed'));
    }

    public function trashed()
    {
        $blogs = Blog::with('category')
            ->where('user_id', auth()->id())
            ->onlyTrashed()
            ->latest()
            ->paginate(10);

        return view('admin.blogs.trashed', compact('blogs'));
    }


    public function restore(int $blogId)
    {

        //dd($blogId);
        $blog = Blog::withTrashed()->find($blogId);
        $blog->restore();

        session()->flash('success', 'Blog Restored Successfully');
        return redirect(route('admin.blogs.index'));

    }
}
