<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\AuditLog;
use Gate;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class AuditLogsController extends BaseController
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('audit_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query = AuditLog::with('user')->latest('audit_logs.created_at');

        // if(!empty($request->subject_id)){
        //     $query->where('subject_id', $request->subject_id);
        // }
        // if(!empty($request->subject_type)){
        //     $query->where('subject_type', 'like', '%'.$request->subject_type.'%');
        // }
        // if(!empty($request->user_id)){
        //     $query->leftJoin('users', 'users.id', '=', 'user_id');
        //     $query->where('users.name', $request->user_id);
        // }
        // if(!empty($request->description)){
        //     $query->where('description', 'like', '%'.$request->description.'%');
        // }
        // if(!empty($request->host)){
        //     $query->where('host', $request->host);
        // }

        if ($search = request()->description){
            $query->where('description' , 'like' , "%$search%");
        }
        if ($search = request()->search){
            $query->where(function($query) use ($search){
                $query->where('subject_id' , $search)
                ->orWhere('subject_type' , 'like' , "$search%");
            });
        }
        $items = $query->paginate(100)->appends([
            'search' => request()->search,
            'description' => request()->description
        ]);

        $local_title = __('Activity Logs');
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.auditLogs.index', compact( 'items', 'local_title', 'breadcrumbs'));
    }

    public function show(AuditLog $auditLog)
    {
        abort_if(Gate::denies('audit_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = $auditLog->id;
        $breadcrumbs[] = ['label' => __('Home'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Activity Logs'), 'url' => route('dashboard.audit-logs.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.auditLogs.show', compact('auditLog', 'local_title', 'breadcrumbs'));
    }
}
