<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';

    protected $fillable = ['nama', 'email'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
