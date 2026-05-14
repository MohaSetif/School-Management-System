{{-- resources/views/filament/infolists/curriculum-subjects-table.blade.php --}}

<style>
    .curriculum-container {
        width: 100%;
    }

    .curriculum-table-wrap {
        overflow: hidden;
        border-radius: 22px;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        box-shadow:
            0 1px 3px rgba(0, 0, 0, .04),
            0 10px 30px rgba(99, 102, 241, .06);
    }

    .dark .curriculum-table-wrap {
        background: #18181b;
        border-color: #27272a;
        box-shadow: none;
    }

    .curriculum-table-scroll {
        overflow-x: auto;
    }

    .curriculum-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .curriculum-table thead th {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        color: white;
        padding: 1rem 1.25rem;
        text-align: left;
        font-size: .78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        white-space: nowrap;
    }

    .curriculum-table tbody tr {
        transition: .2s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .dark .curriculum-table tbody tr {
        border-color: #27272a;
    }

    .curriculum-table tbody tr:hover {
        background: #f8faff;
    }

    .dark .curriculum-table tbody tr:hover {
        background: #1f1f23;
    }

    .curriculum-table td {
        padding: 1.2rem;
        vertical-align: top;
    }

    /* SUBJECT COLUMN */
    .subject-cell {
        min-width: 220px;
        background: #fafbff;
        border-right: 1px solid #e0e7ff;
    }

    .dark .subject-cell {
        background: #18181b;
        border-color: #312e81;
    }

    .subject-name {
        display: flex;
        align-items: center;
        gap: .75rem;
        font-weight: 700;
        color: #4338ca;
        font-size: .96rem;
    }

    .dark .subject-name {
        color: #a5b4fc;
    }

    .subject-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e0e7ff;
        color: #4f46e5;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .dark .subject-icon {
        background: #312e81;
        color: #c7d2fe;
    }

    /* DAY BADGE */
    .day-badge {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .45rem .8rem;
        border-radius: 999px;
        background: #eef2ff;
        color: #4338ca;
        font-size: .82rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .dark .day-badge {
        background: #312e81;
        color: #c7d2fe;
    }

    /* TOPICS */
    .topics-wrapper {
        display: flex;
        flex-direction: column;
        gap: .85rem;
    }

    .topic-card {
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: .9rem 1rem;
        background: #ffffff;
    }

    .dark .topic-card {
        background: #18181b;
        border-color: #3f3f46;
    }

    .topic-title {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: .65rem;
    }

    .dark .topic-title {
        color: #fafafa;
    }

    .topic-dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: #6366f1;
        flex-shrink: 0;
    }

    .bullet-list {
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: .45rem;
    }

    .bullet-list li {
        display: flex;
        align-items: flex-start;
        gap: .65rem;
        font-size: .9rem;
        color: #6b7280;
        line-height: 1.5;
    }

    .dark .bullet-list li {
        color: #a1a1aa;
    }

    .bullet-list li::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 999px;
        background: #6366f1;
        margin-top: .45rem;
        flex-shrink: 0;
    }

    .curriculum-empty {
        padding: 4rem 2rem;
        text-align: center;
        color: #9ca3af;
    }

    @media (max-width: 768px) {

        .curriculum-table {
            min-width: unset;
        }

        .curriculum-table thead {
            display: none;
        }

        .curriculum-table,
        .curriculum-table tbody,
        .curriculum-table tr,
        .curriculum-table td {
            display: block;
            width: 100%;
        }

        .curriculum-table tbody tr {
            margin: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            overflow: hidden;
            background: white;
        }

        .dark .curriculum-table tbody tr {
            border-color: #3f3f46;
            background: #18181b;
        }

        .curriculum-table td {
            border: none;
            padding: 1rem;
        }

        .subject-cell {
            border-right: none;
            border-bottom: 1px solid #e5e7eb;
        }

        .dark .subject-cell {
            border-color: #3f3f46;
        }

        .mobile-label {
            display: block;
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 700;
            color: #9ca3af;
            margin-bottom: .45rem;
        }
    }

    @media (min-width: 769px) {
        .mobile-label {
            display: none;
        }
    }
</style>

