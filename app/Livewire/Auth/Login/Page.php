<?php

namespace App\Livewire\Auth\Login;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Page extends Component
{
    public $email;
    public $password;

    public function save() {
        $this->validate([
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:6|max:255',
        ]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('error', 'Invalid Credentials');
            return;
        }

        // return redirect()->intended('/');
        return redirect(session()->pull('url.intended', '/'));
    }

    public function render()
    {
        return view('livewire.auth.login.page');
    }
}
