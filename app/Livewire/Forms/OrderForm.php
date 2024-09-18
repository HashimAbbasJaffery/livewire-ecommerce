<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderForm extends Form
{
    #[Validate('required|min:3')]
    public $first_name;

    #[Validate('required|min:3')]
    public $last_name;

    #[Validate('required|min:3')]
    public $street_address;

    #[Validate('required|min:3')]
    public $apartment;

    #[Validate('required')]
    public $city;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|numeric|digits:11')]
    public $phone;

    public $order_notes;

    public function messages() {
        return [
            "phone.number" => "Phone Number should be in numbers",
            "phone.digits" => "Phone Number should be valid"
        ];
    }
}
