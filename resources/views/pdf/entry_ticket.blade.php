<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>تذكرة تأخير/غياب</title>

    <style>
        :root{
            --ticket-width-mm: 80mm; /* عرض التذكرة للطباعة */
            --ticket-padding: 8px;
            --border-color: #222;
            --accent: #1f2937;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: ArabicUI, "Segoe UI", Tahoma, "Noto Naskh Arabic", "Arial", sans-serif;
            -webkit-print-color-adjust: exact;
            color: #111827;
            background: #fff;
        }

        /* حاوية التذكرة */
        .ticket {
            width: var(--ticket-width-mm);
            padding: var(--ticket-padding);
            border: 1px dashed var(--border-color);
            border-radius: 6px;
            box-sizing: border-box;
            margin: 10px auto;
            direction: rtl;
            text-align: right;
            font-size: 12px;
            line-height: 1.2;
        }

        /* رأس التذكرة */
        .ticket .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }
        .school-name {
            font-weight: 700;
            font-size: 14px;
        }
        .ticket-type {
            font-weight: 600;
            background: var(--accent);
            color: #fff;
            padding: 4px 6px;
            border-radius: 4px;
            font-size: 11px;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 6px 0;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 6px;
            margin: 3px 0;
        }
        .label {
            font-weight: 600;
            color: #374151;
            font-size: 11px;
        }
        .value {
            flex: 1;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: #111827;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        /* سبب الحضور المتأخر / الغياب */
        .reason {
            margin-top: 6px;
            padding: 6px;
            border-radius: 4px;
            background: #f3f4f6;
            font-size: 12px;
            min-height: 32px;
            box-sizing: border-box;
            word-break: break-word;
            text-align: right;
        }

        /* توقيع المسؤول */
        .footer {
            margin-top: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            font-size: 11px;
        }
        .sig {
            border-top: 1px solid #d1d5db;
            padding-top: 4px;
            width: 48%;
            text-align: center;
        }
        .meta {
            font-size: 10px;
            color: #6b7280;
            text-align: left;
            width: 48%;
        }

        /* رقعة صغيرة تحتوي رقم التذكرة وباركود (إن وُجد) */
        .meta-top {
            display:flex;
            justify-content: space-between;
            align-items: center;
            gap:6px;
            margin-bottom:4px;
        }
        .ticket-id {
            font-size: 10px;
            color: #6b7280;
        }

        /* تأكد من أن الطباعة تُلائم العرض المحدد */
        @media print {
            @page {
                size: var(--ticket-width-mm) auto;
                margin: 4mm;
            }
            body { background: none; }
            .ticket { border: 1px dashed #000; box-shadow: none; margin: 0; }
        }

        /* تحسين لعرض على الشاشة (اختياري) */
        .preview {
            display: flex;
            justify-content: center;
            padding: 12px;
            background: #f8fafc;
        }
    </style>
</head>
<body>

<div class="preview">
    <div class="ticket" role="document" aria-label="تذكرة حضور/غياب">
        <div class="header">
            <div>
                <div class="school-name">{{ $ticket->school_name ?? 'المدرسة' }}</div>
                <div style="font-size:11px;color:#6b7280;">{{ $ticket->department ?? '' }}</div>
            </div>

            <div class="ticket-type">{{ $ticket->type_label ?? 'تأخير / غياب' }}</div>
        </div>

        <div class="meta-top">
            <div class="ticket-id">رقم التذكرة: {{ $ticket->id ?? '—' }}</div>
            <div style="font-size:11px;color:#6b7280;">{{ $ticket->date ?? date('Y-m-d') }} — {{ $ticket->time ?? date('H:i') }}</div>
        </div>

        <div class="divider"></div>

        <div class="row">
            <div class="label">اسم الطالب</div>
            <div class="value">{{ $ticket->student_name ?? '—' }}</div>
        </div>

        <div class="row">
            <div class="label">الصف / المجموعة</div>
            <div class="value">{{ $ticket->group_name ?? '—' }}</div>
        </div>

        <div class="row">
            <div class="label">المادة (إن وجدت)</div>
            <div class="value">{{ $ticket->subject_name ?? '—' }}</div>
        </div>

        <div class="row">
            <div class="label">وضع الحضور</div>
            <div class="value">{{ $ticket->status_label ?? 'متأخر' }}</div>
        </div>

        <div class="reason" aria-label="سبب">
            <strong style="font-weight:600;">السبب:</strong>
            <div style="margin-top:4px;">{{ $ticket->reason ?? '—' }}</div>
        </div>

        <div class="footer">
            <div class="sig">
                توقيع المعلم
            </div>
            <div class="meta">
                <div>مرسل بواسطة: {{ $ticket->issued_by ?? auth()->user()->name ?? '—' }}</div>
                <div style="margin-top:4px;">طُبِع بتاريخ: {{ $ticket->printed_at ?? now()->format('Y-m-d H:i') }}</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
