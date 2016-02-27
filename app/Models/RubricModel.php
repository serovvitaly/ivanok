<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RubricModel extends Model
{

    public $table = 'rubrics';

    public function posts()
    {
        return $this->belongsToMany('\App\Models\PostModel', 'post_rubric', 'rubric_id', 'post_id');
    }
}