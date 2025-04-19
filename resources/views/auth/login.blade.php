<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-indigo-200 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Welcome Back 👋</h2>
        <p class="text-center text-sm text-gray-500 mb-6">Please login to your account</p>

        {{-- Session error message --}}
        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" placeholder="you@example.com"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
            </div>
            <div>
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                    Sign In
                </button>
            </div>
        </form>

        <p class="text-sm text-center text-gray-600 mt-6">
            Don’t have an account? 
            <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">Register here</a>
        </p>
    </div>

</body>
</html>
