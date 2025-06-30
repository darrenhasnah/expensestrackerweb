<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Expenses Tracker</title>
    @vite(['resources/css/app.css', 'resources/css/auth.css'])
</head>
<body>
    <div class="auth-container">
        <h1>Expenses Tracker</h1>
        
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($errors->has('login'))
            <div class="error-message">
                {{ $errors->first('login') }}
            </div>
        @endif

        <!-- CONTAINER UNTUK LAYOUT KIRI-KANAN -->
        <div class="auth-forms-container">
            <!-- Register Form - KIRI -->
            <div class="register-section">
                <h2>Register</h2>
                <form method="POST" action="{{ route('register') }}" class="register-form">
                    @csrf
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" placeholder="Minimum 8 characters" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password:</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm your password" required>
                    </div>
                    <x-button type="submit" variant="success">
                        Register
                    </x-button>
                </form>
            </div>

            <!-- Login Form - KANAN -->
            <div class="login-section">
                <h2>Login</h2>
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <x-button type="submit" variant="primary">
                        Login
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>