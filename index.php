<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Undangan Pernikahan Ega & Nia</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Google Fonts: Playfair Display & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- FontAwesome Icons for Beautiful UI -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Chart.js for Beautiful Analytics & Stats -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            serif: ['Playfair Display', 'serif'],
            sans: ['Plus Jakarta Sans', 'sans-serif'],
          },
          colors: {
            sage: {
              50: '#f4f7f5',
              100: '#e5ebe6',
              200: '#cbdad0',
              300: '#a3beaf',
              400: '#759985',
              500: '#567c69',
              600: '#436151',
              700: '#374f42',
              800: '#2e4036',
              900: '#27362f',
            },
            champagne: {
              50: '#faf6f0',
              100: '#f3eade',
              200: '#e7d5bd',
              300: '#d7bc96',
              400: '#c59f71',
              500: '#b68754',
              600: '#a77546',
              700: '#8b5e39',
              800: '#714d31',
              900: '#5d402b',
            }
          }
        }
      }
    }
  </script>
  
  <style>
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 4px;
    }
    ::-webkit-scrollbar-track {
      background: #f4f7f5;
    }
    ::-webkit-scrollbar-thumb {
      background: #759985;
      border-radius: 10px;
    }
    /* Simple Animation Keyframes */
    @keyframes pulse-slow {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
    .animate-pulse-slow {
      animation: pulse-slow 3s infinite ease-in-out;
    }
    /* Hide scrollbar for element */
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }
    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</head>
