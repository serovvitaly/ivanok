<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Behat\Transliterator\Transliterator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function getCreatingForm()
    {
        if (Gate::denies('create-post')) {
            abort(403, 'Нет прав для создания документа');
        }

        return view('default.post-create-form');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view-posts-list')) {
            abort(403, 'Нет прав для просмотра документа');
        }

        return view('default.my-posts', [
            'posts' => \App\Models\PostModel::where('user_id', '=', \Auth::user()->id)->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('default.post-create-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new PostModel;

        $post->title = $request->get('title');
        $post->keywords = $request->get('keywords');
        $post->description = $request->get('description');
        $post->content = $request->get('content');
        $post->user_id = \Auth::user()->id;
        //$post->url = Transliterator::transliterate($post->title);

        $post->save();

        return [
            'success' => true
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('default.post-create-form', [
            'post' => \App\Models\PostModel::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = PostModel::findOrFail($id);

        $post->title = $request->get('title');
        $post->keywords = $request->get('keywords');
        $post->description = $request->get('description');
        $post->content = $request->get('content');
        //$post->url = Transliterator::transliterate($post->title);

        $post->save();

        return [
            'success' => true
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'destroy';
    }
}
