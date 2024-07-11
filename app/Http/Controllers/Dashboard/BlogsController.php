<?php

namespace App\Http\Controllers\Dashboard;

use Gate;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tag;
use App\Models\Dashboard\Blog;
use App\Http\Requests\BlogStoreRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Builder;

class BlogsController extends BaseController
{
    public function index()
    {    
        abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query= Blog::orderBy('publish_date','DESC')->orderBy('title');
        if ($search = request()->search)
            $query->where('title' , 'like' , "%$search%")
            ->orWhere('description' , 'like' , "%$search%")
            ->orWhereHas('tags', function (Builder $subQuery) {
                $subQuery->where('name', 'like', "%".request()->search."%");
            });

        $items = $query->with('tags' , 'user')->paginate(100)->appends([
            'search' => $search,
        ]);
        
        $local_title = __('Blogs');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.blogs.index', compact(  'search', 'local_title', 'breadcrumbs', 'items'));
    }

    public function create()
    {
        $tags = $this->getTags('blog')->prepend('- Choose', '');
        $users = User::pluck('name' , 'id')->prepend(__('-Choose') , '');
        abort_if(Gate::denies('blog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $local_title = __('Add Blog');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Blogs'), 'url' => route('dashboard.blogs.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.blogs.create', compact('users', 'tags', 'local_title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request)
    {
        $tagArray = $this->createTags($request->tags);
        // dd($request);
        $blog = Blog::create($request->all());
        if ($request->hasFile('photos')){
            foreach($request->file('photos') as $_file){
                $blog->addMedia($_file)
                ->usingName($blog->title)
                ->toMediaCollection('blog-photos', 'media');
                $blog->save();
            }
        }
        $blog->tags()->sync($tagArray);
        return redirect()->route('dashboard.blogs.index')->with(['message' => 'Created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        abort_if(Gate::denies('blog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = $blog->title;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Blogs'), 'url' => route('dashboard.blogs.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.blogs.show', compact('blog', 'local_title', 'breadcrumbs'));
    }

    public function edit(Blog $blog)
    {
        abort_if((Gate::denies('blog_edit') || !$blog->allowEdit), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tags = $this->getTags('blog');
        $users = User::pluck('name' , 'id')->prepend(__('- Choose') , '');
        $local_title = sprintf('%s: %s', __('Edit Blog'), $blog->title);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Blogs'), 'url' => route('dashboard.blogs.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.blogs.show', ['blog' => $blog])];
        $breadcrumbs[] = ['label' => __('Edit')];

        return view($this->template . '.blogs.edit', compact('users', 'tags', 'blog','local_title', 'breadcrumbs'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(BlogStoreRequest $request, Blog $blog)
    {
        $tagArray = $this->createTags($request->tags);
        $blog->update($request->all());
        if ($request->hasFile('photos')){
            $blog->media()->delete();
            foreach($request->file('photos') as $_file){
                $blog->addMedia($_file)->toMediaCollection('blog-photos', 'media');
                $blog->save();
            }
        }

        $blog->tags()->sync($tagArray);
        return redirect()->route('dashboard.blogs.index')->with(['info' => __('Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        abort_if(Gate::denies('blog_delete') || !$blog->allowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blog->delete();
        // dd($blog);
        return back()->with(['danger' => __('Deleted Blog')]);
    }
}
