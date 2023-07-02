<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.kategori.index');
    }

    public function data(Request $request)
    {
        $query = Category::latest();

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($query) {
                return '
                   <div class="btn-group">
                        <button onclick="editForm(`' . route('category.show', $query->slug) . '`)" class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i> Edit</button>
                        <button onclick="deleteData(`' . route('category.destroy', $query->slug) . '`, `' . $query->name . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Delete</button>
                   </div>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $categories = Category::where("name", "LIKE", "%$keyword%")->get();

        return $categories;
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
            'name.required' => 'Nama kategori wajib diisi',
            'name.min' => 'Nama kategori minimal 2 karakter',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa isian anda dan coba lagi'], 422);
        }

        $data = [
            'name' => trim($request->name),
            'slug' => Str::slug($request->name),
        ];


        Category::create($data);


        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json(['data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json(['data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|min:2',
        ];

        $message = [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.min' => 'Nama kategori minimal 2 karakter.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silahkan periksa isian anda dan coba lagi.'], 422);
        }

        $data = [
            'name' => trim($request->name),
            'slug' => Str::slug($request->name),
        ];


        $category->update($data);


        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
