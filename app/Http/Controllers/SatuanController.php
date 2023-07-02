<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.satuan.index');
    }

    public function data(Request $request)
    {
        $query = Satuan::latest();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {
                return '
                   <div class="btn-group">
                        <button onclick="editForm(`' . route('satuan.show', $query->slug) . '`)" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i> Edit</button>
                        <button onclick="deleteData(`' . route('satuan.destroy', $query->slug) . '`, `' . $query->name . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Delete</button>
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
        ];

        $message = [
            'name.required' => 'Nama satuan wajib diisi',
            'name.min' => 'Nama satuan minimal 2 karakter',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa isian anda dan coba lagi'], 422);
        }

        $data = [
            'name' => trim($request->name),
            'slug' => Str::slug($request->name),
        ];


        Satuan::create($data);


        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Satuan $satuan)
    {
        return response()->json(['data' => $satuan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satuan $satuan)
    {
        return response()->json(['data' => $satuan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Satuan $satuan)
    {
        $rules = [
            'name' => 'required|min:2',
        ];

        $message = [
            'name.required' => 'Nama satuan wajib diisi.',
            'name.min' => 'Nama satuan minimal 2 karakter.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa isian anda dan coba lagi.'], 422);
        }

        $data = [
            'name' => trim($request->name),
            'slug' => Str::slug($request->name),
        ];


        $satuan->update($data);


        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Satuan $satuan)
    {
        $satuan->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
