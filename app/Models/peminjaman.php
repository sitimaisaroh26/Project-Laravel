<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang sesuai dengan model ini
    protected $table = 'peminjamen';

    protected $fillable = [
        'tanggal_pinjam',
        'tanggal_kembali',
        'id_buku',
        'id_user',
        'status'

    ];
}
