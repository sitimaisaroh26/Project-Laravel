<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Cetak Data Peminjaman</title>
    <style>
    /* CSS untuk mengatur tampilan laporan */
    body {
        text-align: center;
        font-family: Arial, sans-serif;
    }

    table {
        width: 95%;
        margin: 0 auto;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
    }

    .judul-laporan {
        font-size: 16pt;
        margin-top: 10px;
        font-weight: bold;
    }

    .logo {
        width: 100px;
        margin-right: 20px;
    }

    .alamat {
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="form-group">
        <table>
            <tr>
                <td>
                    <img class="logo" src="{{ public_path('images/POLBENG.png') }}" alt="logoKopSurat">
                </td>
                <td class="alamat">
                    <div>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</div>
                    <div>RISET DAN TEKNOLOGI</div>
                    <div>PERPUSTAKAAN POLITEKNIK NEGERI BENGKALIS</div>
                    <div>Jalan Bathin Alam, Sungai Alam, Bengkalis, Riau 28711</div>
                    <div>Telepon : (+62766) 24566, Fax: (+62766) 800 1000</div>
                    <div>Laman : http://www.polbeng.ac.id, Email : polbeng@polbeng.ac.id</div>
                </td>
            </tr>
        </table>
        <hr>
        <p class="judul-laporan">Laporan Data Peminjaman Buku Perpustakaan</p>
        <table>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Nama Peminjam</th>
                <th>Nama Buku</th>
            </tr>
            @foreach ($data as $peminjam)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peminjam->tanggal_pinjam }}</td>
                <td>{{ $peminjam->tanggal_kembali }}</td>
                <td>{{ $peminjam->name }}</td>
                <td>{{ $peminjam->judul_buku }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>