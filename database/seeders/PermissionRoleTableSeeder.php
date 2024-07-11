<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        $supervisor_permissions = Permission::whereIn('title', ['leads_access', 'campaign_access', 'campaign_create', 'campaign_show', 'campaign_edit', 'campaign_delete', 'lead_access', 'lead_create', 'lead_show', 'lead_edit', 'lead_delete', 'contact_access', 'contact_create', 'contact_show', 'contact_edit', 'contact_delete', 'call_access', 'call_create', 'call_show', 'call_edit', 'call_delete', 'comment_create', 'comment_show', 'comment_access', 'content_access', 'tag_access', 'tag_create', 'tag_show', 'tag_edit', 'tag_delete', 'blog_access', 'blog_create', 'blog_show', 'blog_edit', 'blog_delete', 'properties_access', 'developer_access', 'developer_create', 'developer_show', 'developer_edit', 'developer_delete', 'project_access', 'project_create', 'project_show', 'project_edit', 'project_delete', 'media_access', 'media_create', 'media_show', 'media_edit', 'media_delete', 'installment_access', 'installment_create', 'installment_show', 'installment_edit', 'installment_delete', 'unit_access', 'unit_create', 'unit_show', 'unit_edit', 'unit_delete', 'floor_access', 'floor_create', 'floor_show', 'floor_edit', 'floor_delete', 'home_access', 'profile_password_edit', 'audit_log_access', 'audit_log_show'])->pluck('id');
        Role::where('title' , 'DOS')->first()->permissions()->sync($supervisor_permissions); //Supervisor
        
        $agent_permissions = Permission::whereIn('title', ['unit_create', 'leads_access', 'lead_access', 'lead_create', 'lead_show', 'contact_access', 'contact_create', 'contact_show', 'call_access', 'call_create', 'call_show', 'comment_create', 'comment_show', 'comment_access', 'content_access', 'tag_access', 'tag_create', 'tag_show', 'home_access', 'profile_password_edit'])->pluck('id');
        Role::where('title' , 'Agent')->first()->permissions()->sync($agent_permissions);

        $registered_permissions = Permission::whereIn('title', ['project_create', 'unit_create'])->pluck('id');
        Role::where('title' , 'Registered')->first()->permissions()->sync($registered_permissions);

    }
}
