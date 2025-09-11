<?php

// resources/views/filament/pages/bulk-attendance.blade.php
?>
<x-filament-panels::page>
    <div class="space-y-6">
        <form wire:submit.prevent="saveAttendance">
            {{ $this->form }}
            
            <div class="mt-6">
                <x-filament::button type="submit" wire:click="loadStudents" color="gray">
                    Load Students
                </x-filament::button>
            </div>
        </form>

        @if(!empty($this->students))
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Mark Attendance - {{ \Carbon\Carbon::parse($this->attendance_date)->format('F j, Y') }}
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Group: {{ App\Models\Group::find($this->group_id)?->name }}
                    </p>
                </div>

                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($this->students as $index => $student)
                        <div class="px-6 py-4 flex items-center justify-between">
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $student['name'] }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    ID: {{ $student['student_id'] }}
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <div class="flex space-x-2">
                                    @foreach(['present', 'absent', 'late', 'excused'] as $status)
                                        <label class="inline-flex items-center">
                                            <input
                                                type="radio"
                                                name="status_{{ $student['id'] }}"
                                                value="{{ $status }}"
                                                {{ $student['status'] === $status ? 'checked' : '' }}
                                                wire:change="updateAttendance({{ $student['id'] }}, 'status', '{{ $status }}')"
                                                class="form-radio text-primary-600"
                                            >
                                            <span class="ml-1 text-sm capitalize {{ $status === 'present' ? 'text-green-600' : ($status === 'absent' ? 'text-red-600' : ($status === 'late' ? 'text-yellow-600' : 'text-blue-600')) }}">
                                                {{ $status }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                                
                                <div class="w-48">
                                    <input
                                        type="text"
                                        placeholder="Notes (optional)"
                                        value="{{ $student['notes'] }}"
                                        wire:change="updateAttendance({{ $student['id'] }}, 'notes', $event.target.value)"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:text-gray-300 text-sm"
                                    >
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                    <x-filament::button wire:click="saveAttendance" color="primary">
                        Save Attendance
                    </x-filament::button>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>