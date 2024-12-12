<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - HealthFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    <script>
        // Smooth Scroll JavaScript
        document.addEventListener("DOMContentLoaded", function() {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute("href");
                    document.querySelector(targetId).scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                });
            });
        });
    </script>
</head>
<body class="font-sans antialiased bg-gradient-to-b from-indigo-100 to-blue-200">

    <header class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-4xl font-extrabold transform hover:scale-105 transition duration-300">HealthFlow</h1>
            <nav class="hidden md:flex items-center space-x-8">
                <a href="#about" class="hover:text-blue-300 transition-all">Tentang</a>
                <a href="#services" class="hover:text-blue-300 transition-all">Layanan</a>
                <a href="#contact" class="hover:text-blue-300 transition-all">Kontak</a>
                <a href="/login" class="bg-white text-indigo-700 px-6 py-2 rounded-full font-medium hover:bg-indigo-700 hover:text-white transition-all">
                    Masuk
                </a>
            </nav>
            <a href="/login" class="md:hidden bg-white text-indigo-700 px-6 py-2 rounded-full font-medium hover:bg-indigo-700 hover:text-white transition-all">
                Masuk
            </a>
        </div>
    </header>


    <!-- Hero Section -->
    <section class="flex flex-col items-center justify-center min-h-screen text-center bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-16">
        <h2 class="text-5xl font-extrabold text-white mb-6 animate__animated animate__fadeIn">Selamat Datang di HealthFlow</h2>
        <p class="text-xl text-white mb-8 opacity-80 animate__animated animate__fadeIn animate__delay-1s">Solusi cepat dan tepat untuk layanan kesehatan Anda. Akses riwayat pasien, jadwal dokter, dan informasi kesehatan hanya di ujung jari Anda.</p>
        <a href="#services" class="bg-white text-blue-600 px-12 py-4 rounded-full text-xl font-semibold hover:bg-blue-600 hover:text-white transition-all">Pelajari Layanan Kami</a>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gradient-to-b from-white to-indigo-50">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-semibold text-gray-800 mb-6 transform hover:scale-105 transition duration-300">Tentang Kami</h3>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto transition-all">HealthFlow adalah platform yang dirancang untuk mempermudah pengelolaan data pasien, jadwal dokter, dan rekam medis. Kami menyediakan solusi digital yang efisien untuk tenaga medis dan pasien.</p>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-semibold mb-6 transform hover:scale-105 transition duration-300">Layanan Kami</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white text-gray-800 p-8 rounded-xl shadow-xl hover:shadow-2xl transition duration-300">
                    <h4 class="text-2xl font-semibold mb-4">Jadwal Dokter</h4>
                    <p>Atur dan lihat jadwal dokter klinik dengan mudah kapan saja.</p>
                </div>
                <div class="bg-white text-gray-800 p-8 rounded-xl shadow-xl hover:shadow-2xl transition duration-300">
                    <h4 class="text-2xl font-semibold mb-4">Rekam Medis</h4>
                    <p>Akses rekam medis pasien secara cepat, aman, dan mudah.</p>
                </div>
                <div class="bg-white text-gray-800 p-8 rounded-xl shadow-xl hover:shadow-2xl transition duration-300">
                    <h4 class="text-2xl font-semibold mb-4">Pendataan Pasien</h4>
                    <p> Perbarui data pasien dengan praktis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gradient-to-r from-indigo-50 to-blue-100">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-semibold text-gray-800 mb-6 transform hover:scale-105 transition duration-300">Hubungi Kami</h3>
            <p class="text-lg text-gray-700 mb-4">Kami siap membantu Anda dengan segala pertanyaan. Hubungi kami melalui email di bawah ini.</p>
            <a href="mailto:info@healthflow.com" class="bg-blue-600 text-white px-8 py-4 rounded-full text-xl hover:bg-blue-700 transition-all">Email Kami</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 HealthFlow. Semua Hak Dilindungi.</p>
        </div>
    </footer>

</body>
</html>
