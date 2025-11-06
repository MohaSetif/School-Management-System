@php
use App\Models\Group;
use App\Models\Subject;
use App\Models\SchoolSettings;
use Illuminate\Support\Facades\Auth;

// Sort by oldest first
$curriculums = \App\Models\CurriculumTable::where('user_id', Auth::id())
    ->orderBy('created_at', 'asc')
    ->get();

// Helper: get subject name by id or code
$subjectMap = Subject::pluck('name', 'id')
    ->merge(Subject::pluck('name', 'code'))
    ->toArray();

// Helper closure for resolving subject name
$resolveSubject = function ($subject) use ($subjectMap) {
    $key = $subject['name'] ?? null;
    return $subjectMap[$key] ?? $key ?? '-';
};

// Detect user and related school
$user = auth()->user();
$school = $user?->schoolSettings
    ?? SchoolSettings::first(); // fallback to first if teacher has none

$schoolName = $school->school_name ?? env('APP_NAME', 'مدرسة غير محددة');
$province   = $school->province ?? env('SCHOOL_PROVINCE', 'سطيف');
$district   = $school->district ?? env('SCHOOL_DISTRICT', 'قجال');
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التوزيع الشهري</title>
    <style>
        /* ==============
           GLOBAL STYLE
        ============== */
        body {
            font-family: 'Amiri', 'Cairo', sans-serif;
            direction: rtl;
            background: #fff;
            color: #000;
            margin: 0;
            padding: 20px;
            font-size: 15px;
            line-height: 1.7;
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
            text-align: right;
            padding: 0.6rem;
            font-size: 0.95rem;
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
    <div class="curriculum-docx">
        @foreach ($curriculums as $record)
            @php
                // Get group details (grade)
                $group = Group::where('id', $record->grade_level)
                    ->orWhere('code', $record->grade_level)
                    ->select('name','code')
                    ->first();

                $groupName = $group ? "{$group->name} - {$group->code}" : $record->grade_level;

                // Reverse day order if needed
                $allDays = collect($record->subjects ?? [])
                    ->pluck('days')
                    ->flatten(1)
                    ->pluck('day')
                    ->unique()
                    ->sort()
                    ->values();
            @endphp

            {{-- Header --}}
            <header class="curriculum-header">
                <table class="header-table">
                    <tr>
                        <td>مديرية التربية والتعليم لولاية {{ $province }}</td>
                        <td>الموسم الدراسي: {{ now()->year - 1 }}/{{ now()->year }}</td>
                    </tr>
                    <tr>
                        <td>مفتشية التربية والتعليم لمقاطعة {{ $district }}</td>
                        <td>الصف: {{ $groupName }}</td>
                    </tr>
                    <tr>
                        <td>ابتدائية: {{ $schoolName }}</td>
                        <td>الأستاذ: {{ $record->user?->name ?? '-' }}</td>
                    </tr>
                </table>
            </header>

            {{-- Curriculum Table --}}
            <div class="table-container">
                <table class="curriculum-table">
                    <thead>
                        <tr>
                            <th>الأيّام</th>
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
                        <td>الأستاذ</td>
                        <td>السيد المدير</td>
                        <td>السيد المفتش</td>
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
