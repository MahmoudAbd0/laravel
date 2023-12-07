@extends('layouts.master')
@section('title', 'Create Category')
@section('content')
    <div class="container mt-5 mx-auto">
        <h1>Edit Product</h1>
        <hr class=" mb-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST",
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 ">
                        <label for="product-title" class="form-label fw-semibold">Title</label>
                        <input value="{{ $product->title }}" class="form-control " id="product-title" name="title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 ">
                        <label for="product-description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control " id="product-description" rows="3" name="description">{{ $product->description }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 ">
                        <label for="product-category" class="form-label fw-semibold">Category</label>
                        <select class="form-select " name="category_id" id="">
                            @foreach ($categories as $category)
                                <option @selected($category->id == $product->category_id) value="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 ">
                        <label for="product-quantity" class="form-label fw-semibold">Quantity</label>
                        <input type="number" value="{{ $product->quantity }}" class="form-control " id="product-quantity"
                            name="quantity">
                        @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 ">
                        <label for="product-price" class="form-label fw-semibold">Price</label>
                        <input type="number" step="0.1" value="{{ $product->price }}" class="form-control "
                            id="product-price" name="price">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 ">
                        <label for="formFile" class="form-label fw-semibold">Image</label>
                        <input class="form-control " name="image" type="file" id="formFile">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-success">Update</button>
                </form>
            </div>
            <div class="col-6 text-center">
                <img width="50%" src="{{ $product->imageUrl() }}" class="mt-3" alt="">
            </div>
        </div>
    </div>
@endsection
