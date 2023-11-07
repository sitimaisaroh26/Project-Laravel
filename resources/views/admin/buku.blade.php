<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Buku</title>

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


    <div class="container">
        <!-- Menampilkan pesan selamat datang dengan nama pengguna yang login -->
        <div class="col text-center mt-5 mb-5">
            <h2 class="text-success">Selamat Datang {{ Auth::user()->name }}</h2>
        </div>



        <!-- Pesan berhasil atau gagal -->
        <div class="container mt-3">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (Session::has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        <!-- Form pencarian
        <div class="row mt-4">
            <div class="col"></div>
            <div class="col-6">
                <form action="{{ route('admin.buku') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="search" name="search" class="form-control rounded" placeholder="Cari nama buku"
                            aria-label="Search" aria-describedby="search-addon" />
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>

        Tombol Tambah Data
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col-2">
                <a class="btn btn-success" href="{{ route('admin.tambahBuku') }}"
                    style="text-decoration: none; margin-left: 30px">Tambah Data</a>
            </div>
        </div> -->

        <!-- Baris untuk pencarian -->
        <div class="container mt-3">
            <div class="row mt-4">
                <div class="col"></div>
                <div class="col-6">
                    <form action="{{ route('admin.buku') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="search" name="search" class="form-control rounded" placeholder="Cari nama buku"
                                aria-label="Search" aria-describedby="search-addon" />
                            <button type="submit" class="btn btn-outline-primary">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Button Tambah data -->
                <div class="col-3 text-end">
                    <a class="btn btn-success" href="{{ route('admin.tambahBuku') }}" style=" width: 150px;">Tambah Data
                        +</a>
                </div>
                <!-- Button Logout -->
                <div class="col-1 text-end">
                    <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>


        <!-- Tabel daftar buku -->
        <table class="table" style="margin-top: 10px">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Kode Buku</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($data as $buku)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>
                        <!-- Menampilkan gambar buku -->
                        <img style="width: 50px" src="{{ asset('images/' . $buku->gambar) }}" alt="cover buku">
                    </td>
                    <td>{{ $buku->kode_buku }}</td>
                    <td>{{ $buku->judul_buku }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->kategori }}</td>
                    <td>{{ $buku->tahun_terbit }}</td>
                    <td>
                        <a class="btn btn-outline-warning" href="{{ route('admin.editBuku', $buku->id) }}">Edit</a>
                        <a class="btn btn-outline-danger" href="{{ route('admin.deleteBuku', $buku->id) }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>

        <!-- Tombol halaman pagination -->
        {{ $data->links() }}
    </div>
    <br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>