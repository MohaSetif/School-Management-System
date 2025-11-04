<x-filament-panels::page>
    <div class="curriculum-docx rtl font-[Amiri] text-[16px] leading-relaxed">
    @foreach ($curriculums as $record)
        {{-- ======== HEADER ======== --}}
        <header class="curriculum-header">
            <table class="header-table">
                <tr>
                    <td>مديرية التربية والتعليم: لولاية سطيف</td>
                    <td>الموسم الدراسي: {{ now()->year - 1 }}/{{ now()->year }}</td>
                </tr>
                <tr>
                    <td>مفتشية التربية والتعليم: لمقاطعة قجال</td>
                    <td>الصف: {{ $record->grade_level ?? '-' }}</td>
                </tr>
                <tr>
                    <td>ابتدائية: {{ $record->user->school_name ?? 'معزوز لخضر ـ أولاد صابرـ' }}</td>
                    <td>الأستاذ: {{ $record->user->name ?? '-' }}</td>
                </tr>
            </table>
        </header>

        {{-- ======== MAIN TABLE ======== --}}
        <div class="table-container">
            <table class="curriculum-table">
                <thead>
                    <tr>
                        <th>الأيّام</th>
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
                            ->sort()
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
                                            <p class="topic-line">
                                                {{ $topic['title'] ?? '' }}
                                            </p>
                                            @if (!empty($topic['bullets']))
                                                <ul class="topic-points">
                                                    @foreach ($topic['bullets'] as $bullet)
                                                        <li>{{ $bullet['point'] ?? '' }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ======== FOOTER ======== --}}
        <footer class="signatures">
            <table class="footer-table">
                <tr>
                    <td>الأستاذ</td>
                    <td>السيد المدير</td>
                    <td>السيد المفتش</td>
                </tr>
            </table>
        </footer>
    @endforeach
    </div>

    <style>
        .curriculum-docx {
            direction: rtl;
            padding: 1rem 2rem;
            background: white;
            color: black;
        }

        /* ======== HEADER ======== */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .header-table td {
            font-size: 1rem;
            padding: 0.25rem 0.5rem;
            vertical-align: top;
        }

        /* ======== MAIN TABLE ======== */
        .table-container {
            overflow-x: auto;
        }

        .curriculum-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            table-layout: fixed;
        }

        .curriculum-table th,
        .curriculum-table td {
            border: 1px solid #000;
            padding: 0.35rem;
            vertical-align: top;
        }

        .curriculum-table th {
            background: #f0f0f0;
            font-weight: bold;
        }

        .day-cell {
            font-weight: bold;
            background: #f9f9f9;
            width: 60px;
        }

        .subject-cell {
            text-align: right;
            padding: 0.5rem;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .topic-line {
            margin: 0;
            padding: 0;
            font-weight: normal;
        }

        .topic-points {
            list-style: none;
            padding-right: 1rem;
            margin: 0.25rem 0 0;
        }

        .topic-points li::before {
            content: "ـ ";
        }

        /* ======== FOOTER ======== */
        .footer-table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            margin-top: 2rem;
        }

        .footer-table td {
            padding: 1rem;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* ======== PRINT STYLE ======== */
        @media print {
            body {
                background: white;
                color: black;
            }
            .curriculum-docx {
                padding: 0;
                margin: 0;
            }
            .curriculum-table th,
            .curriculum-table td {
                border: 1px solid #000 !important;
            }
        }
    </style>
</x-filament-panels::page>
