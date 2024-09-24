<div class="mx-auto text-center p-5" style="width: 50%;">
    <i class="fa-regular fa-circle-check display-1" style="color: #666;"></i>
    <p class="mt-1">Your order has been placed!</p>
    <p>Your Tracking Number is: <span style="font-weight: bolder;">{{ session()->get("tracking_number") }}</span></p>
    <p>You can Track your Order by Clicking the <a href="{{ route('track') }}">Track</a> option in navigation bar</p>
</div>
