<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Buku;
use App\Models\peminjaman;
use App\Models\berita;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Charts\ChartPeminjaman;




class AdminController extends Controller
{
    //===== ADMIN =====
    public function tambah()
    {
        // Fungsi ini mengarahkan pengguna ke tampilan untuk menambah data admin.
        return view('admin.tambah');
    }

    public function postTambahAdmin(Request $request)
    {
        // Validasi input dari formulir penambahan admin.
        $request->validate([
            'name' => 'required', // Nama admin wajib diisi.
            'email' => 'required|email', // Email wajib diisi dan harus berformat email.
            'jenisKelamin' => 'required', // Jenis kelamin wajib diisi.
            'password' => 'required|min:8|max:20|confirmed', //minimal pass 8, max pass 20
        ]);

        // Membuat instansi objek User (model) untuk menyimpan data admin baru.
        $user = new User;

        // Menyimpan data dari formulir ke dalam objek User.
        $user->name = $request->name; // Menyimpan nama admin.
        $user->email = $request->email; // Menyimpan email admin.
        $user->level = 'admin'; // Menyimpan level admin (misalnya, "admin").
        $user->jenis_kelamin = $request->jenisKelamin; // Menyimpan jenis kelamin admin.
        $user->password = Hash::make($request->password); // Mengenkripsi password admin sebelum disimpan.

        // Menyimpan data admin baru ke dalam database.
        $user->save();

        // Memeriksa apakah operasi penyimpanan berhasil atau tidak, kemudian memberikan respons sesuai hasilnya.
        if ($user) {
            // Jika berhasil, pengguna diarahkan kembali dengan pesan sukses.
            return back()->with('success', 'Admin baru berhasil ditambah!');
        } else {
            // Jika gagal, pengguna diarahkan kembali dengan pesan gagal.
            return back()->with('failed', 'Gagal menambah admin baru!');
        }
    }

    //edit admin
    public function editAdmin($id)
    {
        // Mencari data admin berdasarkan ID yang diberikan.
        $data = User::find($id);

        // Mengarahkan pengguna ke tampilan edit dengan data admin yang akan diedit.
        return view('admin.edit', compact('data'));
    }

    public function postEditAdmin(Request $request, $id)
    {
        // Validasi input yang diterima dari formulir edit admin.
        $request->validate([
            'name' => 'required', // Nama admin wajib diisi.
            'email' => 'required|email:dns', // Email wajib diisi dan harus berformat email.
            'jenisKelamin' => 'required', // Jenis kelamin wajib diisi.
        ]);

        // Mencari data admin berdasarkan ID yang diberikan.
        $user = User::find($id);

        // Mengupdate data admin dengan nilai yang baru.
        $user->name = $request->name; // Mengupdate nama admin.
        $user->email = $request->email; // Mengupdate email admin.
        $user->jenis_kelamin = $request->jenisKelamin; // Mengupdate jenis kelamin admin.
        $user->save(); // Menyimpan perubahan ke dalam database.

        // Memeriksa apakah operasi penyimpanan berhasil atau tidak, kemudian memberikan respons sesuai hasilnya.
        if ($user) {
            // Jika berhasil, pengguna diarahkan kembali dengan pesan sukses.
            return back()->with('success', 'Data admin berhasil diupdate!');
        } else {
            // Jika gagal, pengguna diarahkan kembali dengan pesan gagal.
            return back()->with('failed', 'Gagal mengupdate data admin!');
        }
    }

    // Delete admin
    public function deleteAdmin($id)
    {
        // Mencari data admin berdasarkan ID yang diberikan.
        $data = User::find($id);

        // Menghapus data admin.
        $data->delete();

        // Memeriksa apakah operasi penghapusan berhasil atau tidak, kemudian memberikan respons sesuai hasilnya.
        if ($data) {
            // Jika berhasil, pengguna diarahkan kembali dengan pesan sukses.
            return back()->with('success', 'Data berhasil dihapus!');
        } else {
            // Jika gagal, pengguna diarahkan kembali dengan pesan gagal.
            return back()->with('failed', 'Gagal menghapus data!');
        }
    }


    //====== BUKU ======

