<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Peminjaman</title>
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
        <!-- Greeting (Salam) -->
        <div class="col text-center mt-5 mb-5">
            <h2 class="text-success">Selamat Datang {{ Auth::user()->name }}</h2>
        </div>



        <!-- Pesan Sukses dan Gagal -->
        <div class="container mt-3">
            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (Session::get('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>

        <!-- Form Pencarian -->
        <div class="row mt-4">
            <div class="col"></div>
            <div class="col-6">
                <form action="{{ route('admin.peminjaman') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="search" name="search" class="form-control rounded" placeholder="Cari id peminjaman"
                            aria-label="Search" aria-describedby="search-addon" />
                        <button type="submit" class="btn btn-outline-primary">Cari</button>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>

        <!-- Tombol Cetak dan Tambah Data -->
        <div class="row mt-5">
            <div class="col"><a class="btn btn-info text-white" target="_blank"
                    href="{{ route('admin.cetakDataPeminjaman') }}" style="text-decoration: none; margin-right: 
30px">Cetak Data</a></div>

            <div class="col"></div>
            <div class="col-2">
                <a class="btn btn-success" href="{{ route('admin.tambahPeminjaman') }}"
                    style="text-decoration: none; margin-left: 30px">Tambah Data +</a>
            </div>
        </div>

        <!-- Tabel Data Peminjaman -->
        <table class="table" style="margin-top: 10px">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nomor Anggota</th>
                    <th scope="col">Kode Buku</th>
                    <th scope="col">Tanggal Peminjaman</th>
                    <th scope="col">Tanggal Pengembalian</th>
                    <th scope="col">Status Peminjaman</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($data as $index => $peminjam)
                <tr>
                    <td scope="row">{{ $index + $data->firstItem() }}</td>
                    <td>{{ $peminjam->id_user }}</td>
                    <td>{{ $peminjam->id_buku }}</td>
                    <td>{{ $peminjam->tanggal_pinjam }}</td>
                    <td>{{ $peminjam->tanggal_kembali }}</td>
                    <td>
                        <span
                            class="{{ $peminjam->status === 'Sudah Dikembalikan' ? 'fw-semibold text-success' : 'fw-semibold text-danger' }}">
                            {{ $peminjam->status }}
                        </span>
                    </td>
                    <td>
                        <a class="btn btn-outline-primary"
                            href="/admin/detailPeminjaman/{{ $peminjam->id }}/{{ $peminjam->id_user }}/{{ $peminjam->id_buku }}">Detail</a>
                        <a class="btn btn-outline-warning" href="/admin/editPeminjaman/{{ $peminjam->id }}">Edit</a>
                        <a class="btn btn-outline-danger" href="/admin/deletePeminjaman/{{ $peminjam->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{ $data->links() }}
    </div>
    <br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
</body>

</html>