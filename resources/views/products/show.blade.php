<!-- resources/views/product/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>{{ number_format($product->price, 2) }} DT</p>
    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
@endsection
