<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.barangmasuk.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $barang = Barang::where('code', $request->kodebarang)->first();

        $data = $request->except('kodebarang');

        $data['hrgabeli'] = str_replace('.', '', $data['hargabeli']);
        $data['hrgajual'] = str_replace('.', '', $data['hargajual']);
        $data['barang_id'] = str_replace('.', '', $barang->id);
        $data['tgltransaksi'] = Date('Y-m-d');

        if (!$barang) {
            return response()->json(['message' => 'Data tidak ada dalam sistem'], 400);
        }

        BarangMasuk::create($data);

        return response()->json(['message' => 'Item berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrfail($id);

        $barangMasuk->delete();

        return response()->json(['message' => 'Item berhasil dihapus']);

    }

    public function ambilDataBarang(Request $request)
    {
        $barang = Barang::where('code', $request->kodebarang)->first();

        if (!$barang) {
            return response()->json(['message' => 'Kode barang tidak ditemukan'], 422);
        }

        return response()->json(['data' => $barang]);
    }

    public function ambilDataItem(Request $request)
    {
        $query = BarangMasuk::all();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('kodebarang', function ($query) {
                return $query->barang->code;
            })
            ->addColumn('namabarang', function ($query) {
                return $query->barang->name;
            })
            ->addColumn('hrgajual', function ($query) {
                return format_uang($query->hrgajual);
            })
            ->addColumn('hrgabeli', function ($query) {
                return format_uang($query->hrgabeli);
            })
            ->addColumn('subtotal', function ($query) {
                return format_uang($query->hrgabeli * $query->jumlah);
            })
            ->addColumn('aksi', function ($query) {
                return '
                    <button onclick="deleteData(`' . route('barangmasuk.destroy', $query->id) . '`, `' . $query->barang->name . '`)" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i> Delete</button>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }
}
