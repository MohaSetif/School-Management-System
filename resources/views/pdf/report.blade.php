<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة المؤطرين</title>
    <style>
        body { 
            font-family: 'Arial', 'DejaVu Sans', sans-serif;
            font-size: 14px;
            line-height: 1.4;
            margin: 30px;
            background-color: #fff;
            direction: rtl;
        }
        
        .header {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .header h3 {
            font-size: 16px;
            font-weight: bold;
            margin: 8px 0;
        }
        
        .header h4 {
            font-size: 14px;
            font-weight: normal;
            margin: 5px 0;
        }
        
        .document-info {
            width: 100%;
            margin: 40px 0;
            position: relative;
        }
        
        .right-info {
            float: right;
            width: 45%;
            text-align: right;
        }
        
        .left-info {
            float: left;
            width: 45%;
            text-align: right;
            direction: ltr;
        }
        
        .right-info p, .left-info p {
            margin: 5px 0;
            font-size: 14px;
        }
        
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
        
        .main-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 60px 0 40px 0;
            clear: both;
        }
        
        .content {
            margin: 20px 0;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .signature-area {
            margin-top: 100px;
            text-align: center;
        }
        
        .signature-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 80px;
        }
        
        .director-name {
            font-size: 14px;
            margin-top: 20px;
        }
        
        @media print {
            body {
                margin: 20px;
            }
            .stamp-placeholder {
                border-color: #000;
                color: #000;
            }
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">
        <h3>الجمهورية الجزائرية الديمقراطية الشعبية</h3>
        <h4>وزارة التربية الوطنية</h4>
    </div>

    <!-- Document Information -->
    <div class="document-info clearfix">
        <div class="right-info">
            <h4>{{ $directorate }}</h4>
            <h4>{{ $institution }}</h4>
            <h4>مقاطعة: {{ $municipality }}</h4>
            <p>{{ $school_name }} - {{ $location }} -</p>
            <p>رقم الإرسال: {{ $ref_number }}</p>
        </div>
        
        <div class="left-info">
            <p>{{ $location }} في: {{ $date }}</p>
            <p>من: {{ $from }}</p>
            <p>:إلى السيد</p>
            <p>{{ $to }}</p>
        </div>
    </div>

    <!-- Main Title -->
    <h2 class="main-title">{{ $subject }}</h2>

    <!-- Supervisors List -->
    <div class="content">
        <div>{!! $content !!}</div>
    </div>

    <!-- Signature Section -->
    <div class="signature-area">
        <p class="signature-title">{{ $signature_title ?? 'السيد المدير' }}</p>
        <p class="director-name">{{ $director_name ?? '' }}</p>
    </div>

</body>
</html>