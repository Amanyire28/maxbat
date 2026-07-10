<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — MaxBat Automobil</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{background:#0a0a0a;font-family:'Barlow',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;}
        .wrap{width:100%;max-width:440px;}
        .logo{text-align:center;margin-bottom:32px;}
        .logo img{height:60px;width:auto;border-radius:8px;margin:0 auto 12px;}
        .logo p{font-family:'Bebas Neue',sans-serif;font-size:13px;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.4);}
        .card{background:#161616;border:1px solid rgba(255,255,255,0.08);border-radius:14px;padding:36px;border-top:3px solid #5BC800;}
        .card h2{font-family:'Bebas Neue',sans-serif;font-size:28px;text-transform:uppercase;letter-spacing:1px;color:#fff;margin-bottom:6px;}
        .card p{font-size:14px;color:rgba(255,255,255,0.4);margin-bottom:28px;}
        .group{margin-bottom:18px;}
        .label{display:block;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,0.5);margin-bottom:7px;}
        .input{width:100%;background:#1e1e1e;border:1px solid rgba(255,255,255,0.10);color:#fff;padding:13px 16px;border-radius:7px;font-size:15px;font-family:'Barlow',sans-serif;transition:border-color 0.2s;}
        .input:focus{outline:none;border-color:#5BC800;box-shadow:0 0 0 3px rgba(91,200,0,0.12);}
        .input::placeholder{color:rgba(255,255,255,0.2);}
        .btn{width:100%;padding:14px;background:#5BC800;color:#000;border:none;border-radius:7px;font-family:'Barlow',sans-serif;font-size:15px;font-weight:700;text-transform:uppercase;letter-spacing:1px;cursor:pointer;transition:background 0.2s;margin-top:8px;}
        .btn:hover{background:#68e000;}
        .error{background:rgba(225,6,0,0.10);border:1px solid rgba(225,6,0,0.2);color:#ff6b6b;padding:10px 14px;border-radius:7px;font-size:13px;margin-bottom:18px;}
        .footer-link{text-align:center;margin-top:20px;font-size:14px;color:rgba(255,255,255,0.4);}
        .footer-link a{color:#5BC800;text-decoration:none;font-weight:600;}
        .input-err{border-color:rgba(225,6,0,0.5)!important;}
        .field-err{font-size:12px;color:#ff6b6b;margin-top:5px;}
    </style>
</head>
<body>
<div class="wrap">
    <div class="logo">
        <img src="{{ asset('storage/maxbat.jpg') }}" alt="MaxBat Automobil">
        <p>Customer Portal</p>
    </div>
    <div class="card">
        <h2>Create Account</h2>
        <p>Join MaxBat to chat directly with our team</p>

        @if($errors->any())
            <div class="error"><i class="fa fa-exclamation-circle"></i> {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="group">
                <label class="label">Full Name *</label>
                <input type="text" name="name" class="input {{ $errors->has('name') ? 'input-err' : '' }}" value="{{ old('name') }}" placeholder="Your full name" required autofocus>
                @error('name')<div class="field-err">{{ $message }}</div>@enderror
            </div>
            <div class="group">
                <label class="label">Email Address *</label>
                <input type="email" name="email" class="input {{ $errors->has('email') ? 'input-err' : '' }}" value="{{ old('email') }}" placeholder="you@example.com" required>
                @error('email')<div class="field-err">{{ $message }}</div>@enderror
            </div>
            <div class="group">
                <label class="label">Password *</label>
                <input type="password" name="password" class="input {{ $errors->has('password') ? 'input-err' : '' }}" placeholder="At least 8 characters" required>
                @error('password')<div class="field-err">{{ $message }}</div>@enderror
            </div>
            <div class="group">
                <label class="label">Confirm Password *</label>
                <input type="password" name="password_confirmation" class="input" placeholder="Repeat your password" required>
            </div>
            <button type="submit" class="btn"><i class="fa fa-user-plus"></i> Create Account</button>
        </form>
    </div>
    <div class="footer-link">Already have an account? <a href="{{ route('login') }}">Sign In</a></div>
</div>
</body>
</html>
