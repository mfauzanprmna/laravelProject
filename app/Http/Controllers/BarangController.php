<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Http\Requests\BarangStoreRequest as RequestsBarangStoreRequest;
use App\Models\Barang;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\ValidatedInput;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
use App\Imports\BarangImport;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::get();
        return view('barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
        ]);

        $barang = Barang::create([
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
        ]);

        if ($barang) {
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
        ]);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
        ]);

        if ($barang) {
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Barang deleted successfully');
    }

    public function export()
    {
        return Excel::download(new BarangExport, 'barang.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'file' => 'required|max:2048',
        ]);

        Excel::import(new BarangImport, $request->file('file'));

        return back()->with('success', 'Users imported successfully.');
    }
}
