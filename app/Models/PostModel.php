<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    public $table = 'posts';

    public function getContent()
    {
        return strip_tags($this->content, '<p><ol><ul><li><br><strong><img>');
    }

    public function getHumanDate()
    {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);
        $date->setLocale('ru');
        return $date->diffForHumans();
    }
}
