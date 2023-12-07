<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadImage;

class CategoryController extends Controller
{
    use UploadImage;
    public function chanageLang(Request $request)
    {
        $lang = $request->lang;
        session()->put('lang', $lang);
        App::setLocale($lang);
        return redirect()->back();
    }

    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function show(Category $category)
    {
        return view('admin.category.show', ['category' => $category]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $storae = 'public/category';
        $default = "public/category/default.png";

        Category::create($request->storeImageAndGetData($storae, $default));

        return redirect()->route('categories.index')
            ->with('success', 'Category Created Successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // $oldImagePath = $category->image;

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->image->store('public/category');
        //     $category->image = $imagePath;
        //     if ($oldImagePath !== "public/category/default.png" && !empty($oldImagePath)) {
        //         Storage::delete($oldImagePath);
        //     }
        // }
        // $category->name = $request->name;
        // $category->description = $request->description;
        // $category->save();

        $category->update($request->storeImageAndGetData());

        return redirect()->route('categories.edit', ['category' => $category->id])->with('success', 'Category Updated Successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully');
    }
}
