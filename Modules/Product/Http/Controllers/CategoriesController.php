<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Entities\Category;
use Modules\Product\DataTables\ProductCategoriesDataTable;

class CategoriesController extends Controller
{
    public function index(ProductCategoriesDataTable $dataTable)
    {
        abort_if(Gate::denies('access_product_categories'), 403);

        // Ambil semua kategori untuk tampilan mobile
        $categories = Category::all();

        // Kirimkan ke view agar bisa ditampilkan di versi mobile
        return $dataTable->render('product::categories.index', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('access_product_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code',
            'category_name' => 'required'
        ]);

        Category::create([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
        ]);

        toast('Kategori Produk Ditambah!', 'success');

        return redirect()->back();
    }

    public function edit($id)
    {
        abort_if(Gate::denies('access_product_categories'), 403);

        $category = Category::findOrFail($id);

        return view('product::categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('access_product_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code,' . $id,
            'category_name' => 'required'
        ]);

        Category::findOrFail($id)->update([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
        ]);

        toast('Kategori Produk Diupdate!', 'info');

        return redirect()->route('product-categories.index');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('access_product_categories'), 403);

        $category = Category::findOrFail($id);

        if ($category->products()->exists()) {
            return back()->withErrors('Tidak bisa menghapus karena kategori memiliki produk.');
        }

        $category->delete();

        toast('Kategori Produk Dihapus!', 'warning');

        return redirect()->route('product-categories.index');
    }
}
