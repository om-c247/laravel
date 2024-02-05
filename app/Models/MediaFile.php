<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $fillable = ['blog_post_id', 'filename', 'filetype'];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
