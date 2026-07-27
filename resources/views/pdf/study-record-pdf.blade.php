<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">

<style>
    @page {
        margin: 18mm;
    }

    body {
        font-family: "Cairo", "DejaVu Sans", sans-serif;
        direction: rtl;
        color: #222;
        font-size: 13px;
        line-height: 1.6;
    }

    *{
        box-sizing:border-box;
    }

    .header{
        border-bottom:3px solid #1f4e79;
        padding-bottom:12px;
        margin-bottom:20px;
    }

    .title{
        font-size:24px;
        font-weight:bold;
        color:#1f4e79;
        margin:0;
    }

    .subtitle{
        color:#666;
        margin-top:4px;
        font-size:12px;
    }

    .info-table{
        width:100%;
        border-collapse:collapse;
        margin-bottom:20px;
    }

    .info-table td{
        border:1px solid #d9d9d9;
        padding:10px;
        vertical-align:top;
    }

    .label{
        width:18%;
        font-weight:bold;
        color:#1f4e79;
        background:#f4f7fb;
    }

    .value{
        width:32%;
    }

    table.data{
        width:100%;
        border-collapse:collapse;
        margin-top:15px;
    }

    table.data th{
        background:#1f4e79;
        color:white;
        font-weight:bold;
        padding:10px;
        border:1px solid #1f4e79;
        font-size:13px;
    }

    table.data td{
        border:1px solid #d9d9d9;
        padding:10px;
        text-align:center;
        font-size:13px;
    }

    .section-title{
        font-size:16px;
        font-weight:bold;
        color:#1f4e79;
        margin:18px 0 10px;
        border-right:4px solid #1f4e79;
        padding-right:8px;
    }

    .footer{
        margin-top:35px;
        border-top:1px solid #ccc;
        padding-top:10px;
        font-size:11px;
        color:#777;
        text-align:center;
    }

    .status{
        font-weight:bold;
    }

</style>
</head>

<body>

<div class="header">
    <div class="title">
        {{ __('pdf.study_record.title') }}
    </div>

    <div class="subtitle">
        {{ __('pdf.study_record.record_number') }}: {{ $record->id }}
    </div>
</div>


<table class="info-table">

<tr>
    <td class="label">{{ __('pdf.study_record.activity') }}</td>
    <td class="value">{{ $record->activity }}</td>

    <td class="label">{{ __('pdf.study_record.field') }}</td>
    <td class="value">{{ $record->field }}</td>
</tr>

<tr>
    <td class="label">{{ __('pdf.study_record.teacher') }}</td>
    <td class="value">{{ $record->teacher->user->name ?? '-' }}</td>

    <td class="label">{{ __('pdf.study_record.subject') }}</td>
    <td class="value">{{ $record->subject->name ?? '-' }}</td>
</tr>

<tr>
    <td class="label">{{ __('pdf.study_record.goal') }}</td>
    <td colspan="3">
        {{ $record->goal ?? '-' }}
    </td>
</tr>

</table>


<div class="section-title">
{{ __('pdf.study_record.details') }}
</div>

<table class="data">

<thead>
<tr>
    <th>{{ __('pdf.study_record.created_at') }}</th>
    <th>{{ __('pdf.study_record.status') }}</th>
</tr>
</thead>

<tbody>

<tr>
    <td>{{ $record->created_at->format('Y-m-d') }}</td>
    <td class="status">{{ $record->status }}</td>
</tr>

</tbody>

</table>


<div class="footer">
{{ __('pdf.study_record.footer') }}<br>
{{ now()->format('Y-m-d H:i') }}
</div>

</body>
</html>