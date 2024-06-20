<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\Paginate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Unit;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function profile(User $user)
    {
        $local_title = __('Hi, ') . $user->name;
        $local_description = '';
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('homepage')];
        $breadcrumbs[] = ['label' => $local_title];
        return view('website.profile', compact('local_title', 'local_description', 'breadcrumbs', 'user') );
    }
}
