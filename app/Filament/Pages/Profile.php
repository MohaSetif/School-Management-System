<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class Profile extends Page
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserCircle;
    protected string $view = 'filament.pages.profile';

    public $user;
    public $profile;
    public $userType;

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->role === 'teacher') {
            $this->userType = 'teacher';
            $this->profile = $this->user->teacher;
        } elseif ($this->user->role === 'student') {
            $this->userType = 'student';
            $this->profile = $this->user->student;
        } else {
            $this->userType = 'default';
            $this->profile = $this->user;
        }
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('user.name')->label('Full Name')->required(),
            TextInput::make('user.email')->label('Email')->required(),
        ];
    }
}
