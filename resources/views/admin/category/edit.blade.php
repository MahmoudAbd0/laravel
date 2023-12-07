@extends('layouts.master')
@section('title', 'Edit Category')
@section('content')
    <div class="container mt-5 mx-auto">
        <h1>Edit Category</h1>
        <hr class="mb-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 ">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Category Name</label>
                        <input value="{{ $category->name }}" class="form-control " id="exampleFormControlInput1"
                            name="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 ">
                        <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="description">{{ $category->description }}</textarea>
                        @error('description')
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
                <img width="50%" src="{{ $category->imageUrl() }}" class="mt-3" alt="">
            </div>
        </div>
    </div>
@endsection
