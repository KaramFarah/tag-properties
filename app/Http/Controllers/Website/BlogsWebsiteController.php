<?php

namespace App\Http\Controllers\Website;

use Share;
// use Jorenvh\Share\Share;
use App\Utils\Paginate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tag;
use App\Models\Dashboard\Blog;
use App\Models\Dashboard\Unit;
use Illuminate\Support\Collection;

class BlogsWebsiteController extends WebsiteController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tag $tag)
    {
        $query = Blog::orderBy('publish_date', 'DESC')->orderBy('title')->with('tags');   

        $search = request()->get('search');

        $tagURL = '';
        
        if($tag && $tag->id){
            $tagURL = '/' . $tag->slug;
            $query->whereHas('tags', function ($q) use ($tag){
                $q->where('slug', $tag->slug);
            });
            $recentPosts = Blog::latest()->limit(3)->get();
        }
        else{
            $recentPosts = new Collection();
        }

        if($search){
            $query->where('title' , 'like' , "%$search%")
            ->orWhere('description' , 'like' , "%$search%")
            ->orWhere('publish_date' , 'like' , "%$search%");
        }
        
        $blogs = $query->with('user')->paginate(5)->withPath('/blogs' . ($tagURL))->withQueryString();

        $tags = $this->getTags();
        $links = $this->getShareLinks();

        $local_title = '';
        $local_description = 'Explore Our World of Real Estate: From Market Trends to Homebuying Tips, We\'ve Got You Covered.';

        $breadcrumbs[] = ['label' => 'Home', 'url' => route('homepage')];

        if ($tag && $tag->id) {
            $local_title .=  ($local_title ? ' | ' : '') .  $tag->name
            ;
            $breadcrumbs[] = ['label' => __('Blogs'), 'url' => route('blog.index')];
            $breadcrumbs[] = ['label' => $tag->name];
        }

        if (request()->has('search') && request()->get('search')){
            !$local_title ? $breadcrumbs[] = ['label' => __('Blogs'), 'url' => route('blog.index')] : '';
            $breadcrumbs[] = ['label' => request()->get('search')];

            $local_title .= ($local_title ? ' | ' : '') . request()->get('search');
        }

        if (!$local_title){
            $local_title = __('Blogs');
            $breadcrumbs[] = ['label' => $local_title];
        }
        else{
            $local_title .= ' | ' . __('Blogs');
        }

        $recentProperties = $this->getRecentProperties();

        return view('website.blog', compact( 'recentProperties', 'tag', 'recentPosts', 'search', 'links', 'tags', 'blogs', 'local_title', 'local_description', 'breadcrumbs'));
    }

    private function getTags()
    {
        return Tag::where('type', 'blog')->orderBy('name')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $recentPosts = Blog::orderBy('publish_date', 'DESC')->limit(3)->get();
        
        $tags = $this->getTags();
        
        $local_title = $blog->title;
        $links = $this->getShareLinks();

        // $local_description = __($blog->description);
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => __('Blogs'), 'url' => route('blog.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('website.blog-single', compact('recentPosts', 'links', 'blog', 'tags', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