@php
    use App\Models\Subject;

    $subjects = collect($getRecord()->subjects ?? []);
@endphp

<div class="curriculum-container">

    @if($subjects->isEmpty())

        <div class="curriculum-table-wrap">
            <div class="curriculum-empty">
                {{ __('curriculum.infolist.no_subjects') }}
            </div>
        </div>

    @else

        <div class="curriculum-table-wrap">
            <div class="curriculum-table-scroll">

                <table class="curriculum-table">

                    <thead>
                        <tr>
                            <th>{{ __('curriculum.infolist.subject_name') }}</th>
                            <th>{{ __('curriculum.infolist.day') }}</th>
                            <th>{{ __('curriculum.infolist.topics') }}</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($subjects as $subject)

                            @php
                                $subject = is_array($subject)
                                    ? (object) $subject
                                    : $subject;

                                $subjectName = '—';

                                if (!empty($subject->name)) {
                                    $subjectName = $subject->name;
                                } elseif (!empty($subject->subject_id)) {
                                    $resolvedSubject = Subject::find($subject->subject_id);

                                    $subjectName = $resolvedSubject?->name ?? '—';
                                } elseif (!empty($subject->id)) {
                                    $resolvedSubject = Subject::find($subject->id);

                                    $subjectName = $resolvedSubject?->name ?? '—';
                                }

                                $days = collect($subject->days ?? []);
                            @endphp

                            @if($days->isEmpty())

                                <tr>

                                    <td class="subject-cell">

                                        <span class="mobile-label">
                                            {{ __('curriculum.infolist.subject_name') }}
                                        </span>

                                        <div class="subject-name">
                                            <div class="subject-icon">📘</div>
                                            {{ $subjectName }}
                                        </div>

                                    </td>

                                    <td>
                                        <span class="mobile-label">
                                            {{ __('curriculum.infolist.day') }}
                                        </span>

                                        —
                                    </td>

                                    <td>
                                        <span class="mobile-label">
                                            {{ __('curriculum.infolist.topics') }}
                                        </span>

                                        —
                                    </td>

                                </tr>

                            @else

                                @foreach($days as $dayIndex => $day)

                                    @php
                                        $day = is_array($day)
                                            ? (object) $day
                                            : $day;

                                        $topics = collect($day->topics ?? []);
                                    @endphp

                                    <tr>

                                        @if($dayIndex === 0)

                                            <td class="subject-cell" rowspan="{{ $days->count() }}">

                                                <span class="mobile-label">
                                                    {{ __('curriculum.infolist.subject_name') }}
                                                </span>

                                                <div class="subject-name">
                                                    <div class="subject-icon">📘</div>
                                                    {{ $subjectName }}
                                                </div>

                                            </td>

                                        @endif

                                        <td>

                                            <span class="mobile-label">
                                                {{ __('curriculum.infolist.day') }}
                                            </span>

                                            <span class="day-badge">
                                                {{ $day->day ?? '—' }}
                                            </span>

                                        </td>

                                        <td>

                                            <span class="mobile-label">
                                                {{ __('curriculum.infolist.topics') }}
                                            </span>

                                            <div class="topics-wrapper">

                                                @forelse($topics as $topic)

                                                    @php
                                                        $topic = is_array($topic)
                                                            ? (object) $topic
                                                            : $topic;

                                                        $bullets = collect($topic->bullets ?? []);
                                                    @endphp

                                                    <div class="topic-card">

                                                        <div class="topic-title">
                                                            <span class="topic-dot"></span>
                                                            {{ $topic->title ?? '—' }}
                                                        </div>

                                                        @if($bullets->isNotEmpty())

                                                            <ul class="bullet-list">

                                                                @foreach($bullets as $bullet)

                                                                    @php
                                                                        $bullet = is_array($bullet)
                                                                            ? (object) $bullet
                                                                            : $bullet;
                                                                    @endphp

                                                                    <li>
                                                                        {{ $bullet->point ?? '—' }}
                                                                    </li>

                                                                @endforeach

                                                            </ul>

                                                        @endif

                                                    </div>

                                                @empty

                                                    <span style="color:#9ca3af">
                                                        —
                                                    </span>

                                                @endforelse
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>