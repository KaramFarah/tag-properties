
    <span class="woocommerce-ordering-pages me-4 font-fifteen">
        {!! __('Showing') !!}
        <span class="fw-semibold">{{ $items->links()->paginator->firstItem() }}</span>
        {!! __('to') !!}
        <span class="fw-semibold">{{ $items->links()->paginator->lastItem() }}</span>
        {!! __('of') !!}
        <span class="fw-semibold">{{ $items->links()->paginator->total() }}</span>
        {!! __('results') !!}
    </span>                          
