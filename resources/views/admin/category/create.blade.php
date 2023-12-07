@extends('layouts.master')
@section('title', 'Create Category')
@section('content')
    <div class="container mt-5 mx-auto">
        <h1>Create Category</h1>
        <hr class=" mb-5">

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 ">
                <label for="exampleFormControlInput1" class="form-label fw-semibold">Category Name</label>
                <input value="{{ old('name') }}" class="form-control form-input" id="exampleFormControlInput1"
                    name="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Description</label>
                <textarea class="form-control form-input" id="exampleFormControlTextarea1" rows="3" name="description">{{ old('description') }}</textarea>
                @error('description')
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
