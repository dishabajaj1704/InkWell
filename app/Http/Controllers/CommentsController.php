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
        if (auth()->user()) {
            $userId = auth()->user()->id;
            $user = User::find($userId);
            $comments = Comment::with('author', 'blog')->paginate(10);
            // if ($user->isAdmin() || ) {
            //     $comments = Comment::with('author', 'blog')->paginate(10);
            //     //dd($comments);
            //     return view('admin.comments.index', compact('comments'));
            // }
            return view('admin.comments.index', compact('comments'));
            //return redirect(route('home'));
        } else {
            abort(401);
        }




    }

    public function store(CreateCommentRequest $request)
    {

        //dd($request);
        if (auth()->user()) {
            $userId = auth()->user()->id;
            $user = User::find($userId);
            // if ($user->isVerified()) {
            Comment::create([
                'blog_id' => $request->blog_Id,
                'message' => $request->comment,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            //}
            //  else {
            //     abort(403);
            // }
            session()->flash('success', 'Comment created successfully...');
        } else {

            //dd($request);
            Comment::create([
                'blog_id' => $request->blog_Id,
                'message' => $request->comment,
                'user_name' => $request->name,
                'user_email' => $request->email,
                'verified_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ]);
            // session()->flash('error', 'Please Login to comment...');
        }

        return redirect(route('frontend.blogs.show', $request->blog_Id));

    }

    public function verifyComment(Comment $comment)
    {

        //dd($comment->blog);
        $blogId = $comment->blog_id;
        if (auth()->user()->isAdmin() || auth()->user()->isOwner($comment->blog)) {
            if (auth()->user()->isAdmin()) {
                $comment->verified_by = 'admin';

            } else {
                $comment->verified_by = 'author';
            }


            if ($comment->verified_at == null) {
                $comment->verified_at = Carbon::now()->format('Y-m-d H:i:s');
                $comment->save();
            } else if ($comment->verified_at != null) {
                $comment->verified_at = null;

                $comment->save();
            }
        } else {
            abort(403);
        }

        // //dd(Carbon::now()->format('Y-m-d H:i:s'));


        return redirect(route('comments.index'));
    }


}
