<?php
namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;
use App\Models\MediaFile;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::with('user', 'categories', 'tags','mediaFiles')->latest()->paginate(10);
       
        
        return view('blogs', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $uploadedFile = $request->file('media');
        $blogPost = BlogPost::create([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        $categoryIds = $request->input('category');
        
        $blogPost->categories()->sync($categoryIds);



        $tagNames = explode(",", $request->input('tags'));

        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $blogPost->tags()->sync($tagIds);

        $uploadedFile = $request->file('media');

        $originalFilename = $uploadedFile->getClientOriginalName();

        $uploadedFilename = pathinfo($originalFilename, PATHINFO_FILENAME) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

        $uploadedFileType = $uploadedFile->getClientMimeType();

        $uploadedFile->move(public_path('uploads'), $uploadedFilename);
        $blogPost->mediaFiles()->create([
            'filename' => $uploadedFilename,
            'filetype' => $uploadedFileType,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    public function edit($id)
    {
        $blog = BlogPost::with('categories', 'tags', 'mediaFiles')->findOrFail($id);
        $categories = Category::all();
       
        return view('blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        

        $blogPost = BlogPost::findOrFail($id);

        $blogPost->update([
            'title' => $request->input('blog_title'),
            'description' => $request->input('description'),
        ]);

        $blogPost->categories()->sync([$request->input('category_id')]);

        
        $blogPost->tags()->sync($request->input('tags'));

        
        $mediaFile = $blogPost->mediaFiles->first();
        $mediaFile->update([
            'filename' => $uploadedFilename,
            'filetype' => $uploadedFileType,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }
}
