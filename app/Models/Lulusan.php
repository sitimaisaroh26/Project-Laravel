<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lulusan extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang sesuai dengan model ini
    protected $table = 'lulusan';

    // Menentukan kolom-kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'gambar',
        'NIM',
        'Nama',
        'ProgramStudi',
        'IPK',
    ];
}