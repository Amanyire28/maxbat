<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — MaxBat Automobil</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{background:#0a0a0a;font-family:'Barlow',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;}
        .login-wrap{width:100%;max-width:420px;}
        .login-logo{text-align:center;margin-bottom:32px;}
        .login-logo img{height:60px;width:auto;border-radius:8px;margin:0 auto 12px;}
        .login-logo p{font-family:'Bebas Neue',sans-serif;font-size:13px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.4);}
        .login-card{background:#161616;border:1px solid rgba(255,255,255,0.08);border-radius:14px;padding:36px;border-top:3px solid #5BC800;}
        .login-card h2{font-family:'Bebas Neue',sans-serif;font-size:26px;font-weight:400;text-transform:uppercase;letter-spacing:1px;color:#fff;margin-bottom:6px;}
        .login-card p{font-size:14px;color:rgba(255,255,255,0.4);margin-bottom:28px;}
        .form-group{margin-bottom:18px;}
        .form-label{display:block;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.5);margin-bottom:7px;}
        .form-input{width:100%;background:#1e1e1e;border:1px solid rgba(255,255,255,0.10);color:#fff;padding:13px 16px;border-radius:7px;font-size:15px;font-family:'Barlow',sans-serif;transition:border-color 0.2s;}
        .form-input:focus{outline:none;border-color:#5BC800;box-shadow:0 0 0 3px rgba(91,200,0,0.12);}
        .form-input::placeholder{color:rgba(255,255,255,0.2);}
        .form-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;}
        .remember{display:flex;align-items:center;gap:8px;font-size:13px;color:rgba(255,255,255,0.5);}
        .remember input{accent-color:#5BC800;}
        .btn-login{width:100%;padding:14px;background:#5BC800;color:#000;border:none;border-radius:7px;font-family:'Barlow',sans-serif;font-size:15px;font-weight:700;text-transform:uppercase;letter-spacing:1px;cursor:pointer;transition:background 0.2s;}
        .btn-login:hover{background:#68e000;}
        .error-msg{background:rgba(225,6,0,0.10);border:1px solid rgba(225,6,0,0.2);color:#ff6b6b;padding:10px 14px;border-radius:7px;font-size:13px;margin-bottom:18px;}
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="login-logo">
        <img src="{{ asset('storage/maxbat.jpg') }}" alt="MaxBat Automobil">
        <p>Admin Panel</p>
    </div>
    <div class="login-card">
        <h2>Welcome Back</h2>
        <p>Sign in to access the admin dashboard</p>

        @if($errors->any())
            <div class="error-msg"><i class="fa fa-exclamation-circle"></i> {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input class="form-input" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@maxbat.com" required autofocus>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input class="form-input" type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            <div class="form-row">
                <label class="remember">
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <button type="submit" class="btn-login"><i class="fa fa-sign-in-alt"></i> Sign In</button>
        </form>
    </div>
</div>
</body>
</html>

