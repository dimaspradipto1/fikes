<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - Fakultas Ilmu Kesehatan (FIKES) Universitas Ibnu Sina</title>
  <meta content="Portal Login Resmi Fakultas Ilmu Kesehatan (FIKES)" name="description">
  <meta content="fikes, login, uis, kesehatan" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logouis.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logouis.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Style CSS -->
  <style>
    :root {
      --color-orange: #ff9c00;
      --color-orange-dark: #e08500;
      --color-orange-glow: rgba(255, 156, 0, 0.12);
      --color-purple: #823ca2;
      --color-purple-dark: #6e2f8b;
      --color-purple-glow: rgba(130, 60, 162, 0.08);
      --color-text-dark: #0f172a;
      --color-text-light: #64748b;
      --font-family: 'Plus Jakarta Sans', sans-serif;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: var(--font-family);
      background-color: #f8fafc;
      color: var(--color-text-dark);
      height: 100vh;
      max-height: 100vh;
      overflow: hidden;
    }

    /* Parent Layout Wrapper (Strictly Non-Scrollable) */
    .login-wrapper {
      display: flex;
      height: 100vh;
      max-height: 100vh;
      width: 100vw;
      overflow: hidden;
    }

    /* Left Visual Panel - Solid Purple Background */
    .login-visual {
      flex: 1.25;
      background-color: var(--color-purple);
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 3.5rem;
      color: #ffffff;
      overflow: hidden;
      box-sizing: border-box;
    }

    /* Pulse/ECG Vector Animation (Solid Subtle Accent) */
    .ecg-container {
      position: absolute;
      width: 140%;
      height: 100%;
      top: 0;
      left: -20%;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0.15;
      pointer-events: none;
      z-index: 1;
    }
    .ecg-svg {
      width: 100%;
      height: 70%;
    }
    .ecg-path {
      fill: none;
      stroke: var(--color-orange);
      stroke-width: 2.2;
      stroke-linecap: round;
      stroke-linejoin: round;
      stroke-dasharray: 2000;
      stroke-dashoffset: 2000;
      animation: drawECG 12s linear infinite;
    }

    @keyframes drawECG {
      0% {
        stroke-dashoffset: 2000;
      }
      70% {
        stroke-dashoffset: 0;
      }
      100% {
        stroke-dashoffset: -2000;
      }
    }

    .visual-content {
      position: relative;
      z-index: 2;
      margin-top: auto;
      margin-bottom: auto;
      max-width: 540px;
    }

    .faculty-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 14px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 700;
      letter-spacing: 1.5px;
      color: #ffe4cc;
      margin-bottom: 1.5rem;
      text-transform: uppercase;
    }

    .visual-title {
      font-size: 2.75rem;
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 0.5rem;
      letter-spacing: -1px;
    }

    .visual-subtitle {
      font-size: 1.5rem;
      font-weight: 500;
      color: #ffe6cc;
      margin-bottom: 2rem;
    }

    .visual-desc {
      font-size: 0.95rem;
      font-weight: 300;
      line-height: 1.7;
      opacity: 0.85;
      margin-bottom: 2.5rem;
    }

    /* Minimalist Statement & Program Badges */
    .visual-statement {
      position: relative;
      padding-left: 20px;
      border-left: 3px solid var(--color-orange);
      margin-bottom: 2.5rem;
    }

    .statement-text {
      font-style: italic;
      font-size: 0.95rem;
      line-height: 1.6;
      opacity: 0.95;
      margin-bottom: 6px;
    }

    .statement-author {
      font-size: 0.78rem;
      font-weight: 600;
      color: #ffe4cc;
      letter-spacing: 0.5px;
      display: block;
    }

    .prodi-badges {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .prodi-badge {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 0.78rem;
      font-weight: 600;
      color: rgba(255, 255, 255, 0.9);
      transition: all 0.2s ease;
    }

    .prodi-badge:hover {
      background: rgba(255, 255, 255, 0.18);
      border-color: rgba(255, 255, 255, 0.3);
      transform: translateY(-2px);
      color: #ffffff;
    }

    .visual-footer {
      position: relative;
      z-index: 2;
      font-size: 0.8rem;
      opacity: 0.7;
      font-weight: 400;
    }

    /* Right Form Panel (Strict Height & Balanced Spacing) */
    .login-form-container {
      flex: 0.8;
      background: #ffffff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 3rem;
      height: 100vh;
      max-height: 100vh;
      box-sizing: border-box;
      overflow-y: auto;
    }

    .form-wrapper {
      width: 100%;
      max-width: 360px;
      display: flex;
      flex-direction: column;
      animation: fadeInForm 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes fadeInForm {
      0% {
        opacity: 0;
        transform: translateY(15px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Single Logo Header - Solid Purple Rounded Badge Box to ensure white logo text visibility */
    .logos-header {
      align-self: center;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 2.25rem;
      background-color: var(--color-purple);
      padding: 12px 28px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(130, 60, 162, 0.15);
    }

    .logo-img {
      height: 40px;
      width: auto;
      object-fit: contain;
      transition: transform 0.2s ease;
    }

    .logo-img:hover {
      transform: scale(1.03);
    }

    .form-header {
      text-align: center;
      margin-bottom: 1.75rem;
    }

    .form-title {
      font-size: 1.6rem;
      font-weight: 800;
      color: var(--color-text-dark);
      margin-bottom: 0.35rem;
      letter-spacing: -0.5px;
    }

    .form-subtitle {
      font-size: 0.88rem;
      color: var(--color-text-light);
      font-weight: 500;
    }

    /* Refined Input Styling */
    .custom-input-group {
      position: relative;
      margin-bottom: 1.15rem;
      width: 100%;
    }

    .custom-control {
      width: 100%;
      padding: 13px 16px 13px 44px;
      border: 1px solid #cbd5e1;
      border-radius: 10px;
      background-color: #ffffff;
      font-size: 0.9rem;
      color: var(--color-text-dark);
      font-family: inherit;
      font-weight: 500;
      transition: all 0.2s ease;
      box-sizing: border-box;
    }

    .custom-control::placeholder {
      color: #94a3b8;
      font-weight: 400;
    }

    .custom-control:focus {
      background-color: #ffffff;
      border-color: var(--color-purple);
      box-shadow: 0 0 0 4px var(--color-purple-glow);
      outline: none;
    }

    .custom-input-group i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 1.15rem;
      transition: color 0.2s ease;
      pointer-events: none;
    }

    .custom-control:focus + i {
      color: var(--color-purple);
    }

    /* Checkbox & Forgot Password options */
    .form-options {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.75rem;
      font-size: 0.85rem;
    }

    .custom-checkbox {
      display: flex;
      align-items: center;
      cursor: pointer;
      position: relative;
      padding-left: 24px;
      color: #475569;
      user-select: none;
      font-weight: 500;
    }

    .custom-checkbox input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    .checkmark {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      height: 16px;
      width: 16px;
      background-color: #ffffff;
      border: 1px solid #cbd5e1;
      border-radius: 5px;
      transition: all 0.2s ease;
    }

    .custom-checkbox input:checked ~ .checkmark {
      background-color: var(--color-purple);
      border-color: var(--color-purple);
    }

    .checkmark::after {
      content: "";
      position: absolute;
      display: none;
      left: 5px;
      top: 1.5px;
      width: 4px;
      height: 8px;
      border: solid #ffffff;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }

    .custom-checkbox input:checked ~ .checkmark::after {
      display: block;
    }

    .custom-checkbox:hover input ~ .checkmark {
      border-color: var(--color-purple);
    }

    .forgot-link {
      font-weight: 600;
      color: var(--color-purple);
      text-decoration: none;
      position: relative;
      transition: color 0.2s ease;
    }

    .forgot-link:hover {
      color: var(--color-orange-dark);
    }

    /* Solid Purple Submit Button */
    .btn-login {
      width: 100%;
      padding: 13px;
      background-color: var(--color-purple);
      color: #ffffff;
      border: none;
      border-radius: 10px;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      box-shadow: 0 4px 10px rgba(130, 60, 162, 0.15);
      transition: all 0.2s ease;
    }

    .btn-login:hover {
      transform: translateY(-1.5px);
      box-shadow: 0 6px 14px rgba(130, 60, 162, 0.25);
      background-color: var(--color-purple-dark);
    }

    .btn-login:active {
      transform: translateY(0);
      box-shadow: 0 4px 10px rgba(130, 60, 162, 0.15);
    }

    .btn-login i {
      font-size: 1.25rem;
      transition: transform 0.2s ease;
    }

    .btn-login:hover i {
      transform: translateX(3px);
    }

    .register-footer {
      text-align: center;
      margin-top: 1.75rem;
      font-size: 0.85rem;
      color: var(--color-text-light);
      font-weight: 500;
    }

    .register-link {
      color: var(--color-purple);
      font-weight: 700;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .register-link:hover {
      color: var(--color-orange-dark);
    }

    /* Bootstrap Validation Adaptations */
    .needs-validation .custom-control:invalid ~ .invalid-feedback {
      display: none;
    }

    .was-validated .custom-control:invalid {
      border-color: #ef4444 !important;
      box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.08) !important;
    }

    .was-validated .custom-control:invalid ~ .invalid-feedback {
      display: block;
      font-size: 0.78rem;
      color: #ef4444;
      margin-top: 0.35rem;
      padding-left: 2px;
      font-weight: 500;
    }

    .was-validated .custom-control:valid {
      border-color: #10b981 !important;
      box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.06) !important;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
      .login-visual {
        padding: 2.5rem;
      }
      .visual-title {
        font-size: 2.25rem;
      }
      .visual-subtitle {
        font-size: 1.35rem;
      }
      .visual-desc {
        margin-bottom: 2rem;
      }
    }

    @media (max-width: 991px) {
      body {
        background-color: var(--color-purple);
        overflow-y: auto;
        height: auto;
        max-height: none;
      }
      .login-wrapper {
        justify-content: center;
        align-items: center;
        padding: 2rem 1.5rem;
        height: auto;
        min-height: 100vh;
        max-height: none;
        overflow: visible;
      }
      .login-visual {
        display: none;
      }
      .login-form-container {
        flex: none;
        width: 100%;
        max-width: 440px;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        padding: 2.5rem 2rem;
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(255, 255, 255, 0.2);
        height: auto;
        max-height: none;
      }
    }

    @media (max-width: 480px) {
      .login-wrapper {
        padding: 1rem;
      }
      .login-form-container {
        padding: 2rem 1.25rem;
      }
      .logos-header {
        margin-bottom: 1.75rem;
        padding: 8px 20px;
      }
      .logo-img {
        height: 34px;
      }
      .form-title {
        font-size: 1.45rem;
      }
    }
  </style>

</head>

<body>

  <main>
    <div class="login-wrapper">

      <!-- Left Section: Visual Brand (Solid Background, strictly non-scrollable) -->
      <section class="login-visual">

        <!-- Subtle heartbeat line -->
        <div class="ecg-container">
          <svg class="ecg-svg" viewBox="0 0 800 200" preserveAspectRatio="none">
            <path class="ecg-path" d="M0,100 L250,100 L270,70 L290,130 L310,45 L330,155 L350,90 L370,110 L390,100 L800,100" />
          </svg>
        </div>

        <div class="visual-header">
          <!-- Spacing -->
        </div>

        <!-- Centered Branding and Info -->
        <div class="visual-content">
          <div class="faculty-badge">
            <i class="bi bi-heart-pulse-fill" style="color: var(--color-orange); font-size: 0.9rem;"></i> Portal Akademik
          </div>
          <h1 class="visual-title">Fakultas Ilmu Kesehatan</h1>
          <h2 class="visual-subtitle">Universitas Ibnu Sina</h2>
          <p class="visual-desc">Menyelenggarakan pendidikan kesehatan unggul untuk mencetak tenaga kesehatan profesional yang siap mengabdi di masyarakat dengan integritas dan keilmuan tinggi.</p>

          <!-- Sleek Professional Statement -->
          <div class="visual-statement">
            <p class="statement-text">“Membentuk tenaga kesehatan yang kompeten, berdaya saing global, dan berintegritas tinggi untuk mengabdi bagi kemanusiaan.”</p>
            <span class="statement-author">— Dekan FIKES Universitas Ibnu Sina</span>
          </div>

          <!-- Study Program Badges -->
          <div class="prodi-badges">
            <span class="prodi-badge">S1 Farmasi</span>
            <span class="prodi-badge">S1 Keperawatan</span>
            <span class="prodi-badge">S1 Kesehatan Masyarakat</span>
            <span class="prodi-badge">Profesi Ners</span>
          </div>
        </div>

        <!-- Bottom Footer -->
        <div class="visual-footer">
          &copy; {{ date('Y') }} FIKES UIS. Semua hak cipta dilindungi.
        </div>
      </section>

      <!-- Right Section: Login Form (Solid color theme, strictly non-scrollable) -->
      <section class="login-form-container">
        <div class="form-wrapper">

          <!-- Centered Single Logo (no double shield) -->
          <div class="logos-header">
            <img src="{{ asset('assets/img/logo_fikes.png') }}" alt="Logo FIKES" class="logo-img">
          </div>

          <div class="form-header">
            <h3 class="form-title">Masuk Portal</h3>
            <p class="form-subtitle">Silakan masuk menggunakan akun Anda</p>
          </div>

          <!-- Login Form submission -->
          <form class="needs-validation" novalidate method="POST" action="{{ route('authenticate') }}">
            @csrf

            <!-- Form Validation Alerts -->
            @if ($errors->any())
              <div class="alert alert-danger mb-3" style="border-radius: 8px; font-size: 0.8rem; border: none; background-color: rgba(239,68,68,0.08); color: #ef4444; padding: 10px 14px;">
                <ul class="mb-0 ps-3">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <!-- Username Field -->
            <div class="custom-input-group">
              <input type="email" name="email" class="custom-control" id="yourUsername" placeholder="Email" required value="{{ old('email') }}">
              <i class="bi bi-person"></i>
              <div class="invalid-feedback">Harap isi email Anda.</div>
            </div>

            <!-- Password Field -->
            <div class="custom-input-group">
              <input type="password" name="password" class="custom-control" id="yourPassword" placeholder="Kata Sandi" required>
              <i class="bi bi-lock"></i>
              <div class="invalid-feedback">Harap isi kata sandi Anda.</div>
            </div>

            <!-- Checkbox & Link options -->
            <div class="form-options">
              <label class="custom-checkbox">
                <input type="checkbox" name="remember" id="rememberMe" value="true" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
                <span class="label-text">Ingat Saya</span>
              </label>
              <a href="#" class="forgot-link">Lupa Sandi?</a>
            </div>

            <!-- Submit Login -->
            <button type="submit" class="btn-login">
              <span>Masuk Sekarang</span>
              <i class="bi bi-arrow-right-short"></i>
            </button>

            <!-- Support note -->
            <div class="register-footer">
              Belum memiliki akun? <a href="#" class="register-link">Hubungi Akademik</a>
            </div>
          </form>

        </div>
      </section>

    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>