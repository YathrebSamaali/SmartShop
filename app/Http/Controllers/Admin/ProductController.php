<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::when(request('search'), function($query) {
                    $query->where('name', 'like', '%'.request('search').'%')
                          ->orWhere('description', 'like', '%'.request('search').'%');
                })
                ->paginate(5);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $this->handleImageUpload($request);

        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category' => $validated['category'],
            'image' => $imagePath
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    private function handleImageUpload(Request $request)
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $fileName = time().'_'.$request->file('image')->getClientOriginalName();

        return $request->file('image')->storeAs(
            'products',
            $fileName,
            'public'
        );
    }

    public function show(Product $product)
    {

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $imagePath = $this->handleImageUpload($request);
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category' => $validated['category'],
            'image' => $imagePath
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function export($format)
    {
        switch ($format) {
            case 'csv':
                return Excel::download(new ProductsExport, 'products.csv');
            case 'excel':
                return Excel::download(new ProductsExport, 'products.xlsx');
            case 'pdf':
                $products = Product::all();
                $pdf = PDF::loadView('admin.products.export_pdf', compact('products'));
                return $pdf->download('products.pdf');
            default:
                abort(404, 'Unsupported format');
        }
    }
}
