<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $theme = 'simple'; // 'modern' or 'simple'
    public $errorMessage = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function toggleTheme()
    {
        $this->theme = ($this->theme === 'modern') ? 'simple' : 'modern';
    }

    public function login()
    {
        $this->validate();

        $this->errorMessage = '';

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            
            // Redirect based on roles (for now, pointing to dashboard, which we will build next)
            // Just a temporary redirect to '/' or '/portal' for success
            session()->flash('message', 'Login successful!');
            return redirect()->intended('/portal');
        }

        $this->errorMessage = 'The provided credentials do not match our records.';
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('portal');
    }
}
