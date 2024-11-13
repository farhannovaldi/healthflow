<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HealthFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
</head>
<body class="font-sans antialiased bg-gradient-to-b from-indigo-100 to-blue-200">

    <!-- Header -->
    <header class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-8 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-4xl font-extrabold transform hover:scale-105 transition duration-300">HealthFlow</h1>
            <nav class="hidden md:flex space-x-8">
                <a href="/" class="hover:text-blue-300 transition-all">Beranda</a>
                <a href="/login" class="bg-white text-indigo-700 px-6 py-2 rounded-full font-medium hover:bg-indigo-700 hover:text-white transition-all">Masuk</a>
            </nav>
            <a href="/login" class="md:hidden bg-white text-indigo-700 px-6 py-2 rounded-full font-medium hover:bg-indigo-700 hover:text-white transition-all">Masuk</a>
        </div>
    </header>

    <!-- Register Form Section -->
    <section class="flex flex-col items-center justify-center min-h-screen text-center bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-16">
        <h2 class="text-4xl font-extrabold text-white mb-6">Daftar</h2>
        <p class="text-xl text-white mb-8 opacity-80">Silakan buat akun baru untuk memulai perjalanan Anda di HealthFlow.</p>

        <!-- Form -->
        <form action="{{ route('register.process') }}" method="POST" class="bg-white p-8 rounded-xl shadow-xl w-full sm:w-96">
            @csrf
            <!-- Menampilkan pesan kesalahan jika ada -->
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

            <div class="mb-4">
                <label for="name" class="block text-left text-lg font-semibold text-gray-700">Nama</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" required placeholder="Masukkan nama Anda" value="{{ old('name') }}">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-left text-lg font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" required placeholder="Masukkan email Anda" value="{{ old('email') }}">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-left text-lg font-semibold text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" required placeholder="Masukkan password Anda">
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-left text-lg font-semibold text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2" required placeholder="Konfirmasi password Anda">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition-all">Daftar</button>
        </form>

        <!-- Login Link -->
        <p class="text-white mt-4">Sudah punya akun? <a href="/login" class="text-blue-300 font-semibold hover:underline">Masuk di sini</a></p>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 HealthFlow. Semua Hak Dilindungi.</p>
        </div>
    </footer>

</body>
</html>
