<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_anak' => 'required|string|max:255',
            'kelas' => 'required|integer|min:1|max:6'
        ]);

        // Cek ke database apakah anak ada dengan nama dan kelas yang sesuai
        $student = DB::table('students')
            ->where('nama_anak', $request->nama_anak)
            ->where('kelas', $request->kelas)
            ->first();

        // Jika data tidak ditemukan
        if (!$student) {
            return back()->with('error', 'Halo! Sepertinya nama atau kelas kamu belum terdaftar. Coba cek lagi ya, atau minta bantuan guru/orang tua untuk mendaftarkan kamu! 😊');
        }

        // Jika data ditemukan, simpan ke session
        session([
            'student_id' => $student->id,
            'student_name' => $student->nama_anak,
            'student_class' => $student->kelas,
            'is_student_logged_in' => true
        ]);

        // Cek apakah ada game yang dituju sebelumnya
        if (session('intended_game_slug')) {
            $gameSlug = session('intended_game_slug');
            session()->forget('intended_game_slug'); // Hapus dari session

            // Redirect ke game start (akan otomatis create session dan mulai game)
            return redirect()->route('games.start', $gameSlug);
        }

        // Redirect ke halaman pilihan game
        return redirect()->route('games.index')->with('success', 'Selamat datang, ' . $student->nama_anak . '!');
    }

    public function logout()
    {
        session()->forget(['student_id', 'student_name', 'student_class', 'is_student_logged_in']);
        return redirect()->route('home')->with('success', 'Sampai jumpa lagi!');
    }
}