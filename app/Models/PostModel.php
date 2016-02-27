<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    public $table = 'posts';

    public function author()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function rubrics()
    {
        return $this->belongsToMany('\App\Models\RubricModel', 'post_rubric', 'post_id', 'rubric_id');
    }

    public function getContent()
    {
        return strip_tags($this->content, '<p><ol><ul><li><br><strong><img><table><tr><th><td><tbody><thead>');
    }

    public function getHumanDate()
    {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at, config('app.timezone'));
        $date->setLocale('ru');
        return $date->diffForHumans();
    }

    public function getAnnotation()
    {
        return str_limit( strip_tags($this->content), 200 );
    }

    public function isActual()
    {
        return (bool) $this->is_actual;
    }

    public function isPublished()
    {
        return (bool) $this->is_published;
    }

    public function getUrl()
    {
        return '/post/' . $this->id;
    }
}
