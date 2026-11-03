# DESIGN.md — Sistem Desain Aplikasi & Dashboard "AI Health" (Desktop & Responsive)

> Dokumen acuan sistem desain antarmuka komprehensif untuk aplikasi layanan kesehatan modern **AI Health**.
> Mengintegrasikan arsitektur **Desktop 3-Zona** (*Sidebar*, *Main Content Area*, *Sticky Booking Panel*) dengan adaptasi responsif menyeluruh (*Tablet* dan *Mobile*). 
> Diturunkan dan diselaraskan penuh dengan spesifikasi `DESIGN-desktop.md` serta implementasi referensi `AI Health — Desktop.html`.

---

## 1. Ringkasan & Filosofi Desain

**Karakter Produk:**
Tenang, bersih, tepercaya, dan bernuansa modern-medis. Mengedepankan integrasi kecerdasan buatan (*AI-assisted healthcare*) tanpa mengorbankan kehangatan interaksi manusia (foto/inisial dokter yang prominent, sapaan personal, informasi yang transparan dan mudah diakses).

**5 Prinsip Desain Utama:**

1. **Satu Layar, Tiga Zona Terpadu (*One Screen, Three Zones*)**
   Di layar desktop, pengguna dapat mengakses seluruh alur kerja medis dalam satu kanvas tanpa perpindahan halaman yang membingungkan:
   - **Zona Kiri (Sidebar):** Navigasi platform, identitas merek, dan kartu akses asisten AI.
   - **Zona Tengah (Area Utama):** Penelusuran dokter, sapaan personal, ringkasan *Next Appointment*, filter spesialisasi, dan katalog dokter.
   - **Zona Kanan (Panel Sticky Detail & Booking):** Informasi mendalam dokter terpilih, metrik pengalaman/ketersediaan, pemilih jadwal mingguan, slot waktu konsultasi, dan tombol reservasi instan.

2. **Calm & Clinical (Nuansa Tenang & Bersih)**
   Dominasi palet warna teal medis yang sejuk dengan latar kanvas lembut (`#EEF4F4`), bukan warna biru rumah sakit yang kaku atau putih datar yang menyilaukan. Dilengkapi dukungan mode gelap penuh (`#0F1E21`).

3. **Soft Depth & Geometry yang Membulat**
   Kartu putih mengambang dengan sudut lengkung ramah (*radius 14–24 px*), elevasi bayangan berdimensi halus (*tinted shadow* hijau kebiruan transparan), serta aksen *frosted glass* pada elemen pelengkap.

4. **Human-First, AI-Amplified**
   Teknologi AI hadir sebagai akselerator dan asisten pendamping, sementara figur dokter tetap menjadi pusat visual utama melalui kartu profil yang ramah dan metrik kredibilitas (rating, pasien, durasi pengalaman).

5. **Responsivitas Adaptif & Aksesibilitas Tinggi**
   Elemen antarmuka secara alami beradaptasi di seluruh rentang ukuran layar (*xl*, *lg*, *md*, *sm*) dengan navigasi ramah keyboard (*focus rings* terdefinisi) dan target sentuh ramah jari.

---

## 2. Design Tokens

### 2.1 Palet Warna & Semantic Tokens

