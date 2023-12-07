<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        //     ->select('products.*', 'categories.name as category_name')
        //     ->paginate(10);

        $products = Product::with("category:id,name");
        if ($request->category_id) {
            $products = $products->where('category_id', $request->category_id);
        }
        $products = $products->paginate(10);
        $categories = Category::all($columns = ['id', 'name']);
        $sortingMethods = ['Creation Date "Asc"' => 0,  'Creation Date "Desc"' => 1,  'Update Date "Asc"' => 2,  'Update Date "Desc"' => 3];

        return view('admin.product.index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $request->category_id,
            'sortingMethods' => $sortingMethods
        ]);
    }

    public function show(Product $product)
    {
        return view('admin.product.show', ['product' => $product]);
    }

    public function create(Category $categories)
    {
        return view('admin.product.create', ['categories' => $categories::all()]);
    }

    public function store(CreateProductRequest $request)
    {
        $imagePath = $request->image ? $request->image->store('public/product') : 'public/product/default.jpg';
        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'quantity' => $request->quantity ?? null,
            'price' => $request->price ?? null,
            'category_id' => $request->category_id,
            'image' => $imagePath
        ]);
        return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all(['id', 'name']);
        return view('admin.product.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $oldImagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('public/product');
            $product->image = $imagePath;
            if ($oldImagePath !== 'public/product/default.jpg' && !empty($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        }
        $product->title = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->update();
        return redirect()->route('products.edit', ['product' => $product->id])->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $selectedCategory = $request->category_id;
        $categories = Category::all($columns = ['id', 'name']);

        $productsQuery = Product::with("category:id,name");

        if ($selectedCategory) {
            $products = $productsQuery->where('category_id', $selectedCategory);
        }

        if ($search) {
            $productsQuery->where(function ($query) use ($search) {
                $query->where('id', $search)
                    ->orWhere('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }
        $products = $productsQuery->paginate(10);

        return view('admin.product.index', compact('products', 'categories', 'selectedCategory'));
    }
}
