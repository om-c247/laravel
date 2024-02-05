<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function blogPosts()
    {
        return $this->belongsToMany(BlogPost::class, 'category_blog_post');
    }
}
