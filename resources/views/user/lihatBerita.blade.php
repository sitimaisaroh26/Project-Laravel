<!DOCTYPE html> <!-- Ini adalah deklarasi tipe dokumen HTML yang digunakan. -->
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Ini adalah tag untuk menyertakan file CSS Bootstrap yang digunakan untuk tampilan. -->
    <title>Homepage</title> <!-- Ini adalah judul halaman web. -->


    <style>
    /* Gaya untuk latar belakang navbar */
    .navbar {
        background-color: black;
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

    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Perpustakaan Polbeng</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.lihatBerita') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.lihatDosen') }}">Dosen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col">
                <h4 class="text-success">Selamat Datang {{ Auth::user()->name }}</h4>
            </div>
            <div class="col-7">
                <form action="" method="GET" class="d-flex">
                    @csrf
                    <!-- Ini adalah token CSRF Laravel untuk keamanan form. -->
                    <input type="search" name="search" class="form-control rounded" placeholder="Cari berita"
                        aria-label="Search" aria-describedby="search-addon" />
                    <!-- Ini adalah kotak pencarian untuk mencari nama buku. -->
                    <button type="submit" class="btn btn-success">Search</button>
                    <!-- Ini adalah tombol "search" untuk memulai pencarian. -->
                </form>
            </div>

            <div class="col-1">
                <a href="{{ route('logout') }}" style="text-decoration: none">
                    <button class="btn btn-danger">Logout</button>
                </a>
            </div>
        </div>
        <br><br>

        @foreach ($data as $beritah)
        <!-- Ini adalah loop untuk data buku. -->
        <div class="card mb-4">
            <!-- Ini adalah kartu (card) untuk menampilkan detail buku. -->
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <img style="width: 150px" src="{{ asset('images/' . $beritah->gambar) }}" alt="gambar berita">
                        <!-- Ini adalah gambar sampul buku. -->
                    </div>
                    <div class="col-2">
                        <p class="fw-bold">Judul Berita</p>
                        <p class="fw-bold">Isi Berita</p>
                    </div>
                    <div class="col-8">
                        <p>{{ $beritah->judulberita }}</p>
                        <p>{{ $beritah->isiberita }}</p>
                        <!-- Ini adalah nilai-nilai atribut buku. -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{ $data->links() }}
        <!-- Ini adalah tautan navigasi halaman berikutnya. -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Ini adalah tag untuk menyertakan file JavaScript Bootstrap. -->
</body>

</html>