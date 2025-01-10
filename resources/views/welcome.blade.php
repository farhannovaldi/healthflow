<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - HealthFlow</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2771/2771400.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased bg-gradient-to-b from-indigo-100 to-blue-200">
<header class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-4 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center px-6">
        <h1 class="text-4xl font-extrabold transform hover:scale-110 transition duration-300">HealthFlow</h1>
        <nav class="hidden md:flex items-center space-x-4">
            <a href="#about"
                class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg font-medium transition-all shadow-lg">
                Tentang
            </a>
            <a href="#services"
                class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg font-medium transition-all shadow-lg">
                Layanan
            </a>
            <a href="#jadwal-dokter"
                class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg font-medium transition-all shadow-lg">
                Jadwal Dokter
            </a>
            <a href="/login"
                class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-indigo-700 px-6 py-2 rounded-lg font-medium hover:scale-105 transform hover:bg-yellow-600 hover:text-white transition-all shadow-lg">
                Masuk
            </a>
        </nav>
        <button id="menu-btn"
            class="md:hidden text-white hover:text-yellow-400 transition duration-300 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>
</header>



    <!-- Hero Section -->
    <section
    class="flex flex-col items-center justify-center min-h-screen text-center bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-16">
    <h2 class="text-5xl font-extrabold text-white mb-6 animate-bounce">Selamat Datang di HealthFlow</h2>
    <p class="text-xl text-white mb-8 opacity-80">Solusi cepat dan tepat untuk layanan kesehatan Anda.</p>
    <a href="#services"
        class="bg-yellow-400 text-indigo-800 px-12 py-4 rounded-full text-xl font-semibold hover:bg-yellow-500 hover:scale-105 transform transition-all">
        Pelajari Layanan Kami
    </a>
</section>

    <!-- Jadwal Dokter Section -->
    <section id="jadwal-dokter" class="py-20 bg-gradient-to-b from-blue-100 to-white">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-semibold text-gray-800 mb-6">Jadwal Dokter</h3>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div id="calendar"></div>
            </div>
        </div>
    </section>

   <!-- About Section -->
<section id="about" class="py-20 bg-gradient-to-b from-indigo-50 via-white to-indigo-50">
    <div class="container mx-auto text-center">
        <h3 class="text-4xl font-bold text-indigo-700 mb-6 hover:text-indigo-600 transform hover:scale-105 transition duration-300">
            Tentang Kami
        </h3>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed transition-all">
            HealthFlow adalah platform yang dirancang untuk mempermudah pengelolaan data pasien, jadwal dokter, dan rekam medis.
            Kami menyediakan solusi digital yang efisien untuk tenaga medis dan pasien.
        </p>
        <div class="mt-10">
            <a href="#services"
                class="bg-indigo-600 text-white px-6 py-3 rounded-full shadow-lg font-medium hover:bg-indigo-500 hover:shadow-2xl transition-all">
                Jelajahi Layanan Kami
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 bg-gradient-to-r from-indigo-700 via-blue-600 to-indigo-800 text-white">
    <div class="container mx-auto text-center">
        <h3 class="text-4xl font-bold mb-8 transform hover:scale-105 transition duration-300">Layanan Kami</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
            <!-- Service 1 -->
            <div class="relative bg-white text-gray-800 p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-indigo-600 text-white w-16 h-16 flex items-center justify-center rounded-full shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 2a1 1 0 000 2h1v2H4V4a1 1 0 10-2 0v2a1 1 0 001 1h2v2H4a1 1 0 100 2h2v2H4a1 1 0 100 2h2v2H4a1 1 0 100 2h4a1 1 0 001-1V3a1 1 0 00-1-1H6z" />
                    </svg>
                </div>
                <h4 class="text-xl font-semibold mb-4 mt-10">Jadwal Dokter</h4>
                <p class="text-gray-600">Atur dan lihat jadwal dokter klinik dengan mudah kapan saja.</p>
            </div>

            <!-- Service 2 -->
            <div class="relative bg-white text-gray-800 p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-indigo-600 text-white w-16 h-16 flex items-center justify-center rounded-full shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V6a1 1 0 10-2 0v1H7a1 1 0 100 2h1v3a1 1 0 102 0V9h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h4 class="text-xl font-semibold mb-4 mt-10">Rekam Medis</h4>
                <p class="text-gray-600">Akses rekam medis pasien secara cepat, aman, dan mudah.</p>
            </div>

            <!-- Service 3 -->
            <div class="relative bg-white text-gray-800 p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-indigo-600 text-white w-16 h-16 flex items-center justify-center rounded-full shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 2a1 1 0 00-.894.553L7.382 6H3a1 1 0 00-.832 1.554l5 7a1 1 0 001.664 0l5-7A1 1 0 0017 6h-4.382l-1.724-3.447A1 1 0 0010 2z" />
                    </svg>
                </div>
                <h4 class="text-xl font-semibold mb-4 mt-10">Pendataan Pasien</h4>
                <p class="text-gray-600">Perbarui data pasien dengan praktis.</p>
            </div>
        </div>
    </div>
