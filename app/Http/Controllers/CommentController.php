<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required:max:250',
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->contenido = $request->get('contenido');

        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        return redirect()->route('post.unico', ['id' => $request->get('post_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $Comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $Comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $Comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $Comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $Comment)
    {
        //
    }
}
