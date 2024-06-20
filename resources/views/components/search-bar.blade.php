<div class="col m-4">
    <form action="" method="GET">
        <div class="input-group">
            {{-- <input type="text" class="form-control" name="search" placeholder="search" value="{{isset($search) ? $search : old('search') ?? ''}}"> --}}
            {{-- {{dd($search)}} --}}
            <input type="text" class="form-control me-3 border" name="search" placeholder="{{ __('Search') }}" value="{{isset($searchInput) ? $searchInput : old('searchInput') ?? ''}}">
            <button type="submit" class="btn btn-primary">
                {{-- {{isset($search) ? $search : ''}} --}}
                <i class="fa fa-filter"></i> {{ __('Apply') }}
            </button>
        </div>
    </form>
</div>