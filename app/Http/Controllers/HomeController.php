<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PostRepository;
use App\Post;
use Illuminate\Http\Request;
use XblogConfig;

class HomeController extends Controller
{
    protected $postRepository;

    /**
     * Create a new controller instance.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $page_size = get_config('page_size', 7);
        $posts = $this->postRepository->pagedPosts($page_size);
        
        return view('post.index', compact('posts'));

        // return view('index');
    }

    public function search(Request $request)
    {
        $key = trim($request->get('q'));
        if ($key == '')
            return back()->withErrors(__('web.PLEASE_KEY_IN_KEYWORD'));
        $page_size = XblogConfig::getValue('page_size', 7);
        $key = "%$key%";
        $posts = Post::where('title', 'like', $key)
            ->orWhere('description', 'like', $key)
            ->with(['tags', 'category'])
            ->withCount('comments')
            ->orderBy('view_count', 'desc')
            ->paginate($page_size);
        $posts->appends($request->except('page'));
        return view('search', compact('posts'));
    }

    public function projects()
    {
        return view('projects');
    }

    public function archives()
    {
        $posts = $this->postRepository->archives();
        $posts_count = $this->postRepository->postCount();
        return view('achieve', compact('posts', 'posts_count'));
    }

}
