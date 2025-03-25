<?php 
include('config/koneksi.php');
session_start();

if(isset($_POST['btn_login'])) {

    // Ambil nilai yang dikirim dari form
    $username       = $_POST['username'];
    $password_input = $_POST['password'];
    $password       = md5($password_input);
    $captcha_input  = $_POST['captcha'];

    // 1. VERIFIKASI CAPTCHA
    if($captcha_input != $_SESSION['captcha_answer']) {
        $_SESSION['login_error'] = "Captcha yang anda masukkan salah, tolong masukkan captcha yang benar !";
        $_SESSION['old_username'] = $username;
        $_SESSION['old_password'] = $password_input;
        header('location:login.php');
        exit();
    }

    // 2. VERIFIKASI USERNAME & PASSWORD
    $sql_user    = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result_user = mysqli_query($db, $sql_user);

    if(mysqli_num_rows($result_user) > 0) {
        $data_user = mysqli_fetch_array($result_user);
        $_SESSION['status']   = 'login';
        $_SESSION['id_users'] = $data_user['id'];
        $_SESSION['nama']     = $data_user['nama'];
        $_SESSION['level']    = $data_user['level'];

        // Tentukan URL tujuan berdasarkan level user
        if($data_user['level'] == 'admin'){
            $redirectUrl = "admin/dashboard.php";
        } else if($data_user['level'] == 'mahasiswa'){
            $redirectUrl = "mahasiswa/dashboard.php";
        } else if($data_user['level'] == 'dosen'){
            $redirectUrl = "dosen/dashboard.php";
        } else {
            $redirectUrl = "dashboard.php";
        }

        // Tampilkan halaman sementara dengan script JavaScript:
        // - Memainkan suara "Anda Berhasil Login sebagai [level] Ke Aplikasi PPID"
        // - Setelah 3 detik, mengalihkan ke halaman dashboard
        echo '<html>
                <head>
                  <meta charset="utf-8">
                  <title>Login Sukses</title>
                </head>
                <body>
                  <script>
                    function redirect() { window.location.href = "'.$redirectUrl.'"; }
                    window.onload = function() {
                        var message = "Anda Berhasil Login sebagai '.$data_user['level'].' Ke Aplikasi PPID";
                        var utterance = new SpeechSynthesisUtterance(message);
                        utterance.lang = "id-ID";
                        speechSynthesis.speak(utterance);
                        setTimeout(redirect, 3000);
                    }
                  </script>
                  <p>Login berhasil. Anda akan dialihkan dalam beberapa detik...</p>
                </body>
              </html>';
        exit();
    } else {
        $_SESSION['login_error'] = "Username atau Password yang anda masukkan salah, tolong periksa kembali !";
        $_SESSION['old_username']  = $username;
        $_SESSION['old_password']  = $password_input;
        header('location:login.php');
        exit();
    }
} else {
    header('location:login.php');
    exit();
}
?>