| Token | Nilai Hex (Light) | Nilai Hex (Dark) | Peruntukan / Penggunaan |
|---|---|---|---|
| `--color-primary` / `--primary` | `#2A8A8C` | `#2A8A8C` | Tombol CTA utama, status aktif, link aksen, outline terpilih |
| `--color-primary-dark` / `--primary-dark` | `#2D6471` | `#2D6471` | Tanggal terpilih, chip kategori aktif, state kontras tinggi |
| `--color-primary-deep` / `--primary-deep` | `#1F6F73` | `#1F6F73` | Warna pangkal gradien desktop, avatar dokter |
| `--color-primary-soft` / `--soft` | `#CFE3E2` | `#2A4B50` | Latar belakang frame foto dokter, aksen lembut |
| `--color-primary-tint` / `--tint` | `#E4F0EF` | `#1F3A3E` | Latar menu aktif sidebar, stat icon, pricing header |
| `--color-bg-app` / `--bg` | `#EEF4F4` | `#0F1E21` | Latar belakang seluruh aplikasi (kanvas dasar) |
| `--color-surface` / `--surface` | `#FFFFFF` | `#17292D` | Kartu putih, sidebar, panel kanan, input field |
| `--color-text` / `--text` | `#0E2A2D` | `#E8F1F1` | Teks utama, judul, nama dokter, harga |
| `--color-text-secondary` / `--text2` | `#5B6B6E` | `#9DB2B5` | Spesialisasi dokter, label pendukung, subjudul |
| `--color-text-muted` / `--muted` | `#8A9699` | `#7F9498` | Placeholder pencarian, label waktu tidak aktif, teks caption |
| `--color-border` / `--border` | `#DDE6E8` | `#264045` | Garis batas kartu, pemisah sidebar, divider slot waktu |
| `--color-rating` / `--rating` | `#F5A623` | `#F5A623` | Bintang rating dokter |
| `--color-focus-ring` / `--focus` | `rgba(42,138,140,0.35)` | `rgba(42,138,140,0.45)` | Focus ring saat navigasi keyboard (`0 0 0 3px`) |

### 2.2 Gradien Khas (*Signatures*)

- **Desktop Banner & AI Promo Card:**
  ```css
  linear-gradient(135deg, #1F6F73 0%, #2F8386 45%, #6FA9AA 100%)
  ```
- **Mobile Header Hero:**
  ```css
  linear-gradient(180deg, #2F8386 0%, #6FA9AA 45%, #CFE3E2 100%)
  ```
- **Avatar Inisial Standar:**
  ```css
  linear-gradient(135deg, #5aa6a8 0%, #1F6F73 100%)
  ```
- **Pricing Card (Vertical Subtle Tint):**
  ```css
  linear-gradient(180deg, var(--color-primary-tint) 0%, var(--color-surface) 100%)
  ```

### 2.3 Tipografi & Skala Teks

**Keluarga Font:** `"Plus Jakarta Sans", "Inter", system-ui, -apple-system, sans-serif`

| Tingkat / Token | Ukuran / Berat | Line Height | Contoh Penggunaan |
|---|---|---|---|
| `display-h1` | 32 px / SemiBold (600) | 1.20 | Headline banner sapaan ("What’s on your health today?") |
| `h2` | 22 px / SemiBold (600) | 1.25 | Judul bagian ("Find a Doctor") |
| `h3` | 19–20 px / SemiBold (600) | 1.25 | Nama dokter di panel detail ("Dr. Anaya Kapoor") |
| `price-large` | 23–24 px / Bold (700) | 1.10 | Harga sesi konsultasi di panel kanan ("$18.0") |
| `title-card` | 14–15 px / SemiBold (600) | 1.30 | Nama dokter pada kartu grid, nama user |
| `body` | 14 px / Regular (400) | 1.45 | Teks standar deskripsi, placeholder input |
| `label-ui` | 12–13 px / Medium (500) | 1.30 | Menu sidebar, chip kategori, tombol aksi |
| `caption` | 11–12 px / Regular (400) | 1.30 | Subspesialisasi, "/per session", tanggal appointment |
| `micro` | 9.5–10.5 px / Medium (500) | 1.20 | Label stat tile (Availability, Experience, Patients) |

### 2.4 Sistem Spasi & Radius

- **Skala Spasi (Base 4 px):** `4 · 8 · 12 · 16 · 20 · 24 · 32 · 40 px`
  - Padding kanvas area utama: **20px 32px 32px**
  - Jarak antar zona/kolom: **0 px** (dipisahkan garis batas `1px solid var(--color-border)`)
  - Gap kartu dokter di grid: **16–20 px**
  - Gap antar stat tiles: **8 px**

