<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <title>تذكرة تأخير / غياب</title>
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
            direction: rtl;
        }

        .ticket {
            width: 100%;
            padding: 8px;
            border: 1px dashed #222;
            border-radius: 6px;
        }

        .header {
            margin-bottom: 6px;
            overflow: hidden;
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
            display: inline-block;
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
            <div class="header-flex">
                <div class="header-left">
                    <div class="school-name">
                        {{ $record->school_name ?? 'مدرسة النور الابتدائية' }}
                    </div>
                    <div class="department">
                        {{ $record->department ?? 'قسم التعليم الأساسي' }}
                    </div>
                </div>
                <div class="header-right">
                    <div class="ticket-type">
                        {{ $record->status === 'absent' ? 'تذكرة غياب' : 'تذكرة تأخير' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="meta-top">
            <span class="meta-left">رقم التذكرة: {{ $record->id ?? '—' }}</span>
            <span class="meta-right">{{ optional($record->created_at)->format('Y-m-d — H:i') ?? now()->format('Y-m-d — H:i') }}</span>
        </div>

        <div class="divider"></div>

        <div class="row">
            <div class="label">اسم الطالب</div>
            <div class="value">{{ optional($record->student)->name ?? optional($record->student)->full_name ?? '—' }}</div>
        </div>

        <div class="row">
            <div class="label">الصف / المجموعة</div>
            <div class="value">{{ optional($record->group)->name ?? '—' }}</div>
        </div>

        <div class="row">
            <div class="label">المادة</div>
            <div class="value">{{ optional($record->subject)->name ?? '—' }}</div>
        </div>

        <div class="row">
            <div class="label">وضع الحضور</div>
            <div class="value">
                @switch($record->status)
                    @case('absent') غائب @break
                    @case('late') متأخر @break
                    @case('excused') معذور @break
                    @case('exit_before_time') خروج مبكر @break
                    @default حاضر
                @endswitch
            </div>
        </div>

        <div class="reason">
            <div class="reason-label">السبب:</div>
            <div>{{ $record->reason ?? '—' }}</div>
        </div>

        <div class="footer">
            <div class="sig">
                توقيع المعلم
            </div>
            <div class="meta">
                <div>مرسل بواسطة: {{ optional($record->teacher)->name ?? '—' }}</div>
                <div>طُبِع بتاريخ: {{ now()->format('Y-m-d H:i') }}</div>
            </div>
        </div>
    </div>
</body>
</html>