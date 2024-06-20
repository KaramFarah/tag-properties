<div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="w-25">
                            {{ __('Id') }}
                        </th>
                        <td>
                            {{ $auditLog->id }}
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
                            {{ $auditLog->user->name }}
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
</div>
