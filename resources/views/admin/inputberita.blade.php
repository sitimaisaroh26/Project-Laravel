<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Link stylesheet Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Link Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Tambah Data Buku</title>
</head>

<body>

    <!-- 1. membuat navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis | D-IV Rekayasa Perangkat Lunak</a>
        </div>
    </nav>

    <div class="container">

        <!--2. back -->
        <a href="{{ route('admin.berita') }}">
            <i class="bi-arrow-left h1"></i>
        </a>

        <!-- 3. menampilkan respon salah/sukses -->
        <div class="container mt-3">
            <!-- Tampilkan pesan sukses jika ada -->
            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- Tampilkan pesan kesalahan jika ada -->
            @if (Session::get('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ Session::get('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Tambah Data Berita</h5>


                        <!-- INI BAGIAN PENTING -->
                        <form action="{{ route('postBerita') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- form gambar berita-->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Gambar Berita</label>
                                <input class="form-control" type="file" name="gambar">
                                <!-- Maksimal ukuran gambar cover buku 5MB -->
                                <div class="form-text">Maksimal ukuran gambar cover buku 5MB</div>
                            </div>

                            <!-- form judul berita-->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Judul Berita</label>
                                <input type="text" class="form-control border border-secondary form-control" name="judulberita" required value="{{ old('judulberita') }}">
                                <span class="text-danger">
                                    @error('judulberita')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <!-- menambahkan isi berita -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Isi berita</label>
                                <textarea class="form-control" name="isiberita" placeholder="Tulis deskripsi buku disini...." style="height: 250px" required value="{{ old('isiberita') }}"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success mt-5">Tambah data berita</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Link script Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>