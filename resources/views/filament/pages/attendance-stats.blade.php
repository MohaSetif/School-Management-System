<x-filament-panels::page>
    <div class="space-y-6 text-right" dir="rtl">

        <h2 class="text-2xl font-bold text-gray-600 text-center">
            {{ __('attendance.stats.title') }}
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <x-filament::card>
                <div class="text-gray-600 text-sm">{{ __('attendance.stats.total_students') }}</div>
                <div class="text-2xl font-bold">{{ $stats['total_students'] }}</div>
            </x-filament::card>

            <x-filament::card>
                <div class="text-gray-600 text-sm">{{ __('attendance.stats.total_days') }}</div>
                <div class="text-2xl font-bold">{{ $stats['total_days'] }}</div>
            </x-filament::card>

            <x-filament::card>
                <div class="text-gray-600 text-sm">{{ __('attendance.stats.realistic_attendance') }}</div>
                <div class="text-2xl font-bold white">{{ $stats['realistic_attendance'] }}</div>
            </x-filament::card>

            <x-filament::card>
                <div class="text-gray-600 text-sm">{{ __('attendance.stats.total_attendances') }}</div>
                <div class="text-2xl font-bold white">{{ $stats['total_attendances'] }}</div>
            </x-filament::card>

            <x-filament::card>
                <div class="text-gray-600 text-sm">{{ __('attendance.stats.attendance_percent') }}</div>
                <div class="text-2xl font-bold white">{{ $stats['attendance_percent'] }}%</div>
            </x-filament::card>

            <x-filament::card>
                <div class="text-gray-600 text-sm">{{ __('attendance.stats.absence_percent') }}</div>
                <div class="text-2xl font-bold white">{{ $stats['absence_percent'] }}%</div>
            </x-filament::card>
        </div>

        <div class="mt-6 text-center text-sm text-gray-500">
            {{ __('attendance.stats.last_update') }} {{ now()->addHour()->format('Y-m-d H:i') }}
        </div>
    </div>
</x-filament-panels::page>
