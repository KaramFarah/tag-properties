<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Models\Dashboard\Comment;
use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Requests\CommentRequest;

class CommentsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.CommentRequest
     */
    public function store(Request $request)
    {
        
        if($request->call_id){
            $id = $request->call_id;
            $type = 'call_id';
           
        }else{
            $id = $request->id;
            $type = 'contact_id';
        }
        $comment = Comment::create([
            'content'      => $request->content,
            'publish_date' => date('Y-m-d H:i:s'),
            'author'       => auth()->user()->id,
            $type   => $id
        ]);
        return redirect()->back()->with(['success' => __('Created Comment')]);
    }

    // public function callComment(CommentRequest $request)
    // {
    //     $comment = Comment::create([
    //         'content'      => $request->content,
    //         'publish_date' => date('Y-m-d H:i:s'),
    //         'author'       => auth()->user()->id,
    //         'call_id'   => $request->id
    //     ]);
    //     return redirect()->back()->with(['success' => __('Created Comment')]);
    // }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
