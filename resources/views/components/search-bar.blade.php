<div class="col m-4">
    <form action="" method="GET">
        <div class="input-group">
            <input type="text" class="form-control me-3 border" name="search" placeholder="{{ __('Search') }}" value="{{isset($searchInput) ? $searchInput : old('searchInput') ?? ''}}">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-filter"></i> {{ __('Apply') }}
            </button>
        </div>
    </form>
</div>