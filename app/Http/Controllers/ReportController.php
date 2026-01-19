<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Transaction;

class ReportController extends Controller
{
    /**
     * Tampilkan halaman laporan harian.
     */
    // LIST / FILTER LAPORAN (harian / mingguan / bulanan)
    public function index(Request $request)
    {
        $type = $request->type ?? 'daily'; // daily | weekly | monthly

        if ($type === 'daily') {
            $date = $request->date ?? Carbon::today()->toDateString();
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date)->endOfDay();
            $label = 'Harian - ' . Carbon::parse($date)->format('d-m-Y');
        } elseif ($type === 'weekly') {
            $date = $request->date ?? Carbon::today()->toDateString();
            $start = Carbon::parse($date)->startOfWeek();
            $end = Carbon::parse($date)->endOfWeek();
            $label = 'Mingguan - ' . $start->format('d-m-Y') . ' s/d ' . $end->format('d-m-Y');
        } elseif ($type === 'monthly') {
            $month = $request->month ?? Carbon::now()->format('Y-m');
            $start = Carbon::parse($month . '-01')->startOfMonth();
            $end = Carbon::parse($month . '-01')->endOfMonth();
            $label = 'Bulanan - ' . $start->format('d-m-Y') . ' s/d ' . $end->format('d-m-Y');
        } else {
            // fallback ke daily
            $date = Carbon::today()->toDateString();
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date)->endOfDay();
            $label = 'Harian - ' . Carbon::parse($date)->format('d-m-Y');
            $type = 'daily';
        }

        $transactions = Transaction::whereBetween('created_at', [$start, $end])->get();
        $total = $transactions->sum('total_price');

        return view('admin.report.daily', compact('transactions', 'total', 'type', 'date', 'month', 'label', 'start', 'end'));
    }

    // Generate PDF (harian / mingguan / bulanan)
    public function pdf(Request $request)
    {
        $type = $request->type ?? 'daily';

        if ($type === 'daily') {
            $date = $request->date ?? Carbon::today()->toDateString();
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date)->endOfDay();
            $label = 'Harian - ' . Carbon::parse($date)->format('d-m-Y');
            $filename = 'laporan-penjualan-' . $date . '.pdf';
        } elseif ($type === 'weekly') {
            $date = $request->date ?? Carbon::today()->toDateString();
            $start = Carbon::parse($date)->startOfWeek();
            $end = Carbon::parse($date)->endOfWeek();
            $label = 'Mingguan - ' . $start->format('d-m-Y') . ' s/d ' . $end->format('d-m-Y');
            $filename = 'laporan-penjualan-minggu-' . $start->format('Y-m-d') . '.pdf';
        } elseif ($type === 'monthly') {
            $month = $request->month ?? Carbon::now()->format('Y-m');
            $start = Carbon::parse($month . '-01')->startOfMonth();
            $end = Carbon::parse($month . '-01')->endOfMonth();
            $label = 'Bulanan - ' . $start->format('d-m-Y') . ' s/d ' . $end->format('d-m-Y');
            $filename = 'laporan-penjualan-bulan-' . str_replace('-', '', $month) . '.pdf';
        } else {
            $date = Carbon::today()->toDateString();
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date)->endOfDay();
            $label = 'Harian - ' . Carbon::parse($date)->format('d-m-Y');
            $filename = 'laporan-penjualan-' . $date . '.pdf';
            $type = 'daily';
        }

        $transactions = Transaction::whereBetween('created_at', [$start, $end])->get();
        $total = $transactions->sum('total_price');

        $pdf = Pdf::loadView('admin.report.daily_pdf', compact('transactions', 'total', 'label', 'start', 'end'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream($filename);
    }
}
