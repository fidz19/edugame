<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'subject',
        'day_of_week',
        'start_time',
        'end_time',
        'location',
        'notes',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'day_of_week' => 'integer'
    ];

    /**
     * Relasi: Jadwal untuk siswa
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relasi: Jadwal dengan guru
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Relasi: Jadwal dibuat oleh admin
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope untuk jadwal aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk filter by hari
     */
    public function scopeForDay($query, $day)
    {
        return $query->where('day_of_week', $day);
    }

    /**
     * Scope untuk jadwal hari ini
     */
    public function scopeToday($query)
    {
        $today = Carbon::now()->dayOfWeekIso; // 1 = Senin, 7 = Minggu
        return $query->where('day_of_week', $today);
    }

    /**
     * Scope untuk jadwal guru tertentu
     */
    public function scopeForTeacher($query, $teacherId)
    {
        return $query->where('teacher_id', $teacherId);
    }

    /**
     * Scope untuk jadwal siswa tertentu
     */
    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    /**
     * Get nama hari dari angka
     */
    public function getDayName()
    {
        $days = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];

        return $days[$this->day_of_week] ?? '-';
    }

    /**
     * Get formatted time range
     */
    public function getTimeRange()
    {
        return Carbon::parse($this->start_time)->format('H:i') . ' - ' .
            Carbon::parse($this->end_time)->format('H:i');
    }
}
