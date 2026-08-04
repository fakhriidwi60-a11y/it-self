<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IT Self Service Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body {
            background: linear-gradient(135deg, #0C2C6C 0%, #1E4FA3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(12, 44, 108, 0.35);
            padding: 50px 40px;
            width: 100%;
            max-width: 450px;
        }
        .logo { text-align: center; margin-bottom: 30px; }
        .logo img { max-width: 80px; margin-bottom: 12px; }
        .logo h1 { color: #0C2C6C; font-size: 26px; font-weight: 700; }
        .logo p { color: #6B7A90; font-size: 14px; margin-top: 5px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: #333; font-weight: 500; margin-bottom: 8px; font-size: 14px; }
        .form-group input {
            width: 100%; padding: 12px 15px; border: 2px solid #E1E9F2;
            border-radius: 10px; font-size: 14px; transition: border-color 0.3s;
        }
        .form-group input:focus { outline: none; border-color: #1E4FA3; }
        .form-group input::placeholder { color: #AAAAAA; }
        .btn-login {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #1E4FA3 0%, #0C2C6C 100%);
            color: white; border: none; border-radius: 10px; font-size: 16px;
            font-weight: 600; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(30, 79, 163, 0.35); }
        .register-link { text-align: center; margin-top: 25px; font-size: 14px; color: #6B7A90; }
        .register-link a { color: #1E4FA3; text-decoration: none; font-weight: 600; }
        .register-link a:hover { text-decoration: underline; }
        .alert { padding: 12px 15px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; }
        .alert-error { background: #FDE9EC; color: #E4002B; border: 1px solid #E4002B; }
        .alert-success { background: #E6F7F2; color: #00A881; border: 1px solid #00A881; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('assets/img/logo.webp') }}" alt="Logo">
            <h1>IT Self Service Portal</h1>
            <p>Masuk untuk melanjutkan</p>
        </div>

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password Anda" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>
    </div>
</body>
</html>
