<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'          => 'required|min:5',
            'description'   => 'required|min:10',
            'waktu_dipinjam'=> 'required|date',
            'stock'         => 'required|numeric',
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('public/products');

        // Create product
        Product::create([
            'image'         => basename($imagePath),
            'nama'          => $validatedData['nama'],
            'description'   => $validatedData['description'],
            'waktu_dipinjam'=> Carbon::parse($validatedData['waktu_dipinjam']),
            'stock'         => $validatedData['stock'],
        ]);

        return redirect()->route('products.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validatedData = $request->validate([
            'image'          => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'nama'           => 'required|min:5',
            'description'    => 'required|min:10',
            'waktu_dipinjam' => 'required|date',
            'stock'          => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('public/products');
            $product->image = basename($imagePath);
        }

        // Update product
        $product->update([
            'nama'           => $validatedData['nama'],
            'description'    => $validatedData['description'],
            'waktu_dipinjam' => Carbon::parse($validatedData['waktu_dipinjam']),
            'stock'          => $validatedData['stock'],
        ]);

        return redirect()->route('products.index')->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Delete image
        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }

        // Delete product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
