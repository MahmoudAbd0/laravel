@extends('layouts.master')
@section('title', 'Categories')
@section('content')
    <div class="container mt-5 text-center">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('categories.create') }}" class="btn btn-lg btn-success">Create Category</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th class="col-1">ID</th>
                    <th class="col-3">Name</th>
                    <th class="col-5">Description</th>
                    <th class="col-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="">
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <div class="d-flex text-center">
                                <div>
                                    <a href="{{ route('categories.show', ['category' => $category->id]) }}"
                                        class="btn btn-sm mx-2 btn-primary">View</a>
                                </div>
                                <div>
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                        class="btn btn-sm mx-2 btn-warning">Edit</a>
                                </div>
                                <div>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm mx-2 btn-danger inline"
                                            onclick="return confirm('Are you sure you want to DELETE this category?')">Delete</button>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {{ $categories->links() }}

    </div>
@endsection
