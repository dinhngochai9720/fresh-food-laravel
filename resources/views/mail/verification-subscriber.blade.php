<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận email</title>
</head>

<body>
    <p>Click để xác nhận email đăng ký của bạn!</p>
    <a href="{{ route('newsletter.verify', $subscriber->verified_token) }}">Xác nhận</a>
</body>

</html>
