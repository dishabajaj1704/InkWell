<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    public function index()
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $comments = Comment::with('author', 'blog')->paginate(10);
        if ($user->isAdmin()) {
            $comments = Comment::with('author', 'blog')->paginate(10);
            return view('admin.comments.index', compact('comments'));
        }

        return redirect(route('home'));
    }

    public function store(CreateCommentRequest $request)
    {

        //dd($request);
        if (auth()->user()) {
            $userId = auth()->user()->id;
            $user = User::find($userId);
            if ($user->isVerified()) {
                Comment::create([
                    'user_id' => $userId,
                    'blog_id' => $request->blog_Id,
                    'message' => $request->comment,
                    'verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            } else {
                abort(403);
            }
            session()->flash('success', 'Comment created successfully...');
        } else {
            session()->flash('error', 'Please Login to comment...');
        }

        return redirect(route('frontend.blogs.show', $request->blog_Id));

    }

    public function verifyComment(Comment $comment)
    {


        //dd(Carbon::now()->format('Y-m-d H:i:s'));
        if ($comment->verified_at == null) {
            $comment->verified_at = Carbon::now()->format('Y-m-d H:i:s');
            $comment->save();
        } else if ($comment->verified_at != null) {
            $comment->verified_at = null;
            $comment->save();
        }

        return redirect(route('comments.index'));
    }


}
