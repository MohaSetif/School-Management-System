<x-filament-panels::page>
    <style>
        /* Global Container */
        .profile-container {
            padding: 2rem 1rem;
            background: #f9fafb;
            border-radius: 1rem;
        }
        .dark .profile-container { background: #1f1f1f; }

        .profile-wrapper {
            max-width: 80rem;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Header Card */
        .profile-header {
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            background: #f3f4f6;
            overflow: hidden;
        }
        .dark .profile-header { background: #2b2b2b; }

        .header-content {
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .avatar-container { position: relative; }
        .avatar {
            width: 6rem;
            height: 6rem;
            border-radius: 50%;
            background: #d1d5db;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            color: #374151;
        }
        .dark .avatar { background: #4b5563; color: #f9fafb; }

        .status-indicator {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 1.5rem;
            height: 1.5rem;
            background: #34d399;
            border-radius: 50%;
            border: 2px solid white;
        }
        .dark .status-indicator { border-color: #1f1f1f; }

        .user-info { flex: 1; }
        .user-name { font-size: 1.75rem; font-weight: bold; color: #111827; }
        .dark .user-name { color: #f9fafb; }
        .user-email { font-size: 1rem; color: #6b7280; margin-bottom: 0.5rem; }
        .dark .user-email { color: #d1d5db; }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            background: #e5e7eb;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.875rem;
        }
        .dark .role-badge { background: #374151; color: #f9fafb; }

        /* Cards */
        .content-card {
            background: #ffffff;
            border-radius: 1rem;
            border: 1px solid #e5e7eb;
            padding: 2rem;
            transition: all 0.2s;
        }
        .dark .content-card { background: #2b2b2b; border-color: #4b5563; }

        .card-title { font-size: 1.5rem; font-weight: bold; color: #111827; }
        .dark .card-title { color: #f9fafb; }

        /* Subject Buttons */
        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            margin-top: 1.5rem;
        }

        .subject-btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            background: #f9fafb;
            color: #374151;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }
        .dark .subject-btn { background: #4b5563; color: #f9fafb; border-color: #6b7280; }

        .subject-btn.selected {
            background: #6366f1;
            color: white;
            border-color: #6366f1;
        }
        .subject-btn.selected:hover { transform: scale(1.05); }

        .submit-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.5rem 1.5rem;
            background: #6366f1;
            color: white;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .submit-btn:hover { background: #4f46e5; }

        /* Student Info Cards */
        .info-grid { display: grid; grid-template-columns: 1fr; gap: 1rem; }
        @media(min-width:768px) { .info-grid { grid-template-columns: repeat(2, 1fr); } }

        .info-card {
            background: #f3f4f6;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            padding: 1rem;
        }
        .dark .info-card { background: #4b5563; border-color: #6b7280; }

        .info-label { font-size: 0.75rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem; }
        .dark .info-label { color: #d1d5db; }
        .info-value { font-size: 1.25rem; font-weight: bold; color: #111827; }
        .dark .info-value { color: #f9fafb; }
    </style>

    <div class="profile-container">
        <div class="profile-wrapper">

            <!-- Header -->
            <div class="profile-header">
                <div class="header-content">
                    <div class="avatar-container">
                        <div class="avatar">{{ substr($user->name,0,1) }}</div>
                        <div class="status-indicator"></div>
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ $user->name }}</div>
                        <div class="user-email">{{ $user->email }}</div>
                        <div class="role-badge">
                            {{ __('profile.roles.' . $userType) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teacher Section -->
            @if($userType === 'teacher')
                <div class="content-card">
                    <div class="card-title">{{ __('profile.teacher.title') }}</div>
                    <form wire:submit.prevent="updateSubjects">
                        <div class="subjects-grid">
                            @foreach($subjects as $subject)
                                <button type="button"
                                        wire:click.prevent="toggleSubject({{ $subject->id }})"
                                        class="subject-btn {{ in_array($subject->id, $selectedSubjects) ? 'selected' : '' }}">
                                    {{ $subject->name }}
                                </button>
                            @endforeach
                        </div>
                        <button type="submit" class="submit-btn" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                {{ __('profile.teacher.save_button') }}
                            </span>
                            <span wire:loading>
                                Saving...
                                <svg class="w-4 h-4 inline-block animate-spin ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>

            @else
                <div class="content-card text-center">
                    {{ __('profile.default.no_info') }}
                </div>
            @endif

        </div>
    </div>
</x-filament-panels::page>
