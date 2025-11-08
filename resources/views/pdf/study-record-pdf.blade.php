<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>سجل رقم {{ $record->id }}</title>
    <style>
        body {
            direction: rtl;
            text-align: right;
            background-color: #f8f9fa;
            color: #333;
            margin: 40px auto;
            max-width: 800px;
            line-height: 1.8;
        }

        h1 {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 30px;
            font-size: 26px;
            letter-spacing: 1px;
        }

        .record-info {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        .record-info p {
            margin: 8px 0;
            font-size: 16px;
        }

        .record-info span {
            font-weight: bold;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
            font-size: 15px;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: normal;
        }

        tr:nth-child(even) {
            background-color: #f2f7fb;
        }

        tr:hover {
            background-color: #e9f3ff;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>سجل رقم {{ $record->id }}</h1>

    <div class="record-info">
        <p><span>النشاط:</span> {{ $record->activity }}</p>
        <p><span>المجال:</span> {{ $record->field }}</p>
        <p><span>المعلم:</span> {{ $record->teacher->user->name ?? '-' }}</p>
        <p><span>المادة:</span> {{ $record->subject->name ?? '-' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>التاريخ</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $record->created_at->format('Y-m-d') }}</td>
                <td>{{ $record->status }}</td>
            </tr>
        </tbody>
    </table>

    <footer>
        <p>تم إنشاء هذا السجل تلقائياً بواسطة النظام</p>
    </footer>
</body>
</html>
