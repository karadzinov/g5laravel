@extends('layouts.dashboard')
@section('content')
    <div class="row">
         <p>{{ $product->title }}</p>
         <p>{{ $product->quantity }}</p>
         <p>{{ $product->user->name }}</p>
    </div>

    <div class="row">
        <form action="{{ route('products.destroy', $product->id ) }}" method="post">
            @csrf
            @method('delete')

            <button type="submit" class="btn btn-danger">Delete Product</button>

        </form>
    </div>
@endsection