- **Skala Radius Lengkung:**
  | Token | Nilai | Penggunaan |
  |---|---|---|
  | `radius.xs` | 8–10 px | Slot waktu jam konsultasi, pill rating kecil |
  | `radius.sm` | 12–14 px | Tile tanggal mingguan, foto dokter mini |
  | `radius.md` | 16–18 px | Tombol CTA booking, stat tile, kartu AI Assistant |
  | `radius.lg` | 20–24 px | Kartu dokter di grid, kartu next appointment, banner utama |
  | `radius.pill` | 999 px | Pill input pencarian, chip spesialisasi, badge rating, avatar bulat |

### 2.5 Elevasi, Bayangan & Efek Visual

| Token | Nilai CSS | Karakteristik |
|---|---|---|
| `shadow.card` | `0 8px 24px rgba(20, 70, 75, 0.12)` | Bayangan lembut mengambang pada kartu appointment & hover kartu |
| `shadow.soft` | `0 2px 8px rgba(20, 70, 75, 0.08)` | Bayangan resting pada kartu dokter dan stat tiles |
| `effect.glass` | `background: rgba(255,255,255,0.22); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.35)` | Tombol aksi transparan di atas gradien |
| `focus.ring` | `0 0 0 3px rgba(42, 138, 140, 0.35)` | Lingkar fokus aksesibilitas untuk keyboard navigation |

---

## 3. Arsitektur Grid & Breakpoint Responsif

### 3.1 Skema Grid 3-Zona Desktop (Maksimum 1440 px)

Aplikasi dibangun menggunakan **CSS Grid** adaptif dengan lebar maksimum `1440px` rata tengah:

```css
.app-container {
  display: grid;
  grid-template-columns: var(--sidebar-w, 240px) 1fr var(--panel-w, 360px);
  min-height: 100vh;
  max-width: 1440px;
  margin: 0 auto;
}
```

### 3.2 Diagram Visual Antarmuka Desktop

```
┌──────────────┬─────────────────────────────────────────────────┬────────────────────────┐
│ [Logo] AI    │ [ 🔍 Cari dokter atau spesialis... ]  (🔔) (RA) │ (AK) Dr. Anaya Kapoor  │
│              ├─────────────────────────────────────────────────┤ ★ 4.7   Neurologist    │
│ ● Beranda    │ ┌ Banner Sapaan (Gradien) ────────────────────┐ │ ┌────────────────────┐ │
│ ○ Jadwal     │ │ Good afternoon,      ┌ Next Appointment ──┐ │ │ Starting from        │ │
│ ○ Dokter     │ │ What’s on your       │ (SM) Dr. Saran M.  │ │ │ $18.0 /per session   │ │
│ ○ Rekam      │ │ health today?        │ [Resched] [Join]   │ │ │ [Avail] [Exp] [Pts]  │ │
│ ○ Setting    │ └──────────────────────┴────────────────────┘ │ └────────────────────┘ │
│              │                                                 │ Select a date & time   │
│              │ (Semua) (Bone) (Brain) (Dental) (Digestion) ... │ [Su][Mo][Tu][We][Th].. │
│              │                                                 │ [09AM] [10AM] [01PM].. │
│ ┌──────────┐ │ Find a Doctor                          View All │                        │
│ │AI Assist │ │ ┌──────┐ ┌──────┐ ┌──────┐ ┌──────┐             │                        │
│ │Konsultasi│ │ │ Card │ │ Card │ │*Card*│ │ Card │   (Doctor   │                        │
│ │gejala... │ │ │      │ │      │ │(Sel) │ │      │    Grid)    │ ┌────────────────────┐ │
│ └──────────┘ │ └──────┘ └──────┘ └──────┘ └──────┘             │ │ [ Book a Session ] │ │
└──────────────┴─────────────────────────────────────────────────┴─┴────────────────────┴─┘
 (Zona 1: Side)                    (Zona 2: Main)                     (Zona 3: Panel Kanan)
```

### 3.3 Spesifikasi Breakpoint

