<div>
    @if ($variable->lead_quality == 'good')
    <i class="fa-solid fa-square" style="color: #22ca16;"></i>
    @elseif ($variable->lead_quality == 'follow')
    <i class="fa-solid fa-square" style="color: #e3dd16;"></i>
    @elseif ($variable->lead_quality == 'unqualified')
    <i class="fa-solid fa-square" style="color: #db222b;"></i>
    @endif
    {{ ucfirst($variable->lead_quality) ?? '' }}
</div>