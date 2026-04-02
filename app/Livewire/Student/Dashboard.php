<?php

declare(strict_types=1);

namespace App\Livewire\Student;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Student Dashboard'])]
class Dashboard extends Component
{
    public function render(): View
    {
        return view('livewire.student.dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