| Breakpoint | Rentang Layar | Komposisi Tata Letak (*Layout Behavior*) |
|---|---|---|
| **xl** (Desktop Penuh) | `≥ 1280 px` | 3 Kolom penuh: Sidebar `240px`, Main `1fr`, Panel Kanan `360px`. Semua label menu terlihat. |
| **lg** (Laptop / Layar Sedang) | `1024–1279 px` | Sidebar ringkas `72px` (ikon saja), Main `1fr`, Panel Kanan `340px`. Card promo AI disembunyikan. |
| **md** (Tablet) | `768–1023 px` | Sidebar `72px`, Main `1fr`. Panel Kanan turun menjadi section di bawah konten dokter (*stacked*). |
| **sm** (Mobile / Ponsel) | `< 768 px` | 1 Kolom penuh (*fluid*). Sidebar digantikan oleh *Floating Bottom Navigation*, detail dokter dibuka via *Modal Bottom Sheet*. |

---

## 4. Spesifikasi Komponen

### 4.1 Sidebar Navigasi (Zona 1)
- **Struktur:** Sticky di tepi kiri sepanjang viewport (`height: 100vh`). Berisi Header Logo, Navigasi Vertikal, dan Kartu AI Assistant.
- **Brand Logo:** Ikon kotak teal `36×36 px` (radius 12 px) dengan simbol `plus`, berdampingan dengan teks "AI Health" (tebal, 17 px).
- **Item Menu Navigasi:**
  - Tombol setinggi `44 px`, padding `11px 12px`, radius 12 px.
  - **State Default:** Teks dan ikon `color.text-secondary`, transisi latar halus pada hover (`color.primary-tint` 60%).
  - **State Aktif:** Latar `color.primary-tint`, teks dan ikon `color.primary`, dengan aksen vertikal kiri selebar `3 px` berwarna `color.primary`.
- **AI Assistant Card:** Terletak di bagian bawah sidebar (`margin-top: auto`), berlatar gradien desktop, teks putih bersih, ikon sparkle, memberikan arahan cepat fitur triase medis AI.

### 4.2 Top Bar & Header Navigasi
- **Search Pill Input:** Lebar fleksibel `360–480 px`, tinggi `44 px`, sudut membulat penuh (`999 px`), border `1px solid var(--color-border)`. Fokus visual ditandai dengan perubahan ring `var(--focus)`.
- **Theme Switcher & Notification:** Tombol ikon bulat `44×44 px`, latar `color.surface`, border halus, hover efek border primary.
- **User Profile Pill:** Menampilkan avatar inisial bulat (`44×44 px`), sapaan nama pengguna ("Rina Anggraini"), dan label peran ("Pasien").

### 4.3 Greeting Banner & Integrated Appointment Card
- **Banner Utama:** Tinggi dinamis `±180 px`, radius `24 px`, background gradien khas 135°, padding `28 px`.
- **Teks Banner:** Salam ramah ("Good afternoon,") dan pertanyaan sapaan ("What’s on your health today?") dengan tipografi 30–32 px.
- **Next Appointment Card Terintegrasi:**
  - Kartu putih `width: 370–380 px`, radius `22 px`, mengambang dengan bayangan `shadow.card`.
  - Memuat avatar dokter `52×52 px`, nama dokter, spesialisasi, jadwal tanggal & jam.
  - Dua tombol aksi terbagi rata: **Reschedule** (tombol sekunder bergaris batas) dan **Join Call** (tombol primer teal dengan ikon kamera video).

### 4.4 Specialty Filter Chips
- Deretan tombol kategori berbentuk *pill* tinggi `36 px`, padding horizontal `16 px`, radius `999 px`.
- **Kategori Standar:** `Semua` (All), `Bone` (Orthopedist), `Brain expert` (Neurologist), `Dental` (Dentist), `Digestion` (Gastroenterologist), `Heart` (Cardiologist).
- **State Interaksi:**
  - *Default:* Latar `color.surface`, border `color.border`, teks `color.text-secondary`. Hover mengubah border ke teal.
  - *Aktif:* Latar dan border `color.primary-dark` (`#2D6471`), teks putih solid, memberikan penegasan kategori aktif.

