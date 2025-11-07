<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; }
    </style>
</head>
<body>
    <h1>سجل رقم {{ $record->id }}</h1>
    <p>النشاط: {{ $record->activity }}</p>
    <p>المجال: {{ $record->field }}</p>
    <p>المعلم: {{ $record->teacher->user->name ?? '-' }}</p>
    <p>المادة: {{ $record->subject->name ?? '-' }}</p>
    
    <table>
        <tr>
            <th>التاريخ</th>
            <th>الحالة</th>
        </tr>
        <tr>
            <td>{{ $record->created_at->format('Y-m-d') }}</td>
            <td>{{ $record->status }}</td>
        </tr>
    </table>
</body>
</html>