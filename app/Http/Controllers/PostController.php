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
        if (Gate::denies('create-post')) {
            abort(403, 'Нет прав для создания документа');
        }

        return view('default.NEW_post-create-form');
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
        //$post->url =  str_slug($post->title);

        $post->rubrics()->sync($request->get('rubrics'));

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
        $post = \App\Models\PostModel::find($id);

        if ( ! $post ) {
            abort(404);
        }

        $auth_user = \Auth::user();

        if ( ! $post->isPublished() and Gate::denies('update-post', $post) ) {

            abort(404);
        }

        if ( ! $auth_user or Gate::denies('update-post', $post) ) {
            //DB::beginTransaction();
            $post->counter++;
            $post->save();
            //DB::commit();
        }

        $template = trim($post->template);

        if ( empty($template) or ! view()->exists($template) ) {

            $template = 'default.post-full';
        }

        return view($template, ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = \App\Models\PostModel::findOrFail($id);

        if (Gate::denies('update-post', $post)) {
            abort(403, 'Нет прав для редактирования документа');
        }

        return view('default.post-create-form', [
            'post' => $post
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

        if (Gate::denies('update-post', $post)) {
            abort(403, 'Нет прав для редактирования документа');
        }

        $post->title = $request->get('title');
        $post->keywords = $request->get('keywords');
        $post->description = $request->get('description');
        $post->content = $request->get('content');
        //$post->url =  str_slug($post->title);

        $post->rubrics()->sync($request->get('rubrics'));

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

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setInt($id)
    {
        $post = PostModel::findOrFail($id);

        if (Gate::denies('update-post', $post)) {
            abort(403, 'Нет прав для едактирования документа');
        }

        $input = \Request::all();

        if (empty($input)) {

            return redirect()->back();
        }

        $allow_fields = ['is_actual', 'is_published'];

        foreach ($input as $field_name => $val) {

            if ( ! in_array($field_name, $allow_fields) ) {

                continue;
            }

            $post->$field_name = (int) $val;
        }

        $post->save();

        return redirect()->back();
    }

    /**
     * Публикация
     * @param $id
     * @return string
     */
    public function publish($id)
    {
        $post = PostModel::findOrFail($id);

        if (Gate::denies('publication-post', $post)) {
            abort(403, 'Нет прав для публикации документа');
        }

        $post->is_published = 1;
        $post->save();

        return redirect()->back();
    }

    /**
     * Отменить публикацию
     * @param $id
     * @return string
     */
    public function unpublish($id)
    {
        $post = PostModel::findOrFail($id);

        if (Gate::denies('publication-post', $post)) {
            abort(403, 'Нет прав для отмены публикации документа');
        }

        $post->is_published = 0;
        $post->save();

        return redirect()->back();
    }
}
