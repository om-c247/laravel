<!-- resources/views/blogs/index.blade.php -->
<style>/* Add some spacing and styling to the pagination links */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination li {
    list-style: none;
    margin: 0 5px;
    display: inline-block;
}

.pagination a, .pagination span {
    padding: 8px 16px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #333;
    background-color: #fff;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.pagination a:hover {
    background-color: #f5f5f5;
}

.pagination .active span {
    background-color: #007bff;
    color: #fff;
    border: 1px solid #007bff;
}
</style>
    <h1>Blog List</h1>
      
    @foreach($blogs->items() as $blog)
    
    




        <div class="blog-post">
         
            <h2>{{ $blog->title }} </h2>
            <?php
foreach ($blog['mediaFiles'] as $mediaFile) {
    $filename = $mediaFile->filename;
    $imageUrl = asset('uploads/' . $filename);
    ?>
    <img src="{{ $imageUrl }}" alt="Image">
<?php
}
?>

            <p>Categories: 
                @foreach ($blog->categories as $category)
                    {{ $category->name }}
                @endforeach
            
            
            <p>{!! $blog->description !!}</p>
            
           
            <p><img src="{{ asset('uploads/$blog->filename') }}" alt="Image Alt Text">
</p>    
            <p>Author: {{ $blog->user->name }}</p>
             {{-- Add more details if needed --}}
        </div>
        <hr>
    @endforeach

    {{-- Pagination links --}}
    

