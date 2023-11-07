<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Link stylesheet Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Link Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Edit Data Buku</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis</a>
        </div>
    </nav>
    <div class="container">
        <a href="{{ route('admin.buku') }}">
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
                        <h5 class="card-title text-center">Update Data Buku</h5>
                        <form action="/postEditBuku/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- update kode buku -->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Kode Buku</label>
                                <input type="text" class="form-control border border-secondary form-control" name="kodeBuku" required value="{{ $data->kode_buku }}">
                                <span class="text-danger">
                                    @error('kodeBuku')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- update judul buku -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Judul Buku</label>
                                <input type="text" class="form-control border border-secondary form-control" name="judulBuku" required value="{{ $data->judul_buku }}">
                                <span class="text-danger">
                                    @error('judulBuku')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- update nama penulis -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Penulis</label>
                                <input type="text" class="form-control border border-secondary form-control" name="penulis" required value="{{ $data->penulis }}">
                                <span class="text-danger">
                                    @error('penulis')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- update nama penerbit -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Penerbit</label>
                                <input type="text" class="form-control border border-secondary form-control" name="penerbit" required value="{{ $data->penerbit }}">
                                <span class="text-danger">
                                    @error('penerbit')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- update tahun penerbit -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tahun Terbit</label>
                                <input type="text" class="form-control border border-secondary form-control" name="tahunTerbit" required value="{{ $data->tahun_terbit }}">
                                <span class="text-danger">
                                    @error('tahunTerbit')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- update cover buku -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Cover Buku</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->gambar }}" disabled>
                                <input class="form-control" type="file" name="gambar">
                                <!-- Maksimal ukuran gambar cover buku 5MB -->
                                <div class="form-text">Maksimal ukuran gambar cover buku 5MB</div>
                                <img class="mt-3" style="width: 100px" src="{{ asset('/images/' . $data->gambar) }}" alt="cover buku">
                            </div>

                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Kategori Buku</label>
                                <select class="form-select" aria-label="Floating label select example" name="kategori">
                                    <option value="Programmer" @if ($data->kategori == 'Programmer') selected
                                        @endif>Programmer</option>
                                    <option value="Sains" @if ($data->kategori == 'Sains') selected @endif>Sains
                                    </option>
                                    <option value="Komik" @if ($data->kategori == 'Komik') selected @endif>Komik
                                    </option>
                                    <!-- @foreach ($data as $option)
                                    <option value="{{ $option }}" @if ($option==$data->kategori) selected
                                        @endif>{{ $option }}</option>
                                    @endforeach -->
                                </select>
                                      
                            </div><br>

                            <!-- update deskripsi buku -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" style="height: 250px" required>{{ $data->deskripsi }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success mt-5">Update Data Buku</button>
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