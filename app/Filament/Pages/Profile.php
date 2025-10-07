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

    public static function getNavigationLabel(): string
    {
        return __('profile.label');
    }

    public $user;
    public $profile;
    public $userType;
    public $selectedSubjects = [];

    public function mount(): void
    {
        $this->user = Auth::user();

        // Define the supported roles and their corresponding relationships
        $roleMap = [
            'teacher'   => 'teacher',
            'student'   => 'student',
            'headmaster'=> 'headmaster',
            'employee'  => 'employee',
        ];

        // Determine the current user type
        $this->userType = $roleMap[$this->user->role] ?? 'default';

        // Load the related profile model if it exists
        $this->profile = $this->user->{$roleMap[$this->user->role]} ?? $this->user;

        // If the user is a teacher, load their subjects
        $this->selectedSubjects = match ($this->userType) {
            'teacher' => $this->profile->subjects?->pluck('id')->toArray() ?? [],
            default => [],
        };
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('user.name')
                ->label(__('profile.form.full_name'))
                ->required(),
            TextInput::make('user.email')
                ->label(__('profile.form.email'))
                ->required(),
        ];
    }

    public function toggleSubject($subjectId): void
    {
        if (in_array($subjectId, $this->selectedSubjects)) {
            $this->selectedSubjects = array_diff($this->selectedSubjects, [$subjectId]);
        } else {
            $this->selectedSubjects[] = $subjectId;
        }
    }

    public function updateSubjects(): void
    {
        try {
            if ($this->userType !== 'teacher') {
                throw new Exception(__('profile.errors.teacher_only'));
            }

            $this->profile->subjects()->sync($this->selectedSubjects);

            Notification::make()
                ->title(__('profile.notifications.success.title'))
                ->body(__('profile.notifications.success.body'))
                ->success()
                ->send();
        } catch (Exception $e) {
            Notification::make()
                ->title(__('profile.notifications.error.title'))
                ->body(__('profile.notifications.error.body', ['message' => $e->getMessage()]))
                ->danger()
                ->send();
        }
    }
}
