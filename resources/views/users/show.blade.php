@extends('layouts.dashboard')
@section('content')
    <div class="row">
         <p>{{ $user->name }}</p>
         <p>{{ $user->email }}</p>


        <ul>
            @foreach($user->products as $product)
                <li>{{ $product->title }}</li>
            @endforeach
        </ul>
    </div>


    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('users.mail', $user->email ) }}" method="post">
        @csrf
        @method('post')
        <button type="submit" class="btn btn-danger">Send Email</button>

    </form>



    <div class="row">
        <form action="{{ route('users.destroy', $user->id ) }}" method="post">
            @csrf
            @method('delete')

            <button type="submit" class="btn btn-danger">Delete User</button>

        </form>



    </div>

@endsection
