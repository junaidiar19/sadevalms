<?php

declare(strict_types=1);

namespace App\Livewire\SuperAdmin;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Super Admin Dashboard'])]
class Dashboard extends Component
{
    public function render(): View
    {
        return view('livewire.super-admin.dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
