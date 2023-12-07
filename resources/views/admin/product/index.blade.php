@extends('layouts.master')
@section('title', 'Products')
@section('content')

    <div class="container mt-5 text-center">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-center">
            <a href="{{ route('products.create') }}" class="btn btn-lg btn-success mb-3">Create Product</a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form action="{{ route('products.search') }}" method="GET">
                    @csrf
                    <div class="input-group mb-3">
                        <select class="form-select" name="category_id" id="category_id">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option @selected($category->id == $selectedCategory) value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-sm btn-primary" type="submit">Filter</button>
                    </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search"
                        placeholder="Search by ID, Title, or Description">
                    <button class="btn btn-sm btn-primary" type="submit">Search</button>
                </div>
            </div>

            <div class="col-md-4">
                <form action="{{ route('products.search') }}" method="GET">
                    @csrf
                    <div class="input-group mb-3">
                        <select class="form-select" name="sort" id="sort">

                            <option value="">All</option>
                            {{-- @foreach ($sortingMethods as $key => $value)
                                option value="{{ $value                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     }}">
                                    {{ $key }}
                                </option>
                            @endforeach --}}
                        </select>
                        <button class="btn btn-sm btn-primary" type="submit">Filter</button>
                    </div>
            </div>
            </form>
        </div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th class="col-1">ID</th>
                    <th class="col-3">Title</th>
                    <th class="col-3">Description</th>
                    <th class="col-1">Category</th>
                    <th class="col-1">Quantity</th>
                    <th class="col-1">Price</th>
                    <th class="col-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th>{{ $product->id }}</th>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}-{{ changeCurency($product->price, 'EGY') }}</td>
                        <td>
                            <div class="d-flex text-center">
                                <div>
                                    <a href="{{ route('products.show', ['product' => $product]) }}"
                                        class="btn btn-sm mx-2 btn-primary">View</a>
                                </div>
                                <div>
                                    <a href="{{ route('products.edit', ['product' => $product]) }}"
                                        class="btn btn-sm mx-2 btn-warning">Edit</a>
                                </div>
                                <div>
                                    <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm mx-2 btn-danger inline"
                                            onclick="return confirm('Are you sure you want to DELETE this product?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
