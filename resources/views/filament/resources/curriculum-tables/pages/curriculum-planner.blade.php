<x-filament-panels::page>
    <div class="planner-page rtl font-[Amiri]">
        {{-- Header --}}
        <!-- <header class="planner-header">
            <p>الصف: {{ $record->grade_level ?? '-' }} — الشهر: {{ $record->month ?? '-' }} {{ $record->year ?? '' }}</p>
            <p>الأستاذ: {{ $record->teacher_name ?? '-' }}</p>
        </header> -->

        {{-- Curriculum Table --}}
        <div class="table-container">
            <table class="curriculum-table">
                <thead>
                    <tr>
                        <th>{{ __('curriculum.infolist.day') }}</th>
                        @foreach ($record->subjects as $subject)
                            <th>{{ $subject['name'] ?? '-' }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        $allDays = collect($record->subjects)
                            ->pluck('days')
                            ->flatten(1)
                            ->pluck('day')
                            ->unique()
                            ->sortDesc()
                            ->values();
                    @endphp

                    @foreach ($allDays as $day)
                        <tr>
                            <td class="day-cell">{{ $day }}</td>

                            @foreach ($record->subjects as $subject)
                                @php
                                    $dayData = collect($subject['days'] ?? [])->firstWhere('day', $day);
                                @endphp
                                <td class="subject-cell">
                                    @if ($dayData)
                                        @foreach ($dayData['topics'] ?? [] as $topic)
                                            <div class="topic-card">
                                                <strong>{{ $topic['title'] ?? '' }}</strong>
                                                @if (!empty($topic['bullets']))
                                                    <ul>
                                                        @foreach ($topic['bullets'] as $bullet)
                                                            <li>{{ $bullet['point'] ?? '' }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="empty">—</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <footer class="planner-footer">
            <p>{{ __('curriculum.infolist.created_at') }}: {{ $record->created_at?->format('Y-m-d') ?? '-' }}</p>
        </footer>
    </div>

    <style>
        /* Base Layout */
        .planner-page {
            direction: rtl;
            padding: 2rem 1rem;
            color: var(--text);
            transition: background 0.3s ease, color 0.3s ease;
        }

        .planner-header {
            text-align: center;
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--border);
            padding-bottom: 1rem;
        }

        .planner-header p {
            color: var(--muted);
            margin: 0.2rem 0;
            font-size: 1.05rem;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 0.75rem;
            box-shadow: var(--shadow);
            background: var(--table-bg);
        }

        .curriculum-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .curriculum-table th,
        .curriculum-table td {
            border: 1px solid var(--border);
            padding: 0.75rem;
            text-align: center;
            vertical-align: top;
        }

        .curriculum-table th {
            background: var(--thead-bg);
            color: var(--thead-text);
            font-weight: 600;
        }

        .curriculum-table tr:nth-child(even) {
            background-color: var(--row-alt);
        }

        .day-cell {
            font-weight: bold;
            color: var(--accent);
            background: var(--day-bg);
        }

        .subject-cell {
            text-align: right;
        }

        .topic-card {
            background: var(--topic-bg);
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            box-shadow: var(--inner-shadow);
        }

        .topic-card strong {
            display: block;
            color: var(--topic-title);
            margin-bottom: 0.25rem;
        }

        .topic-card ul {
            list-style: disc;
            list-style-position: inside;
            margin: 0;
            padding: 0;
            color: var(--topic-text);
        }

        .empty {
            color: var(--muted);
        }

        .planner-footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--muted);
            font-size: 0.9rem;
            border-top: 1px solid var(--border);
            padding-top: 1rem;
        }

        /* Light Mode */
        :root {
            --bg: #f9fafb;
            --text: #1f2937;
            --muted: #6b7280;
            --accent: #374151;
            --border: #d1d5db;
            --table-bg: #ffffff;
            --thead-bg: #f3f4f6;
            --thead-text: #111827;
            --row-alt: #f9fafb;
            --day-bg: #f3f4f6;
            --topic-bg: #f9fafb;
            --topic-title: #111827;
            --topic-text: #374151;
            --shadow: 0 4px 10px rgba(0,0,0,0.05);
            --inner-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }

        /* Dark Mode - Neutral Palette */
        html.dark, .dark {
            --bg: #1a1a1a;
            --text: #e5e5e5;
            --muted: #a3a3a3;
            --accent: #d4d4d4;
            --border: #333;
            --table-bg: #1f1f1f;
            --thead-bg: #2a2a2a;
            --thead-text: #f5f5f5;
            --row-alt: #181818;
            --day-bg: #222;
            --topic-bg: #2a2a2a;
            --topic-title: #f0f0f0;
            --topic-text: #d4d4d4;
            --shadow: 0 4px 10px rgba(0,0,0,0.5);
            --inner-shadow: inset 0 1px 3px rgba(255,255,255,0.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .curriculum-table th,
            .curriculum-table td {
                padding: 0.5rem;
                font-size: 0.9rem;
            }

            .planner-header p {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .curriculum-table {
                font-size: 0.85rem;
                min-width: unset;
            }
        }
    </style>
</x-filament-panels::page>
