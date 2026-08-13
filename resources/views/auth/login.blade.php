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
            background: #eef3fb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-wrapper {
            display: flex;
            width: 100%;
            max-width: 1020px;
            min-height: 620px;
            background: #fff;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 28px 80px rgba(12, 44, 108, 0.18);
        }
        .auth-brand {
            flex: 1.05;
            background: linear-gradient(-45deg, #0C2C6C, #1E4FA3, #0f5c9e, #0C2C6C);
            background-size: 300% 300%;
            animation: gradientMove 12s ease infinite;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .auth-brand .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(79, 195, 247, 0.12);
            filter: blur(2px);
        }
        .shape-1 { width: 340px; height: 340px; top: -90px; right: -110px; }
        .shape-2 { width: 220px; height: 220px; bottom: -60px; left: -80px; }
        .shape-3 { width: 140px; height: 140px; bottom: 130px; right: 60px; background: rgba(255,255,255,0.06); }
        .brand-icon {
            width: 120px;
            height: 120px;
            border-radius: 28px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 54px;
            margin-bottom: 30px;
            border: 1px solid rgba(255,255,255,0.18);
            position: relative;
            z-index: 1;
        }
        .brand-logo { margin-bottom: 24px; position: relative; z-index: 1; }
        .brand-logo img { width: 100px; border-radius: 50%; border: 4px solid rgba(255,255,255,0.15); }
        .auth-brand h2 { font-size: 30px; font-weight: 700; margin-bottom: 14px; position: relative; z-index: 1; }
        .auth-brand p { font-size: 15px; opacity: 0.88; max-width: 340px; line-height: 1.7; position: relative; z-index: 1; }
        .auth-form {
            flex: 1;
            padding: 60px 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }
        .auth-form-header { margin-bottom: 34px; }
        .auth-form-header h1 { font-size: 28px; color: var(--primary-dark); font-weight: 700; margin-bottom: 10px; }
        .auth-form-header p { color: var(--gray); font-size: 15px; }
        .form-group { margin-bottom: 22px; }
        .form-group label { display: block; color: #333; font-weight: 500; margin-bottom: 8px; font-size: 14px; }
        .input-wrap { position: relative; }
        .input-wrap .input-icon {
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
            transition: border-color 0.25s, box-shadow 0.25s;
            color: #333;
            background: #fff;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(30, 79, 163, 0.08);
        }
        .form-group input::placeholder { color: #aaa; }
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
            font-size: 13px;
        }
        .remember input { accent-color: var(--primary); width: 16px; height: 16px; cursor: pointer; }
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 14px 28px rgba(30, 79, 163, 0.32); }
        .btn-login:active { transform: translateY(0); }
        .register-link { text-align: center; margin-top: 28px; font-size: 14px; color: var(--gray); }
        .register-link a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .register-link a:hover { text-decoration: underline; }
        .alert {
            padding: 13px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
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
        @media (max-width: 900px) {
            .auth-brand { display: none; }
            .auth-form { padding: 45px 30px; }
            .auth-wrapper { min-height: auto; }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-brand">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="brand-logo">
                <img src="{{ asset('assets/img/logo.webp') }}" alt="Logo IT Self Service Portal">
            </div>
            <div class="brand-icon">
                <i class="fas fa-headset"></i>
            </div>
            <h2>IT Self Service Portal</h2>
            <p>Solusi cepat untuk layanan dan permasalahan IT. Masuk untuk mengakses dashboard dan fitur lainnya kapan saja.</p>
        </div>

        <div class="auth-form">
            <div class="auth-form-header">
                <h1>Selamat datang kembali</h1>
                <p>Masukkan kredensial Anda untuk melanjutkan</p>
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
