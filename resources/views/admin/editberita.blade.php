<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link stylesheet Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Link Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis</a>
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
                        <h5 class="card-title text-center">Update data berita</h5>

                        <form action="/posteditberita/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- form gambar berita-->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Gambar Berita</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->gambar }}" disabled>
                                <input class="form-control" type="file" name="gambar">
                                <!-- Maksimal ukuran gambar cover buku 5MB -->
                                <div class="form-text">Maksimal ukuran gambar cover buku 5MB</div>
                                <img class="mt-3" style="width: 100px" src="{{ asset('/images/' . $data->gambar) }}" alt="gambarberita">
                            </div>

                            <!-- update judul berita -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Judul Berita</label>
                                <input type="text" class="form-control border border-secondary form-control" name="judulberita" required value="{{ $data->judulberita }}">
                                <span class="text-danger">
                                    @error('judulberita')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- update isi berita -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Isi Berita</label>
                                <textarea class="form-control" name="isiberita" style="height: 250px" required>{{ $data->isiberita }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success mt-5">Update Data Berita</button>
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