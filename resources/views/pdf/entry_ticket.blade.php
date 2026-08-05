@php
    $isRtl = app()->getLocale() === 'ar';
    $dir = $isRtl ? 'rtl' : 'ltr';
@endphp

<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ $dir }}">
<head>
    <meta charset="utf-8" />
    <title>{{ __('pdf.entry_ticket.title') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "DejaVu Sans", sans-serif;
            color: #111827;
            font-size: 12px;
            line-height: 1.4;
        }

        html[dir="rtl"] body {
            direction: rtl;
        }

        html[dir="ltr"] body {
            direction: ltr;
        }

        .ticket {
            width: 100%;
            padding: 8px;
            border: 1px dashed #222;
            border-radius: 6px;
        }

        .header {
            text-align: center;
            display: block; /* remove flex layout */
            margin-bottom: 6px;
        }

        .ticket-type.centered {
            margin: 6px auto 0 auto;
            width: fit-content;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-flex {
            width: 100%;
            display: table;
        }

        .header-left {
            display: table-cell;
            width: 65%;
            vertical-align: middle;
        }

        .header-right {
            display: table-cell;
            width: 35%;
            vertical-align: middle;
            text-align: left;
        }

        .school-name {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .department {
            font-size: 11px;
            color: #6b7280;
        }

        .ticket-type {
            font-weight: 600;
            background: #1f2937;
            color: #fff;
            padding: 4px 6px;
            border-radius: 4px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .meta-top {
            margin: 6px 0;
            font-size: 10px;
            color: #6b7280;
            overflow: hidden;
        }

        .meta-left {
            float: right;
        }

        .meta-right {
            float: left;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 6px 0;
            clear: both;
        }

        .row {
            margin: 3px 0;
            overflow: hidden;
        }

        .label {
            font-weight: 600;
            color: #374151;
            font-size: 11px;
            float: right;
            width: 30%;
        }

        .value {
            font-weight: 500;
            font-size: 12px;
            color: #111827;
            float: left;
            width: 68%;
            text-align: left;
        }

        .reason {
            margin-top: 6px;
            padding: 6px;
            border-radius: 4px;
            background: #f3f4f6;
            font-size: 12px;
            min-height: 32px;
            clear: both;
        }

        .reason-label {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .footer {
            margin-top: 8px;
            overflow: hidden;
            font-size: 11px;
        }

        .sig {
            float: right;
            width: 48%;
            border-top: 1px solid #d1d5db;
            padding-top: 4px;
            text-align: center;
        }

        .meta {
            float: left;
            width: 48%;
            font-size: 10px;
            color: #6b7280;
            text-align: left;
        }

        .meta div {
            margin-top: 4px;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="header">
            <div class="school-info">
                <div class="school-name">{{ config('app.name') }}</div>
            </div>
            <div class="ticket-type centered">
                {{ $record->status === 'absent' ? __('pdf.entry_ticket.absent_ticket') : __('pdf.entry_ticket.late_ticket') }}
            </div>
        </div>

        <div class="meta-top">
            <span class="meta-left">{{ __('pdf.entry_ticket.ticket_number') }}: {{ $record->id ?? '—' }}</span>
            <span class="meta-right">{{ optional($record->created_at)->format('Y-m-d — H:i') ?? now()->format('Y-m-d — H:i') }}</span>
        </div>

        <div class="divider"></div>

        <div class="row">
            <div class="label">{{ __('pdf.entry_ticket.student_name') }}</div>
            <div class="value">{{ optional($record->student)->name ?? optional($record->student)->full_name ?? '—' }}</div>
        </div>

        <div class="row">
            <div class="label">{{ __('pdf.entry_ticket.class_group') }}</div>
            <div class="value">
                @php
                    $group = $record->group;

                    $groupName = $group
                        ? __('students.' . $group->name) . ' (' . __('students.fields.group') . " {$group->code})"
                        : '—';
                @endphp

                {{ $groupName }}
            </div>
        </div>

        <div class="row">
            <div class="label">{{ __('pdf.entry_ticket.attendance_status') }}</div>
            <div class="value">
                @switch($record->status)
                    @case('absent') {{ __('pdf.entry_ticket.status.absent') }} @break
                    @case('late') {{ __('pdf.entry_ticket.status.late') }} @break
                    @case('excused') {{ __('pdf.entry_ticket.status.excused') }} @break
                    @case('exit_before_time') {{ __('pdf.entry_ticket.status.early_exit') }} @break
                    @default {{ __('pdf.entry_ticket.status.present') }}
                @endswitch
            </div>
        </div>

        <div class="reason">
            <div class="reason-label">{{ __('pdf.entry_ticket.reason') }}:</div>
            <div>{{ $record->notes ?? '—' }}</div>
        </div>

        <div class="footer">
            <div class="sig">
                {{ __('pdf.entry_ticket.signature') }}
            </div>
            <div class="meta">
                <div>{{ __('pdf.entry_ticket.printed_on') }}: {{ now()->format('Y-m-d H:i') }}</div>
            </div>
        </div>
    </div>
</body>
</html>