<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Detail Peminjaman</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis | D-IV Rekayasa Perangkat Lunak</a>
        </div>
    </nav>
    <div class="container">
        <!-- Tombol Kembali -->
        <a href="{{ route('admin.peminjaman') }}">
            <i class="bi-arrow-left h1"></i>
        </a>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <!-- Judul Kartu -->
                        <h5 class="card-title text-center">Detail Peminjaman</h5>
                        <div class="text-center">
                            <!-- Gambar Buku -->
                            <img class="rounded mt-5 mb-5" style="width: 200px" src="{{ asset('images/' . $detailPeminjaman->gambar) }}" alt="cover buku">
                        </div>
                        <div class="row text-center">
                            <div class="col"></div>
                            <div class="col-12">
                                <!-- Input ID Peminjaman -->
                                <input class="form-control mb-3 text-center" type="text" value="ID Peminjaman : {{ $detailPeminjaman->id }}" disabled readonly>
                                <!-- Input Tanggal Peminjaman -->
                                <input class="form-control mb-3 text-center" type="text" value="Tanggal Peminjaman : {{ $detailPeminjaman->tanggal_pinjam }}" disabled readonly>
                                <!-- Input Tanggal Pengembalian -->
                                <input class="form-control mb-3 text-center" type="text" value="Tanggal Pengembalian : {{ $detailPeminjaman->tanggal_kembali }}" disabled readonly>
                                <!-- Input Status Pengembalian -->
                                <input class="form-control mb-3 text-center" type="text" value="Status Pengembalian : {{ $detailPeminjaman->status }}" disabled readonly>
                                <!-- Input ID Anggota -->
                                <input class="form-control mb-3 text-center" type="text" value="ID Anggota : {{ $detailPeminjaman->id_user }}" disabled readonly>
                                <!-- Input Nama Anggota -->
                                <input class="form-control mb-3 text-center" type="text" value="Nama Anggota : {{ $detailPeminjaman->name }}" disabled readonly>
                                <!-- Input Email Anggota -->
                                <input class="form-control mb-3 text-center" type="text" value="Email Anggota : {{ $detailPeminjaman->email }}" disabled readonly>
                                <!-- Input ID Buku -->
                                <input class="form-control mb-3 text-center" type="text" value="ID Buku : {{ $detailPeminjaman->id_buku }}" disabled readonly>
                                <!-- Input Kode Buku -->
                                <input class="form-control mb-3 text-center" type="text" value="Kode Buku : {{ $detailPeminjaman->kode_buku }}" disabled readonly>
                                <!-- Input Judul Buku -->
                                <input class="form-control mb-3 text-center" type="text" value="Judul Buku : {{ $detailPeminjaman->judul_buku }}" disabled readonly>
                                <!-- Input Penulis -->
                                <input class="form-control mb-3 text-center" type="text" value="Penulis : {{ $detailPeminjaman->penulis }}" disabled readonly>
                                <!-- Input Penerbit -->
                                <input class="form-control mb-3 text-center" type="text" value="Penerbit : {{ $detailPeminjaman->penerbit }}" disabled readonly>
                                <!-- Input Tahun Terbit -->
                                <input class="form-control text-center" type="text" value="Tahun Terbit : {{ $detailPeminjaman->tahun_terbit }}" disabled readonly>
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>