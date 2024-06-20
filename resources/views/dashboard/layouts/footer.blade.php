<footer class="footer">
    <div class="container-fluid fs-6 text-end">
        {{ sprintf('%s - %s: %s', config('panel.site_title'), __('Version'), config('panel.version')) }}
    </div>
</footer>
<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>