<?php

namespace App\Livewire\Page;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{

    #[Validate("required|string|email")]
    public $email;

    #[Validate("required|string|min:3")]
    public $password;
    public $remember_me;
    public $error_message;
    public function render()
    {
        return view('livewire.page.login');
    }
    public function login() {

        if (! Auth::attempt($this->only('email', 'password'), $this->remember_me)) {
            $this->dispatch("invalid-credentials");
        } else {
            return redirect()->to(route("home"))->with("login", true);
        }
    }
}
