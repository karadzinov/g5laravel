@extends('layouts.app')
@section('content')
    <div class="row">
         <p>{{ $user->name }}</p>
         <p>{{ $user->email }}</p>
    </div>

    <div class="row">
        <form action="{{ route('users.destroy', $user->id ) }}" method="post">
            @csrf
            @method('delete')

            <button type="submit" class="btn btn-danger">Delete User</button>

        </form>
    </div>
@endsection
