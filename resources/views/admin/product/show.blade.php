@extends('layouts.master')
@section('title', 'category')
@section('content')
    <div class="container mt-5">
        <h1 class="text-decoration-underline">{{ $product->id }}</h1>
        <img width="80" src="{{ $product->imageUrl() }}" alt="">
    </div>
@endsection
