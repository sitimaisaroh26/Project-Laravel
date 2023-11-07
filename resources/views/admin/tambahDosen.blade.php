<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Link stylesheet Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Link Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Tambah Data Dosen</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis</a>
        </div>
    </nav>
    <!-- back -->
    <div class="container">
        <a href="{{ route('admin.dosen') }}">
            <i class="bi-arrow-left h1"></i>
        </a>
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
                        <h5 class="card-title text-center">Tambah Data Dosen</h5>
                        <!-- ini penting : harus sama dengan controller -->
                        <form action="{{ route('postTambahDosen') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- menmabahkan foto dosen -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto Dosen</label>
                                <input class="form-control" type="file" name="gambar">
                                <!-- Maksimal ukuran gambar cover buku 5MB -->
                                <div class="form-text">Maksimal ukuran gambar cover buku 5MB</div>
                            </div>

                            <!-- menambahkan NIP -->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">NIP</label>
                                <input type="text" class="form-control border border-secondary form-control" name="NIP" required value="{{ old('NIP') }}">
                                <span class="text-danger">
                                    @error('NIP')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- menmabahkan Nama Dosen-->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Dosen</label>
                                <input type="text" class="form-control border border-secondary form-control" name="Nama" requird value="{{ old('Nama') }}">
                                <span class="text-danger">
                                    @error('Nama')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- menambahkan kategori prodi-->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Program Studi</label>
                                <select class="form-select" aria-label="Floating label select example" name="ProgramStudi">
                                    <option value="D2 Jalur Cepat Administrasi Jaringan Komputer" selected>D2 Jalur
                                        Cepat Administrasi Jaringan Komputer</option>
                                    <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                                    <option value="D4 Rekayasa Perangkat Lunak">D4 Rekayasa Perangkat Lunak</option>
                                    <option value="D4 Keamanan Sistem Informasi">D4 Keamanan Sistem Informasi</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success mt-5">Tambah Data Dosen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Link script Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>