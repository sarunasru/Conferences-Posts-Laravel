<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(User $user)
    {

        if(auth()->user()->userHasRole('Admin'))
        {
            $posts = Post::all();
        }
          else
          {
              $posts = auth()->user()->posts;
          }



        return view('admin.posts.index', ['posts' => $posts]);
    }


    public function show(Post $post)
    {

        return view('blog-post', ['post' => $post]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $this->authorize('create', Post::class);
        //Auth()->user();
      $inputs = request()->validate([

           'title' => 'required',
           'post_image' => 'file',
           'body' => 'required'
       ]);

       if(request('post_image'))
       {
           $inputs['post_image'] = request('post_image')->store('images');
       }
       auth()->user()->posts()->create($inputs);

        Session::flash('post-created-message','Post has been successfully created');

       return redirect()->route('post.index');
    }

    public function edit(Post $post)
    {
       // $this->authorize('view', $post);
      return view('admin.posts.edit', ['post'=> $post]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
       $post->delete();
       Session::flash('post-delete-message','Post '. $post->title. ' has been successfully deleted');
       return back();
    }

    public function update(Post $post)
    {
        $inputs = request()->validate([

            'title' => 'required',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if(request('post_image'))
        {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        $post->update();

        session()->flash('post-updated-message','Post '. $post->title.' has been successfully updated');
        return redirect()->route('post.index');
    }

}
