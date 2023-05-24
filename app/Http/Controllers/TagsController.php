<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tags = Tag::orderBy('id', 'desc')->paginate(2);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTagRequest $request)
    {
        //

        Tag::create([
            'name' => $request->name
        ]);


        session()->flash('success', 'Tag created successfully...');
        return redirect(route('admin.tags.index'));

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
    public function edit(Tag $tag)
    {
        //

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //

        $tag->name = $request->name;
        $tag->save();

        session()->flash('success', 'Tag updated successfully...');
        return redirect(route('admin.tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //

        $tag->delete();
        session()->flash('success', 'Tag deleted successfully...');
        return redirect(route('admin.tags.index'));

    }
}
