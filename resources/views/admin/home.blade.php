<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Mengimpor stylesheet Bootstrap dari CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
    /* Gaya untuk header Selamat Datang */
    .header {
        text-align: center;
        margin-top: 20px;
    }

    /* Gaya untuk tombol "Logout" */
    .logout-button {
        text-decoration: none;
        text-align: end;
        color: black;
        font-weight: 600;
    }

    /* Gaya untuk pesan sukses atau gagal */
    .alert {
        margin-top: 10px;
    }

    /* Gaya untuk kolom pencarian */
    .search-form {
        text-align: center;
        margin-top: 20px;
    }

    /* Gaya untuk tombol "Tambah Data" */
    .add-data-button {
        text-decoration: none;
        margin-left: 30px;
        white-space: nowrap;
        /* Menjaga semua teks pada satu baris */
    }

    /* Gaya untuk latar belakang navbar */
    .navbar {
        background-color: black;
        color: white;
        padding: 15px 0;
        display: flex;
        justify-content: flex-end;
        /* Mengatur konten menjadi rata ke kanan */
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
    <title>Homepage</title>
</head>

<body>


    <!-- Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Politeknik Negeri Bengkalis</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.buku') }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.peminjaman') }}">Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dosen') }}">Dosen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.berita') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.lulusan') }}">Lulusan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Baris pertama: Selamat Datang -->
    <div class="col text-center mt-5 mb-5">
        <h2 class="text-success">Selamat Datang {{ Auth::user()->name }}</h2>
    </div>



    <!-- Kontainer untuk pesan sukses atau gagal -->
    <div class="container mt-3">
        <!-- Pesan Sukses -->
        @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <!-- Pesan Gagal -->
        @if (Session::get('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ Session::get('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    <!-- Baris untuk pencarian -->
    <div class="container mt-3">
        <div class="row mt-4">
            <div class="col"></div>
            <div class="col-6">
                <form action="{{ route('admin.home') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="search" name="search" class="form-control rounded" placeholder="Cari nama admin"
                            aria-label="Search" aria-describedby="search-addon" />
                        <button type="submit" class="btn btn-outline-primary">
                            Search
                        </button>
                    </div>
                </form>
            </div>
            <!-- Button Tambah data -->
            <div class="col-3 text-end">
                <a class="btn btn-success" href="{{ route('admin.tambah') }}" style=" width: 150px;">Tambah Data +</a>
            </div>
            <!-- Button Logout -->
            <div class="col-1 text-end">
                <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </div>


    <!-- Tabel untuk menampilkan data admin -->
    <div class="container mt-3">
        <table class="table" style="margin-top: 10px">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <!-- Loop untuk menampilkan data admin -->
                @foreach ($data as $index => $userAdmin)
                <tr>
                    <td>{{ $index + $data->firstItem() }}</td>
                    <td scope="row">{{ $userAdmin->name }}</td>
                    <td>{{ $userAdmin->email }}</td>
                    <td>{{ $userAdmin->jenis_kelamin }}</td>
                    <td>{{ $userAdmin->level }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <a class="btn btn-outline-warning" href="/editAdmin/{{ $userAdmin->id }}">Edit</a>
                        <!-- Tombol Delete -->
                        <a class="btn btn-outline-danger" href="/deleteAdmin/{{ $userAdmin->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Menampilkan pagination -->
    {{ $data->links() }}

    <!-- Mengimpor script Bootstrap dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>