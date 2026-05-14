<x-filament-panels::page>
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --success: #22c55e;
        }

        .profile-page {
            padding: 2rem 1rem;
        }

        .profile-layout {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* HERO */
        .profile-hero {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            background:
                radial-gradient(circle at top right, rgba(99, 102, 241, 0.35), transparent 30%),
                linear-gradient(135deg, #4f46e5 0%, #6366f1 45%, #8b5cf6 100%);
            padding: 2.5rem;
            color: white;
            box-shadow:
                0 20px 50px rgba(99, 102, 241, 0.25),
                inset 0 1px 1px rgba(255, 255, 255, 0.15);
        }

        .profile-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .hero-user {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .avatar-wrapper {
            position: relative;
        }

        .avatar {
            width: 96px;
            height: 96px;
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.4rem;
            font-weight: 800;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow:
                inset 0 1px 1px rgba(255, 255, 255, 0.15),
                0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .online-dot {
            position: absolute;
            right: -2px;
            bottom: -2px;
            width: 18px;
            height: 18px;
            background: var(--success);
            border-radius: 999px;
            border: 3px solid white;
        }

        .hero-name {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: .4rem;
        }

        .hero-email {
            color: rgba(255, 255, 255, 0.82);
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .role-chip {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .55rem 1rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            font-weight: 600;
            font-size: .9rem;
        }

        .hero-stats {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .stat-card {
            min-width: 130px;
            padding: 1rem 1.25rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .stat-label {
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: .35rem;
        }

        .stat-value {
            font-size: 1.4rem;
            font-weight: 800;
        }

        /* MAIN CARD */
        .main-card {
            border-radius: 28px;
            background: white;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .dark .main-card {
            background: #18181b;
            border-color: #27272a;
        }

        .card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .dark .card-header {
            border-color: #27272a;
        }

        .card-title-group h2 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 800;
            color: #111827;
        }

        .dark .card-title-group h2 {
            color: white;
        }

        .card-subtitle {
            margin-top: .3rem;
            font-size: .92rem;
            color: #6b7280;
        }

        .dark .card-subtitle {
            color: #a1a1aa;
        }

        .card-body {
            padding: 2rem;
        }

        /* SUBJECTS */
        .subjects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
            gap: 1rem;
        }

        .subject-btn {
            position: relative;
            overflow: hidden;
            padding: 1rem;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            color: #111827;
            font-weight: 700;
            transition: .25s ease;
            cursor: pointer;
            min-height: 90px;
            display: flex;
            align-items: flex-end;
            text-align: left;
        }

        .subject-btn::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(99, 102, 241, .08);
        }

        .subject-btn:hover {
            transform: translateY(-4px);
            border-color: rgba(99, 102, 241, .35);
            box-shadow: 0 12px 24px rgba(99, 102, 241, .12);
        }

        .subject-btn.selected {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 16px 30px rgba(99, 102, 241, .28);
        }

        .subject-btn.selected::before {
            background: rgba(255, 255, 255, .12);
        }

        .dark .subject-btn {
            background: #27272a;
            border-color: #3f3f46;
            color: #f4f4f5;
        }

        .dark .subject-btn.selected {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        /* ACTION BAR */
        .action-bar {
            margin-top: 2rem;
            display: flex;
            justify-content: flex-end;
        }

        .save-btn {
            border: none;
            cursor: pointer;
            border-radius: 16px;
            padding: .9rem 1.5rem;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            box-shadow: 0 10px 20px rgba(99, 102, 241, .25);
            transition: .25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .75rem;
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 28px rgba(99, 102, 241, .35);
        }

        .save-btn:disabled {
            opacity: .7;
            cursor: not-allowed;
        }

        /* EMPTY */
        .empty-state {
            padding: 3rem 2rem;
            text-align: center;
            color: #6b7280;
        }

        .dark .empty-state {
            color: #a1a1aa;
        }

        @media (max-width: 768px) {
            .profile-hero {
                padding: 2rem;
            }

            .hero-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-user {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-body,
            .card-header {
                padding: 1.25rem;
            }

            .hero-name {
                font-size: 1.7rem;
            }
        }
    </style>

    <div class="profile-page">
        <div class="profile-layout">

            <!-- HERO -->
            <div class="profile-hero">
                <div class="hero-content">

                    <div class="hero-user">
                        <div class="avatar-wrapper">
                            <div class="avatar">
                                {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                            </div>
                            <div class="online-dot"></div>
                        </div>

                        <div>
                            <div class="hero-name">
                                {{ $user->name }}
                            </div>

                            <div class="hero-email">
                                {{ $user->email }}
                            </div>

                            <div class="role-chip">
                                {{ __('profile.roles.' . $userType) }}
                            </div>
                        </div>
                    </div>

                    <div class="hero-stats">
                        <div class="stat-card">
                            <div class="stat-label">{{ __('profile.status') }}</div>
                            <div class="stat-value">{{ __('profile.active') }}</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-label">{{ __('profile.teacher.subjects') }}</div>
                            <div class="stat-value">
                                {{ count($selectedSubjects ?? []) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- CONTENT -->
            @if($userType === 'teacher')
                <div class="main-card">

                    <div class="card-header">
                        <div class="card-title-group">
                            <h2>{{ __('profile.teacher.title') }}</h2>
                            <div class="card-subtitle">
                                {{ __('profile.purpose') }}
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form wire:submit.prevent="updateSubjects">

                            <div class="subjects-grid">
                                @foreach($subjects as $subject)
                                    <button type="button" wire:click.prevent="toggleSubject({{ $subject->id }})"
                                        class="subject-btn {{ in_array($subject->id, $selectedSubjects) ? 'selected' : '' }}">
                                        <span>{{ __('profile.subjects.' . $subject->name) }}</span>
                                    </button>
                                @endforeach
                            </div>

                            <div class="action-bar">
                                <button type="submit" class="save-btn" wire:loading.attr="disabled">
                                    <span wire:loading.remove>
                                        {{ __('profile.teacher.save_button') }}
                                    </span>

                                    <span wire:loading class="inline-flex items-center gap-2">
                                        Saving
                                        <svg class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>

                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            @else
                <div class="main-card">
                    <div class="empty-state">
                        {{ __('profile.default.no_info') }}
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-filament-panels::page>