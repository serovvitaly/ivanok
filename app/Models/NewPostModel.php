<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewPostModel extends Model
{
    protected $table = 'new_posts';

    public static function getPosts($columns = 1)
    {
        return self::take(12)->get();
    }

    public function medias()
    {
        return $this->hasMany('\App\Models\PostMediaModel', 'post_id');
    }

    public function images()
    {
        return $this->medias()->where('type', '=', 'img');
    }

    public function getContent()
    {
        $content = $this->content;

        $content = strip_tags($content, '<p>');

        return $content;
    }

    public function getMainImage()
    {
        $post_images = $this->images()->first();

        if (empty($post_images)) {
            return null;
        }
        
        return $post_images->file_name;
    }
}
