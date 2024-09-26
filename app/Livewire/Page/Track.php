<?php

namespace App\Livewire\Page;

use App\Courier\PostEx;
use Livewire\Component;

class Track extends Component
{
    public $tracking_number;
    public array $tracking_result;
    public function mount() {
        $this->tracking_number = request("tracking_number");
    }
    public function render()
    {
        if($this->tracking_number) $this->track();
        return view('livewire.page.track');
    }
    public function track() {
        $this->tracking_result = (new PostEx(env("COURIER_POSTEX")))
                                    ->track($this->tracking_number);
    }
}
