<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Logout extends Component
{
    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'You have been logged out successfully.',
        ]);

        $this->redirect(route('login'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.auth.logout');
    }
}
