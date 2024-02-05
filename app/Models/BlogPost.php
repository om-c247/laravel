<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['user_id', 'title', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_blog_post');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_blog_post');
    }

    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class);
    }
}
