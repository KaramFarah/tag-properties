<div class="col-md-10 ms-sm-auto px-md-4">
    <x-session-alert/>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>{{ $local_title ?? 'No Local Title'}}</h1>
		@isset($breadcrumbs)
			<div class="btn-toolbar mb-2 mb-md-0">
				@include('dashboard.layouts.breadcrumbs')
			</div>
		@endisset
	</div>
    @yield('content')
</div>
<div class="toast-container top-0 end-0 p-3" id="customToastContainer"></div>