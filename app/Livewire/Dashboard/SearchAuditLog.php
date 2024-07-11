<?php

namespace App\Livewire\Dashboard;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Livewire\Component;
use stdClass;

class SearchAuditLog extends Component
{
    public $description = '';
    public $subject_id = '';
    public $subject_type = '';
    public $user_id = '';
    public $host = '';
    public $auditLogs = [];

    public function search(){
        $query = AuditLog::with('user');

        if(!empty($this->description)){
            $query->where('description', 'like', '%'.$this->description.'%');
        }

        if(!empty($this->subject_id)){
            $query->where('subject_id', $this->subject_id);
        }
        if(!empty($this->subject_type)){
            $query->where('subject_type', 'like', '%'.$this->subject_type.'%');
        }
        if(!empty($this->user_id)){
            $query->leftJoin('users', 'users.id', '=', 'user_id');
            $query->where('users.name', $this->user_id);
        }
        if(!empty($this->host)){
            $query->where('host', $this->host);
        }

        $this->auditLogs = $query->latest('audit_logs.created_at')->get();  
    }

    public function mount()
    {   
        $this->search();
    }

    public function render()
    {
        return view('livewire.'.config('panel.template').'.search-audit-log');
    }
}
