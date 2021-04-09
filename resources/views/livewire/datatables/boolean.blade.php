<div class="d-flex justify-content-around align-items-center">
@if($value === 0)
    <x-icons.x-circle class="text-danger font-weight-bold" />
@elseif($value === 1)
    <x-icons.check-circle class="text-success font-weight-bold" />
@else
    -
@endif
</div>
