<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Expenses Tracker</title>
</head>
<body>
    <div>
        <h1>Expenses Tracker</h1>
        
        @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <h2>Register (Daftar Akun)</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <label>Email:</label><br>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                </div>
                <div>
                    <label>Password:</label><br>
                    <input type="password" name="password" placeholder="Minimum 8 characters" required>
                </div>
                <div>
                    <label>Confirm Password:</label><br>
                    <input type="password" name="password_confirmation" placeholder="Confirm your password" required>
                </div>
                <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px;">
                    Register
                </button>
            </form>
        </div>

        <div>
            <h2>Login (Masuk)</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label>Email:</label><br>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                </div>
                <div>
                    <label>Password:</label><br>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px;">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>