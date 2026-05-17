<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Istana Qurban</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f6fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: screen;
            /* Fallback */
            min-height: 100vh;
            padding: 20px;
        }

        .login-card {
            background: #fff;
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-top: 8px solid #1e4d2b;
            /* Hijau gelap khas dashboard */
            text-align: center;
        }

        .login-card h1 {
            color: #1e4d2b;
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-card p.subtitle {
            color: #777;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* --- ALERT ERROR --- */
        .alert-error {
            background: #fff5f5;
            color: #c53030;
            padding: 12px;
            border-radius: 6px;
            border-left: 4px solid #f56565;
            margin-bottom: 20px;
            font-size: 13px;
            text-align: left;
            font-weight: bold;
        }

        /* --- FORM STYLING --- */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #444;
            margin-bottom: 8px;
            margin-left: 2px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4c9b77;
            box-shadow: 0 0 0 3px rgba(76, 155, 119, 0.2);
        }

        .error-text {
            color: #e53e3e;
            font-size: 11px;
            margin-top: 5px;
            font-weight: bold;
        }

        /* --- BUTTON --- */
        .btn-login {
            width: 100%;
            background-color: #4c9b77;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #1e4d2b;
        }

        /* --- FOOTER --- */
        .login-footer {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 13px;
            color: #666;
        }

        .login-footer a {
            color: #4c9b77;
            text-decoration: none;
            font-weight: bold;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h1>Istana Qurban</h1>
        <p class="subtitle">Silakan masuk ke akun Anda</p>

        {{-- Alert Error --}}
        @if (session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" name="email" id="inputEmail" placeholder="nama@gmail.com"
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" id="inputPassword" placeholder="Masukkan password" required>
                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        {{-- <div class="login-footer">
        Belum punya akun? <a href="/register">Daftar di sini</a>
    </div> --}}
    </div>

</body>

</html>
