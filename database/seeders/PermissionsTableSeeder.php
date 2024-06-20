<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            #home
            [
                'title' => 'home_access',
            ],
            #users
            [
                'title' => 'users_access'
            ],
            #permissions
            [
                'title' => 'permission_create',
            ],
            [
                'title' => 'permission_edit',
            ],
            [
                'title' => 'permission_show',
            ],
            [
                'title' => 'permission_delete',
            ],
            [
                'title' => 'permission_access',
            ],
            #role
            [
                'title' => 'role_create',
            ],
            [
                'title' => 'role_edit',
            ],
            [
                'title' => 'role_show',
            ],
            [
                'title' => 'role_delete',
            ],
            [
                'title' => 'role_access',
            ],
            #user
            [
                'title' => 'user_create',
            ],
            [
                'title' => 'user_edit',
            ],
            [
                'title' => 'user_show',
            ],
            [
                'title' => 'user_delete',
            ],
            [
                'title' => 'user_access',
            ],
            #Advanced
            [
                'title' => 'advanced_access',
            ],
            #audit_log
            [
                'title' => 'audit_log_show',
            ],
            [
                'title' => 'audit_log_access',
            ],
            [
                'title' => 'clear_cache_access'
            ],
            [
                'title' => 'change_log_access'
            ],
            [
                'title' => 'profile_password_edit'
            ],
            #Leads
            [
                'title' => 'leads_access', // lead menu
            ],
            [
                'title' => 'lead_access',
            ],
            [
                'title' => 'lead_create',
            ],
            [
                'title' => 'lead_edit',
            ],
            [
                'title' => 'lead_show',
            ],
            [
                'title' => 'lead_delete',
            ],
            #Contacts
            [
                'title' => 'contact_create',
            ],
            [
                'title' => 'contact_edit',
            ],
            [
                'title' => 'contact_show',
            ],
            [
                'title' => 'contact_delete',
            ],
            [
                'title' => 'contact_access',
            ],
            #Career
            [
                'title' => 'career_create',
            ],
            [
                'title' => 'career_edit',
            ],
            [
                'title' => 'career_show',
            ],
            [
                'title' => 'career_delete',
            ],
            [
                'title' => 'career_access',
            ],
            #Tags
            [
                'title' => 'tag_create',
            ],
            [
                'title' => 'tag_edit',
            ],
            [
                'title' => 'tag_show',
            ],
            [
                'title' => 'tag_delete',
            ],
            [
                'title' => 'tag_access',
            ],
            #Blogs
            [
                'title' => 'content_access', // content menu
            ],
            [
                'title' => 'blog_create',
            ],
            [
                'title' => 'blog_edit',
            ],
            [
                'title' => 'blog_show',
            ],
            [
                'title' => 'blog_delete',
            ],
            [
                'title' => 'blog_access',
            ],
            #campaigns
            [
                'title' => 'campaign_create',
            ],
            [
                'title' => 'campaign_edit',
            ],
            [
                'title' => 'campaign_show',
            ],
            [
                'title' => 'campaign_delete',
            ],
            [
                'title' => 'campaign_access',
            ],
            #Change Log
            [
                'title' => 'change_log_access'
            ],
            #property access
            [
                'title' => 'properties_access',
            ],
            #developers
            [
                'title' => 'developer_create',
            ],
            [
                'title' => 'developer_edit',
            ],
            [
                'title' => 'developer_show',
            ],
            [
                'title' => 'developer_delete',
            ],
            [
                'title' => 'developer_access',
            ],
            #projects
            [
                'title' => 'project_create',
            ],
            [
                'title' => 'project_edit',
            ],
            [
                'title' => 'project_show',
            ],
            [
                'title' => 'project_delete',
            ],
            [
                'title' => 'project_access',
            ],
            #units
            [
                'title' => 'unit_create',
            ],
            [
                'title' => 'unit_edit',
            ],
            [
                'title' => 'unit_show',
            ],
            [
                'title' => 'unit_delete',
            ],
            [
                'title' => 'unit_access',
            ],
            #floors
            [
                'title' => 'floor_create',
            ],
            [
                'title' => 'floor_edit',
            ],
            [
                'title' => 'floor_show',
            ],
            [
                'title' => 'floor_delete',
            ],
            [
                'title' => 'floor_access',
            ],
             #agents
            [
                'title' => 'agent_create',
            ],
            [
                'title' => 'agent_edit',
            ],
            [
                'title' => 'agent_show',
            ],
            [
                'title' => 'agent_delete',
            ],
            [
                'title' => 'agent_access',
            ],
             #calls
            [
                'title' => 'call_create',
            ],
            [
                'title' => 'call_edit',
            ],
            [
                'title' => 'call_show',
            ],
            [
                'title' => 'call_delete',
            ],
            [
                'title' => 'call_access',
            ],
            #media
            [
                'title' => 'media_create',
            ],
            [
                'title' => 'media_edit',
            ],
            [
                'title' => 'media_show',
            ],
            [
                'title' => 'media_delete',
            ],
            [
                'title' => 'media_access',
            ],
            #installment
            [
                'title' => 'installment_create',
            ],
            [
                'title' => 'installment_edit',
            ],
            [
                'title' => 'installment_show',
            ],
            [
                'title' => 'installment_delete',
            ],
            [
                'title' => 'installment_access',
            ],
            #Comments
            [
                'title' => 'comment_create',
            ],
            [
                'title' => 'comment_edit',
            ],
            [
                'title' => 'comment_show',
            ],
            [
                'title' => 'comment_delete',
            ],
            [
                'title' => 'comment_access',
            ],
        ];

        foreach($permissions as $_item){
            $permission = Permission::firstOrCreate([
                'title' => $_item['title']
            ]);
            // echo $permission->title . ' - Done' . PHP_EOL;
        }
    }
}
