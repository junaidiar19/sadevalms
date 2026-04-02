<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('layouts.app', ['title' => 'Login'])]
class Login extends Component
{
    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|min:6')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', 'These credentials do not match our records.');

            return;
        }

        session()->regenerate();

        $user = Auth::user();

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Welcome back, '.$user->name.'!',
        ]);

        $this->redirect($this->resolveRedirectRoute($user), navigate: true);
    }

    /** @param User $user */
    private function resolveRedirectRoute($user): string
    {
        return match (true) {
            $user->hasRole(RoleEnum::SUPER_ADMIN) => route('superadmin.dashboard'),
            $user->hasRole(RoleEnum::ADMIN) => route('admin.dashboard'),
            $user->hasRole(RoleEnum::TEACHER) => route('teacher.dashboard'),
            $user->hasRole(RoleEnum::STUDENT) => route('student.dashboard'),
            default => route('login'),
        };
    }

    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
