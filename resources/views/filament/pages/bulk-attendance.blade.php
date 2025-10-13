<x-filament-panels::page>
    <style>
        :root{
            --bg: #f6f7fb;
            --card: #ffffff;
            --muted: #6b7280;
            --muted-2: #9aa3b2;
            --border: #e6e9ef;
            --primary: #2563eb;
            --primary-600: #1e40af;
            --success: #16a34a;
            --danger: #dc2626;
            --glass: rgba(255,255,255,0.6);
            --radius-lg: 12px;
            --shadow-md: 0 6px 18px rgba(22, 28, 37, 0.06);
        }

        html.dark {
            --bg: #1c1c1cff;
            --card: #161616ff;
            --muted: #acacacff;
            --muted-2: #94a3b8;
            --border: rgba(255,255,255,0.06);
            --glass: rgba(255,255,255,0.03);
        }

        .ba-page {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Form card */
        .ba-form-card {
            background: var(--card);
            border-radius: var(--radius-lg);
            padding: 1.1rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
        }

        /* Layout for inline form controls */
        .ba-form-grid {
            display: grid;
            grid-template-columns: 1fr 240px;
            gap: 0.9rem;
            align-items: end;
        }

        /* Buttons */
        .ba-controls {
            display:flex;
            justify-content:flex-end;
            gap: 0.6rem;
            margin-top: 0.6rem;
        }

        .btn {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:0.5rem;
            padding: 0.5rem 0.85rem;
            border-radius: 8px;
            border: 1px solid transparent;
            font-weight:600;
            cursor: pointer;
            font-size:0.95rem;
            background: transparent;
            color: inherit;
        }

        .btn-primary {
            background: linear-gradient(180deg,var(--primary),var(--primary-600));
            color: #fff;
            border-color: rgba(0,0,0,0.06);
            box-shadow: 0 6px 14px rgba(37,99,235,0.12);
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
        }

        /* Students card */
        .ba-card {
            background: var(--card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .ba-card-header {
            padding: 1rem 1.1rem;
            border-bottom: 1px solid var(--border);
            display:flex;
            justify-content:space-between;
            align-items:baseline;
            gap:1rem;
            background: linear-gradient(180deg, transparent, var(--glass));
        }

        .ba-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: inherit;
        }

        .ba-sub {
            font-size: 0.9rem;
            color: var(--muted);
        }

        /* Table styles */
        .ba-table-wrap {
            width: 100%;
            overflow-x: auto;
            background: transparent;
        }

        table.ba-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 820px;
        }

        table.ba-table thead th {
            text-align: left;
            padding: 0.85rem 1rem;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
            background: transparent;
        }

        table.ba-table tbody td {
            padding: 0.9rem 1rem;
            vertical-align: middle;
            border-bottom: 1px dashed var(--border);
        }

        table.ba-table tbody tr:hover {
            background: rgba(130,130,130,0.03);
        }

        .student-name {
            font-weight: 600;
        }

        .student-id {
            font-size: 0.85rem;
            color: var(--muted-2);
            margin-top: 0.18rem;
        }

        /* Status radios layout */
        .status-group {
            display:flex;
            gap: 0.6rem;
            align-items:center;
        }

        .status-label {
            display:flex;
            align-items:center;
            gap: 0.45rem;
            font-size: 0.9rem;
            cursor:pointer;
        }

        .status-label input[type="radio"]{
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .status-pill {
            font-size: 0.82rem;
            font-weight:600;
            padding: 0.18rem 0.5rem;
            border-radius: 999px;
            display:inline-block;
            color: #fff;
        }

        .pill-present { background: var(--success); }
        .pill-absent  { background: var(--danger); }
        .pill-late    { background: #f59e0b; } /* amber */
        .pill-excused { background: #0ea5b7; } /* teal */
        .pill-exit_before_time { background: #94a3b8; }

        /* Notes input */
        .notes-input {
            width: 100%;
            max-width: 340px;
            padding: 0.5rem 0.7rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            color: inherit;
            font-size: 0.95rem;
        }

        /* footer */
        .ba-card-footer {
            padding: 0.9rem 1rem;
            border-top: 1px solid var(--border);
            display:flex;
            justify-content: flex-end;
        }

        /* Responsive tweaks */
        @media (max-width: 880px) {
            .ba-form-grid { grid-template-columns: 1fr; }
            .notes-input { max-width: 100%; }
        }
    </style>

    <div class="ba-page">
        {{-- Form container --}}
        <section class="ba-form-card" aria-labelledby="ba-form-heading">
            <form wire:submit.prevent="loadStudents">
                <div id="ba-form-heading" style="display:none">{{ __('attendance.load_students_heading') }}</div>

                <div class="ba-form-grid">
                    {{-- Filament form output (group + date) --}}
                    <div>
                        {{ $this->form }}
                    </div>

                    <div style="display:flex; flex-direction:column; gap:0.6rem; align-items:flex-end;">
                        <div style="font-size:0.9rem; color:var(--muted); text-align:right;">
                            {{ __('attendance.load_students_instructions') }}
                        </div>

                        <div class="ba-controls">
                            {{-- ✅ Filament button with loading state --}}
                            <x-filament::button
                                type="submit"
                                color="gray"
                                wire:loading.attr="disabled"
                                wire:target="loadStudents"
                            >
                                <span>{{ __('attendance.load_students') }}</span>
                            </x-filament::button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        {{-- Students table --}}
        @if(!empty($this->students))
            <section class="ba-card" aria-labelledby="ba-students-heading">
                <header class="ba-card-header">
                    <div>
                        <div class="ba-title" id="ba-students-heading">
                            {{ __('attendance.mark_attendance_for_date', ['date' => \Carbon\Carbon::parse($this->attendance_date)->format('F j, Y')]) }}
                        </div>
                        <div class="ba-sub">
                            {{ __('attendance.group_label', ['group' => \App\Models\Group::find($this->group_id)?->name ?? '—']) }}
                            · {{ __('attendance.students_count', ['count' => count($this->students)]) }}
                        </div>
                    </div>

                    {{-- ✅ Filament button with loading state --}}
                    <x-filament::button
                        wire:click="saveAttendance"
                        color="gray"
                        wire:loading.attr="disabled"
                        wire:target="saveAttendance"
                    >
                        <span>{{ __('attendance.save_attendance') }}</span>
                    </x-filament::button>
                </header>

                <div class="ba-table-wrap">
                    <table class="ba-table">
                        <thead>
                            <tr>
                                <th>{{ __('attendance.student') }}</th>
                                <th>{{ __('attendance.status') }}</th>
                                <th>{{ __('attendance.notes') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($this->students as $student)
                                <tr>
                                    <td>
                                        <div class="student-name">{{ $student['name'] }}</div>
                                        <div class="student-id">{{ __('attendance.student_id', ['id' => $student['student_identifier']]) }}</div>
                                    </td>

                                    <td>
                                        <div class="status-group">
                                            @foreach (['present','absent','late','excused', 'exit_before_time'] as $status)
                                                <label class="status-label" for="status_{{ $student['id'] }}_{{ $status }}">
                                                    <input
                                                        id="status_{{ $student['id'] }}_{{ $status }}"
                                                        type="radio"
                                                        name="status_{{ $student['id'] }}"
                                                        value="{{ $status }}"
                                                        {{ $student['status'] === $status ? 'checked' : '' }}
                                                        wire:change="updateAttendance({{ $student['id'] }}, 'status', '{{ $status }}')"
                                                    >
                                                    <span class="status-pill pill-{{ $status }}">{{ __('attendance.status_'.$status) }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </td>

                                    <td>
                                        <input
                                            type="text"
                                            class="notes-input"
                                            placeholder="{{ __('attendance.notes_placeholder') }}"
                                            value="{{ $student['notes'] }}"
                                            wire:change="updateAttendance({{ $student['id'] }}, 'notes', $event.target.value)"
                                        >
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="ba-card-footer">
                    {{-- ✅ Filament button with loading state --}}
                    <x-filament::button
                        wire:click="saveAttendance"
                        color="gray"
                        wire:loading.attr="disabled"
                        wire:target="saveAttendance"
                    >
                        <span>{{ __('attendance.save_attendance') }}</span>
                    </x-filament::button>
                </div>
            </section>
        @endif
    </div>
</x-filament-panels::page>