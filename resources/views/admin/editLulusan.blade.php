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

    <!-- back -->
    <div class="container">
        <a href="{{ route('admin.lulusan') }}">
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
                        <h5 class="card-title text-center">Update Data Lulusan</h5>
                        <!-- ini penting -->
                        <form action="/postEditLulusan/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- update NIP-->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">NIM</label>
                                <input type="text" class="form-control border border-secondary form-control" name="NIM" required value="{{ $data->NIM }}">
                                <span class="text-danger">
                                    @error('NIM')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- update Nama -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Mahasiswa</label>
                                <input type="text" class="form-control border border-secondary form-control" name="Nama" required value="{{ $data->Nama }}">
                                <span class="text-danger">
                                    @error('Nama')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <!-- update gambar -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto Lulusan</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->gambar }}" disabled>
                                <input class="form-control" type="file" name="gambar">
                                <!-- Maksimal ukuran gambar cover buku 5MB -->
                                <div class="form-text">Maksimal ukuran gambar cover buku 5MB</div>
                                <img class="mt-3" style="width: 100px" src="{{ asset('/images/' . $data->gambar) }}" alt="Foto Dosen">
                            </div>

                            <!-- update prodi -->
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Program Studi</label>
                                <select class="form-select" aria-label="Floating label select example" name="ProgramStudi">
                                    <option value="D2 Jalur
                                        Cepat Administrasi Jaringan Komputer" @if ($data->ProgramStudi == 'D2 Jalur
                                        Cepat Administrasi Jaringan Komputer')selected
                                        @endif>D2 Jalur Cepat Administrasi Jaringan Komputer
                                    </option>
                                    <option value="D3 Teknik Informatika" @if ($data->ProgramStudi == 'D3 Teknik
                                        Informatika') selected @endif>D3 Teknik Informatika
                                    </option>
                                    <option value="D4 Rekayasa Perangkat Lunak" @if ($data->ProgramStudi == 'D4 Rekayasa
                                        Perangkat Lunak')selected @endif>D4 Rekayasa Perangkat Lunak
                                    </option>
                                    <option value="D4 Keamanan Sistem Informasi" @if ($data->ProgramStudi == 'D4
                                        Keamanan Sistem Informasi')selected @endif>D4 Keamanan Sistem Informasi
                                    </option>
                                    <!-- @foreach ($data as $option)
                                    <option value="{{ $option }}" @if ($option==$data->kategori) selected
                                        @endif>{{ $option }}</option>
                                    @endforeach -->
                                </select>
                                      
                            </div><br>

                            <!-- update IPK-->
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">IPK</label>
                                <input type="text" class="form-control border border-secondary form-control" name="IPK" required value="{{ $data->IPK }}">
                                <span class="text-danger">
                                    @error('IPK')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <button type="submit" class="btn btn-success mt-5">Update Data Lulusan</button>
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