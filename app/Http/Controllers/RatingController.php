<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    // AKSES KASIR: Menyimpan rating setelah bayar
    public function store(Request $request)
    {
        // Cek jika input bernama 'rating', ubah ke 'score'
        if (!$request->has('score') && $request->has('rating')) {
            $request->merge(['score' => $request->rating]);
        }

        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'score'          => 'required|integer|min:1|max:5',
            'comment'        => 'nullable|string|max:255',
        ]);

        if (Rating::where('transaction_id', $request->transaction_id)->exists()) {
            return back()->with('error', 'Transaksi ini sudah dinilai!');
        }

        Rating::create([
            'transaction_id' => $request->transaction_id,
            'user_id'        => Auth::id(),
            'score'          => $request->score,
            'comment'        => $request->comment,
        ]);

        return back()->with('success', 'Rating berhasil disimpan!');
    }

    // AKSES ADMIN: Melihat semua laporan rating
    
}
