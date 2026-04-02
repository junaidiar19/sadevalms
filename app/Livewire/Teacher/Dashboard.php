<?php

declare(strict_types=1);

namespace App\Livewire\Teacher;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.dashboard')]
#[Title('Teacher Dashboard')]
class Dashboard extends Component
{
    public function render(): View
    {
        return view('livewire.teacher.dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
