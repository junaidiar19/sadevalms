<?php

use App\Enums\RoleEnum;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Settings\AppProfile as AdminAppProfile;
use App\Livewire\Admin\Settings\Language as AdminLanguage;
use App\Livewire\Admin\Settings\Theme as AdminTheme;
use App\Livewire\Auth\Login;
use App\Livewire\Student\Dashboard as StudentDashboard;
use App\Livewire\SuperAdmin\Dashboard as SuperAdminDashboard;
use App\Livewire\Teacher\Dashboard as TeacherDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

// Guest routes
Route::middleware('guest')->group(function (): void {
    Route::livewire('/login', Login::class)->name('login');
});

// Super Admin
Route::middleware(['auth', 'role:'.RoleEnum::SUPER_ADMIN])->prefix('superadmin')->name('superadmin.')->group(function (): void {
    Route::livewire('/dashboard', SuperAdminDashboard::class)->name('dashboard');
});

// Admin
Route::middleware(['auth', 'role:'.RoleEnum::ADMIN])->prefix('admin')->name('admin.')->group(function (): void {
    Route::livewire('/dashboard', AdminDashboard::class)->name('dashboard');

    // Settings
    Route::prefix('settings')->name('settings.')->group(function (): void {
        Route::livewire('/app-profile', AdminAppProfile::class)->name('app-profile');
        Route::livewire('/language', AdminLanguage::class)->name('language');
        Route::livewire('/theme', AdminTheme::class)->name('theme');
    });
});

// Teacher
Route::middleware(['auth', 'role:'.RoleEnum::TEACHER])->prefix('teacher')->name('teacher.')->group(function (): void {
    Route::livewire('/dashboard', TeacherDashboard::class)->name('dashboard');
});

// Student
Route::middleware(['auth', 'role:'.RoleEnum::STUDENT])->prefix('student')->name('student.')->group(function (): void {
    Route::livewire('/dashboard', StudentDashboard::class)->name('dashboard');
});
