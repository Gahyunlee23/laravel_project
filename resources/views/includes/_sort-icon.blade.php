@if($sortField !==$field)
    <i class="fad fa-sort"></i>
@elseif ($sortAsc)
    <i class="fad fa-sort-up"></i>
@else
    <i class="fad fa-sort-down"></i>
@endif
