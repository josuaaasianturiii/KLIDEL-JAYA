<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gabe Medica | Login — Masuk ke Portal Layanan</title>
  <link rel="icon" type="image/png" href="{{ asset('images/gabe-medica-icon.png') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Schibsted+Grotesk:wght@400;500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    :root {
      /* Colors - Gabe Medica Deep Royal Navy Brand Palette */
      --color-primary: #012D68;
      --color-primary-hover: #083E88;
      --color-primary-active: #01204C;
      --color-bg-page: #F3F6F9;
      --color-surface: #FFFFFF;
      --color-input-bg: #F3F5F8;
      --color-border: #D5DDE5;
      --color-text-primary: #0B1727;
      --color-text-secondary: #3D4853;
      --color-text-muted: #6B7988;
      --color-on-primary: #FFFFFF;
      --color-focus-ring: rgba(1, 45, 104, 0.28);
      --color-error: #D92D20;
      --color-success: #12B76A;

      /* Typography */
      --font-sans: "Schibsted Grotesk", "Plus Jakarta Sans", "Inter", system-ui, sans-serif;
      --fs-display: 40px;
      --fs-body: 14px;
      --fs-small: 12px;
      --fs-caption: 20px;

      /* Radius */
      --radius-card: 32px;
      --radius-control: 8px;

      /* Layout */
      --form-width: 360px;
      --control-height: 48px;
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: var(--font-sans);
      font-size: var(--fs-body);
      color: var(--color-text-primary);
      background: var(--color-bg-page);
      -webkit-font-smoothing: antialiased;
    }

    .login-page {
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 32px;
    }

    .login-card {
      display: grid;
      grid-template-columns: 1fr 1.2fr;
      gap: 40px;
      width: min(1120px, 100%);
      padding: 40px;
      background: var(--color-surface);
      border-radius: var(--radius-card);
      box-shadow: 0 1px 2px rgba(16, 24, 40, .04);
      animation: fade-up .4s ease-out both;
    }

    /* ---------- Form column ---------- */
    .login-form {
      width: 100%;
      max-width: var(--form-width);
      margin: auto;
      text-align: center;
    }

    .brand {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 24px;
      text-decoration: none;
      transition: transform .2s ease;
    }
    .brand:hover {
      transform: scale(1.02);
    }
    .brand img {
      height: 48px;
      width: auto;
      max-width: 230px;
      object-fit: contain;
    }

    /* Role Selector Pill Switch */
    .role-selector {
      display: flex;
      background: var(--color-input-bg);
      padding: 4px;
      border-radius: 12px;
      margin-bottom: 20px;
      gap: 4px;
      border: 1px solid var(--color-border);
    }
    .role-pill {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      padding: 8px 10px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 500;
      border: 0;
      cursor: pointer;
      background: transparent;
      color: var(--color-text-secondary);
      transition: all .15s ease-out;
      user-select: none;
    }
    .role-pill:hover {
      color: var(--color-text-primary);
    }
    .role-pill.active {
      background: #ffffff;
      color: var(--color-primary);
      font-weight: 600;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    h1 {
      margin: 0 0 4px;
      font-size: var(--fs-display);
      line-height: 1.1;
      font-weight: 700;
      letter-spacing: -0.5px;
    }
    .subtitle {
      margin: 0 0 24px;
      font-size: var(--fs-small);
      font-weight: 500;
      color: var(--color-text-secondary);
      transition: color .2s;
    }

    .btn {
      width: 100%;
      height: var(--control-height);
      border-radius: var(--radius-control);
      font: 500 var(--fs-body) var(--font-sans);
      cursor: pointer;
      transition: all .15s ease-out;
    }
    .btn:focus-visible,
    .field input:focus-visible,
    .check input:focus-visible,
    a:focus-visible,
    .toggle:focus-visible,
    .role-pill:focus-visible {
      outline: 0;
      box-shadow: 0 0 0 3px var(--color-focus-ring);
    }

    .btn-social {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 12px;
      background: #fff;
      border: 1px solid var(--color-border);
      color: var(--color-text-secondary);
    }
    .btn-social:hover { background: #F9FAFB; border-color: #BFC4CA; }
    .btn-social:active { background: #F2F4F7; }
    .btn-social svg { width: 18px; height: 18px; flex: none; }

    .btn-primary {
      margin-top: 20px;
      background: var(--color-primary);
      border: 0;
      color: var(--color-on-primary);
      box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15), 0 1px 2px rgba(92, 45, 79, .25);
    }
    .btn-primary:hover { background: var(--color-primary-hover); }
    .btn-primary:active { background: var(--color-primary-active); transform: translateY(1px); }
    .btn-primary[disabled] { opacity: .6; cursor: not-allowed; }

    .spinner {
      display: inline-block;
      width: 18px; height: 18px;
      border: 2px solid rgba(255, 255, 255, .4);
      border-top-color: #fff;
      border-radius: 50%;
      vertical-align: middle;
      animation: spin .7s linear infinite;
    }

    .divider {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 18px 0;
      color: var(--color-text-muted);
      font-size: var(--fs-small);
    }
    .divider::before,
    .divider::after {
      content: "";
      flex: 1;
      height: 1px;
      background: var(--color-border);
    }

    .field {
      position: relative;
      margin-bottom: 16px;
      text-align: left;
    }
    .field label {
      position: absolute;
      top: 9px;
      left: 14px;
      font-size: 11px;
      color: var(--color-text-muted);
      pointer-events: none;
    }
    .field input {
      width: 100%;
      height: 54px;
      padding: 24px 46px 6px 14px;
      background: var(--color-input-bg);
      border: 1.5px solid transparent;
      border-radius: var(--radius-control);
      font: 500 var(--fs-body) var(--font-sans);
      color: var(--color-text-primary);
      transition: all .15s ease-out;
    }
    .field input::placeholder { color: #A0A7B1; font-weight: 400; }
    .field input:hover { background: #EEF1F4; }
    .field input:focus { background: #fff; border-color: var(--color-primary); }
    .field.invalid input { border-color: var(--color-error); background: #fff; }

    .error-msg {
      display: none;
      margin: 6px 2px 0;
      font-size: var(--fs-small);
      color: var(--color-error);
    }
    .field.invalid .error-msg { display: block; }

    .toggle {
      position: absolute;
      right: 10px;
      top: 27px;
      transform: translateY(-50%);
      display: grid;
      place-items: center;
      width: 32px; height: 32px;
      background: none;
      border: 0;
      border-radius: 6px;
      color: var(--color-text-muted);
      cursor: pointer;
    }
    .toggle:hover { color: var(--color-text-primary); }
    .toggle svg { width: 20px; height: 20px; }
    .toggle .eye-off { display: none; }
    .toggle[aria-pressed="true"] .eye { display: none; }
    .toggle[aria-pressed="true"] .eye-off { display: block; }

    .row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: var(--fs-small);
    }
    .row a {
      color: var(--color-text-primary);
      font-weight: 500;
      text-decoration: underline;
    }
    .check {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }
    .check input {
      appearance: none;
      width: 16px; height: 16px;
      margin: 0;
      border: 1px solid #9CA3AF;
      border-radius: 3px;
      background: #fff;
      display: grid;
      place-items: center;
      cursor: pointer;
      transition: all .15s;
    }
    .check input:checked { background: var(--color-primary); border-color: var(--color-primary); }
    .check input:checked::after {
      content: "";
      width: 8px; height: 4px;
      border-left: 2px solid #fff;
      border-bottom: 2px solid #fff;
      transform: translateY(-1px) rotate(-45deg);
    }

    .form-alert {
      display: none;
      margin-bottom: 16px;
      padding: 10px 12px;
      border-radius: var(--radius-control);
      background: #FEF3F2;
      border: 1px solid #FDA29B;
      color: #B42318;
      font-size: var(--fs-small);
      text-align: left;
    }
    .form-alert.show { display: block; }
    .form-alert.ok { background: #ECFDF3; border-color: #6CE9A6; color: #067647; }

    .signup { margin: 18px 0 0; font-size: var(--fs-small); color: var(--color-text-secondary); }
    .signup a { color: var(--color-primary); font-weight: 500; text-decoration: none; }
    .signup a:hover { text-decoration: underline; }

    /* Quick Demo 1-Click Cards */
    .demo-section {
      margin-top: 20px;
      padding-top: 16px;
      border-top: 1px solid var(--color-border);
      text-align: center;
    }
    .demo-title {
      font-size: 11px;
      font-weight: 600;
      color: var(--color-text-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 10px;
    }
    .demo-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
    }
    .demo-pill {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 10px;
      border-radius: 10px;
      border: 1px solid var(--color-border);
      background: #fff;
      text-decoration: none;
      color: var(--color-text-primary);
      transition: all .15s ease-out;
      text-align: left;
    }
    .demo-pill:hover {
      border-color: var(--color-primary);
      background: #FDF9FB;
      transform: translateY(-1px);
    }
    .demo-avatar {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      font-size: 11px;
      font-weight: 700;
      flex-shrink: 0;
    }
    .demo-avatar.user-av { background: #E4F0EF; color: #1F6F73; }
    .demo-avatar.admin-av { background: #F3E8FF; color: #7E22CE; }
    .demo-text {
      min-width: 0;
      line-height: 1.2;
    }
    .demo-text strong {
      display: block;
      font-size: 11.5px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .demo-text small {
      display: block;
      font-size: 10px;
      color: var(--color-text-muted);
    }
    .back-link {
      display: inline-block;
      margin-top: 14px;
      font-size: 12px;
      color: var(--color-text-muted);
      text-decoration: none;
      transition: color .15s;
    }
    .back-link:hover {
      color: var(--color-primary);
    }

    /* ---------- Hero Column (Modern Sleek Rounded Frame) ---------- */
    .login-hero {
      position: relative;
      min-height: 600px;
      height: 100%;
      border-radius: 28px;
      overflow: hidden;
      background: #012D68;
      box-shadow: 
        0 20px 44px -12px rgba(1, 45, 104, 0.22),
        0 4px 12px rgba(0, 0, 0, 0.04),
        inset 0 0 0 1px rgba(255, 255, 255, 0.18);
      border: 1px solid rgba(1, 45, 104, 0.1);
      animation: fade-in .6s ease-out both;
    }
    .login-hero-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center center;
      transition: transform .7s cubic-bezier(0.22, 1, 0.36, 1);
      display: block;
    }
    .login-hero:hover .login-hero-img {
      transform: scale(1.025);
    }

    /* ---------- Animations ---------- */
    @keyframes spin { to { transform: rotate(360deg); } }
    @keyframes fade-up { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: none; } }
    @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
    @media (prefers-reduced-motion: reduce) {
      * { animation: none !important; transition: none !important; }
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 1023px) {
      .login-card { grid-template-columns: 1fr 1fr; padding: 28px; gap: 24px; }
      .login-hero { min-height: 520px; border-radius: 24px; }
    }
    @media (max-width: 767px) {
      .login-page { padding: 0; }
      .login-card {
        grid-template-columns: 1fr;
        min-height: 100vh;
        padding: 24px;
        border-radius: 0;
        box-shadow: none;
      }
      .login-hero { order: -1; min-height: 340px; border-radius: 20px; }
      .field input { font-size: 16px; }
    }
  </style>
</head>
<body>

  <main class="login-page">
    <section class="login-card">

      <!-- ===== Kolom Form ===== -->
      <div class="login-form">
        <!-- Brand Logo & Wordmark -->
        <a class="brand" href="{{ route('home') }}" aria-label="Gabe Medica, beranda" title="Gabe Medica">
          <img src="{{ asset('images/gabe-medica-logo.png') }}?v={{ @filemtime(public_path('images/gabe-medica-logo.png')) }}" alt="Gabe Medica" />
        </a>

        <!-- Role Selector Switch (Pasien / User vs Administrator) -->
        <div class="role-selector" role="tablist" aria-label="Pilih Peran Masuk ke Portal">
          <button type="button" class="role-pill active" id="tabUser" onclick="switchRole('user')" role="tab" aria-selected="true">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
            <span>Pasien / User</span>
          </button>
          <button type="button" class="role-pill" id="tabAdmin" onclick="switchRole('admin')" role="tab" aria-selected="false">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>Administrator</span>
          </button>
        </div>

        <h1>Selamat Datang</h1>
        <p class="subtitle" id="subtitle-text">Masuk ke portal layanan kesehatan Gabe Medica</p>


        <!-- Session Flash Messages -->
        @if (session('success'))
          <div class="form-alert ok show" role="alert">{{ session('success') }}</div>
        @endif

        @if (session('warning'))
          <div class="form-alert show" style="background:#FFFBEB;border-color:#FDE68A;color:#B45309;" role="alert">{{ session('warning') }}</div>
        @endif

        @if (session('info'))
          <div class="form-alert show" style="background:#EFF6FF;border-color:#BFDBFE;color:#1D4ED8;" role="alert">{{ session('info') }}</div>
        @endif

        @if ($errors->any())
          <div class="form-alert show" role="alert">
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        @endif

        <div class="form-alert" id="form-alert" role="alert"></div>

        <!-- Real Laravel Authentication Form -->
        <form id="login-form" action="{{ route('login.post') }}" method="POST" novalidate>
          @csrf
          <div class="field" id="field-email">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" autocomplete="email"
                   value="{{ old('email', 'user@aihealth.com') }}"
                   placeholder="name@example.com" aria-describedby="email-error" required />
            <p class="error-msg" id="email-error">Masukkan alamat email yang valid.</p>
          </div>

          <div class="field" id="field-password">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password"
                   value="password"
                   placeholder="••••••••" aria-describedby="password-error" required />
            <button type="button" class="toggle" id="toggle-password"
                    aria-label="Show password" aria-pressed="false">
              <svg class="eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              <svg class="eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M3 3l18 18"/>
                <path d="M10.6 5.1A9.7 9.7 0 0 1 12 5c6.4 0 10 7 10 7a17 17 0 0 1-3.2 4.1M6.3 6.4C3.7 8.1 2 12 2 12s3.6 7 10 7c1.6 0 3-.4 4.2-1"/>
                <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/>
              </svg>
            </button>
            <p class="error-msg" id="password-error">Password tidak boleh kosong.</p>
          </div>

          <div class="row">
            <label class="check">
              <input type="checkbox" name="remember" checked /> Remember me
            </label>
            <a href="javascript:void(0)" onclick="alert('Kata sandi demo Anda: password')">Forgot Password?</a>
          </div>

          <button class="btn btn-primary" type="submit" id="btn-login">Login</button>
        </form>

        <p class="signup">Don't have an account? <a href="javascript:void(0)" onclick="alert('Pendaftaran akun baru saat ini ditutup untuk sesi demo.')">Sign Up</a></p>

        <!-- Demo Quick Access Section -->
        <div class="demo-section">
          <div class="demo-title">Akses Cepat Demo (1-Klik)</div>
          <div class="demo-grid">
            <a href="{{ route('quick-login', 'user') }}" class="demo-pill" title="Masuk langsung sebagai Pasien">
              <span class="demo-avatar user-av">RA</span>
              <span class="demo-text">
                <strong>Pasien / User</strong>
                <small>user@aihealth.com</small>
              </span>
            </a>
            <a href="{{ route('quick-login', 'admin') }}" class="demo-pill" title="Masuk langsung sebagai Administrator">
              <span class="demo-avatar admin-av">AL</span>
              <span class="demo-text">
                <strong>Administrator</strong>
                <small>admin@aihealth.com</small>
              </span>
            </a>
          </div>
          <a href="{{ route('home') }}" class="back-link">← Kembali ke Beranda</a>
        </div>
      </div>

      <!-- ===== Kolom Hero (Full-bleed Modern Frame, Polos Tanpa Text Overlay) ===== -->
      <aside class="login-hero" aria-label="Foto Klinik Gabe Medica">
        <img src="{{ asset('images/login-hero.jpg') }}?v={{ @filemtime(public_path('images/login-hero.jpg')) }}" alt="Petugas Klinik Gabe Medica" class="login-hero-img" />
      </aside>

    </section>
  </main>

  <script>
    (function () {
      var form = document.getElementById('login-form');
      var email = document.getElementById('email');
      var password = document.getElementById('password');
      var toggle = document.getElementById('toggle-password');
      var btn = document.getElementById('btn-login');
      var alertBox = document.getElementById('form-alert');
      var fieldEmail = document.getElementById('field-email');
      var fieldPassword = document.getElementById('field-password');
      var tabUser = document.getElementById('tabUser');
      var tabAdmin = document.getElementById('tabAdmin');
      var subtitleText = document.getElementById('subtitle-text');

      // Role switcher
      window.switchRole = function (role) {
        if (role === 'admin') {
          tabAdmin.classList.add('active');
          tabAdmin.setAttribute('aria-selected', 'true');
          tabUser.classList.remove('active');
          tabUser.setAttribute('aria-selected', 'false');
          email.value = 'admin@aihealth.com';
          password.value = 'password';
          subtitleText.textContent = 'Mode Akses: Administrator Portal Gabe Medica';
          subtitleText.style.color = 'var(--color-primary)';
        } else {
          tabUser.classList.add('active');
          tabUser.setAttribute('aria-selected', 'true');
          tabAdmin.classList.remove('active');
          tabAdmin.setAttribute('aria-selected', 'false');
          email.value = 'user@aihealth.com';
          password.value = 'password';
          subtitleText.textContent = 'Masuk ke portal layanan kesehatan Gabe Medica';
          subtitleText.style.color = 'var(--color-text-secondary)';
        }
        setInvalid(fieldEmail, email, false);
        setInvalid(fieldPassword, password, false);
      };

      // Tampilkan / sembunyikan password
      toggle.addEventListener('click', function () {
        var show = password.type === 'password';
        password.type = show ? 'text' : 'password';
        toggle.setAttribute('aria-pressed', String(show));
        toggle.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
      });

      function validEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }

      function setInvalid(field, input, isInvalid) {
        field.classList.toggle('invalid', isInvalid);
        input.setAttribute('aria-invalid', String(isInvalid));
      }

      email.addEventListener('input', function () { setInvalid(fieldEmail, email, false); });
      password.addEventListener('input', function () { setInvalid(fieldPassword, password, false); });

      function showAlert(msg, ok) {
        alertBox.textContent = msg;
        alertBox.classList.toggle('ok', !!ok);
        alertBox.classList.add('show');
      }

      form.addEventListener('submit', function (e) {
        alertBox.classList.remove('show');

        var badEmail = !validEmail(email.value.trim());
        var badPass = password.value.length === 0;
        setInvalid(fieldEmail, email, badEmail);
        setInvalid(fieldPassword, password, badPass);

        if (badEmail) {
          e.preventDefault();
          email.focus();
          return;
        }
        if (badPass) {
          e.preventDefault();
          password.focus();
          return;
        }

        // Tampilkan spinner loading saat submit asli ke backend
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner" aria-hidden="true"></span>';
        btn.setAttribute('aria-label', 'Memproses');
      });

    })();
  </script>
</body>
</html>
