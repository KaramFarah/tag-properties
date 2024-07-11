@extends(config('panel.template').'.layouts.app')
@section('content')
    <div class="content">    
        <!-- end page title --> 
        <div class="row">
            <div class="col">
                <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
                    <div class="overflow-x-scroll font-fifteen">
                        <div class="table-responsive">
                            <table class="w-100 items-list bg-transparent">
                                <thead>
                                    <tr class="bg-white">
                                        <th>{{ __('Version No.') }}</th>
                                        <th scope="col">{{ __('Version Changes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($changelogs as $_key => $_item)
                                        <tr>
                                            <td>
                                                {{$_key}}
                                            </td>
                                            <td>
                                                <h5 class="text-secondary font-400">{{ $_item['date'] }}</h5>
                                                <ol>
                                                    @foreach($_item['changes'] as $_changeItem)
                                                        <li>{{ $_changeItem }}</li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection