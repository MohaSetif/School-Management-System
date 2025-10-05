<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Exception;

class Profile extends Page
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserCircle;
    protected string $view = 'filament.pages.profile';

    public $user;
    public $profile;
    public $userType;
    public $selectedSubjects = [];

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->role === 'teacher') {
            $this->userType = 'teacher';
            $this->profile = $this->user->teacher;
            $this->selectedSubjects = $this->profile->subjects->pluck('id')->toArray();
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

    // Toggle subject selection for buttons
    public function toggleSubject($subjectId)
    {
        if (in_array($subjectId, $this->selectedSubjects)) {
            $this->selectedSubjects = array_diff($this->selectedSubjects, [$subjectId]);
        } else {
            $this->selectedSubjects[] = $subjectId;
        }
    }

    // Save selected subjects with error handling
    public function updateSubjects()
    {
        try {
            if ($this->userType !== 'teacher') {
                throw new Exception('Only teachers can update subjects.');
            }

            $this->profile->subjects()->sync($this->selectedSubjects);

            Notification::make()
                ->title('Success!')
                ->body('Your subjects have been updated.')
                ->success()
                ->send();
        } catch (Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Failed to update subjects: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
