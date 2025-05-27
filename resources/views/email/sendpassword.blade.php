<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>بيانات الدخول</title>
    <style>
        body {
            font-family: 'Tajawal', Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            direction: rtl;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: inline-block;
            max-width: 500px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #3490dc;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>مرحبًا {{ $user->name }} 👋</h2>

        <p>تم إنشاء حسابك بنجاح!</p>

        <p><strong>كلمة المرور الخاصة بك:12334567</strong></p>
        {{-- <h3>{{ $password }}</h3> --}}

        <p>ننصحك بتغيير كلمة المرور عند تسجيل الدخول لأول مرة.</p>

        <a href="{{ url('/') }}" class="btn">تسجيل الدخول</a>

        <div class="footer">
            جميع الحقوق محفوظة &copy; {{ date('Y') }}
        </div>
    </div>

</body>
</html>
