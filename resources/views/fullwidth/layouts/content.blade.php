<div class="full-row px-40 py-30 xs-p-0">
	<div class="container-fluid">
		<h3 class="my-3">{{ $local_title ?? 'No Local Title'}}</h3>
		<x-session-alert/>
		@yield('content')
	</div>
</div>