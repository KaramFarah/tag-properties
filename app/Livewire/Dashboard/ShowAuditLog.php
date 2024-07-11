<?php

namespace App\Livewire\Dashboard;

use App\Models\AuditLog;
use Livewire\Component;

class ShowAuditLog extends Component
{
    public AuditLog $auditLog;

    public function mount(AuditLog $auditLog)
    {
        $this->auditLog = $auditLog;
    }

    public function render()
    {
        return view('livewire.'.config('panel.template').'.show-audit-log');
    }
}
