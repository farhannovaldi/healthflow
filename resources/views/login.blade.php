<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HealthFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
</head>

<body class="font-sans antialiased bg-gradient-to-b from-indigo-100 to-blue-200">

    <header class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-6 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-3xl sm:text-4xl font-extrabold transform hover:scale-105 transition duration-300">HealthFlow</h1>
            <nav class="hidden md:flex space-x-6 items-center">
                <a href="/" class="hover:text-blue-300 transition-all text-lg font-medium">Beranda</a>
                <a href="/login"
                    class="bg-white text-indigo-700 px-5 py-2 rounded-full font-medium hover:bg-indigo-700 hover:text-white transition-all text-lg">Masuk</a>
            </nav>
            <a href="/login"
                class="md:hidden bg-white text-indigo-700 px-5 py-2 rounded-full font-medium hover:bg-indigo-700 hover:text-white transition-all">Masuk</a>
        </div>
    </header>


    <!-- Login Form Section -->
    <section
        class="flex flex-col items-center justify-center min-h-screen text-center bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-16">
        <h2 class="text-4xl font-extrabold text-white mb-6">Login</h2>
        <p class="text-xl text-white mb-8 opacity-80">Silakan masukkan kredensial Anda untuk masuk ke akun HealthFlow.
        </p>

        <!-- Form -->
        <form action="{{ route('login.process') }}" method="POST"
            class="bg-white p-8 rounded-xl shadow-xl w-full sm:w-96">
            @csrf
            @if ($errors->any())
                <div class="mb-6">
                    <div class="bg-red-500 text-white p-4 rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <label for="email" class="block text-left text-lg font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" required
                    placeholder="Masukkan email Anda" value="{{ old('email') }}">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-left text-lg font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" required
                    placeholder="Masukkan password Anda">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition-all">Login</button>
        </form>

        <!-- Daftar Link -->
        <p class="text-white mt-4">Belum punya akun? <a href="/register"
                class="text-blue-300 font-semibold hover:underline hover:text-blue-100 transition">Daftar di sini</a></p>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 HealthFlow. Semua Hak Dilindungi.</p>
        </div>
    </footer>

</body>

</html>
