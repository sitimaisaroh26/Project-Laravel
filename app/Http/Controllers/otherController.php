<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Berita;
use App\Models\Lulusan;
use Faker\Calculator\Luhn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class othercontroller extends Controller
{

    public function lulusan()
    {
        return view('lulusan');
    }

    public function aktifitas()
    {
        return view('aktifitas');
    }
    public function biodata()
    {
        return view('biodata');
    }
    public function home()
    {
        return view('home');
    }

    //ini controller dosen
    public function adminDosen(Request $request)
    {
        // Mengambil kata kunci pencarian dari permintaan (request)
        $search = $request->input('search');

        // Mencari buku berdasarkan judul yang cocok dengan kata kunci pencarian
        $data = Dosen::where(function ($query) use ($search) {
            $query->where('Nama', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        // Mengirim data hasil pencarian ke tampilan 'admin.berita'
        return view('admin.dosen', compact('data'));
    }

    //1. tambah dosen
    public function tambahDosen()
    {
        // Menampilkan halaman tambah buku
        return view('admin.tambahDosen');
    }

    public function postTambahDosen(Request $request)
    {
        // Validasi data yang diinputkan oleh pengguna
        $request->validate([
            'gambar' => 'required|image|max:5120',
            'NIP' => 'required',
            'Nama' => 'required',
            'ProgramStudi' => 'required',
        ]);

        // Membuat objek Buku baru
        $dosen = new Dosen;

        // Mengisi properti-properti objek dengan data dari formulir
        $dosen->NIP = $request->NIP;
        $dosen->Nama = $request->Nama;
        $dosen->ProgramStudi = $request->ProgramStudi;

        // Mengelola unggahan gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $dosen->gambar = $filename;
        }

        // Menyimpan objek Buku ke database
        $dosen->save();

        // Mengembalikan pesan ke halaman sebelumnya
        if ($dosen) {
            return back()->with('success', 'Buku baru berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Data gagal ditambahkan!');
        }
    }

    //2. edit berita
    public function editDosen($id)
    {
        // Mengambil data buku yang akan diedit berdasarkan ID
        $data = Dosen::find($id);
        // Menampilkan halaman edit buku dengan data buku yang dipilih
        return view('admin.editDosen', compact('data'));
    }

    public function postEditDosen(Request $request, $id)
    {
        // Validasi data yang diinputkan oleh pengguna untuk edit berita
        $request->validate([
            'NIP' => 'required',
            'Nama' => 'required',
            'ProgramStudi' => 'required',
        ]);

        // Mengambil data berita yang akan diedit berdasarkan ID
        $dosen = Dosen::find($id);

        // Mengisi properti-properti objek Berita dengan data dari formulir edit
        $dosen->NIP = $request->NIP;
        $dosen->Nama = $request->Nama;
        $dosen->ProgramStudi = $request->ProgramStudi;

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
            $oldFilePath = public_path('images/') . $dosen->gambar;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            $dosen->gambar = $filename;
        }

        // Menyimpan objek Berita yang sudah diubah ke database
        $dosen->save();

        // Mengembalikan pesan ke halaman sebelumnya
        if ($dosen) {
            return back()->with('success', 'dosen berhasil diupdate!');
        } else {
            return back()->with('failed', 'dosen gagal diupdate!');
        }
    }
    // 3.delete dosen
    public function deleteDosen($id)
    {
        $dosen = Dosen::find($id); // Mengambil data buku yang akan dihapus berdasarkan ID
        if ($dosen->gambar) { // Menghapus gambar yang terkait dengan buku
            $filePath = public_path('images/') . $dosen->gambar;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Menghapus data buku dari database
        $dosen->delete();
        if ($dosen) { // Mengembalikan pesan ke halaman sebelumnya
            return back()->with('success', 'Data doosen berhasil dihapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data dosen!');
        }
    }

    //user ==> data berita
    public function userBerita(Request $request)
    {
        $search = $request->input('search');
        $data = Berita::where(function ($query) use ($search) {
            $query->where('judulberita', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        return view('user.lihatBerita', compact('data'));
    }

    //user ==> lihat dosen
    public function userDosen(Request $request)
    {
        $search = $request->input('search');
        $data = Dosen::where(function ($query) use ($search) {
            $query->where('Nama', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        return view('user.lihatDosen', compact('data'));
    }


    //ini controller lulusan
    public function adminLulusan(Request $request)
    {
        // Mengambil kata kunci pencarian dari permintaan (request)
        $search = $request->input('search');

        // Mencari buku berdasarkan judul yang cocok dengan kata kunci pencarian
        $data = Lulusan::where(function ($query) use ($search) {
            $query->where('Nama', 'LIKE', '%' . $search . '%');
        })->paginate(5);

        // Mengirim data hasil pencarian ke tampilan 'admin.berita'
        return view('admin.lulusan', compact('data'));
    }

    //1. tambah lulusan
    public function tambahLulusan()
    {
        // Menampilkan halaman tambah buku
        return view('admin.tambahLulusan');
    }

    public function postTambahLulusan(Request $request)
    {
        // Validasi data yang diinputkan oleh pengguna
        $request->validate([
            'gambar' => 'required|image|max:5120',
            'NIM' => 'required',
            'Nama' => 'required',
            'ProgramStudi' => 'required',
            'IPK' => 'required',
        ]);

        // Membuat objek Buku baru
        $lulusan = new Lulusan;

        // Mengisi properti-properti objek dengan data dari formulir
        $lulusan->NIM = $request->NIM;
        $lulusan->Nama = $request->Nama;
        $lulusan->ProgramStudi = $request->ProgramStudi;
        $lulusan->IPK = $request->IPK;

        // Mengelola unggahan gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $lulusan->gambar = $filename;
        }

        // Menyimpan objek Buku ke database
        $lulusan->save();

        // Mengembalikan pesan ke halaman sebelumnya
        if ($lulusan) {
            return back()->with('success', 'Data Lulusan baru berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Data gagal ditambahkan!');
        }
    }

    //2. edit berita
    public function editLulusan($id)
    {
        // Mengambil data buku yang akan diedit berdasarkan ID
        $data = Lulusan::find($id);
        // Menampilkan halaman edit buku dengan data buku yang dipilih
        return view('admin.editLulusan', compact('data'));
    }

    public function postEditLulusan(Request $request, $id)
    {
        // Validasi data yang diinputkan oleh pengguna untuk edit berita
        $request->validate([
            'NIP' => 'required',
            'Nama' => 'required',
            'ProgramStudi' => 'required',
            'NIK' => 'required',
        ]);

        // Mengambil data berita yang akan diedit berdasarkan ID
        $lulusan = Lulusan::find($id);

        // Mengisi properti-properti objek Berita dengan data dari formulir edit
        $lulusan->NIP = $request->NIP;
        $lulusan->Nama = $request->Nama;
        $lulusan->ProgramStudi = $request->ProgramStudi;
        $lulusan->NIK = $request->NIK;

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
            $oldFilePath = public_path('images/') . $lulusan->gambar;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            $lulusan->gambar = $filename;
        }

        // Menyimpan objek Berita yang sudah diubah ke database
        $lulusan->save();

        // Mengembalikan pesan ke halaman sebelumnya
        if ($lulusan) {
            return back()->with('success', 'Data Lulusan berhasil diupdate!');
        } else {
            return back()->with('failed', 'Lulusan gagal diupdate!');
        }
    }
     // 3.delete dosen
     public function deleteLulusan($id)
     {
         $lulusan = Lulusan::find($id); // Mengambil data buku yang akan dihapus berdasarkan ID
         if ($lulusan->gambar) { // Menghapus gambar yang terkait dengan buku
             $filePath = public_path('images/') . $lulusan->gambar;
             if (file_exists($filePath)) {
                 unlink($filePath);
             }
         }
 
         // Menghapus data buku dari database
         $lulusan->delete();
         if ($lulusan) { // Mengembalikan pesan ke halaman sebelumnya
             return back()->with('success', 'Data doosen berhasil dihapus!');
         } else {
             return back()->with('failed', 'Gagal menghapus data dosen!');
         }
     }
}