@php
use App\Models\Group;
use App\Models\Subject;
use App\Models\SchoolSettings;

$isRtl = app()->getLocale() === 'ar';
$dir = $isRtl ? 'rtl' : 'ltr';

// Helper: get subject name by id or code
$subjectMap = Subject::pluck('name', 'id')
    ->merge(Subject::pluck('name', 'code'))
    ->toArray();

$resolveSubject = function ($subject) use ($subjectMap) {
    $key = $subject['name'] ?? null;
    return $subjectMap[$key] ?? $key ?? '-';
};

$user = auth()->user();

$school = $user?->schoolSettings
    ?? SchoolSettings::first();

$schoolName = $school->school_name ?? env('APP_NAME', __('pdf.monthly_curriculum.unspecified_school'));
$province   = $school->province ?? env('SCHOOL_PROVINCE', __('pdf.monthly_curriculum.default_province'));
$district   = $school->district ?? env('SCHOOL_DISTRICT', __('pdf.monthly_curriculum.default_district'));
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('pdf.monthly_curriculum.title') }}</title>
    <style>
        /* ==============
           GLOBAL STYLE
        ============== */
        body {
            font-family: "DejaVu Sans", sans-serif;
            background: #fff;
            color: #000;
            margin: 0;
            padding: 20px;
            font-size: 15px;
            line-height: 1.7;
        }

        html[dir="rtl"] body {
            direction: rtl;
        }

        html[dir="ltr"] body {
            direction: ltr;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .curriculum-docx {
            background: #fff;
            padding: 2rem 2rem 3rem;
        }

        /* ============
           HEADER
        ============ */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .header-table td {
            font-size: 1rem;
            padding: 0.4rem 0.5rem;
            vertical-align: top;
        }

        .header-table tr:first-child td {
            font-weight: bold;
        }

        /* ============
           TABLE
        ============ */
        .table-container {
            overflow-x: auto;
            margin-bottom: 2rem;
        }

        .curriculum-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            table-layout: fixed;
            border: 1px solid #000;
        }

        .curriculum-table th,
        .curriculum-table td {
            border: 1px solid #000;
            padding: 0.5rem;
            vertical-align: top;
        }

        .curriculum-table th {
            background: #f0f0f0;
            font-weight: bold;
            font-size: 1rem;
        }

        .day-cell {
            font-weight: bold;
            background: #f9f9f9;
            width: 80px;
        }

        .subject-cell {
            padding: 0.6rem;
            font-size: 0.95rem;
        }

        body[dir="rtl"] .subject-cell {
            text-align: right;
        }

        body[dir="ltr"] .subject-cell {
            text-align: left;
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

        /* ============
           FOOTER
        ============ */
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

        .page-break {
            page-break-after: always;
        }

        /* ============
           PRINT STYLING
        ============ */
        @page {
            margin: 25mm;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        /* ============
           RESPONSIVE
        ============ */
        @media (max-width: 768px) {
            .curriculum-table th, .curriculum-table td {
                padding: 0.35rem;
                font-size: 0.9rem;
            }

            .header-table td {
                font-size: 0.9rem;
            }

            .footer-table td {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>{{ __('pdf.monthly_curriculum.republic') }}</h3>
        <h4>{{ __('pdf.monthly_curriculum.ministry') }}</h4>
    </div>
    <div class="curriculum-docx">
        @foreach ($curriculums as $record)
            @php
                // Get group details (grade)
                $group = Group::where('id', $record->grade_level)
                    ->orWhere('code', $record->grade_level)
                    ->select('name','code')
                    ->first();

                $groupName = $group ? __('students.' . $group->name) . ' (' . __('students.fields.group') . " {$group->code})" : $record->grade_level;

                // Reverse day order if needed
                $allDays = collect($record->subjects ?? [])
                    ->pluck('days')
                    ->flatten(1)
                    ->pluck('day')
                    ->unique()
                    ->values();
            @endphp

            {{-- Header --}}
            <header class="curriculum-header">
                <table class="header-table">
                    <tr>
                        <td>{{ __('pdf.monthly_curriculum.directorate') }} {{ $province }}</td>
                        <td>{{ __('pdf.monthly_curriculum.academic_year') }}: {{ now()->year - 1 }}/{{ now()->year }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('pdf.monthly_curriculum.inspectorate') }} {{ $district }}</td>
                        <td>{{ __('pdf.monthly_curriculum.class') }}: {{ $groupName }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('pdf.monthly_curriculum.primary_school') }}: {{ $schoolName }}</td>
                        <td>{{ __('pdf.monthly_curriculum.teacher') }}: {{ $record->user?->name ?? '-' }}</td>
                    </tr>
                </table>
            </header>

            {{-- Curriculum Table --}}
            <div class="table-container">
                <table class="curriculum-table">
                    <thead>
                        <tr>
                            <th>{{ __('pdf.monthly_curriculum.days') }}</th>
                            @foreach ($record->subjects ?? [] as $subject)
                                <th>{{ $resolveSubject($subject) }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($allDays as $day)
                            <tr>
                                <td class="day-cell">{{ $day }}</td>

                                @foreach ($record->subjects ?? [] as $subject)
                                    @php
                                        $dayData = collect($subject['days'] ?? [])->firstWhere('day', $day);
                                    @endphp

                                    <td class="subject-cell">
                                        @if ($dayData)
                                            @foreach ($dayData['topics'] ?? [] as $topic)
                                                <p class="topic-line">{{ $topic['title'] ?? '' }}</p>
                                                @if (!empty($topic['bullets']))
                                                    <ul class="topic-points">
                                                        @foreach ($topic['bullets'] as $bullet)
                                                            <li>{{ $bullet['point'] ?? '' }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endforeach
                                        @else
                                            <span>—</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <footer class="signatures">
                <table class="footer-table">
                    <tr>
                        <td>{{ __('pdf.monthly_curriculum.teacher') }}</td>
                        <td>{{ __('pdf.monthly_curriculum.director') }}</td>
                        <td>{{ __('pdf.monthly_curriculum.inspector') }}</td>
                    </tr>
                </table>
            </footer>

            @if (!$loop->last)
                <div class="page-break"></div>
            @endif
        @endforeach
    </div>
</body>
</html>
