<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Tambahkan ini agar nama_anak dan kelas bisa disimpan ke database
    protected $fillable = [
        'nama_anak',
        'kelas',
        'parent_id',
        'teacher_id',
        'user_id'
    ];

    // Relasi ke Orang Tua sudah benar
    public function orangtua()
    {
        return $this->belongsTo(OrangTua::class, 'parent_id');
    }

    // Alias relasi untuk Filament resources (expects "parent")
    public function parent()
    {
        return $this->belongsTo(OrangTua::class, 'parent_id');
    }

    // Relasi ke Guru
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // Relasi ke scores
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    // Relasi ke game sessions
    public function gameSessions()
    {
        return $this->hasMany(GameSession::class);
    }
}
