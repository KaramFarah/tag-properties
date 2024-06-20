@extends('fullwidth.layouts.app')
@section('content')
<div class="card table-responsive">
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td class="w-75">
                        {{ $auditLog->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Description') }}
                    </th>
                    <td>
                        {{ $auditLog->description }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Ref Id') }}
                    </th>
                    <td>
                        {{ $auditLog->subject_id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Ref Type') }}
                    </th>
                    <td>
                        {{ $auditLog->subject_type }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('User') }}
                    </th>
                    <td>
                        {{ $auditLog->user->name ?? 'System User' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Properties') }}
                    </th>
                    <td>
                        {{ $auditLog->properties }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Host') }}
                    </th>
                    <td>
                        {{ $auditLog->host }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Created At') }}
                    </th>
                    <td>
                        {{ $auditLog->created_at }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection