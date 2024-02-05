<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function blogPosts()
    {
        return $this->belongsToMany(BlogPost::class, 'tags_blog_post');
    }
}
