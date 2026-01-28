<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password - Oasis Hub</title>
    <link rel="shortcut icon" type="image/png" href="assets/images/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .bg-image {
            background: url('{{ asset("assets/images/loginimg.jpg") }}') no-repeat center center/cover;
            position: fixed;
            height: 100%;
            width: 100%;
            top: 0; left: 0;
            z-index: -2;
        }
        .overlay {
            position: fixed;
            height: 100%;
            width: 100%;
            top: 0; left: 0;
            background: rgba(0, 0, 0, 0.65);
            z-index: -1;
        }
        .login-wrapper {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            color: #fff;
            margin: auto;
            box-shadow: 0px 8px 25px rgba(0,0,0,0.5);
        }
        .login-wrapper h2 {
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
            color: #f5f5f5;
        }
        .form-control {
            background: rgba(255,255,255,0.15);
            border: none;
            border-radius: 5px;
            color: #fff;
            height:40px;
        }
        .form-control:focus {
            background: rgba(255,255,255,0.25);
            box-shadow: none;
            color: #fff;
        }
        .btn-login {
            background: linear-gradient(135deg, #007bff, #007bff);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 12px;
            width: 100%;
            color: #fff;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #007bff, #007bff);
            transform: scale(1.03);
        }
        .login-footer {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
        }
        .login-footer a {
            color: #d4af37;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
        /* Responsive */
        @media (max-width: 576px) {
            .login-wrapper {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    @livewire('admin-reset-access')

</body>
</html>
