<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Add Schedule Form --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                {{ __('calendar.form.add_new') }}
            </h2>

            <form wire:submit.prevent="submit">
                {{ $this->form }}

                <div class="mt-6">
                    <x-filament::button 
                        type="submit"
                        size="lg"
                        class="w-full sm:w-auto relative"
                        wire:loading.attr="disabled"
                    >
                        {{-- Normal state --}}
                        <div wire:loading.remove>
                            <svg class="w-5 h-5 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ __('calendar.buttons.save') }}
                        </div>

                        {{-- Loading state --}}
                        <div wire:loading.flex class="justify-center items-center space-x-2">
                            <svg class="animate-spin ml-2 w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                            </svg>
                            <span>{{ __('calendar.buttons.saving') }}</span>
                        </div>
                    </x-filament::button>
                </div>
            </form>
        </div>

        {{-- Filter Section --}}
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-4">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ __('calendar.weekly_schedule') }}
            </h2>

            <div class="flex items-center gap-2">
                <div class="w-full sm:w-64 border border-neutral-500 bg-neutral-800 rounded-3xl">
                    <x-filament::input.select wire:model="selectedGroupId">
                        <option value="">{{ __('calendar.filter.all_classes') }}</option>
                        @foreach(\App\Models\Group::orderBy('name')->get() as $group)
                            <option value="{{ $group->id }}">{{ $group->name }} ({{ $group->code }})</option>
                        @endforeach
                    </x-filament::input.select>
                </div>

                <x-filament::button wire:click="filter" color="primary" size="sm">
                    <x-heroicon-o-funnel class="w-4 h-4 mr-1" />
                    {{ __('calendar.filter.button') }}
                </x-filament::button>
            </div>
        </div>

        {{-- Weekly Calendar View --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ __('calendar.weeklySchedule') }}
                </h2>
            </div>

            @php
                $schedules = $this->schedules;
                
                $days = ['الأحد' => 'Sunday', 'الإثنين' => 'Monday', 'الثلاثاء' => 'Tuesday', 'الأربعاء' => 'Wednesday', 'الخميس' => 'Thursday'];
                $groupedSchedules = $schedules->groupBy('day_of_week');
                
                $colors = [
                    'bg-blue-100 dark:bg-blue-900/30 border-blue-300 dark:border-blue-700',
                    'bg-purple-100 dark:bg-purple-900/30 border-purple-300 dark:border-purple-700',
                    'bg-green-100 dark:bg-green-900/30 border-green-300 dark:border-green-700',
                    'bg-amber-100 dark:bg-amber-900/30 border-amber-300 dark:border-amber-700',
                    'bg-pink-100 dark:bg-pink-900/30 border-pink-300 dark:border-pink-700',
                ];
            @endphp

            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 p-6">
                        @foreach($days as $arabicDay => $englishDay)
                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                {{-- Day Header --}}
                                <div class="bg-gradient-to-r from-primary-600 to-primary-500 p-4 text-white">
                                    <h3 class="font-bold text-lg text-center">{{ $arabicDay }}</h3>
                                </div>

                                {{-- Schedule Items --}}
                                <div class="p-3 space-y-2 min-h-[200px]">
                                    @php
                                        $daySchedules = $groupedSchedules->get($arabicDay, collect());
                                    @endphp

                                    @forelse($daySchedules as $index => $schedule)
                                        @php
                                            $colorClass = $colors[$index % count($colors)];
                                        @endphp
                                        <div class="rounded-lg border-l-4 p-3 {{ $colorClass }} hover:shadow-md transition-shadow duration-200">
                                            {{-- Time --}}
                                            <div class="flex items-center gap-1 text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span>{{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}</span>
                                                <span>-</span>
                                                <span>{{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</span>
                                            </div>

                                            {{-- Subject --}}
                                            <div class="font-bold text-sm text-gray-900 dark:text-white mb-1">
                                                {{ $schedule->subject->name }}
                                            </div>

                                            {{-- Group/Class --}}
                                            <div class="flex items-center gap-1 text-xs text-gray-600 dark:text-gray-400 mb-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                                <span>{{ $schedule->group->name }} ({{ $schedule->group->code }})</span>
                                            </div>

                                            {{-- Teacher --}}
                                            <div class="flex items-center gap-1 text-xs text-gray-600 dark:text-gray-400">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                <span>{{ $schedule->teacher->user->name }}</span>
                                            </div>

                                            {{-- Room (if exists) --}}
                                            @if(isset($schedule->room) && $schedule->room)
                                                <div class="flex items-center gap-1 text-xs text-gray-600 dark:text-gray-400 mt-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                    <span>Room: {{ $schedule->room }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="flex flex-col items-center justify-center py-8 text-gray-400 dark:text-gray-600">
                                            <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                            <p class="text-sm font-medium">{{ __('calendar.noClasses') }}</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Summary Statistics --}}
            @if($schedules->isNotEmpty())
                <div class="border-t border-gray-200 dark:border-gray-700 p-6 bg-gray-50 dark:bg-gray-900/50">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600 dark:text-primary-400">
                                {{ $schedules->count() }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('calendar.totalClasses') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600 dark:text-primary-400">
                                {{ $schedules->unique('teacher_id')->count() }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('calendar.teachers') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600 dark:text-primary-400">
                                {{ $schedules->unique('group_id')->count() }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('calendar.classes') }}</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>