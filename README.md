Panduan Deploy & Setup Database Supabase - Ega & Nia WeddingProyek website undangan pernikahan digital interaktif premium ini sudah siap untuk di-upload ke GitHub dan di-deploy langsung ke Vercel serta dikoneksikan ke Supabase secara gratis.BAGIAN 1: Setup Database Supabase (Menampung Data Buku Tamu & RSVP)Ikuti langkah cepat berikut untuk membuat database real-time Anda:Buat Akun Supabase: Daftar atau login ke supabase.com.Buat Proyek Baru: Pilih tombol New Project, tentukan nama (misal: wedding-eganian), isi password database, lalu pilih lokasi server terdekat (Singapura).Buka SQL Editor:Di dasbor sisi kiri Supabase, klik ikon SQL Editor (ikon berbentuk lembaran kode dengan simbol petir).Klik tombol New Query.Jalankan Skrip SQL: Copy-paste kode SQL berikut ke dalam editor lalu klik Run:-- Membuat Tabel RSVP & Buku Tamu Pernikahan
CREATE TABLE rsvp_guestbook (
  id BIGSERIAL PRIMARY KEY,
  nama TEXT NOT NULL,
  kehadiran TEXT NOT NULL,
  pax INTEGER DEFAULT 1,
  pesan TEXT NOT NULL,
  created_at TIMESTAMPTZ DEFAULT NOW()
);

-- Mengaktifkan akses Row Level Security (RLS) agar publik bisa menulis dan membaca secara aman
ALTER TABLE rsvp_guestbook ENABLE ROW LEVEL SECURITY;

-- Membuat Kebijakan / Policy untuk akses baca publik (Semua orang bisa melihat ucapan)
CREATE POLICY "Allow public select" 
ON rsvp_guestbook FOR SELECT 
TO public 
USING (true);

-- Membuat Kebijakan / Policy untuk akses menulis publik (Tamu bisa mengirim RSVP)
CREATE POLICY "Allow public insert" 
ON rsvp_guestbook FOR INSERT 
TO public 
WITH CHECK (true);
Dapatkan API Keys Anda:Masuk ke menu Project Settings (ikon roda gigi di pojok kiri bawah).Klik sub-menu API.Salin nilai Project URL (misal: https://xxxxxx.supabase.co).Salin nilai Project API anon public key (kunci panjang di kolom anon/public).BAGIAN 2: Upload ke GitHubBuat sebuah repositori baru di GitHub (misal: undangan-eganian).Masukkan kedua file proyek ini (index.html dan README.md) ke dalam folder lokal Anda.Jalankan git init di terminal lokal atau gunakan web GitHub untuk langsung meng-upload berkas tersebut.BAGIAN 3: Deploy Cepat ke Vercel (Terintegrasi Environment Variables)Sistem telah dirancang agar API Keys tersimpan secara aman di Vercel:Pergi ke vercel.com dan masuk menggunakan akun GitHub Anda.Klik tombol Add New... -> Project.Cari dan hubungkan (Import) repositori GitHub undangan-eganian yang baru Anda buat.Pada bagian pengaturan proyek sebelum klik deploy, temukan bilah akordeon bernama Environment Variables lalu tambahkan dua key berikut:Name: SUPABASE_URL | Value: (Isi dengan Project URL Supabase Anda)Name: SUPABASE_ANON_KEY | Value: (Isi dengan Anon Public Key Supabase Anda)Klik tombol Deploy!Vercel akan memproses situs Anda hanya dalam hitungan detik dan memberikan tautan domain gratis berakhiran .vercel.app.Tips Tambahan: Mengirim Undangan dengan Nama Tamu KustomGunakan format URL berikut ketika membagikan tautan undangan agar nama tamu langsung tertulis secara personal:https://nama-proyek-anda.vercel.app/?to=Bapak+Jokowi+dan+Keluargahttps://nama-proyek-anda.vercel.app/?to=Nama+Sahabat+Karib
