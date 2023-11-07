<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang sesuai dengan model ini
    protected $table ='bukus';

    // Menentukan kolom-kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'gambar',
        'kode_buku',
        'judul_buku',
        'penulis',
        'penerbit',
        'kategori',
        'deskripsi',
        'tahun_penerbit'
    ];
}