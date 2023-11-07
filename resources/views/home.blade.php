<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        background-image: url('https://i.pinimg.com/564x/99/9e/f5/999ef57852af9fd5d0cb673a99a30ec3.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        color: #000;
        font-family: Arial, sans-serif;
    }

    /* Gaya untuk latar belakang navbar */
    .navbar {
        background-color: success;
        /* Mengubah warna navbar menjadi teal */
        color: white;
        padding: 15px 0;
        display: flex;
        justify-content: space-between;
    }

    /* Gaya untuk logo */
    .navbar-brand {
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
        color: white;
    }

    /* Gaya untuk daftar navigasi */
    .navbar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    /* Gaya untuk item navigasi */
    .nav-item {
        margin-right: 20px;
        /* Margin kanan antara item navigasi */
    }

    /* Gaya untuk tautan navigasi */
    .nav-link {
        text-decoration: none;
        /* Menghapus garis bawah pada tautan */
        color: white;
        /* Warna teks putih */
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">
                Politeknik Negeri Bengkalis | D-IV Rekayasa Perangkat Lunak
            </a>
        </div>
    </nav>
    <div class="container" style="margin-top: 150px">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-white">Selamat Datang!</h1>
                <h4 class="text-white">
                    Di Perpustakaan Negeri Bengkalis
                </h4>
                <h6 class="mt-3 text-white">
                    Silahkan
                    <a href="{{ route('auth.login') }}" class="btn btn-primary"
                        style="text-decoration: none;  color: #fff;">Masuk</a>
                    atau <a href="{{ route('auth.register') }}" class="btn btn-danger"
                        style="text-decoration: none;  color: #fff;">Daftar</a>
                    jika anda belum punya akun
                </h6>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>