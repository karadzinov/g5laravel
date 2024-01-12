@extends('layouts.dashboard')
@section('content')
    <div class="row">

        <div class="col-4">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        </div>
    </div>
    <div class="row">

        <div class="col-12">


            <div class="table table-striped">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><a href="/products/{{ $product->id }}">{{ $product->id }}</a></td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{!!  \Illuminate\Support\Str::limit($product->description, 13)  !!}</td>
                            <td>{{ \Carbon\Carbon::parse($product->created_at)->diffForHumans() }}</td>
                            <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>

    </script>
@endsection
