@section("title", "Track")
<div class="container mx-auto">
    <form action="" wire:loading.attr="disabled" wire:target="track" class="mt-3 mb-3" wire:submit="track">
        <label for="tracking_number float-left">
            Tracking Number*
            <div class="inputs d-flex">
                <input type="text" wire:model="tracking_number" placeholder="Tracking Number" class="w-50 form-control" name="" id="tracking_number">
                <button type="submit" wire:loading.attr="disabled" wire:target="track" class="btn btn-dark" style="height: 40px;">
                    <p style="color: white;" wire:loading.remove wire:target="track">Track</p>
                    <div wire:loading wire:target="track" class="spinner-white"></div>
                </button>
            </div>
        </label>
    </form>

    @if(isset($tracking_result["dist"]))
    <div class="result mx-auto" style="text-align: center;">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Order Timeline</h6>
                    <div id="content">
                        <ul class="timeline">
                            @foreach(array_reverse($tracking_result["dist"]["transactionStatusHistory"]) as $history)
                                <li class="event" data-date="{{ \Carbon\Carbon::parse($history["updatedAt"])->format("Y-m-d H:i:s") }}">
                                    <p>{{ $history["transactionStatusMessage"] }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@elseif(isset($tracking_result["statusCode"]) && $tracking_result["statusCode"] === "404")
<div class="alert alert-danger mb-3">No Order was found!</div>
    @endif
</div>
