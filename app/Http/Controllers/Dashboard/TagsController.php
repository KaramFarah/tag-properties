<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Dashboard\Tag;
use Gate;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagsController extends BaseController
{
    public array $types = [
        'interests' => 'Interests',
        'languages' => 'Languages',
        'blog' => 'Blog',
        'features' => 'Features'
    ];

    public function getTypes()
    {
        return collect($this->types)->prepend('- Choose', '')->all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        abort_if(Gate::denies('tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $items = Tag::orderBy('type')->orderBy('name');
        if ($search = request()->get('search')){
            $items->where('name', 'like', $search.'%');
        }

        if ($type = request()->get('type')){
            $items->where('type', $type);
        }
        
        $items = $items->paginate(100)->appends([
            'search' => $search,
            'type'   => request()->get('type'),
        ]);

        $types = $this->getTypes();

        $local_title = __('Tags');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.tags.index', compact('local_title', 'breadcrumbs', 'items', 'search', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $value_types = Tag::valueTypes();
        $local_title = __('Add Tag');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Tags'), 'url' => route('dashboard.tags.index')];
        $breadcrumbs[] = ['label' => $local_title];

        $types = $this->getTypes();

        $parents = Tag::where('parent_id', null)->pluck('name', 'id')->prepend(__('- Choose One'), '');

        return view($this->template . '.tags.create', compact( 'value_types', 'local_title', 'breadcrumbs', 'parents', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $model = Tag::create($request->all());
        if ($model->id) return redirect()->route('dashboard.tags.index')->with(['message' => 'Created']); else return redirect()->route('dashboard.tags.index')->with(['danger' => __('Error!')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        abort_if(Gate::denies('tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = $tag->name;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Tags'), 'url' => route('dashboard.tags.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.tags.show', compact('tag', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        abort_if(Gate::denies('tag_edit') || !$tag->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $value_types = Tag::valueTypes();
        $local_title = sprintf('%s: %s', __('Edit Tag'), $tag->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Tags'), 'url' => route('dashboard.tags.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.tags.show', ['tag' => $tag])];
        $breadcrumbs[] = ['label' => __('Edit')];

        $types = $this->getTypes();

        $parents = Tag::where('parent_id', null)->pluck('name', 'id')->prepend(__('- Choose One'), '');

        return view($this->template . '.tags.edit', compact('value_types','tag','local_title', 'breadcrumbs', 'parents', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $id = $tag->id;
        $tag->update($request->all());
        // $tag->update($request->all());

        return redirect()->route('dashboard.tags.index')->with(['info' => __('Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        abort_if(Gate::denies('tag_delete') || !$tag->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tag->delete();

        return back()->with(['danger' => __('Deleted')]);
    }

    public function massUpdate(){
        $Tags = Tag::all();
        // dd($query);
        foreach($Tags as $tag)
        $tag->update([]);
        return redirect()->route('dashboard.tags.index')->with(['info' => __('Updated')]);
    }
}
