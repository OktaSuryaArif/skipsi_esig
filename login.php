<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Aplikasi Pendaftaran Bipartit Online.">
  <meta name="author" content="e-development.tech">
  <title>Login Permohonan Informasi</title>

  <!-- Gambar title (Favicon) yang tampil di tab browser -->
  <link rel="icon" type="image/png" href="assets/img/logo.png">

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

  <style>
    .logo-login {
      max-height: 160px;
      margin-bottom: 20px;
    }
    body {
      background-image: url('images/slider-bg.jpg');
      background-size: cover;
      background-position: center;
    }
    .field-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
      color: #aaa;
    }
    .position-relative {
      position: relative;
    }
    /* Tombol on/off suara di pojok kanan atas */
    #toggle-speech {
      position: fixed;
      top: 15px;
      right: 15px;
      z-index: 1000;
      background-color: green; /* default aktif */
      color: white;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Tombol Kembali (di kiri atas, sebelum gambar title) -->
    <a href="index.html" class="btn btn-danger kembali-btn speakable" style="position: absolute; top: 15px; left: 15px;">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <!-- Tombol on/off suara -->
    <button id="toggle-speech" class="btn btn-secondary">Sound: On</button>

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-md-12">
                <div class="p-5">
                  <div class="text-center">
                    <!-- Logo (gambar title) -->
                    <img src="assets/img/logo.png" alt="Logo Pengadilan" class="logo-login">
                    <!-- Tanggal dan Jam Real Time -->
                    <div id="realtimeClock" style="margin-top: 10px; font-weight: bold;"></div>

                    <h1 class="h4 text-gray-900 speakable">Permohonan Informasi</h1>
                    <h1 class="h4 text-gray-900 mb-4 speakable"><b>Pengadilan Negeri Tanjungkarang</b></h1>

                    <?php
                    if (isset($_SESSION['pesan_registrasi'])) { ?>
                      <div class="alert alert-success">
                        <?= $_SESSION['pesan_registrasi'] ?>
                      </div>
                    <?php }

                    if (isset($_SESSION['login_error'])) { ?>
                      <div class="alert alert-danger">
                        <?= $_SESSION['login_error'] ?>
                      </div>
                    <?php }
                    // Jangan melakukan session_destroy() agar data (seperti jawaban CAPTCHA) tetap tersimpan.
                    ?>
                  </div>
                  <form class="user" action="login_control.php" method="POST">
                    <div class="form-group">
                      <!-- Input Username; jika ada nilai lama, maka diisi kembali -->
                      <input type="text" name="username" id="username" class="form-control form-control-user speakable" placeholder="Masukkan Username..." value="<?php echo isset($_SESSION['old_username']) ? $_SESSION['old_username'] : ''; ?>">
                    </div>
                    <!-- Field Password dengan ikon mata untuk toggle tampilan -->
                    <div class="form-group position-relative">
                      <input type="password" name="password" id="exampleInputPassword" class="form-control form-control-user speakable" placeholder="Password" value="<?php echo isset($_SESSION['old_password']) ? $_SESSION['old_password'] : ''; ?>">
                      <i class="fas fa-eye field-icon toggle-password"></i>
                    </div>
                    <!-- CAPTCHA Matematika: Penjumlahan dua angka acak -->
                    <div class="form-group">
                      <?php
                      // Menghasilkan dua angka acak antara 1 dan 10
                      $a = rand(1, 10);
                      $b = rand(1, 10);
                      // Simpan jawaban CAPTCHA ke session untuk validasi di login_control.php
                      $_SESSION['captcha_answer'] = $a + $b;
                      ?>
                      <label for="captcha" class="speakable">Captcha: Berapa <?php echo $a; ?> + <?php echo $b; ?>?</label>
                      <input type="text" name="captcha" id="captcha" class="form-control form-control-user speakable" placeholder="Jawaban Captcha">
                    </div>
                    <button type="submit" name="btn_login" value="login" class="btn btn-primary btn-user btn-block speakable">
                      Login
                    </button>
                  </form>

                  <hr>

                  <!-- Field Lupa Password dan Registrasi -->
                  <div class="form-group row">
                    <div class="col-md-6">
                      <a href="lupa_password.php" class="btn btn-warning btn-user btn-block speakable">
                        <i class="fas fa-key"></i> Lupa Password
                      </a>
                    </div>
                    <div class="col-md-6">
                      <a href="registrasi.php" class="btn btn-success btn-user btn-block speakable">
                        <i class="fas fa-user-plus"></i> Registrasi Akun
                      </a>
                    </div>
                  </div>

                </div><!-- /.p-5 -->
              </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col-md-7 -->
    </div><!-- /.row -->
  </div><!-- /.container -->

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Script untuk toggle tampilan password dengan klik ikon mata -->
  <script>
    document.querySelector('.toggle-password').addEventListener('click', function () {
      var passwordInput = document.getElementById('exampleInputPassword');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
      }
    });
  </script>

  <!-- Script untuk fitur suara (Web Speech API) -->
  <script>
    var speechEnabled = true;

    function speakText(text) {
      if (!speechEnabled || !text) return;
      speechSynthesis.cancel();
      var utterance = new SpeechSynthesisUtterance(text);
      utterance.lang = 'id-ID';
      speechSynthesis.speak(utterance);
    }

    // Ketika kursor masuk ke elemen dengan kelas speakable, bacakan teksnya (placeholder atau innerText)
    function handleMouseEnter() {
      var textToSpeak = this.placeholder || this.innerText;
      speakText(textToSpeak);
    }
    document.querySelectorAll('.speakable').forEach(function (item) {
      item.addEventListener('mouseenter', handleMouseEnter);
    });

    // Event listener untuk input di field Username: bacakan isi saat mengetik
    document.getElementById('username').addEventListener('input', function () {
      speakText("Username " + this.value);
    });
    // Event listener untuk input di field Password: bacakan isi saat mengetik
    document.getElementById('exampleInputPassword').addEventListener('input', function () {
      speakText("Password " + this.value);
    });

    // Tombol on/off suara: ubah warna, teks, dan bacakan statusnya
    document.getElementById('toggle-speech').addEventListener('click', function () {
      speechEnabled = !speechEnabled;
      if (speechEnabled) {
        this.textContent = "Sound: On";
        this.style.backgroundColor = "green";
        speakText("Sound On. Selamat Datang Di Aplikasi PPID website ini mendukung suara untuk memudahkan tuna rungu");
      } else {
        this.textContent = "Sound: Off";
        this.style.backgroundColor = "red";
        speakText("Anda berhasil Mematikan Suara navigasi pembantu tuna rungu");
        speechSynthesis.cancel();
      }
    });

    // Saat halaman dimuat: jika ada error, bacakan error; jika tidak, bacakan sambutan default
    window.addEventListener('load', function () {
      <?php if(isset($_SESSION['login_error'])): ?>
         speakText("<?php echo addslashes($_SESSION['login_error']); ?>");
      <?php else: ?>
         speakText("Selamat Datang Di Aplikasi PPID website ini mendukung suara untuk memudahkan tuna rungu, silahkan login dengan username dan password yang benar, jika anda tidak memiliki akun silahkan klik tombol registrasi untuk mendapatkan akun.");
      <?php endif; ?>
    });
  </script>

  <!-- Script untuk menampilkan tanggal dan jam secara real time -->
  <script>
    function updateClock() {
      var now = new Date();
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      var dateString = now.toLocaleDateString('id-ID', options);
      var timeString = now.toLocaleTimeString('id-ID');
      document.getElementById('realtimeClock').innerHTML = dateString + ' - Jam : ' + timeString;
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>

  <?php
    // Hapus error message dari session agar tidak muncul kembali pada refresh berikutnya
    if(isset($_SESSION['login_error'])) {
      unset($_SESSION['login_error']);
    }
  ?>
</body>
</html>
