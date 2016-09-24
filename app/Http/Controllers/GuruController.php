<?php

namespace App\Http\Controllers;

use App\Models\NewPostModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class GuruController extends Controller
{
    public function getIndex(Request $request)
    {
        //var_dump(\App\Helpers\AuthHelper::getUserKey());

        $posts_arr = \App\Models\NewPostModel::where('status', '=', 1)->take(15);

        if ($request->get('offset') > 0) {
            $posts_arr->offset($request->get('offset'));
        }
        $posts_arr = $posts_arr->get();
        $multi_column_arr = [];
        foreach ($posts_arr as $index => $post) {

            $index++;

            $post_html = view('guru.post-micro', [
                'post' => $post
            ])->render();

            if (($index % 3) == 0) {
                $multi_column_arr[3][] = $post_html;
            }
            elseif (($index % 2) == 0) {
                $multi_column_arr[2][] = $post_html;
            }
            else {
                $multi_column_arr[1][] = $post_html;
            }
        }

        if ($request->get('ajax')) {
            return $multi_column_arr;
        }

        $multi_column_list = view('default.widgets.multicolumn_list', [
            'multi_column_arr' => $multi_column_arr,
        ]);

        return view('guru.index', [
            'multi_column_list' => $multi_column_list,
        ]);
    }

    public function getPost($post_id)
    {
        $post = NewPostModel::findOrFail($post_id);

        return view('guru.post', ['post' => $post]);
    }
}