### 4.5 Doctor Card & Grid Penelusuran
- **Tata Letak Grid:** `grid-template-columns: repeat(auto-fill, minmax(200px, 1fr))` dengan celah `16–20 px`.
- **Anatomi Kartu Dokter:**
  - Container kartu putih `radius: 20 px`, padding `10 px`, border `2px solid transparent`.
  - **Frame Foto/Avatar:** Tinggi `130 px`, radius `14 px`, background `color.primary-soft` (`#CFE3E2`), menampilkan inisial avatar besar (`72×72 px`) atau foto potret dokter.
  - **Rating Badge:** Pill putih mengambang di sudut kiri atas foto, memuat bintang emas `color.rating` dan angka rating (misal: "★ 4.9").
  - **Metadata:** Nama dokter (13.5–14 px tebal), spesialisasi (12 px secondary), tarif konsultasi (12.5 px tebal teal) + keterangan "/per session" (10.5 px muted).
- **State Interaktif:**
  - *Hover:* Mengangkat kartu ke atas `translateY(-2px)` dengan peningkatan bayangan `shadow.card`.
  - *Terpilih (Selected):* Border berubah menjadi `2px solid var(--color-primary)`, secara langsung mengalirkan data dokter ke Panel Kanan.

### 4.6 Panel Kanan (Sticky Detail & Booking Panel)
Panel permanen di sisi kanan desktop (`width: 360 px`, sticky viewport, scroll independen):
1. **Header Dokter:** Avatar `80–84 px`, nama dokter besar, spesialisasi, dan ulasan rating bintang.
2. **Pricing & Stat Card:** Latar gradien vertikal dari tint teal ke putih, menampilkan tarif dasar konsultasi serta 3 *stat tiles*:
   - *Availability:* (Ikon jam) Jam operasional (misal: "9AM - 8PM").
   - *Experience:* (Ikon kalender) Masa praktik (misal: "12 years").
   - *Patients:* (Ikon pengguna) Jumlah pasien tertangani (misal: "4.6k Up").
3. **Weekly Date Strip Picker:** 7 kolom hari (Su, Mo, Tu, We, Th, Fr, Sa) dengan angka tanggal. Hari aktif disorot dengan latar `color.primary-dark` dan teks putih.
4. **Time Slot Selector:** 6 slot waktu dalam format grid 3 kolom (`09 AM`, `10 AM`, `11 AM`, `12 PM`, `01 PM`, `02 PM`). Slot terpilih memiliki latar tint teal dan border primary.
5. **Sticky Booking Button:** Tombol "Book a Session" berketinggian `50 px`, radius `16 px`, melayang di bagian bawah panel dengan gradien penahan latar.

### 4.7 Toast Notification
- Komponen notifikasi mengambang di pojok kanan atas (`position: fixed; right: 24px; top: 24px; z-index: 99`).
- Berlatar gelap `color.text` (`#0E2A2D`) dengan teks putih, meluncur halus dari atas (*transform translateY*) dan menghilang otomatis setelah `2.5 detik`.

---

## 5. Alur Interaksi & State Management

```
[Pengguna mengetik di Search Bar] ──► Filter nama dokter & spesialisasi secara live
[Pengguna klik Chip Kategori]     ──► Filter dokter sesuai data-category
[Pengguna klik Kartu Dokter]      ──► Tandai kartu (border teal) + Update data panel kanan
[Pengguna memilih Tanggal / Jam]  ──► Update state tanggal & slot waktu sesi
[Pengguna klik "Book a Session"]  ──► Tampilkan Toast konfirmasi pemesanan sukses
```