</section>

    <footer class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-8">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p>&copy; 2024 HealthFlow. Semua Hak Dilindungi.</p>
            <div class="flex space-x-4">
                <a href="#" class="hover:text-yellow-400 transition">
                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 2.04c-5.5 0-10 4.48-10 10.01 0 4.41 3.59 8.06 8.15 8.95v-6.34h-2.45v-2.61h2.45v-2.01c0-2.43 1.45-3.79 3.65-3.79 1.06 0 2.17.19 2.17.19v2.39h-1.22c-1.2 0-1.57.74-1.57 1.49v1.74h2.67l-.43 2.61h-2.24v6.34c4.56-.89 8.15-4.54 8.15-8.95 0-5.53-4.5-10.01-10-10.01z" />
                    </svg>
                </a>
                <a href="#" class="hover:text-yellow-400 transition">
                    <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M24 4.56c-.89.39-1.85.66-2.86.78 1.03-.62 1.81-1.6 2.18-2.77-.96.57-2.02.98-3.14 1.2-.91-.96-2.22-1.56-3.65-1.56-2.75 0-4.98 2.23-4.98 4.98 0 .39.04.77.13 1.14-4.14-.21-7.8-2.19-10.25-5.2-.43.74-.67 1.61-.67 2.54 0 1.75.89 3.29 2.23 4.2-.83-.03-1.61-.26-2.3-.63v.06c0 2.44 1.73 4.48 4.02 4.94-.42.12-.86.18-1.31.18-.32 0-.63-.03-.94-.09.63 1.97 2.46 3.4 4.63 3.44-1.7 1.33-3.85 2.13-6.18 2.13-.4 0-.79-.02-1.17-.07 2.21 1.42 4.85 2.26 7.68 2.26 9.22 0 14.27-7.64 14.27-14.27l-.02-.65c.98-.71 1.82-1.6 2.48-2.61z" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const calendarEl = document.getElementById("calendar");

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridWeek",
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '{{ route('jadwaldokter.getJadwal') }}',
                        method: 'GET',
                        data: {
                            start: fetchInfo.startStr,
                            end: fetchInfo.endStr,
                        },
                        success: function(response) {
                            successCallback(response);
                        },
                        error: function() {
                            console.error("Gagal mengambil data jadwal.");
                            failureCallback();
                        },
                    });
                },
                eventDidMount: function(info) {
                    const startTime = info.event.start.toLocaleTimeString([], {
                        hour: "2-digit",
                        minute: "2-digit",
                    });
                    const endTime = info.event.end.toLocaleTimeString([], {
                        hour: "2-digit",
                        minute: "2-digit",
                    });

                    const tooltipContent = `
                        <div>
                            <div><strong>Nama:</strong> ${info.event.extendedProps.description}</div>
                            <div><strong>Jadwal:</strong> ${startTime} - ${endTime}</div>
                        </div>
                    `;

                    info.el.setAttribute("data-bs-toggle", "tooltip");
                    info.el.setAttribute("data-bs-html", "true");
                    info.el.setAttribute("title", tooltipContent);

                    new bootstrap.Tooltip(info.el);
                },
                locale: "id",
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridWeek,dayGridMonth",
                },
            });

            calendar.render();
        });
    </script>
</body>

</html>
