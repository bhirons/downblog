<?php

namespace Bhirons\DownBlog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $table = 'downblog_articles';

    protected $primaryKey = 'id';

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'published_on'];

    protected $fillable = ['title', 'slug', 'subtitle', 'content', 'user_id', 'published_on', 'created_at'];

    public function isPublished()
    {
        return $this->published_on < Carbon::now();
    }

    public function isUnpublished()
    {
        return $this->published_on >= Carbon::now();
    }

    public function scopeByAuthor($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function scopePublished($query)
    {
        return $query->where('published_on', '<', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published_on', '>=', Carbon::now());
    }

    public function author()
    {
        return $this->belongsTo(config('downblog.user_model'), 'user_id', config('downblog.user_id'));
    }
}