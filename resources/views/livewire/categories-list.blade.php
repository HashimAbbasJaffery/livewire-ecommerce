
<div class="filter-item" x-data>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" wire:model="list" value="{{ $id }}" class="custom-control-input" id="cat-{{ $id }}">
        <label class="custom-control-label" for="cat-{{ $id }}">{{ $category }}</label>
    </div><!-- End .custom-checkbox -->
</div><!-- End .filter-item -->
