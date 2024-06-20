@extends('dashboard.layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box page-title-box-alt">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ trans('global.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ trans('global.search') }}</a></li>
                </ol>
            </div>
            <h4 class="page-title">{{ trans('global.search') }}</h4>
        </div>
    </div>
</div>     
<!-- end page title -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <select class="searchable-field form-control"></select>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.searchable-field').select2({
            minimumInputLength: 3,
            ajax: {
                url: '{{ route("dashboard.search.globalSearchPost") }}',
                dataType: 'json',
                type: 'POST',
                delay: 200,
                data: function (term) {
                    return {
                        search: term
                    };
                },
                results: function (data) {
                    return {
                        data
                    };
                }
            },
            escapeMarkup: function (markup) { return markup; },
            templateResult: formatItem,
            templateSelection: formatItemSelection,
            placeholder : "{{ trans('global.search') }}...",
            language: {
                inputTooShort: function(args) {
                    var remainingChars = args.minimum - args.input.length;
                    var translation = "{{ trans('global.search_input_too_short') }}";

                    return translation.replace(':count', remainingChars);
                },
                errorLoading: function() {
                    return "{{ trans('global.results_could_not_be_loaded') }}";
                },
                searching: function() {
                    return "{{ trans('global.searching') }}";
                },
                noResults: function() {
                    return "{{ trans('global.no_results') }}";
                },
            }

        });
        function formatItem (item) {
            if (item.loading) {
                return "{{ trans('global.searching') }}...";
            }
            var markup = "<div class='searchable-link' href='" + item.url + "'>";
            markup += "<div class='searchable-title'>" + item.model + "</div>";
            $.each(item.fields, function(key, field) {
                markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " + item[field] + "</div>";
            });
            markup += "</div>";

            return markup;
        }
        function formatItemSelection (item) {
            if (!item.model) {
                return "{{ trans('global.search') }}...";
            }
            return item.model;
        }
        $(document).delegate('.searchable-link', 'click', function() {
            var url = $(this).attr('href');
            window.location = url;
        });
    });
</script>
@endsection