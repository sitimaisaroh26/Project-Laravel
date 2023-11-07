<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Menambahkan link ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Menambahkan link ke Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Tambah Data</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis</a>
        </div>
    </nav>

    <div class="container">
        <a href="{{ route('admin.home') }}">
            <i class="bi-arrow-left h1"></i>
        </a>

        <!-- Pesan Berhasil dan Gagal -->
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

        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Tambah Data</h5>
                        <form action="{{ route('postTambahAdmin') }}" method="POST">
                            @csrf

                            <!-- Nama Admin -->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Nama Admin</label>
                                <input type="text" class="form-control border border-secondary form-control" name="name" required value="{{ old('name') }}">
                                <span class="text-danger">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Email Admin -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Email Admin</label>
                                <input type="email" class="form-control border border-secondary form-control" name="email" required value="{{ old('email') }}">
                                <span class="text-danger">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="form-group mt-1">
                                <label class="text-secondary">Pilih Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenisKelamin" value="Laki-laki">
                                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenisKelamin" value="Perempuan">
                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                </div>
                            </div>

                            <!-- Password Admin -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Password Admin</label>
                                <input type="password" class="form-control border border-secondary form-control" name="password" required>
                                <span class="text-danger">
                                    @error('password')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Konfirmasi Password Admin -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Konfirmasi Password Admin</label>
                                <input type="password" class="form-control border border-secondary form-control" name="password_confirmation" required>
                                <span class="text-danger">
                                    @error('password_confirmation')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- Tombol Tambah Data Admin -->
                            <button type="submit" class="btn btn-success mt-5">Tambah Data Admin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>