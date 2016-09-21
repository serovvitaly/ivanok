<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostMediaModel extends Model
{
    protected $table = 'posts_media';

    protected $fillable = ['file_name', 'type', 'post_id'];
}
