<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'news';
    protected $fillable = ['title', 'content', 'img', 'alias', 'user_id', 'preview_text', 'preview_image'];

    protected $with = ['user'];


    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'title'
            ]
        ];
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'news_tag', 'news_id', 'tag_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function syncTags($tags = []) {

        if(!empty($tags)) {
            $this->tags()->sync($tags);
        }else {
            $this->tags()->detach();
        }

        return true;
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'news_id', 'id');
    }
}
