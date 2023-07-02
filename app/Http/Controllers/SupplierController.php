<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.supplier.index');
    }

    public function data(Request $request)
    {
        $query = Supplier::latest();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {
                return '
                    <div class="btn-group">
                    <button onclick="editForm(`' . route('supplier.show', $query->slug) . '`)" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button onclick="deleteData(`' . route('supplier.destroy', $query->slug) . '`, `' . $query->name . '`)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
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
            'email' => 'required|unique:suppliers',
            'phone' => 'required:min:11',
            'address' => 'required|min:5',
        ];
        $message = [
            'name.required' => 'Nama supplier wajib diisi',
            'email.required' => 'Email supplier wajib diisi',
            'phone.required' => 'Nomor Hp supplier wajib diisi',
            'address.required' => 'Alamat supplier wajib diisi',

            'name.min' => 'Nama supplier minimal 2 karakter',
            'phone.min' => 'Nomor supplier minimal 11 digit',
            'address.min' => 'Alamat supplier minimal 5 Karakter',

            'email.unique' => 'Email supplier sudah ada sebelumnya',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa isian anda dan coba lagi'], 422);
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        Supplier::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return response()->json(['data' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return response()->json(['data' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $rules = [
            'name' => 'required|min:2',
            'email' => 'required|unique:suppliers,id, '. $supplier->slug,
            'phone' => 'required:min:11',
            'address' => 'required|min:5',
        ];
        $message = [
            'name.required' => 'Nama supplier wajib diisi',
            'email.required' => 'Email supplier wajib diisi',
            'phone.required' => 'Nomor Hp supplier wajib diisi',
            'address.required' => 'Alamat supplier wajib diisi',

            'name.min' => 'Nama supplier minimal 2 karakter',
            'phone.min' => 'Nomor supplier minimal 11 digit',
            'address.min' => 'Alamat supplier minimal 5 Karakter',

            'email.unique' => 'Email supplier sudah ada sebelumnya',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa isian anda dan coba lagi'], 422);
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        $supplier->update($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
