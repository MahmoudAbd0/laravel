@extends('layouts.master')
@section('title', 'Create Category')
@section('content')
    <div class="container mt-5 mx-auto">
        <h1>Create Product</h1>
        <hr class=" mb-5">
        <form action="{{ route('products.store') }}" method="POST", enctype="multipart/form-data">
            @csrf
            <div class="mb-3 ">
                <label for="product-title" class="form-label fw-semibold">Title</label>
                <input value="{{ old('title') }}" class="form-control form-input" id="product-title" name="title">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="product-description" class="form-label fw-semibold">Description</label>
                <textarea class="form-control form-input" id="product-description" rows="3" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 ">
                <label for="product-category" class="form-label fw-semibold">Category</label>
                <select class="form-select form-input" name="category_id" id="">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 ">
                <label for="product-quantity" class="form-label fw-semibold">Quantity</label>
                <input type="number" value="{{ old('quantity') }}" class="form-control form-input" id="product-quantity"
                    name="quantity">
                @error('quantity')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 ">
                <label for="product-price" class="form-label fw-semibold">Price</label>
                <input type="number" step="0.1" value="{{ old('price') }}" class="form-control form-input"
                    id="product-price" name="price">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-3 ">
                <label for="formFile" class="form-label fw-semibold">Image</label>
                <input class="form-control form-input" name="image" type="file" id="formFile">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