1. **Sinkronisasi Data Dua Arah:** Pemilihan kartu dokter pada grid tengah langsung memperbarui nama, inisial, spesialisasi, rating, tarif, ketersediaan, pengalaman, dan jumlah pasien di panel kanan tanpa jeda.
2. **Kombinasi Filter Multikriteria:** Hasil pencarian dihitung berdasarkan persilangan kategori aktif (`category === 'all' || doc.category === cat`) DAN kata kunci pencarian (`(name + specialty).includes(query)`).
3. **Empty State:** Jika kombinasi pencarian tidak menghasilkan dokter, sistem memunculkan pesan informatif ramah: *"Dokter tidak ditemukan."*.

---

## 6. Standar Aksesibilitas (WCAG 2.1 AA)

- **Semantic HTML & Landmark:** Menggunakan elemen semantik baku `<aside class="side">`, `<main>`, `<aside class="panel">`, `<nav>`, `<header>`, dan seluruh elemen yang dapat diklik adalah elemen `<button>` atau tautan ber-URL valid.
- **Kontras Rasio:** Seluruh teks utama dan teks kecil memiliki kontras di atas ambang batas aman 4.5:1 terhadap latar belakangnya.
- **Keyboard Navigation:** Setiap tombol dan input memiliki penanda fokus visual terstandar `var(--focus)`.
- **Target Sentuh Minimum:** Komponen sentuhan/klik dirancang dengan area efektif minimal `40×40 px`.
- **Motion Reduction:** Mendukung query media `@media (prefers-reduced-motion: reduce)` yang mematikan transisi berlebih untuk kenyamanan pengguna sensitif.

---

## 7. Acuan Implementasi Token CSS (`:root`)

Berikut token CSS resmi yang menjadi acuan implementasi kode antarmuka pada platform:

```css
:root {
  /* Core Colors */
  --color-primary: #2A8A8C;
  --color-primary-dark: #2D6471;
  --color-primary-deep: #1F6F73;
  --color-primary-soft: #CFE3E2;
  --color-primary-tint: #E4F0EF;
  --color-bg-app: #EEF4F4;
  --color-surface: #FFFFFF;
  --color-text: #0E2A2D;
  --color-text-secondary: #5B6B6E;
  --color-text-muted: #8A9699;
  --color-border: #DDE6E8;
  --color-rating: #F5A623;

  /* Gradients */
  --gradient-desktop: linear-gradient(135deg, #1F6F73 0%, #2F8386 45%, #6FA9AA 100%);
  --gradient-mobile: linear-gradient(180deg, #2F8386 0%, #6FA9AA 45%, #CFE3E2 100%);

  /* Shadows & Focus */
  --shadow-card: 0 8px 24px rgba(20, 70, 75, 0.12);
  --shadow-soft: 0 2px 8px rgba(20, 70, 75, 0.08);
  --focus-ring: 0 0 0 3px rgba(42, 138, 140, 0.35);

  /* Layout Dimensions */
  --sidebar-w: 240px;
  --sidebar-w-collapsed: 72px;
  --panel-w: 360px;
  --topbar-h: 72px;
  --max-width-canvas: 1440px;

  /* Typography */
  --font-app: "Plus Jakarta Sans", "Inter", system-ui, -apple-system, sans-serif;
}

/* Dark Theme Overrides */
@media (prefers-color-scheme: dark) {
  :root:not([data-theme="light"]) {
    --color-bg-app: #0F1E21;
    --color-surface: #17292D;
    --color-text: #E8F1F1;
    --color-text-secondary: #9DB2B5;
    --color-text-muted: #7F9498;
    --color-border: #264045;
    --color-primary-tint: #1F3A3E;
    --color-primary-soft: #2A4B50;
  }
}

:root[data-theme="dark"] {
  --color-bg-app: #0F1E21;
  --color-surface: #17292D;
  --color-text: #E8F1F1;
  --color-text-secondary: #9DB2B5;
  --color-text-muted: #7F9498;
  --color-border: #264045;
  --color-primary-tint: #1F3A3E;
  --color-primary-soft: #2A4B50;
}
```
