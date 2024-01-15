@extends('layouts.dashboard')
@section('content')

    <form action="{{ route('products.update', $product->id) }}" method="post">
        @method('put')
        @csrf
        <div class="row mt-4">
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control  @error('title') is-invalid @enderror" id="name" name="title"
                           value="{{ $product->title }}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

            </div>

            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                           value="{{ $product->price }}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
            <div class="mb-3 row">
                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                           name="quantity" value="{{ $product->quantity }}">
                    @error('quantity')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

            </div>
            <div class="mb-3 row">
                <label for="description">Description</label>
                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                          name="description">{{ $product->description }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="mb-3 row">
                <label for="user_id">Select User</label>
                <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if($product->user_id === $user->id) selected @endif >{{ $user->name }}</option>
                    @endforeach
                </select>

                @error('user_id')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>


            <div class="mb-3 row">
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </div>
    </form>
@endsection
