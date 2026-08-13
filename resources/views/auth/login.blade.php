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
        :root {
            --primary: #1E4FA3;
            --primary-dark: #0C2C6C;
            --accent: #4FC3F7;
            --gray: #6B7A90;
            --light: #F4F8FC;
            --success: #00A881;
            --danger: #E4002B;
            --border: rgba(255, 255, 255, 0.22);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(-45deg, #050b1f, #0C2C6C, #1E4FA3, #050b1f);
            background-size: 400% 400%;
            animation: meshMove 18s ease infinite;
            position: relative;
            overflow: hidden;
        }
        @keyframes meshMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 15% 30%, rgba(79, 195, 247, 0.25) 0%, transparent 45%),
                radial-gradient(circle at 85% 70%, rgba(30, 79, 163, 0.35) 0%, transparent 50%),
                radial-gradient(circle at 50% 90%, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
            pointer-events: none;
        }
        .login-card {
            width: 100%;
            max-width: 440px;
            padding: 46px 40px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 28px 80px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255,255,255,0.15);
            position: relative;
            z-index: 1;
            animation: fadeIn 0.7s ease-out;
            color: #fff;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .brand { text-align: center; margin-bottom: 34px; }
        .logo-wrap {
            width: 96px;
            height: 96px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #fff;
            padding: 6px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-wrap img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
        .brand h1 { font-size: 24px; font-weight: 700; margin-bottom: 6px; }
        .brand p { font-size: 14px; opacity: 0.75; }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            opacity: 0.9;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.65);
            font-size: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 14px;
            font-size: 14px;
            color: #fff;
            background: rgba(0, 0, 0, 0.18);
            transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
        }
        .form-group input:focus {
            outline: none;
            border-color: rgba(79, 195, 247, 0.8);
            background: rgba(0, 0, 0, 0.28);
            box-shadow: 0 0 0 4px rgba(79, 195, 247, 0.15);
        }
        .form-group input::placeholder { color: rgba(255, 255, 255, 0.45); }
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.65);
            cursor: pointer;
            font-size: 14px;
            background: none;
            border: none;
            padding: 0;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: #fff; }
        .form-extras {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
            font-size: 13px;
        }
        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.9);
            cursor: pointer;
            user-select: none;
        }
        .remember input {
            accent-color: var(--accent);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #4FC3F7 0%, #1E4FA3 100%);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
            box-shadow: 0 10px 24px rgba(30, 79, 163, 0.4);
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(30, 79, 163, 0.5); }
        .btn-login:active { transform: translateY(0); }
        .register-link {
            text-align: center;
            margin-top: 26px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
        }
        .register-link a { color: #4FC3F7; text-decoration: none; font-weight: 600; }
        .register-link a:hover { text-decoration: underline; }
        .alert {
            padding: 13px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-error { background: rgba(228, 0, 43, 0.12); color: #ffb3bf; border: 1px solid rgba(228, 0, 43, 0.5); }
        .alert-success { background: rgba(0, 168, 129, 0.12); color: #9df3d8; border: 1px solid rgba(0, 168, 129, 0.5); }
        .field-error {
            color: #ffb3bf;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }
        @media (max-width: 480px) {
            .login-card { padding: 38px 24px; border-radius: 24px; }
            .brand h1 { font-size: 22px; }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand">
            <div class="logo-wrap">
                <img src="{{ asset('assets/img/logo.webp') }}" alt="Logo IT Self Service Portal">
            </div>
            <h1>IT Self Service Portal</h1>
            <p>Masuk untuk melanjutkan</p>
        </div>

        @if (session('error'))
            <div class="alert alert-error">
                <i class="fas fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required autofocus>
                </div>
                @error('email')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                    <button type="button" class="toggle-password" aria-label="Tampilkan password">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-extras">
                <label class="remember">
                    <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const toggleBtn = document.querySelector('.toggle-password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', () => {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                toggleIcon.classList.toggle('fa-eye', !isPassword);
                toggleIcon.classList.toggle('fa-eye-slash', isPassword);
                toggleBtn.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
            });
        }
    </script>
</body>
</html>
