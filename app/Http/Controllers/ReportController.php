<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type ?? 'daily';
        // Inisialisasi variabel agar tidak error di view
        $date = $request->date ?? Carbon::today()->toDateString();
        $month = $request->month ?? Carbon::now()->format('Y-m');
        $start_date = $request->start_date ?? Carbon::today()->toDateString();
        $end_date = $request->end_date ?? Carbon::today()->toDateString();

        if ($type === 'custom') {
            $start = Carbon::parse($start_date)->startOfDay();
            $end = Carbon::parse($end_date)->endOfDay();
            $label = 'Periode: ' . $start->format('d-m-Y') . ' s/d ' . $end->format('d-m-Y');
        } elseif ($type === 'daily') {
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date)->endOfDay();
            $label = 'Harian - ' . Carbon::parse($date)->format('d-m-Y');
        } elseif ($type === 'weekly') {
            $start = Carbon::parse($date)->startOfWeek();
            $end = Carbon::parse($date)->endOfWeek();
            $label = 'Mingguan - ' . $start->format('d-m-Y') . ' s/d ' . $end->format('d-m-Y');
        } elseif ($type === 'monthly') {
            $start = Carbon::parse($month . '-01')->startOfMonth();
            $end = Carbon::parse($month . '-01')->endOfMonth();
            $label = 'Bulanan - ' . $start->format('F Y');
        } else {
            $start = Carbon::today()->startOfDay();
            $end = Carbon::today()->endOfDay();
            $label = 'Harian - ' . Carbon::today()->format('d-m-Y');
            $type = 'daily';
        }

        $transactions = Transaction::whereBetween('created_at', [$start, $end])->get();
        $total = $transactions->sum('total_price');

        return view('admin.report.daily', compact(
            'transactions',
            'total',
            'type',
            'date',
            'month',
            'label',
            'start',
            'end',
            'start_date',
            'end_date'
        ));
    }

    public function pdf(Request $request)
    {
        $type = $request->type ?? 'daily';
        $date = $request->date ?? Carbon::today()->toDateString();
        $month = $request->month ?? Carbon::now()->format('Y-m');
        $start_date = $request->start_date ?? Carbon::today()->toDateString();
        $end_date = $request->end_date ?? Carbon::today()->toDateString();

        if ($type === 'custom') {
            $start = Carbon::parse($start_date)->startOfDay();
            $end = Carbon::parse($end_date)->endOfDay();
            $label = 'Laporan Periode: ' . $start->format('d-m-Y') . ' s/d ' . $end->format('d-m-Y');
            $filename = 'laporan-custom-' . $start_date . '-ke-' . $end_date . '.pdf';
        } elseif ($type === 'daily') {
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date)->endOfDay();
            $label = 'Laporan Harian - ' . Carbon::parse($date)->format('d-m-Y');
            $filename = 'laporan-penjualan-' . $date . '.pdf';
        } elseif ($type === 'weekly') {
            $start = Carbon::parse($date)->startOfWeek();
            $end = Carbon::parse($date)->endOfWeek();
            $label = 'Laporan Mingguan - ' . $start->format('d-m-Y') . ' s/d ' . $end->format('d-m-Y');
            $filename = 'laporan-mingguan-' . $date . '.pdf';
        } elseif ($type === 'monthly') {
            $start = Carbon::parse($month . '-01')->startOfMonth();
            $end = Carbon::parse($month . '-01')->endOfMonth();
            $label = 'Laporan Bulanan - ' . $start->format('F Y');
            $filename = 'laporan-bulanan-' . $month . '.pdf';
        }

        $transactions = Transaction::whereBetween('created_at', [$start, $end])->get();
        $total = $transactions->sum('total_price');

        $pdf = Pdf::loadView('admin.report.daily_pdf', compact('transactions', 'total', 'label'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream($filename);
    }
}
