<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PortfolioBuilder</title>
</head>
<body>

<nav class="bg-white shadow-md border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="/" class="text-xl font-bold text-purple-700 hover:text-purple-900 no-underline">
                    🚀 PortfolioBuilder
                </a>
            </div>

            <!-- Links for Desktop -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('portfolios.index') }}" class="text-gray-700 hover:text-purple-600 font-medium no-underline">
                    My Portfolios
                </a>

                <!-- Dropdown for Account -->
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center space-x-2 text-gray-700 hover:text-purple-600 focus:outline-none">
                        <span>Account</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0l-4.25-4.25a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu (toggle on small screens) -->
            <div class="md:hidden flex items-center">
                <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-purple-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 5h14a1 1 0 010 2H3a1 1 0 010-2zm0 4h14a1 1 0 010 2H3a1 1 0 010-2zm0 4h14a1 1 0 010 2H3a1 1 0 010-2z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobileMenu" class="hidden md:hidden bg-white shadow-lg border-t border-gray-200 z-50">
        <a href="{{ route('portfolios.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            My Portfolios
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                Logout
            </button>
        </form>
    </div>
</nav>

<script>
    function toggleDropdown() {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    }

    function toggleMobileMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
</script>

</body>
</html>
