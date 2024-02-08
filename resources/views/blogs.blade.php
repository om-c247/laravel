<!-- resources/views/blogs/index.blade.php -->
 <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .blog-post {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .blog-post h2 {
            color: #007bff;
        }

        .blog-post img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .like-comment-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .like-btn, .comment-btn, .post-comment-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .like-btn:hover, .comment-btn:hover, .post-comment-btn:hover {
            background-color: #0056b3;
        }

        .comments {
            display: none;
            width: 70%;
        }

        .comments.show {
            display: block;
        }

        .comment {
            background-color: #f5f5f5;
            padding: 8px;
            margin: 5px 0;
            border-radius: 4px;
        }

        .comment-input {
            width: 60%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: none;
        }

        .post-comment-btn {
            width: 30%;
        }
        svg.w-5.h-5 {
            width: 20px;
            height: 20px;
        }
</style>
   
   
<header>
        <h1>Blog List</h1>
    </header>
    <div class="container">
      
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
            
            
            <p> Description: {!! $blog->description !!}</p>
           
                Comments:
            <?php
            foreach ($blog['comments'] as $comment) {
                 
              
                ?>
                <div class="comment"> <?php echo $comment->content; ?></div>
            <?php
            }
        ?>
      
           
           
            <p>Author: {{ $blog->user->name }}</p>
             {{-- Add more details if needed --}}
        
        <div class="like-comment-section">
            <button class="like-btn" data-blog-id="{{ $blog->id }}">Like</button>
            <button class="comment-btn" data-blog-id="{{ $blog->id }}">Comment</button>
            <div class="comments">
               
                @foreach ($blog->comments as $comment)  
                    <div class="comment">{{ $comment->content }}</div>
                @endforeach

               
            </div>
            <textarea class="comment-input" placeholder="Write a comment"></textarea>
            <button class="post-comment-btn" data-blog-id="{{ $blog->id }}">Post Comment</button>
        </div>  
        
    </div>
    @endforeach

    {{ $blogs->links() }}
    </div>
    <script>
  window.csrfToken = "{{ csrf_token() }}";
document.addEventListener("DOMContentLoaded", function () {
    
    document.querySelectorAll(".like-btn").forEach(function (likeBtn) {
        likeBtn.addEventListener("click", function () {
            const blogId = this.getAttribute("data-blog-id");

            const headers = {
                'X-CSRF-TOKEN': window.csrfToken,
                'Content-Type': 'application/json',
            };

   
            fetch('/blogs/like', {
                method: 'POST',
                headers: headers,
                body: JSON.stringify({
                    blogId: blogId,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            
            })
            .catch(error => {
                console.error('Error:', error);
            
            });
        });
    });

    document.querySelectorAll(".comment-btn").forEach(function (commentBtn) {
        commentBtn.addEventListener("click", function () {
            const commentSection = this.nextElementSibling;
            commentSection.classList.toggle("show");
        });
    });

    document.querySelectorAll(".post-comment-btn").forEach(function (postCommentBtn) {
        postCommentBtn.addEventListener("click", function () {
            const blogId = this.getAttribute("data-blog-id");
            const commentInput = this.previousElementSibling;
            const commentText = commentInput.value.trim();

            if (commentText !== "") {
               
                
                const headers = {
                'X-CSRF-TOKEN': window.csrfToken,
                'Content-Type': 'application/json',
            };

   
            fetch('/blogs/comment', {
                method: 'POST',
                headers: headers,
                body: JSON.stringify({
                    blogId: blogId,
                    content: commentText,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            
            })
            .catch(error => {
                console.error('Error:', error);
            
            });
               
                commentInput.value = "";
            }
        });
    });
});

    </script>

    

