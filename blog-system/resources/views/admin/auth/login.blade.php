<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – BlogYaari</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;700;800&family=Hind:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --saffron: #FF6B00;
            --navy: #0A1931;
            --navy-light: #132645;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Hind', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 50%, #1a3a5c 100%);
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -30%; left: -20%;
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(255,107,0,0.12) 0%, transparent 60%);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: -30%; right: -20%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(255,107,0,0.08) 0%, transparent 60%);
            pointer-events: none;
        }
        .login-box {
            background: white;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            box-shadow: 0 24px 80px rgba(0,0,0,0.4);
            position: relative;
            z-index: 1;
        }
        .login-brand {
            text-align: center;
            margin-bottom: 28px;
        }
        .brand-circle {
            width: 64px; height: 64px;
            background: var(--saffron);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px;
            color: white;
            margin: 0 auto 14px;
            box-shadow: 0 8px 24px rgba(255,107,0,0.35);
        }
        .brand-name {
            font-family: 'Baloo 2', cursive;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--navy);
        }
        .brand-name span { color: var(--saffron); }
        .login-subtitle {
            font-size: 0.85rem;
            color: #888;
            margin-top: 4px;
        }
        .divider {
            height: 1px;
            background: #E8E8E8;
            margin: 20px 0;
        }
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 7px;
            color: var(--navy);
        }
        .input-wrap { position: relative; }
        .input-wrap i {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 0.9rem;
        }
        .form-input {
            width: 100%;
            padding: 11px 14px 11px 40px;
            border: 1.5px solid #E8E8E8;
            border-radius: 10px;
            font-family: 'Hind', sans-serif;
            font-size: 0.92rem;
            outline: none;
            transition: border-color 0.2s;
            color: var(--navy);
        }
        .form-input:focus { border-color: var(--saffron); }
        .toggle-pw {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
            font-size: 0.9rem;
        }
        .toggle-pw:hover { color: var(--saffron); }
        .alert-danger {
            background: rgba(231,76,60,0.1);
            border: 1px solid rgba(231,76,60,0.3);
            color: #e74c3c;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-login {
            width: 100%;
            padding: 13px;
            background: var(--saffron);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: 'Baloo 2', cursive;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover { background: #E55A00; }
        .btn-login:active { transform: scale(0.98); }
        .hint-box {
            margin-top: 20px;
            background: #F0F2F5;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 0.8rem;
            color: #666;
        }
        .hint-box strong { color: var(--navy); }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 16px;
            font-size: 0.85rem;
            color: #888;
            text-decoration: none;
        }
        .back-link:hover { color: var(--saffron); }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="login-brand">
            <div class="brand-circle"><i class="fas fa-newspaper"></i></div>
            <div class="brand-name">Blog<span>Yaari</span></div>
            <div class="login-subtitle"><i class="fas fa-shield-alt"></i> Admin Panel Login</div>
        </div>
        <div class="divider"></div>

        @if($errors->any())
        <div class="alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-input" id="email" name="email" value="{{ old('email') }}" placeholder="admin@blogyaari.com" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-input" id="password" name="password" placeholder="••••••••" required>
                    <span class="toggle-pw" onclick="togglePw()"><i class="fas fa-eye" id="pw-icon"></i></span>
                </div>
            </div>
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login to Admin
            </button>
        </form>

        <div class="hint-box">
            <strong>Demo Credentials:</strong><br>
            Email: <strong>admin@blogyaari.com</strong><br>
            Password: <strong>admin@123</strong>
        </div>

        <a href="{{ route('blog.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Blog
        </a>
    </div>

    <script>
    function togglePw() {
        const input = document.getElementById('password');
        const icon = document.getElementById('pw-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
    </script>
</body>
</html>
