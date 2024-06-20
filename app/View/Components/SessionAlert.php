<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\Session;

class SessionAlert extends Component
{
    // protected $except = ['message', 'type'];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {

    }

    public function shouldRender(): bool
    {
        return (session::has('message') || session::has('success') || session::has('info') || session::has('warning') || session::has('danger') || session::has('error'));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (session::has('message') || session::has('success')){
            $_type = 'success';
            $_msg = session('message') . session('success');
        }
        elseif (session::has('info')){
            $_type = 'info';
            $_msg = session('info');
        }
        elseif (session::has('warning')){
            $_type = 'warning';
            $_msg = session('warning');
        }
        elseif (session::has('danger') || session::has('error')){
            $_type = 'danger';
            $_msg = session('danger') . session('error');
        }
        return view('components.session-alert', ['type' => $_type, 'message' => $_msg]);
    }
}
