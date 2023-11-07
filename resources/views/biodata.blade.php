<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tambahkan link Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <title>CV by Siti Maisaroh</title>

    <style>
    /* Tambahkan gaya kustom untuk latar belakang navbar */
    .navbar-custom {
        background-color: #0B22FF;
        /* Warna latar belakang biru tua */
    }

    /* Gaya untuk foto profil */
    .profile-picture {
        width: 150px;
        /* Lebar foto profil */
        height: 150px;
        /* Tinggi foto profil */
        border-radius: 50%;
        /* Membuat foto profil berbentuk bulat */
        object-fit: cover;
        /* Memastikan gambar tidak terdistorsi */
        margin: 20px auto;
        /* Margins untuk penempatan foto profil */
        display: block;
        /* Memastikan foto profil berada di tengah */
    }
    </style>
</head>

<body>

    <!-- Membuat navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <!-- Gunakan kelas CSS yang telah ditambahkan -->
        <div class="container">
            <a class="navbar-brand" href="#">Sara</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">My CV</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">About Me</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br><br>
    <!-- Tambahkan foto profil -->
    <div class="container text-center">
        <img src="/images/sara.jpeg" alt="Foto Profil" class="profile-picture">

        <h3>Siti Maisaroh</h3>
        <h5>Mahasiswa</h5>

        <br>

        <hr>
        <!-- ini adalah garis lurus -->


        <h5>Overview</h5>

        <p>Nama saya Siti Maisaroh, nama panggilan saya sara. <br> Saya mahasiswa Politeknik Negeri Bengkalis<br>
            Jurusan Teknik Informatika, Program Studi Rekayasa Perangkat Lunak.<br>
            Saat ini saya telah semester 5.
        </p>


    </div>

    <!-- Tambahkan tabel -->
    <div class="container mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Skill</th>
                    <th>Pengalaman Organisasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Saya memiliki skill pada seni sastra<br>
                    </td>
                    <td>Saya pernah mengikuti organisasi UKM Olahraga pada tahun 2022 sampai sekarang, <br>
                        Saya juga mengikuti UKM Kesenian Bathin Alam<br>
                        di Ukm kesenian saya mendalami seni sastra.<br>
                    </td>
                </tr>

            </tbody>
        </table>
        <hr>
    </div>

    <!-- footer -->
    <section>
        <footer class="bg-light text-primary pt-5 pb-4">
            <div class="container">
                <hr>
                <div class="row align-item-center">
                    <div class="col-md-7 col-lg-8">
                        <p>Copyright @2023 All right reserved by : <a href="#" style="text-decoration: none;"><strong
                                    class="text-warning">Siti_Maisaroh</strong></p>
                    </div>
                </div>
            </div>
        </footer>
    </section>



    <!-- Tambahkan script Bootstrap JavaScript (jQuery diperlukan) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>