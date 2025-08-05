<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use App\Imports\TransaksiImport;
use PDF;

class TransaksiController extends Controller
{
    // Tampilkan semua data transaksi
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('transaksi.index', compact('transaksi'));
    }

    // Tampilkan form create manual
    public function create()
    {
        return view('transaksi.create');
    }

    // Simpan data dari form manual
    public function store(Request $request)
    {
        $request->validate([
            'kode_toko' => 'required|numeric',
            'nominal_transaksi' => 'required|numeric',
        ]);

        Transaksi::create($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Data berhasil ditambahkan');
    }

    // Tampilkan form import Excel
    public function importForm()
    {
        return view('transaksi.import');
    }

    // Proses import Excel
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new TransaksiImport, $request->file('file'));

        return redirect()->route('transaksi.index')->with('success', 'Import berhasil');
    }

    // Export ke Excel
    public function exportExcel()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }

    // Export ke PDF
    public function exportPDF()
    {
        $data = Transaksi::all();
        $pdf = PDF::loadView('transaksi.pdf', compact('data'));
        return $pdf->download('transaksi.pdf');
    }
// Tampilkan form edit
public function edit($id)
{
    $transaksi = Transaksi::findOrFail($id);
    return view('transaksi.edit', compact('transaksi'));
}

// Proses update
public function update(Request $request, $id)
{
    $request->validate([
        'kode_toko' => 'required|numeric',
        'nominal_transaksi' => 'required|numeric',
    ]);

    $transaksi = Transaksi::findOrFail($id);
    $transaksi->update($request->all());

    return redirect()->route('transaksi.index')->with('success', 'Data berhasil diperbarui');
}
    // Proses delete
    public function destroy($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $transaksi->delete();

    return redirect()->route('transaksi.index')->with('success', 'Data berhasil dihapus');
}
}
