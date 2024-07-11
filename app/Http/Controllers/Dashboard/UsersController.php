<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends BaseController
{

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = $this->search();
        
        $local_title = __('Users');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.users.index', compact('users', 'local_title', 'breadcrumbs'));
    }

    public function search(){
        $query = User::orderBy('name');

        request()->get('id') ? $query->where('id', request()->get('id')) : '';
        
        if(request()->has('name') && request()->get('name')){
            $query->where('name', 'like', '%'.request()->get('name').'%');  
        }

        if(request()->has('email') && request()->get('email')){
            $query->where('email', 'like', request()->get('email').'%');  
        }
        
        return $query->paginate(100)->appends([
            'id' => request()->get('id'),
            'name' => request()->get('name'),
            'email' => request()->get('email'),
        ]);
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $local_title = __('Add User');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Users'), 'url' => route('dashboard.users.index')];
        $breadcrumbs[] = ['label' => $local_title];

        $languages = $this->getTags('languages');

        return view($this->template . '.users.create', compact('roles', 'local_title', 'breadcrumbs', 'languages'));
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $languages = $this->createTags($request->spoken_languages , 'languages');
        $user->tags()->sync($languages);
        // dd($user);
        if ($user){
            $user->roles()->sync($request->input('roles', []));

            return redirect()->route('dashboard.users.index', $user)->with(['success' => 'Added']);
        }
        else{
            return redirect()->route('dashboard.users.index')->with(['danger' => 'Error!']);
        }
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');
        $roles = Role::pluck('title', 'id');

        $local_title = sprintf('%s: %s',__('Edit User'), $user->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Users'), 'url' => route('dashboard.users.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.users.show', ['user' => $user])];
        $breadcrumbs[] = ['label' => __('Edit')];

        $languages = $this->getTags('languages');

        return view($this->template . '.users.edit', compact('roles', 'user', 'local_title', 'breadcrumbs', 'languages'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        $languages = $this->createTags($request->spoken_languages , 'languages');
        $user->tags()->sync($languages);

        return redirect()->route('dashboard.users.index')->with(['info' => 'Updated']);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        $local_title = $user->name;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Users'), 'url' => route('dashboard.users.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.users.show', compact('user', 'local_title', 'breadcrumbs'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back()->with(['danger' => 'Deleted']);
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}