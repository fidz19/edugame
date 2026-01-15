<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'subject'
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * Relasi: Satu guru bisa punya banyak siswa
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'teacher_id');
    }

    /**
     * Get students by specific class
     */
    public function getStudentsByClass($class)
    {
        return $this->students()->where('kelas', $class)->get();
    }

    /**
     * Get all unique classes taught by this teacher
     */
    public function getClasses()
    {
        return $this->students()
            ->select('kelas')
            ->distinct()
            ->orderBy('kelas')
            ->pluck('kelas');
    }
}
