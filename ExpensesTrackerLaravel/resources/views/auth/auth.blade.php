<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Expenses Tracker</title>
    @vite(['resources/css/auth.css'])
</head>
<body class="auth-container">
    
    <!-- Success Error Messages -->
    @if(session('success'))
        <div class="auth-alert auth-alert-logout auth-slide-up">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <svg class="auth-icon text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-green-800">{{ session('success') }}</p>
                    <p class="text-xs text-green-600 mt-1">Silakan login kembali untuk mengakses dashboard</p>
                </div>
                <button onclick="this.parentElement.parentElement.style.display='none'" class="text-green-600 hover:text-green-800 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="auth-alert auth-alert-error auth-shake">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg class="auth-icon text-red-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-red-800 mb-1">Terjadi kesalahan:</p>
                    <ul class="list-none space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm text-red-700">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.parentElement.parentElement.style.display='none'" class="text-red-600 hover:text-red-800 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif
    <!-- Main Auth Container -->
    <div class="auth-card auth-card-large auth-bounce-in">
        <!-- Header -->
        <div class="auth-header">
            <div class="auth-logo auth-float">
                <svg class="auth-icon-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h1 class="auth-projector-title">Expenses Tracker</h1>
            <p class="auth-projector-subtitle">Welcome! Choose your action below</p>
        </div>

        <!-- Toggle Buttons -->
        <div class="flex mb-8 bg-slate-100 rounded-xl p-1">
            <button onclick="showLogin()" id="loginTab" class="flex-1 py-3 px-4 rounded-lg font-semibold text-sm transition-all duration-300 text-slate-600">
                Login
            </button>
            <button onclick="showRegister()" id="registerTab" class="flex-1 py-3 px-4 rounded-lg font-semibold text-sm transition-all duration-300 bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg">
                Register
            </button>
        </div>

        <!-- Register Form -->
        <div id="registerForm" class="auth-form auth-slide-up">
            <form method="POST" action="{{ route('register') }}" class="auth-space-y-4">
                @csrf
                <div class="auth-form-group">
                    <label class="auth-label auth-projector-text">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required 
                           class="auth-input auth-projector-input auth-focus-ring-blue">
                </div>
                
                <div class="auth-form-group">
                    <label class="auth-label auth-projector-text">Password</label>
                    <div class="auth-password-wrapper">
                        <input type="password" name="password" placeholder="Minimum 8 characters" required 
                               class="auth-input auth-projector-input auth-focus-ring-blue">
                        <button type="button" class="auth-password-toggle" onclick="togglePassword('password')">
                            <svg class="auth-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="auth-form-group">
                    <label class="auth-label auth-projector-text">Confirm Password</label>
                    <div class="auth-password-wrapper">
                        <input type="password" name="password_confirmation" placeholder="Confirm your password" required 
                               class="auth-input auth-projector-input auth-focus-ring-blue">
                        <button type="button" class="auth-password-toggle" onclick="togglePassword('password_confirmation')">
                            <svg class="auth-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="auth-btn auth-btn-primary auth-projector-btn">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="auth-icon-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Create Account</span>
                    </span>
                </button>
            </form>
        </div>

        <!-- Login Form -->
        <div id="loginForm" class="auth-form auth-slide-up hidden">
            <form method="POST" action="{{ route('login') }}" class="auth-space-y-4">
                @csrf
                <div class="auth-form-group">
                    <label class="auth-label auth-projector-text">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required 
                           class="auth-input auth-projector-input auth-focus-ring-blue">
                </div>
                
                <div class="auth-form-group">
                    <label class="auth-label auth-projector-text">Password</label>
                    <div class="auth-password-wrapper">
                        <input type="password" name="password" placeholder="Enter your password" required 
                               class="auth-input auth-projector-input auth-focus-ring-blue">
                        <button type="button" class="auth-password-toggle" onclick="togglePassword('password')">
                            <svg class="auth-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me Checkbox -->
                <div class="auth-checkbox-group">
                    <div class="auth-checkbox-wrapper">
                        <input type="checkbox" name="remember" id="remember" class="auth-checkbox">
                        <label for="remember" class="auth-checkbox-label auth-projector-text">Remember me</label>
                    </div>
                </div>
                
                <button type="submit" class="auth-btn auth-btn-primary auth-projector-btn">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="auth-icon-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Sign In</span>
                    </span>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="auth-footer">
            <p class="auth-footer-text auth-projector-text">
                Secure and modern expense tracking system
            </p>
        </div>
    </div>

    <script>
        function showLogin() {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('loginTab').classList.add('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white', 'shadow-lg');
            document.getElementById('loginTab').classList.remove('text-slate-600');
            document.getElementById('registerTab').classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white', 'shadow-lg');
            document.getElementById('registerTab').classList.add('text-slate-600');
        }

        function showRegister() {
            document.getElementById('registerForm').classList.remove('hidden');
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerTab').classList.add('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white', 'shadow-lg');
            document.getElementById('registerTab').classList.remove('text-slate-600');
            document.getElementById('loginTab').classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white', 'shadow-lg');
            document.getElementById('loginTab').classList.add('text-slate-600');
        }

        function togglePassword(inputName) {
            const input = document.querySelector(`input[name="${inputName}"]`);
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }

        // Initialize with register form active
        document.addEventListener('DOMContentLoaded', function() {
            showRegister();
        });
    </script>
</body>
</html>