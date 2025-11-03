<x-filament-panels::page>
    <div class="rtl font-[Amiri] text-gray-800">
        {{-- Header --}}
        <div class="mb-6 text-center space-y-1">
            <h2 class="text-2xl font-bold">{{ $record->school_name ?? 'مدرسة غير معروفة' }}</h2>
            <p class="text-lg">الصف: {{ $record->grade_level ?? '-' }} — الشهر: {{ $record->month ?? '-' }} {{ $record->year ?? '' }}</p>
            <p class="text-md">الأستاذ: {{ $record->teacher_name ?? '-' }}</p>
        </div>

        {{-- Curriculum Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm text-center bg-white rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-3 py-2 w-16">اليوم</th>
                        @foreach ($record->subjects as $subject)
                            <th class="border border-gray-300 px-3 py-2 whitespace-nowrap">{{ $subject['name'] ?? '-' }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Extract all day numbers across all subjects to create a unified set of rows
                        $allDays = collect($record->subjects)
                            ->pluck('days')
                            ->flatten(1)
                            ->pluck('day')
                            ->unique()
                            ->sort()
                            ->values();
                    @endphp

                    @foreach ($allDays as $day)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-3 py-2 font-semibold bg-gray-50">{{ $day }}</td>

                            {{-- Render each subject’s topics for that day --}}
                            @foreach ($record->subjects as $subject)
                                @php
                                    $dayData = collect($subject['days'] ?? [])->firstWhere('day', $day);
                                @endphp
                                <td class="border border-gray-300 px-3 py-2 text-right align-top">
                                    @if ($dayData)
                                        @foreach ($dayData['topics'] ?? [] as $topic)
                                            <div class="mb-1">
                                                <strong class="block text-gray-900">{{ $topic['title'] ?? '' }}</strong>
                                                @if (!empty($topic['bullets']))
                                                    <ul class="list-disc list-inside text-gray-700">
                                                        @foreach ($topic['bullets'] as $bullet)
                                                            <li>{{ $bullet['point'] ?? '' }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="mt-6 text-center text-sm text-gray-600">
            <p>حرر بتاريخ: {{ $record->created_at?->format('Y-m-d') ?? '-' }}</p>
        </div>
    </div>
</x-filament-panels::page>