    public function adminBuku(Request $request)
    {
        // Mengambil kata kunci pencarian dari permintaan (request)
        $search = $request->input('search');

        // Mencari buku berdasarkan judul yang cocok dengan kata kunci pencarian
        $data = Buku::where(function ($query) use ($search) {
            $query->where('judul_buku', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        // Mengirim data hasil pencarian ke tampilan 'admin.buku'
        return view('admin.buku', compact('data'));
    }

    public function tambahBuku()
    {
        // Menampilkan halaman tambah buku
        return view('admin.tambahBuku');
    }

    public function postTambahBuku(Request $request)
    {
        // Validasi data yang diinputkan oleh pengguna
        $request->validate([
            'kodeBuku' => 'required',
            'judulBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required|date',
            'gambar' => 'required|image|max:5120', // Gambar harus berupa gambar dan ukuran maksimum 5MB
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);

        // Membuat objek Buku baru
        $buku = new Buku;

        // Mengisi properti-properti objek dengan data dari formulir
        $buku->kode_buku = $request->kodeBuku;
        $buku->judul_buku = $request->judulBuku;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahunTerbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kategori = $request->kategori;

        // Mengelola unggahan gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $buku->gambar = $filename;
        }

        // Menyimpan objek Buku ke database
        $buku->save();

        // Mengembalikan pesan ke halaman sebelumnya
        if ($buku) {
            return back()->with('success', 'Buku baru berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Data gagal ditambahkan!');
        }
    }


    // edit buku
    public function editBuku($id)
    {
        // Mengambil data buku yang akan diedit berdasarkan ID
        $data = Buku::find($id);

        // Menampilkan halaman edit buku dengan data buku yang dipilih
        return view('admin.editBuku', compact('data'));
    }

    public function postEditBuku(Request $request, $id)
    {
        // Validasi data yang diinputkan oleh pengguna untuk edit buku
        $request->validate([
            'kodeBuku' => 'required',
            'judulBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required|date',
            'gambar' => 'image|max:5120', // Gambar opsional, ukuran maksimum 5MB
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);

        // Mengambil data buku yang akan diedit berdasarkan ID
        $buku = Buku::find($id);

        // Mengisi properti-properti objek Buku dengan data dari formulir edit
        $buku->kode_buku = $request->kodeBuku;
        $buku->judul_buku = $request->judulBuku;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahunTerbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kategori = $request->kategori;

        // Mengelola unggahan gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);

            // Menghapus gambar lama jika ada
            $oldFilePath = public_path('images/') . $buku->gambar;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            $buku->gambar = $filename;
        }

        // Menyimpan objek Buku yang sudah diubah ke database
        $buku->save();

        // Mengembalikan pesan ke halaman sebelumnya
        if ($buku) {
            return back()->with('success', 'Buku berhasil diupdate!');
        } else {
            return back()->with('failed', 'Buku gagal diupdate!');
        }
    }

    // delete buku
    public function deleteBuku($id)
    {
        $buku = Buku::find($id); // Mengambil data buku yang akan dihapus berdasarkan ID
        if ($buku->gambar) { // Menghapus gambar yang terkait dengan buku
            $filePath = public_path('images/') . $buku->gambar;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Menghapus data buku dari database
        $buku->delete();
        if ($buku) { // Mengembalikan pesan ke halaman sebelumnya
            return back()->with('success', 'Data buku berhasil dihapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data buku!');
        }
    }



    // peminjaman buku
    public function adminPeminjaman(Request $request, ChartPeminjaman
    $chartPeminjaman)
    {
        //pencarian buku
        $search = $request->input('search');
        $data = Peminjaman::where(function ($query) use ($search) {
            $query->where('id_user', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        $chart = $chartPeminjaman->build(); // Inisialisasi objek ChartPeminjaman
        return view('admin.peminjaman', compact('data', 'chart'));
    }

    //tambah peminjaman
    public function tambahPeminjaman()
    {
        return view('admin.tambahPeminjaman');
    }
    public function postTambahPeminjaman(Request $request)
    {
        $request->validate([
            'idUser' => 'required',
            'kodeBuku' => 'required|int',
            'tanggalPeminjaman' => 'required|date',
            'tanggalPengembalian' => 'required|date'
        ]);
        $peminjaman = new Peminjaman;
        $peminjaman->id_user = $request->idUser;
        $peminjaman->id_buku = $request->kodeBuku;
        $peminjaman->tanggal_pinjam = $request->tanggalPeminjaman;
        $peminjaman->tanggal_kembali = $request->tanggalPengembalian;
        $peminjaman->status = 'Belum Dikembalikan';
        $peminjaman->save();
        if ($peminjaman) {
            return back()->with('success', 'Data peminjaman berhasil 
        ditambahkan!');
        } else {
            return back()->with('failed', 'Gagal menambahkan data 
        peminjaman!');
        }
    }

    //edit peminjaman
    public function editPeminjaman($id)
    {
        $data = Peminjaman::find($id);
        return view('admin/editPeminjaman', compact('data'));
    }
    public function postEditPeminjaman(Request $request, $id)
    {
        $request->validate([
            'idUser' => 'required',
            'kodeBuku' => 'required|int',
            'tanggalPeminjaman' => 'required',
            'tanggalPengembalian' => 'required',
            'status' => 'required'
        ]);
        $peminjaman = Peminjaman::find($id);
        $peminjaman->id_user = $request->idUser;
        $peminjaman->id_buku = $request->kodeBuku;
        $peminjaman->tanggal_pinjam = $request->tanggalPeminjaman;
        $peminjaman->tanggal_kembali = $request->tanggalPengembalian;
        $peminjaman->status = $request->status;
        $peminjaman->save();
        if ($peminjaman) {
            return back()->with('success', 'Data peminjaman berhasil di 
        update!');
        } else {
            return back()->with('failed', 'Gagal mengupdate data 
        peminjaman!');
        }
    }

    //hapus peminjaman
    public function deletePeminjaman($id)
    {
        $data = Peminjaman::find($id);
        $data->delete(); //menghapus data peminjaman dari database
        if ($data) {
            return back()->with('success', 'Data peminjaman berhasil di 
        hapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data 
        peminjaman!');
        }
    }

    //detail peminjaman
    public function detailPeminjaman($id_peminjaman, $id_user, $id_buku)
    {
        $detailPeminjaman = Peminjaman::select('peminjamen.*', 'bukus.*', 'users.*')
            ->join('bukus', 'peminjamen.id_buku', 'bukus.id')
            ->join('users', 'peminjamen.id_user', 'users.id')
            ->where('peminjamen.id', $id_peminjaman)
            ->first();


        if (!$detailPeminjaman) {
            abort(404, 'Data tidak ditemukan.');
        }

        return view('admin.detailPeminjaman', compact('detailPeminjaman'));
    }

    // Cetak data peminjaman
    public function cetakDataPeminjaman()
    {
        $data = DB::table('peminjamen') // Perhatikan nama tabel 'peminjamen'
            ->join('users', 'users.id', '=', 'peminjamen.id_user')
            ->join('bukus', 'bukus.id', '=', 'peminjamen.id_buku') // Perhatikan nama tabel 'bukus'
            ->select('peminjamen.*', 'users.name', 'bukus.judul_buku') // Perhatikan nama tabel 'peminjamen' dan 'bukus'
            ->get();

        $pdf = PDF::loadView('admin.cetakPeminjaman', ['data' => $data]);

        return $pdf->stream();
    }


    //ini controller berita
    public function adminberita(Request $request)
    {
        // Mengambil kata kunci pencarian dari permintaan (request)
        $search = $request->input('search');

        // Mencari buku berdasarkan judul yang cocok dengan kata kunci pencarian
        $data = berita::where(function ($query) use ($search) {
            $query->where('judulberita', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        // Mengirim data hasil pencarian ke tampilan 'admin.berita'
        return view('admin.berita', compact('data'));
    }

    //1.input berita
    public function inputberita()
    {
        // Fungsi ini mengarahkan pengguna ke tampilan untuk menambah data admin.
        return view('admin.inputberita');
    }
    public function postBerita(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|max:5120', // Gambar harus berupa gambar dan ukuran maksimum 5MB
            'judulberita' => 'required',
            'isiberita' => 'required',
        ]);
        //membuat objek baru 
        $beritah = new berita;
        $beritah->judulberita = $request->judulberita;
        $beritah->isiberita = $request->isiberita;

        // Mengelola unggahan gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $beritah->gambar = $filename;
        }

        //menyimpan objek berita ke database
        $beritah->save();

        // Mengembalikan pesan ke halaman sebelumnya
        if ($beritah) {
            return back()->with('success', 'Berita baru berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Data gagal ditambahkan!');
        }
    }

    //2. edit berita
    public function editberita($id)
    {
        // Mengambil data buku yang akan diedit berdasarkan ID
        $data = berita::find($id);
        // Menampilkan halaman edit buku dengan data buku yang dipilih
        return view('admin.editberita', compact('data'));
    }

    public function posteditberita(Request $request, $id)
    {
        // Validasi data yang diinputkan oleh pengguna untuk edit berita
        $request->validate([
            'judulberita' => 'required',
            'isiberita' => 'required',
        ]);

        // Mengambil data berita yang akan diedit berdasarkan ID
        $beritah = berita::find($id);

        // Mengisi properti-properti objek Berita dengan data dari formulir edit
        $beritah->judulberita = $request->judulberita;
        $beritah->isiberita = $request->isiberita;

        // Mengelola unggahan gambar hanya jika ada file gambar yang diunggah
        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'image|max:5120', // Gambar harus berupa gambar dan ukuran maksimum 5MB
            ]);

            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);

            // Menghapus gambar lama jika ada
            $oldFilePath = public_path('images/') . $beritah->gambar;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            $beritah->gambar = $filename;
        }

        // Menyimpan objek Berita yang sudah diubah ke database
        $beritah->save();

        // Mengembalikan pesan ke halaman sebelumnya
        if ($beritah) {
            return back()->with('success', 'Berita berhasil diupdate!');
        } else {
            return back()->with('failed', 'Berita gagal diupdate!');
        }
    }

    // 3.delete berita
    public function deleteberita($id)
    {
        $beritah = berita::find($id); // Mengambil data buku yang akan dihapus berdasarkan ID
        if ($beritah->gambar) { // Menghapus gambar yang terkait dengan buku
            $filePath = public_path('images/') . $beritah->gambar;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Menghapus data buku dari database
        $beritah->delete();
        if ($beritah) { // Mengembalikan pesan ke halaman sebelumnya
            return back()->with('success', 'Data buku berhasil dihapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data buku!');
        }
    }
}
