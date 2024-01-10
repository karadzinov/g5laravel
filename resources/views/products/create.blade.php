@extends('layouts.app')
@section('content')

    <form action="{{ route('products.store') }}" method="post">
        @csrf
        <div class="row mt-4">
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="title">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="quantity" name="quantity">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" name="description"></textarea>
            </div>

            <div class="mb-3 row">
                <label for="user_id">Select User</label>
                <select class="form-control" name="user_id" id="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3 row">
                <button type="submit" class="btn btn-primary">Add Product</button>
            </div>
        </div>
    </form>
@endsection
