<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Sportal ITN</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <style>
        .login-body {
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-card h2 {
            margin-bottom: 30px;
            color: #004aad;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #004aad;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background-color: #003380;
        }

        .error-msg {
            background-color: #fee;
            color: #d8000c;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body class="login-body">

    <div class="login-card">
        <h2>Admin Login</h2>
        @if ($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn-login">Masuk</button>
        </form>
    </div>

</body>

</html>