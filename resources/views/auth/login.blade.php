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
            --border: #E1E9F2;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body {
            background: linear-gradient(-45deg, #0C2C6C, #1E4FA3, #2b7ec9, #0C2C6C);
            background-size: 400% 400%;
            animation: gradientMove 16s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            filter: blur(1px);
        }
        .shape-1 { width: 280px; height: 280px; top: -60px; left: -60px; }
        .shape-2 { width: 360px; height: 360px; bottom: -100px; right: -100px; background: rgba(79, 195, 247, 0.12); }
        .shape-3 { width: 160px; height: 160px; top: 15%; right: 12%; }
        .login-card {
            background: #fff;
            width: 100%;
            max-width: 440px;
            padding: 48px 40px;
            border-radius: 26px;
            box-shadow: 0 24px 70px rgba(12, 44, 108, 0.28);
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .brand img {
            width: 86px;
            height: 86px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 18px;
            box-shadow: 0 8px 24px rgba(30, 79, 163, 0.2);
        }
        .brand h1 {
            font-size: 24px;
            color: var(--primary-dark);
            font-weight: 700;
            margin-bottom: 6px;
        }
        .brand p {
            font-size: 14px;
            color: var(--gray);
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid var(--border);
            border-radius: 14px;
            font-size: 14px;
            color: #333;
            transition: border-color 0.25s, box-shadow 0.25s;
            background: #fff;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(30, 79, 163, 0.08);
        }
        .form-group input::placeholder { color: #b0b7c0; }
        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            cursor: pointer;
            font-size: 14px;
            background: none;
            border: none;
            padding: 0;
            transition: color 0.2s;
        }
        .toggle-password:hover { color: var(--primary); }
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
            color: #333;
            cursor: pointer;
            user-select: none;
        }
        .remember input {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 14px 28px rgba(30, 79, 163, 0.32); }
        .btn-login:active { transform: translateY(0); }
        .register-link {
            text-align: center;
            margin-top: 26px;
            font-size: 14px;
            color: var(--gray);
        }
        .register-link a { color: var(--primary); text-decoration: none; font-weight: 600; }
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
        .alert-error { background: #FDE9EC; color: var(--danger); border: 1px solid var(--danger); }
        .alert-success { background: #E6F7F2; color: var(--success); border: 1px solid var(--success); }
        .field-error {
            color: var(--danger);
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }
        @media (max-width: 480px) {
            .login-card { padding: 38px 24px; border-radius: 22px; }
            .brand h1 { font-size: 22px; }
        }
    </style>
</head>
<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <div class="login-card">
        <div class="brand">
            <img src="{{ asset('assets/img/logo.webp') }}" alt="Logo IT Self Service Portal">
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