<body class="bg-slate-900 text-slate-800 font-sans antialiased min-h-screen flex justify-center overflow-x-hidden relative">

  <!-- Toast Notification Container -->
  <div id="toast-container" class="fixed top-5 left-1/2 -translate-x-1/2 z-[10005] flex flex-col gap-2 w-11/12 max-w-sm pointer-events-none"></div>

  <!-- OVERLAY / WELCOME SCREEN (Direct child of body with absolute highest z-index) -->
  <section id="welcome-screen" class="fixed inset-0 z-[9999] bg-gradient-to-b from-sage-900 via-sage-800 to-sage-950 text-white flex flex-col justify-between p-8 pointer-events-auto">
    <div class="text-center pt-12">
      <span class="text-xs tracking-[0.3em] text-champagne-300 uppercase block mb-3 font-semibold">The Wedding of</span>
      <h1 class="font-serif text-4xl md:text-5xl text-champagne-200 leading-tight">Ega & Nia</h1>
      <p class="text-xs text-sage-200 tracking-wider mt-2">20 Juni 2026</p>
    </div>

    <!-- Artistic Frame / Floral Mockup -->
    <div class="my-auto flex justify-center items-center py-6">
      <div class="relative w-56 h-56 rounded-full border border-champagne-300/30 flex items-center justify-center p-3 animate-pulse-slow">
        <div class="w-full h-full rounded-full border-2 border-dashed border-champagne-400/50 flex flex-col justify-center items-center bg-sage-800/40 backdrop-blur-sm">
          <i class="fa-solid fa-heart text-champagne-400 text-3xl mb-3 animate-bounce"></i>
          <span class="font-serif text-sm text-champagne-100">Kepada Yth.</span>
          <span id="guest-name" class="font-bold text-lg text-white mt-1">Tamu Undangan</span>
          <span class="text-[10px] text-sage-300 italic mt-1">Di Tempat</span>
        </div>
      </div>
    </div>

    <div class="text-center pb-12">
      <p class="text-xs text-sage-300 mb-6 max-w-xs mx-auto">Merupakan suatu kehormatan dan kebahagiaan bagi kami sekeluarga apabila Bapak/Ibu/Saudara/i berkenan hadir di hari bahagia kami.</p>
      <button id="btn-open-undangan" class="cursor-pointer px-8 py-3.5 rounded-full bg-champagne-400 hover:bg-champagne-500 text-sage-950 font-bold tracking-wider text-sm transition-all shadow-lg shadow-champagne-950/20 active:scale-95 flex items-center gap-3 mx-auto">
        <i class="fa-solid fa-envelope-open"></i> Buka Undangan
      </button>
    </div>
  </section>

  <!-- Main Mobile Container (Enforces Mobile Viewport Look on Desktop) -->
  <main class="w-full max-w-md bg-champagne-50 shadow-2xl relative min-h-screen pb-24 overflow-x-hidden flex flex-col">

    <!-- Music Background Player (Hidden/Floating Control) -->
    <div id="music-widget" class="fixed bottom-24 right-5 z-40 hidden">
      <button id="btn-music" class="w-12 h-12 rounded-full bg-sage-600 text-white shadow-lg flex items-center justify-center hover:bg-sage-700 transition-transform active:scale-95 duration-200">
        <i id="music-icon" class="fa-solid fa-compact-disc fa-spin"></i>
      </button>
      <audio id="bg-audio" loop>
        <source src="https://assets.mixkit.co/active_storage/sfx/123/123-200.wav" type="audio/wav">
        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
      </audio>
    </div>

    <!-- CONTENT WRAPPER -->
    <div id="main-content" class="opacity-0 transition-opacity duration-1000 flex-grow">
      
      <!-- HERO SECTION -->
      <header class="relative bg-gradient-to-b from-sage-900 to-sage-800 text-white py-16 px-6 text-center shadow-lg">
        <div class="absolute inset-0 bg-[radial-gradient(#567c69_1px,transparent_1px)] [background-size:16px_16px] opacity-10"></div>
        <span class="text-xs tracking-[0.2em] text-champagne-400 uppercase block mb-3 font-semibold">Walimatul 'Ursy</span>
        <h2 class="font-serif text-5xl text-champagne-100 mb-2">Ega & Nia</h2>
        <p class="text-sm text-sage-300 tracking-widest uppercase mb-6">Sabtu, 20 Juni 2026</p>
        
        <!-- Countdown Widget -->
        <div class="grid grid-cols-4 gap-2 max-w-xs mx-auto mt-6">
          <div class="bg-sage-950/50 backdrop-blur-md rounded-xl p-3 border border-sage-700/50">
            <span id="days" class="block font-serif text-2xl text-champagne-300 font-bold">00</span>
            <span class="text-[9px] uppercase tracking-wider text-sage-400">Hari</span>
          </div>
          <div class="bg-sage-950/50 backdrop-blur-md rounded-xl p-3 border border-sage-700/50">
            <span id="hours" class="block font-serif text-2xl text-champagne-300 font-bold">00</span>
            <span class="text-[9px] uppercase tracking-wider text-sage-400">Jam</span>
          </div>
          <div class="bg-sage-950/50 backdrop-blur-md rounded-xl p-3 border border-sage-700/50">
            <span id="minutes" class="block font-serif text-2xl text-champagne-300 font-bold">00</span>
            <span class="text-[9px] uppercase tracking-wider text-sage-400">Menit</span>
          </div>
          <div class="bg-sage-950/50 backdrop-blur-md rounded-xl p-3 border border-sage-700/50">
            <span id="seconds" class="block font-serif text-2xl text-champagne-300 font-bold">00</span>
            <span class="text-[9px] uppercase tracking-wider text-sage-400">Detik</span>
          </div>
        </div>
      </header>

      <!-- TAB SECTIONS CONTAINER -->
      <div class="px-5 py-8 space-y-12">
        
        <!-- TAB 1: MEMPELAI (SAMPUL & PROFIL) -->
        <section id="tab-mempelai" class="tab-content scroll-mt-20">
          <div class="text-center mb-8">
            <i class="fa-solid fa-leaf text-sage-500 text-2xl mb-2"></i>
            <h3 class="font-serif text-2xl text-sage-800">Kedua Mempelai</h3>
            <p class="text-xs text-sage-500 italic mt-1">Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan.</p>
          </div>

          <div class="space-y-6">
            <!-- Mempelai Pria -->
            <div class="bg-white rounded-3xl p-6 shadow-md border border-sage-100/50 relative overflow-hidden">
              <div class="absolute -right-8 -top-8 w-24 h-24 bg-sage-100 rounded-full opacity-50"></div>
              <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 rounded-full bg-sage-200 flex items-center justify-center text-sage-600 font-serif text-2xl font-bold shadow-inner">
                  E
                </div>
                <div>
                  <h4 class="font-serif text-xl text-sage-900 font-bold">Ega Lana Wibowo</h4>
                  <p class="text-xs text-champagne-600 font-semibold uppercase tracking-wider">Ega</p>
                </div>
              </div>
              <p class="text-xs text-slate-500 leading-relaxed pl-1">
                Putra tercinta dari bapak <strong class="text-slate-800 font-medium">PRAMUJI</strong> & Ibu.
              </p>
              <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-2 text-[11px] text-slate-500">
                <i class="fa-solid fa-map-pin text-sage-500"></i>
                <span>JL. Nyiresik Blok Askal, RT 022/RW 001, Kel. Sindang, Kec. Sindang, Indramayu</span>
              </div>
            </div>

            <!-- Heart Divider -->
            <div class="flex items-center justify-center my-2">
              <div class="h-[1px] bg-sage-200 flex-grow max-w-[60px]"></div>
              <i class="fa-solid fa-heart text-champagne-400 mx-3 text-lg"></i>
              <div class="h-[1px] bg-sage-200 flex-grow max-w-[60px]"></div>
            </div>

            <!-- Mempelai Wanita -->
            <div class="bg-white rounded-3xl p-6 shadow-md border border-sage-100/50 relative overflow-hidden">
              <div class="absolute -left-8 -top-8 w-24 h-24 bg-champagne-100 rounded-full opacity-50"></div>
              <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 rounded-full bg-champagne-200 flex items-center justify-center text-champagne-700 font-serif text-2xl font-bold shadow-inner">
                  N
                </div>
                <div>
                  <h4 class="font-serif text-xl text-sage-900 font-bold">Karunia Riski Apri Hesi</h4>
                  <p class="text-xs text-champagne-600 font-semibold uppercase tracking-wider">Nia</p>
                </div>
              </div>
              <p class="text-xs text-slate-500 leading-relaxed pl-1">
                Putri tercinta dari bapak <strong class="text-slate-800 font-medium">SUHERMAN</strong> & Ibu.
              </p>
              <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-2 text-[11px] text-slate-500">
                <i class="fa-solid fa-map-pin text-champagne-500"></i>
                <span>Kp. Jati, RT 002/RW 003, Kel. Jatiuwung, Kec. Cibodas, Tangerang</span>
              </div>
            </div>
          </div>
        </section>

        <!-- TAB 2: ACARA (WAKTU & TEMPAT) -->
        <section id="tab-acara" class="tab-content scroll-mt-20">
          <div class="text-center mb-8">
            <i class="fa-solid fa-calendar-days text-sage-500 text-2xl mb-2"></i>
            <h3 class="font-serif text-2xl text-sage-800">Rangkaian Acara</h3>
            <p class="text-xs text-sage-500 mt-1">Kami sangat menantikan kehadiran Anda di hari bahagia kami</p>
          </div>

          <div class="space-y-6">
            <!-- Akad Nikah -->
            <div class="bg-white rounded-3xl p-6 shadow-md border-t-4 border-sage-500">
              <div class="flex justify-between items-start mb-4">
                <span class="px-3 py-1 bg-sage-100 text-sage-700 text-[10px] rounded-full font-bold uppercase tracking-wider">Akad Nikah</span>
                <i class="fa-solid fa-ring text-sage-500 text-lg"></i>
              </div>
              <div class="space-y-3">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-sage-50 flex items-center justify-center text-sage-600">
                    <i class="fa-solid fa-clock text-sm"></i>
                  </div>
                  <div>
                    <span class="block text-xs text-slate-400">Waktu</span>
                    <span class="text-xs font-semibold text-slate-800">08.00 WIB - 10.00 WIB</span>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-sage-50 flex items-center justify-center text-sage-600">
                    <i class="fa-solid fa-calendar text-sm"></i>
                  </div>
                  <div>
                    <span class="block text-xs text-slate-400">Hari & Tanggal</span>
                    <span class="text-xs font-semibold text-slate-800">Sabtu, 20 Juni 2026</span>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-sage-50 flex items-center justify-center text-sage-600">
                    <i class="fa-solid fa-location-dot text-sm"></i>
                  </div>
                  <div>
                    <span class="block text-xs text-slate-400">Lokasi Acara</span>
                    <span class="text-xs font-semibold text-slate-800 block">Kediaman Mempelai Wanita</span>
                    <span class="text-[10px] text-slate-500">Kp. Jati, Kel. Jatiuwung, Kec. Cibodas, Tangerang</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Resepsi Nikah -->
            <div class="bg-white rounded-3xl p-6 shadow-md border-t-4 border-champagne-400">
              <div class="flex justify-between items-start mb-4">
                <span class="px-3 py-1 bg-champagne-100 text-champagne-800 text-[10px] rounded-full font-bold uppercase tracking-wider">Resepsi Pernikahan</span>
                <i class="fa-solid fa-champagne-glasses text-champagne-500 text-lg"></i>
              </div>
              <div class="space-y-3">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-champagne-50 flex items-center justify-center text-champagne-600">
                    <i class="fa-solid fa-clock text-sm"></i>
                  </div>
                  <div>
                    <span class="block text-xs text-slate-400">Waktu</span>
                    <span class="text-xs font-semibold text-slate-800">11.00 WIB - Selesai</span>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-champagne-50 flex items-center justify-center text-champagne-600">
                    <i class="fa-solid fa-calendar text-sm"></i>
                  </div>
                  <div>
                    <span class="block text-xs text-slate-400">Hari & Tanggal</span>
                    <span class="text-xs font-semibold text-slate-800">Sabtu, 20 Juni 2026</span>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-champagne-50 flex items-center justify-center text-champagne-600">
                    <i class="fa-solid fa-location-dot text-sm"></i>
                  </div>
                  <div>
                    <span class="block text-xs text-slate-400">Lokasi Acara</span>
                    <span class="text-xs font-semibold text-slate-800 block">Gedung Pertemuan Utama Tangerang</span>
                    <span class="text-[10px] text-slate-500">Kp. Jati, Kel. Jatiuwung, Kec. Cibodas, Tangerang</span>
                  </div>
                </div>
              </div>
              <button onclick="openMaps()" class="w-full mt-4 py-2.5 rounded-2xl bg-sage-600 hover:bg-sage-700 text-white font-medium text-xs transition-colors flex items-center justify-center gap-2 shadow-sm">
                <i class="fa-solid fa-map-location-dot"></i> Buka Google Maps Lokasi
              </button>
            </div>
          </div>
        </section>

        <!-- TAB 3: BUKU TAMU / RSVP (REAL-TIME DENGAN SUPABASE) -->
        <section id="tab-rsvpguestbook" class="tab-content scroll-mt-20">
          <div class="text-center mb-8">
            <i class="fa-solid fa-envelope-open-text text-sage-500 text-2xl mb-2"></i>
            <h3 class="font-serif text-2xl text-sage-800">Kehadiran & Buku Tamu</h3>
            <p class="text-xs text-sage-500 mt-1">Berikan RSVP dan ucapan doa terbaik Anda untuk kedua mempelai.</p>
          </div>

          <!-- RSVP & Guestbook Form -->
          <div class="bg-white rounded-3xl p-6 shadow-md border border-sage-100/50 mb-6">
            <form id="rsvp-form" onsubmit="handleFormSubmit(event)" class="space-y-4">
              <div>
                <label for="input-name" class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" id="input-name" required placeholder="Contoh: Budi Santoso" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition-all">
              </div>
              
              <div>
                <label for="select-kehadiran" class="block text-xs font-semibold text-slate-700 mb-1">Konfirmasi Kehadiran</label>
                <select id="select-kehadiran" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition-all bg-white">
                  <option value="" disabled selected>-- Pilih Konfirmasi --</option>
                  <option value="Hadir">Saya Akan Hadir</option>
                  <option value="Tidak Hadir">Maaf, Saya Tidak Bisa Hadir</option>
                  <option value="Masih Ragu">Masih Ragu-ragu</option>
                </select>
              </div>

              <div>
                <label for="select-pax" class="block text-xs font-semibold text-slate-700 mb-1">Jumlah Tamu (Pax)</label>
                <select id="select-pax" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition-all bg-white">
                  <option value="1">1 Orang</option>
                  <option value="2">2 Orang</option>
                  <option value="3">3 Orang</option>
                </select>
              </div>

              <div>
                <div class="flex justify-between items-center mb-1">
                  <label for="textarea-wish" class="block text-xs font-semibold text-slate-700">Pesan & Doa Restu</label>
                  <button type="button" onclick="openAiGenerator()" class="text-[10px] text-sage-600 font-semibold hover:underline flex items-center gap-1">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Buat Pesan Otomatis (AI)
                  </button>
                </div>
                <textarea id="textarea-wish" required rows="3" placeholder="Tuliskan ucapan selamat..." class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sage-400 focus:border-transparent transition-all resize-none"></textarea>
              </div>

              <button type="submit" id="btn-submit" class="w-full py-3 rounded-2xl bg-sage-600 hover:bg-sage-700 text-white font-bold text-xs transition-colors shadow-md shadow-sage-900/10 active:scale-95 flex items-center justify-center gap-2">
                <i class="fa-solid fa-paper-plane"></i> Kirim RSVP & Ucapan
              </button>
            </form>
          </div>

          <!-- Real-Time Feed -->
          <div class="space-y-4">
            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider flex items-center gap-2">
              <i class="fa-solid fa-comments text-sage-400"></i> Ucapan Terkini (<span id="count-ucapan">0</span>)
            </h4>
            
            <div id="wishes-list" class="space-y-3 max-h-96 overflow-y-auto no-scrollbar pr-1">
              <!-- Loading State -->
              <div id="wishes-loading" class="text-center py-6 text-slate-400 text-xs">
                <i class="fa-solid fa-circle-notch fa-spin text-lg text-sage-500 mb-2"></i>
                <p>Memuat data ucapan dari database...</p>
              </div>
            </div>
          </div>
        </section>

        <!-- TAB 4: ASISTEN AI & DATA -->
        <section id="tab-ai-data" class="tab-content scroll-mt-20">
          <div class="text-center mb-8">
            <i class="fa-solid fa-robot text-sage-500 text-2xl mb-2"></i>
            <h3 class="font-serif text-2xl text-sage-800">Asisten AI & Statistik</h3>
            <p class="text-xs text-sage-500 mt-1">Interaksi kecerdasan buatan & infografis sebaran tamu</p>
          </div>

          <!-- Sub Navigation -->
          <div class="flex bg-sage-100 p-1.5 rounded-2xl gap-1 mb-6">
            <button onclick="switchHubTab('hub-ai')" id="btn-hub-ai" class="flex-1 py-2 text-xs font-semibold rounded-xl bg-white text-sage-800 shadow-sm transition-all">
              <i class="fa-solid fa-comment-dots mr-1"></i> Asisten AI
            </button>
            <button onclick="switchHubTab('hub-stats')" id="btn-hub-stats" class="flex-1 py-2 text-xs font-semibold rounded-xl text-sage-600 hover:text-sage-800 transition-all">
              <i class="fa-solid fa-chart-pie mr-1"></i> Statistik Tamu
            </button>
          </div>

          <!-- Sub-Tab 1: Asisten AI "Sari" -->
          <div id="hub-ai" class="space-y-4">
            <div class="bg-white rounded-3xl p-5 shadow-md border border-sage-100/50">
              <div class="flex items-center gap-3 mb-3 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 rounded-full bg-sage-500 text-white flex items-center justify-center text-lg shadow-inner">
                  <i class="fa-solid fa-wand-magic-sparkles"></i>
                </div>
                <div>
                  <h4 class="text-xs font-bold text-slate-800">Asisten Digital: Sari</h4>
                  <p class="text-[10px] text-sage-500">Tanyakan pakaian yang cocok, rute, atau sekedar membuat sajak!</p>
                </div>
              </div>

              <!-- Chat Container -->
              <div id="chat-box" class="h-64 overflow-y-auto space-y-3 p-3 bg-slate-50 rounded-2xl border border-slate-100 mb-3 text-xs leading-relaxed">
                <div class="flex gap-2">
                  <div class="w-6 h-6 rounded-full bg-sage-100 text-sage-700 flex items-center justify-center font-bold text-[9px] shrink-0">S</div>
                  <div class="bg-white p-2.5 rounded-2xl shadow-sm max-w-[80%] border border-slate-100">
                    Halo! Saya Sari, asisten pernikahan Ega & Nia. Ada yang bisa saya bantu? Silakan pilih opsi di bawah ini atau ketik pertanyaanmu sendiri.
                  </div>
                </div>
              </div>

              <!-- Quick Prompt Buttons -->
              <div class="flex flex-wrap gap-1.5 mb-3">
                <button onclick="sendQuickPrompt('Dresscode pernikahan apa ya?')" class="px-2.5 py-1.5 bg-sage-50 hover:bg-sage-100 border border-sage-100 text-[10px] rounded-lg text-slate-600 transition-colors">👗 Dresscode?</button>
                <button onclick="sendQuickPrompt('Ega dan Nia berasal dari mana?')" class="px-2.5 py-1.5 bg-sage-50 hover:bg-sage-100 border border-sage-100 text-[10px] rounded-lg text-slate-600 transition-colors">🗺️ Kota Asal?</button>
                <button onclick="sendQuickPrompt('Buatkan ucapan lucu untuk pengantin')" class="px-2.5 py-1.5 bg-sage-50 hover:bg-sage-100 border border-sage-100 text-[10px] rounded-lg text-slate-600 transition-colors">💡 Buat Ucapan Lucu</button>
              </div>

              <!-- Chat Input -->
              <div class="flex gap-2">
                <input type="text" id="chat-input" placeholder="Tanyakan sesuatu..." onkeydown="if(event.key === 'Enter') handleChatSubmit()" class="flex-grow px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-1 focus:ring-sage-400">
                <button onclick="handleChatSubmit()" class="w-9 h-9 rounded-xl bg-sage-600 text-white flex items-center justify-center shadow-md shadow-sage-600/20 active:scale-95"><i class="fa-solid fa-paper-plane text-xs"></i></button>
              </div>
            </div>
          </div>

          <!-- Sub-Tab 2: Statistik Chart -->
          <div id="hub-stats" class="hidden space-y-4">
            <div class="bg-white rounded-3xl p-5 shadow-md border border-sage-100/50">
              <h4 class="text-xs font-bold text-slate-700 mb-2 flex items-center gap-1.5">
                <i class="fa-solid fa-chart-line text-sage-500"></i> Visualisasi Penyatuan Kota
              </h4>
              <p class="text-[10px] text-slate-500 mb-4">Grafik representatif penyatuan keluarga besar Indramayu (Ega) & Tangerang (Nia).</p>
              
              <div class="w-full max-w-[200px] mx-auto mb-4">
                <canvas id="unionChart"></canvas>
              </div>

              <div class="border-t border-slate-100 pt-3 space-y-2">
                <div class="flex justify-between items-center text-[11px]">
                  <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-sage-500 rounded-full"></span> Keluarga Ega (Indramayu)</span>
                  <span class="font-bold text-slate-800">50%</span>
                </div>
                <div class="flex justify-between items-center text-[11px]">
                  <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-champagne-400 rounded-full"></span> Keluarga Nia (Tangerang)</span>
                  <span class="font-bold text-slate-800">50%</span>
                </div>
              </div>
            </div>

            <div class="bg-white rounded-3xl p-5 shadow-md border border-sage-100/50">
              <h4 class="text-xs font-bold text-slate-700 mb-2 flex items-center gap-1.5">
                <i class="fa-solid fa-hourglass text-champagne-500"></i> Progress Waktu (Countdown)
              </h4>
              <div class="space-y-2">
                <div class="flex justify-between items-center text-[11px]">
                  <span class="text-slate-500">Masa Persiapan Acara</span>
                  <span id="txt-progress-p" class="font-bold text-slate-800">0%</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                  <div id="bar-progress-p" class="bg-gradient-to-r from-sage-500 to-champagne-400 h-full w-0 transition-all duration-1000"></div>
                </div>
                <p class="text-[9px] text-slate-400 italic">Dihitung sejak peluncuran sistem hingga 20 Juni 2026.</p>
              </div>
            </div>
          </div>
        </section>

        <!-- TAB 5: HADIAH DIGITAL -->
        <section id="tab-hadiah" class="tab-content scroll-mt-20">
          <div class="text-center mb-8">
            <i class="fa-solid fa-gift text-sage-500 text-2xl mb-2"></i>
            <h3 class="font-serif text-2xl text-sage-800">Hadiah Digital & Souvenir</h3>
            <p class="text-xs text-sage-500 mt-1">Doa restu Anda adalah berkah yang tak ternilai, namun jika ingin memberikan tanda kasih berupa amplop digital silakan di bawah ini.</p>
          </div>

          <div class="space-y-6">
            <!-- Rekening 1 -->
            <div class="bg-white rounded-3xl p-6 shadow-md border border-sage-100/50 relative overflow-hidden">
              <div class="absolute right-0 bottom-0 opacity-10">
                <i class="fa-solid fa-credit-card text-8xl text-slate-800"></i>
              </div>
              <div class="flex justify-between items-center mb-4">
                <span class="font-bold text-sm tracking-widest text-slate-800 uppercase">Rekening BRI</span>
                <span class="text-xs text-sage-600 font-semibold uppercase">Ega Lana Wibowo</span>
              </div>
              <div class="bg-slate-50 rounded-2xl p-4 flex justify-between items-center border border-slate-100 mb-3">
                <div>
                  <span class="block text-[10px] text-slate-400">Nomor Rekening</span>
                  <span class="font-mono text-base font-bold text-slate-800">2079015536</span>
                </div>
                <button onclick="copyAccount('2079015536')" class="px-4 py-2 bg-sage-600 hover:bg-sage-700 active:scale-95 text-white rounded-xl text-[10px] font-bold transition-all flex items-center gap-1.5">
                  <i class="fa-solid fa-copy"></i> Copy
                </button>
              </div>
              <p class="text-[10px] text-slate-400">Pemberian ditujukan untuk mempelai pria (Ega).</p>
            </div>

            <!-- Rekening 2 -->
            <div class="bg-white rounded-3xl p-6 shadow-md border border-sage-100/50 relative overflow-hidden">
              <div class="absolute right-0 bottom-0 opacity-10">
                <i class="fa-solid fa-credit-card text-8xl text-slate-800"></i>
              </div>
              <div class="flex justify-between items-center mb-4">
                <span class="font-bold text-sm tracking-widest text-slate-800 uppercase">Rekening BRI</span>
                <span class="text-xs text-champagne-700 font-semibold uppercase">Karunia Riski Apri Hesi</span>
              </div>
              <div class="bg-slate-50 rounded-2xl p-4 flex justify-between items-center border border-slate-100 mb-3">
                <div>
                  <span class="block text-[10px] text-slate-400">Nomor Rekening</span>
                  <span class="font-mono text-base font-bold text-slate-800">2079015536</span>
                </div>
                <button onclick="copyAccount('2079015536', 'nia')" class="px-4 py-2 bg-champagne-500 hover:bg-champagne-600 active:scale-95 text-white rounded-xl text-[10px] font-bold transition-all flex items-center gap-1.5">
                  <i class="fa-solid fa-copy"></i> Copy
                </button>
              </div>
              <p class="text-[10px] text-slate-400">Pemberian ditujukan untuk mempelai wanita (Nia).</p>
            </div>

            <!-- Souvenir Info Box -->
            <div class="bg-gradient-to-r from-sage-900 to-sage-800 text-white rounded-3xl p-6 shadow-lg text-center relative overflow-hidden">
              <div class="absolute top-0 right-0 p-4 opacity-10">
                <i class="fa-solid fa-bag-shopping text-6xl"></i>
              </div>
              <i class="fa-solid fa-gift text-champagne-400 text-3xl mb-2 animate-bounce"></i>
              <h4 class="font-serif text-lg text-champagne-100">Kirim Souvenir Fisik</h4>
              <p class="text-[11px] text-slate-300 max-w-xs mx-auto mt-2 mb-4">Pengiriman souvenir pernikahan fisik dijadwalkan serentak mulai <strong class="text-champagne-300 font-bold">20 Juni 2026</strong>. Konfirmasikan alamat Anda pada form RSVP agar kurir kami mengirimkan dengan tepat.</p>
              <span class="inline-block px-4 py-1.5 rounded-full bg-sage-800 text-champagne-300 border border-champagne-300/20 text-[10px] font-bold uppercase tracking-wider">Mulai: 20 Juni 2026</span>
            </div>
          </div>
        </section>

      </div>

      <!-- FOOTER APPRECIATION -->
      <footer class="py-12 bg-sage-900 text-white text-center px-6 relative mt-12 border-t border-sage-800">
        <i class="fa-solid fa-heart text-champagne-400 text-2xl mb-3 animate-pulse"></i>
        <p class="font-serif text-xl text-champagne-100 mb-1">Ega & Nia</p>
        <p class="text-[10px] text-sage-400 uppercase tracking-widest mb-6">Kami yang berbahagia</p>
        <p class="text-[10px] text-sage-500 max-w-xs mx-auto">Terima kasih atas segala dukungan, doa, dan kehadiran Anda.</p>
        <p class="text-[9px] text-sage-600 mt-6">&copy; 2026 Ega & Nia Wedding. Built with love & AI.</p>
      </footer>

    </div>

    <!-- PERSISTENT BOTTOM NAVIGATION BAR -->
    <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white/95 backdrop-blur-md border-t border-slate-100 shadow-[0_-5px_15px_-3px_rgba(0,0,0,0.05)] py-2.5 px-4 z-40 flex justify-between items-center">
      <button onclick="scrollToSection('tab-mempelai', this)" class="nav-item flex-1 flex flex-col items-center gap-1 text-sage-600 font-semibold transition-all duration-200">
        <i class="fa-solid fa-user-friends text-sm"></i>
        <span class="text-[9px]">Mempelai</span>
      </button>
      <button onclick="scrollToSection('tab-acara', this)" class="nav-item flex-1 flex flex-col items-center gap-1 text-slate-400 transition-all duration-200">
        <i class="fa-solid fa-calendar-alt text-sm"></i>
        <span class="text-[9px]">Acara</span>
      </button>
      <button onclick="scrollToSection('tab-rsvpguestbook', this)" class="nav-item flex-1 flex flex-col items-center gap-1 text-slate-400 transition-all duration-200 relative">
        <i class="fa-solid fa-comment-alt text-sm"></i>
        <span class="text-[9px]">Buku Tamu</span>
        <span id="badge-guestbook" class="absolute top-0 right-3 w-1.5 h-1.5 bg-rose-500 rounded-full hidden"></span>
      </button>
      <button onclick="scrollToSection('tab-ai-data', this)" class="nav-item flex-1 flex flex-col items-center gap-1 text-slate-400 transition-all duration-200">
        <i class="fa-solid fa-robot text-sm"></i>
        <span class="text-[9px]">Asisten AI</span>
      </button>
      <button onclick="scrollToSection('tab-hadiah', this)" class="nav-item flex-1 flex flex-col items-center gap-1 text-slate-400 transition-all duration-200">
        <i class="fa-solid fa-gift text-sm"></i>
        <span class="text-[9px]">Hadiah</span>
      </button>
    </nav>

    <!-- AI WRITING MODAL -->
    <div id="ai-modal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
      <div class="bg-white rounded-3xl w-full max-w-sm overflow-hidden shadow-2xl border border-slate-100 animate-pulse-slow-[0.5s]">
        <div class="bg-sage-600 text-white p-5 flex justify-between items-center">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
            <h4 class="font-bold text-sm">Penulis Ucapan AI</h4>
          </div>
          <button onclick="closeAiGenerator()" class="text-white hover:text-champagne-200"><i class="fa-solid fa-times"></i></button>
        </div>
        <div class="p-5 space-y-4 text-xs">
          <div>
            <label class="block font-semibold text-slate-700 mb-1">Hubungan dengan Mempelai</label>
            <select id="ai-relation" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-white">
              <option value="Teman masa kecil">Teman Masa Kecil</option>
              <option value="Rekan Kerja">Rekan Kerja</option>
              <option value="Keluarga dekat">Keluarga</option>
              <option value="Guru / Mentor">Guru / Mentor</option>
              <option value="Masyarakat umum">Tamu Umum</option>
            </select>
          </div>
          <div>
            <label class="block font-semibold text-slate-700 mb-1">Nada Ucapan (Tone)</label>
            <select id="ai-tone" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-white">
              <option value="Sangat sopan, puitis, dan menyentuh hati">Puitis & Haru</option>
              <option value="Lucu, santai, dibumbui humor sedikit">Humoris & Santai</option>
              <option value="Sarat doa-doa islami yang mendalam">Religius & Penuh Doa</option>
              <option value="Modern, santai tapi tetap hormat">Kekinian / Gaul</option>
            </select>
          </div>
          <button onclick="generateAiWish()" id="btn-generate-ai" class="w-full py-2.5 bg-champagne-500 hover:bg-champagne-600 text-white font-bold rounded-xl transition-colors flex items-center justify-center gap-1.5 shadow-md shadow-champagne-500/20">
            <i class="fa-solid fa-gears animate-spin hidden" id="icon-ai-spin"></i> Buat Ucapan Terbaik
          </button>
          
          <div id="ai-result-box" class="hidden">
            <label class="block font-semibold text-slate-700 mb-1">Hasil Ucapan:</label>
            <div id="ai-result-text" class="bg-slate-50 p-3 rounded-xl border border-slate-100 max-h-32 overflow-y-auto leading-relaxed select-all"></div>
            <button onclick="useAiWish()" class="w-full mt-3 py-2 bg-sage-600 hover:bg-sage-700 text-white font-bold rounded-xl transition-all">Gunakan & Masukkan ke Form</button>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script>
    // --- INTEGRASI KEY & DETIL ENVIRONMENT ---
    const apiKey = ""; 
    const appId = typeof __app_id !== 'undefined' ? __app_id : 'ega-nia-wedding';

    let supabaseUrl = "";
    let supabaseAnonKey = "";
    try {
      supabaseUrl = (typeof process !== 'undefined' && process.env?.SUPABASE_URL) || localStorage.getItem('supabase_url') || "";
      supabaseAnonKey = (typeof process !== 'undefined' && process.env?.SUPABASE_ANON_KEY) || localStorage.getItem('supabase_anon_key') || "";
    } catch (e) {
      console.log("Supabase error-guard fallback activated.");
    }

    let chatHistory = [
      { role: "user", parts: [{ text: "Halo, bertindaklah sebagai Sari, asisten pernikahan digital Ega (mempelai pria dari Indramayu, anak dari Pramuji) dan Nia (mempelai wanita dari Tangerang, anak dari Suherman). Acara berlangsung tanggal 20 Juni 2026. Alamat Ega: JL. Nyiresik Blok Askal RT 022/RW 001 Kel. Sindang Indramayu. Alamat Nia: Kp. Jati RT 002/RW 003 Kel. Jatiuwung Kec. Cibodas Tangerang. Pengiriman souvenir dimulai 20 Juni 2026. Jawab semua pertanyaan tamu secara hangat, ringkas, informatif, dan gunakan bahasa Indonesia yang ramah." }] },
      { role: "model", parts: [{ text: "Halo! Saya Sari, asisten virtual pernikahan Ega & Nia. Saya siap memberikan informasi terlengkap untuk seluruh tamu undangan!" }] }
    ];

    // --- INISIALISASI UNIFIED EVENT HANDLER ---
    document.addEventListener("DOMContentLoaded", function() {
      // Tombol Buka Undangan
      const btnOpen = document.getElementById('btn-open-undangan');
      if (btnOpen) {
        // Gabungkan handler click dan touch secara aman agar tidak macet
        const handleOpen = function(e) {
          e.preventDefault();
          e.stopPropagation();
          openUndangan();
        };
        btnOpen.addEventListener('click', handleOpen);
        btnOpen.addEventListener('touchstart', handleOpen, { passive: false });
      }

      // Tombol Musik
      const btnMusic = document.getElementById('btn-music');
      if (btnMusic) {
        btnMusic.addEventListener('click', function(e) {
          e.preventDefault();
          toggleMusic();
        });
      }

      // Memuat nama dari URL parameter (?to=Nama+Tamu)
      try {
        const urlParams = new URLSearchParams(window.location.search);
        const toGuest = urlParams.get('to');
        if (toGuest) {
          document.getElementById('guest-name').innerText = toGuest;
        }
      } catch (e) {
        console.error("Gagal memuat parameter nama tamu:", e);
      }

      // Jalankan seluruh Widget Pendukung secara Aman
      try { initCountdown(); } catch (e) { console.error(e); }
      try { initChart(); } catch (e) { console.error(e); }
      try { initProgressBar(); } catch (e) { console.error(e); }
      try { loadWishes(); } catch (e) { console.error(e); }
    });

    // --- TOAST NOTIFICATION UTILITY ---
    function showToast(message, type = "success") {
      const container = document.getElementById('toast-container');
      if (!container) return;
      const toast = document.createElement('div');
      
      const bgColor = type === "success" ? "bg-sage-600" : type === "error" ? "bg-red-500" : "bg-champagne-500";
      const icon = type === "success" ? "fa-circle-check" : type === "error" ? "fa-circle-exclamation" : "fa-info-circle";
      
      toast.className = `p-4 rounded-2xl ${bgColor} text-white text-xs font-semibold shadow-xl flex items-center gap-3 transition-all transform translate-y-2 opacity-0 pointer-events-auto`;
      toast.innerHTML = `
        <i class="fa-solid ${icon} text-lg"></i>
        <div class="flex-grow">${message}</div>
      `;
      
      container.appendChild(toast);
      
      setTimeout(() => {
        toast.classList.remove('translate-y-2', 'opacity-0');
      }, 50);

      setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-1');
        setTimeout(() => toast.remove(), 400);
      }, 4000);
    }

    // --- AUDIO & WELCOME SCREEN CONTROLLER ---
    const audio = document.getElementById('bg-audio');
    let isPlaying = false;

    function openUndangan() {
      const welcome = document.getElementById('welcome-screen');
      const content = document.getElementById('main-content');
      
      if (!welcome) return;

      // Animasi geser keluar halaman yang sangat mulus & kompatibel
      welcome.style.transition = "all 0.6s cubic-bezier(0.16, 1, 0.3, 1)";
      welcome.style.opacity = "0";
      welcome.style.transform = "translateY(-100%)";
      welcome.style.pointerEvents = "none";
      
      // Hapus total elemen dari viewport agar tidak menghalangi scrolling layar
      setTimeout(() => {
        welcome.style.display = "none";
      }, 650);
      
      if (content) {
        content.classList.remove('opacity-0');
      }
      
      const musicWidget = document.getElementById('music-widget');
      if (musicWidget) {
        musicWidget.classList.remove('hidden');
      }
      
      playMusic();
    }

    function playMusic() {
      if (!audio) return;
      audio.play().then(() => {
        isPlaying = true;
        const icon = document.getElementById('music-icon');
        if (icon) icon.className = "fa-solid fa-compact-disc fa-spin";
      }).catch(err => {
        console.log("Autoplay ditunda oleh browser.");
      });
    }

    function toggleMusic() {
      if (!audio) return;
      const icon = document.getElementById('music-icon');
      if (isPlaying) {
        audio.pause();
        isPlaying = false;
        if (icon) icon.className = "fa-solid fa-play";
        showToast("Musik dinonaktifkan", "info");
      } else {
        audio.play();
        isPlaying = true;
        if (icon) icon.className = "fa-solid fa-compact-disc fa-spin";
        showToast("Musik diaktifkan kembali", "success");
      }
    }

    // --- COUNTDOWN TIMER ---
    function initCountdown() {
      const targetDate = new Date("June 20, 2026 08:00:00").getTime();
      
      const interval = setInterval(function() {
        const now = new Date().getTime();
        const distance = targetDate - now;
        
        if (distance < 0) {
          clearInterval(interval);
          document.getElementById("days").innerText = "00";
          document.getElementById("hours").innerText = "00";
          document.getElementById("minutes").innerText = "00";
          document.getElementById("seconds").innerText = "00";
          return;
        }
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        document.getElementById("days").innerText = String(days).padStart(2, '0');
        document.getElementById("hours").innerText = String(hours).padStart(2, '0');
        document.getElementById("minutes").innerText = String(minutes).padStart(2, '0');
        document.getElementById("seconds").innerText = String(seconds).padStart(2, '0');
      }, 1000);
    }

    // --- NAVIGATOR ACTIVE STATE ---
    function scrollToSection(id, btnElement) {
      const el = document.getElementById(id);
      if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
      }
      
      document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('text-sage-600', 'font-semibold');
        item.classList.add('text-slate-400');
      });
      
      btnElement.classList.remove('text-slate-400');
      btnElement.classList.add('text-sage-600', 'font-semibold');
    }

    // --- CHART.JS INITIALIZER ---
    function initChart() {
      const canvas = document.getElementById('unionChart');
      if (!canvas) return;
      const ctx = canvas.getContext('2d');
      new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ['Keluarga Ega (Indramayu)', 'Keluarga Nia (Tangerang)'],
          datasets: [{
            data: [50, 50],
            backgroundColor: ['#567c69', '#c59f71'],
            borderWidth: 0
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          plugins: {
            legend: {
              display: false
            }
          },
          cutout: '75%'
        }
      });
    }

    // --- TIMELINE PROGRESS BAR ---
    function initProgressBar() {
      const creationDate = new Date("January 1, 2026").getTime();
      const targetDate = new Date("June 20, 2026").getTime();
      const now = new Date().getTime();
      
      const total = targetDate - creationDate;
      const passed = now - creationDate;
      
      let percentage = Math.floor((passed / total) * 100);
      if (percentage < 0) percentage = 0;
      if (percentage > 100) percentage = 100;
      
      const textProgress = document.getElementById('txt-progress-p');
      const barProgress = document.getElementById('bar-progress-p');
      if (textProgress) textProgress.innerText = percentage + "%";
      if (barProgress) barProgress.style.width = percentage + "%";
    }

    // --- GOOGLE MAPS REDIRECT ---
    function openMaps() {
      window.open("https://maps.google.com/?q=Kampung+Jati+Jatiuwung+Cibodas+Tangerang", "_blank");
    }

    // --- REKENING COPY TO CLIPBOARD ---
    function copyAccount(accNumber, person = "ega") {
      const tempInput = document.createElement("input");
      tempInput.value = accNumber;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand("copy");
      document.body.removeChild(tempInput);
      
      showToast(`No. Rekening ${person === 'ega' ? 'Ega' : 'Nia'} berhasil disalin!`, "success");
    }

    // --- AI/STATS SUB TAB SWAP ---
    function switchHubTab(tabId) {
      if (tabId === 'hub-ai') {
        document.getElementById('hub-ai').classList.remove('hidden');
        document.getElementById('hub-stats').classList.add('hidden');
        document.getElementById('btn-hub-ai').className = "flex-1 py-2 text-xs font-semibold rounded-xl bg-white text-sage-800 shadow-sm transition-all";
        document.getElementById('btn-hub-stats').className = "flex-1 py-2 text-xs font-semibold rounded-xl text-slate-600 hover:text-slate-800 transition-all";
      } else {
        document.getElementById('hub-ai').classList.add('hidden');
        document.getElementById('hub-stats').classList.remove('hidden');
        document.getElementById('btn-hub-ai').className = "flex-1 py-2 text-xs font-semibold rounded-xl text-slate-600 hover:text-slate-800 transition-all";
        document.getElementById('btn-hub-stats').className = "flex-1 py-2 text-xs font-semibold rounded-xl bg-white text-sage-800 shadow-sm transition-all";
      }
    }

    // --- AI WRITING ASSISTANT MODAL (WISH GENERATOR) ---
    function openAiGenerator() {
      document.getElementById('ai-modal').classList.remove('hidden');
      document.getElementById('ai-result-box').classList.add('hidden');
    }

    function closeAiGenerator() {
      document.getElementById('ai-modal').classList.add('hidden');
    }

    async function callGeminiAPI(payload, type = "chat") {
      let delay = 1000;
      for (let attempt = 1; attempt <= 5; attempt++) {
        try {
          const response = await fetch(`https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-preview-09-2025:generateContent?key=${apiKey}`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload)
          });
          
          if (!response.ok) throw new Error("API call failed");
          const result = await response.json();
          return result;
        } catch (error) {
          if (attempt === 5) throw error;
          await new Promise(resolve => setTimeout(resolve, delay));
          delay *= 2;
        }
      }
    }

    async function generateAiWish() {
      const relation = document.getElementById('ai-relation').value;
      const tone = document.getElementById('ai-tone').value;
      const btn = document.getElementById('btn-generate-ai');
      const icon = document.getElementById('icon-ai-spin');
      
      btn.disabled = true;
      icon.classList.remove('hidden');
      
      const promptText = `Saya adalah ${relation}. Buatkan pesan ucapan selamat pernikahan yang indah, tulus, dan berkesan untuk kedua mempelai bernama Ega dan Nia. Tuliskan dalam nada: ${tone}. Tuliskan langsung pesan ucapannya saja tanpa kalimat pengantar tambahan, ramah, gunakan bahasa Indonesia.`;
      
      const payload = {
        contents: [{ parts: [{ text: promptText }] }]
      };

      try {
        const result = await callGeminiAPI(payload, "text");
        const generatedText = result.candidates?.[0]?.content?.parts?.[0]?.text || "Selamat menempuh hidup baru Ega & Nia, semoga samawa selamanya!";
        
        document.getElementById('ai-result-text').innerText = generatedText.trim();
        document.getElementById('ai-result-box').classList.remove('hidden');
      } catch (err) {
        showToast("Gagal memanggil AI. Silakan coba sesaat lagi.", "error");
      } finally {
        btn.disabled = false;
        icon.classList.add('hidden');
      }
    }

    function useAiWish() {
      const text = document.getElementById('ai-result-text').innerText;
      document.getElementById('textarea-wish').value = text;
      closeAiGenerator();
      showToast("Ucapan berhasil dimasukkan ke form!", "success");
    }

    // --- AI CHATBOT VIRTUAL "SARI" ---
    function sendQuickPrompt(promptText) {
      document.getElementById('chat-input').value = promptText;
      handleChatSubmit();
    }

    async function handleChatSubmit() {
      const inputEl = document.getElementById('chat-input');
      const messageText = inputEl.value.trim();
      if (!messageText) return;

      inputEl.value = "";
      
      const chatBox = document.getElementById('chat-box');
      chatBox.innerHTML += `
        <div class="flex gap-2 justify-end">
          <div class="bg-sage-600 text-white p-2.5 rounded-2xl shadow-sm max-w-[80%]">
            ${messageText}
          </div>
          <div class="w-6 h-6 rounded-full bg-sage-500 text-white flex items-center justify-center font-bold text-[9px] shrink-0">U</div>
        </div>
      `;
      chatBox.scrollTop = chatBox.scrollHeight;

      const loadingId = "msg-" + Date.now();
      chatBox.innerHTML += `
        <div class="flex gap-2" id="${loadingId}">
          <div class="w-6 h-6 rounded-full bg-sage-100 text-sage-700 flex items-center justify-center font-bold text-[9px] shrink-0">S</div>
          <div class="bg-white p-2.5 rounded-2xl shadow-sm max-w-[80%] border border-slate-100 flex items-center gap-2 text-slate-400">
            <i class="fa-solid fa-spinner fa-spin"></i> Sedang berpikir...
          </div>
        </div>
      `;
      chatBox.scrollTop = chatBox.scrollHeight;

      chatHistory.push({ role: "user", parts: [{ text: messageText }] });

      try {
        const payload = {
          contents: chatHistory
        };
        const result = await callGeminiAPI(payload, "chat");
        const replyText = result.candidates?.[0]?.content?.parts?.[0]?.text || "Maaf, saya sedang mengalami gangguan sementara.";

        const loadingBubble = document.getElementById(loadingId);
        if (loadingBubble) {
          loadingBubble.innerHTML = `
            <div class="w-6 h-6 rounded-full bg-sage-100 text-sage-700 flex items-center justify-center font-bold text-[9px] shrink-0">S</div>
            <div class="bg-white p-2.5 rounded-2xl shadow-sm max-w-[80%] border border-slate-100">
              ${replyText.trim()}
            </div>
          `;
        }

        chatHistory.push({ role: "model", parts: [{ text: replyText }] });

      } catch (err) {
        const loadingBubble = document.getElementById(loadingId);
        if (loadingBubble) {
          loadingBubble.innerHTML = `
            <div class="w-6 h-6 rounded-full bg-sage-100 text-sage-700 flex items-center justify-center font-bold text-[9px] shrink-0">S</div>
            <div class="bg-red-50 text-red-600 p-2.5 rounded-2xl shadow-sm max-w-[80%] border border-red-100">
              Maaf, gagal memproses jawaban. Silakan tanyakan hal lain.
            </div>
          `;
        }
      } finally {
        chatBox.scrollTop = chatBox.scrollHeight;
      }
    }


    // --- REAL-TIME SUPABASE GUESTBOOK MECHANISM ---
    const localFallbackKey = `guestbook_backup_${appId}`;

    function getSupabaseHeaders() {
      return {
        "apikey": supabaseAnonKey,
        "Authorization": `Bearer ${supabaseAnonKey}`,
        "Content-Type": "application/json",
        "Prefer": "return=representation"
      };
    }

    async function loadWishes() {
      const wishesList = document.getElementById('wishes-list');
      
      if (!supabaseUrl || !supabaseAnonKey) {
        setTimeout(() => {
          const localData = JSON.parse(localStorage.getItem(localFallbackKey) || "[]");
          renderWishes(localData);
          showToast("Berjalan dalam offline/local mode", "info");
        }, 800);
        return;
      }

      try {
        const response = await fetch(`${supabaseUrl}/rest/v1/rsvp_guestbook?order=created_at.desc`, {
          method: "GET",
          headers: getSupabaseHeaders()
        });

        if (!response.ok) throw new Error("Gagal mengambil data.");
        const data = await response.json();
        renderWishes(data);
      } catch (err) {
        console.error(err);
        showToast("Koneksi cloud bermasalah. Memuat data lokal.", "error");
        const localData = JSON.parse(localStorage.getItem(localFallbackKey) || "[]");
        renderWishes(localData);
      }
    }

    function renderWishes(list) {
      const wishesList = document.getElementById('wishes-list');
      const countSpan = document.getElementById('count-ucapan');
      if (!wishesList || !countSpan) return;
      
      wishesList.innerHTML = "";
      countSpan.innerText = list.length;

      if (list.length === 0) {
        wishesList.innerHTML = `
          <div class="text-center py-8 text-slate-400 text-xs">
            <i class="fa-solid fa-feather text-lg mb-2 text-slate-300"></i>
            <p>Belum ada ucapan. Jadilah yang pertama memberikan doa!</p>
          </div>
        `;
        return;
      }

      list.forEach(item => {
        const timeStr = item.created_at ? new Date(item.created_at).toLocaleDateString('id-ID', {
          day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit'
        }) : "Baru saja";

        let badgeColor = "bg-emerald-50 text-emerald-700";
        if (item.kehadiran === "Tidak Hadir") badgeColor = "bg-rose-50 text-rose-600";
        if (item.kehadiran === "Masih Ragu") badgeColor = "bg-amber-50 text-amber-600";

        wishesList.innerHTML += `
          <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex gap-3">
            <div class="w-8 h-8 rounded-full bg-sage-100 text-sage-700 font-bold flex items-center justify-center text-xs shrink-0 uppercase">
              ${item.nama.substring(0, 2)}
            </div>
            <div class="flex-grow space-y-1 text-xs">
              <div class="flex justify-between items-center">
                <span class="font-bold text-slate-800">${escapeHTML(item.nama)}</span>
                <span class="text-[9px] text-slate-400">${timeStr}</span>
              </div>
              <div class="flex gap-1.5 items-center">
                <span class="px-2 py-0.5 rounded-full ${badgeColor} text-[9px] font-bold">${item.kehadiran}</span>
                <span class="text-[9px] text-slate-400">${item.pax} Pax</span>
              </div>
              <p class="text-slate-600 leading-relaxed pt-1 font-serif italic">${escapeHTML(item.pesan)}</p>
            </div>
          </div>
        `;
      });
    }

    async function handleFormSubmit(event) {
      event.preventDefault();
      
      const btn = document.getElementById('btn-submit');
      const nama = document.getElementById('input-name').value.trim();
      const kehadiran = document.getElementById('select-kehadiran').value;
      const pax = document.getElementById('select-pax').value;
      const pesan = document.getElementById('textarea-wish').value.trim();
      
      btn.disabled = true;
      btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Mengirim ucapan...`;

      const record = {
        nama,
        kehadiran,
        pax: parseInt(pax),
        pesan,
        created_at: new Date().toISOString()
      };

      const localData = JSON.parse(localStorage.getItem(localFallbackKey) || "[]");
      localData.unshift(record);
      localStorage.setItem(localFallbackKey, JSON.stringify(localData));

      if (supabaseUrl && supabaseAnonKey) {
        try {
          const response = await fetch(`${supabaseUrl}/rest/v1/rsvp_guestbook`, {
            method: "POST",
            headers: getSupabaseHeaders(),
            body: JSON.stringify(record)
          });
          if (!response.ok) throw new Error("Supabase rejected");
          showToast("RSVP & Ucapan berhasil terkirim!", "success");
        } catch (err) {
          console.error(err);
          showToast("Gagal menyimpan ke cloud, ucapan disimpan secara lokal.", "warning");
        }
      } else {
        showToast("Ucapan disimpan lokal", "success");
      }

      document.getElementById('rsvp-form').reset();
      btn.disabled = false;
      btn.innerHTML = `<i class="fa-solid fa-paper-plane"></i> Kirim RSVP & Ucapan`;
      
      loadWishes();
    }

    function escapeHTML(str) {
      return str.replace(/[&<>'"]/g, 
        tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
      );
    }
  </script>
</body>
</html>
