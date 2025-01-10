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
    <header class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-4xl font-extrabold transform hover:scale-105 transition duration-300">HealthFlow</h1>
            <nav class="hidden md:flex items-center space-x-8">
                <a href="#about" class="hover:text-blue-300 transition-all">Tentang</a>
                <a href="#services" class="hover:text-blue-300 transition-all">Layanan</a>
                <a href="#contact" class="hover:text-blue-300 transition-all">Kontak</a>
                <a href="/login"
                    class="bg-white text-indigo-700 px-6 py-2 rounded-full font-medium hover:bg-indigo-700 hover:text-white transition-all">
                    Masuk
                </a>
            </nav>
            <a href="/login"
                class="md:hidden bg-white text-indigo-700 px-6 py-2 rounded-full font-medium hover:bg-indigo-700 hover:text-white transition-all">
                Masuk
            </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section
        class="flex flex-col items-center justify-center min-h-screen text-center bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-16">
        <h2 class="text-5xl font-extrabold text-white mb-6">Selamat Datang di HealthFlow</h2>
        <p class="text-xl text-white mb-8 opacity-80">Solusi cepat dan tepat untuk layanan kesehatan Anda.</p>
        <a href="#services"
            class="bg-white text-blue-600 px-12 py-4 rounded-full text-xl font-semibold hover:bg-blue-600 hover:text-white transition-all">Pelajari
            Layanan Kami</a>
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
    <section id="about" class="py-20 bg-gradient-to-b from-white to-indigo-50">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-semibold text-gray-800 mb-6 transform hover:scale-105 transition duration-300">
                Tentang Kami</h3>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto transition-all">HealthFlow adalah platform yang dirancang
                untuk mempermudah pengelolaan data pasien, jadwal dokter, dan rekam medis. Kami menyediakan solusi
                digital yang efisien untuk tenaga medis dan pasien.</p>
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
    <!-- Footer -->
    <footer class="bg-gradient-to-r from-indigo-700 to-blue-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 HealthFlow. Semua Hak Dilindungi.</p>
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
