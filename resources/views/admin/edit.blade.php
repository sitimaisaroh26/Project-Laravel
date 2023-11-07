<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Edit Data</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <!-- Navigasi Navbar -->
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis | D-IV Rekayasa Perangkat Lunak</a>
        </div>
    </nav>
    <div class="container">
        <a href="{{ route('admin.home') }}">

            <!-- Tombol Kembali ke Halaman Admin -->
            <i class="bi-arrow-left h1"></i>
        </a>
        <div class="container mt-3">
            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">

                <!-- Pesan Sukses -->
                <strong>Berhasil!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (Session::get('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <!-- Pesan Gagal -->
                <strong>Gagal!</strong> {{ Session::get('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Data</h5>
                        <form action="/postEditAdmin/{{ $data->id }}" method="POST">
                            @csrf
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Nama Admin</label>
                                <!-- Input Nama Admin -->
                                <input type="text" class="form-control border border-secondary form-control" name="name"
                                    required value="{{ $data->name }}">
                                <span class="text-danger">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Email Admin</label>
                                <!-- Input Email Admin -->
                                <input type="email" class="form-control border border-secondary form-control"
                                    name="email" required value="{{ $data->email }}">
                                <span class="text-danger">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary">Pilih Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <!-- Pilihan Jenis Kelamin Laki-laki -->
                                    <input class="form-check-input" type="radio" name="jenisKelamin" value="Laki-laki"
                                        @if ($data->jenis_kelamin == 'Laki-laki') checked @endif>
                                    <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <!-- Pilihan Jenis Kelamin Perempuan -->
                                    <input class="form-check-input" type="radio" name="jenisKelamin" value="Perempuan"
                                        @if ($data->jenis_kelamin == 'Perempuan') checked @endif>
                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                </div>
                            </div>
                            <!-- Tombol Edit Data Admin -->
                            <button type="submit" class="btn btn-success mt-5">Edit Data Admin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>