<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.barang.index');
    }

    public function data(Request $request)
    {
        $query = Barang::with('category', 'satuan')->latest();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('kategori', function ($query) {
                return $query->category->name;
            })
            ->addColumn('satuan', function ($query) {
                return  $query->satuan->name;
            })
            ->addColumn('harga', function ($query) {
                return format_uang($query->harga);
            })
            ->addColumn('aksi', function ($query) {
                return '
                   <div class="btn-group">
                        <button onclick="editForm(`' . route('barang.show', $query->code) . '`)" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i> Edit</button>
                        <button onclick="detailForm(`' . route('barang.detail', $query->code) . '`)" class="btn btn-warning btn-xs"><i class="fas fa-eye"></i> Detail</button>
                        <button onclick="deleteData(`' . route('barang.destroy', $query->code) . '`, `' . $query->name . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Delete</button>
                   </div>
                ';
            })
            ->escapeColumns([])
            ->make(true);
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
        $rules = [
            'name' => 'required|min:2',
            'code' => 'required|min:1',
            'categories' => 'required',
            'satuan' => 'required',
            'harga' => 'required|regex:/^[0-9.]+$/',
            'stock' => 'required|min:1',
        ];

        $message = [
            'name.required' => 'Nama barang wajib diisi',
            'code.required' => 'Kode barang wajib diisi',
            'categories.required' => 'Kategori barang wajib diisi',
            'satuan.required' => 'Satuan barang wajib diisi',
            'harga.required' => 'Harga barang wajib diisi',
            'stock.required' => 'Stok barang wajib diisi',

            'name.min' => 'Nama barang minimal 2 karakter',
            'code.min' => 'Kode barang minimal 1 karakter',
            'stock.min' => 'Stok barang minimal 1 berupa angka',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa isian anda dan coba lagi'], 422);
        }

        $data = [
            'name' => trim($request->name),
            'code' => trim($request->code),
            'category_id' => $request->categories,
            'satuan_id' => $request->satuan,
            'harga' => str_replace('.', '', $request->harga),
            'stock' => $request->stock,
        ];

        Barang::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function detail(Barang $barang)
    {
        $barang->category;
        $barang->satuan;
        return response()->json(['data' => $barang]);
    }

    public function show(Barang $barang)
    {
        $barang->category;
        $barang->satuan;
        return response()->json(['data' => $barang]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $barang->category;
        $barang->satuan;
        return response()->json(['data' => $barang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $rules = [
            'name' => 'required|min:2',
            'code' => 'required|min:1',
            'categories' => 'required',
            'satuan' => 'required',
            'harga' => 'required|regex:/^[0-9.]+$/',
            'stock' => 'required|min:1',
        ];

        $message = [
            'name.required' => 'Nama barang wajib diisi',
            'code.required' => 'Kode barang wajib diisi',
            'categories.required' => 'Kategori barang wajib diisi',
            'satuan.required' => 'Satuan barang wajib diisi',
            'harga.required' => 'Harga barang wajib diisi',
            'stock.required' => 'Stok barang wajib diisi',

            'name.min' => 'Nama barang minimal 2 karakter',
            'code.min' => 'Kode barang minimal 1 karakter',
            'stock.min' => 'Stok barang minimal 1 berupa angka',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa isian anda dan coba lagi'], 422);
        }

        $data = [
            'name' => trim($request->name),
            'code' => trim($request->code),
            'category_id' => $request->categories,
            'satuan_id' => $request->satuan,
            'harga' => str_replace('.', '', $request->harga),
            'stock' => $request->stock,
        ];

        $barang->update($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return response()->json(['message' => 'Data berhasil disimpan']);
    }
}
