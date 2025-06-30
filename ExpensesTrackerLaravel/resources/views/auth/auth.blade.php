
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Expenses Tracker</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8 p-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900">Expenses Tracker</h1>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($errors->has('login'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ $errors->first('login') }}
            </div>
        @endif

        <!-- Register Form -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Register (Daftar Akun)</h2>
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" name="password" placeholder="Minimum 8 characters" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm your password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <x-button type="submit" variant="success" class="w-full">
                    Register
                </x-button>
            </form>
        </div>

        <!-- Login Form -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Login (Masuk)</h2>
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" name="password" placeholder="Enter your password" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <x-button type="submit" variant="primary" class="w-full">
                    Login
                </x-button>
            </form>
        </div>
    </div>
</body>
</html>